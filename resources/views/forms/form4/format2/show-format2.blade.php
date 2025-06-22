@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Data Format 2 - Sektor Pendidikan</h1>
    
    @if($bencana)
        <div class="alert alert-light-primary color-primary mb-4">
            <p>Bencana: {{ $bencana->kategori_bencana->nama }}</p>
            <p>Tanggal: {{ $bencana->tanggal }}</p>
            <p>Lokasi: 
                @foreach($bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            </p>
        </div>
    @endif
    
    <div class="mb-4 flex justify-between">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali
        </a>
        <a href="#" class="btn btn-primary" onclick="alert('Form input Format 2 belum tersedia')">
            <i class="fa fa-plus mr-2"></i> Tambah Data Baru
        </a>
    </div>
    
    @if(count($educationReports) > 0)
        @foreach($facilityReports as $facilityType => $reports)
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">{{ ucfirst($facilityType) }}</h2>
            <div class="overflow-x-auto">
                <table class="table table-striped table-hover">
                    <thead>
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
                            <td>{{ $report->nama_fasilitas }}</td>
                            <td>{{ $report->rusak_berat }}</td>
                            <td>{{ $report->rusak_sedang }}</td>
                            <td>{{ $report->rusak_ringan }}</td>
                            <td>Rp {{ number_format($report->biaya_rb, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($report->biaya_rs, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($report->biaya_rr, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($report->total_biaya, 0, ',', '.') }}</td>
                            <td>{{ $report->keterangan ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
        
        <!-- Summary -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Ringkasan Total</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $totalRB = collect($educationReports)->sum('rusak_berat');
                    $totalRS = collect($educationReports)->sum('rusak_sedang');
                    $totalRR = collect($educationReports)->sum('rusak_ringan');
                    $totalBiaya = collect($educationReports)->sum('total_biaya');
                @endphp
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-red-600">{{ $totalRB }}</h3>
                    <p class="text-sm text-gray-600">Total Rusak Berat</p>
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-yellow-600">{{ $totalRS }}</h3>
                    <p class="text-sm text-gray-600">Total Rusak Sedang</p>
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-green-600">{{ $totalRR }}</h3>
                    <p class="text-sm text-gray-600">Total Rusak Ringan</p>
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-blue-600">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</h3>
                    <p class="text-sm text-gray-600">Total Biaya</p>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white p-8 rounded-lg shadow text-center">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-school fa-4x"></i>
            </div>
            <h3 class="text-lg font-semibold mb-2">Belum Ada Data</h3>
            <p class="text-gray-600 mb-4">Belum ada data laporan pendidikan untuk bencana ini.</p>
            <a href="#" class="btn btn-primary" onclick="alert('Form input Format 2 belum tersedia')">
                <i class="fa fa-plus mr-2"></i> Tambah Data Pertama
            </a>
        </div>
    @endif
</div>
@endsection
