<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 06 - Pendataan Tingkat Rumahtangga</title>
    <style>
        @page {
            margin: 0.8cm;
            size: A4;
        }
        
        body {
            font-family: 'Times New Roman', serif;
            font-size: 9pt;
            line-height: 1.2;
            margin: 0;
            padding: 0;
            color: #333;
            background: #ffffff;
        }
        
        .document-header {
            text-align: center;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 1px solid #ddd;
        }
        
        .document-title {
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0.1rem 0;
            letter-spacing: 1px;
            color: #333;
        }
        
        .document-subtitle {
            font-size: 9pt;
            font-weight: normal;
            margin: 0;
            color: #0066cc;
            margin-bottom: 0.1rem;
        }
        
        .section-header {
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            background: #f9f9f9;
            color: #333;
            padding: 3px 6px;
            margin: 6px 0 4px 0;
            text-align: left;
            border-radius: 2px;
            letter-spacing: 0.5px;
        }
        
        .form-section {
            margin-bottom: 4px;
        }
        
        .form-label {
            display: inline-block;
            width: 120px;
            vertical-align: top;
            font-weight: 500;
            color: #333;
            font-size: 9pt;
        }
        
        .form-indent {
            margin-left: 125px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 2px 0;
            font-size: 8pt;
            background: white;
        }
        
        table td {
            border: 1px solid #ddd;
            padding: 3px 4px;
            vertical-align: top;
            font-size: 8pt;
        }
        
        .label {
            font-weight: bold;
            width: 35%;
            background: #f9f9f9;
            color: #333;
        }
        
        .value {
            width: 65%;
            background: white;
            color: #333;
        }
        
        .text-content {
            margin: 0;
            padding: 4px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            font-size: 8pt;
            min-height: 15px;
            color: #333;
        }
        
        .documentation-section {
            margin-top: 8px;
            padding: 6px;
            background: #f9f9f9;
            border-radius: 2px;
        }
        
        .images {
            width: 100%;
            margin: 6px 0;
            display: flex;
            justify-content: space-between;
            gap: 6px;
        }
        
        .image-container {
            flex: 1;
            text-align: center;
            background: white;
            padding: 4px;
            border: 1px solid #ddd;
        }
        
        .image-container img {
            max-width: 100%;
            height: auto;
            max-height: 100px;
            border: 1px solid #333;
        }
        
        .image-caption {
            margin-top: 3px;
            font-size: 7pt;
            font-weight: bold;
            color: #333;
            text-align: center;
        }
        
        .signature-section {
            text-align: right;
            margin: 8px 40px 8px 0;
        }
        
        .signature-content {
            text-align: left;
            margin-bottom: 4px;
        }
        
        .signature-name {
            text-align: center;
            font-weight: bold;
            width: 150px;
            margin-top: 20px;
            border-bottom: 1px solid #333;
            padding-bottom: 1px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 2px 4px;
            border-radius: 2px;
            font-size: 7pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .badge-success {
            background: #27ae60;
            color: white;
        }
        
        .badge-warning {
            background: #f39c12;
            color: white;
        }
        
        .badge-danger {
            background: #e74c3c;
            color: white;
        }
        
        .badge-info {
            background: #3498db;
            color: white;
        }
        
        .badge-secondary {
            background: #95a5a6;
            color: white;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        p {
            margin-bottom: 0.2em;
            text-align: justify;
            line-height: 1.1;
            font-size: 9pt;
        }
        
        @media print {
            body { 
                font-size: 8pt; 
                line-height: 1.0;
            }
            .section-header {
                margin: 4px 0 3px 0;
                padding: 2px 4px;
                font-size: 8pt;
            }
            table {
                font-size: 7pt;
            }
            table td {
                padding: 2px 3px;
                font-size: 7pt;
            }
            .text-content {
                font-size: 7pt;
                padding: 3px;
            }
            .image-container img {
                max-height: 80px;
            }
        }
    </style>
</head>

<body>
    <!-- Document Header -->
    <div class="document-header">
        <div class="document-title"><strong>Formulir 06</strong></div>
        <div class="document-subtitle">Pendataan Tingkat Rumahtangga - JITUPASNA</div>
    </div>

    <!-- A. INFORMASI BENCANA -->
    <div class="section-header">A. Informasi Bencana</div>
    <div class="form-section">
        <p>
            <span class="form-label">Nama Bencana</span>: {{ $rumahtangga->bencana->nama_bencana }}
        </p>
        <p>
            <span class="form-label">Tanggal Bencana</span>: {{ $rumahtangga->bencana->tanggal }}
        </p>
        <p>
            <span class="form-label">Lokasi Bencana</span>: {{ $rumahtangga->bencana->lokasi }}
        </p>
    </div>

    <!-- B. DATA KEPALA KELUARGA -->
    <div class="section-header">B. Data Kepala Keluarga</div>
    <div class="form-section">
        <p>
            <span class="form-label">Nama Kepala Keluarga</span>: {{ $rumahtangga->nama_kk }}
        </p>
        <p>
            <span class="form-label">NIK</span>: {{ $rumahtangga->nik_kk }}
        </p>
        <p>
            <span class="form-label">Jumlah Anggota Keluarga</span>: {{ $rumahtangga->jumlah_anggota }} orang
        </p>
        <p>
            <span class="form-label">Nomor HP/Telepon</span>: {{ $rumahtangga->nomor_hp }}
        </p>
    </div>

    <!-- C. ALAMAT LENGKAP -->
    <div class="section-header">C. Alamat Lengkap</div>
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
    <div class="section-header">D. Status Rumah & Kerusakan</div>
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
    <div class="section-header">E. Kebutuhan Rehabilitasi</div>
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
    <div class="section-header">F. Status Bantuan</div>
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
        <div class="section-header">G. Keterangan Tambahan</div>
        <div class="text-content">{{ $rumahtangga->keterangan_tambahan }}</div>
    @endif

    <!-- H. DOKUMENTASI -->
    <div class="section-header page-break">H. Dokumentasi</div>
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
        <div style="text-align: right; margin-top: 0.5em; margin-right: 0;">
            <div style="text-align: center; width: 200px; margin-left: auto;">
                <p style="font-size: 8pt; margin: 1px 0;">{{ $rumahtangga->kabupaten }}, {{ now()->format('d F Y') }}</p>
                <strong>Petugas Pendataan</strong>
                
                <div style="margin-top: 2em;">
                    <strong>{{ $rumahtangga->createdBy->name ?? 'Petugas' }}</strong>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
