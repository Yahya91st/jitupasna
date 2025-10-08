@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel agar lebih kompak seperti format1form4 */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
</style>

<div class="container mt-4">
    <h5 class="text-center fw-bold">Detail Data Sektor Lainnya<br>Format 10</h5>
    
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
            <td style="width: 50%"><strong>NAMA KAMPUNG:</strong> {{ $report->nama_kampung ?? '-' }}</td>
            <td><strong>NAMA DISTRIK:</strong> {{ $report->nama_distrik ?? '-' }}</td>
        </tr>
    </table>

    <h6 class="fw-bold mt-4">I. KERUSAKAN SEKTOR LAINNYA</h6>

    <!-- Kerusakan Sektor Lainnya -->
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" style="width: 15%">Jenis Sektor</th>
                    <th colspan="3">Tingkat Kerusakan</th>
                    <th rowspan="2" style="width: 15%">Ukuran (m²)</th>
                    <th rowspan="2" style="width: 20%">Harga Satuan</th>
                    <th rowspan="2" style="width: 20%">Nilai Kerusakan</th>
                </tr>
                <tr>
                    <th style="width: 10%">Rusak Berat</th>
                    <th style="width: 10%">Rusak Sedang</th>
                    <th style="width: 10%">Rusak Ringan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-start"><strong>{{ $report->jenis_sektor ?? 'Sektor Lainnya' }}</strong></td>
                    <td>{{ $report->jumlah_rb ?? 0 }}</td>
                    <td>{{ $report->jumlah_rs ?? 0 }}</td>
                    <td>{{ $report->jumlah_rr ?? 0 }}</td>
                    <td>{{ number_format($report->ukuran ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($report->harga_satuan ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format((($report->jumlah_rb ?? 0) * ($report->ukuran ?? 0) * ($report->harga_satuan ?? 0)) + 
                        (($report->jumlah_rs ?? 0) * ($report->ukuran ?? 0) * ($report->harga_satuan ?? 0) * 0.3) + 
                        (($report->jumlah_rr ?? 0) * ($report->ukuran ?? 0) * ($report->harga_satuan ?? 0) * 0.1), 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
            
    <h6 class="fw-bold mt-4">II. DETAIL KERUGIAN</h6>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 30%">Jenis Kerugian</th>
                <th style="width: 40%">Nilai</th>
                <th style="width: 30%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>{{ $report->jenis_kerugian ?? 'Kerugian' }}</strong></td>
                <td class="text-end">Rp {{ number_format($report->nilai_kerugian ?? 0, 0, ',', '.') }}</td>
                <td>{{ $report->keterangan ?? '-' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Total Summary -->
    @php
        $totalKerusakan = $report->total_kerusakan ?? 0;
        $totalKerugian = $report->total_kerugian ?? 0;
        $grandTotal = $totalKerusakan + $totalKerugian;
    @endphp

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">REKAPITULASI TOTAL</h6>
        </div>
        <div class="card-body text-center">
            <h4 class="mb-1">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>
            <small>Total Keseluruhan Format 10</small>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 mb-4">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali
        </a>
        <div>
            <a href="{{ route('forms.form4.format10.edit', $report->id) }}" class="btn btn-warning me-2">
                Edit Data
            </a>
            <a href="{{ route('forms.form4.format10.pdf', $report->id) }}" class="btn btn-primary" target="_blank">
                Unduh PDF
            </a>
        </div>
    </div>
</div>
@endsection
