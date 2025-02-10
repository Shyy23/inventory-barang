<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;

Route::get('/chart-data', [ChartController::class, 'getChartData']);