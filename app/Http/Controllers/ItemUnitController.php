<?php

namespace App\Http\Controllers;

use App\Models\ItemUnit;
use Illuminate\Http\Request;

class ItemUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'item_id' => 'required', // Pastikan item_id ada di tabel items
            'unit_name' => 'required|string|max:255',
            'unit_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        ]);

        // Proses penyimpanan data
        $unit = new ItemUnit();
        $unit->item_id = $request->item_id;
        $unit->unit_name = $request->unit_name;

        // Simpan gambar jika ada
        if ($request->hasFile('unit_image')) {
            $file = $request->file('unit_image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
            // Pindahkan file ke folder public/assets/images/unit_images
            $filePath = $file->move(public_path('assets/images/unit_images'), $fileName);
        
            // Simpan path relatif ke database
            $unit->unit_image = 'assets/images/unit_items/' . $fileName;
        }
        // Simpan data ke database
        $unit->save();

        // Redirect dengan pesan sukses
        return redirect()->route('items.index')->with('success', 'Unit barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
