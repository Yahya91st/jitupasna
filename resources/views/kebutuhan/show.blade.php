@extends('layouts.main')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Detail Kebutuhan Pascabencana</h3>
            <p class="text-subtitle text-muted">Detail kebutuhan pascabencana</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-md-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('kebutuhan.index') }}">Kebutuhan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail Bencana</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal">Tanggal Kejadian</label>
                        <p>{{ is_string($bencana->tanggal) ? $bencana->tanggal : $bencana->tanggal->format('d-m-Y') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jenis_bencana">Jenis Bencana</label>
                        <p>{{ $bencana->jenis_bencana ?? ($bencana->kategori_bencana ? $bencana->kategori_bencana->nama_kategori : '-') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <p>{{ $bencana->kecamatan ?? $bencana->kecamatan_id }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="desa">Desa</label>
                        <p>{{ $bencana->desa ?? $bencana->desa_id }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Ringkasan Kerusakan & Kerugian</h4>
            <a href="{{ route('kebutuhan.create', $bencana->id) }}" class="btn btn-primary">
                <i data-feather="plus-circle"></i> Input Kebutuhan
            </a>
        </div>
        <div class="card-body">
            <!-- Dashboard summary cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5>Total Kerusakan</h5>
                            <h3>Rp {{ number_format($totals['kerusakan'], 0, ',', '.') }}</h3>
                            <div class="progress progress-white mt-2" style="height: 10px;">
                                @php
                                    $kerusakanPercentage = $totals['total'] > 0 ? ($totals['kerusakan'] / $totals['total'] * 100) : 0;
                                @endphp
                                <div class="progress-bar" role="progressbar" style="width: {{ $kerusakanPercentage }}%" aria-valuenow="{{ $kerusakanPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-white">{{ number_format($kerusakanPercentage, 1) }}% dari total</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5>Total Kerugian</h5>
                            <h3>Rp {{ number_format($totals['kerugian'], 0, ',', '.') }}</h3>
                            <div class="progress progress-white mt-2" style="height: 10px;">
                                @php
                                    $kerugianPercentage = $totals['total'] > 0 ? ($totals['kerugian'] / $totals['total'] * 100) : 0;
                                @endphp
                                <div class="progress-bar" role="progressbar" style="width: {{ $kerugianPercentage }}%" aria-valuenow="{{ $kerugianPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-white">{{ number_format($kerugianPercentage, 1) }}% dari total</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5>Total Keseluruhan</h5>
                            <h3>Rp {{ number_format($totals['total'], 0, ',', '.') }}</h3>
                            <div class="progress progress-white mt-2" style="height: 10px;">
                                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-white">100% nilai total dampak</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border">
                        <div class="card-header bg-light">
                            <h5 class="card-title">Rincian Kerusakan & Kerugian Berdasarkan Jenis</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Jenis</th>
                                            <th class="text-end">Nilai (Rp)</th>
                                            <th class="text-end">Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalValue = array_sum($breakdownByType);
                                        @endphp
                                        
                                        @foreach($breakdownByType as $type => $value)
                                            @php
                                                $percentage = $totalValue > 0 ? ($value / $totalValue * 100) : 0;
                                                
                                                // Define color based on type
                                                $typeLabels = [
                                                    'kerusakan_fisik' => ['label' => 'Kerusakan Fisik', 'color' => 'primary'],
                                                    'kerugian_ekonomi' => ['label' => 'Kerugian Ekonomi', 'color' => 'info'],
                                                    'kerusakan_lingkungan' => ['label' => 'Kerusakan Lingkungan', 'color' => 'success'],
                                                    'kerugian_lingkungan' => ['label' => 'Kerugian Lingkungan', 'color' => 'secondary'],
                                                    'kerusakan_infrastruktur' => ['label' => 'Kerusakan Infrastruktur', 'color' => 'warning'],
                                                    'kerugian_infrastruktur' => ['label' => 'Kerugian Infrastruktur', 'color' => 'danger']
                                                ];
                                            @endphp
                                            <tr>
                                                <td>
                                                    <span class="badge bg-{{ $typeLabels[$type]['color'] }}">
                                                        {{ $typeLabels[$type]['label'] }}
                                                    </span>
                                                </td>
                                                <td class="text-end">{{ number_format($value, 0, ',', '.') }}</td>
                                                <td class="text-end">{{ number_format($percentage, 2) }}%</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-dark">
                                            <th>TOTAL</th>
                                            <th class="text-end">{{ number_format($totalValue, 0, ',', '.') }}</th>
                                            <th class="text-end">100.00%</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Detailed Statistics Section -->
            <div class="card border">
                <div class="card-header bg-light">
                    <h5 class="card-title">Analisis Statistik Data Numerik</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs" id="statsTabs" role="tablist">
                                @php $activeFirst = true; @endphp
                                
                                @foreach($numericData as $tableName => $tableData)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $activeFirst ? 'active' : '' }}" 
                                                id="{{ $tableName }}-tab" 
                                                data-bs-toggle="tab" 
                                                data-bs-target="#{{ $tableName }}-content" 
                                                type="button" 
                                                role="tab" 
                                                aria-controls="{{ $tableName }}-content" 
                                                aria-selected="{{ $activeFirst ? 'true' : 'false' }}">
                                            {{ ucfirst(str_replace('_', ' ', $tableName)) }}
                                        </button>
                                    </li>
                                    @php $activeFirst = false; @endphp
                                @endforeach
                            </ul>
                            
                            <div class="tab-content mt-2" id="statsTabsContent">
                                @php $activeFirst = true; @endphp
                                
                                @foreach($numericData as $tableName => $tableData)
                                    <div class="tab-pane fade {{ $activeFirst ? 'show active' : '' }}" 
                                         id="{{ $tableName }}-content" 
                                         role="tabpanel" 
                                         aria-labelledby="{{ $tableName }}-tab">
                                        
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Kolom</th>
                                                        <th>Jumlah Data</th>
                                                        <th>Total</th>
                                                        <th>Rata-rata</th>
                                                        <th>Minimum</th>
                                                        <th>Maksimum</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($tableData as $columnName => $columnData)
                                                        <tr>
                                                            <td>
                                                                <strong>{{ ucfirst(str_replace('_', ' ', $columnName)) }}</strong>
                                                                <button class="btn btn-sm btn-outline-info" type="button" 
                                                                        data-bs-toggle="collapse" 
                                                                        data-bs-target="#details-{{ $tableName }}-{{ $columnName }}" 
                                                                        aria-expanded="false">
                                                                    Detail
                                                                </button>
                                                            </td>
                                                            <td>{{ number_format($columnData['stats']['count'], 0, ',', '.') }}</td>
                                                            <td>{{ number_format($columnData['stats']['sum'], 0, ',', '.') }}</td>
                                                            <td>{{ number_format($columnData['stats']['avg'], 2, ',', '.') }}</td>
                                                            <td>{{ number_format($columnData['stats']['min'], 0, ',', '.') }}</td>
                                                            <td>{{ number_format($columnData['stats']['max'], 0, ',', '.') }}</td>
                                                        </tr>
                                                        <tr class="collapse" id="details-{{ $tableName }}-{{ $columnName }}">
                                                            <td colspan="6">
                                                                <div class="p-3 bg-light">
                                                                    <h6>Data Detail {{ ucfirst(str_replace('_', ' ', $columnName)) }}</h6>
                                                                    <div class="table-responsive">
                                                                        <table class="table table-sm table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Deskripsi</th>
                                                                                    <th>Nilai</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($columnData['data'] as $item)
                                                                                    <tr>
                                                                                        <td>{{ $item['label'] }}</td>
                                                                                        <td class="text-end">{{ number_format($item['value'], 0, ',', '.') }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @php $activeFirst = false; @endphp
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion" id="damageAndLossAccordion">
                @if($kerusakan->count() > 0)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingKerusakan">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapseKerusakan" aria-expanded="true" 
                                aria-controls="collapseKerusakan">
                            Data Kerusakan ({{ $kerusakan->count() }} data)
                        </button>
                    </h2>
                    <div id="collapseKerusakan" class="accordion-collapse collapse show" 
                         aria-labelledby="headingKerusakan" data-bs-parent="#damageAndLossAccordion">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Deskripsi</th>
                                            <th>Kategori</th>
                                            <th class="text-end">Biaya (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kerusakan as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->deskripsi }}</td>
                                            <td>{{ $item->kategori_bangunan ? $item->kategori_bangunan->nama : '-' }}</td>
                                            <td class="text-end">{{ number_format($item->BiayaKeseluruhan, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end">Total:</th>
                                            <th class="text-end">{{ number_format($totals['kerusakan'], 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($kerugian->count() > 0)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingKerugian">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapseKerugian" aria-expanded="false" 
                                aria-controls="collapseKerugian">
                            Data Kerugian ({{ $kerugian->count() }} data)
                        </button>
                    </h2>
                    <div id="collapseKerugian" class="accordion-collapse collapse" 
                         aria-labelledby="headingKerugian" data-bs-parent="#damageAndLossAccordion">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Deskripsi</th>
                                            <th>Tipe</th>
                                            <th>Kuantitas</th>
                                            <th class="text-end">Biaya (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kerugian as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->deskripsi }}</td>
                                            <td>{{ $item->tipe }}</td>
                                            <td>{{ $item->kuantitas }}</td>
                                            <td class="text-end">{{ number_format($item->BiayaKeseluruhan, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-end">Total:</th>
                                            <th class="text-end">{{ number_format($totals['kerugian'], 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($environment->count() > 0)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingEnvironment">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapseEnvironment" aria-expanded="false" 
                                aria-controls="collapseEnvironment">
                            Data Kerusakan & Kerugian Lingkungan ({{ $environment->count() }} data)
                        </button>
                    </h2>
                    <div id="collapseEnvironment" class="accordion-collapse collapse" 
                         aria-labelledby="headingEnvironment" data-bs-parent="#damageAndLossAccordion">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis</th>
                                            <th>Lokasi</th>
                                            <th class="text-end">Kerusakan (Rp)</th>
                                            <th class="text-end">Kerugian (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($environment as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->jenis_lingkungan }}</td>
                                            <td>{{ $item->lokasi }}</td>
                                            <td class="text-end">{{ number_format($item->total_kerusakan, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($item->total_kerugian, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end">Total:</th>
                                            <th class="text-end">{{ number_format($totals['lingkungan']['damage'], 0, ',', '.') }}</th>
                                            <th class="text-end">{{ number_format($totals['lingkungan']['loss'], 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($government->count() > 0)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingGovernment">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapseGovernment" aria-expanded="false" 
                                aria-controls="collapseGovernment">
                            Data Kerusakan & Kerugian Fasilitas Pemerintah ({{ $government->count() }} data)
                        </button>
                    </h2>
                    <div id="collapseGovernment" class="accordion-collapse collapse" 
                         aria-labelledby="headingGovernment" data-bs-parent="#damageAndLossAccordion">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Fasilitas</th>
                                            <th>Tingkat Kerusakan</th>
                                            <th class="text-end">Kerusakan (Rp)</th>
                                            <th class="text-end">Kerugian (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($government as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->nama_fasilitas }}</td>
                                            <td>{{ $item->tingkat_kerusakan }}</td>
                                            <td class="text-end">{{ number_format($item->total_kerusakan, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($item->total_kerugian, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end">Total:</th>
                                            <th class="text-end">{{ number_format($totals['pemerintah']['damage'], 0, ',', '.') }}</th>
                                            <th class="text-end">{{ number_format($totals['pemerintah']['loss'], 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($perumahan->count() > 0)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPerumahan">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapsePerumahan" aria-expanded="false" 
                                aria-controls="collapsePerumahan">
                            Data Kerusakan & Kerugian Perumahan ({{ $perumahan->count() }} data)
                        </button>
                    </h2>
                    <div id="collapsePerumahan" class="accordion-collapse collapse" 
                         aria-labelledby="headingPerumahan" data-bs-parent="#damageAndLossAccordion">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Alamat</th>
                                            <th>Keterangan</th>
                                            <th class="text-end">Biaya (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perumahan as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td class="text-end">{{ number_format($item->biaya, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($pendataan)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPendataan">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapsePendataan" aria-expanded="false" 
                                aria-controls="collapsePendataan">
                            Data Form 3 - Pendataan
                        </button>
                    </h2>
                    <div id="collapsePendataan" class="accordion-collapse collapse" 
                         aria-labelledby="headingPendataan" data-bs-parent="#damageAndLossAccordion">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h5>Kerusakan dan Kerugian</h5>
                                    <p>{{ $pendataan->kerusakan_kerugian ?? 'Tidak ada data' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Gangguan Ekonomi Pertanian</h5>
                                    <p>{{ $pendataan->pertanian_gangguan_ekonomi ?? 'Tidak ada data' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Gangguan Ekonomi Non-pertanian</h5>
                                    <p>{{ $pendataan->nonpertanian_gangguan_ekonomi ?? 'Tidak ada data' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($fgd)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFgd">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapseFgd" aria-expanded="false" 
                                aria-controls="collapseFgd">
                            Data Form 7 - Penilaian Kualitatif
                        </button>
                    </h2>
                    <div id="collapseFgd" class="accordion-collapse collapse" 
                         aria-labelledby="headingFgd" data-bs-parent="#damageAndLossAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Kerusakan Infrastruktur</h5>
                                    <p>{{ $fgd->kerusakan_infrastruktur ?? 'Tidak ada data' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Kerugian Ekonomi</h5>
                                    <p>{{ $fgd->kerugian_ekonomi ?? 'Tidak ada data' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                @if(!$kerusakan->count() && !$kerugian->count() && !$environment->count() && !$government->count() && !$perumahan->count() && !$pendataan && !$fgd)
                <div class="alert alert-info">
                    <p class="mb-0">Data kerusakan dan kerugian untuk bencana ini belum tersedia.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Detailed Breakdown by Category -->
    @if(count($numericData) > 0)
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Perincian Data Dampak Bencana</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills mb-3" id="categoryTabs" role="tablist">
                        @php $firstActive = true; @endphp
                        
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $firstActive ? 'active' : '' }}" id="summary-tab" data-bs-toggle="pill"
                                data-bs-target="#summary" type="button" role="tab" aria-controls="summary"
                                aria-selected="{{ $firstActive ? 'true' : 'false' }}">Ringkasan</button>
                        </li>
                        @php $firstActive = false; @endphp
                        
                        @if(isset($numericData['kerusakan']) && count($numericData['kerusakan']) > 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="kerusakan-tab" data-bs-toggle="pill"
                                data-bs-target="#kerusakan-detail" type="button" role="tab" aria-controls="kerusakan-detail"
                                aria-selected="false">Kerusakan</button>
                        </li>
                        @endif
                        
                        @if(isset($numericData['kerugian']) && count($numericData['kerugian']) > 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="kerugian-tab" data-bs-toggle="pill"
                                data-bs-target="#kerugian-detail" type="button" role="tab" aria-controls="kerugian-detail"
                                aria-selected="false">Kerugian</button>
                        </li>
                        @endif
                        
                        @if(isset($numericData['detail_kerusakan']) && count($numericData['detail_kerusakan']) > 0)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="detail-kerusakan-tab" data-bs-toggle="pill"
                                data-bs-target="#detail-kerusakan" type="button" role="tab" aria-controls="detail-kerusakan"
                                aria-selected="false">Detail Kerusakan</button>
                        </li>
                        @endif
                    </ul>
                    
                    <div class="tab-content" id="categoryTabsContent">
                        <div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                            <div class="card border">
                                <div class="card-body">
                                    <h5>Rekapitulasi Dampak Bencana</h5>
                                    
                                    <!-- Summary chart - visualize the breakdown -->
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th>Kategori</th>
                                                            <th>Nilai (Rp)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Kerusakan Fisik</td>
                                                            <td>{{ number_format($totals['kerusakan'], 0, ',', '.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kerugian Ekonomi</td>
                                                            <td>{{ number_format($totals['kerugian'], 0, ',', '.') }}</td>
                                                        </tr>
                                                        @if($totals['lingkungan']['damage'] > 0)
                                                        <tr>
                                                            <td>Kerusakan Lingkungan</td>
                                                            <td>{{ number_format($totals['lingkungan']['damage'], 0, ',', '.') }}</td>
                                                        </tr>
                                                        @endif
                                                        @if($totals['lingkungan']['loss'] > 0)
                                                        <tr>
                                                            <td>Kerugian Lingkungan</td>
                                                            <td>{{ number_format($totals['lingkungan']['loss'], 0, ',', '.') }}</td>
                                                        </tr>
                                                        @endif
                                                        @if($totals['pemerintah']['damage'] > 0)
                                                        <tr>
                                                            <td>Kerusakan Infrastruktur</td>
                                                            <td>{{ number_format($totals['pemerintah']['damage'], 0, ',', '.') }}</td>
                                                        </tr>
                                                        @endif
                                                        @if($totals['pemerintah']['loss'] > 0)
                                                        <tr>
                                                            <td>Kerugian Infrastruktur</td>
                                                            <td>{{ number_format($totals['pemerintah']['loss'], 0, ',', '.') }}</td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="table-dark">
                                                            <th>TOTAL KESELURUHAN</th>
                                                            <th>{{ number_format($totals['total'], 0, ',', '.') }}</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Visualize with progress bars -->
                                            @foreach($breakdownByType as $type => $value)
                                                @php
                                                    $percentage = $totals['total'] > 0 ? ($value / $totals['total'] * 100) : 0;
                                                
                                                    // Define color based on type
                                                    $typeLabels = [
                                                        'kerusakan_fisik' => ['label' => 'Kerusakan Fisik', 'color' => 'primary'],
                                                        'kerugian_ekonomi' => ['label' => 'Kerugian Ekonomi', 'color' => 'info'],
                                                        'kerusakan_lingkungan' => ['label' => 'Kerusakan Lingkungan', 'color' => 'success'],
                                                        'kerugian_lingkungan' => ['label' => 'Kerugian Lingkungan', 'color' => 'secondary'],
                                                        'kerusakan_infrastruktur' => ['label' => 'Kerusakan Infrastruktur', 'color' => 'warning'],
                                                        'kerugian_infrastruktur' => ['label' => 'Kerugian Infrastruktur', 'color' => 'danger']
                                                    ];
                                                @endphp
                                                
                                                <div class="mb-3">
                                                    <label class="d-flex justify-content-between">
                                                        <span>{{ $typeLabels[$type]['label'] }}</span>
                                                        <span>{{ number_format($value, 0, ',', '.') }} ({{ number_format($percentage, 1) }}%)</span>
                                                    </label>
                                                    <div class="progress" style="height: 20px;">
                                                        <div class="progress-bar bg-{{ $typeLabels[$type]['color'] }}" 
                                                            role="progressbar" 
                                                            style="width: {{ $percentage }}%" 
                                                            aria-valuenow="{{ $percentage }}" 
                                                            aria-valuemin="0" 
                                                            aria-valuemax="100">
                                                            {{ number_format($percentage, 1) }}%
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if(isset($numericData['kerusakan']) && count($numericData['kerusakan']) > 0)
                        <div class="tab-pane fade" id="kerusakan-detail" role="tabpanel" aria-labelledby="kerusakan-tab">
                            <div class="card border">
                                <div class="card-body">
                                    <h5>Detail Data Kerusakan</h5>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Parameter</th>
                                                    <th>Nilai</th>
                                                    <th>Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($numericData['kerusakan'] as $columnName => $columnData)
                                                    <tr>
                                                        <td colspan="3" class="table-dark">
                                                            <strong>{{ ucfirst(str_replace('_', ' ', $columnName)) }}</strong>
                                                        </td>
                                                    </tr>
                                                    @foreach($columnData['data'] as $item)
                                                        @php
                                                            $percentage = $columnData['stats']['sum'] > 0 ? 
                                                                ($item['value'] / $columnData['stats']['sum'] * 100) : 0;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $item['label'] }}</td>
                                                            <td>{{ number_format($item['value'], 0, ',', '.') }}</td>
                                                            <td>
                                                                {{ number_format($percentage, 2) }}%
                                                                <div class="progress" style="height: 5px;">
                                                                    <div class="progress-bar bg-primary" 
                                                                         role="progressbar" 
                                                                         style="width: {{ $percentage }}%" 
                                                                         aria-valuenow="{{ $percentage }}" 
                                                                         aria-valuemin="0" 
                                                                         aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="table-secondary">
                                                        <td><strong>Total</strong></td>
                                                        <td><strong>{{ number_format($columnData['stats']['sum'], 0, ',', '.') }}</strong></td>
                                                        <td><strong>100%</strong></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if(isset($numericData['kerugian']) && count($numericData['kerugian']) > 0)
                        <div class="tab-pane fade" id="kerugian-detail" role="tabpanel" aria-labelledby="kerugian-tab">
                            <div class="card border">
                                <div class="card-body">
                                    <h5>Detail Data Kerugian</h5>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Parameter</th>
                                                    <th>Nilai</th>
                                                    <th>Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($numericData['kerugian'] as $columnName => $columnData)
                                                    <tr>
                                                        <td colspan="3" class="table-dark">
                                                            <strong>{{ ucfirst(str_replace('_', ' ', $columnName)) }}</strong>
                                                        </td>
                                                    </tr>
                                                    @foreach($columnData['data'] as $item)
                                                        @php
                                                            $percentage = $columnData['stats']['sum'] > 0 ? 
                                                                ($item['value'] / $columnData['stats']['sum'] * 100) : 0;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $item['label'] }}</td>
                                                            <td>{{ number_format($item['value'], 0, ',', '.') }}</td>
                                                            <td>
                                                                {{ number_format($percentage, 2) }}%
                                                                <div class="progress" style="height: 5px;">
                                                                    <div class="progress-bar bg-info" 
                                                                         role="progressbar" 
                                                                         style="width: {{ $percentage }}%" 
                                                                         aria-valuenow="{{ $percentage }}" 
                                                                         aria-valuemin="0" 
                                                                         aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="table-secondary">
                                                        <td><strong>Total</strong></td>
                                                        <td><strong>{{ number_format($columnData['stats']['sum'], 0, ',', '.') }}</strong></td>
                                                        <td><strong>100%</strong></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if(isset($numericData['detail_kerusakan']) && count($numericData['detail_kerusakan']) > 0)
                        <div class="tab-pane fade" id="detail-kerusakan" role="tabpanel" aria-labelledby="detail-kerusakan-tab">
                            <div class="card border">
                                <div class="card-body">
                                    <h5>Detail Rincian Kerusakan</h5>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Nilai</th>
                                                    <th>Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $totalDetailKerusakan = 0;
                                                    foreach($numericData['detail_kerusakan'] as $columnName => $columnData) {
                                                        $totalDetailKerusakan += $columnData['stats']['sum'];
                                                    }
                                                @endphp
                                                
                                                @foreach($numericData['detail_kerusakan'] as $columnName => $columnData)
                                                    <tr>
                                                        <td colspan="3" class="table-dark">
                                                            <strong>{{ ucfirst(str_replace('_', ' ', $columnName)) }}</strong>
                                                        </td>
                                                    </tr>
                                                    @foreach($columnData['data'] as $item)
                                                        @php
                                                            $percentage = $columnData['stats']['sum'] > 0 ? 
                                                                ($item['value'] / $columnData['stats']['sum'] * 100) : 0;
                                                            
                                                            $overallPercentage = $totalDetailKerusakan > 0 ?
                                                                ($item['value'] / $totalDetailKerusakan * 100) : 0;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $item['label'] }}</td>
                                                            <td>{{ number_format($item['value'], 0, ',', '.') }}</td>
                                                            <td>
                                                                {{ number_format($percentage, 2) }}% ({{ number_format($overallPercentage, 2) }}% dari total)
                                                                <div class="progress" style="height: 5px;">
                                                                    <div class="progress-bar bg-warning" 
                                                                         role="progressbar" 
                                                                         style="width: {{ $percentage }}%" 
                                                                         aria-valuenow="{{ $percentage }}" 
                                                                         aria-valuemin="0" 
                                                                         aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="table-secondary">
                                                        <td><strong>Total {{ ucfirst(str_replace('_', ' ', $columnName)) }}</strong></td>
                                                        <td><strong>{{ number_format($columnData['stats']['sum'], 0, ',', '.') }}</strong></td>
                                                        <td>
                                                            <strong>
                                                                @php
                                                                    $columnPercentage = $totalDetailKerusakan > 0 ?
                                                                        ($columnData['stats']['sum'] / $totalDetailKerusakan * 100) : 0;
                                                                @endphp
                                                                {{ number_format($columnPercentage, 2) }}% dari total kerusakan
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="table-dark">
                                                    <th>TOTAL KESELURUHAN</th>
                                                    <th>{{ number_format($totalDetailKerusakan, 0, ',', '.') }}</th>
                                                    <th>100%</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add any special scripts needed for the enhanced views here
        
        // Function to toggle all details sections at once
        const toggleAllDetails = (show) => {
            document.querySelectorAll('[id^="details-"]').forEach(element => {
                if (show) {
                    element.classList.add('show');
                } else {
                    element.classList.remove('show');
                }
            });
        };
        
        // Add toggle buttons if needed
    });
</script>
@endpush