<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Formulir 12 - Anggaran Kegiatan PKPB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        h1 {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>FORMULIR 12<br>STANDAR PENYUSUNAN KEGIATAN DAN ANGGARAN UNTUK PKPB</h1>
        
        <h2>A. INFORMASI BENCANA</h2>
        <table>
            <tr>
                <th width="30%">Jenis Bencana</th>
                <td>{{ $anggaran->bencana->kategori_bencana->nama }}</td>
            </tr>
            <tr>
                <th>Tanggal Kejadian</th>
                <td>{{ $anggaran->bencana->tanggal }}</td>
            </tr>
            <tr>
                <th>Lokasi</th>
                <td>
                    @foreach($anggaran->bencana->desa as $desa)
                        {{ $desa->nama }}@if(!$loop->last), @endif
                    @endforeach
                </td>
            </tr>
        </table>
        
        <h2>B. ANGGARAN KEGIATAN</h2>
        <table>
            <tr>
                <th>Sektor</th>
                <td>{{ $anggaran->sektor }}</td>
            </tr>
            <tr>
                <th>Komponen Kebutuhan</th>
                <td>{{ $anggaran->komponen_kebutuhan }}</td>
            </tr>
            <tr>
                <th>Kegiatan</th>
                <td>{{ $anggaran->kegiatan }}</td>
            </tr>
            <tr>
                <th>Lokasi</th>
                <td>{{ $anggaran->lokasi }}</td>
            </tr>
        </table>
        
        <h2>C. RINCIAN ANGGARAN</h2>
        <table>
            <tr>
                <th>Volume</th>
                <th>Satuan</th>
                <th>Harga Satuan (Rp)</th>
                <th>Total (Rp)</th>
            </tr>
            <tr>
                <td class="text-center">{{ number_format($anggaran->volume, 0) }}</td>
                <td>{{ $anggaran->satuan }}</td>
                <td class="text-right">{{ number_format($anggaran->harga_satuan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($anggaran->jumlah, 0, ',', '.') }}</td>
            </tr>
        </table>
        
        @if($anggaran->keterangan)
        <h2>D. KETERANGAN</h2>
        <p>{{ $anggaran->keterangan }}</p>
        @endif
        
        <div class="footer">
            <p>Tanggal: {{ date('d/m/Y') }}</p>
            <br><br><br>
            <p>____________________<br>Penyusun</p>
        </div>
    </div>
</body>
</html>
