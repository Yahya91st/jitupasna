<!DOCTYPE html>
<html>
<head>
    <title>Form 3 - Pendataan OPD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        h1 {
            font-size: 18px;
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 16px;
            margin-bottom: 10px;
            margin-top: 20px;
            background-color: #f2f2f2;
            padding: 5px;
        }
        h3 {
            font-size: 14px;
            margin-bottom: 5px;
        }
        .header-info {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>FORMULIR 3 - PENDATAAN KE OPD</h1>
    
    <div class="header-info">
        <p><strong>Bencana:</strong> {{  $form->bencana->kategori_bencana->nama }}</p>
        <p><strong>Tanggal Kejadian:</strong> {{  $form->bencana->tanggal }}</p>
        <p><strong>Lokasi:</strong> 
            @foreach( $form->bencana->desa as $desa)
                {{ $desa->nama }}@if(!$loop->last), @endif
            @endforeach
        </p>
    </div>
    
    <!-- 1. DATA DASAR SEBELUM BENCANA -->
    <h2>1. DATA DASAR SEBELUM BENCANA</h2>
    
    <h3>Wilayah Bencana</h3>
    <p>{{  $form->wilayah_bencana }}</p>
    
    <h3>Penduduk-Wilayah</h3>
    <table>
        <tr>
            <th>Jumlah Laki-laki</th>
            <th>Jumlah Perempuan</th>
            <th>Jumlah Rumah Tangga</th>
        </tr>
        <tr>
            <td>{{ number_format( $form->jumlah_laki_laki) }} orang</td>
            <td>{{ number_format( $form->jumlah_perempuan) }} orang</td>
            <td>{{ number_format( $form->jumlah_rumah_tangga) }} RT</td>
        </tr>
    </table>
    
    <h3>Kesehatan</h3>
    <table>
        <tr>
            <th>Kategori</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td>Rumah Sakit</td>
            <td>{{ number_format( $form->jumlah_rumah_sakit) }}</td>
        </tr>
        <tr>
            <td>PUSKESMAS</td>
            <td>{{ number_format( $form->jumlah_puskesmas) }}</td>
        </tr>
        <tr>
            <td>POSYANDU</td>
            <td>{{ number_format( $form->jumlah_posyandu) }}</td>
        </tr>
        <tr>
            <td>Dokter</td>
            <td>{{ number_format( $form->jumlah_dokter) }}</td>
        </tr>
        <tr>
            <td>Paramedis</td>
            <td>{{ number_format( $form->jumlah_paramedis) }}</td>
        </tr>
        <tr>
            <td>Bidan</td>
            <td>{{ number_format( $form->jumlah_bidan) }}</td>
        </tr>
        <tr>
            <td>Kunjungan PUSKESMAS</td>
            <td>{{ number_format( $form->jumlah_kunjungan_puskesmas) }}</td>
        </tr>
        <tr>
            <td>Balita</td>
            <td>{{ number_format( $form->jumlah_balita) }}</td>
        </tr>
        <tr>
            <td>Balita Gizi Buruk</td>
            <td>{{ number_format( $form->jumlah_balita_gizi_buruk) }}</td>
        </tr>
        <tr>
            <td>Balita Gizi Kurang</td>
            <td>{{ number_format( $form->jumlah_balita_gizi_kurang) }}</td>
        </tr>
        <tr>
            <td>Manula</td>
            <td>{{ number_format( $form->jumlah_manula) }}</td>
        </tr>
        <tr>
            <td>Penerima JPS Kesehatan</td>
            <td>{{ number_format( $form->jumlah_penerima_jps_kesehatan) }}</td>
        </tr>
        <tr>
            <td>Rumah dengan Air Bersih</td>
            <td>{{ number_format( $form->jumlah_rumah_air_bersih) }}</td>
        </tr>
        <tr>
            <td>Rumah dengan Jamban</td>
            <td>{{ number_format( $form->jumlah_rumah_jamban) }}</td>
        </tr>
    </table>
    
    <!-- Include other sections using similar formatting -->
    
    <h3>Ekonomi</h3>
    <table>
        <tr>
            <th>Kategori</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td>Pasar</td>
            <td>{{ number_format( $form->jumlah_pasar) }}</td>
        </tr>
        <tr>
            <td>Koperasi</td>
            <td>{{ number_format( $form->jumlah_koperasi) }}</td>
        </tr>
        <tr>
            <td>Tempat Wisata</td>
            <td>{{ number_format( $form->jumlah_tempat_wisata) }}</td>
        </tr>
    </table>
    
    <!-- 2. DATA SEKUNDER AKIBAT BENCANA -->
    <h2>2. DATA SEKUNDER AKIBAT BENCANA</h2>
    
    <h3>Sejarah Bencana di Masa Lalu</h3>
    <p>{{  $form->sejarah_bencana ?: 'Tidak ada data' }}</p>
    
    <h3>Kronologis Kejadian Bencana Saat Ini</h3>
    <p>{{  $form->kronologis_bencana ?: 'Tidak ada data' }}</p>
    
    <h3>Wilayah Terdampak</h3>
    <p>{{  $form->wilayah_terdampak ?: 'Tidak ada data' }}</p>
    
    <h3>Jumlah Korban</h3>
    <table>
        <tr>
            <th>Meninggal</th>
            <th>Luka-luka</th>
            <th>Mengungsi</th>
        </tr>
        <tr>
            <td>{{ number_format( $form->jumlah_korban_meninggal) }} orang</td>
            <td>{{ number_format( $form->jumlah_korban_luka) }} orang</td>
            <td>{{ number_format( $form->jumlah_korban_mengungsi) }} orang</td>
        </tr>
    </table>
    
    <h3>Kerusakan dan Kerugian</h3>
    <p>{{  $form->kerusakan_kerugian ?: 'Tidak ada data' }}</p>
    
    <!-- 3. DATA SEKUNDER AKIBAT BENCANA (KHUSUS) -->
    <h2>3. DATA SEKUNDER AKIBAT BENCANA (KHUSUS)</h2>
    
    <h3>Bidang Pertanian</h3>
    <table>
        <tr>
            <th>Aspek</th>
            <th>Keterangan</th>
        </tr>
        <tr>
            <td>Gangguan Ekonomi</td>
            <td>{{  $form->pertanian_gangguan_ekonomi ?: 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Produk Pertanian Terdampak</td>
            <td>{{  $form->pertanian_produk_terdampak ?: 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Pemulihan yang Dibutuhkan</td>
            <td>{{  $form->pertanian_pemulihan ?: 'Tidak ada data' }}</td>
        </tr>
    </table>
    
    <!-- Add remaining sections as needed -->
</body>
</html>
