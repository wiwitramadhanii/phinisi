<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItineraryController extends Controller
{
    public function index()
    {
        $itineraries = Itinerary::all();
        return view('admin.itineraries.index', compact('itineraries'));
    }

    public function create()
    {
        return view('admin.itineraries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subtitle' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:51200',
        ]);

        $imagePath = $request->file('image')->store('itineraries', 'public');

        Itinerary::create([
            'subtitle' => $request->subtitle,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.itineraries.index')->with('success', 'Itinerary berhasil ditambahkan!');
    }

    public function edit(Itinerary $itinerary)
    {
        return view('admin.itineraries.edit', compact('itinerary'));
    }

    public function update(Request $request, Itinerary $itinerary)
    {
        $request->validate([
            'subtitle' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:51200',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $itinerary->image);
            $imagePath = $request->file('image')->store('itineraries', 'public');
            $itinerary->image = $imagePath;
        }

        $itinerary->subtitle = $request->subtitle;
        $itinerary->save();

        return redirect()->route('admin.itineraries.index')->with('success', 'Itinerary berhasil diperbarui!');
    }

    public function destroy(Itinerary $itinerary)
    {
        Storage::disk('public')->delete($itinerary->image);
        $itinerary->delete();

        return redirect()->route('admin.itineraries.index')->with('success', 'Itinerary berhasil dihapus!');
    }
}
