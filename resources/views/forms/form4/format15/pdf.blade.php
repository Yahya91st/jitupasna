<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Pariwisata - {{ $report->nama_kampung }}</title>
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
        <h2>FORMAT 15: PENGUMPULAN DATA SEKTOR PARIWISATA</h2>
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

    <h3>Data Kerusakan Bangunan Sektor Pariwisata</h3>
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
                <td>Hotel/Penginapan</td>
                <td class="text-center">{{ $report->hotel_rb }}</td>
                <td class="text-center">{{ $report->hotel_rs }}</td>
                <td class="text-center">{{ $report->hotel_rr }}</td>
                <td class="text-center">{{ number_format($report->hotel_luas, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->hotel_harga_m2, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getHotelDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Restoran/Rumah Makan</td>
                <td class="text-center">{{ $report->restoran_rb }}</td>
                <td class="text-center">{{ $report->restoran_rs }}</td>
                <td class="text-center">{{ $report->restoran_rr }}</td>
                <td class="text-center">{{ number_format($report->restoran_luas, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->restoran_harga_m2, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getRestaurantDamage(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Objek Wisata</td>
                <td class="text-center">{{ $report->objek_wisata_rb }}</td>
                <td class="text-center">{{ $report->objek_wisata_rs }}</td>
                <td class="text-center">{{ $report->objek_wisata_rr }}</td>
                <td class="text-center">{{ number_format($report->objek_wisata_luas, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->objek_wisata_harga_m2, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->getTouristAttractionDamage(), 0, ',', '.') }}</td>
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

    <h3>Data Kerusakan Peralatan Pariwisata</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Peralatan</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Peralatan Hotel/Penginapan</td>
                <td class="text-right">{{ number_format($report->peralatan_hotel_nilai, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Peralatan Restoran/Rumah Makan</td>
                <td class="text-right">{{ number_format($report->peralatan_restoran_nilai, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Peralatan Objek Wisata</td>
                <td class="text-right">{{ number_format($report->peralatan_objek_wisata_nilai, 0, ',', '.') }}</td>
            </tr>
            @if($report->lainnya_jenis_peralatan)
            <tr>
                <td>{{ $report->lainnya_jenis_peralatan }}</td>
                <td class="text-right">{{ number_format($report->lainnya_peralatan_nilai, 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td>Total Kerusakan Peralatan</td>
                <td class="text-right">{{ number_format($report->getTotalEquipmentDamage(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Gangguan Usaha</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Usaha</th>
                <th class="text-center" colspan="3">Parameter</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="3">Hotel/Penginapan</td>
                <td>Jumlah Kamar: {{ $report->hotel_jumlah_kamar }}</td>
                <td>Tarif: Rp {{ number_format($report->hotel_tarif_per_kamar, 0, ',', '.') }}/kamar</td>
                <td>Durasi: {{ $report->hotel_durasi_hari }} hari</td>
                <td class="text-right" rowspan="3">{{ number_format($report->getHotelBusinessInterruptionLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3">Okupansi: {{ $report->hotel_okupansi }}%</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td rowspan="2">Restoran/Rumah Makan</td>
                <td>Pengunjung/hari: {{ $report->restoran_jumlah_pengunjung_per_hari }}</td>
                <td>Pengeluaran/pengunjung: Rp {{ number_format($report->restoran_pengeluaran_rata_per_pengunjung, 0, ',', '.') }}</td>
                <td>Durasi: {{ $report->restoran_durasi_hari }} hari</td>
                <td class="text-right" rowspan="2">{{ number_format($report->getRestaurantBusinessInterruptionLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td rowspan="2">Objek Wisata</td>
                <td>Pengunjung/hari: {{ $report->objek_wisata_jumlah_pengunjung_per_hari }}</td>
                <td>Harga Tiket: Rp {{ number_format($report->objek_wisata_harga_tiket, 0, ',', '.') }}</td>
                <td>Durasi: {{ $report->objek_wisata_durasi_hari }} hari</td>
                <td class="text-right" rowspan="2">{{ number_format($report->getTouristAttractionBusinessInterruptionLoss(), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="4">Total Kerugian Gangguan Usaha</td>
                <td class="text-right">{{ number_format($report->getTotalBusinessInterruptionLoss(), 0, ',', '.') }}</td>
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
                <td rowspan="2">Biaya Pembersihan</td>
                <td>Tenaga Kerja: {{ $report->biaya_tenaga_kerja_hok }} HOK @ Rp {{ number_format($report->biaya_tenaga_kerja_upah, 0, ',', '.') }}/HOK</td>
                <td class="text-right">{{ number_format($report->biaya_tenaga_kerja_hok * $report->biaya_tenaga_kerja_upah, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Alat Berat: {{ $report->biaya_alat_berat_hari }} hari @ Rp {{ number_format($report->biaya_alat_berat_sewa, 0, ',', '.') }}/hari</td>
                <td class="text-right">{{ number_format($report->biaya_alat_berat_hari * $report->biaya_alat_berat_sewa, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Promosi Pemulihan</td>
                <td>Promosi untuk menarik kembali wisatawan</td>
                <td class="text-right">{{ number_format($report->biaya_promosi_pemulihan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="2">Total Kerugian Lainnya</td>
                <td class="text-right">{{ number_format($report->getCleaningCosts() + $report->getPromotionCosts(), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Rekapitulasi Dampak Sektor Pariwisata</h3>
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
                <td>Total Kerugian (Gangguan Usaha + Pembersihan + Promosi)</td>
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
