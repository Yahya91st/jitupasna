@extends('layouts.main')

@section('content')
<style>
    /* Container & Layout */
    .detail-container {
        max-width: 1200px;
        font-family: 'Times New Roman', serif;
        margin: 0 auto;
        padding: 20px;
    }

    /* Card Styling */
    .main-card {
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }

    /* Header Styling */
    .card-header {
        background: #6c757d;
        color: white;
        padding: 15px 20px;
        border-bottom: none;
    }

    .card-header h4, .card-header h5 {
        margin: 0;
        font-weight: 600;
        color: white;
    }

    /* Section Headers */
    .section-header {
        background: #f9f9f9;
        color: #333;
        font-weight: 600;
        padding: 10px 15px;
        margin: 20px 0 15px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    /* Summary Cards */
    .summary-card {
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
        margin-bottom: 20px;
    }

    .summary-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    /* Table Styling */
    .table {
        border: 1px solid #ddd;
        margin-bottom: 1.5rem;
        font-size: 14px;
        border-radius: 4px;
        overflow: hidden;
    }

    .table td, .table th {
        padding: 8px 12px;
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

    .table tbody tr:hover {
        background-color: rgba(108, 117, 125, 0.05);
        transition: background-color 0.2s ease;
    }

    /* Button Styling */
    .btn {
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-orange {
        background: #F28705;
        color: white;
        border: none;
    }

    .btn-orange:hover {
        background: #e07404;
        color: white;
    }

    /* Orange variations for cards */
    .card-orange-1 { background: #F28705; }
    .card-orange-2 { background: #dc3545; }
    .card-orange-3 { background: #ffc107; }
    .card-orange-4 { background: #28a745; }
    .card-purple { background: #6f42c1; }
    .card-teal { background: #17a2b8; }
    .card-gray { background: #6c757d; }

    /* Form Group Styling */
    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .form-group p {
        color: #555;
        margin-bottom: 0;
        padding: 8px 0;
    }
    /* Container wrapper */
    .detail-wrapper {
        padding: 20px 0;
    }

    /* Breadcrumb styling */
    .breadcrumb-item a {
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: #5a6268 !important;
    }

    /* Badge styling */
    .badge {
        font-size: 12px;
        font-weight: 500;
        border-radius: 4px;
        padding: 4px 8px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .detail-container {
            padding: 10px;
        }
        
        .main-card {
            margin-bottom: 15px;
        }
        
        .card-body {
            padding: 15px !important;
        }
        
        .summary-card {
            margin-bottom: 15px;
        }
    }

    /* Breadcrumb styling */
    .breadcrumb-item a {
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: #e07404 !important;
    }

    /* Badge styling */
    .badge {
        font-size: 12px;
        font-weight: 500;
        border-radius: 4px;
        padding: 4px 8px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .detail-container {
            padding: 10px;
        }
        
        .main-card {
            margin-bottom: 15px;
        }
        
        .card-body {
            padding: 15px !important;
        }
    }
</style>

<div class="detail-container">
<div class="detail-wrapper">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 style="color: #6c757d; font-weight: 600;">Detail Data Kerusakan</h3>
                <p class="text-subtitle text-muted">Detail data kerusakan akibat bencana</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-md-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('kerusakan.list') }}" style="color: #6c757d;">Kerusakan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="main-card">
            <div class="card-header" style="background: #F28705;">
                <h4 class="card-title">Detail Bencana</h4>
            </div>
            <div class="card-body" style="padding: 20px;">
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
        
        <!-- Rekap Section -->
        <div class="main-card">
            <div class="card-header d-flex justify-content-between align-items-center" style="background: #F28705;">
                <h4 class="card-title">
                    <i class="fas fa-chart-pie me-2"></i>
                    Data Rekap Bencana
                    <small id="last-updated" class="text-white ms-2" style="opacity: 0.8;"></small>
                </h4>
                <div>
                    @if($rekaps->count() > 0)
                        <a href="{{ route('rekap.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-eye me-1"></i>Lihat Semua Rekap
                        </a>
                    @endif
                    <button id="sync-rekap-btn" class="btn btn-warning btn-sm" title="Sinkronisasi Data Rekap">
                        <i class="fas fa-sync-alt me-1"></i>Sync Data
                    </button>
                    <a href="{{ route('rekap.create', ['bencana_id' => $bencana->id]) }}" class="btn btn-sm" style="background: white; color: #F28705; border: 1px solid #F28705; font-weight: 500;">
                        <i class="fas fa-plus me-1"></i>Tambah Rekap
                    </a>
                </div>
            </div>
            <div class="card-body" style="padding: 20px;">
                @if($rekaps->count() > 0)
                    <!-- Rekap Summary Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card text-white mb-0 summary-card" style="background: #6c757d;">
                                <div class="card-body text-center py-3">
                                    <h4 class="mb-1">{{ $rekapSummary['total_rekaps'] }}</h4>
                                    <small>Total Rekap</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-0 summary-card" style="background: white; border: 2px solid #6c757d; color: #6c757d;">
                                <div class="card-body text-center py-3">
                                    <h4 class="mb-1">Rp {{ number_format($rekapSummary['total_kerusakan'], 0, ',', '.') }}</h4>
                                    <small>Total Kerusakan</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white mb-0 summary-card" style="background: #F28705;">
                                <div class="card-body text-center py-3">
                                    <h4 class="mb-1">Rp {{ number_format($rekapSummary['total_kerugian'], 0, ',', '.') }}</h4>
                                    <small>Total Kerugian</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-0 summary-card" style="background: white; border: 2px solid #F28705; color: #F28705;">
                                <div class="card-body text-center py-3">
                                    <h4 class="mb-1">{{ $rekapSummary['verified_rekaps'] }}</h4>
                                    <small>Verified</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rekap Table -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Lokasi</th>
                                <th>Format Terisi</th>
                                <th>Total Kerusakan</th>
                                <th>Total Kerugian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rekaps as $rekap)
                                <tr>
                                    <td>
                                        <strong>{{ $rekap->nama_kampung ?? '-' }}</strong><br>
                                        <small class="text-muted">{{ $rekap->nama_distrik ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $rekap->getFilledFormatsCount() }}/17
                                        </span>
                                    </td>
                                    <td>
                                        <strong>Rp {{ number_format($rekap->total_kerusakan, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <strong>Rp {{ number_format($rekap->total_kerugian, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = match($rekap->status) {
                                                'completed' => 'bg-success',
                                                'verified' => 'bg-info',
                                                default => 'bg-warning'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">
                                            {{ ucfirst($rekap->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('rekap.show', $rekap->id) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('rekap.edit', $rekap->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('rekap.pdf', $rekap->id) }}" class="btn btn-sm btn-outline-danger" title="PDF" target="_blank">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5>Belum ada data rekap</h5>
                        <p class="text-muted mb-3">Belum ada data rekap untuk bencana ini. Mulai dengan menambahkan rekap baru.</p>
                        <a href="{{ route('rekap.create', ['bencana_id' => $bencana->id]) }}" class="btn btn-orange" style="font-weight: 500;">
                            <i class="fas fa-plus me-1"></i>Tambah Rekap Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="main-card">
            <div class="card-header d-flex justify-content-between" style="background: #F28705;">
                <h4 class="card-title">Ringkasan Data Kerusakan</h4>
                <a href="{{ route('kerusakan.create', $bencana->id) }}" class="btn" style="background: white; color: #F28705; border: 1px solid white; font-weight: 500;">
                    <i data-feather="plus-circle"></i> Tambah Data Kerusakan
                </a>
            </div>
            <div class="card-body" style="padding: 20px;">
                <!-- Dashboard summary cards -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card text-white summary-card" style="background: #F28705;">
                            <div class="card-body">
                                <h5>Total Kerusakan</h5>
                                <h3>Rp {{ number_format($totalKerusakan ?? 0, 0, ',', '.') }}</h3>
                                <div class="progress progress-white mt-2" style="height: 10px;">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card summary-card" style="background: white; border: 2px solid #F28705; color: #F28705;">
                            <div class="card-body">
                                <h5>Jumlah Item Kerusakan</h5>
                                <h3>{{ $jumlahItem ?? 0 }} item</h3>
                                <div class="progress mt-2" style="height: 10px; background-color: #f8f9fa;">
                                    <div class="progress-bar" role="progressbar" style="width: 100%; background-color: #F28705;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kerusakan List -->
                <div class="main-card mb-4">
                    <div class="card-header" style="background: #F28705;">
                        <h5 class="card-title text-white">Daftar Kerusakan</h5>
                    </div>
                    <div class="card-body">
                        @if (count($kerusakanData ?? []) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Ref</th>
                                            <th>Kategori Bangunan</th>
                                            <th>Estimasi Biaya</th>
                                            <th>Detail</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kerusakanData as $kerusakan)
                                            <tr>
                                                <td>{{ $kerusakan->Ref }}</td>
                                                <td>{{ $kerusakan->kategori_bangunan->nama ?? 'Tidak ada kategori' }}</td>
                                                <td class="text-end">Rp {{ number_format($kerusakan->BiayaKeseluruhan ?? 0, 0, ',', '.') }}</td>
                                                <td>{{ Str::limit($kerusakan->deskripsi ?? 'Tidak ada deskripsi', 50) }}</td>
                                                <td>
                                                    <a href="{{ route('kerusakan.show', $kerusakan->id) }}" class="btn btn-sm btn-info" style="font-weight: 500;">
                                                        <i class="fa fa-eye"></i> Detail
                                                    </a>
                                                    <a href="{{ route('kerusakan.edit', $kerusakan->id) }}" class="btn btn-sm btn-warning">
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
                                <h5>Belum ada data kerusakan</h5>
                                <p class="text-muted mb-3">Tidak ada data kerusakan yang tersedia untuk bencana ini.</p>
                                <a href="{{ route('kerusakan.create', $bencana->id) }}" class="btn btn-orange" style="font-weight: 500;">
                                    <i class="fa fa-plus-circle mr-1"></i> Tambah Data Kerusakan
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                @if(count($kerusakanByKategori ?? []) > 0)
                <div class="main-card mb-4">
                    <div class="card-header" style="background: #F28705;">
                        <h5 class="card-title text-white">Kerusakan Berdasarkan Kategori</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="kerusakanChart"></canvas>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>
</div>

@if(count($kerusakanByKategori ?? []) > 0 || true)
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('kerusakanChart').getContext('2d');
        var categories = @json(array_keys($kerusakanByKategori ?? []));
        var values = @json(array_values($kerusakanByKategori ?? []));
        
        // Generate random colors for each category
        var backgroundColors = categories.map(function() {
            return 'rgba(' + Math.floor(Math.random() * 200) + ',' 
                          + Math.floor(Math.random() * 200) + ',' 
                          + Math.floor(Math.random() * 200) + ', 0.7)';
        });
        
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categories,
                datasets: [{
                    label: 'Nilai Kerusakan (Rp)',
                    data: values,
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors.map(color => color.replace('0.7', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                            }
                        }
                    }
                }
            }
        });    });

    // Sync rekap data
    function syncRekapData() {
        const syncBtn = document.getElementById('sync-rekap-btn');
        const originalHtml = syncBtn.innerHTML;
        
        syncBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Syncing...';
        syncBtn.disabled = true;
        
        fetch('{{ route("rekap.sync-all") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 3000,
                    showConfirmButton: false
                });
                
                // Refresh the page to show updated data
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: data.message || 'Gagal sinkronisasi data'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan saat sinkronisasi data'
            });
        })
        .finally(() => {
            syncBtn.innerHTML = originalHtml;
            syncBtn.disabled = false;
        });
    }
    
    // Event listeners
    document.getElementById('sync-rekap-btn').addEventListener('click', syncRekapData);
</script>
@endpush
@endif
@endsection
