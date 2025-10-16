<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 06 - Pendataan Tingkat Rumahtangga</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 20px 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h2,
        .header h3 {
            margin: 5px 0;
        }

        .header h2 {
            font-size: 18px;
        }

        .header h3 {
            font-size: 16px;
        }

        .content {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        .label {
            font-weight: bold;
            width: 30%;
        }

        .value {
            width: 70%;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            text-decoration: underline;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            padding-right: 50px;
        }

        .signature {
            margin-top: 50px;
            font-weight: bold;
        }

        .images {
            width: 100%;
            margin-bottom: 20px;
        }

        .image-container {
            width: 32%;
            display: inline-block;
            text-align: center;
            vertical-align: top;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            max-height: 150px;
            border: 1px solid #ddd;
        }

        .image-caption {
            margin-top: 5px;
            font-size: 11px;
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>FORMULIR 06 - PENDATAAN TINGKAT RUMAHTANGGA</h2>
            <h3>JITUPASNA - PENGKAJIAN KEBUTUHAN PASCA BENCANA</h3>
        </div>

        <div class="content">
            <div class="section">
                <div class="section-title">A. INFORMASI BENCANA</div>
                <table>
                    <tr>
                        <td class="label">Nama Bencana</td>
                        <td class="value">{{ $rumahtangga->bencana->nama_bencana }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal Bencana</td>
                        <td class="value">{{ $rumahtangga->bencana->tanggal }}</td>
                    </tr>
                    <tr>
                        <td class="label">Lokasi Bencana</td>
                        <td class="value">{{ $rumahtangga->bencana->lokasi }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">B. DATA KEPALA KELUARGA</div>
                <table>
                    <tr>
                        <td class="label">Nama Kepala Keluarga</td>
                        <td class="value">{{ $rumahtangga->nama_kk }}</td>
                    </tr>
                    <tr>
                        <td class="label">NIK</td>
                        <td class="value">{{ $rumahtangga->nik_kk }}</td>
                    </tr>
                    <tr>
                        <td class="label">Jumlah Anggota Keluarga</td>
                        <td class="value">{{ $rumahtangga->jumlah_anggota }} orang</td>
                    </tr>
                    <tr>
                        <td class="label">Nomor HP/Telepon</td>
                        <td class="value">{{ $rumahtangga->nomor_hp }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">C. ALAMAT LENGKAP</div>
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
            </div>

            <div class="section">
                <div class="section-title">D. STATUS RUMAH & KERUSAKAN</div>
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
                        <td class="value">{{ $rumahtangga->kategori_kerusakan }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">E. KEBUTUHAN REHABILITASI</div>
                <table>
                    <tr>
                        <td class="label">Kebutuhan Material</td>
                        <td class="value">{{ $rumahtangga->kebutuhan_material ?: 'Tidak ada' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Kebutuhan SDM</td>
                        <td class="value">{{ $rumahtangga->kebutuhan_sdm ?: 'Tidak ada' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Estimasi Kebutuhan Dana</td>
                        <td class="value">Rp {{ number_format($rumahtangga->kebutuhan_dana, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">F. STATUS BANTUAN</div>
                <table>
                    <tr>
                        <td class="label">Status Bantuan</td>
                        <td class="value">{{ $rumahtangga->status_bantuan }}</td>
                    </tr>
                    @if ($rumahtangga->status_bantuan == 'Ya')
                        <tr>
                            <td class="label">Jenis Bantuan</td>
                            <td class="value">{{ $rumahtangga->jenis_bantuan }}</td>
                        </tr>
                        <tr>
                            <td class="label">Nominal/Nilai Bantuan</td>
                            <td class="value">Rp {{ number_format($rumahtangga->nominal_bantuan, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="label">Pemberi Bantuan</td>
                            <td class="value">{{ $rumahtangga->pemberi_bantuan }}</td>
                        </tr>
                    @endif
                </table>
            </div>

            @if ($rumahtangga->keterangan_tambahan)
                <div class="section">
                    <div class="section-title">G. KETERANGAN TAMBAHAN</div>
                    <table>
                        <tr>
                            <td>{{ $rumahtangga->keterangan_tambahan }}</td>
                        </tr>
                    </table>
                </div>
            @endif

            <div class="section page-break">
                <div class="section-title">H. DOKUMENTASI</div>
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

            <div class="footer">
                <p>{{ $rumahtangga->kabupaten }}, {{ now()->format('d F Y') }}</p>
                <p>Petugas Pendataan</p>
                <div class="signature">
                    <p>{{ $rumahtangga->createdBy->name ?? 'Petugas' }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
