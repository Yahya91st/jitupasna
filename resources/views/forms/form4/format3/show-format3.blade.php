@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel agar lebih kompak seperti format1form4 */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
</style>

<div class="container mt-4">
    <h5 class="text-center fw-bold">Detail Data Sektor Kesehatan<br>Format 3</h5>
    
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
        @if($bencana->desa && is_countable($bencana->desa) && count($bencana->desa) > 0)
            @foreach($bencana->desa as $desa)
                {{ $desa->nama }}@if(!$loop->last), @endif
            @endforeach
        @else
            -
        @endif
    </div>
    @endif

    <h6 class="fw-bold mt-4">I. DATA SEKTOR KESEHATAN</h6>

    @if(isset($healthReports) && is_countable($healthReports) && count($healthReports) > 0)
        @foreach($healthReports as $facilityType => $reports)
        <table class="table table-bordered mt-3">
            <thead>
                <tr class="bg-light">
                    <th colspan="9">{{ strtoupper($facilityType) }}</th>
                </tr>
                <tr>
                    <th>Nama Fasilitas</th>
                    <th>Rusak Berat</th>
                    <th>Rusak Sedang</th>
                    <th>Rusak Ringan</th>
                    <th>Biaya RB</th>
                    <th>Biaya RS</th>
                    <th>Biaya RR</th>
                    <th>Total Biaya</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td><strong>{{ $report->nama_fasilitas }}</strong></td>
                    <td class="text-center">{{ $report->rusak_berat ?? 0 }}</td>
                    <td class="text-center">{{ $report->rusak_sedang ?? 0 }}</td>
                    <td class="text-center">{{ $report->rusak_ringan ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($report->biaya_rb ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($report->biaya_rs ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($report->biaya_rr ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end"><strong>Rp {{ number_format($report->total_biaya ?? 0, 0, ',', '.') }}</strong></td>
                    <td>{{ $report->keterangan ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach

        <h6 class="fw-bold mt-4">II. REKAPITULASI TOTAL SEKTOR KESEHATAN</h6>
        
        @php
            $totalRB = collect($healthReports)->flatten()->sum('rusak_berat');
            $totalRS = collect($healthReports)->flatten()->sum('rusak_sedang');
            $totalRR = collect($healthReports)->flatten()->sum('rusak_ringan');
            $totalBiaya = collect($healthReports)->flatten()->sum('total_biaya');
        @endphp

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Jenis Kerusakan</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-end">Total Biaya</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Total Rusak Berat</strong></td>
                    <td class="text-center">{{ $totalRB }}</td>
                    <td class="text-end">Rp {{ number_format(collect($healthReports)->flatten()->sum('biaya_rb'), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Total Rusak Sedang</strong></td>
                    <td class="text-center">{{ $totalRS }}</td>
                    <td class="text-end">Rp {{ number_format(collect($healthReports)->flatten()->sum('biaya_rs'), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Total Rusak Ringan</strong></td>
                    <td class="text-center">{{ $totalRR }}</td>
                    <td class="text-end">Rp {{ number_format(collect($healthReports)->flatten()->sum('biaya_rr'), 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Total Summary -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">REKAPITULASI TOTAL</h6>
            </div>
            <div class="card-body text-center">
                <h4 class="mb-1">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</h4>
                <small>Total Keseluruhan Format 3</small>
            </div>
        </div>

    @else
        <div class="alert alert-info mt-3">
            <h6>Belum Ada Data</h6>
            <p class="mb-0">Belum ada data laporan kesehatan untuk bencana ini.</p>
        </div>
    @endif

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 mb-4">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali
        </a>
        <div>
            <a href="{{ route('forms.form4.format3form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                Tambah Data Baru
            </a>
        </div>
    </div>
</div>
@endsection
