<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemUnitController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Middleware\PreventBackHistory;



Route::get('/', [PagesController::class, 'home'])->name('home');

Route::middleware(['auth', PreventBackHistory::class])->group(function () {
    Route::get('/dashboard', [PagesController::class, 'dashboardAdmin'])->name('admin.dashboard');

    // Untuk items
    Route::resource('items', ItemController::class);
    // Untuk exports
    Route::prefix('exports')->group(function () {
        Route::get('/items/pdf', [ExportController::class, 'exportPdf'])->name('items.export.pdf');
        Route::get('/items/excel', [ExportController::class, 'exportExcel'])->name('items.export.excel');
    });
    Route::get('/dashboard', [PagesController::class, 'dashboardAdmin'])->name('admin.dashboard');

    // Untuk Loans
    Route::prefix('loans')->controller(LoanController::class)->group(function () {
        Route::get('pending-loan', 'pendingLoan')->name('loans.pending-loans');
        Route::get('monitoring', 'monitoring')->name('loans.monitoring');
        Route::put('{loan}/approve', 'approve')->name('loans.approve');
        Route::delete('{loan}/reject', 'reject')->name('loans.reject');
    });
    Route::resource('loans', LoanController::class);
    // Untuk Item Units
    Route::prefix('item-units')->controller(ItemUnitController::class)->group(function () {
        Route::get('create', 'create')->name('item-units.create');
        Route::post('/', 'store')->name('item-units.store');
        Route::put('{item-unit}', 'update')->name('item-units.update');
        Route::delete('/destroy', 'destroy')->name('item-units.destroy');
    });
    // Untuk Category
    Route::prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('categories.index');
        Route::post('/store', 'store')->name('categories.store');
        Route::put('/update', 'update')->name('categories.update');
        Route::delete('/destroy', 'destroy')->name('categories.destroy');
    });
    // Untuk Locations
    Route::prefix('locations')->controller(LocationController::class)->group(function () {
        Route::get('/', 'index')->name('locations.index');
        Route::post('/store', 'store')->name('locations.store');
        Route::put('/update', 'update')->name('locations.update');
        Route::delete('/destroy', 'destroy')->name('locations.destroy');
    });
    // Untuk Class
    Route::prefix('classes')->controller(ClassController::class)->group(function () {
        Route::get('/', 'index')->name('classes.index');
        Route::get('/{slug_class}/students', 'show')->name('classes.students');
        Route::post('/store', 'store')->name('classes.store');
        Route::put('/update', 'update')->name('classes.update');
        Route::delete('/destroy', 'destroy')->name('classes.destroy');
    });
    // Untuk Students
    Route::prefix('students')->controller(StudentController::class)->group( function () {
        Route::put('/update', 'update')->name('students.update');
        Route::delete('/destroy', 'destroy')->name('students.destroy');
    });
});

// Route diluar middleware yaitu sebelum user login

// Reset Password 
Route::prefix('password')->controller(PasswordResetController::class)->group(function () {
    Route::post('send-code', 'sendResetCode')->name('password.send-code')->middleware('throttle:5,1');
    Route::post('verify-code', 'verifyCode')->name('password.verify-code');
    Route::post('reset', 'resetPassword')->name('password.reset');
});

// Login
Route::controller(AuthController::class)->group(function () {

    Route::post('/login', 'login')->name('login.submit');

    Route::post('/register', 'register')->name('register.submit');

    Route::get('/auth/{provider}/redirect', 'redirectToProvider')->name('social.redirect');
    Route::get('/auth/{provider}/callback', 'handleProviderCallback')->name('social.callback');

    Route::get('forgot-password', 'showForgotPasswordForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetLink')->name('password.email');

    Route::post('/logout', 'logout')->name('logout');
});