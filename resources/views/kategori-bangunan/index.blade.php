@extends('layouts.main')

@section('content')
<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        background: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
        border-radius: 12px 12px 0 0 !important;
        padding: 1.5rem;
        border: none;
    }

    .card-header h4 {
        color: white;
        font-weight: 600;
        margin: 0;
    }

    .btn-add {
        background: white;
        color: #F28705;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
        color: #F28705;
    }

    .btn-filter {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.5);
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-right: 0.5rem;
    }

    .btn-filter:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(-2px);
    }

    .table thead th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        border: none;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        color: #6c757d;
        border-bottom: 1px solid #f0f0f0;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    .edit-icon {
        transition: transform 0.2s ease;
    }

    .edit-icon:hover {
        transform: scale(1.1);
    }

    .modal-content {
        border: none;
        border-radius: 12px;
    }

    .modal-header {
        background: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
        border-radius: 12px 12px 0 0;
        color: white;
        border: none;
    }

    .modal-header .modal-title {
        color: white;
        font-weight: 600;
    }

    .modal-header .close {
        color: white;
        opacity: 1;
    }

    .form-group label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        padding: 0.6rem 1rem;
    }

    .form-control:focus {
        border-color: #F28705;
        box-shadow: 0 0 0 0.2rem rgba(242, 135, 5, 0.15);
    }

    .btn-orange {
        background: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
        border: none;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-orange:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(242, 135, 5, 0.3);
        color: white;
    }

    .btn-light-secondary {
        border-radius: 8px;
        padding: 0.5rem 1.5rem;
    }

    .table-responsive {
        border-radius: 0 0 12px 12px;
    }

    .pagination {
        margin-top: 1rem;
    }

    .page-link {
        color: #F28705;
        border-radius: 8px;
        margin: 0 0.2rem;
    }

    .page-item.active .page-link {
        background-color: #F28705;
        border-color: #F28705;
    }
</style>

<div class="row" id="table-striped">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Data Kategori Bangunan</h4>
                <div>
                    <button class="btn btn-filter" type="button" data-toggle="modal" data-target="#FilterForm">
                        <i data-feather="filter" style="width: 18px; height: 18px;"></i>
                        Filter
                    </button>
                    <button type="button" class="btn btn-add" data-toggle="modal" data-target="#inlineForm">
                        <i data-feather="plus" style="width: 18px; height: 18px;"></i>
                        Tambah Data
                    </button>
                </div>
            </div>
            <div class="card-content">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th style="width: 100px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($KategoriBangunan as $item)
                                <tr>
                                    <td style="font-weight: 500; color: #495057;">{{ $item->nama }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem"
                                            viewBox="0 0 24 24" data-toggle="modal"
                                            data-target="#UpdateData{{ $item->id }}" class="edit-icon" style="cursor: pointer;">
                                            <path fill="#F28705"
                                                d="M21 12a1 1 0 0 0-1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h6a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-6a1 1 0 0 0-1-1m-15 .76V17a1 1 0 0 0 1 1h4.24a1 1 0 0 0 .71-.29l6.92-6.93L21.71 8a1 1 0 0 0 0-1.42l-4.24-4.29a1 1 0 0 0-1.42 0l-2.82 2.83l-6.94 6.93a1 1 0 0 0-.29.71m10.76-8.35l2.83 2.83l-1.42 1.42l-2.83-2.83ZM8 13.17l5.93-5.93l2.83 2.83L10.83 16H8Z" />
                                        </svg>
                                        <div class="modal fade text-left" id="UpdateData{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel33">Update Kategori Bangunan</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('kategori-bangunan.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-body">
                                                            <label>Nama: </label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="nama" value="{{ $item->nama }}" required>
                                                            </div>
                                                            <label>Deskripsi: </label>
                                                            <div class="form-group">
                                                                <textarea class="form-control" rows="3" name="deskripsi">{{ $item->deskripsi }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Batal</span>
                                                            </button>
                                                            <button type="submit" class="btn btn-orange">
                                                                Simpan Perubahan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="bd-example" style="margin-left: 10px; margin-top:10px; margin-right:10px">
                        {{ $KategoriBangunan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Tambah Kategori Bangunan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('kategori-bangunan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label>Nama: </label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <label>Deskripsi: </label>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="deskripsi"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Batal</span>
                    </button>
                    <button type="submit" class="btn btn-orange">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="FilterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Filter Kategori Bangunan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('kategori-bangunan.index') }}" method="GET" id="filterForm">
                <div class="modal-body">
                    <label>Pencarian: </label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ request()->input('nama') }}" placeholder="Cari berdasarkan nama...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" onclick="resetFilters()" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                    </button>
                    <button type="submit" class="btn btn-orange">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    function resetFilters() {
        document.getElementById('nama').value = '';
        document.getElementById('filterForm').submit();
    }
</script>
