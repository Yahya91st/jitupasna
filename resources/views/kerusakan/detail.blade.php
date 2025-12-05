@extends('layouts.main')

@section('content')
<style>
    .page-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .page-header h2 {
        color: #F28705;
        font-weight: 600;
        margin: 0;
    }

    .page-header p {
        color: #666;
        margin-top: 5px;
    }

    .breadcrumb {
        display: flex;
        justify-content: center;
        background: transparent;
        padding: 10px 0;
        margin: 0;
    }

    .breadcrumb-item a {
        color: #F28705;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: #d97604;
        text-decoration: underline;
    }

    .breadcrumb-item.active {
        color: #666;
    }

    .main-card {
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .card-header {
        background: #f9f9f9;
        padding: 15px 20px;
        border-bottom: 1px solid #ddd;
    }

    .card-header h4,
    .card-header h5 {
        margin: 0;
        color: #333;
        font-weight: 600;
    }

    .card-body {
        padding: 20px;
    }

    .summary-card {
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        margin-bottom: 20px;
    }

    .summary-card h4,
    .summary-card h5 {
        color: #333;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .summary-card h3 {
        color: #F28705;
        font-weight: 700;
        margin: 0;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }

    .table th,
    .table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .table th {
        background: #f9f9f9;
        font-weight: 600;
        color: #333;
    }

    .table tbody tr:nth-child(even) {
        background: #f9f9f9;
    }

    .table tbody tr:hover {
        background: rgba(242, 135, 5, 0.08);
    }

    .btn {
        display: inline-block;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
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

    .btn-warning {
        background: #ffc107;
        color: #333;
    }

    .btn-warning:hover {
        background: #e0a800;
        color: #333;
    }

    .btn-light {
        background: #F28705;
        color: white;
        border: 1px solid #F28705;
    }

    .btn-light:hover {
        background: #d97604;
        color: white;
    }

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

    .badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .text-end {
        text-align: right;
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 10px;
        }

        .table th,
        .table td {
            padding: 8px 10px;
            font-size: 13px;
        }
    }
</style>

<div class="page-container">
    <div class="page-header">
        <h2>Detail Data Kerusakan</h2>
        <p>Detail data kerusakan akibat bencana</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kerusakan.list') }}">Kerusakan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>

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
            <h4>Data Rekap Bencana</h4>
            <div>
                    @if($rekaps->count() > 0)
                        <a href="{{ route('rekap.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-light btn-sm">
                            Lihat Semua
                        </a>
                    @endif
                    <button id="sync-rekap-btn" class="btn btn-warning btn-sm" title="Sinkronisasi Data Rekap">
                        Sync Data
                    </button>
                    <a href="{{ route('rekap.create', ['bencana_id' => $bencana->id]) }}" class="btn btn-light btn-sm">
                        Tambah Rekap
                    </a>
                </div>
            </div>
        <div class="card-body">
            @if($rekaps->count() > 0)
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="summary-card">
                            <h5>Total Rekap</h5>
                            <h3>{{ $rekapSummary['total_rekaps'] }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="summary-card">
                            <h5>Total Kerusakan</h5>
                            <h3>Rp {{ number_format($rekapSummary['total_kerusakan'], 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="summary-card">
                            <h5>Total Kerugian</h5>
                            <h3>Rp {{ number_format($rekapSummary['total_kerugian'], 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="summary-card">
                            <h5>Verified</h5>
                            <h3>{{ $rekapSummary['verified_rekaps'] }}</h3>
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
                                        <a href="{{ route('rekap.show', $rekap->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                        <a href="{{ route('rekap.edit', $rekap->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="{{ route('rekap.pdf', $rekap->id) }}" class="btn btn-sm btn-primary" target="_blank">PDF</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <h5>Belum ada data rekap</h5>
                    <p class="text-muted mb-3">Belum ada data rekap untuk bencana ini.</p>
                    <a href="{{ route('rekap.create', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                        Tambah Rekap Pertama
                    </a>
                </div>
            @endif
            </div>
        </div>
        
    <div class="main-card">
        <div class="card-header d-flex justify-content-between">
            <h4>Ringkasan Data Kerusakan</h4>
            <a href="{{ route('kerusakan.create', $bencana->id) }}" class="btn btn-light">
                Tambah Data Kerusakan
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="summary-card">
                        <h5>Total Kerusakan</h5>
                        <h3>Rp {{ number_format($totalKerusakan ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="summary-card">
                        <h5>Jumlah Item Kerusakan</h5>
                        <h3>{{ $jumlahItem ?? 0 }} item</h3>
                    </div>
                </div>
            </div>

            <div class="main-card mb-4">
                <div class="card-header">
                    <h5>Daftar Kerusakan</h5>
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
                                                    <a href="{{ route('kerusakan.show', $kerusakan->id) }}" class="btn btn-sm btn-primary">
                                                        Detail
                                                    </a>
                                                    <a href="{{ route('kerusakan.edit', $kerusakan->id) }}" class="btn btn-sm btn-warning">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    @else
                        <div class="text-center p-4">
                            <h5>Belum ada data kerusakan</h5>
                            <p class="text-muted mb-3">Tidak ada data kerusakan yang tersedia untuk bencana ini.</p>
                            <a href="{{ route('kerusakan.create', $bencana->id) }}" class="btn btn-primary">
                                Tambah Data Kerusakan
                            </a>
                        </div>
                    @endif
                    </div>
                </div>
            @if(count($kerusakanByKategori ?? []) > 0)
            <div class="main-card mb-4">
                <div class="card-header">
                    <h5>Kerusakan Berdasarkan Kategori</h5>
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
