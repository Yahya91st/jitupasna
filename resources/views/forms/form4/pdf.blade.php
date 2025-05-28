<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Perumahan - {{ $formPerumahan->nama_kampung }}</title>
    <style>
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
            font-weight: bold;
            margin-bottom: 5px;
        }
        .bencana-info {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
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
            font-weight: bold;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            background-color: #e0e0e0;
            padding: 5px;
        }
        .subsection-title {
            font-size: 13px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
        }
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .page-break {
            page-break-after: always;
        }
        .signature {
            margin-top: 50px;
            float: right;
            width: 40%;
            text-align: center;
        }
        .signature-line {
            margin-top: 50px;
            border-top: 1px solid #000;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN KERUSAKAN DAN KERUGIAN SEKTOR PERUMAHAN</h1>
        <p>Tanggal Laporan: {{ $tanggal }}</p>
    </div>

    <div class="bencana-info">
        <p><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama }}</p>
        <p><strong>Tanggal Kejadian:</strong> {{ $bencana->tanggal }}</p>
        <p><strong>Lokasi:</strong> 
            @foreach($bencana->desa as $desa)
                {{ $desa->nama }}@if(!$loop->last), @endif
            @endforeach
        </p>
        <p><strong>Kampung:</strong> {{ $formPerumahan->nama_kampung }}</p>
        <p><strong>Distrik:</strong> {{ $formPerumahan->nama_distrik }}</p>
    </div>

    <div class="section-title">I. PERKIRAAN KERUSAKAN</div>

    <div class="subsection-title">1. KERUSAKAN RUMAH</div>
    
    <!-- Tabel Kerusakan Rumah Permanen -->
    <table>
        <thead>
            <tr>
                <th colspan="5">Rumah Permanen (Harga Satuan: Rp {{ number_format($formPerumahan->harga_satuan_permanen, 2, ',', '.') }})</th>
            </tr>
            <tr>
                <th>Hancur Total</th>
                <th>Rusak Berat</th>
                <th>Rusak Sedang</th>
                <th>Rusak Ringan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $formPerumahan->rumah_hancur_total_permanen ?? 0 }}</td>
                <td>{{ $formPerumahan->rumah_rusak_berat_permanen ?? 0 }}</td>
                <td>{{ $formPerumahan->rumah_rusak_sedang_permanen ?? 0 }}</td>
                <td>{{ $formPerumahan->rumah_rusak_ringan_permanen ?? 0 }}</td>
                <td>{{ $totalRumahPermanen }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="4">Total Biaya</td>
                <td>Rp {{ number_format($biayaRumahPermanen, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Tabel Kerusakan Rumah Non-Permanen -->
    <table>
        <thead>
            <tr>
                <th colspan="5">Rumah Non-Permanen (Harga Satuan: Rp {{ number_format($formPerumahan->harga_satuan_non_permanen, 2, ',', '.') }})</th>
            </tr>
            <tr>
                <th>Hancur Total</th>
                <th>Rusak Berat</th>
                <th>Rusak Sedang</th>
                <th>Rusak Ringan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $formPerumahan->rumah_hancur_total_non_permanen ?? 0 }}</td>
                <td>{{ $formPerumahan->rumah_rusak_berat_non_permanen ?? 0 }}</td>
                <td>{{ $formPerumahan->rumah_rusak_sedang_non_permanen ?? 0 }}</td>
                <td>{{ $formPerumahan->rumah_rusak_ringan_non_permanen ?? 0 }}</td>
                <td>{{ $totalRumahNonPermanen }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="4">Total Biaya</td>
                <td>Rp {{ number_format($biayaRumahNonPermanen, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="subsection-title">2. KERUSAKAN JALAN</div>
    <!-- Tabel Kerusakan Jalan -->
    <table>
        <thead>
            <tr>
                <th colspan="4">Jalan (Harga Satuan: Rp {{ number_format($formPerumahan->harga_satuan_jalan, 2, ',', '.') }})</th>
            </tr>
            <tr>
                <th>Rusak Berat</th>
                <th>Rusak Sedang</th>
                <th>Rusak Ringan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $formPerumahan->jalan_rusak_berat ?? 0 }} m²</td>
                <td>{{ $formPerumahan->jalan_rusak_sedang ?? 0 }} m²</td>
                <td>{{ $formPerumahan->jalan_rusak_ringan ?? 0 }} m²</td>
                <td>{{ $totalJalanRusak }} m²</td>
            </tr>
            <tr class="total-row">
                <td colspan="3">Total Biaya</td>
                <td>Rp {{ number_format($biayaJalan, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="subsection-title">3. KERUSAKAN SALURAN</div>
    <!-- Tabel Kerusakan Saluran -->
    <table>
        <thead>
            <tr>
                <th colspan="4">Saluran (Harga Satuan: Rp {{ number_format($formPerumahan->harga_satuan_saluran, 2, ',', '.') }})</th>
            </tr>
            <tr>
                <th>Rusak Berat</th>
                <th>Rusak Sedang</th>
                <th>Rusak Ringan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $formPerumahan->saluran_rusak_berat ?? 0 }} m</td>
                <td>{{ $formPerumahan->saluran_rusak_sedang ?? 0 }} m</td>
                <td>{{ $formPerumahan->saluran_rusak_ringan ?? 0 }} m</td>
                <td>{{ $totalSaluranRusak }} m</td>
            </tr>
            <tr class="total-row">
                <td colspan="3">Total Biaya</td>
                <td>Rp {{ number_format($biayaSaluran, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="subsection-title">4. KERUSAKAN BALAI</div>
    <!-- Tabel Kerusakan Balai -->
    <table>
        <thead>
            <tr>
                <th colspan="3">Balai (Harga Satuan: Rp {{ number_format($formPerumahan->harga_satuan_balai, 2, ',', '.') }})</th>
            </tr>
            <tr>
                <th>Rusak Berat</th>
                <th>Rusak Sedang</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $formPerumahan->balai_rusak_berat ?? 0 }}</td>
                <td>{{ $formPerumahan->balai_rusak_sedang ?? 0 }}</td>
                <td>{{ $totalBalaiRusak }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="2">Total Biaya</td>
                <td>Rp {{ number_format($biayaBalai, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">II. PERKIRAAN KERUGIAN</div>

    <!-- Tabel Perkiraan Kerugian -->
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tenaga Kerja (HOK)</td>
                <td>{{ $formPerumahan->tenaga_kerja_hok ?? 0 }}</td>
                <td>Rp {{ number_format($formPerumahan->upah_harian, 2, ',', '.') }}</td>
                <td>Rp {{ number_format($biayaHOK, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Alat Berat (Hari)</td>
                <td>{{ $formPerumahan->alat_berat_hari ?? 0 }}</td>
                <td>Rp {{ number_format($formPerumahan->biaya_per_hari, 2, ',', '.') }}</td>
                <td>Rp {{ number_format($biayaAlatBerat, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Sewa per Bulan</td>
                <td>-</td>
                <td>-</td>
                <td>Rp {{ number_format($formPerumahan->harga_sewa_per_bulan, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tenda</td>
                <td>{{ $formPerumahan->jumlah_tenda ?? 0 }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_tenda, 2, ',', '.') }}</td>
                <td>Rp {{ number_format($biayaTenda, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Barak</td>
                <td>{{ $formPerumahan->jumlah_barak ?? 0 }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_barak, 2, ',', '.') }}</td>
                <td>Rp {{ number_format($biayaBarak, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Rumah Sementara</td>
                <td>{{ $formPerumahan->jumlah_rumah_sementara ?? 0 }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_rumah_sementara, 2, ',', '.') }}</td>
                <td>Rp {{ number_format($biayaRumahSementara, 2, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="3">Total Kerugian</td>
                <td>Rp {{ number_format($totalBiayaKerugian, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">III. TOTAL KERUSAKAN DAN KERUGIAN</div>
    <table>
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Kerusakan</td>
                <td>Rp {{ number_format($totalBiayaKerusakan, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kerugian</td>
                <td>Rp {{ number_format($totalBiayaKerugian, 2, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>Total Keseluruhan</td>
                <td>Rp {{ number_format($totalKeseluruhanBiaya, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <div class="signature">
            <p>{{ $formPerumahan->nama_distrik }}, {{ $tanggal }}</p>
            <p>Petugas,</p>
            <div class="signature-line"></div>
            <p>________________________</p>
            <p>NIP.</p>
        </div>
    </div>

</body>
</html>
