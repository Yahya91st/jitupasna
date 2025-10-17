@extends('layouts.main')

@section('content')
<style>
    .document-container {
        background: #fff;
        padding: 20px;
        margin: 20px auto;
        max-width: 900px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: 'Times New Roman', serif;
        line-height: 1.3;
        color: #000;
        font-size: 14px;
    }
    
    .document-header {
        text-align: center;
        margin-bottom: 15px;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
    }
    
    .document-title {
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
        margin: 0 0 5px 0;
        letter-spacing: 1px;
    }
    
    .document-subtitle {
        font-size: 15px;
        font-weight: normal;
        margin: 0;
    }
    
    .section-header {
        font-size: 15px;
        font-weight: bold;
        text-transform: uppercase;
        background-color: #e9ecef;
        padding: 8px;
        margin: 15px 0 10px 0;
        border: 1px solid #000;
        text-align: center;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
        margin: 8px 0;
        font-size: 14px;
    }
    
    .form-table, .form-table th, .form-table td {
        border: 1px solid #000;
    }
    
    .form-table th {
        background-color: #e9ecef;
        font-weight: bold;
        text-align: center;
        padding: 6px 4px;
        font-size: 14px;
    }
    
    .form-table td {
        padding: 6px;
        text-align: left;
        vertical-align: top;
    }
    
    .label {
        font-weight: bold;
        width: 30%;
        background-color: #f8f9fa;
    }
    
    .value {
        width: 70%;
    }
    
    .text-content {
        text-align: justify;
        line-height: 1.4;
        padding: 8px;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        font-size: 14px;
    }
    
    .discussion-table {
        margin-bottom: 15px;
    }
    
    .discussion-header {
        background-color: #e9ecef;
        color: #000;
        text-align: center;
        font-size: 14px;
        border: 1px solid #000;
        font-weight: bold;
        padding: 8px;
    }
    
    .footer-signature {
        margin-top: 30px;
        text-align: right;
        padding-right: 50px;
    }
    
    .signature {
        margin-top: 3em;
        font-weight: bold;
    }
    
    .metadata-section {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid #ecf0f1;
        text-align: center;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
    }
    
    .action-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 2px solid #ecf0f1;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .btn-custom {
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .btn-primary-custom {
        background: #0066cc;
        color: white;
    }
    
    .btn-primary-custom:hover {
        background: #004499;
        color: white;
        text-decoration: none;
    }
    
    .btn-secondary-custom {
        background: #6c757d;
        color: white;
    }
    
    .btn-secondary-custom:hover {
        background: #545b62;
        color: white;
        text-decoration: none;
    }
    
    .btn-warning-custom {
        background: #ffc107;
        color: #000;
    }
    
    .btn-warning-custom:hover {
        background: #e0a800;
        color: #000;
        text-decoration: none;
    }
    
    .btn-danger-custom {
        background: #dc3545;
        color: white;
    }
    
    .btn-danger-custom:hover {
        background: #c82333;
        color: white;
        text-decoration: none;
    }
    
    .btn-group-right {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
</style>

<div class="page-heading">
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

    <div class="document-container">
        <!-- Header Formulir -->
        <div class="document-header">
            <div class="document-title">Formulir 07 - Focus Group Discussion (FGD)</div>
            <div class="document-subtitle">JITUPASNA - Pengkajian Kebutuhan Pasca Bencana</div>
        </div>
        <!-- A. INFORMASI BENCANA -->
        <div class="section-header">A. Informasi Bencana</div>
        <table class="form-table">
            <tr>
                <td class="label">Nama Bencana</td>
                <td class="value">{{ $form->bencana->kategori_bencana->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Bencana</td>
                <td class="value">{{ $form->bencana->tanggal ? \Carbon\Carbon::parse($form->bencana->tanggal)->format('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Lokasi Bencana</td>
                <td class="value">
                    @if ($form->bencana->desa && $form->bencana->desa->count() > 0)
                        @foreach ($form->bencana->desa as $desa)
                            {{ $desa->nama }}@if (!$loop->last), @endif
                        @endforeach
                    @else
                        -
                    @endif
                </td>
            </tr>
        </table>

        <!-- B. INFORMASI LOKASI FGD -->
        <div class="section-header">B. Informasi Lokasi FGD</div>
        <table class="form-table">
            <tr>
                <td class="label">Desa/Kelurahan</td>
                <td class="value">{{ $form->desa_kelurahan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kecamatan</td>
                <td class="value">{{ $form->kecamatan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kabupaten</td>
                <td class="value">{{ $form->kabupaten ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Pelaksanaan</td>
                <td class="value">{{ $form->tanggal ? \Carbon\Carbon::parse($form->tanggal)->format('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Jarak dari Lokasi Bencana</td>
                <td class="value">{{ $form->jarak_bencana ?? '-' }} km</td>
            </tr>
            <tr>
                <td class="label">Tempat Pelaksanaan</td>
                <td class="value">{{ $form->tempat_sesi ?? '-' }}</td>
            </tr>
        </table>

        <!-- C. INFORMASI PESERTA -->
        <div class="section-header">C. Informasi Peserta</div>
        <table class="form-table">
            <tr>
                <td class="label">Jumlah Peserta Total</td>
                <td class="value">{{ $form->jumlah_peserta ?? 0 }} orang</td>
            </tr>
            <tr>
                <td class="label">Jumlah Peserta Perempuan</td>
                <td class="value">{{ $form->jumlah_perempuan ?? 0 }} orang</td>
            </tr>
            <tr>
                <td class="label">Jumlah Peserta Laki-laki</td>
                <td class="value">{{ $form->jumlah_laki_laki ?? 0 }} orang</td>
            </tr>
            <tr>
                <td class="label">Komposisi Peserta</td>
                <td class="value">
                    <div class="text-content">{!! nl2br(e($form->komposisi_peserta ?? '-')) !!}</div>
                </td>
            </tr>
        </table>

        <!-- D. PENYELENGGARA -->
        <div class="section-header">D. Penyelenggara</div>
        <table class="form-table">
            <tr>
                <td class="label">Fasilitator</td>
                <td class="value">{{ $form->fasilitator ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Pencatat/Notulen</td>
                <td class="value">{{ $form->pencatat ?? '-' }}</td>
            </tr>
        </table>

        <!-- E. HASIL DISKUSI -->
        <div class="section-header">E. Hasil Diskusi</div>

        <table class="form-table discussion-table">
            <tr>
                <th colspan="2" class="discussion-header">
                    1. AKSES DAN HAK TERHADAP SUMBER DAYA
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="text-content">
                        {!! nl2br(e($form->akses_hak ?? 'Tidak ada data')) !!}
                    </div>
                </td>
            </tr>
        </table>

        <table class="form-table discussion-table">
            <tr>
                <th colspan="2" class="discussion-header">
                    2. FUNGSI PRANATA SOSIAL DAN KEAGAMAAN
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="text-content">
                        {!! nl2br(e($form->fungsi_pranata ?? 'Tidak ada data')) !!}
                    </div>
                </td>
            </tr>
        </table>

        <table class="form-table discussion-table">
            <tr>
                <th colspan="2" class="discussion-header">
                    3. RESIKO DAN KERENTANAN
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="text-content">
                        {!! nl2br(e($form->resiko_kerentanan ?? 'Tidak ada data')) !!}
                    </div>
                </td>
            </tr>
        </table>

        @if ($form->created_by)
            <!-- F. INFORMASI PENDOKUMENTASIAN -->
            <div class="section-header">F. Informasi Pendokumentasian</div>
            <table class="form-table">
                <tr>
                    <td class="label">Didokumentasikan Oleh</td>
                    <td class="value">{{ $form->creator->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Dokumentasi</td>
                    <td class="value">{{ $form->created_at ? $form->created_at->format('d F Y H:i') : '-' }}</td>
                </tr>
                @if ($form->updated_by && $form->updated_by != $form->created_by)
                    <tr>
                        <td class="label">Terakhir Diperbarui Oleh</td>
                        <td class="value">{{ $form->updater->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal Pembaruan</td>
                        <td class="value">{{ $form->updated_at ? $form->updated_at->format('d F Y H:i') : '-' }}</td>
                    </tr>
                @endif
            </table>
        @endif

        <!-- Footer dengan Tanda Tangan -->
        <div class="footer-signature">
            <p style="font-size: 14px;">{{ $form->kabupaten ?? 'Lokasi' }}, {{ now()->format('d F Y') }}</p>
            <p style="font-size: 14px;">Fasilitator FGD</p>
            <div class="signature">
                <p style="font-size: 14px;">{{ $form->fasilitator ?? 'Fasilitator' }}</p>
            </div>
        </div>

        <!-- Metadata -->
        <div class="metadata-section">
            <small>
                <strong>Dibuat pada:</strong> {{ $form->created_at ? $form->created_at->format('d F Y H:i') : '-' }} WIB<br>
                <strong>Terakhir diperbarui:</strong> {{ $form->updated_at ? $form->updated_at->format('d F Y H:i') : '-' }} WIB
            </small>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('forms.form7.list', ['bencana_id' => $form->bencana_id]) }}" class="btn-custom btn-secondary-custom">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <div class="btn-group-right">
                <a href="{{ route('forms.form7.edit', $form->id) }}" class="btn-custom btn-warning-custom">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('forms.form7.pdf', $form->id) }}" class="btn-custom btn-primary-custom" target="_blank">
                    <i class="bi bi-file-pdf"></i> Download PDF
                </a>
                <form action="{{ route('forms.form7.destroy', $form->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-custom btn-danger-custom">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
