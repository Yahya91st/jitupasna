<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Perdagangan - {{ $report->nama_kampung }}</title>
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
        <h2>FORMAT 14: PENGUMPULAN DATA SEKTOR PERDAGANGAN</h2>
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

    <h3>Data Kerusakan Bangunan Perdagangan</h3>
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
                <td>Toko</td>
                <td class="text-center">{{ $report->toko_rb }}</td>
                <td class="text-center">{{ $report->toko_rs }}</td>
                <td class="text-center">{{ $report->toko_rr }}</td>
                <td class="text-center">{{ number_format($report->toko_luas, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->toko_harga_m2, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getShopDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Kios</td>
                <td class="text-center">{{ $report->kios_rb }}</td>
                <td class="text-center">{{ $report->kios_rs }}</td>
                <td class="text-center">{{ $report->kios_rr }}</td>
                <td class="text-center">{{ number_format($report->kios_luas, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->kios_harga_m2, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getKioskDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Pasar</td>
                <td class="text-center">{{ $report->pasar_rb }}</td>
                <td class="text-center">{{ $report->pasar_rs }}</td>
                <td class="text-center">{{ $report->pasar_rr }}</td>
                <td class="text-center">{{ number_format($report->pasar_luas, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->pasar_harga_m2, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getMarketDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Gudang</td>
                <td class="text-center">{{ $report->gudang_rb }}</td>
                <td class="text-center">{{ $report->gudang_rs }}</td>
                <td class="text-center">{{ $report->gudang_rr }}</td>
                <td class="text-center">{{ number_format($report->gudang_luas, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->gudang_harga_m2, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getWarehouseDamage(), 0, ',', '.') }}</td>
            </tr>
            @if($report->lainnya_jenis_bangunan)
            <tr>
                <td>{{ $report->lainnya_jenis_bangunan }}</td>
                <td class="text-center">{{ $report->lainnya_rb }}</td>
                <td class="text-center">{{ $report->lainnya_rs }}</td>
                <td class="text-center">{{ $report->lainnya_rr }}</td>
                <td class="text-center">{{ number_format($report->lainnya_luas, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->lainnya_harga_m2, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getOtherBuildingDamage(), 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="6">Total Kerusakan Bangunan</td>
                <td class="text-right">{{ number_format($report->getTotalBuildingDamage(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Barang Dagangan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Kerugian</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Barang Dagangan Rusak</td>
                <td class="text-right">{{ number_format($report->barang_dagangan_rusak, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Stok Barang Rusak</td>
                <td class="text-right">{{ number_format($report->stok_barang_rusak, 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td>Total Kerugian Barang</td>
                <td class="text-right">{{ number_format($report->getMerchandiseLoss(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Lainnya</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Kerugian</th>
                <th class="text-center">Rincian</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Gangguan Usaha</td>
                <td>{{ $report->gangguan_usaha_hari }} hari @ Rp {{ number_format($report->pendapatan_per_hari, 0, ',', '.') }}/hari</td>
                <td class="text-right">{{ number_format($report->getBusinessInterruptionLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td rowspan="2">Biaya Pembersihan</td>
                <td>Tenaga Kerja: {{ $report->biaya_tenaga_kerja_hok }} HOK @ Rp {{ number_format($report->biaya_tenaga_kerja_upah, 0, ',', '.') }}/HOK</td>
                <td class="text-right">{{ number_format($report->biaya_tenaga_kerja_hok * $report->biaya_tenaga_kerja_upah, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Alat Berat: {{ $report->biaya_alat_berat_hari }} hari @ Rp {{ number_format($report->biaya_alat_berat_sewa, 0, ',', '.') }}/hari</td>
                <td class="text-right">{{ number_format($report->biaya_alat_berat_hari * $report->biaya_alat_berat_sewa, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Relokasi</td>
                <td>{{ $report->relokasi_jumlah_bulan }} bulan @ Rp {{ number_format($report->relokasi_biaya_per_bulan, 0, ',', '.') }}/bulan</td>
                <td class="text-right">{{ number_format($report->getRelocationCosts(), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="2">Total Kerugian Lainnya</td>
                <td class="text-right">{{ number_format($report->getBusinessInterruptionLoss() + $report->getCleaningCosts() + $report->getRelocationCosts(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Rekapitulasi Dampak Sektor Perdagangan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 60%">Kategori</th>
                <th class="text-center">Nilai (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Kerusakan</td>
                <td class="text-right">{{ number_format($report->getTotalDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kerugian</td>
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
