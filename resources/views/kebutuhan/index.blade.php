@extends('layouts.main')

@section('content')
<style>
    * {
        font-family: 'Times New Roman', Times, serif;
    }
    
    .main-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border: none;
        overflow: hidden;
    }
    
    .orange-header {
        background: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
        color: white;
        padding: 20px;
        margin: -1px -1px 20px -1px;
        border-radius: 15px 15px 0 0;
    }
    
    .orange-header h3 {
        margin: 0;
        font-weight: 600;
        font-size: 1.8rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .orange-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }
    
    .alert-info {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        border: none;
        color: white;
    }
    
    .alert-heading {
        color: white !important;
    }
    
    .table thead th {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
        border: none;
        padding: 15px 12px;
        font-weight: 600;
        text-align: center;
    }
    
    .table tbody tr {
        transition: all 0.3s ease;
    }
    
    .table tbody tr:hover {
        background-color: #fff8f0;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(242, 135, 5, 0.15);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
        border: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(242, 135, 5, 0.3);
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #e07600 0%, #f57c00 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(242, 135, 5, 0.4);
    }
    
    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    }
    
    .btn-success:hover {
        background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
    }
    
    .card-header {
        background: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
        color: white;
        border-bottom: none;
    }
    
    .card-header h4 {
        margin: 0;
        font-weight: 600;
    }
</style>

<div class="container-fluid">
<div class="main-card">
    <div class="orange-header">
        <h3>Kebutuhan Pascabencana</h3>
        <p class="text-subtitle">Pilih bencana untuk melihat data kerusakan dan kerugian</p>
    </div>

    <div style="padding: 20px;">
        <div class="card main-card mb-4">
            <div class="card-body">
                <div class="alert alert-info">
                    <h4 class="alert-heading"><i data-feather="info"></i> Informasi</h4>
                    <p>Untuk melihat data kerusakan dan kerugian, silakan pilih bencana dari daftar di bawah ini.</p>
                    <p>Data kerusakan dan kerugian akan menampilkan informasi dari berbagai formulir pendataan yang telah diisi.</p>
                </div>
            </div>
        </div>
        
        <div class="card main-card">
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
</div>
</div>
@endsection