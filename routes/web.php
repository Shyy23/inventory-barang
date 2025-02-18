<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

Route::get('/dashboard', [PagesController::class, 'dashboardAdmin'])->name('admin.dashboard');
Route::get('/', [PagesController::class, 'home'])->name('home');
Route::resource('items', ItemController::class);
Route::prefix('exports')->group(function () {
    Route::get('/items/pdf', [ExportController::class, 'exportPdf'])->name('items.export.pdf');
    Route::get('/items/excel', [ExportController::class, 'exportExcel'])->name('items.export.excel');
});

Route::controller(AuthController::class)->group(function (){
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    
    Route::get('/auth/{provider}/redirect', 'redirectToProvider')->name('social.redirect');
    Route::get('/auth/{provider}/callback', 'handleProviderCallback')->name('social.callback');

    // password reset
    Route::post('/forgot-password', 'sendResetLink')->name('password.email');
});