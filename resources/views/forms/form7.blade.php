@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Formulir 07 - Diskusi Kelompok Terfokus (FGD)</h3>
                <p class="text-subtitle text-muted">Formulir pendataan untuk Diskusi Kelompok Terfokus (FGD) pascabencana</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-end float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('forms.index') }}">Forms</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Formulir 07</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Input Data FGD</h4>
        </div>
        <div class="card-content">
            <div class="card-body">                <form action="{{ route('forms.form7.store') }}" method="POST" class="form form-vertical">
                    @csrf
                    
                    <!-- Section 1: Informasi Umum -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">1. Informasi Umum</h5>
                        </div>
                        <div class="card-body">
                            <!-- Bencana selection -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="bencana_id">Bencana <span class="text-danger">*</span></label>
                                        @if(request()->has('bencana_id') && is_object($bencana))
                                            <input type="hidden" name="bencana_id" value="{{ $bencana->id }}">
                                            <p class="form-control-static">{{ $bencana->Ref }} - {{ $bencana->kategori_bencana->nama }} ({{ $bencana->tanggal }})</p>
                                        @else
                                            <select class="form-select @error('bencana_id') is-invalid @enderror" id="bencana_id" name="bencana_id" required>
                                                <option value="">-- Pilih Bencana --</option>
                                                @foreach($bencana as $b)
                                                    <option value="{{ $b->id }}" {{ old('bencana_id') == $b->id ? 'selected' : '' }}>
                                                        {{ $b->Ref }} - {{ $b->kategori_bencana->nama }} ({{ $b->tanggal }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('bencana_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="desa_kelurahan">Desa/Kelurahan Asal <span class="text-danger">*</span></label>
                                        <input type="text" id="desa_kelurahan" class="form-control @error('desa_kelurahan') is-invalid @enderror" name="desa_kelurahan" value="{{ old('desa_kelurahan') }}" required>
                                        @error('desa_kelurahan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan Asal <span class="text-danger">*</span></label>
                                        <input type="text" id="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" value="{{ old('kecamatan') }}" required>
                                        @error('kecamatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kabupaten">Kabupaten Asal <span class="text-danger">*</span></label>
                                        <input type="text" id="kabupaten" class="form-control @error('kabupaten') is-invalid @enderror" name="kabupaten" value="{{ old('kabupaten') }}" required>
                                        @error('kabupaten')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                        <input type="date" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                        @error('tanggal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jarak_bencana">Jarak dari Lokasi Bencana (KM) <span class="text-danger">*</span></label>
                                        <input type="number" id="jarak_bencana" class="form-control @error('jarak_bencana') is-invalid @enderror" name="jarak_bencana" value="{{ old('jarak_bencana') }}" min="0" required>
                                        @error('jarak_bencana')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Section 2: Informasi Peserta -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">2. Informasi Peserta</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempat_sesi">Tempat Sesi <span class="text-danger">*</span></label>
                                        <input type="text" id="tempat_sesi" class="form-control @error('tempat_sesi') is-invalid @enderror" name="tempat_sesi" value="{{ old('tempat_sesi') }}" required>
                                        @error('tempat_sesi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jumlah_peserta">Jumlah Peserta <span class="text-danger">*</span></label>
                                        <input type="number" id="jumlah_peserta" class="form-control @error('jumlah_peserta') is-invalid @enderror" name="jumlah_peserta" value="{{ old('jumlah_peserta') }}" min="1" required>
                                        @error('jumlah_peserta')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jumlah_perempuan">Jumlah Peserta Perempuan <span class="text-danger">*</span></label>
                                        <input type="number" id="jumlah_perempuan" class="form-control @error('jumlah_perempuan') is-invalid @enderror" name="jumlah_perempuan" value="{{ old('jumlah_perempuan') }}" min="0" required>
                                        @error('jumlah_perempuan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jumlah_laki_laki">Jumlah Peserta Laki-laki <span class="text-danger">*</span></label>
                                        <input type="number" id="jumlah_laki_laki" class="form-control @error('jumlah_laki_laki') is-invalid @enderror" name="jumlah_laki_laki" value="{{ old('jumlah_laki_laki') }}" min="0" required>
                                        @error('jumlah_laki_laki')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="komposisi_peserta">Komposisi Peserta <span class="text-danger">*</span></label>
                                        <textarea id="komposisi_peserta" class="form-control @error('komposisi_peserta') is-invalid @enderror" name="komposisi_peserta" rows="3" placeholder="Gambaran pekerjaan, status sosial, kelompok umur, dll." required>{{ old('komposisi_peserta') }}</textarea>
                                        @error('komposisi_peserta')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Section 3: Penyelenggara -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">3. Penyelenggara</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fasilitator">Fasilitator <span class="text-danger">*</span></label>
                                        <input type="text" id="fasilitator" class="form-control @error('fasilitator') is-invalid @enderror" name="fasilitator" value="{{ old('fasilitator') }}" required>
                                        @error('fasilitator')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pencatat">Pencatat <span class="text-danger">*</span></label>
                                        <input type="text" id="pencatat" class="form-control @error('pencatat') is-invalid @enderror" name="pencatat" value="{{ old('pencatat') }}" required>
                                        @error('pencatat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Section 4: Checklist Persiapan -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">4. Checklist Persiapan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold">Persiapan Pra-FGD</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="persiapan_1" name="checklist[persiapan][]" value="ruangan">
                                        <label class="form-check-label" for="persiapan_1">Ruangan sudah disiapkan</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="persiapan_2" name="checklist[persiapan][]" value="alat_tulis">
                                        <label class="form-check-label" for="persiapan_2">Alat tulis sudah tersedia</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="persiapan_3" name="checklist[persiapan][]" value="konsumsi">
                                        <label class="form-check-label" for="persiapan_3">Konsumsi sudah disiapkan</label>
                                    </div>
                                    
                                    <h6 class="font-weight-bold mt-3">Pembagian Tugas</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="tugas_1" name="checklist[tugas][]" value="fasilitator_siap">
                                        <label class="form-check-label" for="tugas_1">Fasilitator sudah ditentukan</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="tugas_2" name="checklist[tugas][]" value="pencatat_siap">
                                        <label class="form-check-label" for="tugas_2">Pencatat sudah ditentukan</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold">Agenda FGD</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="agenda_1" name="checklist[agenda][]" value="perkenalan">
                                        <label class="form-check-label" for="agenda_1">Perkenalan dan pengantar</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="agenda_2" name="checklist[agenda][]" value="pembahasan">
                                        <label class="form-check-label" for="agenda_2">Pembahasan</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="agenda_3" name="checklist[agenda][]" value="tanya_jawab">
                                        <label class="form-check-label" for="agenda_3">Pendalaman/Tanya jawab</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="agenda_4" name="checklist[agenda][]" value="kesimpulan">
                                        <label class="form-check-label" for="agenda_4">Penyimpulan dan penutupan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Section 5: Pertanyaan Diskusi -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">5. Pertanyaan Diskusi</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="font-weight-bold">Akses Hak</h6>
                                    <div class="form-group">
                                        <label for="hak_bekerja">Bagaimana akses terhadap hak bekerja setelah bencana?</label>
                                        <textarea id="hak_bekerja" class="form-control" name="pertanyaan[akses_hak][bekerja]" rows="2">{{ old('pertanyaan.akses_hak.bekerja') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="jaminan_sosial">Bagaimana akses terhadap jaminan sosial setelah bencana?</label>
                                        <textarea id="jaminan_sosial" class="form-control" name="pertanyaan[akses_hak][jaminan_sosial]" rows="2">{{ old('pertanyaan.akses_hak.jaminan_sosial') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="perlindungan_keluarga">Bagaimana perlindungan keluarga setelah bencana?</label>
                                        <textarea id="perlindungan_keluarga" class="form-control" name="pertanyaan[akses_hak][perlindungan_keluarga]" rows="2">{{ old('pertanyaan.akses_hak.perlindungan_keluarga') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="pelayanan_kesehatan">Bagaimana akses terhadap pelayanan kesehatan setelah bencana?</label>
                                        <textarea id="pelayanan_kesehatan" class="form-control" name="pertanyaan[akses_hak][pelayanan_kesehatan]" rows="2">{{ old('pertanyaan.akses_hak.pelayanan_kesehatan') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="pendidikan">Bagaimana akses terhadap pendidikan setelah bencana?</label>
                                        <textarea id="pendidikan" class="form-control" name="pertanyaan[akses_hak][pendidikan]" rows="2">{{ old('pertanyaan.akses_hak.pendidikan') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="font-weight-bold">Fungsi Pranata</h6>
                                    <div class="form-group">
                                        <label for="pranata_sosial">Bagaimana fungsi pranata sosial setelah bencana?</label>
                                        <textarea id="pranata_sosial" class="form-control" name="pertanyaan[fungsi_pranata][sosial]" rows="2">{{ old('pertanyaan.fungsi_pranata.sosial') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="pranata_ekonomi">Bagaimana fungsi pranata ekonomi setelah bencana?</label>
                                        <textarea id="pranata_ekonomi" class="form-control" name="pertanyaan[fungsi_pranata][ekonomi]" rows="2">{{ old('pertanyaan.fungsi_pranata.ekonomi') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="pranata_agama">Bagaimana fungsi pranata agama setelah bencana?</label>
                                        <textarea id="pranata_agama" class="form-control" name="pertanyaan[fungsi_pranata][agama]" rows="2">{{ old('pertanyaan.fungsi_pranata.agama') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="pranata_pemerintahan">Bagaimana fungsi pranata pemerintahan setelah bencana?</label>
                                        <textarea id="pranata_pemerintahan" class="form-control" name="pertanyaan[fungsi_pranata][pemerintahan]" rows="2">{{ old('pertanyaan.fungsi_pranata.pemerintahan') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="font-weight-bold">Resiko Kerentanan</h6>
                                    <div class="form-group">
                                        <label for="kerentanan_sosial">Karakter sosial yang paling rentan dan cara membantu:</label>
                                        <textarea id="kerentanan_sosial" class="form-control" name="pertanyaan[resiko_kerentanan][sosial]" rows="3">{{ old('pertanyaan.resiko_kerentanan.sosial') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="kerentanan_ekonomi">Karakter ekonomi yang paling rentan dan cara membantu:</label>
                                        <textarea id="kerentanan_ekonomi" class="form-control" name="pertanyaan[resiko_kerentanan][ekonomi]" rows="3">{{ old('pertanyaan.resiko_kerentanan.ekonomi') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="kerentanan_geografis">Karakter geografis yang paling rentan dan cara membantu:</label>
                                        <textarea id="kerentanan_geografis" class="form-control" name="pertanyaan[resiko_kerentanan][geografis]" rows="3">{{ old('pertanyaan.resiko_kerentanan.geografis') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    // JavaScript untuk memastikan jumlah perempuan + laki-laki = jumlah peserta total
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahPeserta = document.getElementById('jumlah_peserta');
        const jumlahPerempuan = document.getElementById('jumlah_perempuan');
        const jumlahLakiLaki = document.getElementById('jumlah_laki_laki');
        
        function validateTotalParticipants() {
            const total = parseInt(jumlahPeserta.value) || 0;
            const perempuan = parseInt(jumlahPerempuan.value) || 0;
            const lakiLaki = parseInt(jumlahLakiLaki.value) || 0;
            
            // Using more flexible validation to avoid floating point or parsing issues
            if (Math.abs((perempuan + lakiLaki) - total) > 0.001) {
                jumlahPeserta.setCustomValidity('Jumlah peserta harus sama dengan total peserta perempuan dan laki-laki');
            } else {
                jumlahPeserta.setCustomValidity('');
            }
        }
        
        jumlahPeserta.addEventListener('input', validateTotalParticipants);
        jumlahPerempuan.addEventListener('input', validateTotalParticipants);
        jumlahLakiLaki.addEventListener('input', validateTotalParticipants);
          // Auto-calculate total participants
        function updateTotalParticipants() {
            const perempuan = parseInt(jumlahPerempuan.value) || 0;
            const lakiLaki = parseInt(jumlahLakiLaki.value) || 0;
            jumlahPeserta.value = perempuan + lakiLaki;
            jumlahPeserta.setCustomValidity(''); // Clear any error when auto-calculating
        }
        
        jumlahPerempuan.addEventListener('input', updateTotalParticipants);
        jumlahLakiLaki.addEventListener('input', updateTotalParticipants);
        
        // Additional check on form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            validateTotalParticipants();
            if (jumlahPeserta.validationMessage) {
                e.preventDefault();
                alert('Harap periksa kembali: ' + jumlahPeserta.validationMessage);
                return false;
            }
        });
    });
</script>
@endpush
