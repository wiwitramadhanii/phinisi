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
            'image'        => 'required|image|mimes:jpg,jpeg,png,gif|max:10240',
            'time'         => 'required|string|max:255',
            'route'        => 'required|string|max:255',
            'pax'          => 'required|string',
            'min_price'    => 'required|integer',
        
            'include'          => 'nullable|array',
            'include.*'        => 'string|max:255',
            'exclude'          => 'nullable|array',
            'exclude.*'        => 'string|max:255',
        
            'rundown'          => 'nullable|array',
            'rundown.*.time'     => 'required_with:rundown|string',
            'rundown.*.activity' => 'required_with:rundown|string',
        ]);
        

        $imagePath = $request->file('image')->store('packages', 'public');

        $package = new Package();
        $package->package_name = $request->package_name;
        $package->image        = $imagePath;
        $package->time         = $request->time;
        $package->route        = $request->route;
        $package->pax          = $request->pax;
        $package->min_price    = $request->min_price;
        $package->include      = $request->include;
        $package->exclude      = $request->exclude;
        $package->rundown      = $request->rundown;
        $package->save();

        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
    }

    public function show($id, Request $request)
    {
        $package = Package::with('paxCategories')->findOrFail($id);
        $documentations = $package->documentations;

        $allImages    = $documentations->pluck('file_path')->toArray();
        $bigImage     = $allImages[0] ?? null;
        $smallImages  = array_slice($allImages, 1, 4);
        $smallImages  = array_pad($smallImages, 4, null);

        $paxCategories = $package->paxCategories;
        $totalPrice    = 0;

        if ($request->has('pax_category_id') && $request->has('num_pax')) {
            $paxCategory = PaxCategory::find($request->input('pax_category_id'));
            $numPax      = $request->input('num_pax');

            if ($paxCategory) {
                $totalPrice = $paxCategory->price_per_pax * $numPax;
            }
        }

        return view('packages.show', compact('package', 'documentations','paxCategories', 'totalPrice', 'bigImage', 'smallImages'));
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
            'image'        => 'required|image|mimes:jpg,jpeg,png,gif|max:10240',
            'time'         => 'required|string|max:255',
            'route'        => 'required|string|max:255',
            'pax'          => 'required|string',
            'min_price'    => 'required|integer',
        
            // terima array
            'include'          => 'nullable|array',
            'include.*'        => 'string|max:255',
            'exclude'          => 'nullable|array',
            'exclude.*'        => 'string|max:255',
        
            'rundown'          => 'nullable|array',
            'rundown.*.time'     => 'required_with:rundown|string',
            'rundown.*.activity' => 'required_with:rundown|string',
        ]);
        

        $package = Package::findOrFail($id);

        // Replace existing image
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($package->image);
            $imagePath     = $request->file('image')->store('packages', 'public');
            $package->image = $imagePath;
        }

        $package->package_name = $request->package_name;
        $package->time         = $request->time;
        $package->route        = $request->route;
        $package->pax          = $request->pax;
        $package->min_price    = $request->min_price;
        $package->include      = $request->include;
        $package->exclude      = $request->exclude;
        $package->rundown      = $request->rundown;
        $package->save();

        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        Storage::disk('public')->delete($package->image);
        $package->delete();

        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }
}
