<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\UpdateHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    use UpdateHelper;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::query()
            ->with([
                'items' => function ($query) {
                    $query->select('item_id', 'category_id', 'item_name', 'slug_item'); // Pilih kolom yang diperlukan
                }
            ])
            ->when($search, function ($query) use ($search) {
                return $query->where('category_name', 'LIKE', "%{$search}%");
            })
            ->paginate(12);


        return view('categories.index', compact('categories'));
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
        $validateData = $request->validate([
            'category_name' => 'required|string'
        ]);

        $category = new Category();
        $category->category_name = $validateData['category_name'];
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Kategori Berhasil Ditambahkan');
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
    public function update(Request $request)
    {

        try {
            $request->validate([
                'categories' => 'required|array',
                'categories.*.category_name' => 'required_if:categories.*.selected,1|string|max:255'
            ]);

            $updates = [];
            $ids = [];

            foreach ($request->categories as $categoryId => $data) {
                if (isset($data['selected'])) {
                    $ids[] = $categoryId;
                    $updates[$categoryId] = $data['category_name'];
                }
            }


            if (!empty($ids)) {
                $updateData = [];
                if (!empty($updates)) {
                    $updateData['category_name'] = $this->buildCaseStatement($updates, 'category_id');
                }

                if (!empty($updateData)) {
                    Category::whereIn('category_id', $ids)->update($updateData);
                }
            }

            return redirect()
                ->route('categories.index')
                ->with('success', 'Kategori berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'categories' => 'required|array',
                'categories.*' => 'exists:categories,category_id'
            ]);

            // Hapus kategori yang dipilih
            Category::whereIn('category_id', $request->categories)->delete();

            return redirect()
                ->route('categories.index')
                ->with('success', 'Kategori berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}
