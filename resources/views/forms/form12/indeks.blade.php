@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Indeks Perbedaan Biaya dan Pemutakhiran Anggaran</h1>
    
    <div class="mb-4 flex justify-between">
        <a href="{{ route('forms.form12.list') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali ke Anggaran
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tambah Data Indeks Biaya</h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('forms.form12.store-indeks') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" id="provinsi" class="form-control" value="{{ old('provinsi') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kota" class="form-label">Kota/Kabupaten</label>
                                <input type="text" name="kota" id="kota" class="form-control" value="{{ old('kota') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 mb-3">
                                <label for="indeks_umum" class="form-label">Indeks Umum</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_umum" id="indeks_umum" class="form-control" value="{{ old('indeks_umum', 1.0000) }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="indeks_perumahan" class="form-label">Indeks Perumahan</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_perumahan" id="indeks_perumahan" class="form-control" value="{{ old('indeks_perumahan', 1.0000) }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="indeks_kesehatan" class="form-label">Indeks Kesehatan</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_kesehatan" id="indeks_kesehatan" class="form-control" value="{{ old('indeks_kesehatan', 1.0000) }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="indeks_pendidikan" class="form-label">Indeks Pendidikan</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_pendidikan" id="indeks_pendidikan" class="form-control" value="{{ old('indeks_pendidikan', 1.0000) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 mb-3">
                                <label for="indeks_sosial" class="form-label">Indeks Sosial</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_sosial" id="indeks_sosial" class="form-control" value="{{ old('indeks_sosial', 1.0000) }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="indeks_ekonomi" class="form-label">Indeks Ekonomi</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_ekonomi" id="indeks_ekonomi" class="form-control" value="{{ old('indeks_ekonomi', 1.0000) }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="indeks_infrastruktur" class="form-label">Indeks Infrastruktur</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_infrastruktur" id="indeks_infrastruktur" class="form-control" value="{{ old('indeks_infrastruktur', 1.0000) }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="indeks_pemerintahan" class="form-label">Indeks Pemerintahan</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_pemerintahan" id="indeks_pemerintahan" class="form-control" value="{{ old('indeks_pemerintahan', 1.0000) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary float-end">Simpan Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <h5 class="p-3 bg-light border-bottom">Data Indeks Biaya</h5>
        @if(isset($indeksBiaya) && $indeksBiaya->count() > 0)
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Provinsi</th>
                        <th>Kota/Kabupaten</th>
                        <th>Indeks Umum</th>
                        <th>Indeks Perumahan</th>
                        <th>Indeks Kesehatan</th>
                        <th>Indeks Pendidikan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($indeksBiaya as $index => $indeks)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $indeks->provinsi }}</td>
                        <td>{{ $indeks->kota }}</td>
                        <td>{{ number_format($indeks->indeks_umum, 4) }}</td>
                        <td>{{ number_format($indeks->indeks_perumahan, 4) }}</td>
                        <td>{{ number_format($indeks->indeks_kesehatan, 4) }}</td>
                        <td>{{ number_format($indeks->indeks_pendidikan, 4) }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('forms.form12.edit-indeks', $indeks->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" title="Hapus" onclick="confirmDelete('{{ $indeks->id }}')">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $indeks->id }}" action="{{ route('forms.form12.delete-indeks', $indeks->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-6 text-center">
                <p>Belum ada data indeks biaya yang disimpan.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            }
        });
    });
    
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endpush
