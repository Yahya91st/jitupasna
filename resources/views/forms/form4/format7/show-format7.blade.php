@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Data Format 7 - Sektor Transportasi</h1>
    
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
        <a href="{{ route('forms.form4.format7form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
            <i class="fa fa-plus mr-2"></i> Tambah Data Baru
        </a>
    </div>
    
    @if($roadReports->count() > 0 || $bridgeReports->count() > 0 || $vehicleReports->count() > 0 || $infrastructureReports->count() > 0)
    
    <!-- Laporan Jalan -->
    @if($roadReports->count() > 0)
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Kerusakan Jalan</h2>
        <div class="overflow-x-auto">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Ruas Jalan</th>
                        <th>Status</th>
                        <th>Jenis</th>
                        <th>Rusak Berat</th>
                        <th>Rusak Sedang</th>
                        <th>Rusak Ringan</th>
                        <th>Harga Satuan</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roadReports as $report)
                    <tr>
                        <td>{{ $report->ruas_jalan }}</td>
                        <td>{{ $report->status_jalan }}</td>
                        <td>{{ $report->jenis_jalan }}</td>
                        <td>{{ $report->rusak_berat }}</td>
                        <td>{{ $report->rusak_sedang }}</td>
                        <td>{{ $report->rusak_ringan }}</td>
                        <td>Rp {{ number_format($report->harga_satuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($report->biaya_total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Laporan Jembatan -->
    @if($bridgeReports->count() > 0)
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Kerusakan Jembatan</h2>
        <div class="overflow-x-auto">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nama Jembatan</th>
                        <th>Status</th>
                        <th>Jenis</th>
                        <th>Rusak Berat</th>
                        <th>Rusak Sedang</th>
                        <th>Rusak Ringan</th>
                        <th>Harga Satuan</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bridgeReports as $report)
                    <tr>
                        <td>{{ $report->nama_jembatan }}</td>
                        <td>{{ $report->status_jembatan }}</td>
                        <td>{{ $report->jenis_jembatan }}</td>
                        <td>{{ $report->rusak_berat }}</td>
                        <td>{{ $report->rusak_sedang }}</td>
                        <td>{{ $report->rusak_ringan }}</td>
                        <td>Rp {{ number_format($report->harga_satuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($report->biaya_total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Laporan Kendaraan -->
    @if($vehicleReports->count() > 0)
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Kerusakan Kendaraan</h2>
        <div class="overflow-x-auto">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Jenis Kendaraan</th>
                        <th>Moda</th>
                        <th>Rusak Berat</th>
                        <th>Rusak Sedang</th>
                        <th>Rusak Ringan</th>
                        <th>Harga Satuan</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicleReports as $report)
                    <tr>
                        <td>{{ $report->jenis_kendaraan }}</td>
                        <td>{{ $report->moda }}</td>
                        <td>{{ $report->rusak_berat }}</td>
                        <td>{{ $report->rusak_sedang }}</td>
                        <td>{{ $report->rusak_ringan }}</td>
                        <td>Rp {{ number_format($report->harga_satuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($report->biaya_total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Laporan Prasarana -->
    @if($infrastructureReports->count() > 0)
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Kerusakan Prasarana</h2>
        <div class="overflow-x-auto">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Jenis Prasarana</th>
                        <th>Tipe</th>
                        <th>Luas</th>
                        <th>Rusak Berat</th>
                        <th>Rusak Sedang</th>
                        <th>Rusak Ringan</th>
                        <th>Harga Satuan</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($infrastructureReports as $report)
                    <tr>
                        <td>{{ $report->jenis_prasarana }}</td>
                        <td>{{ $report->tipe_prasarana }}</td>
                        <td>{{ $report->luas_prasarana }}</td>
                        <td>{{ $report->rusak_berat }}</td>
                        <td>{{ $report->rusak_sedang }}</td>
                        <td>{{ $report->rusak_ringan }}</td>
                        <td>Rp {{ number_format($report->harga_satuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($report->biaya_total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @else
    <div class="bg-white p-6 rounded-lg shadow text-center">
        <p>Belum ada data Format 7 - Transportasi yang disimpan untuk bencana ini.</p>
        <a href="{{ route('forms.form4.format7form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary mt-4">
            <i class="fa fa-plus mr-2"></i> Tambah Data Sekarang
        </a>
    </div>
    @endif
    
</div>
@endsection
