@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel agar lebih kompak seperti format1form4 */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
</style>

<div class="container mt-4">
    <h5 class="text-center fw-bold">Detail Data Sektor Transportasi<br>Format 7</h5>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Informasi Bencana -->
    @if($bencana)
    <div class="alert alert-dismissible fade show" role="alert" style="background-color: #5A8DEE; border-color: #4C7BDA; color: white;">
        <strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama ?? $bencana->nama }}<br>
        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($bencana->tanggal)->format('d M Y') }}<br>
        <strong>Lokasi:</strong> 
        @if($bencana->desa && count($bencana->desa) > 0)
            @foreach($bencana->desa as $desa)
                {{ $desa->nama }}@if(!$loop->last), @endif
            @endforeach
        @else
            -
        @endif
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Identitas Lokasi -->
    <table class="table table-bordered">
        <tr>
            <td style="width: 50%"><strong>NAMA KAMPUNG:</strong> {{ $formTransportasi->nama_kampung ?? '-' }}</td>
            <td><strong>NAMA DISTRIK:</strong> {{ $formTransportasi->nama_distrik ?? '-' }}</td>
        </tr>
    </table>

    <h6 class="fw-bold mt-4">I. KERUSAKAN SEKTOR TRANSPORTASI</h6>

    <!-- Kerusakan Jalan -->
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th colspan="5">1. KERUSAKAN JALAN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 20%"><strong>Ruas Jalan</strong></td>
                <td style="width: 30%">{{ $formTransportasi->jalan_ruas ?? '-' }}</td>
                <td style="width: 15%"><strong>Jenis</strong></td>
                <td style="width: 35%">{{ $formTransportasi->jalan_jenis ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Tipe Jalan</strong></td>
                <td colspan="3">{{ $formTransportasi->jalan_tipe ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Rusak Berat</strong></td>
                <td>{{ $formTransportasi->jalan_rusak_berat ?? 0 }} unit</td>
                <td><strong>Harga Satuan</strong></td>
                <td>Rp {{ number_format($formTransportasi->jalan_harga_satuan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Rusak Sedang</strong></td>
                <td>{{ $formTransportasi->jalan_rusak_sedang ?? 0 }} unit</td>
                <td><strong>Biaya Perbaikan</strong></td>
                <td>Rp {{ number_format($formTransportasi->jalan_biaya_perbaikan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Rusak Ringan</strong></td>
                <td>{{ $formTransportasi->jalan_rusak_ringan ?? 0 }} unit</td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>

    <!-- Kerusakan Jembatan -->
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th colspan="5">2. KERUSAKAN JEMBATAN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 20%"><strong>Nama Jembatan</strong></td>
                <td style="width: 30%">{{ $formTransportasi->jembatan_nama ?? '-' }}</td>
                <td style="width: 15%"><strong>Jenis</strong></td>
                <td style="width: 35%">{{ $formTransportasi->jembatan_jenis ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Tipe Jembatan</strong></td>
                <td colspan="3">{{ $formTransportasi->jembatan_tipe ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Rusak Berat</strong></td>
                <td>{{ $formTransportasi->jembatan_rusak_berat ?? 0 }} unit</td>
                <td><strong>Harga Satuan</strong></td>
                <td>Rp {{ number_format($formTransportasi->jembatan_harga_satuan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Rusak Sedang</strong></td>
                <td>{{ $formTransportasi->jembatan_rusak_sedang ?? 0 }} unit</td>
                <td><strong>Biaya Perbaikan</strong></td>
                <td>Rp {{ number_format($formTransportasi->jembatan_biaya_perbaikan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Rusak Ringan</strong></td>
                <td>{{ $formTransportasi->jembatan_rusak_ringan ?? 0 }} unit</td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>

    <h6 class="fw-bold mt-4">II. KERUSAKAN KENDARAAN</h6>

    <!-- Kerusakan Kendaraan -->
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th colspan="5">KERUSAKAN KENDARAAN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 25%"><strong>Sedan/Minibus</strong></td>
                <td style="width: 25%">{{ $formTransportasi->sedan_minibus_jumlah ?? 0 }} ({{ $formTransportasi->sedan_minibus_unit ?? 0 }} unit)</td>
                <td style="width: 25%"><strong>Kapal Laut</strong></td>
                <td style="width: 25%">{{ $formTransportasi->kapal_laut_jumlah ?? 0 }} ({{ $formTransportasi->kapal_laut_unit ?? 0 }} unit)</td>
            </tr>
            <tr>
                <td><strong>Bus/Truk</strong></td>
                <td>{{ $formTransportasi->bus_truk_jumlah ?? 0 }} ({{ $formTransportasi->bus_truk_unit ?? 0 }} unit)</td>
                <td><strong>Bus Air</strong></td>
                <td>{{ $formTransportasi->bus_air_jumlah ?? 0 }} ({{ $formTransportasi->bus_air_unit ?? 0 }} unit)</td>
            </tr>
            <tr>
                <td><strong>Kendaraan Berat</strong></td>
                <td colspan="3">{{ $formTransportasi->kendaraan_berat_jumlah ?? 0 }} ({{ $formTransportasi->kendaraan_berat_unit ?? 0 }} unit)</td>
            </tr>
        </tbody>
    </table>

    <h6 class="fw-bold mt-4">III. REKAPITULASI TOTAL</h6>
    
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Jenis Kerusakan</th>
                <th class="text-end">Biaya Perbaikan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Total Biaya Perbaikan Jalan</strong></td>
                <td class="text-end">Rp {{ number_format($formTransportasi->jalan_biaya_perbaikan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Total Biaya Perbaikan Jembatan</strong></td>
                <td class="text-end">Rp {{ number_format($formTransportasi->jembatan_biaya_perbaikan ?? 0, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Total Summary -->
    @php
        $grandTotal = ($formTransportasi->jalan_biaya_perbaikan ?? 0) + ($formTransportasi->jembatan_biaya_perbaikan ?? 0);
    @endphp

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">REKAPITULASI TOTAL</h6>
        </div>
        <div class="card-body text-center">
            <h4 class="mb-1">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>
            <small>Total Keseluruhan Format 7</small>
        </div>
    </div>
    
</div>
@endsection
