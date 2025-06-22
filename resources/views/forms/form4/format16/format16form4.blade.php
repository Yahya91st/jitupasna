@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 16: Pengumpulan Data Sektor Pemerintahan</p>

    <table class="table table-bordered">
        <tr>
            <td style="width: 50%">NAMA KAMPUNG:</td>
            <td>NAMA DISTRIK:</td>
        </tr>
    </table>

    <p><strong>A. Kerusakan Gedung dan Peralatan</strong></p>
    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Instansi</th>
                <th>Jumlah Gedung Rusak</th>
                <th>Harga Satuan Bangunan</th>
                <th>Kerusakan Peralatan / Dokumen</th>
                <th>Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Kantor Kecamatan</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Kantor Kampung</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Balai Rakyat</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>B. Dampak Layanan</strong></p>
    <ul>
        <li>Layanan Administratif Terganggu: ........ Hari</li>
        <li>Jumlah Dokumen Penting Hilang: ........ Berkas</li>
        <li>Perlu Relokasi Layanan Pemerintahan: Ya / Tidak</li>
    </ul>
</div>
@endsection
