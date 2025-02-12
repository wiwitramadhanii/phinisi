<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\PaxCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required|string|max:255',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validasi untuk gambar
            'time' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'description' => 'nullable|string',
            'min_price' => 'required|integer',
            'include' => 'nullable|json',
            'exclude' => 'nullable|json',
            'rundown' => 'nullable|json',
        ]);

        // Menangani upload gambar jika ada
        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('public/banners');
        }

        $package = new Package();
        $package->package_name = $request->package_name;
        $package->banner = $bannerPath ? Storage::url($bannerPath) : null; // Menyimpan path gambar
        $package->time = $request->time;
        $package->route = $request->route;
        $package->description = $request->description;
        $package->min_price = $request->min_price;
        $package->include = $request->include ? json_encode($request->include) : null;
        $package->exclude = $request->exclude ? json_encode($request->exclude) : null;
        $package->rundown = $request->rundown ? json_encode($request->rundown) : null;
        $package->save();

        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
    }

    public function show($id, Request $request) {

        $package = Package::findOrFail($id);
        $paxCategories = PaxCategory::where('package_id', $id)->get();
        $totalPrice = 0;

        if ($request->has('pax_category_id') && $request->has('num_pax')) {
            $paxCategory = PaxCategory::find($request->input('pax_category_id'));
            $numPax = $request->input('num_pax');
    
            if ($paxCategory) {
                $totalPrice = $paxCategory->price_per_pax * $numPax; // Hitung total price
            }
        }

        return view('packages.show', compact('package', 'paxCategories', 'totalPrice'));
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'package_name' => 'required|string|max:255',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validasi untuk gambar
            'time' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'description' => 'nullable|string',
            'min_price' => 'required|integer',
            'include' => 'nullable|json',
            'exclude' => 'nullable|json',
            'rundown' => 'nullable|json',
        ]);

        $package = Package::findOrFail($id);
        
        // Menangani upload gambar baru jika ada
        if ($request->hasFile('banner')) {
            // Hapus gambar lama jika ada
            if ($package->banner) {
                $oldBannerPath = str_replace('/storage', 'public', $package->banner);
                Storage::delete($oldBannerPath);
            }
            $bannerPath = $request->file('banner')->store('public/banners');
            $package->banner = Storage::url($bannerPath);
        }

        $package->package_name = $request->package_name;
        $package->time = $request->time;
        $package->route = $request->route;
        $package->description = $request->description;
        $package->min_price = $request->min_price;
        $package->include = $request->include ? json_encode($request->include) : null;
        $package->exclude = $request->exclude ? json_encode($request->exclude) : null;
        $package->rundown = $request->rundown ? json_encode($request->rundown) : null;
        $package->save();

        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($package->banner) {
            $oldBannerPath = str_replace('/storage', 'public', $package->banner);
            Storage::delete($oldBannerPath);
        }

        $package->delete();

        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }
    

}
