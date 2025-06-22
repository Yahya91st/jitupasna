@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <h3>Edit Formulir 01 - Surat Permohonan Keterlibatan dalam PDNA</h3>
        <p class="text-subtitle text-muted">Edit formulir permohonan keterlibatan dalam Pengkajian Kebutuhan Pascabencana</p>
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
            <h4 class="card-title">Edit Data Surat Permohonan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('forms.form1.update', $form->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="bencana_id" value="{{ $form->bencana_id }}">
                
                <div class="row">
                    <!-- Data Bencana -->
                    @if($bencana)
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
                    
                    <!-- Data Surat -->
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="nomor_surat">Nomor Surat</label>
                            <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $form->nomor_surat) }}" required>
                            @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="sifat">Sifat</label>
                            <select class="form-select @error('sifat') is-invalid @enderror" id="sifat" name="sifat" required>
                                <option value="">Pilih Sifat</option>
                                <option value="Segera" {{ old('sifat', $form->sifat) == 'Segera' ? 'selected' : '' }}>Segera</option>
                                <option value="Biasa" {{ old('sifat', $form->sifat) == 'Biasa' ? 'selected' : '' }}>Biasa</option>
                                <option value="Rahasia" {{ old('sifat', $form->sifat) == 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                            </select>
                            @error('sifat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="lampiran">Lampiran</label>
                            <input type="text" class="form-control @error('lampiran') is-invalid @enderror" id="lampiran" name="lampiran" value="{{ old('lampiran', $form->lampiran) }}">
                            @error('lampiran')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-8 mb-3">
                        <div class="form-group">
                            <label for="perihal">Perihal</label>
                            <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal" name="perihal" value="{{ old('perihal', $form->perihal) }}" required>
                            @error('perihal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="tanggal_surat">Tanggal Surat</label>
                            <input type="date" class="form-control @error('tanggal_surat') is-invalid @enderror" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat', $form->tanggal_surat) }}" required>
                            @error('tanggal_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="kepada">Kepada</label>
                            <input type="text" class="form-control @error('kepada') is-invalid @enderror" id="kepada" name="kepada" value="{{ old('kepada', $form->kepada) }}" required>
                            @error('kepada')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="instansi_pengirim">Instansi Pengirim</label>
                            <input type="text" class="form-control @error('instansi_pengirim') is-invalid @enderror" id="instansi_pengirim" name="instansi_pengirim" value="{{ old('instansi_pengirim', $form->instansi_pengirim) }}">
                            @error('instansi_pengirim')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="lokasi_pdna">Lokasi PDNA</label>
                            <input type="text" class="form-control @error('lokasi_pdna') is-invalid @enderror" id="lokasi_pdna" name="lokasi_pdna" value="{{ old('lokasi_pdna', $form->lokasi_pdna) }}" required>
                            @error('lokasi_pdna')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="hari_tanggal">Hari/Tanggal</label>
                            <input type="date" class="form-control @error('hari_tanggal') is-invalid @enderror" id="hari_tanggal" name="hari_tanggal" value="{{ old('hari_tanggal', $form->hari_tanggal) }}" required>
                            @error('hari_tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="waktu">Waktu</label>
                            <input type="time" class="form-control @error('waktu') is-invalid @enderror" id="waktu" name="waktu" value="{{ old('waktu', $form->waktu) }}" required>
                            @error('waktu')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="tempat">Tempat</label>
                            <input type="text" class="form-control @error('tempat') is-invalid @enderror" id="tempat" name="tempat" value="{{ old('tempat', $form->tempat) }}" required>
                            @error('tempat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="agenda">Agenda</label>
                            <input type="text" class="form-control @error('agenda') is-invalid @enderror" id="agenda" name="agenda" value="{{ old('agenda', $form->agenda) }}" required>
                            @error('agenda')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="nama_penandatangan">Nama Penandatangan</label>
                            <input type="text" class="form-control @error('nama_penandatangan') is-invalid @enderror" id="nama_penandatangan" name="nama_penandatangan" value="{{ old('nama_penandatangan', $form->nama_penandatangan) }}" required>
                            @error('nama_penandatangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="jabatan_penandatangan">Jabatan Penandatangan</label>
                            <input type="text" class="form-control @error('jabatan_penandatangan') is-invalid @enderror" id="jabatan_penandatangan" name="jabatan_penandatangan" value="{{ old('jabatan_penandatangan', $form->jabatan_penandatangan) }}" required>
                            @error('jabatan_penandatangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="tembusan">Tembusan</label>
                            <textarea class="form-control @error('tembusan') is-invalid @enderror" id="tembusan" name="tembusan" rows="3">{{ old('tembusan', $form->tembusan) }}</textarea>
                            <small class="form-text text-muted">Masukkan tembusan surat. Setiap tembusan dipisahkan dengan baris baru.</small>
                            @error('tembusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-between">
                        <a href="{{ route('forms.form1.show', $form->id) }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
