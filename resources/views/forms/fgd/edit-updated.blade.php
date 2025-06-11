@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Data FGD</h3>
                <p class="text-subtitle text-muted">Edit data Diskusi Kelompok Terfokus (FGD)</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-end float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('forms.form7.list') }}">FGD</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Edit Data FGD</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('forms.form7.update', $fgd->id) }}" method="POST" class="form form-vertical">
                    @csrf
                    @method('PATCH')
                    
                    <div class="form-body">
                        <!-- Section 1: Informasi Bencana -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">1. Informasi Bencana</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="bencana_id" class="mb-2">Pilih Bencana</label>
                                            <select class="form-select" id="bencana_id" name="bencana_id" required>
                                                <option value="">-- Pilih Bencana --</option>
                                                @foreach($bencana as $b)
                                                    <option value="{{ $b->id }}" {{ $fgd->bencana_id == $b->id ? 'selected' : '' }}>
                                                        {{ $b->Ref }} ({{ $b->tanggal }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Informasi Umum -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">2. Informasi Umum</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="desa_kelurahan">Desa/Kelurahan Asal</label>
                                            <input type="text" class="form-control" id="desa_kelurahan" name="desa_kelurahan" value="{{ old('desa_kelurahan', $fgd->desa_kelurahan) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="kecamatan">Kecamatan Asal</label>
                                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $fgd->kecamatan) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="kabupaten">Kabupaten Asal</label>
                                            <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="{{ old('kabupaten', $fgd->kabupaten) }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="tanggal">Tanggal Pelaksanaan</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $fgd->tanggal) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="jarak_bencana">Jarak dari Lokasi Bencana (KM)</label>
                                            <input type="number" class="form-control" id="jarak_bencana" name="jarak_bencana" value="{{ old('jarak_bencana', $fgd->jarak_bencana) }}" min="0" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Informasi Peserta -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">3. Informasi Peserta</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="tempat_sesi">Tempat Sesi</label>
                                            <input type="text" class="form-control" id="tempat_sesi" name="tempat_sesi" value="{{ old('tempat_sesi', $fgd->tempat_sesi) }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="jumlah_peserta">Jumlah Peserta</label>
                                            <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta" value="{{ old('jumlah_peserta', $fgd->jumlah_peserta) }}" min="1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="jumlah_perempuan">Jumlah Peserta Perempuan</label>
                                            <input type="number" class="form-control" id="jumlah_perempuan" name="jumlah_perempuan" value="{{ old('jumlah_perempuan', $fgd->jumlah_perempuan) }}" min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="jumlah_laki_laki">Jumlah Peserta Laki-laki</label>
                                            <input type="number" class="form-control" id="jumlah_laki_laki" name="jumlah_laki_laki" value="{{ old('jumlah_laki_laki', $fgd->jumlah_laki_laki) }}" min="0" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="komposisi_peserta">Komposisi Peserta</label>
                                            <textarea class="form-control" id="komposisi_peserta" name="komposisi_peserta" rows="3" required>{{ old('komposisi_peserta', $fgd->komposisi_peserta) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Penyelenggara -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">4. Penyelenggara</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="fasilitator">Nama Fasilitator</label>
                                            <input type="text" class="form-control" id="fasilitator" name="fasilitator" value="{{ old('fasilitator', $fgd->fasilitator) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="pencatat">Nama Pencatat</label>
                                            <input type="text" class="form-control" id="pencatat" name="pencatat" value="{{ old('pencatat', $fgd->pencatat) }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 5: Hasil Diskusi -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">5. Hasil Diskusi</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h6 class="fw-bold">Akses Hak</h6>
                                        
                                        @php
                                            $aksesHak = $fgd->akses_hak;
                                            $aksesHakBekerja = "";
                                            $aksesHakJaminanSosial = "";
                                            $aksesHakPerlindunganKeluarga = "";
                                            $aksesHakPelayananKesehatan = "";
                                            $aksesHakPendidikan = "";
                                            
                                            // Parse existing data
                                            if (strpos($aksesHak, 'Bekerja:') !== false) {
                                                preg_match('/Bekerja: (.*?)(\n\n|$)/s', $aksesHak, $matches);
                                                if (isset($matches[1])) {
                                                    $aksesHakBekerja = trim($matches[1]);
                                                }
                                            }
                                            
                                            if (strpos($aksesHak, 'Jaminan Sosial:') !== false) {
                                                preg_match('/Jaminan Sosial: (.*?)(\n\n|$)/s', $aksesHak, $matches);
                                                if (isset($matches[1])) {
                                                    $aksesHakJaminanSosial = trim($matches[1]);
                                                }
                                            }
                                            
                                            if (strpos($aksesHak, 'Perlindungan Keluarga:') !== false) {
                                                preg_match('/Perlindungan Keluarga: (.*?)(\n\n|$)/s', $aksesHak, $matches);
                                                if (isset($matches[1])) {
                                                    $aksesHakPerlindunganKeluarga = trim($matches[1]);
                                                }
                                            }
                                            
                                            if (strpos($aksesHak, 'Pelayanan Kesehatan:') !== false) {
                                                preg_match('/Pelayanan Kesehatan: (.*?)(\n\n|$)/s', $aksesHak, $matches);
                                                if (isset($matches[1])) {
                                                    $aksesHakPelayananKesehatan = trim($matches[1]);
                                                }
                                            }
                                            
                                            if (strpos($aksesHak, 'Pendidikan:') !== false) {
                                                preg_match('/Pendidikan: (.*?)(\n\n|$)/s', $aksesHak, $matches);
                                                if (isset($matches[1])) {
                                                    $aksesHakPendidikan = trim($matches[1]);
                                                }
                                            }
                                        @endphp
                                        
                                        <div class="form-group mb-3">
                                            <label for="hak_bekerja">Bagaimana akses terhadap hak bekerja setelah bencana?</label>
                                            <textarea id="hak_bekerja" class="form-control" name="pertanyaan[akses_hak][bekerja]" rows="2">{{ old('pertanyaan.akses_hak.bekerja', $aksesHakBekerja) }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="jaminan_sosial">Bagaimana akses terhadap jaminan sosial setelah bencana?</label>
                                            <textarea id="jaminan_sosial" class="form-control" name="pertanyaan[akses_hak][jaminan_sosial]" rows="2">{{ old('pertanyaan.akses_hak.jaminan_sosial', $aksesHakJaminanSosial) }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="perlindungan_keluarga">Bagaimana perlindungan keluarga setelah bencana?</label>
                                            <textarea id="perlindungan_keluarga" class="form-control" name="pertanyaan[akses_hak][perlindungan_keluarga]" rows="2">{{ old('pertanyaan.akses_hak.perlindungan_keluarga', $aksesHakPerlindunganKeluarga) }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="pelayanan_kesehatan">Bagaimana akses terhadap pelayanan kesehatan setelah bencana?</label>
                                            <textarea id="pelayanan_kesehatan" class="form-control" name="pertanyaan[akses_hak][pelayanan_kesehatan]" rows="2">{{ old('pertanyaan.akses_hak.pelayanan_kesehatan', $aksesHakPelayananKesehatan) }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="pendidikan">Bagaimana akses terhadap pendidikan setelah bencana?</label>
                                            <textarea id="pendidikan" class="form-control" name="pertanyaan[akses_hak][pendidikan]" rows="2">{{ old('pertanyaan.akses_hak.pendidikan', $aksesHakPendidikan) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h6 class="fw-bold">Fungsi Pranata</h6>
                                        
                                        @php
                                            $fungsiPranata = $fgd->fungsi_pranata;
                                            $pranataSosial = "";
                                            $pranataEkonomi = "";
                                            $pranataAgama = "";
                                            $pranataPemerintahan = "";
                                            
                                            // Parse existing data
                                            if (strpos($fungsiPranata, 'Pranata Sosial:') !== false) {
                                                preg_match('/Pranata Sosial: (.*?)(\n\n|$)/s', $fungsiPranata, $matches);
                                                if (isset($matches[1])) {
                                                    $pranataSosial = trim($matches[1]);
                                                }
                                            }
                                            
                                            if (strpos($fungsiPranata, 'Pranata Ekonomi:') !== false) {
                                                preg_match('/Pranata Ekonomi: (.*?)(\n\n|$)/s', $fungsiPranata, $matches);
                                                if (isset($matches[1])) {
                                                    $pranataEkonomi = trim($matches[1]);
                                                }
                                            }
                                            
                                            if (strpos($fungsiPranata, 'Pranata Agama:') !== false) {
                                                preg_match('/Pranata Agama: (.*?)(\n\n|$)/s', $fungsiPranata, $matches);
                                                if (isset($matches[1])) {
                                                    $pranataAgama = trim($matches[1]);
                                                }
                                            }
                                            
                                            if (strpos($fungsiPranata, 'Pranata Pemerintahan:') !== false) {
                                                preg_match('/Pranata Pemerintahan: (.*?)(\n\n|$)/s', $fungsiPranata, $matches);
                                                if (isset($matches[1])) {
                                                    $pranataPemerintahan = trim($matches[1]);
                                                }
                                            }
                                        @endphp
                                        
                                        <div class="form-group mb-3">
                                            <label for="pranata_sosial">Bagaimana fungsi pranata sosial setelah bencana?</label>
                                            <textarea id="pranata_sosial" class="form-control" name="pertanyaan[fungsi_pranata][sosial]" rows="2">{{ old('pertanyaan.fungsi_pranata.sosial', $pranataSosial) }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="pranata_ekonomi">Bagaimana fungsi pranata ekonomi setelah bencana?</label>
                                            <textarea id="pranata_ekonomi" class="form-control" name="pertanyaan[fungsi_pranata][ekonomi]" rows="2">{{ old('pertanyaan.fungsi_pranata.ekonomi', $pranataEkonomi) }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="pranata_agama">Bagaimana fungsi pranata agama setelah bencana?</label>
                                            <textarea id="pranata_agama" class="form-control" name="pertanyaan[fungsi_pranata][agama]" rows="2">{{ old('pertanyaan.fungsi_pranata.agama', $pranataAgama) }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="pranata_pemerintahan">Bagaimana fungsi pranata pemerintahan setelah bencana?</label>
                                            <textarea id="pranata_pemerintahan" class="form-control" name="pertanyaan[fungsi_pranata][pemerintahan]" rows="2">{{ old('pertanyaan.fungsi_pranata.pemerintahan', $pranataPemerintahan) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="fw-bold">Resiko Kerentanan</h6>
                                        
                                        @php
                                            $resikoKerentanan = $fgd->resiko_kerentanan;
                                            $kerentananSosial = "";
                                            $kerentananEkonomi = "";
                                            $kerentananGeografis = "";
                                            
                                            // Parse existing data
                                            if (strpos($resikoKerentanan, 'Kerentanan Sosial:') !== false) {
                                                preg_match('/Kerentanan Sosial: (.*?)(\n\n|$)/s', $resikoKerentanan, $matches);
                                                if (isset($matches[1])) {
                                                    $kerentananSosial = trim($matches[1]);
                                                }
                                            }
                                            
                                            if (strpos($resikoKerentanan, 'Kerentanan Ekonomi:') !== false) {
                                                preg_match('/Kerentanan Ekonomi: (.*?)(\n\n|$)/s', $resikoKerentanan, $matches);
                                                if (isset($matches[1])) {
                                                    $kerentananEkonomi = trim($matches[1]);
                                                }
                                            }
                                            
                                            if (strpos($resikoKerentanan, 'Kerentanan Geografis:') !== false) {
                                                preg_match('/Kerentanan Geografis: (.*?)(\n\n|$)/s', $resikoKerentanan, $matches);
                                                if (isset($matches[1])) {
                                                    $kerentananGeografis = trim($matches[1]);
                                                }
                                            }
                                        @endphp
                                        
                                        <div class="form-group mb-3">
                                            <label for="kerentanan_sosial">Karakter sosial yang paling rentan dan cara membantu:</label>
                                            <textarea id="kerentanan_sosial" class="form-control" name="pertanyaan[resiko_kerentanan][sosial]" rows="3">{{ old('pertanyaan.resiko_kerentanan.sosial', $kerentananSosial) }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="kerentanan_ekonomi">Karakter ekonomi yang paling rentan dan cara membantu:</label>
                                            <textarea id="kerentanan_ekonomi" class="form-control" name="pertanyaan[resiko_kerentanan][ekonomi]" rows="3">{{ old('pertanyaan.resiko_kerentanan.ekonomi', $kerentananEkonomi) }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="kerentanan_geografis">Karakter geografis yang paling rentan dan cara membantu:</label>
                                            <textarea id="kerentanan_geografis" class="form-control" name="pertanyaan[resiko_kerentanan][geografis]" rows="3">{{ old('pertanyaan.resiko_kerentanan.geografis', $kerentananGeografis) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-between mt-4">
                            <a href="{{ route('forms.form7.show', $fgd->id) }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahPeserta = document.getElementById('jumlah_peserta');
        const jumlahPerempuan = document.getElementById('jumlah_perempuan');
        const jumlahLakiLaki = document.getElementById('jumlah_laki_laki');
        
        function validateTotalParticipants() {
            const total = parseInt(jumlahPeserta.value) || 0;
            const perempuan = parseInt(jumlahPerempuan.value) || 0;
            const lakiLaki = parseInt(jumlahLakiLaki.value) || 0;
            
            if (perempuan + lakiLaki !== total) {
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
        }
        
        jumlahPerempuan.addEventListener('input', updateTotalParticipants);
        jumlahLakiLaki.addEventListener('input', updateTotalParticipants);
    });
</script>
@endpush
