@extends('layouts.main')

@section('content')
<div class="container mt-4">    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 14: Pengumpulan Data Sektor Perdagangan</p>
    
    <form action="{{ route('forms.form4.store-format14') }}" method="POST">
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

    <p><strong>A. Kerusakan Fisik</strong></p>
    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Bangunan Usaha</th>
                <th>Jumlah Rusak</th>
                <th>Luas Rata-rata (m²)</th>
                <th>Harga Satuan / m²</th>
                <th>Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Toko Kecil</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Kios Pasar</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Grosir</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>B. Kerusakan Barang Dagangan</strong></p>
    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Beras</td><td></td><td></td><td></td></tr>
            <tr><td>Minyak Goreng</td><td></td><td></td><td></td></tr>
            <tr><td>Pakaian</td><td></td><td></td><td></td></tr>
            <tr><td>Peralatan Elektronik</td><td></td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td><td></td></tr>
        </tbody>
    </table>    <p><strong>C. Kehilangan Pendapatan</strong></p>
    <ul>
        <li>Jumlah Pelaku Usaha: ........</li>
        <li>Rata-rata Pendapatan Harian: Rp ........</li>
        <li>Lama Tidak Operasi: ........ Hari</li>
    </ul>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <a href="{{ route('forms.form4.index', ['bencana_id' => request()->query('bencana_id')]) }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
