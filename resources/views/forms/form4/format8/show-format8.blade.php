@extends('layouts.main')

@section('content')
<style>
    .table th, .table td { padding: 0.5rem; }
    .btn { margin: 0.25rem; }
    h5 { text-align: center; margin-bottom: 1rem; }
</style>

<div class="container-fluid">
    <h5>Data Format 8 - Sektor Listrik</h5>
    
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

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Sektor Listrik</h6>
            <div class="btn-group">
                <a href="{{ route('forms.form4.format8.edit', $formListrik->id) }}" class="btn btn-sm btn-warning">
                    <i class="fa fa-edit mr-1"></i> Edit
                </a>
                <a href="{{ route('forms.form4.format8.pdf', $formListrik->id) }}" target="_blank" class="btn btn-sm btn-danger">
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
                            <td>{{ $formListrik->nama_kampung }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Distrik</th>
                            <td>{{ $formListrik->nama_distrik }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="font-weight-bold">Rekapitulasi:</h6>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <p class="mb-1">Total Kerusakan:</p>
                                    <h4 class="text-primary">Rp {{ number_format($formListrik->total_kerusakan, 0, ',', '.') }}</h4>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <p class="mb-1">Total Kerugian (Penurunan Pendapatan + Kenaikan Biaya):</p>
                                    <h4 class="text-danger">Rp {{ number_format(($formListrik->penurunan_pendapatan ?? 0) + ($formListrik->kenaikan_biaya_operasional ?? 0), 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Sektor Listrik -->
            <h5 class="font-weight-bold mt-4 mb-3">Detail Kerusakan dan Kerugian Sektor Listrik</h5>

            <!-- Sistem Transmisi dan Distribusi -->
            <div class="card mt-3">
                <div class="card-header bg-info text-white">
                    <h6 class="m-0">Sistem Transmisi dan Distribusi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th>Jenis</th>
                                    <th>Unit</th>
                                    <th>Harga Satuan (Rp)</th>
                                    <th>Total Kerusakan (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Kabel</td>
                                    <td class="text-center">{{ number_format($formListrik->kabel_unit ?? 0) }}</td>
                                    <td class="text-right">{{ number_format($formListrik->kabel_harga_satuan ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($formListrik->kabel_jumlah ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Tiang</td>
                                    <td class="text-center">{{ number_format($formListrik->tiang_unit ?? 0) }}</td>
                                    <td class="text-right">{{ number_format($formListrik->tiang_harga_satuan ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($formListrik->tiang_jumlah ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Trafo</td>
                                    <td class="text-center">{{ number_format($formListrik->trafo_unit ?? 0) }}</td>
                                    <td class="text-right">{{ number_format($formListrik->trafo_harga_satuan ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($formListrik->trafo_jumlah ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sistem Pembangkitan -->
            <div class="card mt-3">
                <div class="card-header bg-warning text-dark">
                    <h6 class="m-0">Sistem Pembangkitan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th>Jenis Pembangkit</th>
                                    <th>Unit</th>
                                    <th>Harga Satuan (Rp)</th>
                                    <th>Total Kerusakan (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PLTA</td>
                                    <td class="text-center">{{ number_format($formListrik->plta_unit ?? 0) }}</td>
                                    <td class="text-right">{{ number_format($formListrik->plta_harga_satuan ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($formListrik->plta_jumlah ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>PLTU</td>
                                    <td class="text-center">{{ number_format($formListrik->pltu_unit ?? 0) }}</td>
                                    <td class="text-right">{{ number_format($formListrik->pltu_harga_satuan ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($formListrik->pltu_jumlah ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>PLTD</td>
                                    <td class="text-center">{{ number_format($formListrik->pltd_unit ?? 0) }}</td>
                                    <td class="text-right">{{ number_format($formListrik->pltd_harga_satuan ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($formListrik->pltd_jumlah ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Pembangkit Lain</td>
                                    <td class="text-center">{{ number_format($formListrik->pembangkit_lain_unit ?? 0) }}</td>
                                    <td class="text-right">{{ number_format($formListrik->pembangkit_lain_harga_satuan ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($formListrik->pembangkit_lain_jumlah ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @if($formListrik->pembangkit_lain_keterangan)
                        <p class="mt-2"><strong>Keterangan Pembangkit Lain:</strong> {{ $formListrik->pembangkit_lain_keterangan }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h6 class="m-0">Perkiraan Jangka Waktu Pemulihan</h6>
                        </div>
                        <div class="card-body">
                            <p class="mb-1"><strong>Jangka Waktu:</strong></p>
                            <h5>{{ $formListrik->jangka_waktu_pemulihan_bulan ?? 0 }} Bulan</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <h6 class="m-0">Pembangkit Listrik Darurat</h6>
                        </div>
                        <div class="card-body">
                            <p class="mb-1"><strong>Genset Unit:</strong> {{ number_format($formListrik->genset_unit ?? 0) }}</p>
                            <p class="mb-1"><strong>Biaya Pengadaan:</strong> Rp {{ number_format($formListrik->genset_biaya_pengadaan ?? 0, 0, ',', '.') }}</p>
                            <p class="mb-1"><strong>Total Biaya Genset:</strong></p>
                            <h5>Rp {{ number_format($formListrik->biaya_genset_total ?? 0, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 mb-4">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali
        </a>
        <div>
            <a href="{{ route('forms.form4.format8.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-info me-2">
                Daftar Laporan
            </a>
            <a href="{{ route('forms.form4.format8.edit', $formListrik->id) }}" class="btn btn-warning me-2">
                Edit Data
            </a>
            <a href="{{ route('forms.form4.format8.pdf', $formListrik->id) }}" class="btn btn-primary" target="_blank">
                Unduh PDF
            </a>
        </div>
    </div>
</div>
@endsection
