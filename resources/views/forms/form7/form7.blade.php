@extends('layouts.main')

@section('content')
<style>
    .form-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 13px;
    }
    .form-table th, .form-table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
        vertical-align: top;
    }
    .form-table th {
        background-color: #f8f9fa;
        font-weight: bold;
        text-align: center;
    }
    .table-header {
        background-color: var(--bs-secondary) !important;
        color: white !important;
        text-align: center;
        font-weight: bold;
    }
    .form-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        background: white;
    }
/* form-header */
/* form-title */
/* form-subtitle */
    .input-underline {
        border: none;
        border-bottom: 1px solid #000;
        background: transparent;
        padding: 2px 4px;
        width: 100%;
        font-size: 13px;
    }
    .input-underline:focus {
        outline: none;
        border-bottom: 2px solid #333;
    }
    .checkbox-group {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .section-number {
        background: var(--bs-secondary);
        color: white;
        padding: 5px 10px;
        font-weight: bold;
        margin-bottom: 10px;
        display: inline-block;
    }
</style>
<div class="container" style="max-width: 800px; font-family: Times New Roman, serif;">    
    <div class="text-center mb-4">
        <h5><strong>Formulir 07</strong></h5>
        <h5>Diskusi Kelompok Terfokus (FGD)</h5>
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
            <div class="card-body">                
                <form action="{{ route('forms.form7.store') }}" method="POST" class="form form-vertical">
                    @csrf
                    
                    <!-- Tabel 1: Informasi Umum -->
                    
                    <table class="form-table">
                        <thead>
                            <tr>
                                <th colspan="4" class="table-header">UMUM</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Hidden Bencana Selection -->
                            <tr style="display: none;">
                                <td colspan="4">
                                    @if(request()->has('bencana_id') && is_object($bencana))
                                        <input type="hidden" name="bencana_id" value="{{ $bencana->id }}">
                                    @else
                                        <select class="form-select @error('bencana_id') is-invalid @enderror" id="bencana_id" name="bencana_id" required>
                                            <option value="">-- Pilih Bencana --</option>
                                            @foreach($bencana as $b)
                                                <option value="{{ $b->id }}" {{ old('bencana_id') == $b->id ? 'selected' : '' }}>
                                                    {{ $b->Ref }} - {{ $b->kategori_bencana->nama }} ({{ $b->tanggal }})
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="25%">Desa/kelurahan asal:</td>
                                <td width="25%"><input type="text" name="desa_kelurahan" class="input-underline @error('desa_kelurahan') is-invalid @enderror" value="{{ old('desa_kelurahan') }}" required></td>
                                <td width="25%">Kecamatan asal:</td>
                                <td width="25%"><input type="text" name="kecamatan" class="input-underline @error('kecamatan') is-invalid @enderror" value="{{ old('kecamatan') }}" required></td>
                            </tr>
                            <tr>
                                <td>Kabupaten asal:</td>
                                <td><input type="text" name="kabupaten" class="input-underline @error('kabupaten') is-invalid @enderror" value="{{ old('kabupaten') }}" required></td>
                                <td>Tanggal:</td>
                                <td><input type="date" name="tanggal" class="input-underline @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required></td>
                            </tr>
                            <tr>
                                <td>Km dari Bencana:</td>
                                <td><input type="number" name="jarak_bencana" class="input-underline @error('jarak_bencana') is-invalid @enderror" value="{{ old('jarak_bencana') }}" required min="0"></td>
                                <td colspan="2"><small>(diisi oleh fasilitator/pencatat)</small></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Tabel 2: Informasi Sesi -->
                    
                    <table class="form-table">
                        <thead>
                            <tr>
                                <th colspan="4" class="table-header">INFORMASI SESI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="25%">Tempat sesi:</td>
                                <td width="25%"><input type="text" name="tempat_sesi" class="input-underline @error('tempat_sesi') is-invalid @enderror" value="{{ old('tempat_sesi') }}" required></td>
                                <td width="15%">Desa/kel:</td>
                                <td width="35%"><input type="text" name="desa_sesi" class="input-underline" value="{{ old('desa_sesi') }}"></td>
                            </tr>
                            <tr>
                                <td>Kec:</td>
                                <td colspan="3"><input type="text" name="kec_sesi" class="input-underline" value="{{ old('kec_sesi') }}"></td>
                            </tr>
                            <tr>
                                <td>Jumlah peserta:</td>
                                <td><input type="number" id="jumlah_peserta" name="jumlah_peserta" class="input-underline @error('jumlah_peserta') is-invalid @enderror" value="{{ old('jumlah_peserta') }}" required min="1"></td>
                                <td colspan="2">
                                    (perempuan: <input type="number" id="jumlah_perempuan" name="jumlah_perempuan" class="input-underline @error('jumlah_perempuan') is-invalid @enderror" value="{{ old('jumlah_perempuan') }}" required min="0" style="width: 50px; display: inline;">
                                    laki-laki: <input type="number" id="jumlah_laki_laki" name="jumlah_laki_laki" class="input-underline @error('jumlah_laki_laki') is-invalid @enderror" value="{{ old('jumlah_laki_laki') }}" required min="0" style="width: 50px; display: inline;">)
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <strong>Gambaran komposisi peserta, misalnya pekerjaan, status sosial, kelompok umur, dsb.</strong><br>
                                    <textarea name="komposisi_peserta" class="input-underline @error('komposisi_peserta') is-invalid @enderror" rows="3" style="height: 60px; border: 1px solid #000; border-bottom: 1px solid #000;" required>{{ old('komposisi_peserta') }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Tabel 3: Penyelenggara -->
                    
                    <table class="form-table">
                        <thead>
                            <tr>
                                <th width="50%" class="table-header">Penyelenggara</th>
                                <th width="50%" class="table-header">Paraf</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Fasilitator: <input type="text" name="fasilitator" class="input-underline @error('fasilitator') is-invalid @enderror" value="{{ old('fasilitator') }}" required></td>
                                <td style="height: 40px;"></td>
                            </tr>
                            <tr>
                                <td>Pencatat: <input type="text" name="pencatat" class="input-underline @error('pencatat') is-invalid @enderror" value="{{ old('pencatat') }}" required></td>
                                <td style="height: 40px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Tabel 4: Checklist Persiapan -->
                    
                    <table class="form-table">
                        <thead>
                            <tr>
                                <th colspan="3" class="table-header">Checklist Persiapan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="5%">1.</td>
                                <td width="70%">Persiapan pra-FGD:</td>
                                <td width="25%">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="prep_ya" name="checklist[persiapan][]" value="ya">
                                            <label for="prep_ya">☐ Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="prep_tidak" name="checklist[persiapan][]" value="tidak">
                                            <label for="prep_tidak">☐ Tidak</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Pembagian tugas pelaksana</td>
                                <td>
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="tugas_ya" name="checklist[tugas][]" value="ya">
                                            <label for="tugas_ya">☐ Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="tugas_tidak" name="checklist[tugas][]" value="tidak">
                                            <label for="tugas_tidak">☐ Tidak</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Perkenalan dan pengantar</td>
                                <td>
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="perkenalan_ya" name="checklist[perkenalan][]" value="ya">
                                            <label for="perkenalan_ya">☐ Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="perkenalan_tidak" name="checklist[perkenalan][]" value="tidak">
                                            <label for="perkenalan_tidak">☐ Tidak</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Pembahasan</td>
                                <td>
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="pembahasan_ya" name="checklist[pembahasan][]" value="ya">
                                            <label for="pembahasan_ya">☐ Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="pembahasan_tidak" name="checklist[pembahasan][]" value="tidak">
                                            <label for="pembahasan_tidak">☐ Tidak</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>Pendalaman/Tanya jawab</td>
                                <td>
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="tanya_ya" name="checklist[tanya_jawab][]" value="ya">
                                            <label for="tanya_ya">☐ Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="tanya_tidak" name="checklist[tanya_jawab][]" value="tidak">
                                            <label for="tanya_tidak">☐ Tidak</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>Penyimpulan dan penutupan</td>
                                <td>
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="penutupan_ya" name="checklist[penutupan][]" value="ya">
                                            <label for="penutupan_ya">☐ Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="penutupan_tidak" name="checklist[penutupan][]" value="tidak">
                                            <label for="penutupan_tidak">☐ Tidak</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Tabel 5: Pertanyaan Diskusi -->
                    
                    <table class="form-table">
                        <thead>
                            <tr>
                                <th colspan="2" class="table-header">PERTANYAAN DISKUSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2"><strong>A. Akses Hak</strong></td>
                            </tr>
                            <tr>
                                <td width="40%">1. Bagaimana akses terhadap hak bekerja setelah bencana?</td>
                                <td width="60%"><textarea name="pertanyaan[akses_hak][bekerja]" class="input-underline" rows="2" style="height: 60px; border: 1px solid #000;">{{ old('pertanyaan.akses_hak.bekerja') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>2. Bagaimana akses terhadap jaminan sosial setelah bencana?</td>
                                <td><textarea name="pertanyaan[akses_hak][jaminan_sosial]" class="input-underline" rows="2" style="height: 60px; border: 1px solid #000;">{{ old('pertanyaan.akses_hak.jaminan_sosial') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>3. Bagaimana perlindungan keluarga setelah bencana?</td>
                                <td><textarea name="pertanyaan[akses_hak][perlindungan_keluarga]" class="input-underline" rows="2" style="height: 60px; border: 1px solid #000;">{{ old('pertanyaan.akses_hak.perlindungan_keluarga') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>4. Bagaimana akses terhadap pelayanan kesehatan setelah bencana?</td>
                                <td><textarea name="pertanyaan[akses_hak][pelayanan_kesehatan]" class="input-underline" rows="2" style="height: 60px; border: 1px solid #000;">{{ old('pertanyaan.akses_hak.pelayanan_kesehatan') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>5. Bagaimana akses terhadap pendidikan setelah bencana?</td>
                                <td><textarea name="pertanyaan[akses_hak][pendidikan]" class="input-underline" rows="2" style="height: 60px; border: 1px solid #000;">{{ old('pertanyaan.akses_hak.pendidikan') }}</textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>B. Fungsi Pranata</strong></td>
                            </tr>
                            <tr>
                                <td>1. Bagaimana fungsi pranata sosial setelah bencana?</td>
                                <td><textarea name="pertanyaan[fungsi_pranata][sosial]" class="input-underline" rows="2" style="height: 60px; border: 1px solid #000;">{{ old('pertanyaan.fungsi_pranata.sosial') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>2. Bagaimana fungsi pranata ekonomi setelah bencana?</td>
                                <td><textarea name="pertanyaan[fungsi_pranata][ekonomi]" class="input-underline" rows="2" style="height: 60px; border: 1px solid #000;">{{ old('pertanyaan.fungsi_pranata.ekonomi') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>3. Bagaimana fungsi pranata agama setelah bencana?</td>
                                <td><textarea name="pertanyaan[fungsi_pranata][agama]" class="input-underline" rows="2" style="height: 60px; border: 1px solid #000;">{{ old('pertanyaan.fungsi_pranata.agama') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>4. Bagaimana fungsi pranata pemerintahan setelah bencana?</td>
                                <td><textarea name="pertanyaan[fungsi_pranata][pemerintahan]" class="input-underline" rows="2" style="height: 60px; border: 1px solid #000;">{{ old('pertanyaan.fungsi_pranata.pemerintahan') }}</textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>C. Resiko Kerentanan</strong></td>
                            </tr>
                            <tr>
                                <td>1. Karakter sosial yang paling rentan dan cara membantu:</td>
                                <td><textarea name="pertanyaan[resiko_kerentanan][sosial]" class="input-underline" rows="3" style="height: 80px; border: 1px solid #000;">{{ old('pertanyaan.resiko_kerentanan.sosial') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>2. Karakter ekonomi yang paling rentan dan cara membantu:</td>
                                <td><textarea name="pertanyaan[resiko_kerentanan][ekonomi]" class="input-underline" rows="3" style="height: 80px; border: 1px solid #000;">{{ old('pertanyaan.resiko_kerentanan.ekonomi') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>3. Karakter geografis yang paling rentan dan cara membantu:</td>
                                <td><textarea name="pertanyaan[resiko_kerentanan][geografis]" class="input-underline" rows="3" style="height: 80px; border: 1px solid #000;">{{ old('pertanyaan.resiko_kerentanan.geografis') }}</textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    
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

        // Checkbox mutual exclusion (only one per row)
        const checkboxPairs = [
            ['prep_ya', 'prep_tidak'],
            ['tugas_ya', 'tugas_tidak'], 
            ['perkenalan_ya', 'perkenalan_tidak'],
            ['pembahasan_ya', 'pembahasan_tidak'],
            ['tanya_ya', 'tanya_tidak'],
            ['penutupan_ya', 'penutupan_tidak']
        ];

        checkboxPairs.forEach(([yaId, tidakId]) => {
            const yaCheckbox = document.getElementById(yaId);
            const tidakCheckbox = document.getElementById(tidakId);
            
            if (yaCheckbox && tidakCheckbox) {
                yaCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        tidakCheckbox.checked = false;
                    }
                });
                
                tidakCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        yaCheckbox.checked = false;
                    }
                });
            }
        });
    });
</script>
@endpush
