@extends('layouts.main')

@section('content')
<div class="container mt-4">    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 11: Pengumpulan Data Sektor Peternakan</p>
    
    <form action="{{ route('forms.form4.store-format11') }}" method="POST">
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

    <p><strong>A. Kerusakan Bangunan & Sarana Peternakan</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Bangunan</th>
                <th>Rusak Berat</th>
                <th>Rusak Sedang</th>
                <th>Rusak Ringan</th>
                <th>Rata-rata Luas (m²)</th>
                <th>Harga Satuan / m²</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Kandang Ternak</td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Gudang Pakan</td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Balai Inseminasi / Klinik Hewan</td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>B. Kerusakan Peralatan Peternakan</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Peralatan</th>
                <th>Jumlah Rusak</th>
                <th>Harga Satuan</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Mesin Pencacah</td><td></td><td></td></tr>
            <tr><td>Mesin Pakan Ternak</td><td></td><td></td></tr>
            <tr><td>Alat Penampung Susu</td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>C. Kematian atau Hilangnya Ternak</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Ternak</th>
                <th>Jumlah Ternak Hilang / Mati</th>
                <th>Harga Rata-Rata / Ekor</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Sapi</td><td></td><td></td></tr>
            <tr><td>Kambing</td><td></td><td></td></tr>
            <tr><td>Ayam</td><td></td><td></td></tr>
            <tr><td>Babi</td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>D. Dampak Ekonomi dan Sosial</strong></p>
    <ul>
        <li>Kehilangan Pendapatan Peternak: Rp ........</li>
        <li>Penurunan Produksi (Susu, Daging, Telur): ........ satuan</li>
        <li>Kenaikan Harga Pakan / Transportasi: Rp ........</li>
        <li>Tambahan Biaya Kesehatan Ternak: Rp ........</li>
    </ul>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <a href="{{ route('forms.form4.index', ['bencana_id' => request()->query('bencana_id')]) }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
