<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 07 - Focus Group Discussion (FGD)</title>
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
            padding: 20px;
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
            font-weight: bold;
        }

        .label {
            font-weight: bold;
            width: 30%;
            background-color: #f8f9fa;
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
            background-color: #e9ecef;
            padding: 8px;
            border-left: 4px solid #333;
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

        .text-content {
            text-align: justify;
            line-height: 1.8;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>FORMULIR 07 - FOCUS GROUP DISCUSSION (FGD)</h2>
            <h3>JITUPASNA - PENGKAJIAN KEBUTUHAN PASCA BENCANA</h3>
        </div>

        <div class="content">
            <div class="section">
                <div class="section-title">A. INFORMASI BENCANA</div>
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
            </div>

            <div class="section">
                <div class="section-title">B. INFORMASI LOKASI FGD</div>
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
            </div>

            <div class="section">
                <div class="section-title">C. INFORMASI PESERTA</div>
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
                        <td class="value text-content">{!! nl2br(e($form->komposisi_peserta ?? '-')) !!}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">D. PENYELENGGARA</div>
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
            </div>

            <div class="section">
                <div class="section-title">E. HASIL DISKUSI</div>

                <table style="margin-bottom: 15px;">
                    <tr>
                        <th colspan="2" style="background-color: #6c757d; color: white; text-align: center;">
                            1. AKSES DAN HAK TERHADAP SUMBER DAYA
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-content">
                            {!! nl2br(e($form->akses_hak ?? 'Tidak ada data')) !!}
                        </td>
                    </tr>
                </table>

                <table style="margin-bottom: 15px;">
                    <tr>
                        <th colspan="2" style="background-color: #6c757d; color: white; text-align: center;">
                            2. FUNGSI PRANATA SOSIAL DAN KEAGAMAAN
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-content">
                            {!! nl2br(e($form->fungsi_pranata ?? 'Tidak ada data')) !!}
                        </td>
                    </tr>
                </table>

                <table style="margin-bottom: 15px;">
                    <tr>
                        <th colspan="2" style="background-color: #6c757d; color: white; text-align: center;">
                            3. RESIKO DAN KERENTANAN
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-content">
                            {!! nl2br(e($form->resiko_kerentanan ?? 'Tidak ada data')) !!}
                        </td>
                    </tr>
                </table>
            </div>

            @if ($form->created_by)
                <div class="section">
                    <div class="section-title">F. INFORMASI PENDOKUMENTASIAN</div>
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
                </div>
            @endif

            <div class="footer">
                <p>{{ $form->kabupaten ?? 'Lokasi' }}, {{ now()->format('d F Y') }}</p>
                <p>Fasilitator FGD</p>
                <div class="signature">
                    <p>{{ $form->fasilitator ?? 'Fasilitator' }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
