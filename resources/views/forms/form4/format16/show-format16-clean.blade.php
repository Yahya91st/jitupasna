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
            <a href="{{ route('forms.form4.list-format16', ['bencana_id' => $bencana->id]) }}" class="btn btn-info">
                <i class="fa fa-list mr-2"></i> Daftar Laporan
            </a>
        </div>
    </div>
    
    <!-- Debug Information -->
    <div class="bg-yellow-100 p-3 mb-4 rounded">
        <h4 class="font-bold">Debug Info:</h4>
        <p>Form Data ID: {{  $form->id }}</p>
        <p>Facility Reports Count: {{ $facilityReports->count() }}</p>
        <p>Loss Reports Count: {{ $lossReports->count() }}</p>
        <p>Government Reports Count: {{ $governmentReports->count() }}</p>
    </div>
    
    @if($facilityReports->count() > 0 || $lossReports->count() > 0)
        
        <!-- I. PERKIRAAN KERUSAKAN FASILITAS PEMERINTAHAN -->
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
        
        <!-- II. PERKIRAAN KERUGIAN SEKTOR PEMERINTAHAN -->
        @if($lossReports->count() > 0)
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold">II. PERKIRAAN KERUGIAN SEKTOR PEMERINTAHAN</h2>
                </div>
                
                <!-- 1. Biaya Pembersihan Puing -->
                <div class="p-4 border-b">
                    <h3 class="font-medium mb-3">1. Biaya Pembersihan Puing</h3>
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
                                @php $totalPuing = 0; @endphp
                                @foreach($lossReports as $lossItem)
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
                </div>
                
                <!-- 2. Biaya Kantor Sementara -->
                <div class="p-4 border-b">
                    <h3 class="font-medium mb-3">2. Biaya Kantor Sementara</h3>
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
                                @php $totalKantor = 0; @endphp
                                @foreach($lossReports as $lossItem)
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
                
                <!-- 3. Biaya Penggantian Arsip -->
                <div class="p-4">
                    <h3 class="font-medium mb-3">3. Biaya Penggantian Arsip</h3>
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
                                @php $totalArsip = 0; @endphp
                                @foreach($lossReports as $lossItem)
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
                    </div>
                </div>

                @php 
                    // Calculate totals
                    $totalLoss = $totalPuing + $totalKantor + $totalArsip;
                    $grandTotal = ($totalDamage ?? 0) + $totalLoss;
                @endphp
                
                <!-- Total Kerugian -->
                <div class="p-4 bg-gray-50 border-t">
                    <div class="text-right">
                        <h3 class="font-bold text-lg">TOTAL KERUGIAN: Rp {{ number_format($totalLoss, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        @endif

        <!-- III. RINGKASAN TOTAL -->
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
