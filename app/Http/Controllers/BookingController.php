<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\PaxCategory;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::all();
        $paxCategories = PaxCategory::all();
        return view('bookings.index', compact('bookings', 'paxCategories'));
    }

    public function showBillingForm($package_id, Request $request)
    {
        $package = Package::findOrFail($package_id);

        $selectedDate = $request->input('selected-date');
        $paxCategoryId = $request->input('pax_category_id');
        $paxCategory = PaxCategory::findOrFail($paxCategoryId);

        // Parse pax range into min and max values
        [$minPax, $maxPax] = explode('-', $paxCategory->pax_range);

        return view('billing.create', [
            'package' => $package,
            'selectedDate' => $selectedDate,
            'paxCategory' => $paxCategory,
            'minPax' => $minPax,
            'maxPax' => $maxPax,
            'pricePerPax' => $paxCategory->price_per_pax,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'package_name' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'required|string',
            'time' => 'required',
            'route' => 'required',
            'selected_date' => 'required|date',
            'pax_category' => 'required|string',
            'num_pax' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'pax_category_id' => 'required|exists:pax_categories,id',
        ]);
        
        $package = Package::find($request->package_id);
        $paxCategory = PaxCategory::find($request->pax_category_id);

        // Cek ketersediaan slot
        $availableSlots = $this->checkAvailability($package, $request->selected_date, $paxCategory->pax_range);

        if (!$paxCategory) {
            return back()->with('error', 'Pax category not found.');
        }

        if ($availableSlots <= 0) {
            return redirect()->back()->with('error', 'The trip package is full for the selected dates.');
        }

        $totalPrice = $paxCategory->price_per_pax * $request->num_pax;

        // Simpan data pemesanan ke database
        $booking = Booking::create([
            'package_id' => $request->package_id,
            'package_name' => $request->package_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'pax_category' => $paxCategory->pax_range,
            'time' => $request->time,
            'route' => $request->route,
            'selected_date' => $request->selected_date,
            'time' => $request->time,
            'num_pax' => $request->num_pax,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('billing.payment', ['booking' => $booking->id]);
    }

    public function payment($bookingId)
    {
        // Ambil data pemesanan berdasarkan ID
        $booking = Booking::findOrFail($bookingId);

        // Tampilkan halaman pembayaran dengan data pemesanan
        return view('billing.payment', compact('booking'));
    }


    public function calculateTotalPrice($paxCategory, $numPax)
    {
    // Mengambil kategori pax berdasarkan kategori yang dipilih
        $paxCategory = PaxCategory::where('pax_range', $paxCategory)->firstOrFail();

    // Memeriksa apakah jumlah pax sesuai dengan kategori yang dipilih
        if ($numPax < $paxCategory->min_pax || $numPax > $paxCategory->max_pax) {
            return response()->json([
                'error' => 'Jumlah pax tidak sesuai dengan kategori yang dipilih.',
            ], 400);
        }

    // Menghitung total harga
        $totalPrice = $paxCategory->price_per_pax * $numPax;

        return response()->json([
            'pax_category' => $paxCategory->pax_range,
            'price_per_pax' => $paxCategory->price_per_pax,
            'num_pax' => $numPax,
            'total_price' => $totalPrice,
        ]);
    }

    public function getPricePerPax($paxCategory)
    {
    // Menyaring kategori pax berdasarkan kategori yang dipilih
        $paxCategory = PaxCategory::where('pax_range', $paxCategory)->firstOrFail();
    
        return response()->json([
            'price_per_pax' => $paxCategory->price_per_pax,
        ]);
    }


    private function checkAvailability($package, $date, $paxCategory)
    {
        $bookedPax = Booking::where('package_id', $package->id)
                            ->where('selected_date', $date)
                            ->where('pax_category', $paxCategory)
                            ->count();
        
        $capacity = [
            '10-14' => 14,
            '15-19' => 19,
            '20-24' => 24,
            '25-50' => 50,
        ];

        $remainingSlots = $capacity[$paxCategory] - $bookedPax;
        return $remainingSlots;
    }

    public function getBookings()
    {
        $bookings = Booking::with('package')
            ->select('package_id', 'selected_date')
            ->get();

        $response = [];

        foreach ($bookings as $booking) {
            $response[] = [
                'date' => $booking->selected_date,
                'package_name' => $booking->package->package_name,
                'status' => 'full booked', // Default status for bookings
            ];
        }

        return response()->json($response);
    }

    // public function getFullBookedDates()
    // {
    //     $fullBookedDates = Booking::pluck('selected_date')->toArray();
    //     return response()->json($fullBookedDates);
    // }
    public function getFullBookedDates(Request $request)
    {
        $selectedDate = $request->query('date');
        $packageId = $request->query('package_id');
        
        // Mendapatkan semua pemesanan untuk tanggal yang dipilih
        $bookedPackages = Booking::where('selected_date', $selectedDate)->get(['package_id']);
        
        // Mengambil ID paket yang tidak tersedia
        $unavailablePackages = $bookedPackages->pluck('package_id')->toArray();

        return response()->json([
            'unavailablePackages' => $unavailablePackages
        ]);
    }
}
