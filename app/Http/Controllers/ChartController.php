<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function getChartData()
    {
        $chartLabelsBarang = Item::pluck('item_name')->toArray();
        $chartDataStockBarang = Item::pluck('stock')->toArray();
        $kategoriChartData = DB::table('vitems')->select('category_name', DB::raw('COUNT(item_id) as total'))->groupBy('category_name')->orderByDesc('total')->get();

        $topKategori = $kategoriChartData->take(5);
        $otherKategori = $kategoriChartData->slice(5);

        $otherTotal = $otherKategori->sum('total');
        $finalData = $topKategori->toArray();

        if($otherTotal>0){
            $finalData[]=(object)[
                'category_name'=>'Lainnya',
                'total'=>$otherTotal
            ];
        }
        return response()->json([
            'chartBarang' => [
                'data' => $chartDataStockBarang,
                'labels' => $chartLabelsBarang,
            ],
            'chartKategori' => [
                'data' => $finalData,
            ]
        ]);
        
    }
}
