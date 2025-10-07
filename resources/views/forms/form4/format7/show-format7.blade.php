@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Detail Form Sektor Transportasi (Format 7)</h1>
    
    @if(session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="mb-4 flex justify-between">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali ke Form 4
        </a>
        <div class="flex gap-2">
            <a href="{{ route('forms.form4.format7.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
                <i class="fa fa-list mr-2"></i> Daftar Laporan
            </a>
            <a href="{{ route('forms.form4.format7.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-info">
                <i class="fa fa-plus mr-2"></i> Tambah Data Baru
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Sektor Transportasi</h6>
            <div class="btn-group">
                <a href="{{ route('forms.form4.format7.edit', $formTransportasi->id) }}" class="btn btn-sm btn-warning">
                    <i class="fa fa-edit mr-1"></i> Edit
                </a>
                <a href="{{ route('forms.form4.format7.pdf', $formTransportasi->id) }}" target="_blank" class="btn btn-sm btn-danger">
                    <i class="fa fa-file-pdf mr-1"></i> PDF
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light" style="width: 30%">Bencana</th>
                            <td>{{ $bencana->kategori_bencana->nama }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal</th>
                            <td>{{ $bencana->tanggal }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Kampung</th>
                            <td>{{ $formTransportasi->nama_kampung }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Distrik</th>
                            <td>{{ $formTransportasi->nama_distrik }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="font-weight-bold">Lokasi Bencana:</h6>
                            @if($bencana->desa && $bencana->desa->count() > 0)
                                <p class="mb-1">
                                    @foreach($bencana->desa as $desa)
                                        {{ $desa->nama }}@if(!$loop->last), @endif
                                    @endforeach
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Data Kerusakan Jalan -->
    @if($formTransportasi->jalan_ruas || $formTransportasi->jalan_jenis)
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="card-title mb-0">A. Kerusakan Jalan</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 20%">Nama Ruas Jalan</th>
                    <td>{{ $formTransportasi->jalan_ruas ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jenis Jalan</th>
                    <td>{{ $formTransportasi->jalan_jenis ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tipe Jalan</th>
                    <td>{{ $formTransportasi->jalan_tipe ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Rusak Berat</th>
                    <td>{{ $formTransportasi->jalan_rusak_berat ?? 0 }} unit</td>
                </tr>
                <tr>
                    <th>Rusak Sedang</th>
                    <td>{{ $formTransportasi->jalan_rusak_sedang ?? 0 }} unit</td>
                </tr>
                <tr>
                    <th>Rusak Ringan</th>
                    <td>{{ $formTransportasi->jalan_rusak_ringan ?? 0 }} unit</td>
                </tr>
                <tr>
                    <th>Harga Satuan</th>
                    <td>Rp {{ number_format($formTransportasi->jalan_harga_satuan ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Biaya Perbaikan</th>
                    <td>Rp {{ number_format($formTransportasi->jalan_biaya_perbaikan ?? 0, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    </div>
    @endif

    <!-- Data Kerusakan Jembatan -->
    @if($formTransportasi->jembatan_nama || $formTransportasi->jembatan_jenis)
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="card-title mb-0">B. Kerusakan Jembatan</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 20%">Nama Jembatan</th>
                    <td>{{ $formTransportasi->jembatan_nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jenis Jembatan</th>
                    <td>{{ $formTransportasi->jembatan_jenis ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tipe Jembatan</th>
                    <td>{{ $formTransportasi->jembatan_tipe ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Rusak Berat</th>
                    <td>{{ $formTransportasi->jembatan_rusak_berat ?? 0 }} unit</td>
                </tr>
                <tr>
                    <th>Rusak Sedang</th>
                    <td>{{ $formTransportasi->jembatan_rusak_sedang ?? 0 }} unit</td>
                </tr>
                <tr>
                    <th>Rusak Ringan</th>
                    <td>{{ $formTransportasi->jembatan_rusak_ringan ?? 0 }} unit</td>
                </tr>
                <tr>
                    <th>Harga Satuan</th>
                    <td>Rp {{ number_format($formTransportasi->jembatan_harga_satuan ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Biaya Perbaikan</th>
                    <td>Rp {{ number_format($formTransportasi->jembatan_biaya_perbaikan ?? 0, 0, ',', '.') }}</td>
                </tr>
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
    
</div>
@endsection
