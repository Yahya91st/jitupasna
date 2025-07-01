<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Peternakan - {{ $report->nama_kampung }}</title>
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
        <h2>FORMAT 11: PENGUMPULAN DATA SEKTOR PETERNAKAN</h2>
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

    <h3>Data Kerusakan Bangunan Peternakan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" rowspan="2">Jenis Bangunan</th>
                <th class="text-center" colspan="3">Jumlah (Unit)</th>
                <th class="text-center" rowspan="2">Luas per Unit (m²)</th>
                <th class="text-center" rowspan="2">Harga per m² (Rp)</th>
                <th class="text-center" rowspan="2">Nilai Kerusakan (Rp)</th>
            </tr>
            <tr>
                <th class="text-center">Rusak Berat</th>
                <th class="text-center">Rusak Sedang</th>
                <th class="text-center">Rusak Ringan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Kandang</td>
                <td class="text-center">{{ $report->kandang_rb }}</td>
                <td class="text-center">{{ $report->kandang_rs }}</td>
                <td class="text-center">{{ $report->kandang_rr }}</td>
                <td class="text-center">{{ number_format($report->kandang_luas, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->kandang_harga_m2, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getShelterDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Gudang Pakan</td>
                <td class="text-center">{{ $report->gudang_pakan_rb }}</td>
                <td class="text-center">{{ $report->gudang_pakan_rs }}</td>
                <td class="text-center">{{ $report->gudang_pakan_rr }}</td>
                <td class="text-center">{{ number_format($report->gudang_pakan_luas, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->gudang_pakan_harga_m2, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getFeedWarehouseDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Balai Inseminasi</td>
                <td class="text-center">{{ $report->balai_inseminasi_rb }}</td>
                <td class="text-center">{{ $report->balai_inseminasi_rs }}</td>
                <td class="text-center">{{ $report->balai_inseminasi_rr }}</td>
                <td class="text-center">{{ number_format($report->balai_inseminasi_luas, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->balai_inseminasi_harga_m2, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getInseminationCenterDamage(), 0, ',', '.') }}</td>
            </tr>
            @if($report->lainnya_jenis_bangunan)
            <tr>
                <td>{{ $report->lainnya_jenis_bangunan }}</td>
                <td class="text-center">{{ $report->lainnya_bangunan_rb }}</td>
                <td class="text-center">{{ $report->lainnya_bangunan_rs }}</td>
                <td class="text-center">{{ $report->lainnya_bangunan_rr }}</td>
                <td class="text-center">{{ number_format($report->lainnya_bangunan_luas, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->lainnya_bangunan_harga_m2, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getOtherBuildingDamage(), 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="6">Total Kerusakan Bangunan</td>
                <td class="text-right">{{ number_format($report->getTotalBuildingDamage(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerusakan Peralatan Peternakan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Peralatan</th>
                <th class="text-center">Jumlah Rusak (Unit)</th>
                <th class="text-center">Harga per Unit (Rp)</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mesin Pencacah Pakan</td>
                <td class="text-center">{{ $report->mesin_pencacah_jumlah }}</td>
                <td class="text-right">{{ number_format($report->mesin_pencacah_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getChoppingMachineDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Mesin Pembuat Pakan</td>
                <td class="text-center">{{ $report->mesin_pakan_jumlah }}</td>
                <td class="text-right">{{ number_format($report->mesin_pakan_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getFeedMachineDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Alat Penampung Susu</td>
                <td class="text-center">{{ $report->alat_penampung_susu_jumlah }}</td>
                <td class="text-right">{{ number_format($report->alat_penampung_susu_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getMilkStorageDamage(), 0, ',', '.') }}</td>
            </tr>
            @if($report->lainnya_jenis_peralatan)
            <tr>
                <td>{{ $report->lainnya_jenis_peralatan }}</td>
                <td class="text-center">{{ $report->lainnya_peralatan_jumlah }}</td>
                <td class="text-right">{{ number_format($report->lainnya_peralatan_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getOtherEquipmentDamage(), 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerusakan Peralatan</td>
                <td class="text-right">{{ number_format($report->getTotalEquipmentDamage(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Ternak</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Ternak</th>
                <th class="text-center">Jumlah (Ekor)</th>
                <th class="text-center">Harga per Ekor (Rp)</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sapi</td>
                <td class="text-center">{{ $report->sapi_jumlah }}</td>
                <td class="text-right">{{ number_format($report->sapi_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getCattleLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Kambing</td>
                <td class="text-center">{{ $report->kambing_jumlah }}</td>
                <td class="text-right">{{ number_format($report->kambing_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getGoatLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Ayam</td>
                <td class="text-center">{{ $report->ayam_jumlah }}</td>
                <td class="text-right">{{ number_format($report->ayam_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getChickenLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Bebek</td>
                <td class="text-center">{{ $report->bebek_jumlah }}</td>
                <td class="text-right">{{ number_format($report->bebek_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getDuckLoss(), 0, ',', '.') }}</td>
            </tr>
            @if($report->lainnya_jenis_ternak)
            <tr>
                <td>{{ $report->lainnya_jenis_ternak }}</td>
                <td class="text-center">{{ $report->lainnya_ternak_jumlah }}</td>
                <td class="text-right">{{ number_format($report->lainnya_ternak_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getOtherLivestockLoss(), 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerugian Ternak</td>
                <td class="text-right">{{ number_format($report->getTotalLivestockLoss(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Lainnya</h3>
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
                <td>Kerugian Pakan</td>
                <td>{{ number_format($report->pakan_jumlah_ton, 2, ',', '.') }} ton @ Rp {{ number_format($report->pakan_harga_per_ton, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getFeedLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Gangguan Usaha</td>
                <td>{{ $report->gangguan_usaha_hari }} hari @ Rp {{ number_format($report->pendapatan_per_hari, 0, ',', '.') }}/hari</td>
                <td class="text-right">{{ number_format($report->getBusinessInterruptionLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="2">Total Kerugian Lainnya</td>
                <td class="text-right">{{ number_format($report->getFeedLoss() + $report->getBusinessInterruptionLoss(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Rekapitulasi Dampak Sektor Peternakan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 60%">Kategori</th>
                <th class="text-center">Nilai (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Kerusakan (Bangunan + Peralatan)</td>
                <td class="text-right">{{ number_format($report->getTotalDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kerugian (Ternak + Pakan + Gangguan Usaha)</td>
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
