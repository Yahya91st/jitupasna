@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Detail Form Sektor Ekonomi (Format 5)</h1>
    
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
            <a href="{{ route('forms.form4.list-format5', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
                <i class="fa fa-list mr-2"></i> Daftar Laporan
            </a>
            <a href="{{ route('forms.form4.format5form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-info">
                <i class="fa fa-plus mr-2"></i> Tambah Data Baru
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Sektor Ekonomi</h6>
            <div class="btn-group">
                <a href="{{ route('forms.form4.edit-format5', $report->id) }}" class="btn btn-sm btn-warning">
                    <i class="fa fa-edit mr-1"></i> Edit
                </a>
                <a href="{{ route('forms.form4.pdf-format5', $report->id) }}" target="_blank" class="btn btn-sm btn-danger">
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
                            <td>{{ $report->nama_kampung }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Distrik</th>
                            <td>{{ $report->nama_distrik }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="font-weight-bold">Rekapitulasi:</h6>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="mb-1">Total Kerusakan:</p>
                                    <h4 class="text-primary">Rp {{ number_format($report->total_kerusakan, 0, ',', '.') }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1">Total Kerugian:</p>
                                    <h4 class="text-danger">Rp {{ number_format($report->total_kerugian, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail data sesuai dengan struktur format5form4 -->
            <h5 class="font-weight-bold mt-4 mb-3">Detail Kerusakan dan Kerugian</h5>

            <!-- Tambahkan tabel-tabel sesuai dengan struktur format5form4 -->
            <!-- Contoh tabel untuk bagian tertentu, sesuaikan dengan struktur model Format5Form4 -->
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th rowspan="2">Jenis</th>
                            <th colspan="3">Kerusakan</th>
                            <th rowspan="2">Ukuran (m²)</th>
                            <th rowspan="2">Harga Satuan (Rp)</th>
                            <th rowspan="2">Nilai Kerusakan (Rp)</th>
                        </tr>
                        <tr class="text-center">
                            <th>Rusak Berat</th>
                            <th>Rusak Sedang</th>
                            <th>Rusak Ringan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sesuaikan dengan field model Format5Form4 -->
                        <!-- Data Toko -->
                        <tr>
                            <td>Toko/Kios/Ruko</td>
                            <td class="text-center">{{ number_format($report->toko_rb ?? 0) }}</td>
                            <td class="text-center">{{ number_format($report->toko_rs ?? 0) }}</td>
                            <td class="text-center">{{ number_format($report->toko_rr ?? 0) }}</td>
                            <td class="text-center">{{ number_format($report->toko_luas ?? 0) }}</td>
                            <td class="text-right">{{ number_format($report->toko_harga ?? 0, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format(($report->toko_rb * $report->toko_luas * $report->toko_harga) + 
                                ($report->toko_rs * $report->toko_luas * $report->toko_harga * 0.3) + 
                                ($report->toko_rr * $report->toko_luas * $report->toko_harga * 0.1), 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Tambahkan tabel kerugian dan informasi lainnya sesuai model -->
        </div>
    </div>
</div>
@endsection
