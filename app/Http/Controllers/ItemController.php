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



class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        $search = $request->input('search');
        $selectedCategories = $request->input('categories', []);
        $items = DB::table('vitems')
            ->when($search, function ($query) use ($search) {
                return $query->where('item_name', 'like', "%{$search}%");
            })->when($selectedCategories, function ($query) use ($selectedCategories) {
                return $query->whereIn('category_name', $selectedCategories);
            })->paginate(9);


        if ($request->ajax()) {
            return response()->json([
                'html' => view('items.partials.items-list', compact('items'))->render(),
                'checks' => $selectedCategories // Kirim kategori yang terpilih
            ]);
        }
        return view('items.index', compact('items', 'categories'));
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
        //
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
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'location_id' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif'
        ]);

        Item::where('item_id', $item->item_id)
            ->update([
                'item_name' => $request->item_name,
                'category_id' => $request->category_id,
                'location_id' => $request->location_id,
                'stock' => $request->stock,
                'description' => $request->description,
            ]);

        // Gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($item->image && file_exists(public_path($item->image))) {
                unlink(public_path($item->image));
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('assets/images/products', 'public');

            // Update kolom image di database
            $item->update(['image' => 'storage/' . $imagePath]);
        }

        return redirect()->route('items.show', ['item' => $item->slug_item])->with('status', 'Barang Berhasil di Edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
