@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <h3>Formulir 01 - Surat Permohonan Keterlibatan dalam PDNA</h3>
        <p class="text-subtitle text-muted">Pengisian formulir permohonan keterlibatan dalam Pengkajian Kebutuhan Pascabencana</p>
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
            <h4 class="card-title">Data Surat Permohonan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('forms.form1.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->get('bencana_id') }}">
                
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
                            <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" required>
                            @error('nomor_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="sifat">Sifat Surat</label>
                            <select class="form-select @error('sifat') is-invalid @enderror" id="sifat" name="sifat" required>
                                <option value="" disabled selected>Pilih Sifat Surat</option>
                                <option value="Segera" {{ old('sifat') == 'Segera' ? 'selected' : '' }}>Segera</option>
                                <option value="Biasa" {{ old('sifat') == 'Biasa' ? 'selected' : '' }}>Biasa</option>
                                <option value="Rahasia" {{ old('sifat') == 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                            </select>
                            @error('sifat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="lampiran">Lampiran</label>
                            <input type="text" class="form-control @error('lampiran') is-invalid @enderror" id="lampiran" name="lampiran" value="{{ old('lampiran') }}" placeholder="Contoh: 2 lembar">
                            @error('lampiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-8 mb-3">
                        <div class="form-group">
                            <label for="perihal">Perihal</label>
                            <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal" name="perihal" value="{{ old('perihal', 'Permohonan Keterlibatan dalam PDNA') }}" required>
                            @error('perihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="tanggal_surat">Tanggal Surat</label>
                            <input type="date" class="form-control @error('tanggal_surat') is-invalid @enderror" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat', date('Y-m-d')) }}">
                            @error('tanggal_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="kepada">Kepada</label>
                            <input type="text" class="form-control @error('kepada') is-invalid @enderror" id="kepada" name="kepada" value="{{ old('kepada') }}" placeholder="Contoh: Direktur [Nama Kementerian/OPD]" required>
                            @error('kepada')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="lokasi_pdna">Lokasi PDNA</label>
                            <input type="text" class="form-control @error('lokasi_pdna') is-invalid @enderror" id="lokasi_pdna" name="lokasi_pdna" value="{{ old('lokasi_pdna') }}" required>
                            @error('lokasi_pdna')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="hari_tanggal">Hari/Tanggal Konsolidasi</label>
                            <input type="date" class="form-control @error('hari_tanggal') is-invalid @enderror" id="hari_tanggal" name="hari_tanggal" value="{{ old('hari_tanggal') }}" required>
                            @error('hari_tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="waktu">Waktu Konsolidasi</label>
                            <input type="time" class="form-control @error('waktu') is-invalid @enderror" id="waktu" name="waktu" value="{{ old('waktu') }}" required>
                            @error('waktu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="tempat">Tempat Konsolidasi</label>
                            <input type="text" class="form-control @error('tempat') is-invalid @enderror" id="tempat" name="tempat" value="{{ old('tempat') }}" required>
                            @error('tempat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="agenda">Agenda Konsolidasi</label>
                            <input type="text" class="form-control @error('agenda') is-invalid @enderror" id="agenda" name="agenda" value="{{ old('agenda', 'Konsolidasi awal PDNA') }}" required>
                            @error('agenda')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="nama_penandatangan">Nama Penandatangan</label>
                            <input type="text" class="form-control @error('nama_penandatangan') is-invalid @enderror" id="nama_penandatangan" name="nama_penandatangan" value="{{ old('nama_penandatangan') }}" required>
                            @error('nama_penandatangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="jabatan_penandatangan">Jabatan Penandatangan</label>
                            <select class="form-select @error('jabatan_penandatangan') is-invalid @enderror" id="jabatan_penandatangan" name="jabatan_penandatangan" required>
                                <option value="" disabled selected>Pilih Jabatan</option>
                                <option value="Deputi Rehabilitasi BNPB" {{ old('jabatan_penandatangan') == 'Deputi Rehabilitasi BNPB' ? 'selected' : '' }}>Deputi Rehabilitasi BNPB</option>
                                <option value="Kepala BPBD" {{ old('jabatan_penandatangan') == 'Kepala BPBD' ? 'selected' : '' }}>Kepala BPBD</option>
                                <option value="Sekretaris BPBD" {{ old('jabatan_penandatangan') == 'Sekretaris BPBD' ? 'selected' : '' }}>Sekretaris BPBD</option>
                                <option value="Lainnya" {{ old('jabatan_penandatangan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jabatan_penandatangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3" id="jabatan_lainnya_container" style="display: none;">
                        <div class="form-group">
                            <label for="jabatan_lainnya">Jabatan Lainnya</label>
                            <input type="text" class="form-control @error('jabatan_lainnya') is-invalid @enderror" id="jabatan_lainnya" name="jabatan_lainnya" value="{{ old('jabatan_lainnya') }}">
                            @error('jabatan_lainnya')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="tembusan">Tembusan</label>
                            <textarea class="form-control @error('tembusan') is-invalid @enderror" id="tembusan" name="tembusan" rows="3" placeholder="Masukkan daftar tembusan, pisahkan dengan baris baru">{{ old('tembusan') }}</textarea>
                            <small class="form-text text-muted">Contoh: Kepala BNPB, Menteri PUPR, dll. Setiap baris untuk satu penerima tembusan.</small>
                            @error('tembusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="instansi_pengirim">Instansi Pengirim</label>
                            <input type="text" class="form-control @error('instansi_pengirim') is-invalid @enderror" id="instansi_pengirim" name="instansi_pengirim" value="{{ old('instansi_pengirim') }}" placeholder="Contoh: BNPB, BPBD Provinsi Papua, dll">
                            @error('instansi_pengirim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('forms.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Formulir</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to show/hide jabatan lainnya field
        const jabatanSelect = document.getElementById('jabatan_penandatangan');
        const jabatanLainnyaContainer = document.getElementById('jabatan_lainnya_container');
        
        // Check on load
        if (jabatanSelect.value === 'Lainnya') {
            jabatanLainnyaContainer.style.display = 'block';
        } else {
            jabatanLainnyaContainer.style.display = 'none';
        }
        
        // Check on change
        jabatanSelect.addEventListener('change', function() {
            if (this.value === 'Lainnya') {
                jabatanLainnyaContainer.style.display = 'block';
            } else {
                jabatanLainnyaContainer.style.display = 'none';
            }
        });

        // Set default date for hari_tanggal if empty
        const hariTanggalInput = document.getElementById('hari_tanggal');
        if (!hariTanggalInput.value) {
            // Set to tomorrow's date as default
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const formattedDate = tomorrow.toISOString().split('T')[0];
            hariTanggalInput.value = formattedDate;
        }
        
        // Set default time for waktu if empty
        const waktuInput = document.getElementById('waktu');
        if (!waktuInput.value) {
            // Default to 10:00 AM
            waktuInput.value = '10:00';
        }
    });
</script>
@endsection
