@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 5: Pengumpulan Data Sektor Keagamaan</p>

    <table class="table table-bordered">
        <tr>
            <td style="width: 50%">NAMA KAMPUNG:</td>
            <td>NAMA DISTRIK:</td>
        </tr>
    </table>

    <p><strong>A. Kerusakan Bangunan Ibadah</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th rowspan="2">Jenis Bangunan Ibadah</th>
                <th colspan="3">Jumlah Unit Rusak</th>
                <th rowspan="2">Rata-Rata Luas Bangunan (m²)</th>
                <th colspan="2">Harga Satuan</th>
            </tr>
            <tr>
                <th>Berat</th>
                <th>Sedang</th>
                <th>Ringan</th>
                <th>Bangunan/m²</th>
                <th>Peralatan Ibadah</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Masjid</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Musala</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Gereja</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Kapel</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Pura</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Vihara</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>B. Perkiraan Kerugian</strong></p>
    <p>
        <strong>1) Biaya Pembersihan Puing:</strong><br>
        A. Biaya Tenaga Kerja: ...... HOK x Rp ......<br>
        B. Biaya Alat Berat: ...... Hari x Rp ......
    </p>

    <p>
        <strong>2) Biaya Pemulihan Layanan Keagamaan:</strong><br>
        - Kegiatan ibadah di tempat sementara: ........ Hari<br>
        - Biaya Operasional Harian: Rp ........<br>
        - Bantuan Sarana Keagamaan Darurat: Rp ........
    </p>
</div>
@endsection
