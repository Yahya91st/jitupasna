@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 10: Pengumpulan Data Sektor Pertanian & Perkebunan</p>

    <table class="table table-bordered">
        <tr>
            <td style="width: 50%">NAMA KAMPUNG:</td>
            <td>NAMA DISTRIK:</td>
        </tr>
    </table>

    <p><strong>A. Kerusakan Tanaman</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Tanaman</th>
                <th>Luasan Terdampak (Ha)</th>
                <th>Umur Tanaman Saat Bencana</th>
                <th>Harga Panen per Kg</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Padi</td><td></td><td></td><td></td></tr>
            <tr><td>Jagung</td><td></td><td></td><td></td></tr>
            <tr><td>Kedelai</td><td></td><td></td><td></td></tr>
            <tr><td>Kopi</td><td></td><td></td><td></td></tr>
            <tr><td>Sawit</td><td></td><td></td><td></td></tr>
            <tr><td>Kakao</td><td></td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>B. Kerusakan Irigasi</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Jaringan</th>
                <th>Volume Kerusakan</th>
                <th>Luas Tanam Terdampak</th>
                <th>Perkiraan Biaya Perbaikan</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Primer</td><td></td><td></td><td></td></tr>
            <tr><td>Sekunder</td><td></td><td></td><td></td></tr>
            <tr><td>Tersier</td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>C. Kerusakan Alat dan Gudang</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Nama Peralatan</th>
                <th>Jumlah Rusak Berat</th>
                <th>Rusak Sedang</th>
                <th>Rusak Ringan</th>
                <th>Harga Satuan</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Traktor</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Pompa</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Gudang</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>D. Produksi yang Hilang Total</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Tanaman</th>
                <th>Luasan Tanaman</th>
                <th>Produktivitas (Kg/Ha)</th>
                <th>Harga Panen per Kg</th>
            </tr>
        </thead>
        <tbody>
            <tr><td colspan="4"></td></tr>
        </tbody>
    </table>

    <p><strong>E. Penurunan Produksi (Sebagian)</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Tanaman</th>
                <th>Selisih Penurunan Produktivitas</th>
                <th>Harga Panen per Kg</th>
                <th>Jangka Waktu Dampak</th>
            </tr>
        </thead>
        <tbody>
            <tr><td colspan="4"></td></tr>
        </tbody>
    </table>

    <p><strong>F. Kenaikan Ongkos Produksi</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Tanaman</th>
                <th>Luasan Terdampak</th>
                <th>Selisih Ongkos Produksi</th>
            </tr>
        </thead>
        <tbody>
            <tr><td colspan="3"></td></tr>
        </tbody>
    </table>
</div>
@endsection
