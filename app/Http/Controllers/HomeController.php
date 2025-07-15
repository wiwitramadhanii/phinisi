<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Booking;
use App\Models\Documentation;
use App\Models\Package;
use App\Models\Itinerary;
use App\Models\PaxCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{

    public function index(){
        $sliders = Slider::oldest()->get();
        $itineraries = Itinerary::latest()->get();
        $events = Package::all();
        
        $bookings = Booking::whereDate('selected_date', Carbon::today())->get()->groupBy('package_id');
        return view('home', compact('sliders', 'itineraries', 'events', 'bookings'));
    }
    

    public function package(Request $request){
        $packages = Package::oldest()->get();
        $paxCategories = PaxCategory::all();
        $documentations = Documentation::all();
        $date = $request->input('date');
        return view('trip.package', compact('packages', 'date', 'paxCategories', 'documentations'));
    }

    public function search(Request $request)
    {
        $date = $request->input('date');
    
        // Ambil ID paket yang sudah dibooking pada tanggal yang dipilih
        $bookedPackages = Booking::where('selected_date', $date)
            ->where('status', 'full_booked')
            ->pluck('package_id');
    
        // Ambil paket yang tidak ada dalam daftar bookedPackages
        $packages = Package::whereNotIn('id', $bookedPackages)->get();
    
        return response()->json($packages);
    
        // Jika bukan AJAX, kembalikan tampilan dengan paket
        return view('trip.package', compact('packages'));
    }
}
