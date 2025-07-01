@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 10: Pengumpulan Data Sektor Pertanian & Perkebunan</p>

    <form action="{{ route('forms.form4.store-format10') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
        
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA KAMPUNG</span>
                    <input type="text" class="form-control form-control-sm" name="nama_kampung" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA DISTRIK</span>
                    <input type="text" class="form-control form-control-sm" name="nama_distrik" required>
                </div>
            </div>
        </div>

    <p><strong>A. Kerusakan Tanaman</strong></p>

    <table class="table table-bordered text-center align-middle" style="background-color: #f8f9fa; color:rgb(0, 0, 0);">
        <thead>
            <tr style="background-color:rgb(0, 0, 0); color:rgb(255, 255, 255);">
                <td></td>
                <td>Jenis Tanaman</td>
                <td style="padding: 0;">Luasan Terdampak (Ha)</td>
                <td style="padding: 0;">Umur Tanaman Saat Bencana</td>
                <td>Harga Panen per Ha</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Perkiraan Kerusakan</td>
            </tr>
            <tr>
                <td rowspan="6">Kerusakan Lahan Pertanian</td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="padi_luas" id="padi_luas" step="0.01"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="padi_lama_tanam"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="padi_harga" id="padi_harga"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm" name="padi_total" id="padi_total" ></td>
            </tr>
            <tr>
                
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="palawija_luas" id="palawija_luas" step="0.01"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="palawija_lama_tanam"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="palawija_harga" id="palawija_harga"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm" name="palawija_total" id="palawija_total" ></td>
            </tr>
            <tr>
                
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="holtikultura_luas" id="holtikultura_luas" step="0.01"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="holtikultura_lama_tanam"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="holtikultura_harga" id="holtikultura_harga"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm" name="holtikultura_total" id="holtikultura_total" ></td>
            </tr>
            <tr>
                
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_luas" id="perkebunan_luas" step="0.01"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_harga" id="perkebunan_harga"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm" name="perkebunan_total" id="perkebunan_total" ></td>
            </tr>
            <tr>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_luas" id="perkebunan_luas" step="0.01"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_harga" id="perkebunan_harga"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm" name="perkebunan_total" id="perkebunan_total" ></td>
            </tr>
            <tr>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_luas" id="perkebunan_luas" step="0.01"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_harga" id="perkebunan_harga"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm" name="perkebunan_total" id="perkebunan_total" ></td>
            </tr>
            <tr>
                <td rowspan="4">Kerusakan Bibit & Tanaman</td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_luas" id="perkebunan_luas" step="0.01"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_harga" id="perkebunan_harga"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm" name="perkebunan_total" id="perkebunan_total" ></td>
            </tr>
            <tr>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_luas" id="perkebunan_luas" step="0.01"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_harga" id="perkebunan_harga"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm" name="perkebunan_total" id="perkebunan_total" ></td>
            </tr>
            <tr>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_luas" id="perkebunan_luas" step="0.01"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_harga" id="perkebunan_harga"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm" name="perkebunan_total" id="perkebunan_total" ></td>
            </tr>
            <tr>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_luas" id="perkebunan_luas" step="0.01"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_harga" id="perkebunan_harga"></td>
                <td style="padding:5px"><input type="number" class="form-control form-control-sm" name="perkebunan_total" id="perkebunan_total" ></td>
            </tr>
            <tr style="background-color:rgb(0, 0, 0); color:rgb(255, 255, 255);">
                <td></td>
                <td>Jenis Jaringan</td>
                <td>Luasan Kerusakan</td>
                <td>Luas Tanam Terdampak</td>
                <td>Perkiraan Biaya Perbaikan</td>
            </tr>
            <tr>
                <td rowspan="3">C. Sarana Irigasi</td>
                <td>Jaringan Primer</td>
                <td style="padding:5px;"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px;"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_harga" id="perkebunan_harga"></td>
                <td style="padding:5px;"><input type="number" class="form-control form-control-sm" name="perkebunan_total" id="perkebunan_total" ></td>
            </tr>
            <tr>
                <td>Jaringan Tersier</td>
                <td style="padding:5px;"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px;"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_harga" id="perkebunan_harga"></td>
                <td style="padding:5px;"><input type="number" class="form-control form-control-sm" name="perkebunan_total" id="perkebunan_total" ></td>
            </tr>
            <tr>
                <td>Jaringan Irigasi Desa</td>
                <td style="padding:5px;"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px;"><input type="number" class="form-control form-control-sm calculate-crop-damage" name="perkebunan_harga" id="perkebunan_harga"></td>
                <td style="padding:5px;"><input type="number" class="form-control form-control-sm" name="perkebunan_total" id="perkebunan_total" ></td>
            </tr>
            <tr style="padding: 0; background-color:rgb(0, 0, 0); color:rgb(255, 255, 255);">
                <td>Mesin dan Bangunan</td>
                <td>Harga Satuan</td>
                <td>Rusak Berat</td>
                <td>Rusak Sedang</td>
                <td>Rusak Ringan</td>
            </tr>
            <tr>
                <td style="padding: 0;">
                    D. Mesin-mesin pertanian dan peralatan
                </td>                
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>
            <tr>
                <td style="padding: 0;"></td> 
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>
            <tr>
                <td style="padding: 0;">E. Kerusakan Gudang dan Bangunan Lainnya</td>                 
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>
            <tr>
                <td style="padding: 0;"></td> 
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>
            <tr style="padding: 0; background-color:rgb(0, 0, 0); color:rgb(255, 255, 255);">
                <td>Produksi Yang Hilang Total</td>
                <td>Jenis Tanaman</td>
                <td>Luasan Tanaman</td>
                <td>Produktifitas/Ha</td>
                <td>Harga Panen Per Kg</td>
            </tr>
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>
            
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>
            
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>
            
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>            
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>
            <tr style="padding: 0; background-color:rgb(0, 0, 0); color:rgb(255, 255, 255);">
                <td>Penurunan Produksi</td>
                <td>Jenis Tanaman</td>
                <td>Luasan Tanaman</td>
                <td>Selisih Penurunan Produktifitas</td>
                <td>Harga Panen Per Kg</td>
                <td style="padding:0; width: 120px; line-height: 1.1; text-align: center;">Jangka Waktu Penurunan Produktivitas</td>
            </tr>           
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>        
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>        
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>        
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>        
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>        
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>
            <tr style="padding: 0; background-color:rgb(0, 0, 0); color:rgb(255, 255, 255);">
                <td>Kenaikan Ongkos Produksi</td>
                <td>Jenis Tanaman</td>
                <td>Luasan Tanaman</td>
                <td>Selisih Kenaikan Ongkos Produksi</td>
            </tr>        
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>    
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>    
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>    
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>    
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>    
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm" name="perkebunan_lama_tanam"></td>
            </tr>
        </tbody>
    </table>


    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{ route('forms.form4.index', ['bencana_id' => request()->query('bencana_id')]) }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </div>
    </form>
