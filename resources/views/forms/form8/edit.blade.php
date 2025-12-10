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

<form method="POST" action="{{ route('forms.form8.update', $penilaian->id) }}">
    @csrf
    @method('PATCH')
    <input type="hidden" name="bencana_id" value="{{ $penilaian->bencana_id }}">

    <div class="form-container">
        <!-- Document Header -->
        <div class="form-header">
            <h5><strong>Formulir 08 - Edit</strong></h5>
            <h5>Pengolahan dan Analisis Data Penilaian Kerusakan dan Kerugian</h5>
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

        <!-- Info Bencana -->
        @if(isset($bencana))
        <div class="alert alert-info text-white mb-3">
            <strong>Informasi Bencana:</strong> {{ $bencana->kategori_bencana->nama }} 
            pada {{ $bencana->tanggal }}
            di 
            @foreach($bencana->desa as $desa)
                {{ $desa->nama }}@if(!$loop->last), @endif
            @endforeach
        </div>
        @endif

        <!-- 1. Informasi Umum -->
        <div class="section-header">1. Informasi Umum</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">Nomor Dokumen <span class="text-danger">*</span></td>
                <td>
                    <input type="text" class="form-control @error('nomor_dokumen') is-invalid @enderror" 
                           name="nomor_dokumen" value="{{ old('nomor_dokumen', $penilaian->nomor_dokumen) }}" required>
                    @error('nomor_dokumen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold;">Tanggal <span class="text-danger">*</span></td>
                <td>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                           name="tanggal" value="{{ old('tanggal', $penilaian->tanggal) }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- 2. Tim Penilai -->
        <div class="section-header">2. Tim Penilai</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">Tim Penilai <span class="text-danger">*</span></td>
                <td>
                    <textarea class="form-control @error('tim_penilai') is-invalid @enderror" 
                              name="tim_penilai" rows="4" required>{{ old('tim_penilai', $penilaian->tim_penilai) }}</textarea>
                    <small class="text-muted">Masukkan nama dan instansi anggota tim penilai, satu per baris</small>
                    @error('tim_penilai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- 3. Metodologi -->
        <div class="section-header">3. Metodologi</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">Metodologi Penilaian <span class="text-danger">*</span></td>
                <td>
                    <textarea class="form-control @error('metodologi') is-invalid @enderror" 
                              name="metodologi" rows="4" required>{{ old('metodologi', $penilaian->metodologi) }}</textarea>
                    <small class="text-muted">Jelaskan metodologi yang digunakan dalam penilaian</small>
                    @error('metodologi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- 4. Sektor Terkena Dampak -->
        <div class="section-header">4. Sektor Terkena Dampak</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">Sektor Terkena Dampak <span class="text-danger">*</span></td>
                <td>
                    <textarea class="form-control @error('sektor_terkena_dampak') is-invalid @enderror" 
                              name="sektor_terkena_dampak" rows="4" required>{{ old('sektor_terkena_dampak', $penilaian->sektor_terkena_dampak) }}</textarea>
                    <small class="text-muted">Jelaskan sektor-sektor yang terkena dampak bencana</small>
                    @error('sektor_terkena_dampak')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- 5. Dampak Ekonomi -->
        <div class="section-header">5. Dampak Ekonomi</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">Dampak Ekonomi <span class="text-danger">*</span></td>
                <td>
                    <textarea class="form-control @error('dampak_ekonomi') is-invalid @enderror" 
                              name="dampak_ekonomi" rows="4" required>{{ old('dampak_ekonomi', $penilaian->dampak_ekonomi) }}</textarea>
                    <small class="text-muted">Jelaskan dampak ekonomi dari bencana</small>
                    @error('dampak_ekonomi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- 6. Dampak Sosial -->
        <div class="section-header">6. Dampak Sosial</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">Dampak Sosial <span class="text-danger">*</span></td>
                <td>
                    <textarea class="form-control @error('dampak_sosial') is-invalid @enderror" 
                              name="dampak_sosial" rows="4" required>{{ old('dampak_sosial', $penilaian->dampak_sosial) }}</textarea>
                    <small class="text-muted">Jelaskan dampak sosial dari bencana</small>
                    @error('dampak_sosial')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- 7. Kebutuhan Pemulihan -->
        <div class="section-header">7. Kebutuhan Pemulihan</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">Kebutuhan Pemulihan <span class="text-danger">*</span></td>
                <td>
                    <textarea class="form-control @error('kebutuhan_pemulihan') is-invalid @enderror" 
                              name="kebutuhan_pemulihan" rows="4" required>{{ old('kebutuhan_pemulihan', $penilaian->kebutuhan_pemulihan) }}</textarea>
                    <small class="text-muted">Jelaskan kebutuhan pemulihan pascabencana</small>
                    @error('kebutuhan_pemulihan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- 8. Kesimpulan -->
        <div class="section-header">8. Kesimpulan</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">Kesimpulan <span class="text-danger">*</span></td>
                <td>
                    <textarea class="form-control @error('kesimpulan') is-invalid @enderror" 
                              name="kesimpulan" rows="4" required>{{ old('kesimpulan', $penilaian->kesimpulan) }}</textarea>
                    @error('kesimpulan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- 9. Rekomendasi -->
        <div class="section-header">9. Rekomendasi</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">Rekomendasi <span class="text-danger">*</span></td>
                <td>
                    <textarea class="form-control @error('rekomendasi') is-invalid @enderror" 
                              name="rekomendasi" rows="4" required>{{ old('rekomendasi', $penilaian->rekomendasi) }}</textarea>
                    @error('rekomendasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- 10. Penandatangan -->
        <div class="section-header">10. Penandatangan</div>
        <table class="table table-bordered">
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold; width: 35%;">Nama Penandatangan <span class="text-danger">*</span></td>
                <td>
                    <input type="text" class="form-control @error('nama_penandatangan') is-invalid @enderror" 
                           name="nama_penandatangan" value="{{ old('nama_penandatangan', $penilaian->nama_penandatangan) }}" required>
                    @error('nama_penandatangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td style="background-color: #f8f9fa; font-weight: bold;">Jabatan Penandatangan <span class="text-danger">*</span></td>
                <td>
                    <input type="text" class="form-control @error('jabatan_penandatangan') is-invalid @enderror" 
                           name="jabatan_penandatangan" value="{{ old('jabatan_penandatangan', $penilaian->jabatan_penandatangan) }}" required>
                    @error('jabatan_penandatangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- Action Buttons -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('forms.form8.show', $penilaian->id) }}" class="btn btn-secondary">
                <i class="bi bi-x"></i> Kembali
            </a>
        </div>
    </div>
</form>
@endsection
