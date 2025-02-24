<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemUnitController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Middleware\PreventBackHistory;



Route::get('/', [PagesController::class, 'home'])->name('home');

Route::middleware(['auth', PreventBackHistory::class])->group(function () {
    Route::get('/dashboard', [PagesController::class, 'dashboardAdmin'])->name('admin.dashboard');

    Route::resource('items', ItemController::class);
    Route::prefix('exports')->group(function () {
        Route::get('/items/pdf', [ExportController::class, 'exportPdf'])->name('items.export.pdf');
        Route::get('/items/excel', [ExportController::class, 'exportExcel'])->name('items.export.excel');
    });
    Route::get('/dashboard', [PagesController::class, 'dashboardAdmin'])->name('admin.dashboard');

    // Untuk Item Units
    Route::get('/loans/delayed-loan', [LoanController::class, 'delayedLoan'])->name('loans.delayed-loans');
    Route::get('/loans/monitoring', [LoanController::class, 'monitoring'])->name('loans.monitoring');
    Route::put('/loans/{loan}/approve', [LoanController::class, 'approve'])->name('loans.approve');
    Route::delete('/loans/{loan}/reject', [LoanController::class, 'reject'])->name('loans.reject');
    Route::resource('loans', LoanController::class);
    Route::get('/item-units/create', [ItemUnitController::class, 'create'])->name('item-units.create');
    Route::post('/item-units', [ItemUnitController::class, 'store'])->name('item-units.store');


});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.submit');

    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register')->name('register.submit');

    Route::get('/auth/{provider}/redirect', 'redirectToProvider')->name('social.redirect');
    Route::get('/auth/{provider}/callback', 'handleProviderCallback')->name('social.callback');

    Route::get('forgot-password', 'showForgotPasswordForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetLink')->name('password.email');

    Route::post('/logout', 'logout')->name('logout');
});