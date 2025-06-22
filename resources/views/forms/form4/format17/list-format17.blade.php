@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Laporan Lingkungan Hidup (Format 17)</h1>
    
    @if($bencana)
        <div class="alert alert-light-primary color-primary mb-4">
            <p><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama }}</p>
            <p><strong>Tanggal:</strong> {{ $bencana->tanggal }}</p>
            <p><strong>Lokasi:</strong> 
                @foreach($bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            </p>
        </div>
    @endif
    
    <div class="mb-4 flex justify-between">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali ke Form 4
        </a>        <div class="flex gap-2">
            <a href="{{ route('forms.form4.format17form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                <i class="fa fa-plus mr-2"></i> Tambah Laporan Baru
            </a>
            <a href="{{ route('forms.form4.show-format17', $bencana->id) }}" class="btn btn-info">
                <i class="fa fa-eye mr-2"></i> Lihat Ringkasan Laporan
            </a>
            <a href="{{ route('forms.form4.format17-preview-pdf', $bencana->id) }}" class="btn btn-secondary" target="_blank">
                <i class="fa fa-file-pdf mr-2"></i> Lihat PDF
            </a>
            <a href="{{ route('forms.form4.format17-pdf', $bencana->id) }}" class="btn btn-success" target="_blank">
                <i class="fa fa-download mr-2"></i> Unduh PDF
            </a>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        @if($environmentalReports->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tipe Laporan</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th>Total Biaya</th>
                    <th>Tanggal Input</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1; @endphp
                @foreach($environmentalReports as $report)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>
                            @if($report->report_type === 'damage')
                                <span class="badge bg-danger">Kerusakan</span>
                            @else
                                <span class="badge bg-warning">Kerugian</span>
                            @endif
                        </td>
                        <td>
                            @if($report->report_type === 'damage')
                                {{ ucfirst($report->ekosistem ?? 'N/A') }}
                            @else
                                @switch($report->jenis_kerugian)
                                    @case('kehilangan_jasa_lingkungan')
                                        Jasa Lingkungan
                                        @break
                                    @case('pencemaran_air')
                                        Pencemaran Air
                                        @break
                                    @case('pencemaran_udara')
                                        Pencemaran Udara
                                        @break
                                    @default
                                        {{ ucfirst(str_replace('_', ' ', $report->jenis_kerugian)) }}
                                @endswitch
                            @endif
                        </td>
                        <td>
                            @if($report->report_type === 'damage')
                                {{ $report->jenis_kerusakan }}
                            @else
                                {{ $report->jenis }}
                            @endif
                        </td>
                        <td>
                            @php
                                $totalBiaya = $report->harga_rb + $report->harga_rs + $report->harga_rr;
                            @endphp
                            Rp {{ number_format($totalBiaya, 2, ',', '.') }}
                        </td>
                        <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>                        <td>
                            <div class="btn-group" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 4px;">
                                <a href="{{ route('forms.form4.show-format17', $bencana->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                                <!-- Placeholder for Edit button -->
                                <div class="btn btn-sm btn-warning disabled" style="opacity: 0.5;" title="Edit">
                                    <i class="fa fa-edit"></i> Edit
                                </div>
                                <a href="{{ route('forms.form4.format17-preview-pdf', $bencana->id) }}" class="btn btn-sm btn-secondary" title="Preview PDF" target="_blank">
                                    <i class="fa fa-search"></i> Lihat PDF
                                </a>
                                <a href="{{ route('forms.form4.format17-pdf', $bencana->id) }}" class="btn btn-sm btn-primary" title="Download PDF" target="_blank">
                                    <i class="fa fa-download"></i> Unduh PDF
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="p-4 bg-gray-50">
            @php
                $totalKerusakan = $environmentalReports->where('report_type', 'damage')->sum(function($report) {
                    return $report->harga_rb + $report->harga_rs + $report->harga_rr;
                });
                $totalKerugian = $environmentalReports->where('report_type', 'loss')->sum(function($report) {
                    return $report->harga_rb + $report->harga_rs + $report->harga_rr;
                });
                $grandTotal = $totalKerusakan + $totalKerugian;
            @endphp
            <div class="row">
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body text-center">
                            <h6>Total Kerusakan</h6>
                            <h4>Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <h6>Total Kerugian</h6>
                            <h4>Rp {{ number_format($totalKerugian, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h6>Grand Total</h6>
                            <h4>Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <h6>Total Laporan</h6>
                            <h4>{{ $environmentalReports->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="p-6 text-center">
            <div class="mb-4">
                <i class="fa fa-leaf fa-4x text-gray-400"></i>
            </div>
            <h4>Belum ada laporan lingkungan hidup</h4>
            <p class="text-gray-600 mb-4">Belum ada data laporan lingkungan hidup yang disimpan untuk bencana ini.</p>
            <a href="{{ route('forms.form4.format17form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                <i class="fa fa-plus mr-2"></i> Buat Laporan Pertama
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
