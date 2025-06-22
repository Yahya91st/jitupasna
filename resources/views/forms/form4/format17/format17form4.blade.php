@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 17: Pengumpulan Data Sektor Lingkungan Hidup</p>

    <table class="table table-bordered">
        <tr>
            <td style="width: 50%">NAMA KAMPUNG:</td>
            <td>NAMA DISTRIK:</td>
        </tr>
    </table>

    <p><strong>A. Kerusakan Ekosistem</strong></p>
    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Ekosistem</th>
                <th>Area Terdampak (Ha)</th>
                <th>Tingkat Kerusakan</th>
                <th>Biaya Rehabilitasi per Ha</th>
                <th>Total Perkiraan Biaya</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Hutan</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Mangrove</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Sawah / Lahan Basah</td><td></td><td></td><td></td><td></td></tr>
            <tr><td>Sungai / Sempadan</td><td></td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <p><strong>B. Kerusakan Infrastruktur Pengelolaan Lingkungan</strong></p>
    <ul>
        <li>Tempat Pembuangan Sampah Sementara / TPS</li>
        <li>Drainase Lingkungan</li>
        <li>Saluran Air Limbah</li>
    </ul>

    <p><strong>C. Biaya Penanganan Limbah B3 & Non-B3</strong></p>
    <ul>
        <li>Volume Limbah: ........ Ton</li>
        <li>Biaya Penanganan per Ton: Rp ........</li>
    </ul>
</div>
@endsection
