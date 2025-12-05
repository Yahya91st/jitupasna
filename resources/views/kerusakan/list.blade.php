@extends('layouts.main')

@section('content')
<style>
    :root {
        --orange-primary: #F28705;
        --orange-gradient: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
    }

    .page-container {
        padding: 2rem;
    }

    .page-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .page-header h3 {
        color: var(--orange-primary);
        font-weight: 600;
        margin: 0 0 0.5rem 0;
        font-size: 1.75rem;
    }

    .page-header p {
        color: #6c757d;
        margin: 0;
        font-size: 0.95rem;
    }

    .main-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-header-gradient {
        background: var(--orange-gradient);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header-gradient h4 {
        color: white;
        margin: 0;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .btn-filter {
        background: transparent;
        border: 2px solid white;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-filter:hover {
        background: white;
        color: var(--orange-primary);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 1.5rem;
    }

    .alert-info {
        background: linear-gradient(135deg, #e3f2fd 0%, #f0f8ff 100%);
        border: none;
        border-left: 4px solid #2196F3;
        color: #004085;
        border-radius: 8px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
    }

    .alert-info h5 {
        color: #004085;
        font-weight: 600;
        margin: 0 0 0.5rem 0;
        font-size: 1rem;
    }

    .alert-info p {
        margin: 0;
        font-size: 0.9rem;
    }

    .table-container {
        overflow-x: auto;
        border-radius: 8px;
        border: 1px solid #dee2e6;
    }

    .table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse;
    }

    .table thead th {
        background: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        border-bottom: 2px solid #dee2e6;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
        color: #495057;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .bencana-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .bencana-info {
        display: flex;
        align-items: center;
    }

    .bencana-name {
        font-weight: 500;
        color: #212529;
    }

    .location-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .location-list li {
        padding: 0.25rem 0;
        color: #495057;
        position: relative;
        padding-left: 1rem;
    }

    .location-list li:before {
        content: "•";
        color: var(--orange-primary);
        font-weight: bold;
        position: absolute;
        left: 0;
    }

    .btn-view {
        background: var(--orange-gradient);
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.875rem;
        display: inline-block;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(242, 135, 5, 0.3);
        color: white;
        text-decoration: none;
    }

    .pagination-container {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
    }

    .pagination .page-link {
        color: var(--orange-primary);
        border: 1px solid #dee2e6;
        margin: 0 2px;
        border-radius: 6px;
    }

    .pagination .page-link:hover {
        background-color: #fff3e0;
        border-color: var(--orange-primary);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--orange-primary);
        border-color: var(--orange-primary);
        color: white;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 12px;
        border: none;
        overflow: hidden;
    }

    .modal-header {
        background: var(--orange-gradient);
        color: white;
        border: none;
        padding: 1.25rem 1.5rem;
    }

    .modal-header h4 {
        color: white;
        margin: 0;
        font-weight: 600;
    }

    .modal-header .close {
        color: white;
        opacity: 0.8;
        text-shadow: none;
        padding: 0;
        margin: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .modal-header .close:hover {
        opacity: 1;
        background: rgba(255, 255, 255, 0.2);
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        border-top: 1px solid #dee2e6;
        padding: 1rem 1.5rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.9rem;
    }

    .form-select {
        width: 100%;
        padding: 0.625rem 0.875rem;
        font-size: 0.9rem;
        border: 1px solid #ced4da;
        border-radius: 8px;
        transition: all 0.3s ease;
        background-color: white;
    }

    .form-select:focus {
        border-color: var(--orange-primary);
        box-shadow: 0 0 0 0.2rem rgba(242, 135, 5, 0.25);
        outline: none;
    }

    .btn-orange {
        background: var(--orange-gradient);
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-orange:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(242, 135, 5, 0.3);
        color: white;
    }

    .btn-light-secondary {
        background: #f8f9fa;
        color: #6c757d;
        border: 1px solid #dee2e6;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-light-secondary:hover {
        background: #e9ecef;
        border-color: #adb5bd;
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 1rem;
        }

        .card-header-gradient {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .card-header-gradient h4 {
            font-size: 1.1rem;
        }

        .table thead th,
        .table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.85rem;
        }

        .bencana-img {
            width: 60px;
            height: 60px;
        }

        .btn-view {
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
        }
    }
</style>

<div class="page-container">
    <div class="page-header">
        <h3>Pilih Kejadian Bencana</h3>
        <p>Silahkan pilih kejadian bencana untuk melihat data kerusakan</p>
    </div>

    <div class="main-card">
        <div class="card-header-gradient">
            <h4>Daftar Kejadian Bencana</h4>
            <button class="btn-filter" type="button" data-toggle="modal" data-target="#inlineForm">
                <i data-feather="filter" style="width: 16px; height: 16px; margin-right: 6px;"></i>
                Filter
            </button>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <h5><i data-feather="info" style="width: 18px; height: 18px; margin-right: 6px;"></i>Informasi</h5>
                <p>Pilih bencana untuk melihat semua data kerusakan yang telah diinput pada formulir-formulir pendataan.</p>
            </div>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Bencana</th>
                            <th>Tanggal</th>
                            <th>Lokasi (Kelurahan/Desa)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bencana as $item)
                            <tr>
                                <td>{{ $item->Ref }}</td>
                                <td>
                                    <div class="bencana-info">
                                        <img class="bencana-img"
                                            src="{{ asset('/frontend/dist/assets/images/avatar/' . $item['gambar']) }}"
                                            alt="{{ $item->kategori_bencana->nama }}">
                                        <div class="bencana-name">{{ $item->kategori_bencana->nama }}</div>
                                    </div>
                                </td>
                                <td>{{ $item->tanggal }}</td>
                                <td>
                                    <ul class="location-list">
                                        @foreach ($item->desa as $desa)
                                            <li>{{ $desa->nama }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route('kerusakan.detail', $item->id) }}" class="btn-view">
                                        <i data-feather="eye" style="width: 14px; height: 14px; margin-right: 4px;"></i>
                                        Lihat Data
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-container">
                {{ $bencana->links() }}
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        <i data-feather="filter" style="width: 20px; height: 20px; margin-right: 8px;"></i>
                        Filter Bencana
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('kerusakan.list') }}" method="GET" id="filterForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori_bencana_id">Kategori Bencana</label>
                            <select class="form-select" name="kategori_bencana_id" id="kategori_bencana_id">
                                <option selected disabled value="">Pilih Kategori...</option>
                                @foreach ($kategoribencana as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request()->input('kategori_bencana_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-light-secondary" onclick="resetFilters()" data-dismiss="modal">
                            <i data-feather="x" style="width: 14px; height: 14px; margin-right: 4px;"></i>
                            Reset
                        </button>
                        <button type="submit" class="btn-orange">
                            <i data-feather="check" style="width: 14px; height: 14px; margin-right: 4px;"></i>
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function resetFilters() {
        document.getElementById('kategori_bencana_id').value = '';
        document.getElementById('filterForm').submit();
    }

    // Initialize Feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
</script>
@endsection
