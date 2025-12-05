@extends('layouts.main')

@section('content')
<style>
    .page-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .page-header h2 {
        color: #F28705;
        font-weight: 600;
        margin: 0;
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

    .card-header h4 {
        margin: 0;
        color: #333;
        font-weight: 600;
    }

    .card-body {
        padding: 20px;
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

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #F28705;
        box-shadow: 0 0 0 0.2rem rgba(242, 135, 5, 0.25);
    }

    .form-control:disabled,
    .form-control[readonly] {
        background: #f9f9f9;
        cursor: not-allowed;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
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

    .detail-card {
        border: 2px solid #ddd;
        border-radius: 6px;
        padding: 20px;
        background: #fafafa;
        margin-top: 15px;
    }

    #quill-deskripsi {
        min-height: 150px;
        background: white;
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
    <div class="page-header">
        <h2>Edit Data Kerusakan</h2>
    </div>

    <div class="main-card">
        <div class="card-header">
            <h4>Informasi Bencana</h4>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 15%">Bencana Ref</th>
                        <th style="width: 15%">Ref</th>
                        <th style="width: 30%">Bencana</th>
                        <th style="width: 40%">Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $bencana->Ref }}</td>
                        <td>{{ $kerusakan->Ref }}</td>
                        <td>{{ $bencana->kategori_bencana->nama }}</td>
                        <td>
                            @foreach ($bencana->desa as $index => $desa)
                                {{ $desa->nama }}{{ $index < count($bencana->desa) - 1 ? ', ' : '' }}
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="main-card">
        <form class="form" id="kerusakan-form" action="{{ route('kerusakan.update', $kerusakan->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-header">
                <h4>Update Data Kerusakan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="kategori_bangunan_id">Tipe Bangunan</label>
                            <select class="choices form-select" name="kategori_bangunan_id">
                                <option selected disabled value="">Pilih...</option>
                                @foreach ($kategoribangunan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (old('kategori_bangunan_id') ?? $kerusakan->kategori_bangunan_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <div id="quill-deskripsi"></div>
                            <input type="hidden" id="deskripsi" name="deskripsi">
                        </div>
                    </div>
                </div>
                @foreach ($kerusakan->detail as $details)
                    <input type="hidden" name="details[{{ $loop->index }}][id]" value="{{ $details->id }}">
                    <div class="detail-card">
                        @if ($details->hsd->tipe == 1)
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Tipe</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][tipe]" readonly value="Bahan">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][nama]" value="{{ $details->hsd->nama }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][satuan]" value="{{ $details->hsd->satuan }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Harga per Satuan</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][harga]" value="{{ 'Rp ' . number_format($details->hsd->harga, 2, ',', '.') }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Jumlah Kuantitas</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][kuantitas]" value="{{ $details->kuantitas_per_satuan }}">
                                    </div>
                                </div>
                            </div>
                        @elseif($details->hsd->tipe == 2)
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Tipe</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][tipe]" readonly value="Upah">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][nama]" value="{{ $details->hsd->nama }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][satuan]" value="{{ $details->hsd->satuan }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Upah per Satuan</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][harga]" value="{{ 'Rp ' . number_format($details->hsd->harga, 2, ',', '.') }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Kuantitas Berdasarkan Satuan</label>
                                        <input type="number" class="form-control" name="details[{{ $loop->index }}][kuantitas]" value="{{ $details->kuantitas_per_satuan }}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Jumlah Pekerja</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][kuantitas_item]" value="{{ $details->kuantitas_item }}">
                                    </div>
                                </div>
                            </div>
                        @elseif($details->hsd->tipe == 3)
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Tipe</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][tipe]" readonly value="Alat">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][nama]" value="{{ $details->hsd->nama }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][satuan]" value="{{ $details->hsd->satuan }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Harga per Satuan</label>
                                        <input type="text" class="form-control" name="details[{{ $loop->index }}][harga]" value="{{ 'Rp ' . number_format($details->hsd->harga, 2, ',', '.') }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Kuantitas</label>
                                        <input type="number" class="form-control" name="details[{{ $loop->index }}][kuantitas]" value="{{ $details->kuantitas_per_satuan }}">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach

                <div class="col-12 d-flex justify-content-end" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('script')
    <script src="{{ asset('frontend/dist/assets/vendors/quill/quill.min.js') }}"></script>
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     function initializeQuill(selector) {
        //         return new Quill(selector, {
        //             theme: 'snow',
        //             modules: {
        //                 toolbar: [
        //                     [{
        //                         font: []
        //                     }, {
        //                         size: []
        //                     }],
        //                     ['bold', 'italic', 'underline', 'strike'],
        //                     [{
        //                         color: []
        //                     }, {
        //                         background: []
        //                     }],
        //                     [{
        //                         script: 'super'
        //                     }, {
        //                         script: 'sub'
        //                     }],
        //                     [{
        //                         list: 'ordered'
        //                     }, {
        //                         list: 'bullet'
        //                     }, {
        //                         indent: '-1'
        //                     }, {
        //                         indent: '+1'
        //                     }],
        //                     ['direction', {
        //                         align: []
        //                     }],
        //                     // ['link', 'image', 'video'],
        //                     ['clean']
        //                 ]
        //             }
        //         });
        //     }

        //     // Inisialisasi Quill untuk masing-masing editor
        //     const descriptionEditor = initializeQuill('#quill-deskripsi');
        //     const notesEditor = initializeQuill('#full-nama');

        //     // Mengatur nilai hidden input saat form disubmit
        //     document.querySelector('form').onsubmit = function() {
        //         document.querySelector('#deskripsi').value = descriptionEditor.root.innerHTML;
        //         document.querySelector('#nama').value = notesEditor.root.innerHTML;

        //         console.log('satuan:', descriptionEditor.root.innerHTML);
        //         console.log('Catatan:', notesEditor.root.innerHTML);
        //     };
        // });
        document.addEventListener('DOMContentLoaded', function() {
            const descriptionEditor = new Quill('#quill-deskripsi', {
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
                        ['direction', {
                            align: []
                        }],
                        ['clean']
                    ]
                }
            });

            // Mengisi editor dengan data dari database
            descriptionEditor.root.innerHTML = `{!! $kerusakan->deskripsi !!}`;

            // Mengatur nilai hidden input saat form disubmit
            document.querySelector('form').onsubmit = function() {
                document.querySelector('#deskripsi').value = descriptionEditor.root.innerHTML;
            };
        });
    </script>
@endpush
