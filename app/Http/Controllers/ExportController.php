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
        
        $items = DB::table('vitems')
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where('item_name', 'like',"%{$search}%");
            })
            ->get();

        $pdf = Pdf::loadView('exports.items-pdf', compact('items'));
        return $pdf->download('items.pdf');
    }
}