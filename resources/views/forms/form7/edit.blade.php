@extends('layouts.main')

@section('content')
<style>
    /* Container & Layout */
    .form-container {
        max-width: 900px;
        font-family: 'Times New Roman', serif;
        margin: 0 auto;
        padding: 20px;
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Header Styling */
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
        color: #F28705;
        margin-bottom: 0.3rem;
    }

    /* Section Headers */
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

    /* Table Styling */
    .table {
        border: 1px solid #ddd;
        margin-bottom: 1.5rem;
        font-size: 14px;
        border-radius: 4px;
        overflow: hidden;
    }

    .table td,
    .table th {
        padding: 8px 12px;
        border: 1px solid #ddd;
        vertical-align: middle;
    }

    .table thead th {
        background: #f9f9f9;
        color: #333;
        font-weight: 600;
        text-align: center;
        border-bottom: 2px solid #ddd;
    }

    /* Form Controls */
    .form-control {
        font-family: 'Times New Roman', serif;
        font-size: 14px;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    /* Button Styling */
    .btn {
        margin: 0 5px;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-success {
        background: #28a745;
        color: white;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .alert-info {
        background: #6c757d;    
        border-radius: 4px;
        padding: 1rem;  
        margin-bottom: 1.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-container {
            padding: 10px;
        }

        .table {
            font-size: 12px;
        }

        .btn {
            margin: 2px;
            padding: 6px 12px;
            font-size: 12px;
        }
    }
</style>

<form method="POST" action="{{ route('forms.form7.update', $form->id) }}">
    @csrf
    @method('PATCH')
    <input type="hidden" name="bencana_id" value="{{ $form->bencana_id }}">

    <div class="form-container">
        <!-- Document Header -->
        <div class="form-header">
            <h5><strong>Formulir 07 - Edit</strong></h5>
            <h5>Focus Group Discussion (FGD)</h5>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Info Bencana -->
        <div class="alert alert-info text-white mb-3">
            <strong>Informasi Bencana:</strong> {{ $form->bencana->kategori_bencana->nama ?? '-' }} 
            pada {{ $form->bencana->tanggal_bencana ? \Carbon\Carbon::parse($form->bencana->tanggal_bencana)->format('d/m/Y') : '-' }}
            di {{ $form->bencana->lokasi_bencana ?? '-' }}
        </div>

        <!-- Informasi Lokasi -->
        <div class="section-header">Informasi Lokasi</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">Desa/Kelurahan <span class="text-danger">*</span></td>
                <td>
                    <input type="text" class="form-control @error('desa_kelurahan') is-invalid @enderror" 
                           name="desa_kelurahan" value="{{ old('desa_kelurahan', $form->desa_kelurahan) }}" required>
                    @error('desa_kelurahan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold;">Kecamatan <span class="text-danger">*</span></td>
                <td>
                    <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" 
                           name="kecamatan" value="{{ old('kecamatan', $form->kecamatan) }}" required>
                    @error('kecamatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold;">Kabupaten <span class="text-danger">*</span></td>
                <td>
                    <input type="text" class="form-control @error('kabupaten') is-invalid @enderror" 
                           name="kabupaten" value="{{ old('kabupaten', $form->kabupaten) }}" required>
                    @error('kabupaten')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold;">Tanggal FGD <span class="text-danger">*</span></td>
                <td>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                           name="tanggal" value="{{ old('tanggal', $form->tanggal ? $form->tanggal->format('Y-m-d') : '') }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold;">Jarak dari Lokasi Bencana (km)</td>
                <td>
                    <input type="number" step="0.1" class="form-control @error('jarak_bencana') is-invalid @enderror" 
                           name="jarak_bencana" value="{{ old('jarak_bencana', $form->jarak_bencana) }}">
                    @error('jarak_bencana')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold;">Tempat Pelaksanaan Sesi <span class="text-danger">*</span></td>
                <td>
                    <input type="text" class="form-control @error('tempat_sesi') is-invalid @enderror" 
                           name="tempat_sesi" value="{{ old('tempat_sesi', $form->tempat_sesi) }}" required>
                    @error('tempat_sesi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- Informasi Peserta -->
        <div class="section-header">Informasi Peserta</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">Jumlah Peserta <span class="text-danger">*</span></td>
                <td>
                    <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror" 
                           id="jumlah_peserta" name="jumlah_peserta" value="{{ old('jumlah_peserta', $form->jumlah_peserta) }}" min="1" required readonly>
                    @error('jumlah_peserta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Total otomatis dari jumlah perempuan + laki-laki</small>
                </td>
            </tr>
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold;">Jumlah Perempuan <span class="text-danger">*</span></td>
                <td>
                    <input type="number" class="form-control @error('jumlah_perempuan') is-invalid @enderror" 
                           id="jumlah_perempuan" name="jumlah_perempuan" value="{{ old('jumlah_perempuan', $form->jumlah_perempuan) }}" min="0" required>
                    @error('jumlah_perempuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold;">Jumlah Laki-laki <span class="text-danger">*</span></td>
                <td>
                    <input type="number" class="form-control @error('jumlah_laki_laki') is-invalid @enderror" 
                           id="jumlah_laki_laki" name="jumlah_laki_laki" value="{{ old('jumlah_laki_laki', $form->jumlah_laki_laki) }}" min="0" required>
                    @error('jumlah_laki_laki')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold;">Komposisi Peserta</td>
                <td>
                    <textarea class="form-control @error('komposisi_peserta') is-invalid @enderror" 
                              name="komposisi_peserta" rows="3">{{ old('komposisi_peserta', $form->komposisi_peserta) }}</textarea>
                    @error('komposisi_peserta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Contoh: Kepala Desa, Tokoh Masyarakat, Tokoh Agama, Kelompok Perempuan, dll.</small>
                </td>
            </tr>
        </table>

        <!-- Penyelenggara -->
        <div class="section-header">Penyelenggara</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">Fasilitator <span class="text-danger">*</span></td>
                <td>
                    <input type="text" class="form-control @error('fasilitator') is-invalid @enderror" 
                           name="fasilitator" value="{{ old('fasilitator', $form->fasilitator) }}" required>
                    @error('fasilitator')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold;">Pencatat/Notulen <span class="text-danger">*</span></td>
                <td>
                    <input type="text" class="form-control @error('pencatat') is-invalid @enderror" 
                           name="pencatat" value="{{ old('pencatat', $form->pencatat) }}" required>
                    @error('pencatat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- Hasil Diskusi -->
        <div class="section-header">Hasil Diskusi</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">1. Akses dan Hak Terhadap Sumber Daya</td>
                <td>
                    <textarea class="form-control @error('akses_hak') is-invalid @enderror" 
                              name="akses_hak" rows="5">{{ old('akses_hak', $form->akses_hak) }}</textarea>
                    @error('akses_hak')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold;">2. Fungsi Pranata Sosial dan Keagamaan</td>
                <td>
                    <textarea class="form-control @error('fungsi_pranata') is-invalid @enderror" 
                              name="fungsi_pranata" rows="5">{{ old('fungsi_pranata', $form->fungsi_pranata) }}</textarea>
                    @error('fungsi_pranata')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold;">3. Resiko dan Kerentanan</td>
                <td>
                    <textarea class="form-control @error('resiko_kerentanan') is-invalid @enderror" 
                              name="resiko_kerentanan" rows="5">{{ old('resiko_kerentanan', $form->resiko_kerentanan) }}</textarea>
                    @error('resiko_kerentanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- Action Buttons -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Update Data
            </button>
            <a href="{{ route('forms.form7.show', $form->id) }}" class="btn btn-secondary">
                <i class="bi bi-x"></i> Batalkan
            </a>
        </div>
    </div>
</form>
@endsection

@push('script')
    <script>
        // Auto-calculate total participants
        function updateTotalParticipants() {
            const perempuan = parseInt(document.getElementById('jumlah_perempuan').value) || 0;
            const lakiLaki = parseInt(document.getElementById('jumlah_laki_laki').value) || 0;
            document.getElementById('jumlah_peserta').value = perempuan + lakiLaki;
        }

        document.getElementById('jumlah_perempuan').addEventListener('input', updateTotalParticipants);
        document.getElementById('jumlah_laki_laki').addEventListener('input', updateTotalParticipants);
    </script>
@endpush
