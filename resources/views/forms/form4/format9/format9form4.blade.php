@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 9: Pengumpulan Data Sektor Telekomunikasi</p>

    <table class="table table-bordered">
        <tr>
            <td style="width: 50%">NAMA KAMPUNG:</td>
            <td>NAMA DISTRIK:</td>
        </tr>
    </table>

    <p><strong>A. Kerusakan Sarana Telekomunikasi</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Sarana</th>
                <th>Jumlah Unit Rusak</th>
                <th>Harga Satuan</th>
                <th>Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Menara BTS</td><td></td><td></td><td></td></tr>
            <tr><td>Switching Station</td><td></td><td></td><td></td></tr>
            <tr><td>Peralatan Transmisi</td><td></td><td></td><td></td></tr>
            <tr><td>Panel & Perangkat Kontrol</td><td></td><td></td><td></td></tr>
            <tr><td>Kabel Fiber Optik</td><td></td><td></td><td></td></tr>
            <tr><td>Peralatan Kantor Layanan</td><td></td><td></td><td></td></tr>
            <tr><td>Lainnya:</td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>B. Perkiraan Kerugian</strong></p>
    <p>
        <strong>1) Biaya Pemulihan:</strong><br>
        A. Tenaga Kerja: ...... HOK x Rp ......<br>
        B. Sewa Alat Berat: ...... Hari x Rp ......
    </p>

    <p>
        <strong>2) Kehilangan Pendapatan Operator Telekomunikasi:</strong><br>
        - Rata-rata Pendapatan Harian: Rp ........<br>
        - Lama Gangguan: ........ Hari
    </p>

    <p>
        <strong>3) Biaya Alternatif Komunikasi:</strong><br>
        - Penggunaan radio HT, satelit, dll<br>
        - Biaya sewa perangkat alternatif: Rp ........
    </p>

    <p><strong>Catatan:</strong><br>
        Mohon lengkapi jumlah pelanggan terdampak bila tersedia.
    </p>
</div>
@endsection
