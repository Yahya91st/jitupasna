@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Data Format 4 - Sektor Perlindungan Sosial</h1>
    
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
    
    <div class="mb-4 flex justify-between">        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali
        </a>
        <a href="{{ route('forms.form4.format4form4-alt', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
            <i class="fa fa-plus mr-2"></i> Tambah Data Baru
        </a>
    </div>
    
    @if(count($facilityReports) > 0)
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Kerusakan Fasilitas Pelayanan Sosial</h2>
            <div class="overflow-x-auto">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Jenis Fasilitas</th>
                            <th>Rusak Berat</th>
                            <th>Rusak Sedang</th>
                            <th>Rusak Ringan</th>
                            <th>Total Biaya (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($facilityReports as $report)
                        @php
                            $data = json_decode($report->data);
                        @endphp
                        <tr>
                            <td>{{ $report->name }}</td>
                            <td>{{ $data->rusak_berat }}</td>
                            <td>{{ $data->rusak_sedang }}</td>
                            <td>{{ $data->rusak_ringan }}</td>
                            <td>{{ number_format($data->total_biaya, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($lossReport)
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Perkiraan Kerugian</h2>
            @php
                $lossData = json_decode($lossReport->data);
            @endphp
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="border p-4 rounded">
                    <h3 class="text-lg font-medium mb-3">Biaya Pembersihan Puing</h3>
                    <p>Tenaga Kerja: {{ $lossData->biaya_tenaga_kerja_hok ?? 0 }} HOK × Rp {{ number_format($lossData->biaya_tenaga_kerja_upah ?? 0, 0, ',', '.') }} = Rp {{ number_format($lossData->biaya_tenaga_kerja ?? 0, 0, ',', '.') }}</p>
                    <p>Alat Berat: {{ $lossData->biaya_alat_berat_hari ?? 0 }} Hari × Rp {{ number_format($lossData->biaya_alat_berat_harga ?? 0, 0, ',', '.') }} = Rp {{ number_format($lossData->biaya_alat_berat ?? 0, 0, ',', '.') }}</p>
                </div>
                
                <div class="border p-4 rounded">
                    <h3 class="text-lg font-medium mb-3">Kehilangan Pendapatan</h3>
                    <p>Rata-rata Pendapatan per Hari: Rp {{ number_format($lossData->pendapatan_perhari ?? 0, 0, ',', '.') }}</p>
                    <p>Lama Gangguan: {{ $lossData->lama_gangguan ?? 0 }} Hari</p>
                    <p>Total Kehilangan: Rp {{ number_format($lossData->biaya_kehilangan_pendapatan ?? 0, 0, ',', '.') }}</p>
                </div>
                
                <div class="border p-4 rounded">
                    <h3 class="text-lg font-medium mb-3">Biaya Penanganan</h3>
                    <p>Penanganan Korban Bencana: Rp {{ number_format($lossData->biaya_penanganan_korban ?? 0, 0, ',', '.') }}</p>
                    <p>Bantuan Logistik: Rp {{ number_format($lossData->biaya_logistik ?? 0, 0, ',', '.') }}</p>
                </div>
                
                <div class="border p-4 rounded">
                    <h3 class="text-lg font-medium mb-3">Pos Pelayanan Sementara</h3>
                    <p>Jumlah Pos: {{ $lossData->jumlah_pos ?? 0 }} Unit</p>
                    <p>Biaya Operasional per Hari: Rp {{ number_format($lossData->biaya_operasional_perhari ?? 0, 0, ',', '.') }}</p>
                    <p>Jangka Waktu: {{ $lossData->jangka_waktu ?? 0 }} Hari</p>
                    <p>Total Biaya: Rp {{ number_format($lossData->biaya_pos_pelayanan ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
            
            <div class="mt-6 bg-gray-100 p-4 rounded text-center">
                <h3 class="text-xl font-bold">Total Kerugian: Rp {{ number_format($lossData->total_biaya_kerugian ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
        @endif
        
        <!-- Summary -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Ringkasan</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $totalRB = $totalRS = $totalRR = $totalKerusakan = $totalKerugian = 0;
                    
                    // Calculate damage totals
                    foreach($facilityReports as $report) {
                        $data = json_decode($report->data);
                        $totalRB += $data->rusak_berat;
                        $totalRS += $data->rusak_sedang;
                        $totalRR += $data->rusak_ringan;
                        $totalKerusakan += $data->total_biaya;
                    }
                    
                    // Calculate loss total
                    if($lossReport) {
                        $lossData = json_decode($lossReport->data);
                        $totalKerugian = $lossData->total_biaya_kerugian ?? 0;
                    }
                    
                    $totalKeseluruhan = $totalKerusakan + $totalKerugian;
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
                    <h3 class="text-lg font-semibold text-blue-600">Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</h3>
                    <p class="text-sm text-gray-600">Total Biaya</p>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white p-8 rounded-lg shadow text-center">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-users fa-4x"></i>
            </div>            <h3 class="text-lg font-semibold mb-2">Belum Ada Data</h3>
            <p class="text-gray-600 mb-4">Belum ada data laporan perlindungan sosial untuk bencana ini.</p>
            <a href="{{ route('forms.form4.format4form4-alt', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                <i class="fa fa-plus mr-2"></i> Tambah Data Baru
            </a>
        </div>
    @endif
</div>
@endsection
