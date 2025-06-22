@extends('layouts.main')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Kebutuhan Pascabencana</h3>
            <p class="text-subtitle text-muted">Pilih bencana untuk melihat data kerusakan dan kerugian</p>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="alert alert-info">
                <h4 class="alert-heading"><i data-feather="info"></i> Informasi</h4>
                <p>Untuk melihat data kerusakan dan kerugian, silakan pilih bencana dari daftar di bawah ini.</p>
                <p>Data kerusakan dan kerugian akan menampilkan informasi dari berbagai formulir pendataan yang telah diisi.</p>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Bencana</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Kejadian</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>Jenis Bencana</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody> @forelse ($bencanas as $index => $bencana)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ is_string($bencana->tanggal) ? $bencana->tanggal : $bencana->tanggal->format('d-m-Y') }}</td>
                            <td>{{ $bencana->kecamatan ?? $bencana->kecamatan_id }}</td>
                            <td>{{ $bencana->desa ?? $bencana->desa_id }}</td>
                            <td>{{ $bencana->jenis_bencana ?? ($bencana->kategori_bencana ? $bencana->kategori_bencana->nama_kategori : '-') }}</td>                            <td>
                                <div class="buttons">
                                    <a href="{{ route('kebutuhan.show', $bencana->id) }}" class="btn btn-sm btn-primary">
                                        <i data-feather="bar-chart-2"></i> Lihat Kerusakan & Kerugian
                                    </a>
                                    <a href="{{ route('kebutuhan.create', $bencana->id) }}" class="btn btn-sm btn-success">
                                        <i data-feather="plus-circle"></i> Input Kebutuhan
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data bencana</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection