<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\PaxCategory;
use Illuminate\Http\Request;

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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'time' => 'required',
            'route' => 'required|string',
            'description' => 'nullable|string',
            'min_price' => 'required|integer',
            'include' => 'nullable|array',
            'exclude' => 'nullable|array',
            'rundown' => 'nullable|array',
            'status' => 'required|in:available,full',
        ]);
    

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages');
        }
    
        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('packages');
        }

        Package::create($data);

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
        $package = Package::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'time' => 'required',
            'route' => 'required|string',
            'description' => 'nullable|string',
            'min_price' => 'required|integer',
            'include' => 'nullable|array',
            'exclude' => 'nullable|array',
            'rundown' => 'nullable|array',
            'status' => 'required|in:available,full',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages');
        }
    
        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('packages');
        }

        $package->update($data);

        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }
    

}
