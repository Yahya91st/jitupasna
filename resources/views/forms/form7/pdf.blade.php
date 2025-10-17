<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 07 - Focus Group Discussion (FGD)</title>
    <style>
        @page {
            margin: 15mm;
            size: A4;
        }
        
        body {
            font-family: 'Times New Roman', serif;
            font-size: 10pt;
            line-height: 1.3;
            margin: 0;
            padding: 0;
            color: #000;
        }
        
        .document-header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        
        .document-title {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0 0 5px 0;
            letter-spacing: 1px;
        }
        
        .document-subtitle {
            font-size: 11pt;
            font-weight: normal;
            margin: 0;
        }
        
        .section-header {
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #e9ecef;
            padding: 8px;
            margin: 15px 0 10px 0;
            border: 1px solid #000;
            text-align: center;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
            font-size: 9pt;
        }
        
        table, th, td {
            border: 1px solid #000;
        }
        
        th {
            background-color: #e9ecef;
            font-weight: bold;
            text-align: center;
            padding: 6px 4px;
            font-size: 9pt;
        }
        
        td {
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
            font-size: 10pt;
        }
        
        .footer {
            margin-top: 30px;
            text-align: right;
            padding-right: 50px;
        }
        
        .signature {
            margin-top: 3em;
            font-weight: bold;
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
                margin: 10px 0 8px 0;
                padding: 6px;
            }
            table {
                margin: 6px 0;
            }
            th, td {
                padding: 4px;
            }
        }
    </style>
</head>

<body>
    <!-- Header Formulir -->
    <div class="document-header">
        <div class="document-title">Formulir 07 - Focus Group Discussion (FGD)</div>
        <div class="document-subtitle">JITUPASNA - Pengkajian Kebutuhan Pasca Bencana</div>
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
    <table>
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
    <table>
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
    <table>
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

    <table style="margin-bottom: 15px;">
        <tr>
            <th colspan="2" style="background-color: #e9ecef; color: #000; text-align: center; font-size: 10pt; border: 1px solid #000;">
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

    <table style="margin-bottom: 15px;">
        <tr>
            <th colspan="2" style="background-color: #e9ecef; color: #000; text-align: center; font-size: 10pt; border: 1px solid #000;">
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

    <table style="margin-bottom: 15px;">
        <tr>
            <th colspan="2" style="background-color: #e9ecef; color: #000; text-align: center; font-size: 10pt; border: 1px solid #000;">
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
        <table>
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
    <div class="footer">
        <p style="font-size: 10pt;">{{ $form->kabupaten ?? 'Lokasi' }}, {{ now()->format('d F Y') }}</p>
        <p style="font-size: 10pt;">Fasilitator FGD</p>
        <div class="signature">
            <p style="font-size: 10pt;">{{ $form->fasilitator ?? 'Fasilitator' }}</p>
        </div>
    </div>
</body>
</html>
