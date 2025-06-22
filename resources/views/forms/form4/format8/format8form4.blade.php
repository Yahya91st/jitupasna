@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 8: Pengumpulan Data Sektor Listrik</p>

    <table class="table table-bordered">
        <tr>
            <td style="width: 50%">NAMA KAMPUNG:</td>
            <td>NAMA DISTRIK:</td>
        </tr>
    </table>

    <p><strong>A. Kerusakan Infrastruktur Kelistrikan</strong></p>

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
            <tr><td>Trafo</td><td></td><td></td><td></td></tr>
            <tr><td>Tiang Listrik</td><td></td><td></td><td></td></tr>
            <tr><td>Kabel Jaringan</td><td></td><td></td><td></td></tr>
            <tr><td>Panel Distribusi</td><td></td><td></td><td></td></tr>
            <tr><td>Meteran</td><td></td><td></td><td></td></tr>
            <tr><td>Peralatan Listrik Lainnya</td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>B. Perkiraan Kerugian</strong></p>
    <p>
        <strong>1) Biaya Pembersihan Puing dan Pemulihan:</strong><br>
        A. Tenaga Kerja: ...... HOK x Rp ......<br>
        B. Sewa Alat Berat: ...... Hari x Rp ......
    </p>

    <p>
        <strong>2) Kehilangan Pendapatan PLN:</strong><br>
        - Rata-rata Pendapatan Harian: Rp ........<br>
        - Lama Gangguan: ........ Hari
    </p>

    <p>
        <strong>3) Biaya Operasional Tambahan:</strong><br>
        - Penggunaan Genset Darurat<br>
        - BBM dan Perawatan<br>
        - Biaya Pengadaan Sarana Darurat
    </p>

    <p><strong>Catatan Tambahan:</strong><br>
        Masukkan data lainnya bila ada kebutuhan pemulihan non-fisik.
    </p>
</div>
@endsection
