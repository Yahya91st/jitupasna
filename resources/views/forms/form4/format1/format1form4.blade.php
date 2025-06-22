@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
        <p class="fw-bold">Format 1a: Pengumpulan Data Sektor Perumahan</p>
        
        <form action="{{ route('forms.form4.store') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">

        <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required></td>
            </tr>
        </table>

        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th rowspan="2">Perkiraan Kerusakan</th>
                    <th colspan="3">Jumlah Rumah</th>
                    <th colspan="2">Harga Satuan</th>
                </tr>
                <tr>
                    <th>Rumah Permanen</th>
                    <th>Rumah Non Permanen</th>
                    <th>Jumlah</th>
                    <th>Permanen</th>
                    <th>Non Permanen</th>
                </tr>
                
                
            </thead>
            <tbody>
                <tr>
                    <td>1a) JUMLAH RUMAH HANCUR TOTAL</td>
                    <td><input type="number" class="form-control" name="hancur_total_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="hancur_total_non_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="hancur_total_jumlah" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="hancur_total_harga_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="hancur_total_harga_non_permanen" placeholder="0"></td>
                </tr>
                <tr>
                    <td>1b) JUMLAH RUMAH RUSAK SEDANG</td>
                    <td><input type="number" class="form-control" name="rusak_sedang_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_sedang_non_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_sedang_jumlah" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_sedang_harga_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_sedang_harga_non_permanen" placeholder="0"></td>
                </tr>
                <tr>
                    <td>1c) JUMLAH RUMAH RUSAK RINGAN</td>
                    <td><input type="number" class="form-control" name="rusak_ringan_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_ringan_non_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_ringan_jumlah" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_ringan_harga_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_ringan_harga_non_permanen" placeholder="0"></td>
                </tr>
                <tr>
                    <td>1d) JUMLAH RUMAH RUSAK BERAT</td>
                    <td><input type="number" class="form-control" name="rusak_berat_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_berat_non_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_berat_jumlah" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_berat_harga_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_berat_harga_non_permanen" placeholder="0"></td>
                </tr>
            </tbody>
        </table>

        <p class="fw-bold mt-4">2. KERUSAKAN PRASARANA LINGKUNGAN</p>
        <p><strong>2.1 JALAN LINGKUNGAN</strong><br>
            Rusak berat: <input type="number" class="form-control d-inline-block" name="jalan_rusak_berat" placeholder="0" style="width: 150px;"> m²<br>
            Rusak sedang: <input type="number" class="form-control d-inline-block" name="jalan_rusak_sedang" placeholder="0" style="width: 150px;"> m²<br>
            Rusak ringan: <input type="number" class="form-control d-inline-block" name="jalan_rusak_ringan" placeholder="0" style="width: 150px;"> m²<br>
            Harga Satuan/M²: Rp <input type="number" class="form-control d-inline-block" name="jalan_harga_satuan" placeholder="0" style="width: 150px;">
        </p>

        <p><strong>2.2 SALURAN AIR/GORONG-GORONG</strong><br>
            Rusak berat: <input type="number" class="form-control d-inline-block" name="saluran_rusak_berat" placeholder="0" style="width: 150px;"> m²<br>
            Rusak sedang: <input type="number" class="form-control d-inline-block" name="saluran_rusak_sedang" placeholder="0" style="width: 150px;"> m²<br>
            Rusak ringan: <input type="number" class="form-control d-inline-block" name="saluran_rusak_ringan" placeholder="0" style="width: 150px;"> m²<br>
            Harga Satuan/M²: Rp <input type="number" class="form-control d-inline-block" name="saluran_harga_satuan" placeholder="0" style="width: 150px;">
        </p>

        <p><strong>2.3 BALAI PERTEMUAN RW/RT</strong><br>
            RUSAK BERAT: <input type="number" class="form-control d-inline-block" name="balai_rusak_berat" placeholder="0" style="width: 150px;"> UNIT<br>
            RUSAK SEDANG: <input type="number" class="form-control d-inline-block" name="balai_rusak_sedang" placeholder="0" style="width: 150px;"> UNIT<br>
            RUSAK RINGAN: <input type="number" class="form-control d-inline-block" name="balai_rusak_ringan" placeholder="0" style="width: 150px;"> UNIT<br>
            Harga Satuan/M²: Rp <input type="number" class="form-control d-inline-block" name="balai_harga_satuan" placeholder="0" style="width: 150px;">
        </p>

        <hr class="my-4">

        <h6 class="fw-bold">II. PERKIRAAN KERUGIAN</h6>
        <p><strong>1) BIAYA PEMBERSIHAN PUING</strong></p>
        <p>
            A. Jumlah Tenaga Kerja: <input type="number" class="form-control d-inline-block" name="biaya_tenaga_kerja_hok" placeholder="0" style="width: 100px;"> HOK * Rp <input type="number" class="form-control d-inline-block" name="biaya_tenaga_kerja_upah" placeholder="0" style="width: 150px;"> /Upah Harian<br>
            B. Jumlah Alat Berat: <input type="number" class="form-control d-inline-block" name="biaya_alat_berat_hari" placeholder="0" style="width: 100px;"> Hari X Rp <input type="number" class="form-control d-inline-block" name="biaya_alat_berat_harga" placeholder="0" style="width: 150px;"> /Hari
        </p>

        <p><strong>2) PERKIRAAN JUMLAH RUMAH YANG DISEWAKAN</strong><br>
            c) Harga Sewa Rumah Per Bulan: <input type="number" class="form-control d-inline-block" name="harga_sewa_rumah" placeholder="0" style="width: 200px;"> Rupiah
        </p>

        <p><strong>3) PERKIRAAN KEBUTUHAN HUNIAN SEMENTARA</strong><br>
            Tenda : <input type="number" class="form-control d-inline-block" name="kebutuhan_tenda" placeholder="0" style="width: 150px;"> Unit<br>
            Barak : <input type="number" class="form-control d-inline-block" name="kebutuhan_barak" placeholder="0" style="width: 150px;"> Unit<br>
            Rumah Sementara : <input type="number" class="form-control d-inline-block" name="kebutuhan_rumah_sementara" placeholder="0" style="width: 150px;"> Unit
        </p>

        <p><strong>4) HARGA SATUAN PENYEDIAAN HUNIAN SEMENTARA</strong><br>
            Tenda : <input type="number" class="form-control d-inline-block" name="harga_tenda" placeholder="0" style="width: 200px;"> Rupiah<br>
            Barak : <input type="number" class="form-control d-inline-block" name="harga_barak" placeholder="0" style="width: 200px;"> Rupiah<br>
            Rumah Sementara : <input type="number" class="form-control d-inline-block" name="harga_rumah_sementara" placeholder="0" style="width: 200px;"> Rupiah
        </p>

        <hr class="my-4">

        <div class="row mb-4">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
        </form>
{{-- 
        <h6 class="fw-bold">Format 2. Pengumpulan Data Sektor PENDIDIKAN</h6>
        <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG:</td>
                <td>NAMA DISTRIK:</td>
            </tr> --}}

        {{-- Lanjutkan layout tabel sektor pendidikan dan kesehatan menggunakan struktur HTML serupa --}}

    </div>
@endsection
