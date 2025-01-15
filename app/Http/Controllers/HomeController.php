<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Booking;
use App\Models\Package;
use App\Models\PaxCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin(){
        return view('admin');
    }

    public function index(){

        $sliders = Slider::latest()->get();

        return view('home', compact('sliders'));
    }

    public function package(Request $request){

        $packages = Package::latest()->get();
        $date = $request->input('date');
        return view('trip.package', compact('packages', 'date'));
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
