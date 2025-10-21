<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 06 - Pendataan Tingkat Rumahtangga</title>
    <style>
        @page {
            margin: 10mm;
            size: A4;
        }

        body {
            font-family: 'Times New Roman', serif;
            font-size: 9pt;
            line-height: 1.1;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .document-header {
            text-align: center;
            margin-bottom: 8px;
            border-bottom: 2px solid #000;
            padding-bottom: 6px;
        }

        .document-title {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0 0 3px 0;
            letter-spacing: 1px;
        }

        .document-subtitle {
            font-size: 9pt;
            font-weight: normal;
            margin: 0;
        }

        .section-header {
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #e9ecef;
            padding: 4px 6px;
            margin: 8px 0 5px 0;
            border: 1px solid #000;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 4px 0;
            font-size: 8pt;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th {
            background-color: #e9ecef;
            font-weight: bold;
            text-align: center;
            padding: 3px 2px;
            font-size: 8pt;
        }

        td {
            padding: 3px 4px;
            text-align: left;
            vertical-align: top;
        }

        .label {
            font-weight: bold;
            width: 30%;
            background-color: #f8f9fa;
            font-size: 8pt;
        }

        .value {
            width: 70%;
            font-size: 8pt;
        }

        .text-content {
            margin: 2px 0;
            padding: 3px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            font-size: 8pt;
            min-height: 15px;
        }

        .footer {
            margin-top: 15px;
            text-align: right;
            padding-right: 30px;
        }

        .signature {
            margin-top: 2em;
            font-weight: bold;
        }

        .images {
            width: 100%;
            margin-bottom: 10px;
        }

        .image-container {
            width: 32%;
            display: inline-block;
            text-align: center;
            vertical-align: top;
            margin: 0 1%;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            max-height: 120px;
            border: 1px solid #000;
        }

        .image-caption {
            margin-top: 3px;
            font-size: 8pt;
            text-align: center;
            font-weight: bold;
        }

        .page-break {
            page-break-before: always;
        }

        @media print {
            body {
                font-size: 8pt;
                line-height: 1.0;
            }

            .document-header {
                margin-bottom: 6px;
                padding-bottom: 4px;
            }

            .section-header {
                margin: 6px 0 4px 0;
                padding: 3px 4px;
                font-size: 8pt;
            }

            table {
                margin: 3px 0;
                font-size: 7pt;
            }

            th,
            td {
                padding: 2px 3px;
                font-size: 7pt;
            }

            .text-content {
                font-size: 7pt;
                padding: 2px;
            }

            .image-container img {
                max-height: 100px;
            }
        }
    </style>
</head>

<body>
    <!-- Header Formulir -->
    <div class="document-header">
        <div class="document-title">Formulir 06 - Pendataan Tingkat Rumahtangga</div>
        <div class="document-subtitle">JITUPASNA - Pengkajian Kebutuhan Pasca Bencana</div>
    </div>

    <!-- A. INFORMASI BENCANA -->
    <div class="section-header">A. Informasi Bencana</div>
    <table>
        <tr>
            <td class="label">Nama Bencana</td>
            <td class="value">{{ $bencana->bencana->nama_bencana }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Bencana</td>
            <td class="value">{{ $bencana->bencana->tanggal }}</td>
        </tr>
        <tr>
            <td class="label">Lokasi Bencana</td>
            <td class="value">{{ $bencana->bencana->lokasi }}</td>
        </tr>
    </table>

    <!-- B. DATA KEPALA KELUARGA -->
    <div class="section-header">B. Data Kepala Keluarga</div>
    <table>
        <tr>
            <td class="label">Nama Kepala Keluarga</td>
            <td class="value">{{ $form->nama_kk }}</td>
        </tr>
        <tr>
            <td class="label">NIK</td>
            <td class="value">{{ $form->nik_kk }}</td>
        </tr>
        <tr>
            <td class="label">Jumlah Anggota Keluarga</td>
            <td class="value">{{ $form->jumlah_anggota }} orang</td>
        </tr>
        <tr>
            <td class="label">Nomor HP/Telepon</td>
            <td class="value">{{ $form->nomor_hp }}</td>
        </tr>
    </table>

    <!-- C. ALAMAT LENGKAP -->
    <div class="section-header">C. Alamat Lengkap</div>
    <table>
        <tr>
            <td class="label">Dusun/Lingkungan</td>
            <td class="value">{{ $form->dusun }}</td>
        </tr>
        <tr>
            <td class="label">RT/RW</td>
            <td class="value">{{ $form->rt }}/{{ $form->rw }}</td>
        </tr>
        <tr>
            <td class="label">Desa/Kelurahan</td>
            <td class="value">{{ $form->desa }}</td>
        </tr>
        <tr>
            <td class="label">Kecamatan</td>
            <td class="value">{{ $form->kecamatan }}</td>
        </tr>
        <tr>
            <td class="label">Kabupaten/Kota</td>
            <td class="value">{{ $form->kabupaten }}</td>
        </tr>
        <tr>
            <td class="label">Provinsi</td>
            <td class="value">{{ $form->provinsi }}</td>
        </tr>
    </table>

    <!-- D. STATUS RUMAH & KERUSAKAN -->
    <div class="section-header">D. Status Rumah & Kerusakan</div>
    <table>
        <tr>
            <td class="label">Status Rumah</td>
            <td class="value">{{ $form->status_rumah }}</td>
        </tr>
        <tr>
            <td class="label">Status Hunian Pasca Bencana</td>
            <td class="value">{{ $form->status_hunian }}</td>
        </tr>
        <tr>
            <td class="label">Kategori Kerusakan</td>
            <td class="value">{{ $form->kategori_kerusakan }}</td>
        </tr>
    </table>

    <!-- E. KEBUTUHAN REHABILITASI -->
    <div class="section-header">E. Kebutuhan Rehabilitasi</div>
    <table>
        <tr>
            <td class="label">Kebutuhan Material</td>
            <td class="value">
                <div class="text-content">{{ $form->kebutuhan_material ?: 'Tidak ada data' }}</div>
            </td>
        </tr>
        <tr>
            <td class="label">Kebutuhan SDM</td>
            <td class="value">
                <div class="text-content">{{ $form->kebutuhan_sdm ?: 'Tidak ada data' }}</div>
            </td>
        </tr>
        <tr>
            <td class="label">Estimasi Kebutuhan Dana</td>
            <td class="value">Rp {{ number_format($form->kebutuhan_dana, 0, ',', '.') }}</td>
        </tr>
    </table>

    <!-- F. STATUS BANTUAN -->
    <div class="section-header">F. Status Bantuan</div>
    <table>
        <tr>
            <td class="label">Status Bantuan</td>
            <td class="value">{{ $form->status_bantuan }}</td>
        </tr>
        @if ($form->status_bantuan == 'Ya')
            <tr>
                <td class="label">Jenis Bantuan</td>
                <td class="value">{{ $form->jenis_bantuan }}</td>
            </tr>
            <tr>
                <td class="label">Nominal/Nilai Bantuan</td>
                <td class="value">Rp {{ number_format($form->nominal_bantuan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Pemberi Bantuan</td>
                <td class="value">{{ $form->pemberi_bantuan }}</td>
            </tr>
        @endif
    </table>

    @if ($form->keterangan_tambahan)
        <!-- G. KETERANGAN TAMBAHAN -->
        <div class="section-header">G. Keterangan Tambahan</div>
        <div class="text-content">{{ $form->keterangan_tambahan }}</div>
    @endif

    <!-- H. DOKUMENTASI -->
    <div class="section-header page-break">H. Dokumentasi</div>
    <div class="images">
        <div class="image-container">
            <img src="{{ public_path('storage/' . $form->foto_rumah) }}" alt="Foto Rumah">
            <div class="image-caption">Foto Rumah/Bangunan</div>
        </div>
        <div class="image-container">
            <img src="{{ public_path('storage/' . $form->foto_ktp) }}" alt="Foto KTP">
            <div class="image-caption">Foto KTP Kepala Keluarga</div>
        </div>
        <div class="image-container">
            <img src="{{ public_path('storage/' . $form->foto_kk) }}" alt="Foto KK">
            <div class="image-caption">Foto Kartu Keluarga</div>
        </div>
    </div>

    <!-- Footer dengan Tanda Tangan -->
    <div class="footer">
        <p style="font-size: 8pt; margin: 1px 0;">{{ $form->kabupaten }}, {{ now()->format('d F Y') }}</p>
        <p style="font-size: 8pt; margin: 1px 0;">Petugas Pendataan</p>
        <div class="signature">
            <p style="font-size: 8pt;">{{ $form->createdBy->name ?? 'Petugas' }}</p>
        </div>
    </div>
</body>

</html>
