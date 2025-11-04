@extends('layouts.main')

@section('content')
<style>
    /* Container & Layout - Konsisten dengan form8.blade */
    * {
        font-family: 'Times New Roman', serif;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background: white;
        color: #333;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Header Styling - Dari form8.blade */
    .form-header {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ddd;
    }

    .form-header h5 {
        margin: 0.5rem 0;
        font-weight: bold;
        color: #333;
    }

    .form-header h5:first-child {
        color: #0066cc;
        margin-bottom: 0.3rem;
    }

    /* Table Styling - Konsisten dengan form8.blade */
    .form-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 10px;
        table-layout: fixed;
    }

    .form-table th,
    .form-table td {
        padding: 2px 2px;
        border: 1px solid #333;
        text-align: center;
        vertical-align: middle;
        word-break: break-word;
    }

    .form-table th {
        font-size: 10px;
    }

    @media (max-width: 900px) {
        .form-table,
        .form-table th,
        .form-table td {
            font-size: 8px;
            padding: 1px 1px;
        }
    }

    .form-table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }

    .form-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .form-table tbody tr:hover {
        background-color: rgba(0, 102, 204, 0.05);
        transition: background-color 0.2s ease;
    }

    .table-header {
        background-color: white !important;
        color: #333 !important;
        text-align: center;
        font-weight: bold;
        border: 1px solid #333;
        padding: 6px 4px;
        font-size: 11px;
        line-height: 1.2;
        vertical-align: middle;
    }

    /* Data row styling */
    .data-row td {
        padding: 6px 4px;
        font-size: 11px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #333;
        min-height: 25px;
    }

    .data-row td:first-child {
        font-weight: bold;
        background-color: #f9f9f9;
    }

    /* Total row styling */
    .total-row {
        font-weight: bold;
        text-align: center;
        background-color: #e9ecef !important;
        border-top: 2px solid #333;
    }

    .total-row td {
        background-color: #e9ecef !important;
        font-weight: 700;
        color: #333;
        border: 1px solid #333;
        padding: 8px 4px;
        font-size: 12px;
    }

    /* Button Styling - Dari form8.blade */
    .form-button {
        margin: 0 5px;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        font-family: 'Times New Roman', serif;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-success {
        background: #28a745;
        color: white;
    }

    .btn-warning {
        background: #ffc107;
        color: #212529;
    }

    .btn-info {
        background: #17a2b8;
        color: white;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-primary {
        background: #007bff;
        color: white;
    }

    /* Action buttons container - Dari form8.blade */
    .d-flex {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    /* Action buttons styling */
    .action-btn {
        padding: 4px 8px;
        font-size: 11px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
        margin: 2px;
    }

    .btn-edit {
        background: #ffc107;
        color: #212529;
        border: 1px solid #ffc107;
        border-radius: 3px;
    }

    .btn-edit:hover {
        background: #e0a800;
        border-color: #e0a800;
        transform: scale(1.05);
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: 1px solid #dc3545;
        border-radius: 3px;
    }

    .btn-delete:hover {
        background: #c82333;
        border-color: #c82333;
        transform: scale(1.05);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .container {
            max-width: 100%;
            padding: 10px;
        }

        .form-table {
            font-size: 11px;
        }

        .form-table th,
        .form-table td {
            padding: 4px;
        }
    }

    @media (max-width: 768px) {
        .form-table {
            font-size: 10px;
        }

        .form-button {
            margin: 2px;
            padding: 6px 12px;
            font-size: 12px;
        }
    }

    /* Print Styles */
    @media print {
        .form-table {
            page-break-inside: auto;
            border: 2px solid #000 !important;
        }

        .form-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .form-table td,
        .form-table th {
            border: 1px solid #000 !important;
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }

        .form-table thead th {
            background-color: #b3b3b3 !important;
            border-bottom: 2px solid #000 !important;
        }

        .total-row td {
            border-top: 2px solid #000 !important;
            border-bottom: 2px solid #000 !important;
            background-color: #e9ecef !important;
        }

        .form-button,
        .action-btn,
        .d-flex {
            display: none !important;
        }

        /* Hide action column header and cells */
        .form-table thead tr th:last-child,
        .form-table tbody tr td:last-child {
            display: none !important;
        }

        .container {
            box-shadow: none;
            margin: 0;
            padding: 10px;
        }

        body {
            font-size: 12pt;
            line-height: 1.4;
        }

        .alert {
            display: none !important;
        }
    }

    /* Alert styling */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

</style>

<div class="container">
    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle"></i> 
        <strong>Terjadi kesalahan:</strong>
        <ul style="margin: 10px 0 0 20px;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Document Header - Style dari form8.blade -->
    <div class="form-header">
        <h5><strong>Formulir 08</strong></h5>
        <h5>Daftar Kerusakan dan Kerugian Per Sektor/Sub Sektor Akibat Bencana Alam</h5>
    </div>

    <!-- Info Bencana -->
    @if(isset($bencana))
    <div style="background: #f8f9fa; border-left: 4px solid #0066cc; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
        <p style="margin: 5px 0; font-size: 13px;"><strong style="color: #0066cc;">Bencana:</strong> {{ $bencana->kategori_bencana->nama ?? 'N/A' }}</p>
        <p style="margin: 5px 0; font-size: 13px;"><strong style="color: #0066cc;">Tanggal:</strong> {{ $bencana->tanggal ? \Carbon\Carbon::parse($bencana->tanggal)->format('d F Y') : 'N/A' }}</p>
        <p style="margin: 5px 0; font-size: 13px;"><strong style="color: #0066cc;">Lokasi:</strong> 
            @if($bencana->desa && $bencana->desa->count() > 0)
                @foreach($bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            @else
                N/A
            @endif
        </p>
        <p style="margin: 5px 0; font-size: 13px;"><strong style="color: #0066cc;">Total Data:</strong> {{ $allRows->count() }} item</p>
    </div>
    @endif

    <div class="table-responsive-custom" style="overflow-x:auto; width:100%;">
        <table class="form-table">
            <thead>
                <tr>
                    <th class="table-header" rowspan="2" style="width: 3%;">No</th>
                    <th class="table-header" rowspan="2" style="width: 5%;">Form ID</th>
                    <th class="table-header" rowspan="2" style="width: 12%;">Sektor/Sub Sektor</th>
                    <th class="table-header" rowspan="2" style="width: 15%;">Komponen Kerusakan</th>
                    <th class="table-header" rowspan="2" style="width: 10%;">Lokasi</th>
                    <th class="table-header" colspan="3" style="width: 12%;">Data Kerusakan</th>
                    <th class="table-header" colspan="3" style="width: 12%;">Harga Satuan (Rp.)</th>
                    <th class="table-header" colspan="3" style="width: 12%;">Nilai Kerusakan (Damage)</th>
                    <th class="table-header" rowspan="2" style="width: 8%;">Perkiraan Kerugian (Losses)</th>
                    <th class="table-header" rowspan="2" style="width: 8%;">Kerusakan + Kerugian</th>
                    <th class="table-header" rowspan="2" style="width: 8%;">Kebutuhan</th>
                    <th class="table-header" rowspan="2" style="width: 8%;">Aksi</th>
                </tr>
                <tr>
                    <th class="table-header" style="width: 4%;">RB</th>
                    <th class="table-header" style="width: 4%;">RS</th>
                    <th class="table-header" style="width: 4%;">RR</th>
                    <th class="table-header" style="width: 4%;">RB</th>
                    <th class="table-header" style="width: 4%;">RS</th>
                    <th class="table-header" style="width: 4%;">RR</th>
                    <th class="table-header" style="width: 4%;">RB</th>
                    <th class="table-header" style="width: 4%;">RS</th>
                    <th class="table-header" style="width: 4%;">RR</th>
                </tr>
            </thead>
            <tbody>
                @if($allRows->count() > 0)
                    @foreach($allRows as $index => $row)
                    <tr class="data-row">
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td style="text-align: center;">{{ $row->form8 ? $row->form8->id : $row->form8_id }}</td>
                        <td style="text-align: left;">{{ $row->sektor_sub_sektor ?? '-' }}</td>
                        <td style="text-align: left;">{{ $row->komponen_kerusakan ?? '-' }}</td>
                        <td style="text-align: center;">{{ $row->lokasi ?? '-' }}</td>
                        <td style="text-align: center;">{{ number_format($row->data_kerusakan_rb ?? 0, 0, ',', '.') }}</td>
                        <td style="text-align: center;">{{ number_format($row->data_kerusakan_rs ?? 0, 0, ',', '.') }}</td>
                        <td style="text-align: center;">{{ number_format($row->data_kerusakan_rr ?? 0, 0, ',', '.') }}</td>
                        <td style="text-align: right;">{{ number_format($row->harga_satuan_rb ?? 0, 0, ',', '.') }}</td>
                        <td style="text-align: right;">{{ number_format($row->harga_satuan_rs ?? 0, 0, ',', '.') }}</td>
                        <td style="text-align: right;">{{ number_format($row->harga_satuan_rr ?? 0, 0, ',', '.') }}</td>
                        <td style="text-align: right;">{{ number_format($row->nilai_kerusakan_rb ?? 0, 0, ',', '.') }}</td>
                        <td style="text-align: right;">{{ number_format($row->nilai_kerusakan_rs ?? 0, 0, ',', '.') }}</td>
                        <td style="text-align: right;">{{ number_format($row->nilai_kerusakan_rr ?? 0, 0, ',', '.') }}</td>
                        <td style="text-align: right;">{{ number_format($row->perkiraan_kerugian ?? 0, 0, ',', '.') }}</td>
                        <td style="text-align: right;">{{ number_format($row->jumlah_kerusakan_kerugian ?? 0, 0, ',', '.') }}</td>
                        <td style="text-align: right;">{{ number_format($row->kebutuhan ?? 0, 0, ',', '.') }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('forms.form8.row.edit', $row->id) }}" class="action-btn btn-edit" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 4px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                            <form action="{{ route('forms.form8.row.destroy', $row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 4px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="18" style="text-align: center; padding: 40px; font-style: italic; color: #6c757d;">
                            Tidak ada data tersedia
                        </td>
                    </tr>
                @endif
                <tr class="total-row">
                    <td colspan="5" style="text-align: center; font-weight: bold;">JUMLAH</td>
                    @php
                        $totalRB = $allRows->sum('data_kerusakan_rb');
                        $totalRS = $allRows->sum('data_kerusakan_rs');
                        $totalRR = $allRows->sum('data_kerusakan_rr');
                        $totalNilaiRB = $allRows->sum('nilai_kerusakan_rb');
                        $totalNilaiRS = $allRows->sum('nilai_kerusakan_rs');
                        $totalNilaiRR = $allRows->sum('nilai_kerusakan_rr');
                        $totalKerugian = $allRows->sum('perkiraan_kerugian');
                        $totalKerusakanKerugian = $allRows->sum('jumlah_kerusakan_kerugian');
                        $totalKebutuhan = $allRows->sum('kebutuhan');
                    @endphp
                    <td style="text-align: center;">{{ number_format($totalRB, 0, ',', '.') }}</td>
                    <td style="text-align: center;">{{ number_format($totalRS, 0, ',', '.') }}</td>
                    <td style="text-align: center;">{{ number_format($totalRR, 0, ',', '.') }}</td>
                    <td style="text-align: center;">-</td>
                    <td style="text-align: center;">-</td>
                    <td style="text-align: center;">-</td>
                    <td style="text-align: right;">{{ number_format($totalNilaiRB, 0, ',', '.') }}</td>
                    <td style="text-align: right;">{{ number_format($totalNilaiRS, 0, ',', '.') }}</td>
                    <td style="text-align: right;">{{ number_format($totalNilaiRR, 0, ',', '.') }}</td>
                    <td style="text-align: right;">{{ number_format($totalKerugian, 0, ',', '.') }}</td>
                    <td style="text-align: right;">{{ number_format($totalKerusakanKerugian, 0, ',', '.') }}</td>
                    <td style="text-align: right;">{{ number_format($totalKebutuhan, 0, ',', '.') }}</td>
                    <td style="text-align: center;">-</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Tombol Aksi - Style dari form8.blade -->
    <div class="d-flex gap-2 justify-content-center mt-4 mb-3">
        @if(isset($bencana) && isset($bencana->id))
        <a href="{{ route('forms.form8.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> Kembali ke List
        </a>
        @endif
        <a href="{{ route('forms.form8.form8-per-baris-pdf') }}" class="btn btn-success" target="_blank">
            <i class="bi bi-file-pdf"></i> Lihat PDF
        </a>
        <button type="button" class="btn btn-info" onclick="window.print()">
            <i class="bi bi-printer"></i> Cetak
        </button>
    </div>
</div>

<script>
    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.style.display = 'none';
            }, 500);
        });
    }, 5000);
</script>
@endsection