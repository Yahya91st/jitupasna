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
            table-layout: fixed;
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
            word-wrap: break-word;
        }
        
        td {
            padding: 2px;
            text-align: left;
            vertical-align: top;
            font-size: 7pt;
            line-height: 1.1;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        
        .category-cell {
            width: 20%;
            font-weight: bold; 
            background-color: #f9f9f9; 
            text-align: center; 
            vertical-align: middle;
            font-size: 7pt;
            padding: 2px;
        }
        
        .subcategory-cell {
            width: 50%;
            font-size: 7pt;
            padding: 2px;
        }
        
        .answer-cell {
            width: 30%;
            text-align: right;
            font-size: 7pt;
            padding: 2px;
            padding-right: 6px;
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
            font-size: 7pt;
            width: 30%;
        }
        
        @media print {
            body { 
                font-size: 7pt; 
                line-height: 1.0;
            }
            .document-header {
                margin-bottom: 4px;
                padding-bottom: 2px;
            }
            .section-header {
                margin: 4px 0 2px 0;
                padding: 2px;
                font-size: 8pt;
            }
            .subsection-header {
                margin: 2px 0 1px 0;
                padding: 2px;
                font-size: 7pt;
            }
            table {
                margin: 1px 0;
            }
            th, td {
                padding: 1px;
                font-size: 7pt;
            }
            .category-cell {
                font-size: 6pt;
            }
            .subcategory-cell {
                font-size: 6pt;
            }
            .answer-cell {
                font-size: 6pt;
            }
        }
        
        @media print {
            body { 
                font-size: 7pt; 
                line-height: 1.0;
            }
            .document-header {
                margin-bottom: 4px;
                padding-bottom: 2px;
            }
            .section-header {
                margin: 4px 0 2px 0;
                padding: 2px;
                font-size: 8pt;
            }
            .subsection-header {
                margin: 2px 0 1px 0;
                padding: 2px;
                font-size: 7pt;
            }
            table {
                margin: 1px 0;
            }
            th, td {
                padding: 1px;
                font-size: 6pt;
            }
            .category-cell {
                font-size: 6pt;
            }
            .subcategory-cell {
                font-size: 6pt;
            }
            .answer-cell {
                font-size: 6pt;
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
    
    
    
    <table>
        <tr>
            <th style="width: 20%; font-size: 7pt;">Kategori</th>
            <th style="width: 50%; font-size: 7pt;">Sub-Kategori</th>
            <th style="width: 30%; font-size: 7pt;">Jawaban</th>
        </tr>
        <tr>
            <td rowspan="3" class="category-cell">Penduduk-Wilayah</td>
            <td class="subcategory-cell">Jumlah laki-laki</td>
            <td class="answer-cell">{{ number_format($form->penduduk_laki_laki ?: 0) }}</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah perempuan</td>
            <td class="answer-cell">{{ number_format($form->penduduk_perempuan ?: 0) }}</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah rumah tangga</td>
            <td class="answer-cell">{{ number_format($form->penduduk_rumah_tangga ?: 0) }}</td>
        </tr>
        
        <tr>
            <td rowspan="5" class="category-cell">Kesehatan</td>
            <td class="subcategory-cell">Jumlah rumah sakit</td>
            <td class="answer-cell">{{ number_format($form->rumah_sakit ?: 0) }}</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah PUSKESMAS</td>
            <td class="answer-cell">{{ number_format($form->puskesmas ?: 0) }}</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah PUSKESMAS Pembantu</td>
            <td class="answer-cell">{{ number_format($form->puskesmas_pembantu ?: 0) }}</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah POLINDES</td>
            <td class="answer-cell">{{ number_format($form->polindes ?: 0) }}</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah POSYANDU</td>
            <td class="answer-cell">{{ number_format($form->posyandu ?: 0) }}</td>
        </tr>
        
        <tr>
            <td rowspan="4" class="category-cell">Tenaga Kesehatan</td>
            <td class="subcategory-cell">Jumlah dokter</td>
            <td class="answer-cell">{{ number_format($form->dokter ?: 0) }}</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah paramedis</td>
            <td class="answer-cell">{{ number_format($form->paramedis ?: 0) }}</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah bidan</td>
            <td class="answer-cell">{{ number_format($form->bidan ?: 0) }}</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah kader kesehatan</td>
            <td class="answer-cell">{{ number_format($form->kader_kesehatan ?: 0) }}</td>
        </tr>
        
        <tr>
            <td class="category-cell">Kunjungan ke PUSKESMAS</td>
            <td class="subcategory-cell">Jumlah kunjungan ke PUSKESMAS</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        
        <tr>
            <td rowspan="4" class="category-cell">Balita</td>
            <td class="subcategory-cell">Jumlah balita</td>
            <td class="answer-cell">{{ number_format($form->balita ?: 0) }}</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah balita gizi buruk</td>
            <td class="answer-cell">{{ number_format($form->balita_gizi_buruk ?: 0) }}</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah balita gizi kurang</td>
            <td class="answer-cell">{{ number_format($form->balita_gizi_kurang ?: 0) }}</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah balita ditimbang di Posyandu</td>
            <td class="answer-cell">{{ number_format($form->ditimbang_posyandu ?: 0) }}</td>
        </tr>
        
        <tr>
            <td class="category-cell">Manula</td>
            <td class="subcategory-cell">Jumlah manula</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        
        <tr>
            <td class="category-cell">Penerima JPS Kesehatan</td>
            <td class="subcategory-cell">Jumlah penerima JPS kesehatan</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        
        <tr>
            <td rowspan="2" class="category-cell">Sanitasi</td>
            <td class="subcategory-cell">Jumlah cakupan rumah dengan air bersih</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah cakupan rumah dengan jamban (MCK)</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        
        <tr>
            <td rowspan="4" class="category-cell">Ekonomi Kondisi Keluarga</td>
            <td class="subcategory-cell">Jumlah Keluarga Pra-Sejahtera/Miskin</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah Keluarga Sejahtera-I</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah Penduduk Miskin</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah Keluarga Penerima Beras Miskin</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        
        <tr>
            <td rowspan="10" class="category-cell">Unit Kegiatan Ekonomi</td>
            <td class="subcategory-cell">Jumlah rumah tangga pertanian</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah rumah tangga peternakan</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah rumah tangga perikanan</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah rumah tangga perkebunan</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah industri kecil-menengah</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah pedagang kecil-menengah</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah koperasi/lembaga ekonomi masyarakat</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah tempat wisata umum/tempat menarik</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah pasar</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah tambang</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        
        <tr>
            <td rowspan="6" class="category-cell">Sosial Dan Agama Sarana Ibadah</td>
            <td class="subcategory-cell">Jumlah masjid</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah mushola</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah gereja Protestan/rumah kebaktian</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah gereja Katolik/kapel</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah wihara/sejenis</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah pura/sejenis</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        
        <tr>
            <td rowspan="8" class="category-cell">Jumlah Lembaga Sosial Masyarakat</td>
            <td class="subcategory-cell">Islam (termasuk Ponpes)</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Katolik</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Protestan</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Buddha</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Hindu</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Kepercayaan</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Kemasyarakatan</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Adat istiadat</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        
        <tr>
            <td class="category-cell">Penyandang PMKS</td>
            <td class="subcategory-cell">Jumlah penyandang PMKS</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        
        <tr>
            <td rowspan="3" class="category-cell">Rumah</td>
            <td class="subcategory-cell">Jumlah rumah permanen</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah rumah semi permanen</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah rumah non-permanen</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        
        <tr>
            <td rowspan="3" class="category-cell">Jalan</td>
            <td class="subcategory-cell">Panjang jalan negara</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Panjang jalan provinsi</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Panjang jalan kabupaten</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        
        <tr>
            <td class="category-cell">Bangunan Bersejarah</td>
            <td class="subcategory-cell">Jumlah bangunan bersejarah</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        
        <tr>
            <td rowspan="2" class="category-cell">Produksi</td>
            <td class="subcategory-cell">Jumlah produksi komoditas pertanian</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Jumlah produksi komoditas industri pengolahan</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        
        <tr>
            <td rowspan="6" class="category-cell">Harga</td>
            <td class="subcategory-cell">Harga konstruksi untuk per M2 untuk rumah</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Harga konstruksi untuk per M2 untuk bangunan gedung</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Harga konstruksi untuk per M2 untuk jalan</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Harga konstruksi untuk per M2 untuk jembatan</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Harga konstruksi untuk per M2 untuk dermaga pelabuhan</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
        <tr>
            <td class="subcategory-cell">Harga sewa rumah</td>
            <td class="answer-cell">Data tidak tersedia</td>
        </tr>
    </table>
    
    <!-- Sumber data -->
    <div style="font-size: 7pt; margin: 10px 0; font-style: italic;">
        Sumber data: badan pusat statistik (BPS), daerah (Prov, Kab/Kota) dalam angka, data kecamatan/kelurahan serta data program pembangunan
    </div>
    
    <!-- 2. FORMULIR ISIAN DATA SEKUNDER AKIBAT BENCANA (UMUM) -->
    <div class="section-header">2. Formulir Isian Data Sekunder Akibat Bencana (Umum)</div>
    
    <table>
        <tr>
            <th style="width: 50%; font-size: 7pt; background-color: #e9ecef;">Pertanyaan</th>
            <th style="width: 50%; font-size: 7pt; background-color: #e9ecef;">Jawaban</th>
        </tr>
        <tr>
            <td style="padding: 4px; font-size: 7pt;">Sejarah bencana di masa lalu</td>
            <td style="padding: 4px; font-size: 7pt;">{{ $form->bencana->pendataan->sejarah_bencana ?? 'Data tidak tersedia dalam database' }}</td>
        </tr>
        <tr>
            <td style="padding: 4px; font-size: 7pt;">Kronologis kejadian bencana saat ini</td>
            <td style="padding: 4px; font-size: 7pt;">{{ $form->bencana->pendataan->kronologis_bencana ?? 'Data tidak tersedia dalam database' }}</td>
        </tr>
        <tr>
            <td style="padding: 4px; font-size: 7pt;">Wilayah yang terdampak bencana saat ini</td>
            <td style="padding: 4px; font-size: 7pt;">{{ $form->bencana->pendataan->wilayah_terdampak ?? 'Data tidak tersedia dalam database' }}</td>
        </tr>
        <tr>
            <td style="padding: 4px; font-size: 7pt;">Jumlah korban meninggal dunia</td>
            <td style="padding: 4px; font-size: 7pt;">{{ $form->bencana->pendataan ? number_format($form->bencana->pendataan->jumlah_korban_meninggal ?: 0) . ' orang' : 'Data tidak tersedia dalam database' }}</td>
        </tr>
        <tr>
            <td style="padding: 4px; font-size: 7pt;">Jumlah korban luka-luka</td>
            <td style="padding: 4px; font-size: 7pt;">{{ $form->bencana->pendataan ? number_format($form->bencana->pendataan->jumlah_korban_luka ?: 0) . ' orang' : 'Data tidak tersedia dalam database' }}</td>
        </tr>
        <tr>
            <td style="padding: 4px; font-size: 7pt;">Jumlah korban yang mengungsi</td>
            <td style="padding: 4px; font-size: 7pt;">{{ $form->bencana->pendataan ? number_format($form->bencana->pendataan->jumlah_korban_mengungsi ?: 0) . ' orang' : 'Data tidak tersedia dalam database' }}</td>
        </tr>
        <tr>
            <td style="padding: 4px; font-size: 7pt;">Kerusakan dan kerugian yang dialami</td>
            <td style="padding: 4px; font-size: 7pt;">{{ $form->bencana->pendataan->kerusakan_kerugian ?? 'Data tidak tersedia dalam database' }}</td>
        </tr>
    </table>
    
    <!-- 3. FORMULIR ISIAN DATA SEKUNDER AKIBAT BENCANA (KHUSUS) -->
    <div class="section-header">3. Formulir Isian Data Sekunder Akibat Bencana (Khusus)</div>
    
    <!-- Header Box -->
    <div style="border: 1px solid black; padding: 8px; margin-bottom: 15px;">
        <div style="margin-bottom: 8px;">
            <strong>Nama OPD :</strong> ....................................................................
        </div>
        <div style="margin-bottom: 8px; font-style: italic; text-align: left; font-size: 6pt;">
            (OPD yang terkait dengan Bidang Pertanian dalam arti luas seperti: Dinas Pertanian, Perkebunan, Peternakan, Perikanan, Kehutanan)
        </div>
        <div>
            <strong>Tgl/Bln/Thn :</strong> {{ $form->tanggal_fgd ? $form->tanggal_fgd->format('d/m/Y') : '....................................................................' }}
        </div>
    </div>
    
    <!-- Tabel Pokok Bahasan dengan format konsisten -->
    <table style="width: 100%; border-collapse: collapse; font-size: 7pt;">
        <thead>
            <tr>
                <th style="width: 8%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">NO</th>
                <th style="width: 92%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">POKOK BAHASAN</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">1</td>
            <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                <strong>Rumah tangga yang terkena bencana dan terganggu kegiatan ekonominya:</strong><br>
                <table style="width: 100%; border: none; margin-top: 4px;" cellpadding="0" cellspacing="0">
                    <tr><td style="width: 180px; border: none; padding: 1px 0;">Pertanian pangan dan sayuran</td><td style="border: none; padding: 1px 0;">:</td></tr>
                    <tr><td style="width: 180px; border: none; padding: 1px 0;">Peternakan</td><td style="border: none; padding: 1px 0;">:</td></tr>
                    <tr><td style="width: 180px; border: none; padding: 1px 0;">Perikanan</td><td style="border: none; padding: 1px 0;">:</td></tr>
                    <tr><td style="width: 180px; border: none; padding: 1px 0;">Perkebunan</td><td style="border: none; padding: 1px 0;">:</td></tr>
                    <tr><td style="width: 180px; border: none; padding: 1px 0;">Lainnya</td><td style="border: none; padding: 1px 0;">:</td></tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">2</td>
            <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                <strong>Bentuk gangguan kegiatan ekonomi yang paling parah:</strong><br>
                <table style="width: 100%; border: none; margin-top: 4px;" cellpadding="0" cellspacing="0">
                    <tr><td style="width: 180px; border: none; padding: 3px 0;">Pertanian pangan dan sayuran</td><td style="border: none; padding: 3px 0;">:</td></tr>
                    <tr><td colspan="2" style="border: none; padding: 2px 0;"></td></tr>
                    <tr><td style="width: 180px; border: none; padding: 3px 0;">Peternakan</td><td style="border: none; padding: 3px 0;">:</td></tr>
                    <tr><td colspan="2" style="border: none; padding: 2px 0;"></td></tr>
                    <tr><td style="width: 180px; border: none; padding: 3px 0;">Perikanan</td><td style="border: none; padding: 3px 0;">:</td></tr>
                    <tr><td colspan="2" style="border: none; padding: 2px 0;"></td></tr>
                    <tr><td style="width: 180px; border: none; padding: 3px 0;">Perkebunan</td><td style="border: none; padding: 3px 0;">:</td></tr>
                    <tr><td colspan="2" style="border: none; padding: 2px 0;"></td></tr>
                    <tr><td style="width: 180px; border: none; padding: 3px 0;">Lainnya</td><td style="border: none; padding: 3px 0;">:</td></tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">3</td>
            <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                <strong>Jenis produk pertanian lokal khas yang terkena dampak bencana :</strong><br>
                <br><br>
                
                <strong>Seberapa berat dampak bencana terhadap produk tersebut;</strong><br>
                <br><br>
                
                <strong>Kegiatan pemulihan yang dibutuhkan untuk pemulihan produk tersebut;</strong><br>
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">4</td>
            <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                <strong>Jumlah organisasi/lembaga pertanian di lokasi bencana yang terkena dampak bencana</strong><br>
                .................................... unit.<br><br>
                
                <strong>Sebutkan bentuk-bentuk organisasi/lembaga tersebut</strong><br>
                .....................................................................................................................................................................................................................................................................<br><br>
                
                <strong>Seberapa berat dampak bencana terhadap organisasi/lembaga pertanian tersebut</strong><br>
                .....................................................................................................................................................................................................................................................................<br><br>
                
                <strong>Kegiatan pemulihan yang dibutuhkan untuk pemulihan organisasi/lembaga pertanian tersebut</strong><br>
                .....................................................................................................................................................................................................................................................................
            </td>
        </tr>
        </tbody>
    </table>
    
    <!-- 4. FORMULIR LANJUTAN: SATUAN KERJA PERANGKAT DAERAH -->
    <div style="page-break-inside: avoid; page-break-before: auto;">
        <div class="section-header">4. FORMULIR LANJUTAN: SATUAN KERJA PERANGKAT DAERAH</div>
        
        <!-- Header Box -->
        <div style="border: 1px solid black; padding: 8px; margin-bottom: 15px;">
            <div style="margin-bottom: 8px;">
                <strong>Nama OPD :</strong> ....................................................................
            </div>
            <div style="margin-bottom: 8px; font-style: italic; text-align: left; font-size: 6pt;">
                (OPD yang terkait dengan Bidang Non Pertanian: Perdagangan,Perindustrian, Koperasi, Usaha Kecil Menengah dll)<br>
                
            </div>
            <div>
                <strong>Tgl/Bln/Thn :</strong> ....................................................................
            </div>
        </div>
        
        <!-- Tabel Pokok Bahasan dengan format konsisten dengan bagian 3 -->
        <table style="width: 100%; border-collapse: collapse; font-size: 7pt;">
            <thead>
                <tr>
                    <th style="width: 8%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">NO</th>
                    <th style="width: 92%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">POKOK BAHASAN</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">1</td>
                <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                    <strong>Rumah tangga yang terkena bencana dan terganggu kegiatan ekonominya:</strong><br>
                    <table style="width: 100%; border: none; margin-top: 4px;" cellpadding="0" cellspacing="0">
                        <tr><td style="width: 180px; border: none; padding: 1px 0;">Perdagangan kecil</td><td style="border: none; padding: 1px 0;">:</td></tr>
                        <tr><td style="width: 180px; border: none; padding: 1px 0;">Perdagangan menengah</td><td style="border: none; padding: 1px 0;">:</td></tr>
                        <tr><td style="width: 180px; border: none; padding: 1px 0;">Perdagangan besar</td><td style="border: none; padding: 1px 0;">:</td></tr>
                        <tr><td style="width: 180px; border: none; padding: 1px 0;">Industri kecil (rakyat)</td><td style="border: none; padding: 1px 0;">:</td></tr>
                        <tr><td style="width: 180px; border: none; padding: 1px 0;">Industri menengah</td><td style="border: none; padding: 1px 0;">:</td></tr>
                        <tr><td colspan="2" style="border: none; padding: 1px 0; font-style: italic;">Lanjutan</td></tr>
                        <tr><td style="width: 180px; border: none; padding: 1px 0;">Industri besar</td><td style="border: none; padding: 1px 0;">:</td></tr>
                        <tr><td style="width: 180px; border: none; padding: 1px 0;">Koperasi</td><td style="border: none; padding: 1px 0;">:</td></tr>
                        <tr><td style="width: 180px; border: none; padding: 1px 0;">Lainnya</td><td style="border: none; padding: 1px 0;">:</td></tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">2</td>
                <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                    <strong>Bentuk gangguan kegiatan ekonomi yang paling parah:</strong><br>
                    <table style="width: 100%; border: none; margin-top: 4px;" cellpadding="0" cellspacing="0">
                        <tr><td style="width: 180px; border: none; padding: 3px 0;">Perdagangan Kecil</td><td style="border: none; padding: 3px 0;">:</td></tr>
                        <tr><td colspan="2" style="border: none; padding: 2px 0;"></td></tr>
                        <tr><td style="width: 180px; border: none; padding: 3px 0;">Perdagangan Menengah</td><td style="border: none; padding: 3px 0;">:</td></tr>
                        <tr><td colspan="2" style="border: none; padding: 2px 0;"></td></tr>
                        <tr><td style="width: 180px; border: none; padding: 3px 0;">Perdagangan besar</td><td style="border: none; padding: 3px 0;">:</td></tr>
                        <tr><td colspan="2" style="border: none; padding: 2px 0;"></td></tr>
                        <tr><td style="width: 180px; border: none; padding: 3px 0;">Industri kecil-menengah</td><td style="border: none; padding: 3px 0;">:</td></tr>
                        <tr><td colspan="2" style="border: none; padding: 2px 0;"></td></tr>
                        <tr><td style="width: 180px; border: none; padding: 3px 0;">Industri besar</td><td style="border: none; padding: 3px 0;">:</td></tr>
                        <tr><td style="width: 180px; border: none; padding: 3px 0;">Lainnya</td><td style="border: none; padding: 3px 0;">: berupa ......................................................................................................</td></tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">3</td>
                <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                    <strong>Jenis produk industri lokal khas yang terkena dampak bencana:</strong><br>
                    <div style="margin: 8px 0; line-height: 1.5;">
                        .....................................................................................................................................................................................................................................................................<br>
                        .....................................................................................................................................................................................................................................................................<br><br>
                    </div>
                    
                    <strong>Seberapa berat dampak bencana terhadap produk tersebut;</strong><br>
                    <div style="margin: 8px 0; line-height: 1.5;">
                        .....................................................................................................................................................................................................................................................................<br>
                        .....................................................................................................................................................................................................................................................................<br><br>
                    </div>
                    
                    <strong>Kegiatan yang dibutuhkan untuk pemulihan produk tersebut;</strong><br>
                    <div style="margin: 8px 0; line-height: 1.5;">
                        .....................................................................................................................................................................................................................................................................<br>
                        .....................................................................................................................................................................................................................................................................<br>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">4</td>
                <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                    <strong>Jumlah organisasi/lembaga koperasi di lokasi bencana yang terkena dampak bencana</strong><br>
                    ......................................... unit.<br><br>
                    
                    <strong>Sebutkan bentuk dampak terhadap organisasi/lembaga koperasi tersebut</strong><br>
                    <div style="margin: 8px 0; line-height: 1.5;">
                        .....................................................................................................................................................................................................................................................................<br>
                        .....................................................................................................................................................................................................................................................................<br><br>
                    </div>
                    
                    <strong>Kegiatan pemulihan yang dibutuhkan untuk pemulihan organisasi/lembaga koperasi tersebut</strong><br>
                    <div style="margin: 8px 0; line-height: 1.5;">
                        .....................................................................................................................................................................................................................................................................<br>
                        .....................................................................................................................................................................................................................................................................<br>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    
    <!-- Catatan -->
    <div style="font-size: 7pt; margin: 10px 0; line-height: 1.3;">
        <strong>Catatan :</strong> perlunya menjabarkan batasan operasional/pengertian dari setiap istilah<br>
        Perdagangan kecil adalah ...<br>
        Perdagangan besar adalah ...<br>
        Industry kecil adalah ...<br>
        Industry besar adalah ....
    </div>
    </div>
    
    <!-- SATUAN KERJA PERANGKAT DAERAH (TABEL KEDUA) -->
    <div style="page-break-inside: avoid; margin-top: 20px;">
        <div style="text-align: center; font-weight: bold; font-size: 8pt; margin-bottom: 10px;">
            SATUAN KERJA PERANGKAT DAERAH
        </div>
        
        <!-- Header Box -->
        <div style="border: 1px solid black; padding: 8px; margin-bottom: 15px;">
            <div style="margin-bottom: 8px;">
                <strong>Nama OPD :</strong> ....................................................................
            </div>
            <div style="margin-bottom: 8px; font-style: italic; text-align: left; font-size: 6pt;">
                (OPD yang terkait dengan Bidang Sosial dan Keagamaan)
            </div>
            <div>
                <strong>Tgl/Bln/Thn :</strong> ....................................................................
            </div>
        </div>
        
        <!-- Tabel Pokok Bahasan -->
        <table style="width: 100%; border-collapse: collapse; font-size: 7pt;">
            <thead>
                <tr>
                    <th style="width: 8%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">NO</th>
                    <th style="width: 92%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">POKOK BAHASAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">1</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Jumlah rumah tangga yang kehilangan akses terhadap matapencaharian yang layak (rumah rusak berat dan rusak sedang)</strong><br>
                        <div style="margin: 8px 0;">.......................................................................</div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">2</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Jumlah penyandang cacat akibat bencana</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            <strong>Kegiatan yang dibutuhkan untuk membantu rehabilitasi penyandang cacat akibat bencana</strong><br>
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">3</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Kegiatan agama, sosial kemasyarakatan yang terkena dampak bencana:</strong><br>
                        <div style="margin: 8px 0;">Jelaskan</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">4</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Penggera kegiatan masyarakat tersebut :</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">5</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Kondisi keberlanjutan kegiatan masyarakat tersebut setelah mengalami bencana</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Kegiatan yang dibutuhkan untuk pemulihan kegiatan tersebut tercibit;</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">6</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Adakah permasalahan sosial akibat bencana?</strong><br>
                        <div style="margin: 8px 0;">Jelaskan</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Kegiatan yang dibutuhkan untuk penanganan permasalahan sosial tersebut;</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">7</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Adakah permasalahan kearifan lokal yang dapat digunakan untuk mengurangi risiko akibat bencana?</strong><br>
                        <div style="margin: 8px 0;">Jelaskan</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- SATUAN KERJA PERANGKAT DAERAH (TABEL KETIGA - DINAS PENDIDIKAN) -->
    <div style="page-break-inside: avoid; margin-top: 20px;">
        <div style="text-align: center; font-weight: bold; font-size: 8pt; margin-bottom: 10px;">
            SATUAN KERJA PERANGKAT DAERAH
        </div>
        
        <!-- Header Box -->
        <div style="border: 1px solid black; padding: 8px; margin-bottom: 15px;">
            <div style="margin-bottom: 8px;">
                <strong>Nama OPD :</strong> ....................................................................
            </div>
            <div style="margin-bottom: 8px; font-style: italic; text-align: left; font-size: 6pt;">
                (Dinas Pendidikan)
            </div>
            <div>
                <strong>Tgl/Bln/Thn :</strong> ....................................................................
            </div>
        </div>
        
        <!-- Tabel Pokok Bahasan -->
        <table style="width: 100%; border-collapse: collapse; font-size: 7pt;">
            <thead>
                <tr>
                    <th style="width: 8%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">NO</th>
                    <th style="width: 92%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">POKOK BAHASAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">1</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Permasalahan umum yang menghambat pelaksanaan pendidikan pada masa sebelum bencana</strong><div><br>(dari faktor pemberi layanan, penduduk, infrastruktur maupun bentang alam)<br></div> 
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">2</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Adakah indikasi siswa dan atau guru terkena trauma setelah bencana?</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Berapa jumlah persentase diantara mereka yang terindikasi mengalami trauma?</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">3</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Permasalahan pendidikan akibat bencana?</strong><br>
                        <div style="margin: 8px 0;">Jelaskan</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Kegiatan yang dibutuhkan untuk pengurusan permasalahan tersebut;</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Jumlah sasaran</strong> ........................................................................................................<br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">4</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Jumlah guru yang meninggal/berpindah setelah bencana :</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Kegiatan yang dibutuhkan untuk mengatasi permasalahan guru yang meninggal/berpindah :</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- SATUAN KERJA PERANGKAT DAERAH (TABEL KEEMPAT - PEKERJAAN DAERAH) -->
    <div style="page-break-inside: avoid; margin-top: 20px;">
        <div style="text-align: center; font-weight: bold; font-size: 8pt; margin-bottom: 10px;">
            SATUAN KERJA PERANGKAT DAERAH
        </div>
        
        <!-- Header Box -->
        <div style="border: 1px solid black; padding: 8px; margin-bottom: 15px;">
            <div style="margin-bottom: 8px;">
                <strong>Nama OPD :</strong> ....................................................................
            </div>
            <div style="margin-bottom: 8px; font-style: italic; text-align: left; font-size: 6pt;">
                (Pekerjaan Daerah)
            </div>
            <div>
                <strong>Tgl/Bln/Thn :</strong> ..................................................................
            </div>
        </div>
        
        <!-- Tabel Pokok Bahasan -->
        <table style="width: 100%; border-collapse: collapse; font-size: 7pt;">
            <thead>
                <tr>
                    <th style="width: 8%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">NO</th>
                    <th style="width: 92%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">POKOK BAHASAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">1</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Jumlah Bukan Tetuapan Rukun Warga/Kelurahan Kecamatan yang terganggu akibat bencana</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>

                             <strong>Jenis gangguan</strong> 
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Kebutuhan dukungan untuk pemulihan</strong>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                        </div>
                    </td>
                </tr>
    
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">3</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Adakah komunitas atau gesa yang memiliki sistem pemeliharaan dan sarana desa?</strong><br>
                        <div style="margin: 6px 0;">Bila ada jelaskan :</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Apakah sistem tersebut terganggu akibat bencana? Jelaskan</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">4</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Adakah komunitas yang desa yang memiliki kebiasaan gotong desa (sambang dll)?</strong><br>
                        <div style="margin: 6px 0;">Bila ada jelaskan :</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Apakah sistem tersebut terganggu akibat bencana? Jelaskan</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">5</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Jumlah penduduk keluarga yang kehilangan surat-surat penting (sertifikat tanah, KTP dll atau keamya)</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Kegiatan yang dibutuhkan untuk mengatasi hal tersebut</strong> ........................................<br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">6</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Apakah pemerintah daerah memiliki rencana kontingensi untuk permasalahan administrasi?</strong><br>
                        <div style="margin: 6px 0;">Jelaskan</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Kegiatan yang dibutuhkan untuk pengurusan permasalahan tersebut;</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">7</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Jumlah pegawai pemerintah yang meninggal/berpindah;</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Dukungan yang dibutuhkan untuk mengatasi permasalahan tersebut;</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- SATUAN KERJA PERANGKAT DAERAH (TABEL KELIMA - DINAS KESEHATAN) -->
    <div style="page-break-inside: avoid; margin-top: 20px;">
        <div style="text-align: center; font-weight: bold; font-size: 8pt; margin-bottom: 10px;">
            SATUAN KERJA PERANGKAT DAERAH
        </div>
        
        <!-- Header Box -->
        <div style="border: 1px solid black; padding: 8px; margin-bottom: 15px;">
            <div style="margin-bottom: 8px;">
                <strong>Nama OPD :</strong> ....................................................................
            </div>
            <div style="margin-bottom: 8px; font-style: italic; text-align: left; font-size: 6pt;">
                (Dinas Kesehatan)
            </div>
            <div>
                <strong>Tgl/Bln/Thn :</strong> ....................................................................
            </div>
        </div>
        
        <!-- Tabel Pokok Bahasan -->
        <table style="width: 100%; border-collapse: collapse; font-size: 7pt;">
            <thead>
                <tr>
                    <th style="width: 8%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">NO</th>
                    <th style="width: 92%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">POKOK BAHASAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">1</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Permasalahan umum yang menghambat pelaksanaan pelayanan kesehatan pada masa sebelum bencana.</strong> <em>(dari faktor pemberi layanan, penduduk, infrastruktur maupun bentang alam)</em><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">2</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Adakah indikasi penduduk trauma setelah bencana?;</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Berapa jumlah/persentase diantara mereka yang terindikasi mengalami trauma?</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">3</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Adakah program/kegiatan kesehatan masal dalam penanggulangan dampak bencana?</strong><br>
                        <div style="margin: 6px 0;">Jelaskan</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">4</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Permasalahan kesehatan yang umum akibat bencana?</strong><br>
                        <div style="margin: 6px 0;">: Jelaskan</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Kegiatan yang dibutuhkan untuk pengurangan permasalahan tersebut;</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">5</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Adakah program pemberian makanan tambahan untuk balita/ anak sekolah?</strong><br>
                        <div style="margin: 6px 0;">: Jelaskan</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">6</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Jumlah balita yang terdampak bencana</strong>........................................................................<br>
                        <div style="margin: 6px 0;"><strong>Jelaskan dampak bencana terhadap balita</strong> ..................................................................</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Kegiatan yang dibutuhkan untuk mengatasi dampak bencana terhadap balita</strong>............<br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">7</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Jumlah ibu hamil yang terdampak bencana</strong> ..................................................................<br>
                        <div style="margin: 6px 0;"><strong>Jelaskan dampak bencana terhadap ibu hamil</strong> ..........................................</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Kegiatan yang dibutuhkan untuk mengatasi dampak bencana terhadap ibu hamil</strong>........<br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">8</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Jumlah lansia yang terdampak bencana</strong> .................................................................<br>
                        <div style="margin: 6px 0;"><strong>Jelaskan dampak bencana terhadap lansia</strong> ............................................................</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Kegiatan yang dibutuhkan untuk mengatasi dampak bencana terhadap lansia</strong>........<br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">9</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Perkiraan dampak kesehatan jangka menengah akibat bencana</strong><br>
                        <div style="margin: 6px 0;">Jelaskan</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br><br>
                        </div>
                        
                        <strong>Kegiatan yang dibutuhkan untuk pengurangan permasalahan tersebut;</strong><br>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;">10</td>
                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        <strong>Adakah rencana kontingensi terkait bidang kesehatan dalam mengurangi risiko akibat bencana?</strong><br>
                        <div style="margin: 6px 0;">Jelaskan</div>
                        <div style="margin: 8px 0; line-height: 1.5;">
                            .....................................................................................................................................................................................................................................................................<br>
                            .....................................................................................................................................................................................................................................................................<br>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px; border-top: 1px solid #000; padding-top: 10px; font-size: 8pt; color: #666;">
        <p><strong>Tanggal Pengisian:</strong> {{ $form->created_at ? $form->created_at->format('d F Y H:i') : 'Tidak tersedia' }}</p>
        <p><strong>Terakhir Diupdate:</strong> {{ $form->updated_at ? $form->updated_at->format('d F Y H:i') : 'Tidak tersedia' }}</p>
    </div>
</body>
</html>
