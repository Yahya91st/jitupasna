@extends('layouts.main')

@section('content')
<div class="container mt-4">    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 15: Pengumpulan Data Sektor Pariwisata</p>
    
    <form action="{{ route('forms.form4.store-format15') }}" method="POST">
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

    <p><strong>A. Kerusakan Sarana & Objek Wisata</strong></p>
    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Sarana</th>
                <th>Jumlah Rusak</th>
                <th>Harga Satuan</th>
                <th>Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Penginapan / Homestay</td><td></td><td></td><td></td></tr>
            <tr><td>Restoran / Warung Wisata</td><td></td><td></td><td></td></tr>
            <tr><td>Objek Wisata (Pantai, Situs, dll)</td><td></td><td></td><td></td></tr>
            <tr><td>Pusat Informasi Wisata</td><td></td><td></td><td></td></tr>
        </tbody>
    </table>    <p><strong>B. Kehilangan Pendapatan</strong></p>
    <ul>
        <li>Jumlah Usaha Pariwisata Terdampak: ........</li>
        <li>Rata-rata Pendapatan Harian: Rp ........</li>
        <li>Jumlah Hari Tutup Operasi: ........ Hari</li>
        <li>Kehilangan Wisatawan: ........ Orang</li>
    </ul>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <a href="{{ route('forms.form4.index', ['bencana_id' => request()->query('bencana_id')]) }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
