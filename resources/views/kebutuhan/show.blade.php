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

        .card-header h4 {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .card-body {
            padding: 20px;
        }

        /* Summary Cards */
        .summary-card {
            background: white;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .summary-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .summary-card.bg-primary {
            background: #F28705 !important;
        }

        .summary-card.bg-danger {
            background: #dc3545 !important;
        }

        .summary-card.bg-warning {
            background: #ffc107 !important;
        }

        .summary-card.bg-success {
            background: #28a745 !important;
        }

        /* Form Group */
        .form-group label {
            color: #333;
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .form-group p {
            color: #666;
            margin-bottom: 0;
            font-size: 14px;
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
            padding: 10px;
            border: 1px solid #ddd;
            vertical-align: middle;
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
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
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

        .btn-warning {
            background: #ffc107;
            color: #212529;
        }

        .btn-warning:hover {
            background: #e0a800;
        }

        .btn-outline-primary {
            border: 1px solid #F28705;
            color: #F28705;
            background: white;
        }

        .btn-outline-primary:hover {
            background: #F28705;
            color: white;
        }

        .btn-outline-warning {
            border: 1px solid #ffc107;
            color: #ffc107;
            background: white;
        }

        .btn-outline-warning:hover {
            background: #ffc107;
            color: #212529;
        }

        .btn-outline-danger {
            border: 1px solid #dc3545;
            color: #dc3545;
            background: white;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
            color: white;
        }

        /* Badge */
        .badge {
            border-radius: 4px;
            font-weight: 500;
            padding: 4px 8px;
            font-size: 12px;
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
                padding: 5px 10px;
                font-size: 12px;
            }
        }
    </style>

    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-12 col-md-8">
                    <h3>Detail Kebutuhan Pascabencana</h3>
                    <p>Detail kebutuhan pascabencana</p>
                </div>
                <div class="col-12 col-md-4">
                    <nav aria-label="breadcrumb" class="float-start float-md-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('kebutuhan.index') }}">Kebutuhan</a></li>
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
                            <label for="kategori_bencana">Kategori Bencana</label>
                            <p>
                                @if ($bencana->kategori_bencana && isset($bencana->kategori_bencana->nama))
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
                                @if ($bencana->kecamatan && isset($bencana->kecamatan->nama))
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
                            @if ($bencana->desa && count($bencana->desa) > 0)
                                <ul class="mb-0 ps-3">
                                    @foreach ($bencana->desa as $desa)
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
                </div>
            </div>
        </div>

        <!-- Rekap Section -->
        <div class="main-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Data Rekap Bencana</h4>
                <div>
                    <button id="sync-rekap-btn" class="btn btn-warning" title="Sinkronisasi Data Rekap">
                        Sync Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if ($rekaps->count() > 0)
                    <!-- Summary Cards -->
                    <div class="row mb-3">
                        <div class="col-md-3 col-6 mb-2">
                            <div class="summary-card bg-primary text-white">
                                <div class="card-body text-center py-3">
                                    <h4 class="mb-1">{{ $rekapSummary['total_rekaps'] }}</h4>
                                    <small>Total Rekap</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <div class="summary-card bg-danger text-white">
                                <div class="card-body text-center py-3">
                                    @php
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
                        <div class="col-md-3 col-6 mb-2">
                            <div class="summary-card bg-warning text-white">
                                <div class="card-body text-center py-3">
                                    <h4 class="mb-1">Rp {{ number_format($rekapSummary['total_kerugian'], 0, ',', '.') }}</h4>
                                    <small>Total Kerugian</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <div class="summary-card bg-success text-white">
                                <div class="card-body text-center py-3">
                                    <h4 class="mb-1">{{ $rekapSummary['verified_rekaps'] }}</h4>
                                    <small>Verified</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
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
                            @foreach ($rekaps as $rekap)
                                @for ($i = 1; $i <= 17; $i++)
                                    @php
                                        $relasi = "format{$i}Form4";
                                        $formatData = $rekap->$relasi;
                                    @endphp
                                    @if (!empty($formatData))
                                        <tr>
                                            <td style="text-align: center;">
                                                <span class="badge bg-secondary">Format {{ $i }}</span>
                                            </td>
                                            <td>
                                                <strong>{{ $rekap->nama_kampung ?? '-' }}</strong><br>
                                                <small class="text-muted">{{ $rekap->nama_distrik ?? '-' }}</small>
                                            </td>
                                            <td style="text-align: right;">
                                                Rp {{ number_format($formatData->total_kerusakan ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td style="text-align: right;">
                                                Rp {{ number_format($formatData->total_kerugian ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td style="text-align: center;">
                                                @php
                                                    $statusClass = match ($rekap->status) {
                                                        'completed' => 'bg-success',
                                                        'verified' => 'bg-info',
                                                        default => 'bg-warning',
                                                    };
                                                @endphp
                                                <span class="badge {{ $statusClass }}">
                                                    {{ ucfirst($rekap->status) }}
                                                </span>
                                            </td>
                                            <td style="text-align: center;">
                                                @php
                                                    $detailUrl = route("forms.form4.format{$i}.show", ['id' => $formatData->id]);
                                                    $editUrl = route("forms.form4.format{$i}.edit", ['id' => $formatData->id]);
                                                    $pdfUrl = route("forms.form4.format{$i}.pdf", ['id' => $formatData->id]);
                                                @endphp
                                                <a href="{{ $detailUrl }}" class="btn btn-outline-primary">Detail</a>
                                                <a href="{{ $editUrl }}" class="btn btn-outline-warning">Edit</a>
                                                <a href="{{ $pdfUrl }}" class="btn btn-outline-danger" target="_blank">PDF</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endfor
                            @endforeach
                                <!-- @foreach ($rekaps as $rekap)
                                    <tr>
                                        <td style="text-align: center;">
                                        @php
                                            $formats = [];
                                            for ($i = 1; $i <= 17; $i++) {
                                                $relasi = "format{$i}Form4";
                                                if (!empty($rekap->$relasi)) {
                                                    $formats[] = "Format $i";
                                                }
                                            }
                                        @endphp
                                        @if (count($formats))
                                            @foreach ($formats as $f)
                                                <span class="badge bg-secondary">{{ $f }}</span>
                                            @endforeach
                                        @else
                                            <span class="badge bg-secondary">-</span>
                                        @endif                                            
                                        </td>
                                        <td>
                                            <strong>{{ $rekap->nama_kampung ?? '-' }}</strong><br>
                                            <small class="text-muted">{{ $rekap->nama_distrik ?? '-' }}</small>
                                        </td>
                                        <td style="text-align: right;">
                                            @php
                                                $totalKerusakan = 0;
                                                for ($i = 1; $i <= 17; $i++) {
                                                    $relasi = "format{$i}Form4";
                                                    if (!empty($rekap->$relasi) && isset($rekap->$relasi->total_kerusakan)) {
                                                        $totalKerusakan += $rekap->$relasi->total_kerusakan;
                                                    }
                                                }
                                            @endphp
                                            Rp {{ number_format($totalKerusakan, 0, ',', '.') }}
                                        </td>
                                        <td style="text-align: right;">
                                            Rp {{ number_format($rekap->total_kerugian, 0, ',', '.') }}
                                        </td>
                                        <td style="text-align: center;">
                                            @php
                                                $statusClass = match ($rekap->status) {
                                                    'completed' => 'bg-success',
                                                    'verified' => 'bg-info',
                                                    default => 'bg-warning',
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">
                                                {{ ucfirst($rekap->status) }}
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            @php
                                                // cari format pertama yang ada pada rekap (format1_form4_id .. format17_form4_id)
                                                $detailUrl = null;
                                                $editUrl = null;
                                                $pdfUrl = null;

                                                for ($i = 1; $i <= 17; $i++) {
                                                    $col = "format{$i}form4";
                                                    if (!empty($rekap->{$col})) {
                                                        $formatId = $rekap->{$col};

                                                        // coba nama route khusus per format: forms.form4.show-format{n}, edit-format{n}, pdf-format{n}
                                                        $showRoute = "forms.form4.format{$i}.show";
                                                        $editRoute = "forms.form4.format{$i}.edit";
                                                        $pdfRoute = "forms.form4.format{$i}.pdf";

                                                        if (Route::has($showRoute)) {
                                                            $detailUrl = route($showRoute, ['id' => $formatId]);
                                                        } elseif (Route::has('forms.form4.format{$i}.show')) {
                                                            $detailUrl = route('forms.form4.format{$i}.show', ['format' => $i, 'id' => $formatId]);
                                                        }

                                                        if (Route::has($editRoute)) {
                                                            $editUrl = route($editRoute, ['id' => $formatId]);
                                                        } elseif (Route::has('forms.form4.format{$i}.edit')) {
                                                            $editUrl = route('forms.form4.format{$i}.edit', ['format' => $i, 'id' => $formatId]);
                                                        }

                                                        if (Route::has($pdfRoute)) {
                                                            $pdfUrl = route($pdfRoute, ['id' => $formatId]);
                                                        } elseif (Route::has('forms.form4.format{$i}.pdf')) {
                                                            $pdfUrl = route('forms.form4.format{$i}.pdf', ['format' => $i, 'id' => $formatId]);
                                                        }

                                                        break;
                                                    }
                                                }

                                                // fallback ke rekap routes jika tidak ditemukan route spesifik
                                                $detailUrl = $detailUrl ?? route('rekap.show', $rekap->id);
                                                $editUrl = $editUrl ?? route('rekap.edit', $rekap->id);
                                                $pdfUrl = $pdfUrl ?? route('rekap.pdf', $rekap->id);
                                            @endphp

                                            <a href="{{ $detailUrl }}" class="btn btn-outline-primary">Detail</a>
                                            <a href="{{ $editUrl }}" class="btn btn-outline-warning">Edit</a>
                                            <a href="{{ $pdfUrl }}" class="btn btn-outline-danger" target="_blank">PDF</a>
                                        </td>
                                    </tr>
                                @endforeach -->
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <h5 class="text-muted">Belum ada data rekap</h5>
                        <p class="text-muted">Belum ada data rekap untuk bencana ini.</p>
                        <a href="{{ route('rekap.create', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                            Tambah Rekap Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
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

            console.log('Sync button found:', syncBtn); // Auto-sync functionality only

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
                    url: '{{ route('rekap.sync-all') }}',
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
                    }
                });
            }

            // Event listenersconsole.log('Adding event listeners...');

            const syncBtnElement = document.getElementById('sync-rekap-btn');
            if (syncBtnElement) {
                console.log('Adding click listener to sync button');
                syncBtnElement.addEventListener('click', function(e) {
                    console.log('Sync button clicked!', e);
                    syncRekapData();
                });
            } else {
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
