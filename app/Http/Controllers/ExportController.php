<?php

namespace App\Http\Controllers;

use App\Exports\ItemsExport;
use App\Models\Item;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    public function exportExcel(Request $request)
    {
        $filters = $request->all();
        return (new ItemsExport($filters))->download('items.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $filters = $request->all();
        // dd($filters);
        $items = DB::table('vitems')
        ->when(!empty($filters['search']), function ($query) use ($filters) {
            $query->where('item_name', 'like', "%{$filters['search']}%");
        })
        ->when(!empty($filters['categories']), function ($query) use ($filters) {
            // Pastikan categories adalah array dan filter nilai kosong
            $categories = array_filter((array) $filters['categories']);
            if (!empty($categories)) {
                $query->whereIn('category_name', $categories); // Sesuaikan dengan kolom di database
            }
        })
        ->get();

        $pdf = Pdf::loadView('exports.items-pdf', compact('items'));
        return $pdf->download('items.pdf');
    }
}