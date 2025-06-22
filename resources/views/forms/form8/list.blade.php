@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Penilaian Kerusakan dan Kerugian</h3>
                <p class="text-subtitle text-muted">Daftar data pengolahan dan analisis penilaian kerusakan dan kerugian</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-md-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Formulir 08</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="alert alert-light-primary color-primary">
                <p><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama }}</p>
                <p><strong>Tanggal:</strong> {{ $bencana->tanggal }}</p>
                <p><strong>Lokasi:</strong> 
                    @foreach($bencana->desa as $desa)
                        {{ $desa->nama }}@if(!$loop->last), @endif
                    @endforeach
                </p>
            </div>
        </div>
    </div>    <div class="mb-4">
        <a href="{{ route('forms.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Daftar Data Penilaian</h4>
            <a href="{{ route('forms.form8.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                <i class="bi bi-plus"></i> Tambah Data Baru
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Sektor/Sub Sektor</th>
                            <th>Lokasi</th>
                            <th>Total Kerusakan dan Kerugian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($formData) > 0)
                            @foreach($formData as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->sektor }} / {{ $item->sub_sektor }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>Rp {{ number_format($item->total_kerusakan_kerugian, 0, ',', '.') }}</td>                                <td>
                                    <div class="btn-group" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 4px;">
                                        <a href="{{ route('forms.form8.show', $item->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('forms.form8.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <a href="{{ route('forms.form8.preview-pdf', $item->id) }}" class="btn btn-sm btn-secondary" title="Preview PDF" target="_blank">
                                            <i class="bi bi-file-pdf"></i> Lihat PDF
                                        </a>
                                        <a href="{{ route('forms.form8.pdf', $item->id) }}" class="btn btn-sm btn-primary" title="Download PDF" target="_blank">
                                            <i class="bi bi-download"></i> Unduh PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data penilaian</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
