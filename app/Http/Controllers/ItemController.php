<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ItemsExport;
use PDF;


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
        })->when($selectedCategories, function ($query) use ($selectedCategories){
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
    public function show(Item $items)
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
