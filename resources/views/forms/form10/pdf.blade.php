<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 10 - Analisa Data Akibat</title>
    <style>
        @page {
            size: landscape;
            margin: 1cm;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 11px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
        }
        .header h2 {
            margin: 0;
            padding: 0;
            font-size: 14px;
            font-weight: bold;
        }
        .header p {
            margin: 0;
            padding: 0;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 4px 8px;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
            font-weight: bold;
        }
        .section-title {
            font-weight: bold;
            margin: 12px 0 4px 0;
        }
        .page-break {
            page-break-after: always;
        }
        .footer {
            text-align: right;
            margin-top: 20px;
            padding-top: 8px;
            border-top: 1px solid #ddd;
            font-size: 10px;
        }
        .info-table {
            margin-bottom: 15px;
        }
        .data-table th {
            background-color: #e6e6e6;
            text-align: center;
            vertical-align: middle;
        }
        .data-table td {
            vertical-align: top;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>FORMULIR 10 - ANALISA DATA AKIBAT TERHADAP AKSES, FUNGSI, DAN RESIKO</h2>
        <p>Pengkajian Kebutuhan Pascabencana (JITUPASNA)</p>
    </div>

    <div>
        <h3>A. INFORMASI BENCANA</h3>
        <table class="info-table">
            <tr>
                <th width="15%">Nama Bencana</th>
                <td width="35%">{{ $analisa->bencana->kategori_bencana->nama }}</td>
                <th width="15%">Tanggal Kejadian</th>
                <td width="35%">{{ $analisa->bencana->tanggal }}</td>
            </tr>
            <tr>
                <th>Lokasi</th>
                <td>
                    @foreach($analisa->bencana->desa as $desa)
                        {{ $desa->nama }}@if(!$loop->last), @endif
                    @endforeach
                </td>
                <th>Referensi</th>
                <td>{{ $analisa->bencana->Ref }}</td>
            </tr>
        </table>

        <h3>B. ANALISA DATA AKIBAT</h3>
        <table class="info-table">
            <tr>
                <th width="15%">Sektor</th>
                <td width="35%">{{ $analisa->sektor }}</td>
                <th width="15%">Sub Sektor</th>
                <td width="35%">{{ $analisa->sub_sektor }}</td>
            </tr>
            <tr>
                <th>Lokasi</th>
                <td colspan="3">{{ $analisa->lokasi }}</td>
            </tr>
        </table>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th width="25%">Hasil Pengolahan Data Survey</th>
                    <th width="25%">Hasil Wawancara/FGD</th>
                    <th width="25%">Hasil Pendataan ke SKPD</th>
                    <th width="25%">Kebutuhan-Kegiatan Pemulihan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{!! nl2br(e($analisa->hasil_survey)) !!}</td>
                    <td>{!! nl2br(e($analisa->hasil_wawancara)) !!}</td>
                    <td>{!! nl2br(e($analisa->hasil_pendataan_skpd)) !!}</td>
                    <td>{!! nl2br(e($analisa->kebutuhan_pemulihan)) !!}</td>
                </tr>
            </tbody>
        </table>        <div class="footer">
            <table style="border: none; width: 100%;">
                <tr style="border: none;">
                    <td style="border: none; text-align: left; width: 60%;">
                        <p>Dokumen dibuat pada: {{ \Carbon\Carbon::now()->format('d F Y, H:i') }}</p>
                    </td>
                    <td style="border: none; text-align: right; width: 40%;">
                        <p>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
                        <br><br><br>
                        <p>____________________</p>
                        <p>(Petugas yang mengisi)</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
