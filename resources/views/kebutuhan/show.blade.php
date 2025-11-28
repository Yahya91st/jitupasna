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
    
    .breadcrumb {
        background: transparent;
        margin: 0;
    }
    
    .breadcrumb-item a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
    }
    
    .breadcrumb-item a:hover {
        color: white;
    }
    
    .breadcrumb-item.active {
        color: white;
    }
    
    .detail-card {
        background: white;
        border-radius: 12px;
        border: 3px solid #F28705;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    
    .card-header {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
        border-bottom: none;
        border-radius: 12px 12px 0 0;
    }
    
    .card-header h4 {
        margin: 0;
        font-weight: 600;
    }
    
    .card-primary .card-header {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }
    
    .card-danger .card-header {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    }
    
    .card-warning .card-header {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    }
    
    .card-success .card-header {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    }
    
    .summary-card {
        background: white;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    
    .btn-outline-primary {
        border: 2px solid #F28705;
        color: #F28705;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-outline-primary:hover {
        background: #F28705;
        border-color: #F28705;
        color: white;
        transform: translateY(-2px);
    }
    
    .btn-outline-warning {
        border: 2px solid #ffc107;
        color: #ffc107;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-outline-warning:hover {
        background: #ffc107;
        border-color: #ffc107;
        color: #212529;
        transform: translateY(-2px);
    }
    
    .btn-outline-danger {
        border: 2px solid #dc3545;
        color: #dc3545;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-outline-danger:hover {
        background: #dc3545;
        border-color: #dc3545;
        color: white;
        transform: translateY(-2px);
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
    
    .btn-warning {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        border: none;
        color: #212529;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-warning:hover {
        background: linear-gradient(135deg, #e0a800 0%, #d39e00 100%);
        transform: translateY(-2px);
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
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(242, 135, 5, 0.1);
    }
    
    .badge {
        border-radius: 8px;
        font-weight: 500;
        padding: 6px 12px;
    }
    
    .form-group label {
        color: #495057;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .form-group p {
        color: #6c757d;
        margin-bottom: 0;
    }
</style>

<div class="container-fluid">
<div class="main-card">
    <div class="orange-header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Kebutuhan Pascabencana</h3>
                <p class="text-subtitle">Detail kebutuhan pascabencana</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-md-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('kebutuhan.index') }}">Kebutuhan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div style="padding: 20px;">
        <div class="detail-card">
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
                        <label for="kategori_bencana">Kategori Bencana</label>
                        <p>
                            @if($bencana->kategori_bencana && isset($bencana->kategori_bencana->nama))
                                {{ $bencana->kategori_bencana->nama }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <p>
                            @if($bencana->kecamatan && isset($bencana->kecamatan->nama))
                                {{ $bencana->kecamatan->nama }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="desa">Desa</label>
                        @if($bencana->desa && count($bencana->desa) > 0)
                            <ul class="mb-0 ps-3">
                                @foreach($bencana->desa as $desa)
                                    <li>
                                        <span class="badge bg-info text-dark">{{ $desa->nama }}</span>
                                        <small class="text-muted">Kode Pos: {{ $desa->kode_pos }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>-</p>
                        @endif
                    </div>
                </div>
            </div>        </div>
    </div>    
    
        <!-- Rekap Section -->
        <div class="detail-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">
                    <i class="fas fa-chart-pie me-2"></i>
                    Data Rekap Bencana
                    <small id="last-updated" class="text-muted ms-2"></small>
                </h4>
            <div>
                <!-- @if($rekaps->count() > 0)
                    <a href="{{ route('rekap.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye me-1"></i>Lihat Semua Rekap
                    </a>                
                @endif                 -->
                <button id="sync-rekap-btn" class="btn btn-warning btn-sm" title="Sinkronisasi Data Rekap">
                    <i class="fas fa-sync-alt me-1"></i>Sync Data
                </button>
                <!-- <a href="{{ route('rekap.create', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>Tambah Rekap
                </a> -->
            </div>
        </div>
        <div class="card-body">
            @if($rekaps->count() > 0)
                <!-- Rekap Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="summary-card bg-primary text-white mb-0">
                            <div class="card-body text-center py-3">
                                <h4 class="mb-1">{{ $rekapSummary['total_rekaps'] }}</h4>
                                <small>Total Rekap</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="summary-card bg-danger text-white mb-0">
                            <div class="card-body text-center py-3">
                                @php
                                    // Hitung total kerusakan seluruh rekap (format1-17)
                                    $totalKerusakan = 0;
                                    foreach ($rekaps as $rekap) {
                                        for ($i = 1; $i <= 17; $i++) {
                                            $relasi = "format{$i}Form4";
                                            if (!empty($rekap->$relasi) && isset($rekap->$relasi->total_kerusakan)) {
                                                $totalKerusakan += $rekap->$relasi->total_kerusakan;
                                            }
                                        }
                                    }
                                @endphp
                                <h4 class="mb-1">Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</h4>
                                <small>Total Kerusakan</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="summary-card bg-warning text-white mb-0">
                            <div class="card-body text-center py-3">
                                <h4 class="mb-1">Rp {{ number_format($rekapSummary['total_kerugian'], 0, ',', '.') }}</h4>
                                <small>Total Kerugian</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="summary-card bg-success text-white mb-0">
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
                                <th>Format</th>
                                <th>Lokasi</th>
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
                                        @php
                                            $format = '-';
                                            for ($i = 1; $i <= 17; $i++) {
                                                $relasi = "format{$i}Form4";
                                                if (!empty($rekap->$relasi)) {
                                                    $format = "Format $i";
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <span class="badge bg-secondary">{{ $format }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $rekap->nama_kampung ?? '-' }}</strong><br>
                                        <small class="text-muted">{{ $rekap->nama_distrik ?? '-' }}</small>
                                    </td>
                                    <td>
                                        @php
                                            $totalKerusakan = 0;
                                            for ($i = 1; $i <= 17; $i++) {
                                                $relasi = "format{$i}Form4";
                                                if (!empty($rekap->$relasi) && isset($rekap->$relasi->total_kerusakan)) {
                                                    $totalKerusakan += $rekap->$relasi->total_kerusakan;
                                                }
                                            }
                                        @endphp
                                        <strong>Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</strong>
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
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            <a href="{{ route('rekap.edit', $rekap->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="{{ route('rekap.pdf', $rekap->id) }}" class="btn btn-sm btn-outline-danger" title="PDF" target="_blank">
                                                <i class="fas fa-file-pdf"></i> PDF
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
                    <a href="{{ route('rekap.create', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Tambah Rekap Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
</div>
    
</section>
@endsection

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded - JavaScript is running');
    
    // Check jQuery availability
    if (typeof $ === 'undefined') {
        console.error('jQuery is not loaded!');
        return;
    } else {
        console.log('jQuery is available, version:', $.fn.jquery);
    }
    
    // Check SweetAlert availability
    if (typeof Swal === 'undefined') {
        console.error('SweetAlert2 is not loaded!');
    } else {
        console.log('SweetAlert2 is available');
    }
      // Check if elements exist
    const syncBtn = document.getElementById('sync-rekap-btn');
    
    console.log('Sync button found:', syncBtn);    // Auto-sync functionality only
    
    // Sync rekap data
    function syncRekapData() {
        console.log('syncRekapData function called');
        const syncBtn = document.getElementById('sync-rekap-btn');
        console.log('Sync button element:', syncBtn);
        
        if (!syncBtn) {
            console.error('Sync button not found!');
            return;
        }
        
        const originalHtml = syncBtn.innerHTML;
        
        syncBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Syncing...';
        syncBtn.disabled = true;

        // Use jQuery AJAX for better AJAX detection compatibility
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $.ajax({
            url: '{{ route("rekap.sync-all") }}',
            type: 'POST',
            dataType: 'json',
            data: {
                bencana_id: {{ $bencana->id }},
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                console.log('AJAX Success - Response data:', data);
                
                if (data.success) {
                    // Build detailed message
                    let message = data.message;
                    if (data.deleted_count > 0) {
                        message += `\n\nDetail:\n• ${data.synced_count} rekap disinkronisasi\n• ${data.deleted_count} data orphan dihapus`;
                    } else {
                        message += `\n\nDetail:\n• ${data.synced_count} rekap disinkronisasi`;
                    }
                    
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: message,
                        timer: 4000,
                        showConfirmButton: false
                    });
                    
                    // Refresh the page to show updated data
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message || 'Gagal sinkronisasi data'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {
                    status: status,
                    error: error,
                    responseText: xhr.responseText,
                    xhr: xhr
                });
                
                // Check if it's actually a successful redirect (302/200 status)
                if (xhr.status === 200 || xhr.status === 302) {
                    // Parse response for success indicators
                    const responseText = xhr.responseText || '';
                    if (responseText.includes('success') || responseText.includes('berhasil') || responseText.includes('Berhasil')) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Sinkronisasi rekap berhasil dilakukan',
                            timer: 3000,
                            showConfirmButton: false
                        });
                        
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                        return;
                    }
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat sinkronisasi data'
                });
            },
            complete: function() {
                syncBtn.innerHTML = originalHtml;
                syncBtn.disabled = false;
            }        });
    }
    
    // Event listenersconsole.log('Adding event listeners...');
    
    const syncBtnElement = document.getElementById('sync-rekap-btn');
    if (syncBtnElement) {
        console.log('Adding click listener to sync button');
        syncBtnElement.addEventListener('click', function(e) {
            console.log('Sync button clicked!', e);
            syncRekapData();
        });    } else {
        console.error('Sync button element not found for event listener!');
    }
    
    // Debug: Log initial state
    console.log('Sync system initialized successfully');
    
    // Function to toggle all details sections at once
    const toggleAllDetails = (show) => {
        document.querySelectorAll('[id^="details-"]').forEach(element => {
            if (show) {
                element.classList.add('show');
            } else {
                element.classList.remove('show');
            }
        });
    };
});
</script>
@endpush