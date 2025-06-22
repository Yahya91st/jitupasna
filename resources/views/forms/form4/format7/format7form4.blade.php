@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 7: Pengumpulan Data Sektor Transportasi</p>

    <table class="table table-bordered">
        <tr>
            <td style="width: 50%">NAMA KAMPUNG:</td>
            <td>NAMA DISTRIK:</td>
        </tr>
    </table>

    <p><strong>A. Kerusakan Jalan dan Jembatan</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th rowspan="2">Jenis Infrastruktur</th>
                <th rowspan="2">Nama Ruas/Jembatan</th>
                <th rowspan="2">Jenis (Nasional/Kab/Kota/Desa)</th>
                <th rowspan="2">Material (Aspal/Batu/Tanah)</th>
                <th colspan="3">Jumlah Kerusakan (Km)</th>
                <th rowspan="2">Harga Satuan / m²</th>
                <th rowspan="2">Perkiraan Biaya Perbaikan</th>
            </tr>
            <tr>
                <th>Berat</th>
                <th>Sedang</th>
                <th>Ringan</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Jalan</td><td colspan="8"></td></tr>
            <tr><td>Jembatan</td><td colspan="8"></td></tr>
        </tbody>
    </table>

    <p><strong>B. Kerusakan Kendaraan</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Kendaraan</th>
                <th>Jumlah</th>
                <th>Unit</th>
                <th colspan="2">Tidak Perlu Diisi</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Sedan / Minibus</td><td></td><td>Unit</td><td colspan="2"></td></tr>
            <tr><td>Bus / Truk</td><td></td><td>Unit</td><td colspan="2"></td></tr>
            <tr><td>Kendaraan Berat</td><td></td><td>Unit</td><td colspan="2"></td></tr>
            <tr><td>Kapal Laut</td><td></td><td>Unit</td><td colspan="2"></td></tr>
            <tr><td>Bus Air</td><td></td><td>Unit</td><td colspan="2"></td></tr>
            <tr><td>Speed Boat</td><td></td><td>Unit</td><td colspan="2"></td></tr>
            <tr><td>Perahu Klotok</td><td></td><td>Unit</td><td colspan="2"></td></tr>
        </tbody>
    </table>

    <p><strong>C. Kerusakan Sarana Transportasi</strong></p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sarana</th>
                <th>Jenis</th>
                <th>Ukuran/Luas</th>
                <th>Perkiraan Biaya</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Terminal</td><td></td><td></td><td></td></tr>
            <tr><td>Dermaga</td><td></td><td></td><td></td></tr>
            <tr><td>Bandara</td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>D. Kehilangan Pendapatan</strong></p>
    <ul>
        <li>Angkutan Darat: Rp ......... / hari x ........ Unit</li>
        <li>Angkutan Laut: Rp ......... / hari x ........ Unit</li>
        <li>Angkutan Udara: Rp ......... / hari x ........ Unit</li>
        <li>Terminal, Dermaga, Bandara: masing-masing Rp ......... / hari</li>
    </ul>

    <p><strong>E. Tambahan Biaya Operasional</strong></p>
    <ul>
        <li>Biaya Operasional Kendaraan Sebelum dan Sesudah Bencana</li>
        <li>Jumlah Kendaraan Terdampak</li>
        <li>Biaya per Unit</li>
    </ul>

    <p><strong>F. Infrastruktur Darurat</strong><br>
        Contoh: Jembatan Bailey, Jalur Alternatif, dll – Biaya: Rp .........
    </p>
</div>
@endsection
