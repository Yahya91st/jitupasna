<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kuesioner Form 09 - {{ $form->nomor_kuesioner }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0 0;
        }
        .content {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FORMULIR 09 - KUESIONER DATA DAMPAK BENCANA</h1>
        <p>Nomor: {{ $form->nomor_kuesioner }}</p>
    </div>

    <div class="content">
        <div class="section">
            <div class="section-title">DATA BENCANA</div>
            <table>
                <tr>
                    <td width="30%"><strong>Jenis Bencana</strong></td>
                    <td width="70%">{{ $bencana->kategori_bencana->nama ?? 'Tidak ada data' }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Bencana</strong></td>
                    <td>{{ \Carbon\Carbon::parse($bencana->tanggal)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Lokasi</strong></td>
                    <td>
                        @if(isset($bencana->desa) && $bencana->desa->count() > 0)
                            @foreach($bencana->desa as $desa)
                                {{ $desa->nama }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            Tidak ada data
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">DATA KUESIONER</div>
            <table>
                <tr>
                    <td width="30%"><strong>Nomor Kuesioner</strong></td>
                    <td width="70%">{{ $form->nomor_kuesioner }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal</strong></td>
                    <td>{{ \Carbon\Carbon::parse($form->tanggal)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Kecamatan</strong></td>
                    <td>{{ $form->kecamatan }}</td>
                </tr>
                <tr>
                    <td><strong>Desa/Kelurahan</strong></td>
                    <td>{{ $form->desa_kelurahan }}</td>
                </tr>
                <tr>
                    <td><strong>Jenis Kelamin Responden</strong></td>
                    <td>{{ $form->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td><strong>Umur</strong></td>
                    <td>{{ $form->umur }}</td>
                </tr>
            </table>
        </div>

        @if(isset($form->dukungan_pangan_air) && is_array($form->dukungan_pangan_air))
        <div class="section">
            <div class="section-title">DUKUNGAN UNTUK PEMULIHAN PANGAN DAN AIR BERSIH</div>
            <ul>
                @foreach($form->dukungan_pangan_air as $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    </div>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d-m-Y H:i:s') }}</p>
        <p>Sistem Informasi JITUPASNA</p>
    </div>
</body>
</html>
