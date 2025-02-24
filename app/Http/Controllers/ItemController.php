<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemUnit;
use App\Models\Location;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $locations = Location::where('type', '=', 'item')->get();

        $search = $request->input('search');
        $selectedCategories = $request->input('categories', []);
        $items = DB::table('vitems')
            ->when($search, function ($query) use ($search) {
                return $query->where('item_name', 'like', "%{$search}%");
            })->when($selectedCategories, function ($query) use ($selectedCategories) {
                return $query->whereIn('category_name', $selectedCategories);
            })->paginate(12);


        if ($request->ajax()) {
            return response()->json([
                'html' => view('items.partials.items-list', compact('items'))->render(),
                'checks' => $selectedCategories // Kirim kategori yang terpilih
            ]);
        }
        return view('items.index', compact('items', 'categories', 'locations'));
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
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'location_id' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required|string',
            'image' => 'nullable|image',
        ]);

        // Generate slug otomatis
        $slug = Str::slug($request->item_name);
        $count = Item::where('slug_item', 'LIKE', "$slug%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        // Simpan data barang
        $item = new Item();
        $item->item_name = $request->item_name;
        $item->slug_item = $slug;
        $item->category_id = $request->category_id;
        $item->location_id = $request->location_id;
        $item->stock = $request->stock;
        $item->description = $request->description;

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $slug . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/products'), $imageName);
            $item->image = 'assets/images/products/' . $imageName;
        }

        $item->save();

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $students = Student::all();
        $items = Item::all();
        $item = DB::table('vitems')->where('slug_item', $slug)->first();
        $units = DB::table('vitem_units')->where('item_name', '=', $item->item_name)->get();
        $classes = DB::table('vclasses')->get();
        $subjects = Subject::all();
        $categories = Category::all();
        $locations = Location::where('type', '=', 'item')->get();

        if (!$item) {
            abort(404);
        }
        // dd($items);

        return view('items.show', compact('item', 'students', 'items', 'units', 'classes', 'subjects', 'categories', 'locations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari item berdasarkan ID
        $item = Item::find($id);

        // Jika item tidak ditemukan, redirect dengan pesan error
        if (!$item) {
            return redirect()->route('items.index')->with('error', 'Item not found');
        }

        // Tampilkan view edit dengan data item
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        // Validasi input
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'location_id' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required|string',
            'image' => 'nullable|image' // Ubah dari 'sometimes' ke 'nullable'
        ]);

        // Update data utama
        $item->item_name = $request->item_name;
        $item->category_id = $request->category_id;
        $item->location_id = $request->location_id;
        $item->stock = $request->stock;
        $item->description = $request->description;

        // Update gambar jika ada file baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($item->image && file_exists(public_path($item->image))) {
                unlink(public_path($item->image));
            }

            // Ambil file gambar dan buat nama file unik
            $file = $request->file('image');
            $imageName = $item->slug_item . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/products'), $imageName);

            // Update kolom image
            $item->image = 'assets/images/products/' . $imageName;
        }

        // Simpan perubahan ke database
        $item->save();

        // Redirect ke halaman detail item
        return redirect()->route('items.show', ['item' => $item->slug_item])
            ->with('status', 'Barang Berhasil di Edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        // Hapus gambar jika ada
        if ($item->image) {
            $imagePath = public_path($item->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item berhasil dihapus.');
    }
}
