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
                @if($reports->isEmpty())
                    <div class="alert alert-info">
                        Belum ada data laporan transportasi untuk bencana ini.
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
                                        <td>{{ number_format($report->total_kerusakan ?? 0, 2) }}</td>
                                        <td>{{ number_format($report->total_kerugian ?? 0, 2) }}</td>
                                        <td>
                                            <a href="{{ route('forms.form4.show-format7', $report->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i> Lihat</a>
                                            <a href="{{ route('forms.form4.edit-format7', $report->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Edit</a>
                                            <form action="{{ route('forms.form4.destroy-format7', $report->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                                            </form>
                                            <a href="{{ route('forms.form4.format7.pdf', $report->id) }}" class="btn btn-sm btn-secondary"><i class="bi bi-file-earmark-pdf"></i> PDF</a>
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
