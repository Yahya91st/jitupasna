@extends('layouts.main')

@section('content')
<style>
    .page-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
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

    .summary-card h4 {
        color: #F28705;
        font-weight: 700;
        margin: 10px 0;
    }

    .summary-card small {
        color: #666;
        font-weight: 600;
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
        margin-right: 5px;
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

    .btn-light {
        background: white;
        color: #F28705;
        border: 1px solid #F28705;
    }

    .btn-light:hover {
        background: #F28705;
        color: white;
    }

    .badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .modal-header {
        background: #f9f9f9;
        border-bottom: 1px solid #ddd;
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
    <div class="main-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Rekap Data Bencana</h5>
            <div>
                <a href="{{ route('rekap.index') }}" class="btn btn-light btn-sm">
                    Lihat Semua
                </a>
                <a href="{{ route('rekap.dashboard') }}" class="btn btn-primary btn-sm">
                    Dashboard
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="summary-card">
                        <small>Total Rekap</small>
                        <h4>{{ $rekapSummary['total_rekaps'] }}</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="summary-card">
                        <small>Total Kerusakan</small>
                        <h4>Rp {{ number_format($rekapSummary['total_kerusakan'], 0, ',', '.') }}</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="summary-card">
                        <small>Total Kerugian</small>
                        <h4>Rp {{ number_format($rekapSummary['total_kerugian'], 0, ',', '.') }}</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="summary-card">
                        <small>Verified</small>
                        <h4>{{ $rekapSummary['verified_rekaps'] }}</h4>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <h6 class="mb-3">10 Rekap Terbaru:</h6>
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Bencana</th>
                                    <th>Lokasi</th>
                                    <th>Format Terisi</th>
                                    <th>Total Kerusakan</th>
                                    <th>Total Kerugian</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rekaps as $rekap)
                                    <tr>
                                        <td>
                                            <strong>{{ $rekap->bencana->nama_kejadian ?? '-' }}</strong><br>
                                            <small class="text-muted">{{ $rekap->bencana->tanggal_kejadian ?? '-' }}</small>
                                        </td>
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
                                            <a href="{{ route('rekap.pdf', $rekap->id) }}" class="btn btn-sm btn-primary" target="_blank">PDF</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <p class="text-muted mb-0">Belum ada data rekap</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                    </table>
                </div>
            </div>
        </div>

    <div class="main-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Kerusakan Dampak Bencana</h4>
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#inlineForm">Filter</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Bencana Ref</th>
                                    <th>Ref</th>
                                    <th>Kategori Bagunan</th>
                                    <th>Estimasi Biaya Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kerusakan as $item)
                                    <tr>
                                        <td class="text-bold-500">{{ $item->bencana->Ref }}</td>
                                        <td>{{ $item->Ref }}</td>
                                        <td>{{ $item->kategori_bangunan->nama }}</td>
                                        <td>{{ 'Rp ' . number_format($item->BiayaKeseluruhan, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('kerusakan.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                                Edit
                                            </a>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                    <div style="margin-top: 15px;">
                        {{ $kerusakan->links() }}
                    </div>
                </div>
            </div>
        </div>
    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Filter Kategori Bangunan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kerusakan.index') }}" method="GET" id="filterForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori_bangunan_id">Kategori Bangunan</label>
                            <select class="form-select" name="kategori_bangunan_id" id="kategori_bangunan_id">
                                <option selected disabled value="">Pilih...</option>
                                @foreach ($kategoribangunan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request()->input('kategori_bangunan_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="resetFilters()" data-dismiss="modal">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function resetFilters() {
        document.getElementById('kategori_bangunan_id').value = '';
        // Submit formulir secara otomatis untuk menghapus filter
        document.getElementById('filterForm').submit();
    }
</script>
