@extends('layouts.main')

@section('content')
<style>
    /* Container & Layout - Kombinasi Form3 & Form6 */
    * {
        font-family: 'Times New Roman', serif;
    }
    
    .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        background: white;
        color: #333;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    /* Header Styling - Dari Form6 */
    .form-header {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ddd;
    }
    
    .form-header h5 {
        margin: 0.5rem 0;
        font-weight: bold;
        color: #333;
    }

    .form-header h5:first-child {
        color: #0066cc;
        margin-bottom: 0.3rem;
    }
    
    /* Section Headers - Dari Form3 */
    .section-header {
        background: #f9f9f9;
        color: #333;
        font-weight: 600;
        padding: 10px 15px;
        margin: 20px 0 15px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }
    
    /* Table Styling - Kombinasi Form3 & Form6 */
    .form-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
    }
    
    .form-table th, .form-table td {
        border: 1px solid #ddd;
        padding: 12px 8px;
        text-align: left;
        vertical-align: top;
    }
    
    .form-table th {
        background-color: #f9f9f9;
        font-weight: 600;
        text-align: center;
        color: #333;
    }
    
    .form-table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
    
    .form-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .form-table tbody tr:hover {
        background-color: rgba(0, 102, 204, 0.05);
        transition: background-color 0.2s ease;
    }
    
    .table-header {
        background-color: #333 !important;
        color: white !important;
        text-align: center;
        font-weight: bold;
    }
    
    /* Form Inputs - Dari Form3 */
    .form-input {
        background: transparent;
        border: none;
        border-bottom: 1px dotted #333;
        font-family: 'Times New Roman', serif;
        font-size: 14px;
        color: #333;
        outline: none;
        padding: 6px 8px;
        transition: border-color 0.3s ease;
        line-height: 1.5;
    }
    
    .form-input:focus {
        border-bottom-color: #0066cc;
        background-color: rgba(0, 102, 204, 0.05);
    }
    
    textarea.form-input {
        border: 1px dotted #333;
        padding: 8px;
        border-radius: 3px;
        resize: vertical;
        min-height: 60px;
    }
    
    textarea.form-input:focus {
        border-color: #0066cc;
        background-color: rgba(0, 102, 204, 0.05);
    }
    
    /* Checkbox Styling - Dari Form6 */
    .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
        align-items: center;
        padding: 0.3rem 0;
    }
    
    .checkbox-item {
        display: flex;
        align-items: center;
        margin-right: 1.2rem;
        margin-bottom: 0.4rem;
        white-space: nowrap;
    }
    
    .checkbox-item label {
        margin: 0;
        font-weight: 500;
        cursor: pointer;
        user-select: none;
        color: #333;
    }
    
    input[type="checkbox"] {
        transform: scale(1.1);
        margin-right: 0.5rem;
        margin-left: 0.2rem;
        accent-color: #0066cc;
        vertical-align: middle;
    }
    
    /* Card Styling - Dari Form6 */
    .card {
        background: white;
        border: none;
        box-shadow: none;
        border-radius: 4px;
        overflow: hidden;
    }
    
    .card-header {
        background-color: #f9f9f9;
        border-bottom: 1px solid #ddd;
        padding: 15px 20px;
    }
    
    .card-title {
        color: #333;
        font-weight: bold;
        margin: 0;
    }
    
    .card-body {
        padding: 20px;
    }
    
    /* Button Styling - Kombinasi Form3 & Form6 */
    .form-button {
        margin: 0 5px;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        font-family: 'Times New Roman', serif;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }
    
    .form-button.btn-success {
        background: #28a745;
        color: white;
    }
    
    .form-button.btn-warning {
        background: #ffc107;
        color: #212529;
    }
    
    .form-button.btn-info {
        background: #17a2b8;
        color: white;
    }
    
    .form-button.btn-secondary {
        background: #6c757d;
        color: white;
    }
    
    /* Alert Styling */
    .alert {
        border-radius: 4px;
        margin-bottom: 20px;
        padding: 12px 16px;
        border: 1px solid transparent;
    }
    
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    
    /* Action buttons container - Dari Form3 */
    .d-flex {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 10px;
        }
        
        .form-table {
            font-size: 12px;
        }
        
        .form-input {
            font-size: 12px;
        }
        
        .checkbox-group {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .form-button {
            margin: 2px;
            padding: 6px 12px;
            font-size: 12px;
        }
    }
    
    /* Print Styles */
    @media print {
        .form-table {
            border: 2px solid #000 !important;
        }
        
        .form-table th, .form-table td {
            border: 1px solid #000 !important;
        }
        
        .form-input {
            border-bottom: 1px solid #000 !important;
        }
        
        .form-button {
            display: none !important;
        }
        
        .alert {
            display: none !important;
        }
        
        .container {
            box-shadow: none;
            margin: 0;
            padding: 10px;
        }
        
        body {
            font-size: 12pt;
            line-height: 1.4;
        }
    }
