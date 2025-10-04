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
            
            <!-- Detail Sektor Transportasi -->
            <h5 class="font-weight-bold mt-4 mb-3">Detail Kerusakan Sektor Transportasi</h5>

            <!-- Kerusakan Jalan -->
            <div class="card mt-3">
                <div class="card-header bg-primary text-white">
                    <h6 class="m-0">Kerusakan Jalan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Ruas Jalan:</strong> {{ $formTransportasi->jalan_ruas ?? 'Tidak diisi' }}</p>
                            <p class="mb-1"><strong>Jenis:</strong> {{ $formTransportasi->jalan_jenis ?? 'Tidak diisi' }}</p>
                            <p class="mb-1"><strong>Tipe:</strong> {{ $formTransportasi->jalan_tipe ?? 'Tidak diisi' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Rusak Berat:</strong> {{ $formTransportasi->jalan_rusak_berat ?? 0 }} unit</p>
                            <p class="mb-1"><strong>Rusak Sedang:</strong> {{ $formTransportasi->jalan_rusak_sedang ?? 0 }} unit</p>
                            <p class="mb-1"><strong>Rusak Ringan:</strong> {{ $formTransportasi->jalan_rusak_ringan ?? 0 }} unit</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Harga Satuan:</strong> Rp {{ number_format($formTransportasi->jalan_harga_satuan ?? 0, 0, ',', '.') }}</p>
                            <p class="mb-1"><strong>Biaya Perbaikan:</strong></p>
                            <h5 class="text-primary">Rp {{ number_format($formTransportasi->jalan_biaya_perbaikan ?? 0, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kerusakan Jembatan -->
            <div class="card mt-3">
                <div class="card-header bg-info text-white">
                    <h6 class="m-0">Kerusakan Jembatan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Nama Jembatan:</strong> {{ $formTransportasi->jembatan_nama ?? 'Tidak diisi' }}</p>
                            <p class="mb-1"><strong>Jenis:</strong> {{ $formTransportasi->jembatan_jenis ?? 'Tidak diisi' }}</p>
                            <p class="mb-1"><strong>Tipe:</strong> {{ $formTransportasi->jembatan_tipe ?? 'Tidak diisi' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Rusak Berat:</strong> {{ $formTransportasi->jembatan_rusak_berat ?? 0 }} unit</p>
                            <p class="mb-1"><strong>Rusak Sedang:</strong> {{ $formTransportasi->jembatan_rusak_sedang ?? 0 }} unit</p>
                            <p class="mb-1"><strong>Rusak Ringan:</strong> {{ $formTransportasi->jembatan_rusak_ringan ?? 0 }} unit</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Harga Satuan:</strong> Rp {{ number_format($formTransportasi->jembatan_harga_satuan ?? 0, 0, ',', '.') }}</p>
                            <p class="mb-1"><strong>Biaya Perbaikan:</strong></p>
                            <h5 class="text-info">Rp {{ number_format($formTransportasi->jembatan_biaya_perbaikan ?? 0, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <!-- Kerusakan Kendaraan -->
            <div class="card mt-3">
                <div class="card-header bg-warning text-dark">
                    <h6 class="m-0">Kerusakan Kendaraan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Sedan/Minibus</h6>
                            <p class="mb-1"><strong>Jumlah:</strong> {{ $formTransportasi->sedan_minibus_jumlah ?? 0 }}</p>
                            <p class="mb-1"><strong>Unit:</strong> {{ $formTransportasi->sedan_minibus_unit ?? 0 }}</p>
                            
                            <h6 class="mt-3">Bus/Truk</h6>
                            <p class="mb-1"><strong>Jumlah:</strong> {{ $formTransportasi->bus_truk_jumlah ?? 0 }}</p>
                            <p class="mb-1"><strong>Unit:</strong> {{ $formTransportasi->bus_truk_unit ?? 0 }}</p>
                            
                            <h6 class="mt-3">Kendaraan Berat</h6>
                            <p class="mb-1"><strong>Jumlah:</strong> {{ $formTransportasi->kendaraan_berat_jumlah ?? 0 }}</p>
                            <p class="mb-1"><strong>Unit:</strong> {{ $formTransportasi->kendaraan_berat_unit ?? 0 }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Kapal Laut</h6>
                            <p class="mb-1"><strong>Jumlah:</strong> {{ $formTransportasi->kapal_laut_jumlah ?? 0 }}</p>
                            <p class="mb-1"><strong>Unit:</strong> {{ $formTransportasi->kapal_laut_unit ?? 0 }}</p>
                            
                            <h6 class="mt-3">Bus Air</h6>
                            <p class="mb-1"><strong>Jumlah:</strong> {{ $formTransportasi->bus_air_jumlah ?? 0 }}</p>
                            <p class="mb-1"><strong>Unit:</strong> {{ $formTransportasi->bus_air_unit ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
