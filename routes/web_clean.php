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
use App\Http\Controllers\Form4\Format1Controller;
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
    Route::get('list', [KerusakanController::class, 'list'])->name('list');
    Route::get('detail/{id}', [KerusakanController::class, 'detail'])->name('detail');
    Route::get('index', [KerusakanController::class, 'index'])->name('index');
    Route::get('create/{id}', [KerusakanController::class, 'create'])->name('create');
    Route::post('store/{id}', [KerusakanController::class, 'store'])->name('store');
    Route::get('show/{id}', [KerusakanController::class, 'show'])->name('show');
    Route::get('edit/{id}', [KerusakanController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [KerusakanController::class, 'update'])->name('update');
});

Route::prefix('/kerugian')->middleware(['auth', 'verified', 'admin'])->name('kerugian.')->group(function () {
    Route::get('list', [KerugianController::class, 'list'])->name('list');
    Route::get('detail/{id}', [KerugianController::class, 'detail'])->name('detail');
    Route::get('index', [KerugianController::class, 'index'])->name('index');
    Route::get('create/{id}', [KerugianController::class, 'create'])->name('create');
    Route::post('store/{id}', [KerugianController::class, 'store'])->name('store');
    Route::get('show/{id}', [KerugianController::class, 'show'])->name('show');
    Route::get('edit/{id}', [KerugianController::class, 'edit'])->name('edit');
    Route::patch('update/{id}', [KerugianController::class, 'update'])->name('update');
});

Route::prefix('/kebutuhan')->middleware(['auth', 'verified'])->name('kebutuhan.')->group(function () {
    Route::get('list', [KebutuhanController::class, 'listTables'])->name('list');
    Route::get('', [KebutuhanController::class, 'index'])->name('index');
    Route::get('create/{id}', [KebutuhanController::class, 'create'])->name('create');
    Route::post('store/{id}', [KebutuhanController::class, 'store'])->name('store');
    Route::get('show/{id}', [KebutuhanController::class, 'show'])->name('show');
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
    $namaList = $namaList->map(function ($item) {
        $item->harga = 'Rp ' . number_format($item->harga, 2, ',', '.');
        return $item;
    });
    return response()->json($namaList);
})->middleware(['auth', 'verified']);

// Forms Routes
Route::prefix('/forms')->middleware(['auth', 'verified'])->name('forms.')->group(function () {
    Route::get('/', [FormsController::class, 'index'])->name('index');
    Route::get('form-list', [FormsController::class, 'index'])->name('form-list');

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
        Route::post('/store', [Format1Controller::class, 'store'])->name('store');
        Route::get('/pdf/{id}', [Format1Controller::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [Format1Controller::class, 'previewPdf'])->name('preview-pdf');
        Route::get('/show-format1/{id}', [Format1Controller::class, 'show'])->name('show-format1');
        Route::get('/list-format1', [Format1Controller::class, 'list'])->name('list-format1');
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
