@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Laporan Format 7 - Transportasi</h3>
                <p class="text-subtitle text-muted">Daftar laporan untuk bencana {{ $bencana->kategori_bencana->nama }}</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="alert alert-light-primary color-primary">
        <p>Bencana: {{ $bencana->kategori_bencana->nama }}</p>
        <p>Tanggal: {{ $bencana->tanggal }}</p>
        <p>Lokasi: 
            @foreach($bencana->desa as $desa)
                {{ $desa->nama }}@if(!$loop->last), @endif
            @endforeach
        </p>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar Laporan Transportasi</h4>
                <a href="{{ route('forms.form4.format7form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Tambah Data Baru
                </a>
            </div>
            <div class="card-body">
                @if($transportationReports->isEmpty())
                    <div class="alert alert-info">
                        Belum ada data laporan transportasi untuk bencana ini.
                    </div>
                @else
                    <a href="{{ route('forms.form4.show-format7', $bencana->id) }}" class="btn btn-success mb-3">
                        <i class="bi bi-eye"></i> Lihat Laporan Lengkap
                    </a>
                    
                    <h5>Jalan</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
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
                                @foreach($transportationReports->where('report_type', 'jalan') as $report)
                                    <tr>
                                        <td>{{ $report->ruas_jalan }}</td>
                                        <td>{{ $report->status_jalan }}</td>
                                        <td>{{ $report->jenis_jalan }}</td>
                                        <td>{{ number_format($report->rusak_berat, 2) }} m²</td>
                                        <td>{{ number_format($report->rusak_sedang, 2) }} m²</td>
                                        <td>{{ number_format($report->rusak_ringan, 2) }} m²</td>
                                        <td>Rp. {{ number_format($report->harga_satuan) }}</td>
                                        <td>Rp. {{ number_format($report->biaya_total) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <h5 class="mt-4">Jembatan</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
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
                                @foreach($transportationReports->where('report_type', 'jembatan') as $report)
                                    <tr>
                                        <td>{{ $report->nama_jembatan }}</td>
                                        <td>{{ $report->status_jembatan }}</td>
                                        <td>{{ $report->jenis_jembatan }}</td>
                                        <td>{{ number_format($report->rusak_berat, 2) }} m²</td>
                                        <td>{{ number_format($report->rusak_sedang, 2) }} m²</td>
                                        <td>{{ number_format($report->rusak_ringan, 2) }} m²</td>
                                        <td>Rp. {{ number_format($report->harga_satuan) }}</td>
                                        <td>Rp. {{ number_format($report->biaya_total) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <h5 class="mt-4">Kendaraan</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
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
                                @foreach($transportationReports->where('report_type', 'kendaraan') as $report)
                                    <tr>
                                        <td>{{ $report->jenis_kendaraan }}</td>
                                        <td>{{ $report->moda }}</td>
                                        <td>{{ number_format($report->rusak_berat) }} unit</td>
                                        <td>{{ number_format($report->rusak_sedang) }} unit</td>
                                        <td>{{ number_format($report->rusak_ringan) }} unit</td>
                                        <td>Rp. {{ number_format($report->harga_satuan) }}</td>
                                        <td>Rp. {{ number_format($report->biaya_total) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </section>
    
    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Form 4
        </a>
    </div>
</div>
@endsection
