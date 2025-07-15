<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\Documentation;
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentations = Documentation::all();
        $packages = Package::all();
        return view('admin.documentations.index', compact('documentations', 'packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::all();
        return view('admin.documentations.create', compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'file_path' => 'required|array',
            'file_path.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240',
        ]);

        $paths = [];
        $paths[] = $request->file('file_path')->store('documentations', 'public');
        
        Documentation::create([
            'package_id' => $request->package_id,
            'file_path'  => $paths,
          ]);
        return redirect()->route('admin.documentations.index')->with('success', 'File created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documentation $documentation)
    {
        $packages = Package::all();
        return view('admin.documentations.edit', compact('documentation', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documentation $documentation)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'file_path' => 'required|array',
            'file_path.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240',
        ]);

        $documentation->package_id = $request->package_id;

        if ($request->hasFile('file_path')) {
            Storage::disk('public')->delete($documentation->file_path);
            $filePath = $request->file('file_path')->store('documentations', 'public');
            $documentation->file_path = $filePath;
        }
        $documentation->save();

        return redirect()->route('admin.documentations.index')->with('success', 'File updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documentation $documentation)
    {
        Storage::disk('public')->delete($documentation->file_path);
        $documentation->delete();

        return redirect()->route('admin.documentations.index')->with('success', 'File deleted successfully');
    }
}
