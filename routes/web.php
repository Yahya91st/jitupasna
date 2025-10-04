<?php

use App\Http\Controllers\UserController;
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
use App\Http\Controllers\Form4\Format2Controller;
use App\Http\Controllers\Form4\Format3Controller;
use App\Http\Controllers\Form4\Format4Controller;
use App\Http\Controllers\Form4\Format5Controller;
use App\Http\Controllers\Form4\Format6Controller;
use App\Http\Controllers\Form4\Format7Controller;
use App\Http\Controllers\Form4\Format8Controller;
use App\Http\Controllers\Form4\Format9Controller;
use App\Http\Controllers\Form4\Format10Controller;
use App\Http\Controllers\Form4\Format11Controller;
use App\Http\Controllers\Form4\Format12Controller;
use App\Http\Controllers\Form4\Format13Controller;
use App\Http\Controllers\Form4\Format14Controller;
use App\Http\Controllers\Form4\Format15Controller;
use App\Http\Controllers\Form4\Format16Controller;
use App\Http\Controllers\Form4\Format17Controller;
// NOTE: Format1Controller sampai Format17Controller sudah dibuat
use App\Http\Controllers\RekapController;
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
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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

Route::prefix('/bencana')
    ->middleware(['auth', 'verified'])
    ->name('bencana.')
    ->group(function () {
        Route::get('list', [BencanaController::class, 'index'])->name('index');

        // Admin-only routes
        Route::middleware(['auth', 'verified'])->group(function () {
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

Route::get('/bencana/get-desa/{kecamatan_id}', [BencanaController::class, 'getDesaByKecamatan'])
    ->middleware(['auth', 'verified']);

Route::prefix('/kerusakan')
    ->middleware(['auth', 'verified'])
    ->name('kerusakan.')
    ->group(function () {
        Route::get('list', [KerusakanController::class, 'list'])->name('list'); // New list view
        Route::get('detail/{id}', [KerusakanController::class, 'detail'])->name('detail'); // New detail view
        Route::get('index', [KerusakanController::class, 'index'])->name('index'); // Original index view
        Route::get('create/{id}', [KerusakanController::class, 'create'])->name('create');
        Route::post('store/{id}', [KerusakanController::class, 'store'])->name('store');
        Route::get('show/{id}', [KerusakanController::class, 'show'])->name('show');
        Route::get('edit/{id}', [KerusakanController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [KerusakanController::class, 'update'])->name('update');
    });

Route::prefix('/kerugian')
    ->middleware(['auth', 'verified'])
    ->name('kerugian.')
    ->group(function () {
        Route::get('list', [KerugianController::class, 'list'])->name('list'); // New list view
        Route::get('detail/{id}', [KerugianController::class, 'detail'])->name('detail'); // New detail view
        Route::get('index', [KerugianController::class, 'index'])->name('index'); // Original index view
        Route::get('create/{id}', [KerugianController::class, 'create'])->name('create');
        Route::post('store/{id}', [KerugianController::class, 'store'])->name('store');
        Route::get('show/{id}', [KerugianController::class, 'show'])->name('show');
        Route::get('edit/{id}', [KerugianController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [KerugianController::class, 'update'])->name('update');
    });

Route::prefix('/kebutuhan')
    ->middleware(['auth', 'verified'])
    ->name('kebutuhan.')
    ->group(function () {
        Route::get('list', [KebutuhanController::class, 'listTables'])->name('list');
        Route::get('', [KebutuhanController::class, 'index'])->name('index'); // Shows list of disasters
        Route::get('create/{id}', [KebutuhanController::class, 'create'])->name('create');
        Route::post('store/{id}', [KebutuhanController::class, 'store'])->name('store');
        Route::get('show/{id}', [KebutuhanController::class, 'show'])->name('show'); // Shows damage & loss data for specific disaster
        Route::get('edit/{id}', [KebutuhanController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [KebutuhanController::class, 'update'])->name('update');
        Route::get('detail-bencana/{id}', [KebutuhanController::class, 'showDetailBencana'])->name('detail-bencana');
    });

Route::prefix('/kategori-bangunan')
    ->middleware(['auth', 'verified'])
    ->name('kategori-bangunan.')
    ->group(function () {
        Route::get('/', [KategoriBangunanController::class, 'index'])->name('index');
        Route::get('list', [KategoriBangunanController::class, 'index'])->name('list'); // Alternative route
        Route::post('store', [KategoriBangunanController::class, 'store'])->name('store');
        Route::patch('update/{id}', [KategoriBangunanController::class, 'update'])->name('update');
    });

Route::prefix('/kategori-bencana')
    ->middleware(['auth', 'verified'])
    ->name('kategori-bencana.')
    ->group(function () {
        Route::get('list', [KategoriBencanaController::class, 'index'])->name('index');
        Route::post('store', [KategoriBencanaController::class, 'store'])->name('store');
        Route::patch('update/{id}', [KategoriBencanaController::class, 'update'])->name('update');
    });

Route::prefix('/satuan')
    ->middleware(['auth', 'verified'])
    ->name('satuan.')
    ->group(function () {
        Route::get('list', [SatuanController::class, 'index'])->name('index');
        Route::post('store', [SatuanController::class, 'store'])->name('store');
        Route::patch('update/{id}', [SatuanController::class, 'update'])->name('update');
    });

Route::prefix('/hsd')
    ->middleware(['auth', 'verified'])
    ->name('hsd.')
    ->group(function () {
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
Route::prefix('/forms')
    ->middleware(['auth', 'verified'])
    ->name('forms.')
    ->group(function () {
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
            Route::delete('/destroy/{id}', [Form3Controller::class, 'destroy'])->name('destroy');
            Route::get('/list', [Form3Controller::class, 'list'])->name('list');
            Route::get('/pdf/{id}', [Form3Controller::class, 'generatePdf'])->name('pdf');
            Route::get('/preview-pdf/{id}', [Form3Controller::class, 'previewPdf'])->name('preview-pdf');
        });

        // Form 4 (All Sectors)
        Route::prefix('form4')->name('form4.')->group(function () {
            Route::get('/', [Form4Controller::class, 'index'])->name('index');

            // Format 1 - Housing sector
            Route::prefix('format1')->name('format1.')->group(function () {
                Route::get('/', [Format1Controller::class, 'index'])->name('index');
                Route::post('/store', [Format1Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format1Controller::class, 'show'])->name('show');
                Route::get('/list', [Format1Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format1Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format1Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format1Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format1Controller::class, 'update'])->name('update');
                Route::get('/pdf/{id}', [Format1Controller::class, 'generatePdf'])->name('generatePdf-format1');
            });

            // Format 2 - Education sector
            Route::prefix('format2')->name('format2.')->group(function () {
                Route::get('/', [Format2Controller::class, 'index'])->name('index');
                Route::post('/store', [Format2Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format2Controller::class, 'show'])->name('show');
                Route::get('/list', [Format2Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format2Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format2Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format2Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format2Controller::class, 'update'])->name('update');
            });

            // Format 3 - Health sector (IMPLEMENTED)
            Route::prefix('format3')->name('format3.')->group(function () {
                Route::get('/', [Format3Controller::class, 'index'])->name('index');
                Route::post('/store', [Format3Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format3Controller::class, 'show'])->name('show');
                Route::get('/list', [Format3Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format3Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format3Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format3Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format3Controller::class, 'update'])->name('update');
                Route::get('/pdf/{id}', [Format3Controller::class, 'generatePdf'])->name('generatePdf-format3');
                Route::delete('/destroy/{id}', [Format3Controller::class, 'destroy'])->name('destroy');
            });

            // Format 4 - Social Protection sector (IMPLEMENTED)
            Route::prefix('format4')->name('format4.')->group(function () {
                Route::get('/', [Format4Controller::class, 'index'])->name('index');
                Route::post('/store', [Format4Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format4Controller::class, 'show'])->name('show');
                Route::get('/list', [Format4Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format4Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format4Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format4Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format4Controller::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [Format4Controller::class, 'destroy'])->name('destroy');

            });

            // Format 5 - Religious sector (IMPLEMENTED)
            Route::prefix('format5')->name('format5.')->group(function () {
                Route::get('/', [Format5Controller::class, 'index'])->name('index');
                Route::post('/store', [Format5Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format5Controller::class, 'show'])->name('show');
                Route::get('/list', [Format5Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format5Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format5Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format5Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format5Controller::class, 'update'])->name('update');
            });

            // Format 6 - Clean Water and Sanitation sector (IMPLEMENTED)
            Route::prefix('format6')->name('format6.')->group(function () {
                Route::get('/', [Format6Controller::class, 'index'])->name('index');
                Route::post('/store', [Format6Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format6Controller::class, 'show'])->name('show');
                Route::get('/list', [Format6Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format6Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format6Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format6Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format6Controller::class, 'update'])->name('update');
            });

            // Format 7 - Transportation sector (IMPLEMENTED)
            Route::prefix('format7')->name('format7.')->group(function () {
                Route::get('/', [Format7Controller::class, 'index'])->name('index');
                Route::post('/store', [Format7Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format7Controller::class, 'show'])->name('show');
                Route::get('/list', [Format7Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format7Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format7Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format7Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format7Controller::class, 'update'])->name('update');
            });

            // Format 8 - Electricity sector (IMPLEMENTED)
            Route::prefix('format8')->name('format8.')->group(function () {
                Route::get('/', [Format8Controller::class, 'index'])->name('index');
                Route::post('/store', [Format8Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format8Controller::class, 'show'])->name('show');
                Route::get('/list', [Format8Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format8Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format8Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format8Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format8Controller::class, 'update'])->name('update');
            });

            // Format 9 - Telecommunications sector (IMPLEMENTED)
            Route::prefix('format9')->name('format9.')->group(function () {
                Route::get('/', [Format9Controller::class, 'index'])->name('index');
                Route::post('/store', [Format9Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format9Controller::class, 'show'])->name('show');
                Route::get('/list', [Format9Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format9Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format9Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format9Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format9Controller::class, 'update'])->name('update');
            });

            // Format 10 - Agriculture sector (IMPLEMENTED)
            Route::prefix('format10')->name('format10.')->group(function () {
                Route::get('/', [Format10Controller::class, 'index'])->name('index');
                Route::post('/store', [Format10Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format10Controller::class, 'show'])->name('show');
                Route::get('/list', [Format10Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format10Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format10Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format10Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format10Controller::class, 'update'])->name('update');
            });

            // Format 11 - Livestock sector (IMPLEMENTED)
            Route::prefix('format11')->name('format11.')->group(function () {
                Route::get('/', [Format11Controller::class, 'index'])->name('index');
                Route::post('/store', [Format11Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format11Controller::class, 'show'])->name('show');
                Route::get('/list', [Format11Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format11Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format11Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format11Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format11Controller::class, 'update'])->name('update');
            });

            // Format 12 - Fishery sector (IMPLEMENTED)
            Route::prefix('format12')->name('format12.')->group(function () {
                Route::get('/', [Format12Controller::class, 'index'])->name('index');
                Route::post('/store', [Format12Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format12Controller::class, 'show'])->name('show');
                Route::get('/list', [Format12Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format12Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format12Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format12Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format12Controller::class, 'update'])->name('update');
            });

            // Format 13 - Industry sector (IMPLEMENTED)
            Route::prefix('format13')->name('format13.')->group(function () {
                Route::get('/', [Format13Controller::class, 'index'])->name('index');
                Route::post('/store', [Format13Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format13Controller::class, 'show'])->name('show');
                Route::get('/list', [Format13Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format13Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format13Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format13Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format13Controller::class, 'update'])->name('update');
            });

            // Format 14 - Commerce sector (IMPLEMENTED)
            Route::prefix('format14')->name('format14.')->group(function () {
                Route::get('/', [Format14Controller::class, 'index'])->name('index');
                Route::post('/store', [Format14Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format14Controller::class, 'show'])->name('show');
                Route::get('/list', [Format14Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format14Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format14Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format14Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format14Controller::class, 'update'])->name('update');
            });

            // Format 15 - Tourism sector (IMPLEMENTED)
            Route::prefix('format15')->name('format15.')->group(function () {
                Route::get('/', [Format15Controller::class, 'index'])->name('index');
                Route::post('/store', [Format15Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format15Controller::class, 'show'])->name('show');
                Route::get('/list', [Format15Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format15Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format15Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format15Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format15Controller::class, 'update'])->name('update');
            });

            // Format 16 - Government sector (IMPLEMENTED)
            Route::prefix('format16')->name('format16.')->group(function () {
                Route::get('/', [Format16Controller::class, 'index'])->name('index');
                Route::post('/store', [Format16Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format16Controller::class, 'show'])->name('show');
                Route::get('/list', [Format16Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format16Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id}', [Format16Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format16Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format16Controller::class, 'update'])->name('update');
            });

            // Format 17 - Environment sector (IMPLEMENTED)
            Route::prefix('format17')->name('format17.')->group(function () {
                Route::get('/', [Format17Controller::class, 'index'])->name('index');
                Route::post('/store', [Format17Controller::class, 'store'])->name('store');
                Route::get('/show/{id}', [Format17Controller::class, 'show'])->name('show');
                Route::get('/list', [Format17Controller::class, 'list'])->name('list');
                Route::get('/pdf/{id}', [Format17Controller::class, 'generatePdf'])->name('pdf');
                Route::get('/preview-pdf/{id]', [Format17Controller::class, 'previewPdf'])->name('preview-pdf');
                Route::get('/edit/{id}', [Format17Controller::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [Format17Controller::class, 'update'])->name('update');
            });

            // Legacy routes for backwards compatibility
            Route::get('/format1form4', [Format1Controller::class, 'index'])->name('format1form4');
            Route::get('/format2form4', [Format2Controller::class, 'index'])->name('format2form4');
            Route::get('/format3form4', [Format3Controller::class, 'index'])->name('format3form4');
            Route::get('/format4form4', [Format4Controller::class, 'index'])->name('format4form4');
            Route::get('/format4form4-alt', [Format4Controller::class, 'index'])->name('format4form4-alt');
            Route::get('/format5form4', [Format5Controller::class, 'index'])->name('format5form4');
            Route::get('/format6form4', [Format6Controller::class, 'index'])->name('format6form4');
            Route::get('/format7form4', [Format7Controller::class, 'index'])->name('format7form4');
            Route::get('/format8form4', [Format8Controller::class, 'index'])->name('format8form4');
            Route::get('/format9form4', [Format9Controller::class, 'index'])->name('format9form4');
            Route::get('/format10form4', [Format10Controller::class, 'index'])->name('format10form4');
            Route::get('/format11form4', [Format11Controller::class, 'index'])->name('format11form4');
            Route::get('/format12form4', [Format12Controller::class, 'index'])->name('format12form4');
            Route::get('/format13form4', [Format13Controller::class, 'index'])->name('format13form4');
            Route::get('/format14form4', [Format14Controller::class, 'index'])->name('format14form4');
            Route::get('/format15form4', [Format15Controller::class, 'index'])->name('format15form4');
            Route::get('/format16form4', [Format16Controller::class, 'index'])->name('format16form4');
            Route::get('/format17form4', [Format17Controller::class, 'index'])->name('format17form4');

            // Legacy store routes for backwards compatibility
            Route::post('/store', [Format1Controller::class, 'store'])->name('store');
            Route::post('/store-format2', [Format2Controller::class, 'store'])->name('store-format2');
            Route::post('/store-format3', [Format3Controller::class, 'store'])->name('store-format3');
            Route::post('/store-format4', [Format4Controller::class, 'store'])->name('store-format4');
            Route::post('/store-format5', [Format5Controller::class, 'store'])->name('store-format5');
            Route::post('/store-format6', [Format6Controller::class, 'store'])->name('store-format6');
            Route::post('/store-format7', [Format7Controller::class, 'store'])->name('store-format7');
            Route::post('/store-format8', [Format8Controller::class, 'store'])->name('store-format8');
            Route::post('/store-format9', [Format9Controller::class, 'store'])->name('store-format9');
            Route::post('/store-format10', [Format10Controller::class, 'store'])->name('store-format10');
            Route::post('/store-format11', [Format11Controller::class, 'store'])->name('store-format11');
            Route::post('/store-format12', [Format12Controller::class, 'store'])->name('store-format12');
            Route::post('/store-format13', [Format13Controller::class, 'store'])->name('store-format13');
            Route::post('/store-format14', [Format14Controller::class, 'store'])->name('store-format14');
            Route::post('/store-format15', [Format15Controller::class, 'store'])->name('store-format15');
            Route::post('/store-format16', [Format16Controller::class, 'store'])->name('store-format16');
            Route::post('/store-format17', [Format17Controller::class, 'store'])->name('store-format17');

            // Legacy show routes for backwards compatibility
            Route::get('/show-format1/{id}', [Format1Controller::class, 'show'])->name('show-format1');
            Route::get('/show-format2/{id}', [Format2Controller::class, 'show'])->name('show-format2');
            Route::get('/show-format3/{id}', [Format3Controller::class, 'show'])->name('show-format3');
            Route::get('/show-format4/{id}', [Format4Controller::class, 'show'])->name('show-format4');
            Route::get('/show-format5/{id}', [Format5Controller::class, 'show'])->name('show-format5');
            Route::get('/show-format6/{id}', [Format6Controller::class, 'show'])->name('show-format6');
            Route::get('/show-format7/{id}', [Format7Controller::class, 'show'])->name('show-format7');
            Route::get('/show-format8/{id}', [Format8Controller::class, 'show'])->name('show-format8');
            Route::get('/show-format9/{id}', [Format9Controller::class, 'show'])->name('show-format9');
            Route::get('/show-format10/{id}', [Format10Controller::class, 'show'])->name('show-format10');
            Route::get('/show-format11/{id}', [Format11Controller::class, 'show'])->name('show-format11');
            Route::get('/show-format12/{id}', [Format12Controller::class, 'show'])->name('show-format12');
            Route::get('/show-format13/{id}', [Format13Controller::class, 'show'])->name('show-format13');
            Route::get('/show-format14/{id}', [Format14Controller::class, 'show'])->name('show-format14');
            Route::get('/show-format15/{id}', [Format15Controller::class, 'show'])->name('show-format15');
            Route::get('/show-format16/{id}', [Format16Controller::class, 'show'])->name('show-format16');
            Route::get('/show-format17/{id}', [Format17Controller::class, 'show'])->name('show-format17');

            // Legacy list routes for backwards compatibility
            Route::get('/list-format1', [Format1Controller::class, 'list'])->name('list-format1');
            Route::get('/list-format2', [Format2Controller::class, 'list'])->name('list-format2');
            Route::get('/list-format3', [Format3Controller::class, 'list'])->name('list-format3');
            Route::get('/list-format4', [Format4Controller::class, 'list'])->name('list-format4');
            Route::get('/list-format5', [Format5Controller::class, 'list'])->name('list-format5');
            Route::get('/list-format6', [Format6Controller::class, 'list'])->name('list-format6');
            Route::get('/list-format7', [Format7Controller::class, 'list'])->name('list-format7');
            Route::get('/list-format8', [Format8Controller::class, 'list'])->name('list-format8');
            Route::get('/list-format9', [Format9Controller::class, 'list'])->name('list-format9');
            Route::get('/list-format10', [Format10Controller::class, 'list'])->name('list-format10');
            Route::get('/list-format11', [Format11Controller::class, 'list'])->name('list-format11');
            Route::get('/list-format12', [Format12Controller::class, 'list'])->name('list-format12');
            Route::get('/list-format13', [Format13Controller::class, 'list'])->name('list-format13');
            Route::get('/list-format14', [Format14Controller::class, 'list'])->name('list-format14');
            Route::get('/list-format15', [Format15Controller::class, 'list'])->name('list-format15');
            Route::get('/list-format16', [Format16Controller::class, 'list'])->name('list-format16');
            Route::get('/list-format17', [Format17Controller::class, 'list'])->name('list-format17');

            // Legacy delete routes for backwards compatibility
            Route::delete('/destroy-format1/{id}', [Format1Controller::class, 'destroy'])->name('destroy-format1');
            Route::delete('/destroy-format2/{id}', [Format2Controller::class, 'destroy'])->name('destroy-format2');
            Route::delete('/destroy-format3/{id}', [Format3Controller::class, 'destroy'])->name('destroy-format3');
            Route::delete('/destroy-format4/{id}', [Format4Controller::class, 'destroy'])->name('destroy-format4');
            Route::delete('/destroy-format5/{id}', [Format5Controller::class, 'destroy'])->name('destroy-format5');
            Route::delete('/destroy-format6/{id}', [Format6Controller::class, 'destroy'])->name('destroy-format6');
            Route::delete('/destroy-format7/{id}', [Format7Controller::class, 'destroy'])->name('destroy-format7');
            Route::delete('/destroy-format8/{id}', [Format8Controller::class, 'destroy'])->name('destroy-format8');
            Route::delete('/destroy-format9/{id}', [Format9Controller::class, 'destroy'])->name('destroy-format9');
            Route::delete('/destroy-format10/{id}', [Format10Controller::class, 'destroy'])->name('destroy-format10');
            Route::delete('/destroy-format11/{id}', [Format11Controller::class, 'destroy'])->name('destroy-format11');
            Route::delete('/destroy-format12/{id}', [Format12Controller::class, 'destroy'])->name('destroy-format12');
            Route::delete('/destroy-format13/{id}', [Format13Controller::class, 'destroy'])->name('destroy-format13');
            Route::delete('/destroy-format14/{id}', [Format14Controller::class, 'destroy'])->name('destroy-format14');
            Route::delete('/destroy-format15/{id}', [Format15Controller::class, 'destroy'])->name('destroy-format15');
            Route::delete('/destroy-format16/{id}', [Format16Controller::class, 'destroy'])->name('destroy-format16');
            Route::delete('/destroy-format17/{id}', [Format17Controller::class, 'destroy'])->name('destroy-format17');

            // Edit routes for all formats
            Route::get('/edit-format1/{id}', [Format1Controller::class, 'edit'])->name('edit-format1');
            Route::put('/update-format1/{id}', [Format1Controller::class, 'update'])->name('update-format1');
            Route::get('/edit-format2/{id}', [Format2Controller::class, 'edit'])->name('edit-format2');
            Route::put('/update-format2/{id}', [Format2Controller::class, 'update'])->name('update-format2');
            Route::get('/edit-format3/{id}', [Format3Controller::class, 'edit'])->name('edit-format3');
            Route::put('/update-format3/{id}', [Format3Controller::class, 'update'])->name('update-format3');
            Route::get('/edit-format4/{id}', [Format4Controller::class, 'edit'])->name('edit-format4');
            Route::put('/update-format4/{id}', [Format4Controller::class, 'update'])->name('update-format4');
            Route::get('/edit-format5/{id}', [Format5Controller::class, 'edit'])->name('edit-format5');
            Route::put('/update-format5/{id}', [Format5Controller::class, 'update'])->name('update-format5');
            Route::get('/edit-format6/{id}', [Format6Controller::class, 'edit'])->name('edit-format6');
            Route::put('/update-format6/{id}', [Format6Controller::class, 'update'])->name('update-format6');
            Route::get('/edit-format7/{id}', [Format7Controller::class, 'edit'])->name('edit-format7');
            Route::put('/update-format7/{id}', [Format7Controller::class, 'update'])->name('update-format7');
            Route::get('/edit-format8/{id}', [Format8Controller::class, 'edit'])->name('edit-format8');
            Route::put('/update-format8/{id}', [Format8Controller::class, 'update'])->name('update-format8');
            Route::get('/edit-format9/{id}', [Format9Controller::class, 'edit'])->name('edit-format9');
            Route::put('/update-format9/{id}', [Format9Controller::class, 'update'])->name('update-format9');
            Route::get('/edit-format10/{id}', [Format10Controller::class, 'edit'])->name('edit-format10');
            Route::put('/update-format10/{id}', [Format10Controller::class, 'update'])->name('update-format10');
            Route::get('/edit-format11/{id}', [Format11Controller::class, 'edit'])->name('edit-format11');
            Route::put('/update-format11/{id}', [Format11Controller::class, 'update'])->name('update-format11');
            Route::get('/edit-format12/{id}', [Format12Controller::class, 'edit'])->name('edit-format12');
            Route::put('/update-format12/{id}', [Format12Controller::class, 'update'])->name('update-format12');
            Route::get('/edit-format13/{id}', [Format13Controller::class, 'edit'])->name('edit-format13');
            Route::put('/update-format13/{id}', [Format13Controller::class, 'update'])->name('update-format13');
            Route::get('/edit-format14/{id}', [Format14Controller::class, 'edit'])->name('edit-format14');
            Route::put('/update-format14/{id}', [Format14Controller::class, 'update'])->name('update-format14');
            Route::get('/edit-format15/{id}', [Format15Controller::class, 'edit'])->name('edit-format15');
            Route::put('/update-format15/{id}', [Format15Controller::class, 'update'])->name('update-format15');
            Route::get('/edit-format16/{id}', [Format16Controller::class, 'edit'])->name('edit-format16');
            Route::put('/update-format16/{id}', [Format16Controller::class, 'update'])->name('update-format16');
            Route::get('/edit-format17/{id}', [Format17Controller::class, 'edit'])->name('edit-format17');
            Route::put('/update-format17/{id}', [Format17Controller::class, 'update'])->name('update-format17');

            // Legacy PDF routes for general form4 (will redirect to Format1Controller)
            Route::get('/pdf/{id}', [Format1Controller::class, 'generatePdf'])->name('pdf');
            Route::get('/preview-pdf/{id}', [Format1Controller::class, 'previewPdf'])->name('preview-pdf');

            // Legacy Format 10 (Agriculture sector) PDF routes
            Route::get('/format10-pdf/{id}', [Format10Controller::class, 'generatePdf'])->name('format10-pdf');
            Route::get('/format10-preview-pdf/{id}', [Format10Controller::class, 'previewPdf'])->name('format10-preview-pdf');

            // Legacy Format 11 (Livestock sector) PDF routes
            Route::get('/format11-pdf/{id}', [Format11Controller::class, 'generatePdf'])->name('format11-pdf');
            Route::get('/format11-preview-pdf/{bencana_id}', [Form4Controller::class, 'previewFormat11Pdf'])->name('format11-preview-pdf');

            // Format 12 (Fishery sector) PDF routes
            Route::get('/format12-pdf/{bencana_id}', [Form4Controller::class, 'generateFormat12Pdf'])->name('format12-pdf');
            Route::get('/format12-preview-pdf/{bencana_id}', [Form4Controller::class, 'previewFormat12Pdf'])->name('format12-preview-pdf');

            // Format 13 (SME sector) PDF routes
            Route::get('/format13-pdf/{bencana_id}', [Form4Controller::class, 'generateFormat13Pdf'])->name('format13-pdf');
            Route::get('/format13-preview-pdf/{bencana_id}', [Form4Controller::class, 'previewFormat13Pdf'])->name('format13-preview-pdf');

            // Format 14 (Tourism sector) PDF routes
            Route::get('/format14-pdf/{bencana_id}', [Form4Controller::class, 'generateFormat14Pdf'])->name('format14-pdf');
            Route::get('/format14-preview-pdf/{bencana_id}', [Form4Controller::class, 'previewFormat14Pdf'])->name('format14-preview-pdf');

            // Format 15 (Industry sector) PDF routes
            Route::get('/format15-pdf/{bencana_id}', [Form4Controller::class, 'generateFormat15Pdf'])->name('format15-pdf');
            Route::get('/format15-preview-pdf/{bencana_id}', [Form4Controller::class, 'previewFormat15Pdf'])->name('format15-preview-pdf');

            // Format 16 (Government sector) PDF routes
            Route::get('/format16-pdf/{bencana_id}', [Form4Controller::class, 'generateFormat16Pdf'])->name('format16-pdf');
            Route::get('/format16-preview-pdf/{bencana_id}', [Form4Controller::class, 'previewFormat16Pdf'])->name('format16-preview-pdf');

            // Format 17 (Environment sector) PDF routes
            Route::get('/format17-pdf/{bencana_id}', [Form4Controller::class, 'generateFormat17Pdf'])->name('format17-pdf');
            Route::get('/format17-preview-pdf/{bencana_id]', [Form4Controller::class, 'previewFormat17Pdf'])->name('format17-preview-pdf');
            Route::get('/list', [Form4Controller::class, 'listFormat1'])->name('list');

            Route::get('/list-format1', [Format1Controller::class, 'list'])->name('list-format1');
            Route::get('/list-format8', [Format8Controller::class, 'list'])->name('list-format8');
            Route::get('/list-format9', [Format9Controller::class, 'list'])->name('list-format9');
            Route::get('/list-format11', [Format11Controller::class, 'list'])->name('list-format11');
            Route::get('/list-format12', [Format12Controller::class, 'list'])->name('list-format12');
            Route::get('/list-format13', [Format13Controller::class, 'list'])->name('list-format13');
            Route::get('/list-format14', [Format14Controller::class, 'list'])->name('list-format14');
            Route::get('/list-format15', [Format15Controller::class, 'list'])->name('list-format15');
            Route::get('/list-format10', [Format10Controller::class, 'list'])->name('list-format10');

            // Additional show and list routes for formats 4, 5, 8, 9, 10
            Route::get('/show-format4/{id}', [Format4Controller::class, 'show'])->name('show-format4');
            Route::get('/show-format5/{id}', [Format5Controller::class, 'show'])->name('show-format5');
            Route::get('/show-format8/{id}', [Format8Controller::class, 'show'])->name('show-format8');
            Route::get('/show-format9/{id}', [Format9Controller::class, 'show'])->name('show-format9');
            Route::get('/show-format10/{id}', [Format10Controller::class, 'show'])->name('show-format10');
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

// Rekap System - Data Consolidation from all formats (MOVED OUTSIDE FORMS GROUP)
Route::prefix('rekap')
    ->name('rekap.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', [RekapController::class, 'index'])->name('index');
        Route::get('/dashboard', [RekapController::class, 'dashboard'])->name('dashboard');
        Route::get('/show/{id}', [RekapController::class, 'show'])->name('show');
        Route::get('/create/{bencana_id}', [RekapController::class, 'create'])->name('create');
        Route::post('/store', [RekapController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RekapController::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [RekapController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [RekapController::class, 'destroy'])->name('delete');
        Route::get('/statistics', [RekapController::class, 'statistics'])->name('statistics');
        Route::get('/pdf/{id}', [RekapController::class, 'generatePdf'])->name('pdf');
        Route::get('/preview-pdf/{id}', [RekapController::class, 'previewPdf'])->name('preview-pdf');
        Route::post('/bulk-delete', [RekapController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('/bulk-update-status', [RekapController::class, 'bulkUpdateStatus'])->name('bulk-update-status');
        Route::get('/export-excel', [RekapController::class, 'exportExcel'])->name('export-excel');

        // Auto-sync routes
        Route::post('/sync-all', [RekapController::class, 'syncAll'])->name('sync-all');
    });

Route::get('/form4/format2', [\App\Http\Controllers\Form4\Format2Controller::class, 'index'])->name('forms.form4.index-format2');
Route::get('/form4/format2/pdf/{id}', [\App\Http\Controllers\Form4\Format2Controller::class, 'generatePdf'])->name('forms.form4.generatePdf-format2');
Route::get('/form4/format4', [\App\Http\Controllers\Form4\Format4Controller::class, 'index'])->name('forms.form4.index-format4');
Route::get('/form4/format4/pdf/{id}', [\App\Http\Controllers\Form4\Format4Controller::class, 'generatePdf'])->name('forms.form4.pdf-format4');

Route::get('/forms/form4/format1/edit/{id}', [\App\Http\Controllers\Form4\Format1Controller::class, 'edit'])->name('forms.form4.format1.edit');
Route::patch('/forms/form4/format1/update/{id}', [\App\Http\Controllers\Form4\Format1Controller::class, 'update'])->name('forms.form4.format1.update');
Route::delete('/forms/form4/format1/destroy/{id}', [\App\Http\Controllers\Form4\Format1Controller::class, 'destroy'])->name('forms.form4.format1.destroy');

Route::get('/forms/form4/format2/edit/{id}', [\App\Http\Controllers\Form4\Format2Controller::class, 'edit'])->name('forms.form4.format2.edit');
Route::delete('/forms/form4/format2/destroy/{id}', [\App\Http\Controllers\Form4\Format2Controller::class, 'destroy'])->name('forms.form4.format2.destroy');
Route::patch('/forms/form4/format2/update/{id}', [\App\Http\Controllers\Form4\Format2Controller::class, 'update'])->name('forms.form4.format2.update');

Route::get('/forms/form4/format3/pdf/{id}', [\App\Http\Controllers\Form4\Format3Controller::class, 'generatePdf'])->name('forms.form4.generatePdf-format3');
Route::get('/forms/form4/format1/pdf/{id]', [\App\Http\Controllers\Form4\Format1Controller::class, 'generatePdf'])->name('forms.form4.generatePdf-format1');

Route::delete('/forms/form4/destroy-format6/{id}', [\App\Http\Controllers\Form4\Format6Controller::class, 'destroy'])->name('forms.form4.destroy-format6');
Route::delete('/forms/form4/destroy/{id}', [\App\Http\Controllers\Form4\Format4Controller::class, 'destroy'])->name('forms.form4.destroy-format4');
Route::get('/forms/form4/format4/pdf/{id}', [\App\Http\Controllers\Form4\Format4Controller::class, 'generatePdf'])->name('forms.form4.generatePdf-format4');

require __DIR__ . '/auth.php';


Route::middleware(['auth', 'role:admin,super-admin'])->group(function () {
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
});

// Untuk super-admin create admin
Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/admins/create', [UserController::class, 'createAdmin'])->name('admins.create');
    Route::post('/admins', [UserController::class, 'storeAdmin'])->name('admins.store');
});