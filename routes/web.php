<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

Route::get('/', [PagesController::class, 'dashboardAdmin'])->name('admin.dashboard');
Route::resource('items', ItemController::class);