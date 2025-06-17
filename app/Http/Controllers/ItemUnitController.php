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
            'item_name' => 'required|string',
            'unit_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        ]);

        // Proses penyimpanan data
        $unit = new ItemUnit();
        $unit->item_id = $request->item_id;
        $unit->unit_name = $request->unit_name;
        // Simpan gambar jika ada
        if ($request->hasFile('unit_image')) {
            // Ambil file dari request
            $file = $request->file('unit_image');

            // Buat nama file unik
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Tentukan folder penyimpanan berdasarkan item_name
            $itemNameFolder = strtolower(str_replace(' ', '_', $request->item_name)) . 's'; // Contoh: "pc_desktops"
            $folderPath = public_path("assets/images/unit_items/{$itemNameFolder}");

            // Pastikan folder sudah ada, jika belum, buat folder tersebut
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0755, true); // Buat folder dengan izin 0755
            }

            // Pindahkan file ke folder tujuan
            $file->move($folderPath, $fileName);

            // Simpan path relatif ke database
            $relativePath = "assets/images/unit_items/{$itemNameFolder}/{$fileName}";
            $unit->unit_image = $relativePath;
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
    public function destroy(Request $request)
    {

        // Validasi input
        $request->validate([
            'item-units' => 'required|array',
            'item-units.*' => 'exists:item_units,unit_id'
        ]);

        // Ambil unit yang akan dihapus dengan kunci yang benar
        $units = ItemUnit::whereIn('unit_id', $request->input('item-units'))->get();

        foreach ($units as $unit) {
            // Hapus gambar jika ada
            if ($unit->unit_image && file_exists(public_path($unit->unit_image))) {
                unlink(public_path($unit->unit_image));
            }
            // Hapus record unit
            $unit->delete();
        }

        return redirect()->back()->with('success', 'Unit terpilih berhasil dihapus');
    }
}
