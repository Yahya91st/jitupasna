@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Format 16 - Data Sektor Pemerintahan</h1>
    
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
            <i class="fa fa-arrow-left mr-2"></i> Kembali
        </a>
        <div class="flex gap-2">
            <a href="{{ route('forms.form4.format16form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                <i class="fa fa-plus mr-2"></i> Tambah Data Baru
            </a>
            @if($governmentReports->count() > 0)
                <a href="{{ route('forms.form4.format16-preview-pdf', $bencana->id) }}" class="btn btn-secondary" target="_blank">
                    <i class="fa fa-file-pdf mr-2"></i> Lihat PDF
                </a>
                <a href="{{ route('forms.form4.format16-pdf', $bencana->id) }}" class="btn btn-success" target="_blank">
                    <i class="fa fa-download mr-2"></i> Unduh PDF
                </a>
            @endif
        </div>
    </div>
    
    @if($facilityReports->count() > 0 || $governmentReports->where('tenaga_kerja_hok', '!=', null)->count() > 0)
        
        <!-- Fasilitas Pemerintahan Section -->
        @if($facilityReports->count() > 0)
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold">I. PERKIRAAN KERUSAKAN FASILITAS PEMERINTAHAN</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-striped table-hover">
                        <thead class="bg-gray-100">
                            <tr>
                                <th rowspan="2" class="text-center align-middle">No</th>
                                <th rowspan="2" class="text-center align-middle">Jenis Fasilitas</th>
                                <th colspan="3" class="text-center">Jumlah Kerusakan</th>
                                <th colspan="3" class="text-center">Harga Satuan (Rp)</th>
                                <th rowspan="2" class="text-center align-middle">Total Biaya (Rp)</th>
                            </tr>
                            <tr>
                                <th class="text-center">RB</th>
                                <th class="text-center">RS</th>
                                <th class="text-center">RR</th>
                                <th class="text-center">RB</th>
                                <th class="text-center">RS</th>
                                <th class="text-center">RR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; $totalDamage = 0; @endphp
                            @foreach($facilityReports as $report)
                                @php
                                    $biayaTotal = ($report->jumlah_rb * $report->harga_rb) + 
                                                 ($report->jumlah_rs * $report->harga_rs) + 
                                                 ($report->jumlah_rr * $report->harga_rr);
                                    $totalDamage += $biayaTotal;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $report->jenis_fasilitas }}</td>
                                    <td class="text-center">{{ $report->jumlah_rb ?? 0 }}</td>
                                    <td class="text-center">{{ $report->jumlah_rs ?? 0 }}</td>
                                    <td class="text-center">{{ $report->jumlah_rr ?? 0 }}</td>
                                    <td class="text-right">{{ number_format($report->harga_rb ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($report->harga_rs ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($report->harga_rr ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right font-bold">{{ number_format($biayaTotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr class="bg-gray-100 font-bold">
                                <td colspan="8" class="text-center">TOTAL BIAYA KERUSAKAN</td>
                                <td class="text-right">{{ number_format($totalDamage, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
          <!-- Kerugian Section -->        @if($lossReports && $lossReports->count() > 0)
            <div class="bg-white rounded-lg shadow mb-6">                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold">II. PERKIRAAN KERUGIAN SEKTOR PEMERINTAHAN</h2>
                    
                    <!-- Summary Debug Information -->
                    <div class="bg-yellow-100 p-3 mb-4 rounded">
                        <h4 class="font-bold">Debug Info - Summary:</h4>
                        <p>Total Loss Reports: {{ $lossReports->count() }}</p>
                        <p>Loss Report IDs: 
                            @foreach($lossReports as $lossItem)
                                {{ $lossItem->id }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                        <p class="mt-2">All records with jenis_fasilitas = 'Kerugian Lainnya'</p>
                    </div>
                </div><!-- Puing Section -->                <div class="p-4 border-b">
                    <h3 class="font-medium mb-3">1. Biaya Pembersihan Puing</h3>
                    
                    <!-- Debug Information for Puing -->
                    <div class="bg-blue-100 p-3 mb-4 rounded">
                        <h4 class="font-bold">Debug Info - Puing:</h4>
                        <div class="overflow-x-auto">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tenaga Kerja HOK</th>
                                        <th>Upah Harian</th>
                                        <th>Alat Berat Hari</th>
                                        <th>Biaya per Hari Alat Berat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lossReports as $lossItem)
                                    <tr>
                                        <td>{{ $lossItem->id }}</td>
                                        <td>{{ $lossItem->tenaga_kerja_hok ?? 'null' }}</td>
                                        <td>{{ $lossItem->upah_harian ?? 'null' }}</td>
                                        <td>{{ $lossItem->alat_berat_hari ?? 'null' }}</td>
                                        <td>{{ $lossItem->biaya_per_hari_alat_berat ?? 'null' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tenaga Kerja (HOK)</th>
                                    <th>Upah Harian (Rp)</th>
                                    <th>Alat Berat (Hari)</th>
                                    <th>Biaya per Hari (Rp)</th>
                                    <th>Total Biaya (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                    $totalPuing = 0;
                                @endphp
                                
                                @foreach($lossReports as $index => $lossItem)
                                    @php 
                                        $biayaPuing = (($lossItem->tenaga_kerja_hok ?? 0) * ($lossItem->upah_harian ?? 0)) + 
                                                     (($lossItem->alat_berat_hari ?? 0) * ($lossItem->biaya_per_hari_alat_berat ?? 0));
                                        $totalPuing += $biayaPuing;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $lossItem->id }}</td>
                                        <td class="text-center">{{ $lossItem->tenaga_kerja_hok ?? 0 }}</td>
                                        <td class="text-right">{{ number_format($lossItem->upah_harian ?? 0, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $lossItem->alat_berat_hari ?? 0 }}</td>
                                        <td class="text-right">{{ number_format($lossItem->biaya_per_hari_alat_berat ?? 0, 0, ',', '.') }}</td>
                                        <td class="text-right font-bold">{{ number_format($biayaPuing, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                
                                <tr class="bg-gray-100 font-bold">
                                    <td colspan="5" class="text-center">SUBTOTAL BIAYA PEMBERSIHAN PUING</td>
                                    <td class="text-right">{{ number_format($totalPuing, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>                <!-- Kantor Sementara Section -->                <div class="p-4 border-b">
                    <h3 class="font-medium mb-3">2. Biaya Kantor Sementara</h3>
                    
                    <!-- Debug Information for Kantor Sementara -->
                    <div class="bg-blue-100 p-3 mb-4 rounded">
                        <h4 class="font-bold">Debug Info - Kantor Sementara:</h4>
                        <div class="overflow-x-auto">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Jumlah Unit</th>
                                        <th>Biaya Sewa per Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lossReports as $lossItem)
                                    <tr>
                                        <td>{{ $lossItem->id }}</td>
                                        <td>{{ $lossItem->jumlah_unit ?? 'null' }}</td>
                                        <td>{{ $lossItem->biaya_sewa_per_unit ?? 'null' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jumlah Unit</th>
                                    <th>Biaya Sewa per Unit (Rp)</th>
                                    <th>Total Biaya (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalKantor = 0;
                                @endphp
                                
                                @foreach($lossReports as $index => $lossItem)
                                    @php
                                        $biayaKantor = ($lossItem->jumlah_unit ?? 0) * ($lossItem->biaya_sewa_per_unit ?? 0);
                                        $totalKantor += $biayaKantor;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $lossItem->id }}</td>
                                        <td class="text-center">{{ $lossItem->jumlah_unit ?? 0 }}</td>
                                        <td class="text-right">{{ number_format($lossItem->biaya_sewa_per_unit ?? 0, 0, ',', '.') }}</td>
                                        <td class="text-right font-bold">{{ number_format($biayaKantor, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                
                                <tr class="bg-gray-100 font-bold">
                                    <td colspan="3" class="text-center">SUBTOTAL BIAYA KANTOR SEMENTARA</td>
                                    <td class="text-right">{{ number_format($totalKantor, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                  <!-- Arsip Section -->                <div class="p-4">
                    <h3 class="font-medium mb-3">3. Biaya Penggantian Arsip</h3>
                    
                    <!-- Debug Information for Arsip -->
                    <div class="bg-blue-100 p-3 mb-4 rounded">
                        <h4 class="font-bold">Debug Info - Arsip:</h4>
                        <div class="overflow-x-auto">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Jumlah Arsip</th>
                                        <th>Harga Satuan</th>
                                        <th>Dasar Perhitungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lossReports as $lossItem)
                                    <tr>
                                        <td>{{ $lossItem->id }}</td>
                                        <td>{{ $lossItem->jumlah_arsip ?? 'null' }}</td>
                                        <td>{{ $lossItem->harga_satuan ?? 'null' }}</td>
                                        <td>{{ $lossItem->dasar_perhitungan ?? 'null' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jumlah Arsip</th>
                                    <th>Harga Satuan (Rp)</th>
                                    <th>Dasar Perhitungan</th>
                                    <th>Total Biaya (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalArsip = 0;
                                @endphp
                                
                                @foreach($lossReports as $index => $lossItem)
                                    @php
                                        $biayaArsip = ($lossItem->jumlah_arsip ?? 0) * ($lossItem->harga_satuan ?? 0);
                                        $totalArsip += $biayaArsip;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $lossItem->id }}</td>
                                        <td class="text-center">{{ $lossItem->jumlah_arsip ?? 0 }}</td>
                                        <td class="text-right">{{ number_format($lossItem->harga_satuan ?? 0, 0, ',', '.') }}</td>
                                        <td>{{ $lossItem->dasar_perhitungan ?? '-' }}</td>
                                        <td class="text-right font-bold">{{ number_format($biayaArsip, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                
                                <tr class="bg-gray-100 font-bold">
                                    <td colspan="4" class="text-center">SUBTOTAL BIAYA PENGGANTIAN ARSIP</td>
                                    <td class="text-right">{{ number_format($totalArsip, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                </div>@php 
                    // All variables are already calculated in their respective sections
                    
                    // Calculate totals
                    $totalLoss = ($totalPuing ?? 0) + ($totalKantor ?? 0) + ($totalArsip ?? 0);
                    $grandTotal = ($totalDamage ?? 0) + $totalLoss;
                    
                    // Debug information on totals (shown in console but not visible to users)
                    \Log::debug('Final calculation values:', [
                        'totalPuing' => $totalPuing ?? 0,
                        'totalKantor' => $totalKantor ?? 0, 
                        'totalArsip' => $totalArsip ?? 0,
                        'totalLoss' => $totalLoss,
                        'totalDamage' => $totalDamage ?? 0,
                        'grandTotal' => $grandTotal
                    ]);
                @endphp
                
                <!-- Total Kerugian -->
                <div class="p-4 bg-gray-50 border-t">
                    <div class="text-right">
                        <h3 class="font-bold text-lg">TOTAL KERUGIAN: Rp {{ number_format($totalLoss, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        @endif

        <!-- Grand Total -->
        <div class="bg-primary text-white rounded-lg shadow p-4">
            <div class="text-center">
                <h2 class="text-xl font-bold">TOTAL KESELURUHAN SEKTOR PEMERINTAHAN</h2>
                <h3 class="text-2xl font-bold mt-2">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h3>
            </div>
        </div>

    @else
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <i class="fa fa-info-circle fa-3x text-gray-400 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-700 mb-2">Belum Ada Data</h3>
            <p class="text-gray-500 mb-4">Belum ada data sektor pemerintahan untuk bencana ini.</p>
            <a href="{{ route('forms.form4.format16form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                <i class="fa fa-plus mr-2"></i> Tambah Data Sekarang
            </a>
        </div>
    @endif
</div>
@endsection
