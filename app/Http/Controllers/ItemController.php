<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemUnit;
use App\Models\Location;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
                return $query->whereIn(DB::raw('TRIM(category_name)'), $selectedCategories);
            })->paginate(10);
        $selectedUnitItems = DB::table('vitems')->where('item_type', '=', 'unit')->get(['item_id', 'item_name']);

        if($request->ajax()){
            $paginationHtml = view('components.pagination', [
                'paginator' => $items,
                'routeName' => 'items.index',
                'routeParams' => [],
                'queryParams' => $request->except('page'),
            ])->render();

            return response()->json([
                'html' => view('items.partials.items-list', compact('items'))->render(),
                'pagination' => $paginationHtml,
                'search' => $search,
                'categories' => $selectedCategories,
            ]);
        }

        return view('items.index', compact('items', 'categories', 'locations', 'selectedUnitItems'));
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
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,category_id',
            'location_id' => 'required|integer|exists:locations,location_id',
            'item_type' => 'required|string|in:unit,consumable',
            'stock' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->input('item_type') === 'consumable';
                }),
                'integer',
                'min:0'
            ],
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate slug otomatis
        $slug = Str::slug($validatedData['item_name']);
        $count = Item::where('slug_item', 'LIKE', "$slug%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        // Simpan data barang
        $item = new Item();
        $item->item_name = $validatedData['item_name'];
        $item->slug_item = $slug;
        $item->category_id = $validatedData['category_id'];
        $item->location_id = $validatedData['location_id'];
        $item->item_type = $validatedData['item_type'];
        $item->stock = $validatedData['stock'] ?? 0; // Default 0 jika tidak ada
        $item->description = $validatedData['description'];

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
        $students = DB::table('vstudents')->get();
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
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,category_id',
            'location_id' => 'required|integer|exists:locations,location_id',
            'item_type' => 'required|string|in:unit,consumable',
            'stock' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->input('item_type') === 'consumable';
                }),
                'integer',
                'min:0'
            ],
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'units' => 'nullable|array',
            'units.*.unit_id' => 'required|integer|exists:item_units,unit_id',
            'units.*.unit_name' => 'required|string|max:255',
            'units.*.unit_status' => 'required|in:available,borrowed,maintenance',
            'units.*.unit_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // ================== UPDATE ITEM UTAMA ==================
        $item->update([
            'item_name' => $validatedData['item_name'],
            'category_id' => $validatedData['category_id'],
            'location_id' => $validatedData['location_id'],
            'item_type' => $validatedData['item_type'],
            'stock' => $validatedData['stock'] ?? 0,
            'description' => $validatedData['description']
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($item->image && file_exists(public_path($item->image))) {
                unlink(public_path($item->image));
            }

            // Ambil file gambar dan buat nama file unik
            $file = $request->file('image');
            $imageName = $item->slug_item . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/products'), $imageName);

            // Update kolom image
            $item->image = 'assets/images/products/' . $imageName;
            $item->save();
        }
        // ================== UPDATE UNIT ITEM ==================
        if ($item->item_type === 'unit' && isset($validatedData['units'])) {
            foreach ($validatedData['units'] as $unitData) {
                $unit = ItemUnit::where('unit_id', $unitData['unit_id'])
                    ->where('item_id', $item->item_id) // Pastikan unit milik item ini
                    ->firstOrFail();

                $updateData = [
                    'unit_name' => $unitData['unit_name'],
                    'unit_status' => $unitData['unit_status']
                ];

                // Update gambar unit jika ada
                if (isset($unitData['unit_image'])) {
                    // Hapus gambar lama jika ada
                    if ($unit->unit_image && file_exists(public_path($unit->unit_image))) {
                        unlink(public_path($unit->unit_image));
                    }

                    // Ambil file gambar dan buat nama file unik
                    $unitFile = $unitData['unit_image'];
                    $unitImageName = strtolower(str_replace(' ', '_', $item->item_name)) . '_unit_' . $unit->unit_id . '_' . time() . '.' . $unitFile->getClientOriginalExtension();

                    // Tentukan folder tujuan berdasarkan item_name
                    $itemNameFolder = strtolower(str_replace(' ', '_', $item->item_name)) . 's'; // Contoh: "pc_desktops"
                    $unitFolder = public_path("assets/images/unit_items/{$itemNameFolder}");

                    // Pastikan folder tujuan ada
                    if (!file_exists($unitFolder)) {
                        mkdir($unitFolder, 0777, true);
                    }

                    // Pindahkan file ke folder tujuan
                    $unitFile->move($unitFolder, $unitImageName);

                    // Update kolom unit_image dengan path relatif
                    $updateData['unit_image'] = "assets/images/unit_items/{$itemNameFolder}/{$unitImageName}";
                }

                // Simpan perubahan ke database
                $unit->update($updateData);
            }
        }

        return redirect()->route('items.show', $item->slug_item)
            ->with('success', 'Item dan unit berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::with('units')->findOrFail($id);

        // Hapus semua unit terkait
        foreach ($item->units as $unit) {
            // Hapus gambar unit jika ada
            if ($unit->unit_image && file_exists(public_path($unit->unit_image))) {
                unlink(public_path($unit->unit_image));
            }
            $unit->delete();
        }
        // Hapus gambar jika ada
        if ($item->image && file_exists(public_path($item->image))) {
            unlink(public_path($item->image));
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item dan semua unit terkait berhasil dihapus');
    }
}
