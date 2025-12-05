@extends('layouts.main')

@section('content')
<style>
    /* Container & Layout */
    .page-container {
        padding: 20px;
    }

    /* Card Styling */
    .main-card {
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }

    /* Header Styling */
    .page-header {
        text-align: center;
        padding: 25px 20px;
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }

    .page-header h3 {
        margin: 0 0 10px 0;
        font-weight: bold;
        color: #F28705;
        font-size: 1.8rem;
    }

    .page-header p {
        margin: 0;
        color: #666;
        font-size: 1rem;
    }

    /* Alert Styling */
    .alert-info {
        background: #f9f9f9;
        border-left: 4px solid #F28705;
        color: #333;
        border-radius: 4px;
        padding: 15px 20px;
    }

    .alert-heading {
        color: #F28705 !important;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }

    .alert-info p {
        margin: 5px 0;
        line-height: 1.6;
        font-size: 14px;
    }

    /* Card Header */
    .card-header {
        background: #f9f9f9;
        color: #333;
        font-weight: 600;
        padding: 15px 20px;
        border-bottom: 2px solid #ddd;
    }

    .card-header h4 {
        margin: 0;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .card-body {
        padding: 20px;
    }

    /* Table Styling */
    .table {
        border: 1px solid #ddd;
        margin-bottom: 0;
        font-size: 14px;
    }

    .table thead th {
        background: #f9f9f9;
        color: #333;
        font-weight: 600;
        text-align: center;
        border-bottom: 2px solid #ddd;
        padding: 12px 10px;
    }

    .table tbody td {
        padding: 12px 10px;
        border: 1px solid #ddd;
        vertical-align: middle;
        text-align: center;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table tbody tr:hover {
        background-color: rgba(242, 135, 5, 0.08);
        transition: background-color 0.2s ease;
    }

    /* Button Styling */
    .btn {
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
        margin: 2px;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-primary {
        background: #F28705;
        color: white;
    }

    .btn-primary:hover {
        background: #d97604;
        color: white;
    }

    .btn-success {
        background: #28a745;
        color: white;
    }

    .btn-success:hover {
        background: #218838;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-container {
            padding: 10px;
        }

        .page-header h3 {
            font-size: 1.4rem;
        }

        .table {
            font-size: 12px;
        }

        .btn {
            padding: 6px 12px;
            font-size: 12px;
        }
    }
</style>

<div class="page-container">
    <!-- Page Header -->
    <div class="page-header">
        <h3>Kebutuhan Pascabencana</h3>
        <p>Pilih bencana untuk melihat data kerusakan dan kerugian</p>
    </div>

    <!-- Info Alert -->
    <div class="alert alert-info">
        <h5 class="alert-heading">Informasi</h5>
        <p>Untuk melihat data kerusakan dan kerugian, silakan pilih bencana dari daftar di bawah ini. Data akan menampilkan informasi dari berbagai formulir pendataan yang telah diisi.</p>
    </div>

    <!-- Data Table -->
    <div class="main-card">
        <div class="card-header">
            <h4>Daftar Bencana</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 15%;">Tanggal Kejadian</th>
                            <th style="width: 15%;">Kecamatan</th>
                            <th style="width: 15%;">Desa</th>
                            <th style="width: 15%;">Jenis Bencana</th>
                            <th style="width: 35%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bencanas as $index => $bencana)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ is_string($bencana->tanggal) ? $bencana->tanggal : $bencana->tanggal->format('d-m-Y') }}</td>
                            <td>{{ $bencana->kecamatan ?? $bencana->kecamatan_id }}</td>
                            <td>{{ $bencana->desa ?? $bencana->desa_id }}</td>
                            <td>{{ $bencana->jenis_bencana ?? ($bencana->kategori_bencana ? $bencana->kategori_bencana->nama_kategori : '-') }}</td>
                            <td>
                                <a href="{{ route('kebutuhan.show', $bencana->id) }}" class="btn btn-primary">
                                    Lihat Data
                                </a>
                                <a href="{{ route('kebutuhan.create', $bencana->id) }}" class="btn btn-success">
                                    Input Kebutuhan
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center" style="padding: 30px; color: #666;">
                                Tidak ada data bencana
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection