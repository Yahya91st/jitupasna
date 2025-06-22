<!DOCTYPE html>
<html>
<head>
    <title>Rekapitulasi Kebutuhan Pascabencana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2cm;
            font-size: 12pt;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            padding: 0;
        }
        .header p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        table, th, td {
            border: 1px solid #000;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            font-weight: bold;
        }
        .bg-danger {
            background-color: #dc3545;
        }
        .bg-warning {
            background-color: #ffc107;
            color: #000;
        }
        .bg-info {
            background-color: #17a2b8;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col {
            flex-basis: 0;
            flex-grow: 1;
            max-width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .footer p {
            margin: 5px 0;
        }
        .page-break {
            page-break-after: always;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .font-bold {
            font-weight: bold;
        }
        .info-box {
            background-color: #e9f5fb;
            border: 1px solid #6cb2eb;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>FORMULIR 11 - REKAPITULASI KEBUTUHAN PASCABENCANA (PDNA)</h2>
        <p>{{ $rekapitulasi->bencana->kategori_bencana->nama }} - {{ $rekapitulasi->bencana->tanggal }}</p>
    </div>
    
    <div class="info-box">
        <h3>Informasi Bencana</h3>
        <table border="0" style="border: none;">
            <tr style="border: none;">
                <td style="border: none; width: 150px;"><strong>Nama Bencana</strong></td>
                <td style="border: none;">: {{ $rekapitulasi->bencana->kategori_bencana->nama }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;"><strong>Referensi</strong></td>
                <td style="border: none;">: {{ $rekapitulasi->bencana->Ref }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;"><strong>Tanggal</strong></td>
                <td style="border: none;">: {{ $rekapitulasi->bencana->tanggal }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;"><strong>Lokasi</strong></td>
                <td style="border: none;">: 
                    @foreach($rekapitulasi->bencana->desa as $desa)
                        {{ $desa->nama }}@if(!$loop->last), @endif
                    @endforeach
                </td>
            </tr>
        </table>
    </div>

    <h3>Detail Rekapitulasi Kebutuhan</h3>
    
    <table>
        <tr>
            <th width="30%">Sektor</th>
            <td>{{ $rekapitulasi->sektor }}</td>
        </tr>
        <tr>
            <th>Sub Sektor</th>
            <td>{{ $rekapitulasi->sub_sektor }}</td>
        </tr>
        <tr>
            <th>Lokasi</th>
            <td>{{ $rekapitulasi->lokasi }}</td>
        </tr>
        <tr>
            <th>Jenis Kebutuhan</th>
            <td>{{ $rekapitulasi->jenis_kebutuhan }}</td>
        </tr>
        <tr>
            <th>Rincian Kebutuhan</th>
            <td>{{ $rekapitulasi->rincian_kebutuhan }}</td>
        </tr>
        <tr>
            <th>Jumlah Unit</th>
            <td>{{ number_format($rekapitulasi->jumlah_unit, 2) }} {{ $rekapitulasi->satuan }}</td>
        </tr>
        <tr>
            <th>Harga Satuan</th>
            <td>Rp {{ number_format($rekapitulasi->harga_satuan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Kebutuhan</th>
            <td class="font-bold">Rp {{ number_format($rekapitulasi->total_kebutuhan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Prioritas</th>
            <td>{{ $rekapitulasi->prioritas }}</td>
        </tr>
        <tr>
            <th>Durasi Penyelesaian</th>
            <td>{{ $rekapitulasi->durasi_penyelesaian }}</td>
        </tr>
        <tr>
            <th>Penanggung Jawab</th>
            <td>{{ $rekapitulasi->penanggung_jawab }}</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{{ $rekapitulasi->keterangan ?? '-' }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Tanggal Dibuat: {{ $rekapitulasi->created_at->format('d/m/Y H:i') }}</p>
        @if($rekapitulasi->updated_at != $rekapitulasi->created_at)
            <p>Terakhir Diperbarui: {{ $rekapitulasi->updated_at->format('d/m/Y H:i') }}</p>
        @endif
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>____________________________</p>
        <p>Tanda Tangan & Nama Jelas</p>
    </div>
</body>
</html>