</div>

<script>
$(document).ready(function() {
    // Calculate crop damage
    $('.calculate-crop-damage').on('input', function() {
        const cropType = $(this).attr('name').split('_')[0];
        const luas = parseFloat($('#' + cropType + '_luas').val()) || 0;
        const harga = parseFloat($('#' + cropType + '_harga').val()) || 0;
        $('#' + cropType + '_total').val(luas * harga);
    });

    // Calculate irrigation damage
    $('.calculate-irrigation').on('input', function() {
        const rusakBerat = parseFloat($('#irigasi_rusak_berat').val()) || 0;
        const rusakSedang = parseFloat($('#irigasi_rusak_sedang').val()) || 0;
        const rusakRingan = parseFloat($('#irigasi_rusak_ringan').val()) || 0;
        const harga = parseFloat($('#irigasi_harga').val()) || 0;
        $('#irigasi_total').val((rusakBerat + rusakSedang + rusakRingan) * harga);
    });

    // Calculate equipment damage
    $('.calculate-equipment').on('input', function() {
        const rusakBerat = parseFloat($('#peralatan_rusak_berat').val()) || 0;
        const rusakSedang = parseFloat($('#peralatan_rusak_sedang').val()) || 0;
        const rusakRingan = parseFloat($('#peralatan_rusak_ringan').val()) || 0;
        const harga = parseFloat($('#peralatan_harga').val()) || 0;
        $('#peralatan_total').val((rusakBerat + rusakSedang + rusakRingan) * harga);
    });

    // Calculate building damage
    $('.calculate-building').on('input', function() {
        const rusakBerat = parseFloat($('#bangunan_rusak_berat').val()) || 0;
        const rusakSedang = parseFloat($('#bangunan_rusak_sedang').val()) || 0;
        const rusakRingan = parseFloat($('#bangunan_rusak_ringan').val()) || 0;
        const harga = parseFloat($('#bangunan_harga').val()) || 0;
        $('#bangunan_total').val((rusakBerat + rusakSedang + rusakRingan) * harga);
    });
});
</script>
@endsection
