@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <h3>Edit Formulir 09 - Pengolahan Data dan Kuesioner</h3>
        <p class="text-subtitle text-muted">Edit formulir kuesioner untuk pendataan dampak bencana terhadap masyarakat</p>
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
            <h4 class="card-title">Edit Data Kuesioner</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('forms.form9.update', $form->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="bencana_id" value="{{ $form->bencana_id }}">
                
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
                            <label for="nomor_kuesioner">Nomor Kuesioner</label>
                            <input type="text" class="form-control @error('nomor_kuesioner') is-invalid @enderror" 
                                   id="nomor_kuesioner" name="nomor_kuesioner" value="{{ old('nomor_kuesioner', $form->nomor_kuesioner) }}" required>
                            @error('nomor_kuesioner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin Responden</label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                   id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $form->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $form->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="umur">Umur</label>
                            <select class="form-select @error('umur') is-invalid @enderror" 
                                   id="umur" name="umur" required>
                                <option value="">Pilih</option>
                                <option value="20" {{ old('umur', $form->umur) == '20' ? 'selected' : '' }}>≤ 20 tahun</option>
                                <option value="30" {{ old('umur', $form->umur) == '30' ? 'selected' : '' }}>21-30 tahun</option>
                                <option value="40" {{ old('umur', $form->umur) == '40' ? 'selected' : '' }}>31-40 tahun</option>
                                <option value="50" {{ old('umur', $form->umur) == '50' ? 'selected' : '' }}>41-50 tahun</option>
                                <option value="51" {{ old('umur', $form->umur) == '51' ? 'selected' : '' }}>>50 tahun</option>
                            </select>
                            @error('umur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="desa_kelurahan">Desa/Kelurahan</label>
                            <input type="text" class="form-control @error('desa_kelurahan') is-invalid @enderror" 
                                   id="desa_kelurahan" name="desa_kelurahan" value="{{ old('desa_kelurahan', $form->desa_kelurahan) }}" required>
                            @error('desa_kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" 
                                   id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $form->kecamatan) }}" required>
                            @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Multi-select fields for dukungan_pangan_air -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Dukungan untuk Pemulihan Pangan dan Air Bersih</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_pangan_air[]" value="Bantuan pangan langsung" id="pangan_bantuan" 
                                            {{ (is_array(old('dukungan_pangan_air', $form->dukungan_pangan_air)) && in_array('Bantuan pangan langsung', old('dukungan_pangan_air', $form->dukungan_pangan_air))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pangan_bantuan">Bantuan pangan langsung</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_pangan_air[]" value="Pemulihan sumber pangan" id="pangan_pemulihan" 
                                            {{ (is_array(old('dukungan_pangan_air', $form->dukungan_pangan_air)) && in_array('Pemulihan sumber pangan', old('dukungan_pangan_air', $form->dukungan_pangan_air))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pangan_pemulihan">Pemulihan sumber pangan</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_pangan_air[]" value="Pemulihan sumber daya kemasyarakatan" id="pangan_sumber_daya" 
                                            {{ (is_array(old('dukungan_pangan_air', $form->dukungan_pangan_air)) && in_array('Pemulihan sumber daya kemasyarakatan', old('dukungan_pangan_air', $form->dukungan_pangan_air))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pangan_sumber_daya">Pemulihan sumber daya kemasyarakatan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_pangan_air[]" value="Lainnya" id="pangan_lainnya" 
                                            {{ (is_array(old('dukungan_pangan_air', $form->dukungan_pangan_air)) && in_array('Lainnya', old('dukungan_pangan_air', $form->dukungan_pangan_air))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pangan_lainnya">Lainnya</label>
                                    </div>
                                </div>
                            </div>
                            @error('dukungan_pangan_air')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Update Kuesioner</button>
                            <a href="{{ route('forms.form9.show', $form->id) }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
