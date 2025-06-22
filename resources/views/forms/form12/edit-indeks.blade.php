@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Indeks Biaya</h4>
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

                    <form action="{{ route('forms.form12.update-indeks', $indeksBiaya->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" id="provinsi" class="form-control" value="{{ old('provinsi', $indeksBiaya->provinsi) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kota" class="form-label">Kota/Kabupaten</label>
                                <input type="text" name="kota" id="kota" class="form-control" value="{{ old('kota', $indeksBiaya->kota) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 mb-3">
                                <label for="indeks_umum" class="form-label">Indeks Umum</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_umum" id="indeks_umum" class="form-control" value="{{ old('indeks_umum', $indeksBiaya->indeks_umum) }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="indeks_perumahan" class="form-label">Indeks Perumahan</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_perumahan" id="indeks_perumahan" class="form-control" value="{{ old('indeks_perumahan', $indeksBiaya->indeks_perumahan) }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="indeks_kesehatan" class="form-label">Indeks Kesehatan</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_kesehatan" id="indeks_kesehatan" class="form-control" value="{{ old('indeks_kesehatan', $indeksBiaya->indeks_kesehatan) }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="indeks_pendidikan" class="form-label">Indeks Pendidikan</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_pendidikan" id="indeks_pendidikan" class="form-control" value="{{ old('indeks_pendidikan', $indeksBiaya->indeks_pendidikan) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 mb-3">
                                <label for="indeks_sosial" class="form-label">Indeks Sosial</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_sosial" id="indeks_sosial" class="form-control" value="{{ old('indeks_sosial', $indeksBiaya->indeks_sosial) }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="indeks_ekonomi" class="form-label">Indeks Ekonomi</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_ekonomi" id="indeks_ekonomi" class="form-control" value="{{ old('indeks_ekonomi', $indeksBiaya->indeks_ekonomi) }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="indeks_infrastruktur" class="form-label">Indeks Infrastruktur</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_infrastruktur" id="indeks_infrastruktur" class="form-control" value="{{ old('indeks_infrastruktur', $indeksBiaya->indeks_infrastruktur) }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="indeks_pemerintahan" class="form-label">Indeks Pemerintahan</label>
                                <input type="number" step="0.0001" min="0.0001" max="5.0000" name="indeks_pemerintahan" id="indeks_pemerintahan" class="form-control" value="{{ old('indeks_pemerintahan', $indeksBiaya->indeks_pemerintahan) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('forms.form12.indeks') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary float-end">Perbarui Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
