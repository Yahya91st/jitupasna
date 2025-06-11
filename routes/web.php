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
use App\Http\Controllers\Form1Controller;
use App\Http\Controllers\Form2Controller;
use App\Http\Controllers\Form6Controller;
use App\Http\Controllers\Form7Controller;
use App\Http\Controllers\PendataanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User Management - Admin only
    Route::middleware(['admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
Route::prefix('/bencana')->middleware(['auth', 'verified'])->name('bencana.')->group(function () {
    Route::get('list', [BencanaController::class, 'index'])->name('index');
    
    // Admin-only routes
    Route::middleware(['admin'])->group(function () {
        Route::get('create', [BencanaController::class, 'create'])->name('create');
        Route::post('store', [BencanaController::class, 'store'])->name('store');
        Route::get('edit/{id}', [BencanaController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [BencanaController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [BencanaController::class, 'destroy'])->name('destroy');
    });
    
    // Available to all authenticated users
    Route::get('detail/{id}', [BencanaController::class, 'show'])->name('show');
    Route::get('form-lanjutan/{id}', [BencanaController::class, 'formLanjutan'])->name('form-lanjutan');
});
Route::get('/bencana/get-desa/{kecamatan_id}', [BencanaController::class, 'getDesaByKecamatan'])->middleware(['auth', 'verified']);

Route::prefix('/kerusakan')->middleware(['auth', 'verified', 'admin'])->name('kerusakan.')->group(function () {
    Route::get('list', [KerusakanController::class, 'index'])->name('index');
    Route::get('create/{id}', [KerusakanController::class, 'create'])->name('create');
    Route::post('store/{id}', [KerusakanController::class, 'store'])->name('store');
    Route::get('edit/{id}', [KerusakanController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [KerusakanController::class, 'update'])->name('update');
});
Route::prefix('/kerugian')->middleware(['auth', 'verified', 'admin'])->name('kerugian.')->group(function () {
    Route::get('list', [KerugianController::class, 'index'])->name('index');
    Route::get('create/{id}', [KerugianController::class, 'create'])->name('create');
    Route::post('store/{id}', [KerugianController::class, 'store'])->name('store');
    Route::get('edit/{id}', [KerugianController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [KerugianController::class, 'update'])->name('update');
});
Route::prefix('/kategori-bangunan')->middleware(['auth', 'verified', 'admin'])->name('kategori-bangunan.')->group(function () {
    Route::get('list', [KategoriBangunanController::class, 'index'])->name('index');
    Route::post('store', [KategoriBangunanController::class, 'store'])->name('store');
    Route::patch('update/{id}', [KategoriBangunanController::class, 'update'])->name('update');
});
Route::prefix('/kategori-bencana')->middleware(['auth', 'verified', 'admin'])->name('kategori-bencana.')->group(function () {
    Route::get('list', [KategoriBencanaController::class, 'index'])->name('index');
    Route::post('store', [KategoriBencanaController::class, 'store'])->name('store');
    Route::patch('update/{id}', [KategoriBencanaController::class, 'update'])->name('update');
});
Route::prefix('/satuan')->middleware(['auth', 'verified', 'admin'])->name('satuan.')->group(function () {
    Route::get('list', [SatuanController::class, 'index'])->name('index');
    Route::post('store', [SatuanController::class, 'store'])->name('store');
    Route::patch('update/{id}', [SatuanController::class, 'update'])->name('update');
});
Route::prefix('/hsd')->middleware(['auth', 'verified', 'admin'])->name('hsd.')->group(function () {
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
        Route::get('/format7form4', [Form4Controller::class, 'format7form4'])->name('format7form4');
        Route::get('/format17form4', [Form4Controller::class, 'format17form4'])->name('format17form4');
        Route::get('/format16form4', [Form4Controller::class, 'format16form4'])->name('format16form4');
        Route::post('/store', [Form4Controller::class, 'store'])->name('store');
        Route::post('/store-format7', [Form4Controller::class, 'storeFormat7'])->name('store-format7');
        Route::post('/store-format17', [Form4Controller::class, 'storeFormat17'])->name('store-format17');
        Route::post('/store-format16', [Form4Controller::class, 'storeFormat16'])->name('store-format16');
        Route::get('/show-format1/{id}', [Form4Controller::class, 'showFormat1'])->name('show-format1');
        Route::get('/show-format17/{bencana_id}', [Form4Controller::class, 'showFormat17'])->name('show-format17');
        Route::get('/show-format7/{bencana_id}', [Form4Controller::class, 'showFormat7'])->name('show-format7');
        Route::get('/show-format16/{bencana_id}', [Form4Controller::class, 'showFormat16'])->name('show-format16');
        Route::get('/show-format3/{bencana_id}', [Form4Controller::class, 'showFormat3'])->name('show-format3');
        Route::get('/show-format2/{bencana_id}', [Form4Controller::class, 'showFormat2'])->name('show-format2');
        Route::get('/list-format17', [Form4Controller::class, 'listFormat17'])->name('list-format17');
        Route::get('/list-format7', [Form4Controller::class, 'listFormat7'])->name('list-format7');
        Route::get('/list-format16', [Form4Controller::class, 'listFormat16'])->name('list-format16');
        Route::get('/list-format3', [Form4Controller::class, 'listFormat3'])->name('list-format3');
        Route::get('/list-format2', [Form4Controller::class, 'listFormat2'])->name('list-format2');
        Route::get('/pdf/{id}', [Form4Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form4Controller::class, 'previewPdf'])->name('preview-pdf');
        Route::get('/format17-pdf/{bencana_id}', [Form4Controller::class, 'generateFormat17Pdf'])->name('format17-pdf');
        Route::get('/format17-preview-pdf/{bencana_id}', [Form4Controller::class, 'previewFormat17Pdf'])->name('format17-preview-pdf');
        Route::get('/format16-pdf/{bencana_id}', [Form4Controller::class, 'generateFormat16Pdf'])->name('format16-pdf');
        Route::get('/format16-preview-pdf/{bencana_id}', [Form4Controller::class, 'previewFormat16Pdf'])->name('format16-preview-pdf');
        Route::get('/list', [Form4Controller::class, 'listFormat1'])->name('list');
        Route::get('/list-format1', [Form4Controller::class, 'listFormat1'])->name('list-format1');
    });
    
    // Format 17 (Lingkungan Hidup)
    // Note: This group is redundant since we're using the route from forms.form4 namespace
    // Route::prefix('format17')->name('format17.')->group(function() {
    //     Route::post('/store', [Form4Controller::class, 'storeFormat17'])->name('store');
    // });
});

// Form 1 (Surat Permohonan Keterlibatan PDNA)
Route::prefix('/forms/form1')->middleware(['auth', 'verified'])->name('forms.form1.')->group(function() {
    Route::get('/', [Form1Controller::class, 'index'])->name('index');
    Route::post('/store', [Form1Controller::class, 'store'])->name('store');
    Route::get('/show/{id}', [Form1Controller::class, 'show'])->name('show');
    Route::get('/list-form1', [Form1Controller::class, 'listForm1'])->name('list-form1');
    Route::get('/pdf/{id}', [Form1Controller::class, 'generatePdf'])->name('pdf');
    Route::get('/preview-pdf/{id}', [Form1Controller::class, 'previewPdf'])->name('preview-pdf');
});

// Form 3 (Pendataan ke OPD)
Route::prefix('/forms/form3')->middleware(['auth', 'verified'])->name('forms.form3.')->group(function() {
    Route::get('/', [PendataanController::class, 'index'])->name('index');
    Route::post('/store', [PendataanController::class, 'store'])->name('store');
    Route::get('/show/{id}', [PendataanController::class, 'show'])->name('show');
    Route::get('/list', [PendataanController::class, 'list'])->name('list');
    Route::get('/pdf/{id}', [PendataanController::class, 'generatePdf'])->name('pdf');
    Route::get('/preview-pdf/{id}', [PendataanController::class, 'previewPdf'])->name('preview-pdf');
});

// Form 2 (Surat Keputusan Pembentukan Tim Kerja Pengkajian Kebutuhan Pascabencana)
Route::prefix('/forms/form2')->middleware(['auth', 'verified'])->name('forms.form2.')->group(function() {
    Route::get('/', [Form2Controller::class, 'index'])->name('index');
    Route::post('/store', [Form2Controller::class, 'store'])->name('store');
    Route::get('/show/{id}', [Form2Controller::class, 'show'])->name('show');
    Route::get('/edit/{id}', [Form2Controller::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [Form2Controller::class, 'update'])->name('update');
    Route::get('/list', [Form2Controller::class, 'listForm2'])->name('list');
    Route::get('/pdf/{id}', [Form2Controller::class, 'generatePdf'])->name('pdf');
    Route::get('/preview-pdf/{id}', [Form2Controller::class, 'previewPdf'])->name('preview-pdf');
});

// Form 6 (Formulir 06 - Pendataan Tingkat Rumahtangga)
Route::prefix('/forms/form6')->middleware(['auth', 'verified'])->name('forms.form6.')->group(function() {
    Route::get('/', [Form6Controller::class, 'index'])->name('index');
    Route::post('/store', [Form6Controller::class, 'store'])->name('store');
    Route::get('/show/{id}', [Form6Controller::class, 'show'])->name('show');
    Route::get('/edit/{id}', [Form6Controller::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [Form6Controller::class, 'update'])->name('update');
    Route::get('/list', [Form6Controller::class, 'listForm6'])->name('list');
    Route::get('/pdf/{id}', [Form6Controller::class, 'generatePdf'])->name('pdf');
    Route::get('/preview-pdf/{id}', [Form6Controller::class, 'previewPdf'])->name('preview-pdf');
});

// Form 7 (Formulir 07 - Diskusi Kelompok Terfokus (FGD))
Route::prefix('/forms/form7')->middleware(['auth', 'verified'])->name('forms.form7.')->group(function() {
    Route::get('/', [Form7Controller::class, 'index'])->name('index');
    Route::post('/store', [Form7Controller::class, 'store'])->name('store');
    Route::get('/show/{id}', [Form7Controller::class, 'show'])->name('show');
    Route::get('/edit/{id}', [Form7Controller::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [Form7Controller::class, 'update'])->name('update');
    Route::get('/list', [Form7Controller::class, 'listForm7'])->name('list');
    Route::get('/pdf/{id}', [Form7Controller::class, 'generatePdf'])->name('pdf');
    Route::get('/preview-pdf/{id}', [Form7Controller::class, 'previewPdf'])->name('preview-pdf');
});

require __DIR__ . '/auth.php';

// Route::middleware('guest')->group(function () {
//     Route::get('register', function () {
//         return view('auth.register');
//     })->name('register');
// });

// require __DIR__ . '/auth.php';