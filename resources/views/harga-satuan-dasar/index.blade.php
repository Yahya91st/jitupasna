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

    .badge {
        padding: 0.35rem 0.65rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
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

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        padding: 0.6rem 1rem;
    }

    .form-control:focus,
    .form-select:focus {
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
                <h4 class="card-title mb-0">Harga Satuan Dasar</h4>
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
                                <th style="width: 100px;">Tipe</th>
                                <th>Nama</th>
                                <th style="width: 150px;">Satuan</th>
                                <th style="width: 180px;">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hsd as $item)
                                <tr>
                                    @if ($item->tipe == 1)
                                        <td><span class="badge bg-danger">Bahan</span></td>
                                    @elseif ($item->tipe == 2)
                                        <td><span class="badge bg-success">Upah</span></td>
                                    @elseif ($item->tipe == 3)
                                        <td><span class="badge bg-warning">Alat</span></td>
                                    @endif
                                    <td style="font-weight: 500; color: #495057;">{{ $item->nama }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td style="font-weight: 500;">{{ 'Rp ' . number_format($item->harga, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="bd-example" style="margin-left: 10px; margin-top:10px; margin-right:10px">
                        {{ $hsd->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Form Harga Satuan Dasar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('hsd.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label>Tipe: </label>
                    <div class="form-group">
                        <select class="choices form-select" name="tipe" id="tipe">
                            <option value="1">Bahan</option>
                            <option value="2">Upah</option>
                            <option value="3">Alat</option>
                        </select>
                    </div>
                    <label>Nama: </label>
                    <div class="form-group">
                        <div id="quill-nama"></div>
                        <input type="hidden" name="nama" id="nama">
                    </div>
                    <label>Satuan: </label>
                    <div class="form-group">
                        <div id="quill-satuan"></div>
                        <input type="hidden" name="satuan" id="satuan">
                    </div>
                    <label>Harga: </label>
                    <div class="form-group">
                        <input type="text" id="harga" placeholder="Masukkan harga" class="form-control">
                        <input type="hidden" name="harga" id="harga-hidden">
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
                <h4 class="modal-title" id="myModalLabel33">Filter Harga Satuan Dasar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('hsd.index') }}" method="GET" id="filterForm">
                <div class="modal-body">
                    <label>Pencarian: </label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ request()->input('nama') }}"
                            placeholder="Masukan nama/satuan...">
                    </div>
                    <label>Tipe: </label>
                    <div class="form-group">
                        <select class="form-select" name="tipe" id="tipe">
                            <option selected disabled value="">Pilih...</option>
                            <option value="1">Bahan</option>
                            <option value="2">Upah</option>
                            <option value="3">Alat</option>
                        </select>
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

@push('script')
    <script src="{{ asset('frontend/dist/assets/vendors/quill/quill.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function initializeQuill(selector) {
                return new Quill(selector, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{
                                font: []
                            }, {
                                size: []
                            }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{
                                color: []
                            }, {
                                background: []
                            }],
                            [{
                                script: 'super'
                            }, {
                                script: 'sub'
                            }],
                            [{
                                list: 'ordered'
                            }, {
                                list: 'bullet'
                            }, {
                                indent: '-1'
                            }, {
                                indent: '+1'
                            }],
                            ['clean']
                        ]
                    }
                });
            }

            const namaEditor = initializeQuill('#quill-nama');
            const satuanEditor = initializeQuill('#quill-satuan');

            document.querySelector('form').onsubmit = function() {
                document.querySelector('#nama').value = namaEditor.root.innerHTML;
                document.querySelector('#satuan').value = satuanEditor.root.innerHTML;

                console.log('satuan:', satuanEditor.root.innerHTML);
            };
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cleave = new Cleave('#harga', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                delimiter: '.',
                numeralDecimalMark: ',',
                prefix: 'Rp '
            });

            document.querySelector('form').onsubmit = function() {
                const formattedValue = cleave.getRawValue();
                document.querySelector('#harga-hidden').value = formattedValue;

                console.log(formattedValue);
            };
        });
    </script>

    <script>
        function resetFilters() {
            document.getElementById('nama').value = '';
            document.getElementById('tipe').value = '';
            document.getElementById('filterForm').submit();
        }
    </script>
@endpush
