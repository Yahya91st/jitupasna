@extends('layouts.main')

@section('content')
<style>
    /* Container & Layout */
    .list-container {
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
        background: #F28705;
        color: white;
        padding: 15px 20px;
        border-bottom: none;
    }

    .card-header h4 {
        margin: 0;
        font-weight: 600;
        color: white;
    }

    /* Page Title Styling */
    .page-heading h3 {
        color: #F28705;
        font-weight: 600;
        font-family: 'Times New Roman', serif;
    }

    /* Alert Styling */
    .alert-info {
        background: white;
        border: 2px solid #6c757d;
        color: #6c757d;
        border-radius: 4px;
    }

    .alert-info .alert-heading {
        color: #6c757d;
        font-weight: 600;
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
        padding: 12px 15px;
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

    .btn-primary {
        background: #F28705;
        border-color: #F28705;
        color: white;
    }

    .btn-primary:hover {
        background: #e07404;
        border-color: #e07404;
        color: white;
    }

    .btn-danger {
        background: #007bff;
        border-color: #007bff;
        color: white;
    }

    .btn-danger:hover {
        background: #0056b3;
        border-color: #0056b3;
        color: white;
    }

    /* Modal Styling */
    .modal-header {
        background: #6c757d;
        color: white;
        border-bottom: none;
    }

    .modal-header h4 {
        color: white;
        font-weight: 600;
    }

    .modal-header .close {
        color: white;
        opacity: 0.8;
    }

    /* Form Styling */
    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .form-select {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 8px 12px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .form-select:focus {
        border-color: #6c757d;
        box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
    }

    /* Location List Styling */
    .location-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .location-list li {
        padding: 2px 0;
        color: #555;
        font-size: 14px;
    }

    /* Card Content */
    .card-content {
        padding: 20px;
    }
</style>
<div class="list-container">
    <div class="page-heading">
        <div class="page-title mb-4">
            <h3>Pilih Kejadian Bencana</h3>
            <p class="text-subtitle text-muted">Silahkan pilih kejadian bencana untuk melihat data kerusakan</p>
        </div>
    </div>

<div class="row" id="table-striped">
        <div class="col-12">
            <div class="main-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Daftar Kejadian Bencana</h4>
                    <div>
                        <button class="btn btn-danger" type="button" data-toggle="modal"
                            data-target="#inlineForm" style="font-weight: 500;">Filter</button>
                    </div>
                </div>
                <div class="card-content">
                    <div class="alert alert-info">
                        <h5 class="alert-heading"><i data-feather="info"></i> Informasi</h5>
                        <p>Pilih bencana untuk melihat semua data kerusakan yang telah diinput pada formulir-formulir pendataan.</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
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
                                            <div class="d-flex align-items-center">
                                                <img class="rounded img-fluid avatar-40 me-3 bg-soft-primary"
                                                    src="{{ asset('/frontend/dist/assets/images/avatar/' . $item['gambar']) }}"
                                                    alt="profile" style="width: 100px; height: 100px; margin-right: 10px;">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-0">{{ $item->kategori_bencana->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-bold-500">{{ $item->tanggal }}</td>
                                        <td>
                                            <ul class="location-list">
                                                @foreach ($item->desa as $desa)
                                                    <li>{{ $desa->nama }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ route('kerusakan.detail', $item->id) }}" class="btn btn-orange" style="font-weight: 500;">
                                                <i class="fa fa-chart-bar mr-1"></i>
                                                Lihat Data Kerusakan
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bd-example" style="margin-left: 10px; margin-top:10px; margin-right:10px">
                            {{ $bencana->links() }}
                        </div>
                    </div>
                </div>
                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Filter Bencana</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>                            
                            <form action="{{ route('kerusakan.list') }}" method="GET" id="filterForm">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="first-name-column">Kategori Bencana</label>
                                        <div class="form-group">
                                            <select class="form-select" name="kategori_bencana_id" id="kategori_bencana_id">
                                                <option selected disabled value="">{{ __('Pilih...') }}</option>
                                                @foreach ($kategoribencana as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ request()->input('kategori_bencana_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" onclick="resetFilters()"
                                        data-dismiss="modal" style="font-weight: 500;">{{ __('Reset') }}</button>
                                    <button type="submit" class="btn btn-orange mr-1 mb-1" style="font-weight: 500;">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function resetFilters() {
        document.getElementById('kategori_bencana_id').value = '';
        document.getElementById('filterForm').submit();
    }
</script>
