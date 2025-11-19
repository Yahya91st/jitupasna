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
            <td class="number-cell">{{ number_format($form->penduduk_laki_laki ?: 0) }} orang</td>
            <td class="number-cell">{{ number_format($form->penduduk_perempuan ?: 0) }} orang</td>
            <td class="number-cell">{{ number_format($form->rumah_tangga ?: 0) }} RT</td>
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
            <td class="number-cell">{{ number_format($form->rumah_sakit ?: 0) }}</td>
        </tr>
        <tr>
            <td>PUSKESMAS</td>
            <td class="number-cell">{{ number_format($form->puskesmas ?: 0) }}</td>
        </tr>
        <tr>
            <td>POSYANDU</td>
            <td class="number-cell">{{ number_format($form->posyandu ?: 0) }}</td>
        </tr>
        <tr>
            <td>Dokter</td>
            <td class="number-cell">{{ number_format($form->dokter ?: 0) }}</td>
        </tr>
        <tr>
            <td>Paramedis</td>
            <td class="number-cell">{{ number_format($form->paramedis ?: 0) }}</td>
        </tr>
        <tr>
            <td>Bidan</td>
            <td class="number-cell">{{ number_format($form->bidan ?: 0) }}</td>
        </tr>
        <tr>
            <td>Kunjungan PUSKESMAS</td>
            <td class="number-cell">{{ number_format($form->kunjungan_puskesmas ?: 0) }}</td>
        </tr>
        <tr>
            <td>Balita</td>
            <td class="number-cell">{{ number_format($form->balita ?: 0) }}</td>
        </tr>
        <tr>
            <td>Balita Gizi Buruk</td>
            <td class="number-cell">{{ number_format($form->balita_gizi_buruk ?: 0) }}</td>
        </tr>
        <tr>
            <td>Balita Gizi Kurang</td>
            <td class="number-cell">{{ number_format($form->balita_gizi_kurang ?: 0) }}</td>
        </tr>
        <tr>
            <td>Manula</td>
            <td class="number-cell">{{ number_format($form->manula ?: 0) }}</td>
        </tr>
        <tr>
            <td>Penerima JPS Kesehatan</td>
            <td class="number-cell">{{ number_format($form->penerima_jps_kesehatan ?: 0) }}</td>
        </tr>
        <tr>
            <td>Rumah dengan Air Bersih</td>
            <td class="number-cell">{{ number_format($form->rumah_air_bersih ?: 0) }}</td>
        </tr>
        <tr>
            <td>Rumah dengan Jamban</td>
            <td class="number-cell">{{ number_format($form->rumah_jamban ?: 0) }}</td>
        </tr>
        <tr>
            <td>Puskesmas Pembantu</td>
            <td class="number-cell">{{ number_format($form->puskesmas_pembantu ?: 0) }}</td>
        </tr>
        <tr>
            <td>Polindes</td>
            <td class="number-cell">{{ number_format($form->polindes ?: 0) }}</td>
        </tr>
        <tr>
            <td>Kader Kesehatan</td>
            <td class="number-cell">{{ number_format($form->kader_kesehatan ?: 0) }}</td>
        </tr>
        <tr>
            <td>Ditimbang Posyandu</td>
            <td class="number-cell">{{ number_format($form->ditimbang_posyandu ?: 0) }}</td>
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
            <td class="number-cell">{{ number_format($form->pasar ?: 0) }}</td>
        </tr>
        <tr>
            <td>Koperasi</td>
            <td class="number-cell">{{ number_format($form->koperasi ?: 0) }}</td>
        </tr>
        <tr>
            <td>Tempat Wisata</td>
            <td class="number-cell">{{ number_format($form->tempat_wisata ?: 0) }}</td>
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
            <td class="number-cell">{{ number_format($form->korban_meninggal ?: 0) }} orang</td>
            <td class="number-cell">{{ number_format($form->korban_luka ?: 0) }} orang</td>
            <td class="number-cell">{{ number_format($form->korban_mengungsi ?: 0) }} orang</td>
        </tr>
    </table>
    
    <div class="subsection-header">Kerusakan dan Kerugian</div>
    <div class="text-content">{{ $form->kerusakan_kerugian ?: 'Tidak ada data' }}</div>
    
    <!-- 3. DATA SEKUNDER AKIBAT BENCANA (KHUSUS) -->
    <div class="section-header">3. Data Sekunder Akibat Bencana (Khusus)</div>
    
    <div class="subsection-header">FGD (Focus Group Discussion)</div>
    <table>
        <tr>
            <th>Aspek</th>
            <th>Keterangan</th>
        </tr>
        <tr>
            <td>Tanggal FGD</td>
            <td>{{ $form->tanggal_fgd ? $form->tanggal_fgd->format('d F Y') : 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Waktu Mulai</td>
            <td>{{ $form->waktu_mulai ? $form->waktu_mulai->format('H:i') : 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Waktu Selesai</td>
            <td>{{ $form->waktu_selesai ? $form->waktu_selesai->format('H:i') : 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Lokasi FGD</td>
            <td>{{ $form->lokasi_fgd ?: 'Tidak ada data' }}</td>
        </tr>
    </table>
    
    <div class="subsection-header">Program Kesehatan</div>
    <table>
        <tr>
            <th>Program/Masalah</th>
            <th>Keterangan</th>
        </tr>
        <tr>
            <td>Program Kesehatan Masal</td>
            <td>{{ $form->program_kesehatan_masal ?: 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Permasalahan Kesehatan</td>
            <td>{{ $form->permasalahan_kesehatan ?: 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Kegiatan Permasalahan Kesehatan</td>
            <td>{{ $form->kegiatan_permasalahan_kesehatan ?: 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Program Makanan Tambahan</td>
            <td>{{ $form->program_makanan_tambahan ?: 'Tidak ada data' }}</td>
        </tr>
    </table>
    
    <div class="subsection-header">Dampak pada Kelompok Khusus</div>
    <table>
        <tr>
            <th>Kelompok</th>
            <th>Jumlah Terdampak</th>
            <th>Dampak</th>
            <th>Kegiatan</th>
        </tr>
        <tr>
            <td>Balita</td>
            <td class="number-cell">{{ number_format($form->jumlah_balita_terdampak ?: 0) }}</td>
            <td>{{ $form->dampak_balita ?: 'Tidak ada data' }}</td>
            <td>{{ $form->kegiatan_balita ?: 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Ibu Hamil</td>
            <td class="number-cell">{{ number_format($form->jumlah_ibu_hamil_terdampak ?: 0) }}</td>
            <td>{{ $form->dampak_ibu_hamil ?: 'Tidak ada data' }}</td>
            <td>{{ $form->kegiatan_ibu_hamil ?: 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Lansia</td>
            <td class="number-cell">{{ number_format($form->jumlah_lansia_terdampak ?: 0) }}</td>
            <td>{{ $form->dampak_lansia ?: 'Tidak ada data' }}</td>
            <td>{{ $form->kegiatan_lansia ?: 'Tidak ada data' }}</td>
        </tr>
    </table>
    
    <div class="subsection-header">Dampak Kesehatan Jangka Menengah</div>
    <div class="text-content">{{ $form->dampak_kesehatan_menengah ?: 'Tidak ada data' }}</div>
    
    <div class="subsection-header">Kegiatan Dampak Kesehatan</div>
    <div class="text-content">{{ $form->kegiatan_dampak_kesehatan ?: 'Tidak ada data' }}</div>
    
    <div class="subsection-header">Rencana Kontingensi Kesehatan</div>
    <div class="text-content">{{ $form->rencana_kontingensi_kesehatan ?: 'Tidak ada data' }}</div>
    
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
    
    <!-- 4. DATA OPD -->
    <div class="section-header">4. Data OPD dan Penanggung Jawab</div>
    
    <div class="subsection-header">Informasi OPD</div>
    <table>
        <tr>
            <th>Aspek</th>
            <th>Keterangan</th>
        </tr>
        <tr>
            <td>Nama OPD</td>
            <td>{{ $form->nama_opd ?: 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Penanggung Jawab</td>
            <td>{{ $form->penanggung_jawab ?: 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Kontak</td>
            <td>{{ $form->kontak_opd ?: 'Tidak ada data' }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $form->email_opd ?: 'Tidak ada data' }}</td>
        </tr>
    </table>
    
    <div class="subsection-header">Catatan dan Keterangan Tambahan</div>
    <div class="text-content">{{ $form->catatan_tambahan ?: 'Tidak ada catatan tambahan' }}</div>
    
    <div style="margin-top: 20px; border-top: 1px solid #000; padding-top: 10px; font-size: 8pt; color: #666;">
        <p><strong>Tanggal Pengisian:</strong> {{ $form->created_at ? $form->created_at->format('d F Y H:i') : 'Tidak tersedia' }}</p>
        <p><strong>Terakhir Diupdate:</strong> {{ $form->updated_at ? $form->updated_at->format('d F Y H:i') : 'Tidak tersedia' }}</p>
    </div>
</body>
</html>
