@extends('layouts.main')

@section('content')
<div class="container mt-4">    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 13: Pengumpulan Data Sektor Industri & UMKM</p>
    
    <form action="{{ route('forms.form4.store-format13') }}" method="POST">
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

    <p><strong>A. Kerusakan Bangunan Produksi</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Bangunan</th>
                <th>Jumlah Rusak</th>
                <th>Rata-rata Luas (m²)</th>
                <th>Harga Satuan / m²</th>
                <th>Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Unit Produksi</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Gudang</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Toko / Gerai</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>B. Kerusakan Peralatan Produksi</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Peralatan</th>
                <th>Jumlah Rusak</th>
                <th>Harga Satuan</th>
                <th>Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Mesin Jahit</td><td></td><td></td><td></td></tr>
            <tr><td>Alat Panggang / Oven</td><td></td><td></td><td></td></tr>
            <tr><td>Etalase / Display</td><td></td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>C. Kehilangan Produksi & Pendapatan</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Usaha</th>
                <th>Rata-rata Produksi per Hari</th>
                <th>Harga Jual per Unit</th>
                <th>Hari Tidak Produksi</th>
                <th>Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Roti / Kue</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Pakaian</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Mebel</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>D. Biaya Tambahan</strong></p>
    <ul>
        <li>Sewa tempat sementara produksi: Rp ........</li>
        <li>Transportasi bahan baku: Rp ........</li>
        <li>Alat bantu darurat: Rp ........</li>
    </ul>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <a href="{{ route('forms.form4.index', ['bencana_id' => request()->query('bencana_id')]) }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
