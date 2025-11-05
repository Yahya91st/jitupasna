<!DOCTYPE html>
<html>
<head>
    <title>Form 3 - Pendataan OPD</title>
    <style>
        @page {
            margin: 8mm;
            size: A4;
        }
        
        body {
            font-family: 'Times New Roman', serif;
            font-size: 8pt;
            line-height: 1.1;
            margin: 0;
            padding: 0;
            color: #000;
        }
        
        .document-header {
            text-align: center;
            margin-bottom: 8px;
            border-bottom: 1px solid #000;
            padding-bottom: 4px;
        }
        
        .document-title {
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0 0 2px 0;
            letter-spacing: 0.5px;
        }
        
        .document-subtitle {
            font-size: 9pt;
            font-weight: normal;
            margin: 0;
        }
        
        .header-info {
            margin-bottom: 8px;
            background-color: #f8f9fa;
            padding: 4px;
            border: 1px solid #ddd;
        }
        
        .header-info p {
            margin: 1px 0;
            font-size: 8pt;
        }
        
        .section-header {
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #e9ecef;
            padding: 4px;
            margin: 8px 0 4px 0;
            border: 1px solid #000;
            text-align: center;
        }
        
        .subsection-header {
            font-size: 8pt;
            font-weight: bold;
            margin: 4px 0 2px 0;
            padding: 3px;
            background-color: #f8f9fa;
            border-left: 2px solid #000;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 3px 0;
            font-size: 7pt;
        }
        
        table, th, td {
            border: 1px solid #000;
        }
        
        th {
            background-color: #e9ecef;
            font-weight: bold;
            text-align: center;
            padding: 3px 2px;
            font-size: 7pt;
        }
        
        td {
            padding: 2px;
            text-align: left;
            vertical-align: top;
        }
        
        .text-content {
            margin: 2px 0;
            padding: 3px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            font-size: 8pt;
            min-height: 15px;
        }
        
        .number-cell {
            text-align: right;
            padding-right: 6px;
        }
        
        @media print {
            body { 
                font-size: 7pt; 
                line-height: 1.05;
            }
            .document-header {
                margin-bottom: 6px;
                padding-bottom: 3px;
            }
            .section-header {
                margin: 6px 0 3px 0;
                padding: 3px;
            }
            .subsection-header {
                margin: 3px 0 1px 0;
                padding: 2px;
            }
            table {
                margin: 2px 0;
            }
            th, td {
                padding: 1px;
            }
        }
    </style>
</head>
<<body>
    <div class="document-header">
        <div class="document-title">Formulir 3 - Pendataan Ke OPD</div>
        <div class="document-subtitle">Data Dasar dan Sekunder Akibat Bencana</div>
    </div>
    
    <div class="header-info">
        <p><strong>Bencana:</strong> {{ $form->bencana->kategori_bencana->nama }}</p>
        <p><strong>Tanggal Kejadian:</strong> {{ $form->bencana->tanggal }}</p>
        <p><strong>Lokasi:</strong> 
            @foreach($form->bencana->desa as $desa)
                {{ $desa->nama }}@if(!$loop->last), @endif
            @endforeach
        </p>
    </div>
    
    <!-- 1. DATA DASAR SEBELUM BENCANA -->
    <div class="section-header">1. Data Dasar Sebelum Bencana</div>
    
    <div class="subsection-header">Wilayah Bencana</div>
    <div class="text-content">{{ $form->wilayah_bencana ?: 'Tidak ada data' }}</div>
    
    <div class="subsection-header">Penduduk-Wilayah</div>
    <table>
        <tr>
            <th>Jumlah Laki-laki</th>
            <th>Jumlah Perempuan</th>
            <th>Jumlah Rumah Tangga</th>
        </tr>
        <tr>
            <td class="number-cell">{{ number_format($form->jumlah_laki_laki) }} orang</td>
            <td class="number-cell">{{ number_format($form->jumlah_perempuan) }} orang</td>
            <td class="number-cell">{{ number_format($form->jumlah_rumah_tangga) }} RT</td>
        </tr>
    </table>
    
    <div class="subsection-header">Kesehatan</div>
    <table>
        <tr>
            <th>Kategori</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td>Rumah Sakit</td>
            <td class="number-cell">{{ number_format($form->jumlah_rumah_sakit) }}</td>
        </tr>
        <tr>
            <td>PUSKESMAS</td>
            <td class="number-cell">{{ number_format($form->jumlah_puskesmas) }}</td>
        </tr>
        <tr>
            <td>POSYANDU</td>
            <td class="number-cell">{{ number_format($form->jumlah_posyandu) }}</td>
        </tr>
        <tr>
            <td>Dokter</td>
            <td class="number-cell">{{ number_format($form->jumlah_dokter) }}</td>
        </tr>
        <tr>
            <td>Paramedis</td>
            <td class="number-cell">{{ number_format($form->jumlah_paramedis) }}</td>
        </tr>
        <tr>
            <td>Bidan</td>
            <td class="number-cell">{{ number_format($form->jumlah_bidan) }}</td>
        </tr>
        <tr>
            <td>Kunjungan PUSKESMAS</td>
            <td class="number-cell">{{ number_format($form->jumlah_kunjungan_puskesmas) }}</td>
        </tr>
        <tr>
            <td>Balita</td>
            <td class="number-cell">{{ number_format($form->jumlah_balita) }}</td>
        </tr>
        <tr>
            <td>Balita Gizi Buruk</td>
            <td class="number-cell">{{ number_format($form->jumlah_balita_gizi_buruk) }}</td>
        </tr>
        <tr>
            <td>Balita Gizi Kurang</td>
            <td class="number-cell">{{ number_format($form->jumlah_balita_gizi_kurang) }}</td>
        </tr>
        <tr>
            <td>Manula</td>
            <td class="number-cell">{{ number_format($form->jumlah_manula) }}</td>
        </tr>
        <tr>
            <td>Penerima JPS Kesehatan</td>
            <td class="number-cell">{{ number_format($form->jumlah_penerima_jps_kesehatan) }}</td>
        </tr>
        <tr>
            <td>Rumah dengan Air Bersih</td>
            <td class="number-cell">{{ number_format($form->jumlah_rumah_air_bersih) }}</td>
        </tr>
        <tr>
            <td>Rumah dengan Jamban</td>
            <td class="number-cell">{{ number_format($form->jumlah_rumah_jamban) }}</td>
        </tr>
    </table>
    
    <div class="subsection-header">Ekonomi</div>
    <table>
        <tr>
            <th>Kategori</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td>Pasar</td>
            <td class="number-cell">{{ number_format($form->jumlah_pasar) }}</td>
        </tr>
        <tr>
            <td>Koperasi</td>
            <td class="number-cell">{{ number_format($form->jumlah_koperasi) }}</td>
        </tr>
        <tr>
            <td>Tempat Wisata</td>
            <td class="number-cell">{{ number_format($form->jumlah_tempat_wisata) }}</td>
        </tr>
    </table>
    
    <!-- 2. DATA SEKUNDER AKIBAT BENCANA -->
    <div class="section-header">2. Data Sekunder Akibat Bencana</div>
    
    <div class="subsection-header">Sejarah Bencana di Masa Lalu</div>
    <div class="text-content">{{ $form->sejarah_bencana ?: 'Tidak ada data' }}</div>
    
    <div class="subsection-header">Kronologis Kejadian Bencana Saat Ini</div>
    <div class="text-content">{{ $form->kronologis_bencana ?: 'Tidak ada data' }}</div>
    
    <div class="subsection-header">Wilayah Terdampak</div>
    <div class="text-content">{{ $form->wilayah_terdampak ?: 'Tidak ada data' }}</div>
    
    <div class="subsection-header">Jumlah Korban</div>
    <table>
        <tr>
            <th>Meninggal</th>
            <th>Luka-luka</th>
            <th>Mengungsi</th>
        </tr>
        <tr>
            <td class="number-cell">{{ number_format($form->jumlah_korban_meninggal) }} orang</td>
            <td class="number-cell">{{ number_format($form->jumlah_korban_luka) }} orang</td>
            <td class="number-cell">{{ number_format($form->jumlah_korban_mengungsi) }} orang</td>
        </tr>
    </table>
    
    <div class="subsection-header">Kerusakan dan Kerugian</div>
    <div class="text-content">{{ $form->kerusakan_kerugian ?: 'Tidak ada data' }}</div>
    
    <!-- 3. DATA SEKUNDER AKIBAT BENCANA (KHUSUS) -->
    <div class="section-header">3. Data Sekunder Akibat Bencana (Khusus)</div>
    
    <div class="subsection-header">Bidang Pertanian</div>
    <table>
        <tr>
            <th>Aspek</th>
            <th>Keterangan</th>
        </tr>
        <tr>
            <td>Gangguan Ekonomi</td>
            <td>{{ $form->pertanian_gangguan_ekonomi ?: 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Produk Pertanian Terdampak</td>
            <td>{{ $form->pertanian_produk_terdampak ?: 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Pemulihan yang Dibutuhkan</td>
            <td>{{ $form->pertanian_pemulihan ?: 'Tidak ada data' }}</td>
        </tr>
    </table>
</body>
</html>
