@extends('layouts.main')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Detail Data Kerugian</h3>
            <p class="text-subtitle text-muted">Detail data kerugian akibat bencana</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-md-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('kerugian.list') }}">Kerugian</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail Bencana</h4>
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
    
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Ringkasan Data Kerugian</h4>
            <a href="{{ route('kerugian.create', $bencana->id) }}" class="btn btn-primary">
                <i data-feather="plus-circle"></i> Tambah Data Kerugian
            </a>
        </div>
        <div class="card-body">
            <!-- Dashboard summary cards -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5>Total Kerugian</h5>
                            <h3>Rp {{ number_format($totalKerugian ?? 0, 0, ',', '.') }}</h3>
                            <div class="progress progress-white mt-2" style="height: 10px;">
                                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5>Jumlah Sektor Terdampak</h5>
                            <h3>{{ $jumlahSektor ?? 0 }} sektor</h3>
                            <div class="progress progress-white mt-2" style="height: 10px;">
                                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kerugian List -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="card-title">Daftar Kerugian</h5>
                </div>
                <div class="card-body">
                    @if (count($kerugianData ?? []) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-light">
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
                                            <td class="text-end">Rp {{ number_format($kerugian->BiayaKeseluruhan ?? 0, 0, ',', '.') }}</td>
                                            <td>{{ Str::limit($kerugian->deskripsi ?? 'Tidak ada deskripsi', 50) }}</td>
                                            <td>
                                                <a href="{{ route('kerugian.edit', $kerugian->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center p-4">
                            <img src="{{ asset('frontend/dist/assets/images/no-data.svg') }}" alt="No Data" class="img-fluid mb-3" style="max-height: 150px;">
                            <h5>Belum ada data kerugian</h5>
                            <p class="text-muted mb-3">Tidak ada data kerugian yang tersedia untuk bencana ini.</p>
                            <a href="{{ route('kerugian.create', $bencana->id) }}" class="btn btn-primary">
                                <i class="fa fa-plus-circle mr-1"></i> Tambah Data Kerugian
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Category breakdown -->
            @if(count($kerugianBySektor ?? []) > 0)
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="card-title">Kerugian Berdasarkan Sektor</h5>
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
</section>

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
