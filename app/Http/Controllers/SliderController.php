<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240', 
        ]);

        // Menyimpan gambar ke dalam storage dan mendapatkan path
        $imagePath = $request->file('image')->store('sliders', 'public');

        // Membuat slider baru dengan data title dan path gambar
        Slider::create([
            'title' => $request->title,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240',
        ]);

        if ($request->hasFile('image')) {
            // Menghapus gambar lama
            Storage::disk('public')->delete($slider->image);
            // Menyimpan gambar baru
            $imagePath = $request->file('image')->store('sliders', 'public');
            $slider->image = $imagePath;
        }

        $slider->title = $request->title;
        $slider->save();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->image);
        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
