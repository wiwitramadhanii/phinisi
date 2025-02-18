<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PaxCategory;
use Illuminate\Http\Request;

class PaxCategoryController extends Controller
{
    public function index()
    {
        $paxCategories = PaxCategory::all();
        $packages = Package::all();
        return view('paxCategories.index', compact('paxCategories', 'packages'));
    }
    public function create(){

        $packages = Package::all(); 
        return view('paxCategories.create', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'pax_range' => 'required|string',
            'price_per_pax' => 'required|numeric',
        ]);

        PaxCategory::create([
            'package_id' => $request->package_id,
            'pax_range' => $request->pax_range,
            'price_per_pax' => $request->price_per_pax,
        ]);

        return redirect()->route('paxCategories.index')->with('success', 'Pax Category created successfully.');
    }

    public function calculateTotalPrice($paxCategoryId, $numPax)
    {
        $paxCategory = PaxCategory::findOrFail($paxCategoryId);
        $totalPrice = $paxCategory->price_per_pax * $numPax;

        return response()->json([
            'pax_category' => $paxCategory->pax_range,
            'price_per_pax' => $paxCategory->price_per_pax,
            'num_pax' => $numPax,
            'total_price' => $totalPrice,
        ]);
    }

    public function calculateTotalPriceWithExtraPax($packageId, $numPax, $categoryId) {
        
        $package = Package::with('paxCategories')->findOrFail($packageId);
        $category = PaxCategory::find($categoryId);
        $totalPrice = $category->price_per_pax * $numPax;

        $closestPaxCategory = $package->paxCategories->filter(function ($category) use ($numPax) {
            [$minPax, $maxPax] = explode('-', $category->pax_range);
            return $numPax >= (int) $minPax && $numPax <= (int) $maxPax;
        })->first();
    
        if (!$closestPaxCategory) {
            return response()->json(['error' => 'Kategori pax tidak tersedia untuk jumlah pax yang dipilih.'], 404);
        }

        $pricePerPax = $closestPaxCategory->price_per_pax;
        $minPax = (int) explode('-', $closestPaxCategory->pax_range)[0];

        $totalPrice = ($minPax * $pricePerPax) + (($numPax - $minPax) * $pricePerPax);

        return response()->json([
            'pax_category' => $closestPaxCategory->pax_range,
            'price_per_pax' => $pricePerPax,    
            'num_pax' => $numPax,
            'total_price' => $totalPrice,
        ]);
    }

    public function edit($id)
    {
        $paxCategory = PaxCategory::findOrFail($id);
        $packages = Package::all(); // Mengambil data package
        return view('paxCategories.edit', compact('paxCategory', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'pax_range' => 'required|string|max:255',
            'price_per_pax' => 'required|numeric|min:0',
        ]);

        $paxCategory = PaxCategory::findOrFail($id);
        $paxCategory->update([
            'package_id' => $request->package_id,
            'pax_range' => $request->pax_range,
            'price_per_pax' => $request->price_per_pax,
        ]);

        return redirect()->route('paxCategories.index')->with('success', 'Pax Category berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $paxCategory = PaxCategory::findOrFail($id);
        $paxCategory->delete();

        return redirect()->route('paxCategories.index')->with('success', 'Pax Category berhasil dihapus!');
    }

    

    
}
