<?php

use App\Http\Controllers\BencanaController;
use App\Http\Controllers\HargaSatuanDasarController;
use App\Http\Controllers\KategoriBangunanController;
use App\Http\Controllers\KategoriBencanaController;
use App\Http\Controllers\KerugianController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\KebutuhanController;
use App\Http\Controllers\SatuanController;
use App\Models\HSD;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\Form4Controller;
use App\Http\Controllers\Form1Controller;
use App\Http\Controllers\Form2Controller;
use App\Http\Controllers\Form3Controller;
use App\Http\Controllers\Form6Controller;
use App\Http\Controllers\Form7Controller;
use App\Http\Controllers\Form8Controller;
use App\Http\Controllers\Form9Controller;
use App\Http\Controllers\Form10Controller;
use App\Http\Controllers\Form11Controller;
use App\Http\Controllers\Form12Controller;
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

    // User Management - Admin or Super Admin
    Route::middleware(['role:admin,super-admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
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
    Route::get('list', [KerusakanController::class, 'list'])->name('list'); // New list view
    Route::get('detail/{id}', [KerusakanController::class, 'detail'])->name('detail'); // New detail view
    Route::get('index', [KerusakanController::class, 'index'])->name('index'); // Original index view
    Route::get('create/{id}', [KerusakanController::class, 'create'])->name('create');
    Route::post('store/{id}', [KerusakanController::class, 'store'])->name('store');
    Route::get('show/{id}', [KerusakanController::class, 'show'])->name('show');
    Route::get('edit/{id}', [KerusakanController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [KerusakanController::class, 'update'])->name('update');
});
Route::prefix('/kerugian')->middleware(['auth', 'verified', 'admin'])->name('kerugian.')->group(function () {
    Route::get('list', [KerugianController::class, 'list'])->name('list'); // New list view
    Route::get('detail/{id}', [KerugianController::class, 'detail'])->name('detail'); // New detail view
    Route::get('index', [KerugianController::class, 'index'])->name('index'); // Original index view
    Route::get('create/{id}', [KerugianController::class, 'create'])->name('create');
    Route::post('store/{id}', [KerugianController::class, 'store'])->name('store');
    Route::get('show/{id}', [KerugianController::class, 'show'])->name('show');
    Route::get('edit/{id}', [KerugianController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [KerugianController::class, 'update'])->name('update');
});
Route::prefix('/kebutuhan')->middleware(['auth', 'verified'])->name('kebutuhan.')->group(function () {
    Route::get('list', [KebutuhanController::class, 'listTables'])->name('list');
    Route::get('', [KebutuhanController::class, 'index'])->name('index'); // Shows list of disasters
    Route::get('create/{id}', [KebutuhanController::class, 'create'])->name('create');
    Route::post('store/{id}', [KebutuhanController::class, 'store'])->name('store');
    Route::get('show/{id}', [KebutuhanController::class, 'show'])->name('show'); // Shows damage & loss data for specific disaster
    Route::get('edit/{id}', [KebutuhanController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [KebutuhanController::class, 'update'])->name('update');
    Route::get('detail-bencana/{id}', [KebutuhanController::class, 'showDetailBencana'])->name('detail-bencana');
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

    // Form 1 (Surat Permohonan Keterlibatan PDNA)
    Route::prefix('form1')->name('form1.')->group(function () {
        Route::get('/', [Form1Controller::class, 'index'])->name('index');
        Route::post('/store', [Form1Controller::class, 'store'])->name('store');
        Route::get('/show/{id}', [Form1Controller::class, 'show'])->name('show');
        Route::get('/edit/{id}', [Form1Controller::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [Form1Controller::class, 'update'])->name('update');
        Route::get('/list-form1', [Form1Controller::class, 'listForm1'])->name('list-form1');
        Route::get('/pdf/{id}', [Form1Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form1Controller::class, 'previewPdf'])->name('preview-pdf');
    });

    // Form 2 (Surat Keputusan Pembentukan Tim Kerja Pengkajian Kebutuhan Pascabencana)
    Route::prefix('form2')->name('form2.')->group(function () {
        Route::get('/', [Form2Controller::class, 'index'])->name('index');
        Route::post('/store', [Form2Controller::class, 'store'])->name('store');
        Route::get('/show/{id}', [Form2Controller::class, 'show'])->name('show');
        Route::get('/edit/{id}', [Form2Controller::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [Form2Controller::class, 'update'])->name('update');
        Route::get('/list', [Form2Controller::class, 'listForm2'])->name('list');
        Route::get('/pdf/{id}', [Form2Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form2Controller::class, 'previewPdf'])->name('preview-pdf');
    });

    // Form 3 (Pendataan ke OPD)
    Route::prefix('form3')->name('form3.')->group(function () {
        Route::get('/', [Form3Controller::class, 'index'])->name('index');
        Route::post('/store', [Form3Controller::class, 'store'])->name('store');
        Route::get('/show/{id}', [Form3Controller::class, 'show'])->name('show');
        Route::get('/edit/{id}', [Form3Controller::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [Form3Controller::class, 'update'])->name('update');
        Route::get('/list', [Form3Controller::class, 'list'])->name('list');
        Route::get('/pdf/{id}', [Form3Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form3Controller::class, 'previewPdf'])->name('preview-pdf');
    });

    // Form 4 (Sektor Perumahan)
    Route::prefix('form4')->name('form4.')->group(function () {
        Route::get('/', [Form4Controller::class, 'index'])->name('index');
        Route::get('/perumahan', [Form4Controller::class, 'perumahan'])->name('perumahan');
        Route::get('/format1form4', [Form4Controller::class, 'format1form4'])->name('format1form4');
        Route::get('/format2form4', [Form4Controller::class, 'format2form4'])->name('format2form4');
        Route::get('/format3form4', [Form4Controller::class, 'format3form4'])->name('format3form4');
        Route::get('/format4form4', [Form4Controller::class, 'format4form4'])->name('format4form4');
        Route::get('/format5form4', [Form4Controller::class, 'format5form4'])->name('format5form4');
        Route::get('/format6form4', [Form4Controller::class, 'format6form4'])->name('format6form4');
        Route::get('/format7form4', [Form4Controller::class, 'format7form4'])->name('format7form4');
        Route::get('/format8form4', [Form4Controller::class, 'format8form4'])->name('format8form4');
        Route::get('/format9form4', [Form4Controller::class, 'format9form4'])->name('format9form4');
        Route::get('/format10form4', [Form4Controller::class, 'format10form4'])->name('format10form4');
        Route::get('/format11form4', [Form4Controller::class, 'format11form4'])->name('format11form4');
        Route::get('/format12form4', [Form4Controller::class, 'format12form4'])->name('format12form4');
        Route::get('/format13form4', [Form4Controller::class, 'format13form4'])->name('format13form4');
        Route::get('/format14form4', [Form4Controller::class, 'format14form4'])->name('format14form4');
        Route::get('/format15form4', [Form4Controller::class, 'format15form4'])->name('format15form4');
        Route::get('/format16form4', [Form4Controller::class, 'format16form4'])->name('format16form4');
        Route::get('/format17form4', [Form4Controller::class, 'format17form4'])->name('format17form4');
        Route::post('/store', [Form4Controller::class, 'store'])->name('store');
        Route::post('/store-format2', [Form4Controller::class, 'storeFormat2'])->name('store-format2');
        Route::post('/store-format3', [Form4Controller::class, 'storeFormat3'])->name('store-format3');
        Route::post('/store-format4', [Form4Controller::class, 'storeFormat4'])->name('store-format4');
        Route::post('/store-format5', [Form4Controller::class, 'storeFormat5'])->name('store-format5');
        Route::post('/store-format6', [Form4Controller::class, 'storeFormat6'])->name('store-format6');
        Route::post('/store-format7', [Form4Controller::class, 'storeFormat7'])->name('store-format7');
        Route::post('/store-format8', [Form4Controller::class, 'storeFormat8'])->name('store-format8');
        Route::post('/store-format9', [Form4Controller::class, 'storeFormat9'])->name('store-format9');
        Route::post('/store-format10', [Form4Controller::class, 'storeFormat10'])->name('store-format10');
        Route::post('/store-format11', [Form4Controller::class, 'storeFormat11'])->name('store-format11');
        Route::post('/store-format12', [Form4Controller::class, 'storeFormat12'])->name('store-format12');
        Route::post('/store-format13', [Form4Controller::class, 'storeFormat13'])->name('store-format13');
        Route::post('/store-format14', [Form4Controller::class, 'storeFormat14'])->name('store-format14');
        Route::post('/store-format15', [Form4Controller::class, 'storeFormat15'])->name('store-format15');
        Route::post('/store-format16', [Form4Controller::class, 'storeFormat16'])->name('store-format16');
        Route::post('/store-format17', [Form4Controller::class, 'storeFormat17'])->name('store-format17');
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
        
        // Show routes for formats 11-15
        Route::get('/show-format11/{id}', [Form4Controller::class, 'showFormat11'])->name('show-format11');
        Route::get('/show-format12/{id}', [Form4Controller::class, 'showFormat12'])->name('show-format12');
        Route::get('/show-format13/{id}', [Form4Controller::class, 'showFormat13'])->name('show-format13');
        Route::get('/show-format14/{id}', [Form4Controller::class, 'showFormat14'])->name('show-format14');
        Route::get('/show-format15/{id}', [Form4Controller::class, 'showFormat15'])->name('show-format15');
        Route::get('/pdf/{id}', [Form4Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form4Controller::class, 'previewPdf'])->name('preview-pdf');
        Route::get('/format17-pdf/{bencana_id}', [Form4Controller::class, 'generateFormat17Pdf'])->name('format17-pdf');
        Route::get('/format17-preview-pdf/{bencana_id}', [Form4Controller::class, 'previewFormat17Pdf'])->name('format17-preview-pdf');
        Route::get('/format16-pdf/{bencana_id}', [Form4Controller::class, 'generateFormat16Pdf'])->name('format16-pdf');
        Route::get('/format16-preview-pdf/{bencana_id}', [Form4Controller::class, 'previewFormat16Pdf'])->name('format16-preview-pdf');
        Route::get('/list', [Form4Controller::class, 'listFormat1'])->name('list');
        Route::get('/list-format1', [Form4Controller::class, 'listFormat1'])->name('list-format1');

        // Format 11-15 list routes
        Route::get('/list-format11', [Form4Controller::class, 'listFormat11'])->name('list-format11');
        Route::get('/list-format12', [Form4Controller::class, 'listFormat12'])->name('list-format12');
        Route::get('/list-format13', [Form4Controller::class, 'listFormat13'])->name('list-format13');
        Route::get('/list-format14', [Form4Controller::class, 'listFormat14'])->name('list-format14');
        Route::get('/list-format15', [Form4Controller::class, 'listFormat15'])->name('list-format15');
        
        // Additional show and list routes for formats 4, 5, 8, 9, 10
        Route::get('/show-format4/{id}', [Form4Controller::class, 'showFormat4'])->name('show-format4');
        Route::get('/show-format5/{id}', [Form4Controller::class, 'showFormat5'])->name('show-format5');
        Route::get('/show-format8/{id}', [Form4Controller::class, 'showFormat8'])->name('show-format8');
        Route::get('/show-format9/{id}', [Form4Controller::class, 'showFormat9'])->name('show-format9');
        Route::get('/show-format10/{id}', [Form4Controller::class, 'showFormat10'])->name('show-format10');
        
        Route::get('/list-format4', [Form4Controller::class, 'listFormat4'])->name('list-format4');
        Route::get('/list-format5', [Form4Controller::class, 'listFormat5'])->name('list-format5');
        Route::get('/list-format8', [Form4Controller::class, 'listFormat8'])->name('list-format8');
        Route::get('/list-format9', [Form4Controller::class, 'listFormat9'])->name('list-format9');
        Route::get('/list-format10', [Form4Controller::class, 'listFormat10'])->name('list-format10');
        
        // Show and list routes for format 6
        Route::get('/show-format6/{id}', [Form4Controller::class, 'showFormat6'])->name('show-format6');
        Route::get('/list-format6', [Form4Controller::class, 'listFormat6'])->name('list-format6');
    });

    // Form 6 (Formulir 06 - Pendataan Tingkat Rumahtangga)
    Route::prefix('form6')->name('form6.')->group(function () {
        Route::get('/', [Form6Controller::class, 'index'])->name('index');
        Route::post('/store', [Form6Controller::class, 'store'])->name('store');
        Route::get('/show/{id}', [Form6Controller::class, 'show'])->name('show');
        Route::get('/edit/{id}', [Form6Controller::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [Form6Controller::class, 'update'])->name('update');
        Route::get('/list', [Form6Controller::class, 'listForm6'])->name('list');
        Route::get('/pdf/{id}', [Form6Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form6Controller::class, 'previewPdf'])->name('preview-pdf');
        Route::get('/get-rumahtangga/{id}', [Form6Controller::class, 'getRumahtangga'])->name('get-rumahtangga');
    });

    // Form 7 (Formulir 07 - Diskusi Kelompok Terfokus (FGD))
    Route::prefix('form7')->name('form7.')->group(function () {
        Route::get('/', [Form7Controller::class, 'index'])->name('index');
        Route::post('/store', [Form7Controller::class, 'store'])->name('store');
        Route::get('/show/{id}', [Form7Controller::class, 'show'])->name('show');
        Route::get('/edit/{id}', [Form7Controller::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [Form7Controller::class, 'update'])->name('update');
        Route::get('/list', [Form7Controller::class, 'listForm7'])->name('list');
        Route::get('/pdf/{id}', [Form7Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form7Controller::class, 'previewPdf'])->name('preview-pdf');
    });

    // Form 8 (Pengolahan dan Analisis Data Penilaian Kerusakan dan Kerugian)
    Route::prefix('form8')->name('form8.')->group(function () {
        Route::get('/', [Form8Controller::class, 'index'])->name('index');
        Route::post('/store', [Form8Controller::class, 'store'])->name('store');
        Route::get('/show/{id}', [Form8Controller::class, 'show'])->name('show');
        Route::get('/edit/{id}', [Form8Controller::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [Form8Controller::class, 'update'])->name('update');
        Route::get('/list-penilaian', [Form8Controller::class, 'listPenilaian'])->name('listPenilaian');
        Route::get('/pdf/{id}', [Form8Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form8Controller::class, 'previewPdf'])->name('preview-pdf');
    });

    // Form9 (Pengolahan Data dan Kuesioner)
    Route::prefix('form9')->name('form9.')->group(function () {
        Route::get('/', [Form9Controller::class, 'index'])->name('index');
        Route::post('/store', [Form9Controller::class, 'store'])->name('store');
        Route::get('/list', [Form9Controller::class, 'list'])->name('list');
        Route::get('/show/{id}', [Form9Controller::class, 'show'])->name('show');
        Route::get('/edit/{id}', [Form9Controller::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [Form9Controller::class, 'update'])->name('update');
        Route::get('/pdf/{id}', [Form9Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form9Controller::class, 'previewPdf'])->name('preview-pdf');
    });
    
    // Form10 (Analisa Data Akibat terhadap Akses, Fungsi, dan Resiko)
    Route::prefix('form10')->name('form10.')->group(function () {
        Route::get('/', [Form10Controller::class, 'index'])->name('index');
        Route::post('/store', [Form10Controller::class, 'store'])->name('store');
        Route::get('/list', [Form10Controller::class, 'listForm10'])->name('list');
        Route::get('/show/{id}', [Form10Controller::class, 'show'])->name('show');
        Route::get('/edit/{id}', [Form10Controller::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [Form10Controller::class, 'update'])->name('update');
        Route::get('/pdf/{id}', [Form10Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form10Controller::class, 'previewPdf'])->name('preview-pdf');
    });
    
    // Form11 (Rekapitulasi Kebutuhan Pascabencana)
    Route::prefix('form11')->name('form11.')->group(function () {
        Route::get('/', [Form11Controller::class, 'index'])->name('index');
        Route::post('/store', [Form11Controller::class, 'store'])->name('store');
        Route::get('/list', [Form11Controller::class, 'list'])->name('list');
        Route::get('/show/{id}', [Form11Controller::class, 'show'])->name('show');
        Route::get('/edit/{id}', [Form11Controller::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [Form11Controller::class, 'update'])->name('update');
        Route::get('/pdf/{id}', [Form11Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form11Controller::class, 'previewPdf'])->name('previewPdf');
    });
    
    // Form12 (Standar Penyusunan Kegiatan dan Anggaran untuk PKPB)
    Route::prefix('form12')->name('form12.')->group(function () {
        // Main Anggaran Routes
        Route::get('/', [Form12Controller::class, 'index'])->name('index');
        Route::post('/store', [Form12Controller::class, 'store'])->name('store');
        Route::get('/list', [Form12Controller::class, 'list'])->name('list');
        Route::get('/show/{id}', [Form12Controller::class, 'show'])->name('show');
        Route::get('/edit/{id}', [Form12Controller::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [Form12Controller::class, 'update'])->name('update');
        Route::get('/pdf/{id}', [Form12Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Form12Controller::class, 'previewPdf'])->name('previewPdf');
        
        // Indeks Biaya Routes
        Route::get('/indeks', [Form12Controller::class, 'indexIndeks'])->name('indeks');
        Route::post('/store-indeks', [Form12Controller::class, 'storeIndeks'])->name('store-indeks');
        Route::get('/edit-indeks/{id}', [Form12Controller::class, 'editIndeks'])->name('edit-indeks');
        Route::patch('/update-indeks/{id}', [Form12Controller::class, 'updateIndeks'])->name('update-indeks');
        Route::delete('/delete-indeks/{id}', [Form12Controller::class, 'deleteIndeks'])->name('delete-indeks');
    });
});

require __DIR__ . '/auth.php';