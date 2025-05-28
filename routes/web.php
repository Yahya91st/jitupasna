<?php

use App\Http\Controllers\BencanaController;
use App\Http\Controllers\HargaSatuanDasarController;
use App\Http\Controllers\KategoriBangunanController;
use App\Http\Controllers\KategoriBencanaController;
use App\Http\Controllers\KerugianController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\SatuanController;
use App\Models\HSD;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\Form4Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('/bencana')->middleware(['auth', 'verified'])->name('bencana.')->group(function () {
    Route::get('list', [BencanaController::class, 'index'])->name('index');
    Route::get('create', [BencanaController::class, 'create'])->name('create');
    Route::post('store', [BencanaController::class, 'store'])->name('store');
    Route::get('detail/{id}', [BencanaController::class, 'show'])->name('show');
    Route::get('edit/{id}', [BencanaController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [BencanaController::class, 'update'])->name('update');
    Route::get('destroy/{id}', [BencanaController::class, 'destroy'])->name('destroy');
    Route::get('form-lanjutan/{id}', [BencanaController::class, 'formLanjutan'])->name('form-lanjutan');
});
Route::get('/bencana/get-desa/{kecamatan_id}', [BencanaController::class, 'getDesaByKecamatan'])->middleware(['auth', 'verified']);

Route::prefix('/kerusakan')->middleware(['auth', 'verified'])->name('kerusakan.')->group(function () {
    Route::get('list', [KerusakanController::class, 'index'])->name('index');
    Route::get('create/{id}', [KerusakanController::class, 'create'])->name('create');
    Route::post('store/{id}', [KerusakanController::class, 'store'])->name('store');
    Route::get('edit/{id}', [KerusakanController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [KerusakanController::class, 'update'])->name('update');
});
Route::prefix('/kerugian')->middleware(['auth', 'verified'])->name('kerugian.')->group(function () {
    Route::get('list', [KerugianController::class, 'index'])->name('index');
    Route::get('create/{id}', [KerugianController::class, 'create'])->name('create');
    Route::post('store/{id}', [KerugianController::class, 'store'])->name('store');
    Route::get('edit/{id}', [KerugianController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [KerugianController::class, 'update'])->name('update');
});
Route::prefix('/kategori-bangunan')->middleware(['auth', 'verified'])->name('kategori-bangunan.')->group(function () {
    Route::get('list', [KategoriBangunanController::class, 'index'])->name('index');
    Route::post('store', [KategoriBangunanController::class, 'store'])->name('store');
    Route::patch('update/{id}', [KategoriBangunanController::class, 'update'])->name('update');
});
Route::prefix('/kategori-bencana')->middleware(['auth', 'verified'])->name('kategori-bencana.')->group(function () {
    Route::get('list', [KategoriBencanaController::class, 'index'])->name('index');
    Route::post('store', [KategoriBencanaController::class, 'store'])->name('store');
    Route::patch('update/{id}', [KategoriBencanaController::class, 'update'])->name('update');
});
Route::prefix('/satuan')->middleware(['auth', 'verified'])->name('satuan.')->group(function () {
    Route::get('list', [SatuanController::class, 'index'])->name('index');
    Route::post('store', [SatuanController::class, 'store'])->name('store');
    Route::patch('update/{id}', [SatuanController::class, 'update'])->name('update');
});
Route::prefix('/hsd')->middleware(['auth', 'verified'])->name('hsd.')->group(function () {
    Route::get('list', [HargaSatuanDasarController::class, 'index'])->name('index');
    Route::post('store', [HargaSatuanDasarController::class, 'store'])->name('store');
});
Route::get('/get-nama-by-tipe/{tipe}', function ($tipe) {
    $namaList = HSD::where('tipe', $tipe)->get(['id', 'nama', 'satuan', 'harga']);
    // Format harga ke format Rupiah dengan "Rp" di depan
    $namaList = $namaList->map(function ($item) {
        $item->harga = 'Rp ' . number_format($item->harga, 2, ',', '.');
        return $item;
    });
    return response()->json($namaList);
})->middleware(['auth', 'verified']);
// Route::post('/upload-cropped-image', 'ImageController@uploadCroppedImage')->middleware(['auth', 'verified']);

// Forms Routes
Route::prefix('/forms')->middleware(['auth', 'verified'])->name('forms.')->group(function () {
    Route::get('/', [FormsController::class, 'index'])->name('index');
    
    // Form 4 (Sektor Perumahan)
    Route::prefix('form4')->name('form4.')->group(function() {
        Route::get('/', [Form4Controller::class, 'index'])->name('index');
        Route::get('/perumahan', [Form4Controller::class, 'perumahan'])->name('perumahan');
        Route::get('/format1form4', [Form4Controller::class, 'format1form4'])->name('format1form4');
        Route::post('/store', [Form4Controller::class, 'store'])->name('store');
        Route::get('/show/{id}', [Form4Controller::class, 'show'])->name('show');
        Route::get('/pdf/{id}', [Form4Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form4Controller::class, 'previewPdf'])->name('preview-pdf');
        Route::get('/list', [Form4Controller::class, 'listData'])->name('list');
    });
});

require __DIR__ . '/auth.php';

// Route::middleware('guest')->group(function () {
//     Route::get('register', function () {
//         return view('auth.register');
//     })->name('register');
// });

// require __DIR__ . '/auth.php';