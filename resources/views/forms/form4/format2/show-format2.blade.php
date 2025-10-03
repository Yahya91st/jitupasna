@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel agar lebih kompak seperti format1form4 */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
</style>

<div class="container mt-4">
    <h5 class="text-center fw-bold">Detail Data Sektor Pendidikan<br>Format 2</h5>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Informasi Bencana -->
    @if($bencana)
    <div class="alert alert-light-primary color-primary mb-4">
        <strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama ?? $bencana->nama }}<br>
        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($bencana->tanggal)->format('d F Y') }}<br>
        <strong>Lokasi:</strong> 
        @if($bencana->desa && count($bencana->desa) > 0)
            @foreach($bencana->desa as $desa)
                {{ $desa->nama }}@if(!$loop->last), @endif
            @endforeach
        @else
            -
        @endif
    </div>
    @endif

    <!-- Identitas Lokasi -->
    <table class="table table-bordered">
        <tr>
            <td style="width: 50%"><strong>NAMA KAMPUNG:</strong> {{ $formPendidikan->nama_kampung ?? '-' }}</td>
            <td><strong>NAMA DISTRIK:</strong> {{ $formPendidikan->nama_distrik ?? '-' }}</td>
        </tr>
    </table>

    <h6 class="fw-bold mt-4">I. DATA SEKTOR PENDIDIKAN</h6>

    <!-- Tabel Sekolah -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr class="bg-light">
                <th colspan="5">KERUSAKAN SEKOLAH</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 25%"><strong>Sekolah untuk Pengungsian</strong></td>
                <td style="width: 25%">{{ $formPendidikan->sekolah_pengungsian ?? 0 }} unit</td>
                <td style="width: 20%"><strong>Guru Korban Bencana</strong></td>
                <td style="width: 30%">{{ $formPendidikan->guru_korban ?? 0 }} orang</td>
            </tr>
            <tr>
                <td><strong>Jumlah Sekolah Sementara</strong></td>
                <td>{{ $formPendidikan->jumlah_sekolah_sementara ?? 0 }} unit</td>
                <td><strong>Harga Sekolah Sementara</strong></td>
                <td>Rp {{ number_format($formPendidikan->harga_sekolah_sementara ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Iuran Sekolah Swasta</strong></td>
                <td colspan="3">Rp {{ number_format($formPendidikan->iuran_sekolah ?? 0, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h6 class="fw-bold mt-4">II. REKAPITULASI KERUSAKAN DAN KERUGIAN</h6>
    
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Jenis</th>
                <th class="text-end">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Total Kerusakan</strong></td>
                <td class="text-end">Rp {{ number_format($formPendidikan->total_kerusakan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Total Kerugian</strong></td>
                <td class="text-end">Rp {{ number_format($formPendidikan->total_kerugian ?? 0, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Total Summary -->
    @php
        $grandTotal = ($formPendidikan->total_kerusakan ?? 0) + ($formPendidikan->total_kerugian ?? 0);
    @endphp

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">REKAPITULASI TOTAL</h6>
        </div>
        <div class="card-body text-center">
            <h4 class="mb-1">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>
            <small>Total Keseluruhan Format 2</small>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 mb-4">
        <a href="{{ route('forms.form4.list-format2', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali ke Daftar
        </a>
        <div>
            <a href="{{ route('forms.form4.generatePdf-format2', $formPendidikan->id) }}" class="btn btn-primary" target="_blank">
                Unduh PDF
            </a>
        </div>
    </div>
</div>
@endsection
