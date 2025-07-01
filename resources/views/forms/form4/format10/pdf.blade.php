<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Pertanian - {{ $report->nama_kampung }}</title>
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
        }        .info-table td, .info-table th {
            width: 25%;
        }
        .footer {
            margin-top: 30px;
            page-break-inside: avoid;
        }        .footer-sign {
            float: right;
            text-align: center;
            width: 200px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FORMAT 10: LAPORAN KERUSAKAN DAN KERUGIAN SEKTOR PERTANIAN AKIBAT BENCANA</h1>
        <h2>{{ strtoupper($bencana->nama_bencana) }} DI {{ strtoupper($report->nama_kampung) }}, {{ strtoupper($report->nama_distrik) }}</h2>
    </div>

    <table class="info-table">
        <tr>
            <th>Nama Bencana</th>
            <td>{{ $bencana->nama_bencana }}</td>
            <th>Tanggal Kejadian</th>
            <td>{{ date('d-m-Y', strtotime($bencana->tanggal_kejadian)) }}</td>
        </tr>
        <tr>
            <th>Lokasi</th>
            <td>{{ $report->nama_kampung }}, {{ $report->nama_distrik }}</td>
            <th>Tanggal Laporan</th>
            <td>{{ $tanggal }}</td>
        </tr>
    </table>

    <h3>Data Kerusakan Tanaman</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Tanaman</th>
                <th class="text-center">Luas Terdampak (Ha)</th>
                <th class="text-center">Biaya Kerusakan Per Ha (Rp)</th>
                <th class="text-center">Lama Tanam (Bulan)</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Padi</td>
                <td class="text-center">{{ number_format($report->padi_luas_rusak, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->padi_harga_per_ha, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->padi_lama_tanam }}</td>
                <td class="text-right">{{ number_format($report->getRiceDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Jagung</td>
                <td class="text-center">{{ number_format($report->jagung_luas_rusak, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->jagung_harga_per_ha, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->jagung_lama_tanam }}</td>
                <td class="text-right">{{ number_format($report->getCornDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Kedelai</td>
                <td class="text-center">{{ number_format($report->kedelai_luas_rusak, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->kedelai_harga_per_ha, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->kedelai_lama_tanam }}</td>
                <td class="text-right">{{ number_format($report->getSoybeanDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Sayuran</td>
                <td class="text-center">{{ number_format($report->sayuran_luas_rusak, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->sayuran_harga_per_ha, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->sayuran_lama_tanam }}</td>
                <td class="text-right">{{ number_format($report->getVegetableDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Buah-buahan</td>
                <td class="text-center">{{ number_format($report->buah_luas_rusak, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->buah_harga_per_ha, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->buah_lama_tanam }}</td>
                <td class="text-right">{{ number_format($report->getFruitDamage(), 0, ',', '.') }}</td>
            </tr>
            @if($report->lainnya_jenis)
            <tr>
                <td>{{ $report->lainnya_jenis }}</td>
                <td class="text-center">{{ number_format($report->lainnya_luas_rusak, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->lainnya_harga_per_ha, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->lainnya_lama_tanam }}</td>
                <td class="text-right">{{ number_format($report->getOtherCropDamage(), 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="4">Total Kerusakan Tanaman</td>
                <td class="text-right">{{ number_format($report->getTotalCropDamage(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerusakan Infrastruktur Pertanian</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Infrastruktur</th>
                <th class="text-center">Jumlah Rusak</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Biaya Per Unit (Rp)</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Saluran Irigasi</td>
                <td class="text-center">{{ number_format($report->irigasi_panjang_rusak, 0, ',', '.') }}</td>
                <td class="text-center">meter</td>
                <td class="text-right">{{ number_format($report->irigasi_harga_per_meter, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getIrrigationDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Traktor/Mesin Pengolah Tanah</td>
                <td class="text-center">{{ $report->traktor_jumlah_rusak }}</td>
                <td class="text-center">unit</td>
                <td class="text-right">{{ number_format($report->traktor_harga_per_unit, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getTractorDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Pompa Air</td>
                <td class="text-center">{{ $report->pompa_jumlah_rusak }}</td>
                <td class="text-center">unit</td>
                <td class="text-right">{{ number_format($report->pompa_harga_per_unit, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getPumpDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Alat Penanam</td>
                <td class="text-center">{{ $report->alat_tanam_jumlah_rusak }}</td>
                <td class="text-center">unit</td>
                <td class="text-right">{{ number_format($report->alat_tanam_harga_per_unit, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getPlantingEquipmentDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Gudang Penyimpanan</td>
                <td class="text-center">{{ $report->gudang_jumlah_rusak }} ({{ number_format($report->gudang_luas_per_unit, 0, ',', '.') }} m²)</td>
                <td class="text-center">unit</td>
                <td class="text-right">{{ number_format($report->gudang_harga_per_m2, 0, ',', '.') }}/m²</td>
                <td class="text-right">{{ number_format($report->getWarehouseDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="4">Total Kerusakan Infrastruktur</td>
                <td class="text-right">{{ number_format($report->getTotalInfrastructureDamage(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Akibat Bencana</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Kerugian</th>
                <th class="text-center">Parameter 1</th>
                <th class="text-center">Parameter 2</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Pembersihan Lahan</td>
                <td>{{ number_format($report->luas_lahan_dibersihkan, 2, ',', '.') }} Ha</td>
                <td>Rp {{ number_format($report->biaya_pembersihan_per_ha, 0, ',', '.') }}/Ha</td>
                <td class="text-right">{{ number_format($report->getCleaningCosts(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Penurunan Hasil Panen</td>
                <td>{{ number_format($report->luas_panen_terdampak, 2, ',', '.') }} Ha</td>
                <td>Penurunan {{ number_format($report->produksi_normal_per_ha - $report->produksi_pasca_bencana_per_ha, 2, ',', '.') }} ton/Ha</td>
                <td class="text-right">{{ number_format($report->getProductionLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Tambahan Produksi</td>
                <td>{{ number_format($report->luas_lahan_terdampak, 2, ',', '.') }} Ha</td>
                <td>Rp {{ number_format($report->tambahan_biaya_per_ha, 0, ',', '.') }}/Ha</td>
                <td class="text-right">{{ number_format($report->getAdditionalProductionCosts(), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerugian Akibat Bencana</td>
                <td class="text-right">{{ number_format($report->getTotalLoss(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Rekapitulasi Dampak Sektor Pertanian</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 60%">Kategori</th>
                <th class="text-center">Nilai (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Kerusakan (Tanaman + Infrastruktur)</td>
                <td class="text-right">{{ number_format($report->getTotalDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kerugian (Pembersihan + Produksi + Biaya Tambahan)</td>
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
