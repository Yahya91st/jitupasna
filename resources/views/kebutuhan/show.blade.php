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

    {{-- Header --}}
        <div class="page-header">
            <div class="row">
                <div class="col-md-8">
                    <h3>Detail Kebutuhan Pascabencana</h3>
                    <p>Hasil perhitungan kebutuhan berdasarkan formulir.</p>
                </div>

                <div class="col-md-4">
                    <nav class="float-md-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('kebutuhan.index') }}">
                                    Kebutuhan
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Detail
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        {{-- Informasi Bencana --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    Informasi Bencana
                </h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">
                            Tanggal Kejadian
                        </label>

                        <p>
                            {{ optional($formulir->laporan->bencana->tanggal)->format('d-m-Y') }}
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">
                            Jenis Bencana
                        </label>

                        <p>
                            {{ $formulir->laporan->bencana->kategori_bencana->nama ?? '-' }}
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">
                            Kecamatan
                        </label>

                        <p>
                            {{ $formulir->laporan->bencana->kecamatan->nama ?? '-' }}
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">
                            Desa
                        </label>

                        @if(!empty($formulir->laporan->bencana->villages))
                            <ul class="mb-0">
                                @foreach($formulir->laporan->bencana->villages as $village)
                                    <li>{{ $village['name'] }}</li>
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif

                    </div>

                </div>

            </div>
        </div>


        {{-- Ringkasan --}}
        <div class="row mb-4">

            <div class="col-md-4">
                <div class="card border-danger">
                    <div class="card-body text-center">
                        <h6>Total Kerusakan</h6>

                        <h4>
                            Rp {{ number_format($totals['total_kerusakan'],0,',','.') }}
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-warning">
                    <div class="card-body text-center">
                        <h6>Total Kerugian</h6>

                        <h4>
                            Rp {{ number_format($totals['total_kerugian'],0,',','.') }}
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-success">
                    <div class="card-body text-center">
                        <h6>Total Keseluruhan</h6>

                        <h4>
                            Rp {{ number_format($totals['total_keseluruhan'],0,',','.') }}
                        </h4>
                    </div>
                </div>
            </div>

        </div>


        {{-- Detail Item --}}
        <div class="card">

            <div class="card-header">
                <h5 class="mb-0">
                    Detail Perhitungan
                </h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead class="table-light">

                        <tr>

                            <th>Kategori</th>

                            <th>Sub Kategori</th>

                            <th>Tingkat Kerusakan</th>

                            <th>Jumlah</th>

                            <th>Satuan</th>

                            <th>Harga Satuan</th>

                            <th>Subtotal</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($rows as $row)

                            <tr>

                                <td>{{ $row['kategori'] }}</td>

                                <td>{{ $row['sub_kategori'] ?? '-' }}</td>

                                <td>{{ $row['tingkat_kerusakan'] }}</td>

                                <td>{{ number_format($row['jumlah']) }}</td>

                                <td>{{ $row['satuan'] ?? '-' }}</td>

                                <td>
                                    Rp {{ number_format($row['harga_satuan'],0,',','.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($row['subtotal'],0,',','.') }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center text-muted">
                                    Belum ada data.
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                        <tfoot>

                        <tr>

                            <th colspan="6" class="text-end">
                                Total Kerusakan
                            </th>

                            <th>
                                Rp {{ number_format($totals['total_kerusakan'],0,',','.') }}
                            </th>

                        </tr>

                        <tr>

                            <th colspan="6" class="text-end">
                                Total Kerugian
                            </th>

                            <th>
                                Rp {{ number_format($totals['total_kerugian'],0,',','.') }}
                            </th>

                        </tr>

                        <tr class="table-success">

                            <th colspan="6" class="text-end">
                                Total Keseluruhan
                            </th>

                            <th>
                                Rp {{ number_format($totals['total_keseluruhan'],0,',','.') }}
                            </th>

                        </tr>

                        </tfoot>

                    </table>

                </div>

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
