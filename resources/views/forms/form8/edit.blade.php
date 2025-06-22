@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <h3>Edit Formulir 08 - Pengolahan dan Analisis Data Penilaian Kerusakan dan Kerugian</h3>
        <p class="text-subtitle text-muted">Edit formulir pengolahan dan analisis data penilaian kerusakan dan kerugian</p>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Data Penilaian</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('forms.form8.update', $penilaian->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="bencana_id" value="{{ $penilaian->bencana_id }}">
                
                <!-- Data Bencana -->
                @if(isset($bencana))
                <div class="col-md-12 mb-4">
                    <div class="alert alert-light-primary color-primary">
                        <p><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama }}</p>
                        <p><strong>Tanggal:</strong> {{ $bencana->tanggal }}</p>
                        <p><strong>Lokasi:</strong> 
                            @foreach($bencana->desa as $desa)
                                {{ $desa->nama }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                    </div>
                </div>
                @endif

                <!-- 1. Informasi Umum -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-3 mb-4">1. Informasi Umum</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_dokumen">Nomor Dokumen</label>
                            <input type="text" class="form-control @error('nomor_dokumen') is-invalid @enderror" 
                                   id="nomor_dokumen" name="nomor_dokumen" value="{{ old('nomor_dokumen', $penilaian->nomor_dokumen) }}" required>
                            @error('nomor_dokumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                   id="tanggal" name="tanggal" value="{{ old('tanggal', $penilaian->tanggal) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 2. Tim Penilai -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-4 mb-3">2. Tim Penilai</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tim_penilai">Tim Penilai</label>
                            <textarea class="form-control @error('tim_penilai') is-invalid @enderror" 
                                      id="tim_penilai" name="tim_penilai" rows="4" required>{{ old('tim_penilai', $penilaian->tim_penilai) }}</textarea>
                            <small class="text-muted">Masukkan nama dan instansi anggota tim penilai, satu per baris</small>
                            @error('tim_penilai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 3. Metodologi -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-4 mb-3">3. Metodologi</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="metodologi">Metodologi Penilaian</label>
                            <textarea class="form-control @error('metodologi') is-invalid @enderror" 
                                      id="metodologi" name="metodologi" rows="4" required>{{ old('metodologi', $penilaian->metodologi) }}</textarea>
                            <small class="text-muted">Jelaskan metodologi yang digunakan dalam penilaian</small>
                            @error('metodologi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 4. Sektor Terkena Dampak -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-4 mb-3">4. Sektor Terkena Dampak</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sektor_terkena_dampak">Sektor Terkena Dampak</label>
                            <textarea class="form-control @error('sektor_terkena_dampak') is-invalid @enderror" 
                                      id="sektor_terkena_dampak" name="sektor_terkena_dampak" rows="4" required>{{ old('sektor_terkena_dampak', $penilaian->sektor_terkena_dampak) }}</textarea>
                            <small class="text-muted">Jelaskan sektor-sektor yang terkena dampak bencana</small>
                            @error('sektor_terkena_dampak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 5. Dampak Ekonomi -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-4 mb-3">5. Dampak Ekonomi</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="dampak_ekonomi">Dampak Ekonomi</label>
                            <textarea class="form-control @error('dampak_ekonomi') is-invalid @enderror" 
                                      id="dampak_ekonomi" name="dampak_ekonomi" rows="4" required>{{ old('dampak_ekonomi', $penilaian->dampak_ekonomi) }}</textarea>
                            <small class="text-muted">Jelaskan dampak ekonomi dari bencana</small>
                            @error('dampak_ekonomi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 6. Dampak Sosial -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-4 mb-3">6. Dampak Sosial</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="dampak_sosial">Dampak Sosial</label>
                            <textarea class="form-control @error('dampak_sosial') is-invalid @enderror" 
                                      id="dampak_sosial" name="dampak_sosial" rows="4" required>{{ old('dampak_sosial', $penilaian->dampak_sosial) }}</textarea>
                            <small class="text-muted">Jelaskan dampak sosial dari bencana</small>
                            @error('dampak_sosial')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 7. Kebutuhan Pemulihan -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-4 mb-3">7. Kebutuhan Pemulihan</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kebutuhan_pemulihan">Kebutuhan Pemulihan</label>
                            <textarea class="form-control @error('kebutuhan_pemulihan') is-invalid @enderror" 
                                      id="kebutuhan_pemulihan" name="kebutuhan_pemulihan" rows="4" required>{{ old('kebutuhan_pemulihan', $penilaian->kebutuhan_pemulihan) }}</textarea>
                            <small class="text-muted">Jelaskan kebutuhan pemulihan pascabencana</small>
                            @error('kebutuhan_pemulihan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 8. Kesimpulan -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-4 mb-3">8. Kesimpulan</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kesimpulan">Kesimpulan</label>
                            <textarea class="form-control @error('kesimpulan') is-invalid @enderror" 
                                      id="kesimpulan" name="kesimpulan" rows="4" required>{{ old('kesimpulan', $penilaian->kesimpulan) }}</textarea>
                            @error('kesimpulan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 9. Rekomendasi -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-4 mb-3">9. Rekomendasi</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="rekomendasi">Rekomendasi</label>
                            <textarea class="form-control @error('rekomendasi') is-invalid @enderror" 
                                      id="rekomendasi" name="rekomendasi" rows="4" required>{{ old('rekomendasi', $penilaian->rekomendasi) }}</textarea>
                            @error('rekomendasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 10. Penandatangan -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-4 mb-3">10. Penandatangan</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_penandatangan">Nama Penandatangan</label>
                            <input type="text" class="form-control @error('nama_penandatangan') is-invalid @enderror" 
                                   id="nama_penandatangan" name="nama_penandatangan" value="{{ old('nama_penandatangan', $penilaian->nama_penandatangan) }}" required>
                            @error('nama_penandatangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jabatan_penandatangan">Jabatan Penandatangan</label>
                            <input type="text" class="form-control @error('jabatan_penandatangan') is-invalid @enderror" 
                                   id="jabatan_penandatangan" name="jabatan_penandatangan" value="{{ old('jabatan_penandatangan', $penilaian->jabatan_penandatangan) }}" required>
                            @error('jabatan_penandatangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('forms.form8.show', $penilaian->id) }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
