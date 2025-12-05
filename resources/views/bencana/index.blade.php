@extends('layouts.main')

@section('content')
<style>
    :root {
        --orange-primary: #F28705;
        --orange-gradient: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
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
        flex-wrap: wrap;
        gap: 1rem;
    }

    .card-header-gradient h4 {
        color: white;
        margin: 0;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .header-buttons {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn-add {
        background: white;
        color: var(--orange-primary);
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        border: none;
        cursor: pointer;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
        color: var(--orange-primary);
        text-decoration: none;
    }

    .btn-filter {
        background: transparent;
        border: 2px solid white;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        cursor: pointer;
    }

    .btn-filter:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .card-content {
        padding: 1.5rem;
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
        width: 100px;
        height: 100px;
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
        margin: 0;
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

    .dropdown-toggle {
        background: var(--orange-gradient);
        color: white;
        border: none;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .dropdown-toggle:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(242, 135, 5, 0.3);
    }

    .dropdown-toggle:focus,
    .dropdown-toggle:active {
        background: var(--orange-gradient) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(242, 135, 5, 0.3) !important;
    }

    .dropdown-menu {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 0.5rem 0;
        min-width: 200px;
    }

    .dropdown-item {
        padding: 0.625rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #495057;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: var(--orange-primary);
    }

    .dropdown-item svg {
        flex-shrink: 0;
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
        .card-header-gradient {
            flex-direction: column;
            align-items: flex-start;
        }

        .card-header-gradient h4 {
            font-size: 1.1rem;
        }

        .header-buttons {
            width: 100%;
        }

        .btn-add,
        .btn-filter {
            flex: 1;
            justify-content: center;
        }

        .table thead th,
        .table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.85rem;
        }

        .bencana-img {
            width: 70px;
            height: 70px;
        }

        .dropdown-item {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="main-card">
            <div class="card-header-gradient">
                <h4>Data Kejadian Bencana</h4>
                <div class="header-buttons">
                    <button class="btn-filter" type="button" data-toggle="modal" data-target="#inlineForm">
                        <i data-feather="filter" style="width: 16px; height: 16px; margin-right: 6px;"></i>
                        Filter
                    </button>
                    <a href="{{ route('bencana.create') }}" class="btn-add">
                        <i data-feather="plus" style="width: 16px; height: 16px; margin-right: 6px;"></i>
                        Tambah Data Bencana
                    </a>
                </div>
            </div>
            <div class="card-content">
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
                                            <h6 class="bencana-name">{{ $item->kategori_bencana->nama }}</h6>
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
                                        <div class="btn-group">
                                            <div class="dropdown">
                                                <button class="dropdown-toggle" type="button" id="dropdownMenu{{ $item->id }}"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu{{ $item->id }}">
                                                    <a href="{{ route('bencana.edit', $item->id) }}" class="dropdown-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                                            <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2">
                                                                <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                                                <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                            </g>
                                                        </svg>
                                                        Update Data
                                                    </a>
                                                    <a href="{{ route('kerusakan.create', $item->id) }}" class="dropdown-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512">
                                                            <path fill="currentColor"
                                                                d="M87.195 53.838v79.494h44.213V53.838zm344.291 89.422q.51 10.83 1.014 21.662l27.861 41.004l-46.379 17.504l9.409 16.57l-24.334 32.486h86.273V143.26zm-387.562 2.303v124.619H266.61l5.389-54.61l-63.18-17.166l21.7-38.656l-9.46-14.188zm6.709 134.802v201.711h53.316V321.408h96.614v160.668h271.152v-201.71h-83.766l-34.537 13.61l-23.178 30.768l-34.505-29.69l-26.827-14.689z" />
                                                        </svg>
                                                        Kerusakan
                                                    </a>
                                                    <a href="{{ route('kerugian.create', $item->id) }}" class="dropdown-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 14 14">
                                                            <path fill="currentColor" fill-rule="evenodd"
                                                                d="M1.315.606a.75.75 0 0 1 .99-.38l8.591 3.828l.361-.795a.75.75 0 0 1 1.386.05l.8 2.16a.75.75 0 0 1-.438.963l-2.15.81a.75.75 0 0 1-.948-1.013l.368-.81l-8.58-3.822a.75.75 0 0 1-.38-.99ZM1.25 5.5a1 1 0 0 0-1 1v7a.5.5 0 0 0 .5.5h2.5a.5.5 0 0 0 .5-.5v-7a1 1 0 0 0-1-1zm4.293 1.793A1 1 0 0 1 6.25 7h1.5a1 1 0 0 1 1 1v5.5a.5.5 0 0 1-.5.5h-2.5a.5.5 0 0 1-.5-.5V8a1 1 0 0 1 .293-.707M11.25 8.5a1 1 0 0 0-1 1v4a.5.5 0 0 0 .5.5h2.5a.5.5 0 0 0 .5-.5v-4a1 1 0 0 0-1-1z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Kerugian
                                                    </a>
                                                    <a href="{{ route('bencana.form-lanjutan', $item->id) }}" class="dropdown-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2m-8 14H7v-4h4zm0-6H7V7h4zm6 6h-4v-4h4zm0-6h-4V7h4z"/>
                                                        </svg>
                                                        Form Lanjutan
                                                    </a>
                                                    <a href="{{ route('bencana.show', $item->id) }}" class="dropdown-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0" />
                                                        </svg>
                                                        Detail
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
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
                        <form action="{{ route('bencana.index') }}" method="GET" id="filterForm">
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
