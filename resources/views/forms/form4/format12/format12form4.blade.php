@extends('layouts.main')

@section('content')
<div class="container mt-4">    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 12: Pengumpulan Data Sektor Perikanan</p>
    
    <form action="{{ route('forms.form4.store-format12') }}" method="POST">
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

    <p><strong>A. Kerusakan Sarana Budidaya</strong></p>

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
            <tr><td>Kolam Ikan</td><td></td><td></td><td></td></tr>
            <tr><td>Tambak</td><td></td><td></td><td></td></tr>
            <tr><td>Keramba</td><td></td><td></td><td></td></tr>
            <tr><td>Hatchery (Balai Benih)</td><td></td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>B. Kerusakan Sarana Tangkap</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Alat Tangkap</th>
                <th>Jumlah Rusak</th>
                <th>Harga Satuan</th>
                <th>Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Perahu Motor</td><td></td><td></td><td></td></tr>
            <tr><td>Perahu Dayung</td><td></td><td></td><td></td></tr>
            <tr><td>Jaring Insang</td><td></td><td></td><td></td></tr>
            <tr><td>Jaring Purse Seine</td><td></td><td></td><td></td></tr>
            <tr><td>Alat Penangkap Lain</td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>C. Kematian/Hilangnya Hasil Perikanan</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Ikan</th>
                <th>Jumlah (Kg)</th>
                <th>Harga per Kg</th>
                <th>Total Nilai Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Ikan Lele</td><td></td><td></td><td></td></tr>
            <tr><td>Ikan Nila</td><td></td><td></td><td></td></tr>
            <tr><td>Udang</td><td></td><td></td><td></td></tr>
            <tr><td>Bandeng</td><td></td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>D. Dampak Ekonomi</strong></p>
    <ul>
        <li>Kehilangan Pendapatan Harian Nelayan: Rp ........</li>
        <li>Rata-rata Hari Tidak Melaut: ........ hari</li>
        <li>Biaya Sewa Alat Tangkap Darurat: Rp ........</li>
        <li>Kenaikan Harga Pakan/BBM: Rp ........</li>
    </ul>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <a href="{{ route('forms.form4.index', ['bencana_id' => request()->query('bencana_id')]) }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
