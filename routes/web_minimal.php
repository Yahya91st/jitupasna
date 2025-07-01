<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\Form1Controller;
use App\Http\Controllers\Form4Controller;
use App\Http\Controllers\Form4\Format1Controller;
use App\Http\Controllers\BencanaController;
use App\Http\Controllers\KategoriBangunanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Management - Admin or Super Admin
    Route::middleware(['role:admin,super-admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

// Bencana Routes
Route::prefix('/bencana')->middleware(['auth', 'verified'])->name('bencana.')->group(function () {
    Route::get('/', [BencanaController::class, 'index'])->name('index');
    Route::get('/create', [BencanaController::class, 'create'])->name('create');
    Route::post('/store', [BencanaController::class, 'store'])->name('store');
    Route::get('/show/{id}', [BencanaController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [BencanaController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [BencanaController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [BencanaController::class, 'destroy'])->name('destroy');
    Route::get('/get-desa/{kecamatan_id}', [BencanaController::class, 'getDesaByKecamatan']);
    Route::get('/form-lanjutan/{id}', [BencanaController::class, 'formLanjutan'])->name('form-lanjutan');
});

// Kategori Bangunan Routes
Route::prefix('/kategori-bangunan')->middleware(['auth', 'verified', 'admin'])->name('kategori-bangunan.')->group(function () {
    Route::get('/list', [KategoriBangunanController::class, 'index'])->name('index');
    Route::post('/store', [KategoriBangunanController::class, 'store'])->name('store');
    Route::patch('/update/{id}', [KategoriBangunanController::class, 'update'])->name('update');
});

// Forms Routes
Route::prefix('/forms')->middleware(['auth', 'verified'])->name('forms.')->group(function () {
    Route::get('/', [FormsController::class, 'index'])->name('index');
    Route::get('form-list', [FormsController::class, 'index'])->name('form-list');

    // Form 1 - Initial disaster assessment form
    Route::prefix('form1')->name('form1.')->group(function () {
        Route::get('/', [Form1Controller::class, 'index'])->name('index');
        Route::post('/store', [Form1Controller::class, 'store'])->name('store');
        Route::get('/show/{id}', [Form1Controller::class, 'show'])->name('show');
        Route::get('/list', [Form1Controller::class, 'list'])->name('list');
        Route::get('/list-form1', [Form1Controller::class, 'listForm1'])->name('list-form1');
        Route::get('/pdf/{id}', [Form1Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form1Controller::class, 'previewPdf'])->name('preview-pdf');
    });

    // Form 4 (All Sectors) - Only Format1 is implemented
    Route::prefix('form4')->name('form4.')->group(function () {
        Route::get('/', [Form4Controller::class, 'index'])->name('index');
        
        // Format 1 - Housing sector (IMPLEMENTED)
        Route::prefix('format1')->name('format1.')->group(function () {
            Route::get('/', [Format1Controller::class, 'index'])->name('index');
            Route::post('/store', [Format1Controller::class, 'store'])->name('store');
            Route::get('/show/{id}', [Format1Controller::class, 'show'])->name('show');
            Route::get('/list', [Format1Controller::class, 'list'])->name('list');
            Route::get('/pdf/{id}', [Format1Controller::class, 'generatePdf'])->name('pdf');
            Route::get('/preview-pdf/{id}', [Format1Controller::class, 'previewPdf'])->name('preview-pdf');
        });
        
        // Legacy routes for backwards compatibility
        Route::get('/format1form4', [Format1Controller::class, 'index'])->name('format1form4');
        Route::get('/list-format1', [Format1Controller::class, 'list'])->name('list-format1');
    });
});

require __DIR__ . '/auth.php';