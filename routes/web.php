<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

Route::get('/dashboard', [PagesController::class, 'dashboardAdmin'])->name('admin.dashboard');
Route::get('/', [PagesController::class, 'home'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PagesController::class, 'dashboardAdmin'])->name('admin.dashboard');
    Route::resource('items', ItemController::class);
    Route::prefix('exports')->group(function () {
        Route::get('/items/pdf', [ExportController::class, 'exportPdf'])->name('items.export.pdf');
        Route::get('/items/excel', [ExportController::class, 'exportExcel'])->name('items.export.excel');
    });
    // Tambahkan rute lain yang memerlukan autentikasi
});

Route::controller(AuthController::class)->group(function (){
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.submit');

    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register')->name('register.submit');
    


    Route::get('/auth/{provider}/redirect', 'redirectToProvider')->name('social.redirect');
    Route::get('/auth/{provider}/callback', 'handleProviderCallback')->name('social.callback');

    // password reset
    Route::get('forgot-password', 'showForgotPasswordForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetLink')->name('password.email');

    Route::post('/logout', 'logout')->name('logout');
});