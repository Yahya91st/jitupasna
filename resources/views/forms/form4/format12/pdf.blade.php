<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Perikanan - {{ $report->nama_kampung }}</title>
    <style>
        @page {
            size: landscape;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .header h2 {
            font-size: 14px;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #333;
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
        .info-table td, .info-table th {
            width: 25%;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .footer-sign {
            display: inline-block;
            width: 200px;
            text-align: center;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FORMULIR 04 - PENGUMPULAN DATA SEKTOR</h1>
        <h2>FORMAT 12: PENGUMPULAN DATA SEKTOR PERIKANAN</h2>
    </div>

    <table class="info-table">
        <tr>
            <th>Bencana</th>
            <td>{{ $bencana->kategori_bencana->nama }}</td>
            <th>Tanggal</th>
            <td>{{ $bencana->tanggal }}</td>
        </tr>
        <tr>
            <th>Kampung</th>
            <td>{{ $report->nama_kampung }}</td>
            <th>Distrik</th>
            <td>{{ $report->nama_distrik }}</td>
        </tr>
    </table>

    <h3>Data Kerusakan Sarana Budidaya Perikanan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Sarana</th>
                <th class="text-center">Jumlah Rusak (Unit)</th>
                <th class="text-center">Harga per Unit (Rp)</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Kolam Ikan</td>
                <td class="text-center">{{ $report->kolam_ikan_jumlah }}</td>
                <td class="text-right">{{ number_format($report->kolam_ikan_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getFishPondDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tambak</td>
                <td class="text-center">{{ $report->tambak_jumlah }}</td>
                <td class="text-right">{{ number_format($report->tambak_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getFishpond(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Keramba</td>
                <td class="text-center">{{ $report->keramba_jumlah }}</td>
                <td class="text-right">{{ number_format($report->keramba_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getCageDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Hatchery</td>
                <td class="text-center">{{ $report->hatchery_jumlah }}</td>
                <td class="text-right">{{ number_format($report->hatchery_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getHatcheryDamage(), 0, ',', '.') }}</td>
            </tr>
            @if($report->lainnya_jenis_sarana)
            <tr>
                <td>{{ $report->lainnya_jenis_sarana }}</td>
                <td class="text-center">{{ $report->lainnya_sarana_jumlah }}</td>
                <td class="text-right">{{ number_format($report->lainnya_sarana_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getOtherFacilitiesDamage(), 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerusakan Sarana Budidaya</td>
                <td class="text-right">{{ number_format($report->getTotalCultivationFacilitiesDamage(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerusakan Alat Penangkapan Ikan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Alat</th>
                <th class="text-center">Jumlah Rusak (Unit)</th>
                <th class="text-center">Harga per Unit (Rp)</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Perahu Bermotor</td>
                <td class="text-center">{{ $report->perahu_motor_jumlah }}</td>
                <td class="text-right">{{ number_format($report->perahu_motor_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getMotorboatDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Perahu Dayung</td>
                <td class="text-center">{{ $report->perahu_dayung_jumlah }}</td>
                <td class="text-right">{{ number_format($report->perahu_dayung_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getRowingBoatDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Jaring Insang</td>
                <td class="text-center">{{ $report->jaring_insang_jumlah }}</td>
                <td class="text-right">{{ number_format($report->jaring_insang_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getGillNetDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Jaring Purse Seine</td>
                <td class="text-center">{{ $report->jaring_purse_seine_jumlah }}</td>
                <td class="text-right">{{ number_format($report->jaring_purse_seine_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getPurseSeineNetDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Alat Penangkap Lainnya</td>
                <td class="text-center">{{ $report->alat_penangkap_lain_jumlah }}</td>
                <td class="text-right">{{ number_format($report->alat_penangkap_lain_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getOtherEquipmentDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerusakan Alat Penangkapan Ikan</td>
                <td class="text-right">{{ number_format($report->getTotalFishingEquipmentDamage(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Budidaya Ikan dan Perikanan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Ikan</th>
                <th class="text-center">Jumlah (kg)</th>
                <th class="text-center">Harga per kg (Rp)</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Ikan Lele</td>
                <td class="text-center">{{ $report->ikan_lele_jumlah }}</td>
                <td class="text-right">{{ number_format($report->ikan_lele_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getCatfishLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Ikan Nila</td>
                <td class="text-center">{{ $report->ikan_nila_jumlah }}</td>
                <td class="text-right">{{ number_format($report->ikan_nila_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getTilapiaLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Ikan Mas</td>
                <td class="text-center">{{ $report->ikan_mas_jumlah }}</td>
                <td class="text-right">{{ number_format($report->ikan_mas_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getGoldfishLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Udang</td>
                <td class="text-center">{{ $report->udang_jumlah }}</td>
                <td class="text-right">{{ number_format($report->udang_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getShrimpLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Bandeng</td>
                <td class="text-center">{{ $report->bandeng_jumlah }}</td>
                <td class="text-right">{{ number_format($report->bandeng_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getMilkfishLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Ikan Laut Lainnya</td>
                <td class="text-center">{{ $report->ikan_laut_jumlah }}</td>
                <td class="text-right">{{ number_format($report->ikan_laut_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getOtherSeaFishLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerugian Ikan</td>
                <td class="text-right">{{ number_format($report->getTotalFishLoss(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Gangguan Usaha</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Kerugian</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Gangguan Usaha Perikanan</td>
                <td>{{ $report->gangguan_usaha_hari }} hari @ Rp {{ number_format($report->pendapatan_per_hari, 0, ',', '.') }}/hari</td>
                <td class="text-right">{{ number_format($report->getBusinessInterruptionLoss(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Rekapitulasi Dampak Sektor Perikanan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 60%">Kategori</th>
                <th class="text-center">Nilai (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Kerusakan (Sarana Budidaya + Alat Penangkapan)</td>
                <td class="text-right">{{ number_format($report->getTotalDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kerugian (Ikan + Gangguan Usaha)</td>
                <td class="text-right">{{ number_format($report->getTotalLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td>TOTAL DAMPAK</td>
                <td class="text-right">{{ number_format($report->getTotalDamage() + $report->getTotalLoss(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>{{ $report->nama_distrik }}, {{ now()->format('d F Y') }}</p>
        <div class="footer-sign">
            <p>Petugas</p>
            <br><br><br>
            <p>___________________________</p>
            <p>NIP.</p>
        </div>
    </div>
</body>
</html>
