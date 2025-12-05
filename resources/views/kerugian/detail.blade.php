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

    /* Page Header */
    .page-header {
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 1.5rem;
    }

    .page-header h3 {
        margin: 0 0 5px 0;
        font-weight: bold;
        color: #F28705;
        font-size: 1.6rem;
    }

    .page-header p {
        margin: 0;
        color: #666;
    }

    /* Breadcrumb */
    .breadcrumb {
        background: transparent;
        margin: 10px 0 0 0;
        padding: 0;
    }

    .breadcrumb-item a {
        color: #F28705;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    .breadcrumb-item.active {
        color: #666;
    }

    /* Card Header */
    .card-header {
        background: #f9f9f9;
        color: #333;
        font-weight: 600;
        padding: 15px 20px;
        border-bottom: 2px solid #ddd;
    }

    .card-header h4, .card-header h5 {
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .card-body {
        padding: 20px;
    }

    /* Summary Cards */
    .summary-card {
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
        margin-bottom: 1rem;
    }

    .summary-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    /* Table Styling */
    .table {
        border: 1px solid #ddd;
        margin-bottom: 0;
        font-size: 14px;
    }

    .table td, .table th {
        padding: 10px 12px;
        border: 1px solid #ddd;
        vertical-align: middle;
    }

    .table thead th {
        background: #f9f9f9;
        color: #333;
        font-weight: 600;
        text-align: center;
        border-bottom: 2px solid #ddd;
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
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
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

    .btn-warning {
        background: #ffc107;
        color: #212529;
    }

    .btn-warning:hover {
        background: #e0a800;
    }

    /* Form Group */
    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .form-group p {
        color: #666;
        margin-bottom: 0;
        padding: 8px 0;
        font-size: 14px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-container {
            padding: 10px;
        }
        
        .page-header h3 {
            font-size: 1.3rem;
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
        <div class="row">
            <div class="col-12 col-md-8">
                <h3>Detail Data Kerugian</h3>
                <p>Detail data kerugian akibat bencana</p>
            </div>
            <div class="col-12 col-md-4">
                <nav aria-label="breadcrumb" class="float-start float-md-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('kerugian.list') }}">Kerugian</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Detail Bencana -->
    <div class="main-card">
        <div class="card-header">
            <h4>Detail Bencana</h4>
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
                        <p>{{ $bencana->kategori_bencana ? $bencana->kategori_bencana->nama : '-' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kecamatan">Lokasi</label>
                        <p>
                            @foreach ($bencana->desa as $desa)
                                {{ $desa->nama }}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ref">Referensi</label>
                        <p>{{ $bencana->Ref }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="main-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Ringkasan Data Kerugian</h4>
            <a href="{{ route('kerugian.create', $bencana->id) }}" class="btn btn-success">
                Tambah Data Kerugian
            </a>
        </div>
        <div class="card-body">
            <!-- Summary Cards -->
            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <div class="card text-white summary-card" style="background: #F28705;">
                        <div class="card-body text-center py-3">
                            <h5 class="mb-2">Total Kerugian</h5>
                            <h3 class="mb-0">Rp {{ number_format($totalKerugian ?? 0, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="card summary-card" style="background: #28a745; color: white;">
                        <div class="card-body text-center py-3">
                            <h5 class="mb-2">Jumlah Sektor Terdampak</h5>
                            <h3 class="mb-0">{{ $jumlahSektor ?? 0 }} sektor</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Table -->
            <div class="main-card mb-3">
                <div class="card-header">
                    <h5>Daftar Kerugian</h5>
                </div>
                <div class="card-body">
                    @if (count($kerugianData ?? []) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ref</th>
                                        <th>Sektor Terdampak</th>
                                        <th>Kuantitas</th>
                                        <th>Nilai Kerugian</th>
                                        <th>Detail</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kerugianData as $kerugian)
                                        <tr>
                                            <td>{{ $kerugian->Ref }}</td>
                                            <td>
                                                @if ($kerugian->tipe == 1)
                                                    Pariwisata
                                                @elseif ($kerugian->tipe == 2)
                                                    Pertanian
                                                @elseif ($kerugian->tipe == 3)
                                                    Transportasi
                                                @else
                                                    Lainnya
                                                @endif
                                            </td>
                                            <td>{{ $kerugian->kuantitas }} {{ optional($kerugian->satuan)->nama ?? '' }}</td>
                                            <td style="text-align: right;">Rp {{ number_format($kerugian->BiayaKeseluruhan ?? 0, 0, ',', '.') }}</td>
                                            <td>{{ Str::limit($kerugian->deskripsi ?? 'Tidak ada deskripsi', 50) }}</td>
                                            <td style="text-align: center;">
                                                <a href="{{ route('kerugian.edit', $kerugian->id) }}" class="btn btn-warning">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <h5 class="text-muted">Belum ada data kerugian</h5>
                            <p class="text-muted">Tidak ada data kerugian yang tersedia untuk bencana ini.</p>
                            <a href="{{ route('kerugian.create', $bencana->id) }}" class="btn btn-primary">
                                Tambah Data Kerugian
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Chart -->
            @if(count($kerugianBySektor ?? []) > 0)
            <div class="main-card">
                <div class="card-header">
                    <h5>Kerugian Berdasarkan Sektor</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:300px;">
                        <canvas id="kerugianChart"></canvas>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@if(count($kerugianBySektor ?? []) > 0)
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('kerugianChart').getContext('2d');
        var categories = @json(array_keys($kerugianBySektor ?? []));
        var values = @json(array_values($kerugianBySektor ?? []));
        
        // Generate colors for each sector
        var backgroundColors = [
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 99, 132, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)'
        ];
        
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: categories,
                datasets: [{
                    data: values,
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors.map(color => color.replace('0.7', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                var value = 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                return label + ': ' + value;
                            }
                        }
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>
@endpush
@endif
@endsection
