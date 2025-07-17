@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Laporan Format 13 - Sektor Industri & UMKM</h3>
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
                <h4 class="card-title">Daftar Laporan Sektor Industri & UMKM</h4>
                <a href="{{ route('forms.form4.format13form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Tambah Data Baru
                </a>
            </div>
            <div class="card-body">
                @if($reports->isEmpty())
                    <div class="alert alert-info">
                        Belum ada data laporan sektor industri & UMKM untuk bencana ini.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kampung</th>
                                    <th>Nama Distrik</th>
                                    <th>Total Kerusakan</th>
                                    <th>Total Kerugian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $index => $report)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $report->nama_kampung }}</td>
                                        <td>{{ $report->nama_distrik }}</td>
                                        <td>Rp. {{ number_format($report->total_kerusakan ?? 0, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($report->total_kerugian ?? 0, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('forms.form4.show-format13', $report->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                            <a href="{{ route('forms.form4.edit-format13', $report->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('forms.form4.destroy-format13', $report->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            @if(Route::has('forms.form4.format13.pdf'))
                                                <a href="{{ route('forms.form4.format13.pdf', $report->id) }}" class="btn btn-secondary btn-sm">PDF</a>
                                            @else
                                                <a href="#" class="btn btn-secondary btn-sm disabled">PDF</a>
                                            @endif
                                        </td>
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
