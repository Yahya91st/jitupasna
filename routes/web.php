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
use App\Http\Controllers\WilayahProxyController;
use App\Http\Controllers\WilayahController;


// Proxy routes for wilayah.id
Route::get('/proxy/wilayah/provinces', [WilayahProxyController::class, 'provinces']);
Route::get('/proxy/wilayah/regencies/{province_code}', [WilayahProxyController::class, 'regencies']);
Route::get('/proxy/wilayah/districts/{regency_code}', [WilayahProxyController::class, 'districts']);
Route::get('/proxy/wilayah/villages/{district_code}', [WilayahProxyController::class, 'villages']);

Route::get('/wilayah/provinces', [WilayahController::class, 'provinces']);
Route::get('/wilayah/regencies/{code}', [WilayahController::class, 'regencies']);
Route::get('/wilayah/districts/{code}', [WilayahController::class, 'districts']);
Route::get('/wilayah/villages/{code}', [WilayahController::class, 'villages']);


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
            Route::delete('/delete/{id}', [Form1Controller::class, 'destroy'])->name('destroy');
            Route::get('/list', [Form1Controller::class, 'list'])->name('list');
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
            Route::delete('/delete/{id}', [Form2Controller::class, 'destroy'])->name('destroy');
            Route::get('/list', [Form2Controller::class, 'list'])->name('list');
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
                Route::delete('/destroy/{id}', [Format5Controller::class, 'destroy'])->name('destroy');
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
        });

        // Form 6 (Formulir 06 - Pendataan Tingkat Rumahtangga)
        Route::prefix('form6')->name('form6.')->group(function () {
            Route::get('/', [Form6Controller::class, 'index'])->name('index');
            Route::post('/store', [Form6Controller::class, 'store'])->name('store');
            Route::get('/show/{id}', [Form6Controller::class, 'show'])->name('show');
            Route::get('/edit/{id}', [Form6Controller::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [Form6Controller::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [Form6Controller::class, 'destroy'])->name('destroy');
            Route::get('/list', [Form6Controller::class, 'list'])->name('list');
            Route::get('/pdf/{id}', [Form6Controller::class, 'generatePdf'])->name('pdf');
            Route::get('/preview-pdf/{id}', [Form6Controller::class, 'previewPdf'])->name('preview-pdf');
            Route::get('/get-rumahtangga/{id}', [Form6Controller::class, 'getRumahtangga'])->name('get-rumahtangga');
            
            // Route untuk contoh PDF (dengan data dummy dari controller)
            Route::get('/contoh-pdf', [Form6Controller::class, 'contohPdf'])->name('contoh-pdf');
        });

        // Form 7 (Formulir 07 - Diskusi Kelompok Terfokus (FGD))
        Route::prefix('form7')->name('form7.')->group(function () {
            Route::get('/', [Form7Controller::class, 'index'])->name('index');
            Route::post('/store', [Form7Controller::class, 'store'])->name('store');
            Route::get('/show/{id}', [Form7Controller::class, 'show'])->name('show');
            Route::get('/edit/{id}', [Form7Controller::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [Form7Controller::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [Form7Controller::class, 'destroy'])->name('destroy');
            Route::get('/list', [Form7Controller::class, 'list'])->name('list');
            Route::get('/pdf/{id}', [Form7Controller::class, 'generatePdf'])->name('pdf');
            Route::get('/preview-pdf/{id}', [Form7Controller::class, 'previewPdf'])->name('preview-pdf');
            Route::get('/contoh-pdf', [Form7Controller::class, 'contohPdf'])->name('contoh-pdf');

        });

        // Form 8 (Pengolahan dan Analisis Data Penilaian Kerusakan dan Kerugian)
        Route::prefix('form8')->name('form8.')->group(function () {
            Route::get('/', [Form8Controller::class, 'index'])->name('index');
            Route::post('/store', [Form8Controller::class, 'store'])->name('store');
            Route::get('/show/{id}', [Form8Controller::class, 'show'])->name('show');
            Route::get('/edit/{id}', [Form8Controller::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [Form8Controller::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [Form8Controller::class, 'destroy'])->name('destroy');
            Route::get('/list', [Form8Controller::class, 'list'])->name('list');
            Route::get('/pdf/{id}', [Form8Controller::class, 'generatePdf'])->name('pdf');
            Route::get('/preview-pdf/{id}', [Form8Controller::class, 'previewPdf'])->name('preview-pdf');
            Route::get('/contoh-pdf', [Form8Controller::class, 'contohPdf'])->name('contoh-pdf');
            Route::get('/form8-per-baris', [Form8Controller::class, 'perBaris'])->name('form8-per-baris');

            // Route untuk format baru Form8
            Route::get('/format-menu', [Form8Controller::class, 'formatMenu'])->name('format-menu');
            Route::get('/table-ringkas', [Form8Controller::class, 'tableRingkas'])->name('table-ringkas');
            Route::get('/form8-per-baris-pdf', [Form8Controller::class, 'perBarisPdf'])->name('form8-per-baris-pdf');
            Route::get('/analisis-komprehensif', [Form8Controller::class, 'analisisKomprehensif'])->name('analisis-komprehensif');
            
            // Route untuk edit dan delete per row
            Route::get('/row/edit/{id}', [Form8Controller::class, 'editRow'])->name('row.edit');
            Route::patch('/row/update/{id}', [Form8Controller::class, 'updateRow'])->name('row.update');
            Route::delete('/row/destroy/{id}', [Form8Controller::class, 'destroyRow'])->name('row.destroy');
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
            Route::delete('/delete/{id}', [Form9Controller::class, 'destroy'])->name('destroy');
            Route::get('/contoh-pdf', [Form9Controller::class, 'contohPdf'])->name('contoh-pdf');
            Route::get('/form9Row', [Form9Controller::class, 'perBaris'])->name('form9Row');
});

        // Form10 (Analisa Data Akibat terhadap Akses, Fungsi, dan Resiko)
        Route::prefix('form10')->name('form10.')->group(function () {
            Route::get('/', [Form10Controller::class, 'index'])->name('index');
            Route::post('/store', [Form10Controller::class, 'store'])->name('store');
            Route::get('/list', [Form10Controller::class, 'list'])->name('list');
            Route::get('/show/{id}', [Form10Controller::class, 'show'])->name('show');
            Route::get('/edit/{id}', [Form10Controller::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [Form10Controller::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [Form10Controller::class, 'destroy'])->name('destroy');
            Route::get('/pdf/{id}', [Form10Controller::class, 'generatePdf'])->name('pdf');
            Route::get('/preview-pdf/{id}', [Form10Controller::class, 'previewPdf'])->name('preview-pdf');
            Route::get('/contoh-pdf', [Form10Controller::class, 'contohPdf'])->name('contoh-pdf');
        });

        // Form11 (Rekapitulasi Kebutuhan Pascabencana)
        Route::prefix('form11')->name('form11.')->group(function () {
            Route::get('/', [Form11Controller::class, 'index'])->name('index');
            Route::post('/store', [Form11Controller::class, 'store'])->name('store');
            Route::get('/list', [Form11Controller::class, 'list'])->name('list');
            Route::get('/show/{id}', [Form11Controller::class, 'show'])->name('show');
            Route::get('/edit/{id}', [Form11Controller::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [Form11Controller::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [Form11Controller::class, 'destroy'])->name('destroy');
            Route::get('/pdf/{id}', [Form11Controller::class, 'generatePdf'])->name('pdf');
            Route::get('/preview-pdf/{id}', [Form11Controller::class, 'previewPdf'])->name('preview-pdf');
            Route::get('/contoh-pdf', [Form11Controller::class, 'contohPdf'])->name('contoh-pdf');
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