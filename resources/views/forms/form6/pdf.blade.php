<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 06 - Pendataan Tingkat Rumahtangga</title>
    <style>
        @page {
            margin: 0.5cm;
            size: A4;
        }
        
        body {
            font-family: 'Times New Roman', serif;
            font-size: 8pt;
            line-height: 1.2;
            margin: 0.5cm;
            color: #333;
        }
        
        .document-title {
            text-align: center;
            margin-bottom: 6px;
            padding-bottom: 4px;
            border-bottom: 2px solid #0066cc;
        }
        
        .document-title h5 {
            margin: 0.1rem 0;
            font-weight: bold;
            color: #333;
            font-size: 10pt;
        }
        
        .document-title h5:first-child {
            color: #0066cc;
            margin-bottom: 0.1rem;
            font-size: 9pt;
        }
        
        .section-header {
            font-size: 8pt;
            font-weight: bold;
            background: #f0f0f0;
            color: #333;
            padding: 3px 6px;
            margin: 6px 0 3px 0;
            border-left: 3px solid #0066cc;
            letter-spacing: 0.2px;
        }
        
        .form-section {
            margin-bottom: 3px;
        }
        
        .form-label {
            display: inline-block;
            width: 140px;
            vertical-align: top;
            font-weight: 600;
            color: #555;
            font-size: 8pt;
        }
        
        .form-value {
            color: #000;
            font-weight: normal;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 4px 0;
            font-size: 8pt;
        }
        
        table td {
            border: 1px solid #333;
            padding: 3px 5px;
            vertical-align: top;
        }
        
        .label {
            font-weight: 600;
            width: 35%;
            background: #f5f5f5;
            color: #333;
        }
        
        .value {
            width: 65%;
            background: white;
            color: #000;
        }
        
        .text-content {
            margin: 0;
            padding: 3px 5px;
            background: white;
            font-size: 8pt;
            min-height: 12px;
            color: #000;
            line-height: 1.2;
        }
        
        .documentation-section {
            margin-top: 6px;
            padding: 5px;
            background: #f9f9f9;
            border: 1px solid #ddd;
        }
        
        .images {
            width: 100%;
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
            gap: 5px;
        }
        
        .image-container {
            flex: 1;
            text-align: center;
            background: white;
            padding: 4px;
            border: 1px solid #333;
        }
        
        .image-container img {
            max-width: 100%;
            height: auto;
            max-height: 80px;
            border: 1px solid #666;
        }
        
        .image-caption {
            margin-top: 3px;
            font-size: 7pt;
            font-weight: bold;
            color: #333;
            text-align: center;
        }
        
        .signature-section {
            position: relative;
            text-align: right;
            margin-top: 8px;
            page-break-inside: avoid;
        }
        
        .signature-box {
            display: inline-block;
            text-align: center;
            width: 150px;
            float: right;
        }
        
        .signature-name {
            text-align: center;
            font-weight: bold;
            margin-top: 35px;
            border-bottom: 1px solid #333;
            padding-bottom: 2px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 2px;
            font-size: 7pt;
            font-weight: bold;
        }
        
        .badge-success {
            background: #28a745;
            color: white;
        }
        
        .badge-warning {
            background: #ffc107;
            color: #000;
        }
        
        .badge-danger {
            background: #dc3545;
            color: white;
        }
        
        .badge-info {
            background: #17a2b8;
            color: white;
        }
        
        .badge-secondary {
            background: #6c757d;
            color: white;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        p {
            margin: 2px 0;
            line-height: 1.2;
            font-size: 8pt;
        }
        
        strong {
            font-weight: 600;
        }
        
        @media print {
            body { 
                font-size: 8pt;
            }
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>

<body>
    <!-- Document Header -->
    <div class="document-title">
        <h5><strong>Formulir 06</strong></h5>
        <h5>Pendataan Tingkat Rumahtangga</h5>
    </div>

    <!-- A. INFORMASI BENCANA -->
    <div class="section-header">A. INFORMASI BENCANA</div>
    <div class="form-section">
        <p>
            <span class="form-label">Nama Bencana</span>: <span class="form-value">{{ $rumahtangga->bencana->nama_bencana }}</span>
        </p>
        <p>
            <span class="form-label">Tanggal Bencana</span>: <span class="form-value">{{ \Carbon\Carbon::parse($rumahtangga->bencana->tanggal)->format('d F Y') }}</span>
        </p>
        <p>
            <span class="form-label">Lokasi Bencana</span>: <span class="form-value">{{ $rumahtangga->bencana->lokasi }}</span>
        </p>
    </div>

    <!-- B. DATA KEPALA KELUARGA -->
    <div class="section-header">B. DATA KEPALA KELUARGA</div>
    <div class="form-section">
        <p>
            <span class="form-label">Nama Kepala Keluarga</span>: <span class="form-value">{{ $rumahtangga->nama_kk }}</span>
        </p>
        <p>
            <span class="form-label">NIK</span>: <span class="form-value">{{ $rumahtangga->nik_kk }}</span>
        </p>
        <p>
            <span class="form-label">Jumlah Anggota Keluarga</span>: <span class="form-value">{{ $rumahtangga->jumlah_anggota }} orang</span>
        </p>
        <p>
            <span class="form-label">Nomor HP/Telepon</span>: <span class="form-value">{{ $rumahtangga->nomor_hp }}</span>
        </p>
    </div>

    <!-- C. ALAMAT LENGKAP -->
    <div class="section-header">C. ALAMAT LENGKAP</div>
    <table>
        <tr>
            <td class="label">Dusun/Lingkungan</td>
            <td class="value">{{ $rumahtangga->dusun }}</td>
        </tr>
        <tr>
            <td class="label">RT/RW</td>
            <td class="value">{{ $rumahtangga->rt }}/{{ $rumahtangga->rw }}</td>
        </tr>
        <tr>
            <td class="label">Desa/Kelurahan</td>
            <td class="value">{{ $rumahtangga->desa }}</td>
        </tr>
        <tr>
            <td class="label">Kecamatan</td>
            <td class="value">{{ $rumahtangga->kecamatan }}</td>
        </tr>
        <tr>
            <td class="label">Kabupaten/Kota</td>
            <td class="value">{{ $rumahtangga->kabupaten }}</td>
        </tr>
        <tr>
            <td class="label">Provinsi</td>
            <td class="value">{{ $rumahtangga->provinsi }}</td>
        </tr>
    </table>

    <!-- D. STATUS RUMAH & KERUSAKAN -->
    <div class="section-header">D. STATUS RUMAH & KERUSAKAN</div>
    <table>
        <tr>
            <td class="label">Status Rumah</td>
            <td class="value">{{ $rumahtangga->status_rumah }}</td>
        </tr>
        <tr>
            <td class="label">Status Hunian Pasca Bencana</td>
            <td class="value">{{ $rumahtangga->status_hunian }}</td>
        </tr>
        <tr>
            <td class="label">Kategori Kerusakan</td>
            <td class="value">
                @if($rumahtangga->kategori_kerusakan == 'Rusak Berat')
                    <span class="status-badge badge-danger">{{ $rumahtangga->kategori_kerusakan }}</span>
                @elseif($rumahtangga->kategori_kerusakan == 'Rusak Sedang')
                    <span class="status-badge badge-warning">{{ $rumahtangga->kategori_kerusakan }}</span>
                @elseif($rumahtangga->kategori_kerusakan == 'Rusak Ringan')
                    <span class="status-badge badge-info">{{ $rumahtangga->kategori_kerusakan }}</span>
                @else
                    <span class="status-badge badge-success">{{ $rumahtangga->kategori_kerusakan }}</span>
                @endif
            </td>
        </tr>
    </table>

    <!-- E. KEBUTUHAN REHABILITASI -->
    <div class="section-header">E. KEBUTUHAN REHABILITASI</div>
    <table>
        <tr>
            <td class="label">Kebutuhan Material</td>
            <td class="value">
                <div class="text-content">{{ $rumahtangga->kebutuhan_material ?: 'Tidak ada data' }}</div>
            </td>
        </tr>
        <tr>
            <td class="label">Kebutuhan SDM</td>
            <td class="value">
                <div class="text-content">{{ $rumahtangga->kebutuhan_sdm ?: 'Tidak ada data' }}</div>
            </td>
        </tr>
        <tr>
            <td class="label">Estimasi Kebutuhan Dana</td>
            <td class="value"><strong>Rp {{ number_format($rumahtangga->kebutuhan_dana, 0, ',', '.') }}</strong></td>
        </tr>
    </table>

    <!-- F. STATUS BANTUAN -->
    <div class="section-header">F. STATUS BANTUAN</div>
    <table>
        <tr>
            <td class="label">Status Bantuan</td>
            <td class="value">
                @if($rumahtangga->status_bantuan == 'Ya')
                    <span class="status-badge badge-success">Sudah Menerima Bantuan</span>
                @else
                    <span class="status-badge badge-secondary">Belum Menerima Bantuan</span>
                @endif
            </td>
        </tr>
        @if ($rumahtangga->status_bantuan == 'Ya')
            <tr>
                <td class="label">Jenis Bantuan</td>
                <td class="value">{{ $rumahtangga->jenis_bantuan }}</td>
            </tr>
            <tr>
                <td class="label">Nominal/Nilai Bantuan</td>
                <td class="value"><strong>Rp {{ number_format($rumahtangga->nominal_bantuan, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td class="label">Pemberi Bantuan</td>
                <td class="value">{{ $rumahtangga->pemberi_bantuan }}</td>
            </tr>
        @endif
    </table>

    @if ($rumahtangga->keterangan_tambahan)
        <!-- G. KETERANGAN TAMBAHAN -->
        <div class="section-header">G. KETERANGAN TAMBAHAN</div>
        <table>
            <tr>
                <td colspan="2" class="value">
                    <div class="text-content">{{ $rumahtangga->keterangan_tambahan }}</div>
                </td>
            </tr>
        </table>
    @endif

    <!-- H. DOKUMENTASI -->
    <div class="section-header">H. DOKUMENTASI</div>
    <div class="documentation-section">
        <div class="images">
            <div class="image-container">
                <img src="{{ public_path('storage/' . $rumahtangga->foto_rumah) }}" alt="Foto Rumah">
                <div class="image-caption">Foto Rumah/Bangunan</div>
            </div>
            <div class="image-container">
                <img src="{{ public_path('storage/' . $rumahtangga->foto_ktp) }}" alt="Foto KTP">
                <div class="image-caption">Foto KTP Kepala Keluarga</div>
            </div>
            <div class="image-container">
                <img src="{{ public_path('storage/' . $rumahtangga->foto_kk) }}" alt="Foto KK">
                <div class="image-caption">Foto Kartu Keluarga</div>
            </div>
        </div>
    </div>

    <!-- Signature Section -->
    <div class="signature-section">
        <div class="signature-box">
            <p style="margin: 0;">{{ $rumahtangga->kabupaten }}, {{ now()->format('d F Y') }}</p>
            <p style="margin: 5px 0;"><strong>Petugas Pendataan</strong></p>
            <div class="signature-name">
                {{ $rumahtangga->createdBy->name ?? 'Petugas' }}
            </div>
        </div>
    </div>
</body>
</html>
