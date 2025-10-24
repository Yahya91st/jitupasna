<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 07 - Focus Group Discussion (FGD)</title>
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
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th {
            background-color: #f9f9f9;
            font-weight: bold;
            text-align: center;
            padding: 3px 4px;
            font-size: 8pt;
            color: #333;
        }

        td {
            padding: 3px 4px;
            text-align: left;
            vertical-align: top;
            font-size: 8pt;
        }

        .label {
            font-weight: bold;
            width: 30%;
            background-color: #f9f9f9;
            color: #333;
        }

        .value {
            width: 70%;
            color: #333;
        }

        .text-content {
            text-align: justify;
            line-height: 1.2;
            padding: 4px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            font-size: 8pt;
            color: #333;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            margin: 8px 40px 8px 0;
        }

        .signature-content {
            text-align: left;
            margin-bottom: 4px;
        }

        .signature {
            margin-top: 3em;
            font-weight: bold;
            width: 150px;
            margin-top: 20px;
            border-bottom: 1px solid #333;
            padding-bottom: 1px;
        }

        p {
            margin-bottom: 0.2em;
            text-align: justify;
            line-height: 1.1;
            font-size: 9pt;
        }

        @media print {
            body {
                font-size: 9pt;
                line-height: 1.2;
            }

            .document-header {
                margin-bottom: 10px;
                padding-bottom: 8px;
            }

            .section-header {
                margin: 4px 0 3px 0;
                padding: 2px 4px;
                font-size: 8pt;
            }

            table {
                margin: 2px 0;
                font-size: 7pt;
            }

            th,
            td {
                padding: 4px;
            }
        }
    </style>
</head>

<body>
    <!-- Document Header -->
    <div class="document-header">
        <div class="document-title"><strong>Formulir 07</strong></div>
        <div class="document-subtitle">Focus Group Discussion (FGD) - JITUPASNA</div>
    </div>
    <!-- A. INFORMASI BENCANA -->
    <div class="section-header">A. Informasi Bencana</div>
    <table>
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
                        {{ $desa->nama }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                @else
                    -
                @endif
            </td>
        </tr>
    </table>

    <!-- B. INFORMASI LOKASI FGD -->
    <div class="section-header">B. Informasi Lokasi FGD</div>
    <div class="form-section">
        <p>
            <span class="form-label">Desa/Kelurahan</span>: {{ $form->desa_kelurahan ?? '-' }}
        </p>
        <p>
            <span class="form-label">Kecamatan</span>: {{ $form->kecamatan ?? '-' }}
        </p>
        <p>
            <span class="form-label">Kabupaten</span>: {{ $form->kabupaten ?? '-' }}
        </p>
        <p>
            <span class="form-label">Tanggal Pelaksanaan</span>: {{ $form->tanggal ? \Carbon\Carbon::parse($form->tanggal)->format('d F Y') : '-' }}
        </p>
        <p>
            <span class="form-label">Jarak dari Bencana</span>: {{ $form->jarak_bencana ?? '-' }} km
        </p>
        <p>
            <span class="form-label">Tempat Pelaksanaan</span>: {{ $form->tempat_sesi ?? '-' }}
        </p>
    </div>

    <!-- C. INFORMASI PESERTA -->
    <div class="section-header">C. Informasi Peserta</div>
    <table>
        <tr>
            <td class="label">Jumlah Peserta Total</td>
            <td class="value">{{ $form->jumlah_peserta ?? 0 }} orang</td>
        </tr>
        <tr>
            <td class="label">Peserta Perempuan</td>
            <td class="value">{{ $form->jumlah_perempuan ?? 0 }} orang</td>
        </tr>
        <tr>
            <td class="label">Peserta Laki-laki</td>
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
    <div class="form-section">
        <p>
            <span class="form-label">Fasilitator</span>: {{ $form->fasilitator ?? '-' }}
        </p>
        <p>
            <span class="form-label">Pencatat/Notulen</span>: {{ $form->pencatat ?? '-' }}
        </p>
    </div>

    <!-- E. HASIL DISKUSI -->
    <div class="section-header">E. Hasil Diskusi</div>

    <table style="margin-bottom: 8px;">
        <tr>
            <th colspan="2" style="background-color: #f9f9f9; color: #333; text-align: center; font-size: 8pt; border: 1px solid #ddd;">
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

    <table style="margin-bottom: 8px;">
        <tr>
            <th colspan="2" style="background-color: #f9f9f9; color: #333; text-align: center; font-size: 8pt; border: 1px solid #ddd;">
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

    <table style="margin-bottom: 8px;">
        <tr>
            <th colspan="2" style="background-color: #f9f9f9; color: #333; text-align: center; font-size: 8pt; border: 1px solid #ddd;">
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
        <div class="form-section">
            <p>
                <span class="form-label">Didokumentasikan Oleh</span>: {{ $form->creator->name ?? '-' }}
            </p>
            <p>
                <span class="form-label">Tanggal Dokumentasi</span>: {{ $form->created_at ? $form->created_at->format('d F Y H:i') : '-' }}
            </p>
            @if ($form->updated_by && $form->updated_by != $form->created_by)
                <p>
                    <span class="form-label">Terakhir Diperbarui</span>: {{ $form->updater->name ?? '-' }}
                </p>
                <p>
                    <span class="form-label">Tanggal Pembaruan</span>: {{ $form->updated_at ? $form->updated_at->format('d F Y H:i') : '-' }}
                </p>
            @endif
        </div>
    @endif

    <!-- Signature Section -->
    <div class="signature-section">
        <div style="text-align: right; margin-top: 0.5em; margin-right: 0;">
            <div style="text-align: center; width: 200px; margin-left: auto;">
                <p style="font-size: 8pt; margin: 1px 0;">{{ $form->kabupaten ?? 'Lokasi' }}, {{ now()->format('d F Y') }}</p>
                <strong>Fasilitator FGD</strong>

                <div style="margin-top: 2em;">
                    <strong>{{ $form->fasilitator ?? 'Fasilitator' }}</strong>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