</style>
<div class="container">    
    <!-- Document Header - Style dari Form6 -->
    <div class="form-header">
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
                    
                    <!-- Section Header - Style dari Form3 -->
                    <div class="section-header">
                        INFORMASI UMUM
                    </div>
                    
                    <table class="form-table">
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
                                <td width="25%"><input type="text" name="desa_kelurahan" class="form-input @error('desa_kelurahan') is-invalid @enderror" value="{{ old('desa_kelurahan') }}" required></td>
                                <td width="25%">Kecamatan asal:</td>
                                <td width="25%"><input type="text" name="kecamatan" class="form-input @error('kecamatan') is-invalid @enderror" value="{{ old('kecamatan') }}" required></td>
                            </tr>
                            <tr>
                                <td>Kabupaten asal:</td>
                                <td><input type="text" name="kabupaten" class="form-input @error('kabupaten') is-invalid @enderror" value="{{ old('kabupaten') }}" required></td>
                                <td>Tanggal:</td>
                                <td><input type="date" name="tanggal" class="form-input @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required></td>
                            </tr>
                            <tr>
                                <td>Km dari Bencana:</td>
                                <td><input type="number" name="jarak_bencana" class="form-input @error('jarak_bencana') is-invalid @enderror" value="{{ old('jarak_bencana') }}" required min="0"></td>
                                <td colspan="2"><small>(diisi oleh fasilitator/pencatat)</small></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Section Header - Style dari Form3 -->
                    <div class="section-header">
                        INFORMASI SESI
                    </div>
                    
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <td width="25%">Tempat sesi:</td>
                                <td width="25%"><input type="text" name="tempat_sesi" class="form-input @error('tempat_sesi') is-invalid @enderror" value="{{ old('tempat_sesi') }}" required></td>
                                <td width="15%">Desa/kel:</td>
                                <td width="35%"><input type="text" name="desa_sesi" class="form-input" value="{{ old('desa_sesi') }}"></td>
                            </tr>
                            <tr>
                                <td>Kec:</td>
                                <td colspan="3"><input type="text" name="kec_sesi" class="form-input" value="{{ old('kec_sesi') }}"></td>
                            </tr>
                            <tr>
                                <td>Jumlah peserta:</td>
                                <td><input type="number" id="jumlah_peserta" name="jumlah_peserta" class="form-input @error('jumlah_peserta') is-invalid @enderror" value="{{ old('jumlah_peserta') }}" required min="1"></td>
                                <td colspan="2">
                                    (perempuan: <input type="number" id="jumlah_perempuan" name="jumlah_perempuan" class="form-input @error('jumlah_perempuan') is-invalid @enderror" value="{{ old('jumlah_perempuan') }}" required min="0" style="width: 50px; display: inline;">
                                    laki-laki: <input type="number" id="jumlah_laki_laki" name="jumlah_laki_laki" class="form-input @error('jumlah_laki_laki') is-invalid @enderror" value="{{ old('jumlah_laki_laki') }}" required min="0" style="width: 50px; display: inline;">)
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <strong>Gambaran komposisi peserta, misalnya pekerjaan, status sosial, kelompok umur, dsb.</strong><br>
                                    <textarea name="komposisi_peserta" class="form-input @error('komposisi_peserta') is-invalid @enderror" rows="3" style="height: 60px;" required>{{ old('komposisi_peserta') }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Section Header - Style dari Form3 -->
                    <div class="section-header">
                        PENYELENGGARA
                    </div>
                    
                    <table class="form-table">
                        <thead>
                            <tr>
                                <th width="50%">Penyelenggara</th>
                                <th width="50%">Paraf</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Fasilitator: <input type="text" name="fasilitator" class="form-input @error('fasilitator') is-invalid @enderror" value="{{ old('fasilitator') }}" required></td>
                                <td style="height: 40px;"></td>
                            </tr>
                            <tr>
                                <td>Pencatat: <input type="text" name="pencatat" class="form-input @error('pencatat') is-invalid @enderror" value="{{ old('pencatat') }}" required></td>
                                <td style="height: 40px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Section Header - Style dari Form3 -->
                    <div class="section-header">
                        CHECKLIST PERSIAPAN
                    </div>
                    
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <td width="5%">1.</td>
                                <td width="70%">Persiapan pra-FGD:</td>
                                <td width="25%">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="prep_ya" name="checklist[persiapan][]" value="ya">
                                            <label for="prep_ya"> Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="prep_tidak" name="checklist[persiapan][]" value="tidak">
                                            <label for="prep_tidak"> Tidak</label>
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
                                            <label for="tugas_ya"> Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="tugas_tidak" name="checklist[tugas][]" value="tidak">
                                            <label for="tugas_tidak"> Tidak</label>
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
                                            <label for="perkenalan_ya"> Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="perkenalan_tidak" name="checklist[perkenalan][]" value="tidak">
                                            <label for="perkenalan_tidak"> Tidak</label>
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
                                            <label for="pembahasan_ya"> Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="pembahasan_tidak" name="checklist[pembahasan][]" value="tidak">
                                            <label for="pembahasan_tidak"> Tidak</label>
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
                                            <label for="tanya_ya"> Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="tanya_tidak" name="checklist[tanya_jawab][]" value="tidak">
                                            <label for="tanya_tidak"> Tidak</label>
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
                                            <label for="penutupan_ya"> Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="penutupan_tidak" name="checklist[penutupan][]" value="tidak">
                                            <label for="penutupan_tidak"> Tidak</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Section Header - Style dari Form3 -->
                    <div class="section-header">
                        PERTANYAAN DISKUSI
                    </div>
                    
                    <table class="form-table">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 55%;">Pertanyaan</th>
                                <th style="width: 40%;">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3"><strong>A. Akses Hak</strong></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Bagaimana akses terhadap hak bekerja setelah bencana?</td>
                                <td><textarea name="pertanyaan[akses_hak][bekerja]" class="form-input" rows="2" style="height: 60px;">{{ old('pertanyaan.akses_hak.bekerja') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Bagaimana akses terhadap jaminan sosial setelah bencana?</td>
                                <td><textarea name="pertanyaan[akses_hak][jaminan_sosial]" class="form-input" rows="2" style="height: 60px;">{{ old('pertanyaan.akses_hak.jaminan_sosial') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Bagaimana perlindungan keluarga setelah bencana?</td>
                                <td><textarea name="pertanyaan[akses_hak][perlindungan_keluarga]" class="form-input" rows="2" style="height: 60px;">{{ old('pertanyaan.akses_hak.perlindungan_keluarga') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Bagaimana akses terhadap pelayanan kesehatan setelah bencana?</td>
                                <td><textarea name="pertanyaan[akses_hak][pelayanan_kesehatan]" class="form-input" rows="2" style="height: 60px;">{{ old('pertanyaan.akses_hak.pelayanan_kesehatan') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Bagaimana akses terhadap pendidikan setelah bencana?</td>
                                <td><textarea name="pertanyaan[akses_hak][pendidikan]" class="form-input" rows="2" style="height: 60px;">{{ old('pertanyaan.akses_hak.pendidikan') }}</textarea></td>
                            </tr>
                            <tr>
                                <td colspan="3"><strong>B. Fungsi Pranata</strong></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Bagaimana fungsi pranata sosial setelah bencana?</td>
                                <td><textarea name="pertanyaan[fungsi_pranata][sosial]" class="form-input" rows="2" style="height: 60px;">{{ old('pertanyaan.fungsi_pranata.sosial') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Bagaimana fungsi pranata ekonomi setelah bencana?</td>
                                <td><textarea name="pertanyaan[fungsi_pranata][ekonomi]" class="form-input" rows="2" style="height: 60px;">{{ old('pertanyaan.fungsi_pranata.ekonomi') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Bagaimana fungsi pranata agama setelah bencana?</td>
                                <td><textarea name="pertanyaan[fungsi_pranata][agama]" class="form-input" rows="2" style="height: 60px;">{{ old('pertanyaan.fungsi_pranata.agama') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Bagaimana fungsi pranata pemerintahan setelah bencana?</td>
                                <td><textarea name="pertanyaan[fungsi_pranata][pemerintahan]" class="form-input" rows="2" style="height: 60px;">{{ old('pertanyaan.fungsi_pranata.pemerintahan') }}</textarea></td>
                            </tr>
                            <tr>
                                <td colspan="3"><strong>C. Resiko Kerentanan</strong></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Karakter sosial yang paling rentan dan cara membantu</td>
                                <td><textarea name="pertanyaan[resiko_kerentanan][sosial]" class="form-input" rows="3" style="height: 80px;">{{ old('pertanyaan.resiko_kerentanan.sosial') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>Karakter ekonomi yang paling rentan dan cara membantu</td>
                                <td><textarea name="pertanyaan[resiko_kerentanan][ekonomi]" class="form-input" rows="3" style="height: 80px;">{{ old('pertanyaan.resiko_kerentanan.ekonomi') }}</textarea></td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>Karakter geografis yang paling rentan dan cara membantu</td>
                                <td><textarea name="pertanyaan[resiko_kerentanan][geografis]" class="form-input" rows="3" style="height: 80px;">{{ old('pertanyaan.resiko_kerentanan.geografis') }}</textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Tombol Aksi -->
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-3">
                        <button type="submit" class="form-button btn-success">
                            <i class="bi bi-save"></i> Simpan Data
                        </button>
                        <button type="reset" class="form-button btn-warning" onclick="resetForm()">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </button>
                        <button type="button" class="form-button btn-info" onclick="printForm()">
                            <i class="bi bi-printer"></i> Cetak
                        </button>
                        <button type="button" class="form-button btn-secondary" onclick="previewForm()">
                            <i class="bi bi-eye"></i> Preview
                        </button>
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

    function resetForm() {
        if (confirm('Apakah Anda yakin ingin mereset semua data form?')) {
            document.querySelector('form').reset();
        }
    }

    function printForm() {
        window.print();
    }

    function previewForm() {
        // Create preview window
        const previewWindow = window.open('', '_blank', 'width=800,height=600,scrollbars=yes');
        const formContent = document.querySelector('.container').cloneNode(true);
        
        // Remove buttons from preview
        const buttons = formContent.querySelectorAll('button');
        buttons.forEach(btn => btn.style.display = 'none');
        
        // Remove input borders for preview
        const inputs = formContent.querySelectorAll('.form-input, input');
        inputs.forEach(input => {
            const span = document.createElement('span');
            span.textContent = input.value || input.placeholder || '';
            span.style.borderBottom = '1px solid #000';
            span.style.minWidth = '100px';
            span.style.display = 'inline-block';
            input.parentNode.replaceChild(span, input);
        });
        
        previewWindow.document.write(`
            <html>
            <head>
                <title>Preview Form 7 - FGD</title>
                <style>
                    body { font-family: 'Times New Roman', serif; padding: 20px; }
                    .form-table { border-collapse: collapse; width: 100%; }
                    .form-table td, .form-table th { border: 1px solid #000; padding: 8px; }
                </style>
            </head>
            <body>
                ${formContent.outerHTML}
            </body>
            </html>
        `);
        previewWindow.document.close();
    }
</script>
@endpush
