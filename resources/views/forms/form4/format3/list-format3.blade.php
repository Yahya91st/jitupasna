@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Laporan Format 3 - Sektor Kesehatan</h3>
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
                <h4 class="card-title">Daftar Laporan Sektor Kesehatan</h4>                <a href="{{ route('forms.form4.format3form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Tambah Data Baru
                </a>
            </div>
            <div class="card-body">
                @if($healthReports->isEmpty())
                    <div class="alert alert-info">
                        Belum ada data laporan kesehatan untuk bencana ini.
                    </div>
                @else
                    <a href="{{ route('forms.form4.show-format3', $bencana->id) }}" class="btn btn-success mb-3">
                        <i class="bi bi-eye"></i> Lihat Laporan Lengkap
                    </a>
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
                            <thead>
                                <tr>
                                    <th>Jenis Fasilitas</th>
                                    <th>Nama Fasilitas</th>
                                    <th>Rusak Berat</th>
                                    <th>Rusak Sedang</th>
                                    <th>Rusak Ringan</th>
                                    <th>Kerusakan Lainnya</th>
                                    <th>Total Kerugian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($healthReports as $report)
                                    <tr>
                                        <td>{{ $report->jenis_fasilitas }}</td>
                                        <td>{{ $report->nama_fasilitas }}</td>                                        <td>{{ $report->rusak_berat }} unit</td>
                                        <td>{{ $report->rusak_sedang }} unit</td>
                                        <td>{{ $report->rusak_ringan }} unit</td>
                                        <td>{{ is_string($report->keterangan) ? $report->keterangan : '-' }}</td>
                                        <td>Rp. {{ number_format($report->total_biaya, 0, ',', '.') }}</td>
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
