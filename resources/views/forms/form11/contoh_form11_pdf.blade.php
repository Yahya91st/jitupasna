{{-- 
    Formulir 11 PDF Template - Sesuai Format Standar PDNA
    
    Cara penggunaan:
    1. Jika dipanggil dari controller dengan data: pass variabel $form
    2. Jika dipanggil tanpa data: akan menggunakan data contoh default
    
    Contoh pemanggilan dengan data:
    return view('forms.form11.contoh_form11_pdf', compact('form'));
--}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 11 - Rekapitulasi Kebutuhan Pascabencana (PDNA)</title>
    <style>
        @page {
            margin: 0.8cm;
            size: A4;
        }

        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.2;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 9pt;
        }

        .container {
            width: 100%;
            max-width: 100%;
            margin: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 1px solid #ddd;
        }

        .header h2 {
            margin: 0.1rem 0;
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #333;
        }

        .header h3 {
            margin: 0.1rem 0;
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #333;
        }

        .intro-text {
            text-align: justify;
            font-size: 8pt;
            line-height: 1.2;
            margin-bottom: 6px;
            padding: 4px 6px;
            background-color: #f9f9f9;
            border-left: 2px solid #333;
            border-radius: 2px;
        }

        .intro-label {
            font-weight: 600;
            font-size: 8pt;
            margin-bottom: 1px;
            display: block;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
            border: 1px solid #333;
            page-break-inside: auto;
        }

        th, td {
            padding: 2px 3px;
            text-align: left;
            font-size: 7pt;
            vertical-align: top;
            border: 1px solid #333;
            line-height: 1.1;
        }

        th {
            background-color: #f9f9f9;
            font-weight: bold;
            text-align: center;
            color: #333;
            font-size: 7pt;
            padding: 3px 2px;
        }

        .sector-column {
            width: 12%;
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            font-size: 7pt;
            color: #333;
        }

        .komponen-column {
            width: 15%;
            font-size: 7pt;
        }

        .kegiatan-column {
            width: 18%;
            font-size: 7pt;
        }

        .lokasi-column {
            width: 12%;
            font-size: 7pt;
        }

        .volume-column {
            width: 8%;
            text-align: center;
            font-size: 7pt;
        }

        .harga-column {
            width: 12%;
            text-align: right;
            font-size: 7pt;
            font-family: 'Courier New', monospace;
        }

        .jumlah-column {
            width: 13%;
            text-align: right;
            font-size: 7pt;
            font-family: 'Courier New', monospace;
            font-weight: bold;
        }

        .keterangan-column {
            width: 10%;
            font-size: 7pt;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Formulir 11</h2>
            <h3>Rekapitulasi Kebutuhan Pascabencana (PDNA)</h3>
        </div>

    

        <!-- Tabel Utama Formulir 11 sesuai format standar -->
        <table>
            <thead>
                <tr>
                    <th class="sector-column">Sektor</th>
                    <th class="komponen-column">Komponen Kebutuhan</th>
                    <th class="kegiatan-column">Kegiatan</th>
                    <th class="lokasi-column">Lokasi</th>
                    <th class="volume-column">Volume</th>
                    <th class="harga-column">Harga Satuan</th>
                    <th class="jumlah-column">Jumlah</th>
                    <th class="keterangan-column">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <!-- SEKTOR PERUMAHAN & PERMUKIMAN -->
                <tr>
                    <td rowspan="15" class="sector-column">Perumahan & Permukiman</td>
                    <td rowspan="3" class="komponen-column">Pembangunan</td>
                    <td class="kegiatan-column">Rumah Tahan Gempa Type 45</td>
                    <td class="lokasi-column">Cugenang</td>
                    <td class="volume-column">150 unit</td>
                    <td class="harga-column">125,000,000</td>
                    <td class="jumlah-column">18,750,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Rumah Tahan Gempa Type 36</td>
                    <td class="lokasi-column">Gasol</td>
                    <td class="volume-column">100 unit</td>
                    <td class="harga-column">95,000,000</td>
                    <td class="jumlah-column">9,500,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Kompleks Perumahan Relokasi</td>
                    <td class="lokasi-column">Warungkondang</td>
                    <td class="volume-column">75 unit</td>
                    <td class="harga-column">110,000,000</td>
                    <td class="jumlah-column">8,250,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Penggantian</td>
                    <td class="kegiatan-column">Rumah Rusak Berat</td>
                    <td class="lokasi-column">Gasol</td>
                    <td class="volume-column">85 unit</td>
                    <td class="harga-column">100,000,000</td>
                    <td class="jumlah-column">8,500,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Rumah Rusak Total</td>
                    <td class="lokasi-column">Cugenang</td>
                    <td class="volume-column">60 unit</td>
                    <td class="harga-column">120,000,000</td>
                    <td class="jumlah-column">7,200,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Renovasi Rumah Roboh</td>
                    <td class="lokasi-column">Sarampad</td>
                    <td class="volume-column">45 unit</td>
                    <td class="harga-column">90,000,000</td>
                    <td class="jumlah-column">4,050,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Penyediaan Bantuan</td>
                    <td class="kegiatan-column">Paket Bahan Bangunan</td>
                    <td class="lokasi-column">Warungkondang</td>
                    <td class="volume-column">200 paket</td>
                    <td class="harga-column">25,000,000</td>
                    <td class="jumlah-column">5,000,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Bantuan Semen & Besi</td>
                    <td class="lokasi-column">Cipanas</td>
                    <td class="volume-column">150 paket</td>
                    <td class="harga-column">35,000,000</td>
                    <td class="jumlah-column">5,250,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Alat Konstruksi Ringan</td>
                    <td class="lokasi-column">Gasol</td>
                    <td class="volume-column">100 set</td>
                    <td class="harga-column">15,000,000</td>
                    <td class="jumlah-column">1,500,000,000</td>
                    <td class="keterangan-column">Prioritas Rendah</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Pemulihan Fungsi</td>
                    <td class="kegiatan-column">Rumah Rusak Sedang</td>
                    <td class="lokasi-column">Cipanas</td>
                    <td class="volume-column">120 unit</td>
                    <td class="harga-column">50,000,000</td>
                    <td class="jumlah-column">6,000,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Perbaikan Atap & Dinding</td>
                    <td class="lokasi-column">Warungkondang</td>
                    <td class="volume-column">90 unit</td>
                    <td class="harga-column">35,000,000</td>
                    <td class="jumlah-column">3,150,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Rehabilitasi Struktur</td>
                    <td class="lokasi-column">Cugenang</td>
                    <td class="volume-column">70 unit</td>
                    <td class="harga-column">45,000,000</td>
                    <td class="jumlah-column">3,150,000,000</td>
                    <td class="keterangan-column">Prioritas Rendah</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Pengurangan Resiko</td>
                    <td class="kegiatan-column">Huntara Korban Gempa</td>
                    <td class="lokasi-column">Sarampad</td>
                    <td class="volume-column">80 unit</td>
                    <td class="harga-column">55,000,000</td>
                    <td class="jumlah-column">4,400,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Relokasi Keluarga Beresiko</td>
                    <td class="lokasi-column">Gasol</td>
                    <td class="volume-column">50 KK</td>
                    <td class="harga-column">75,000,000</td>
                    <td class="jumlah-column">3,750,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Pengamanan Zona Bahaya</td>
                    <td class="lokasi-column">Cipanas</td>
                    <td class="volume-column">25 lokasi</td>
                    <td class="harga-column">80,000,000</td>
                    <td class="jumlah-column">2,000,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>

                <!-- SEKTOR INFRASTRUKTUR -->
                <tr>
                    <td rowspan="9" class="sector-column">Infrastruktur</td>
                    <td rowspan="3" class="komponen-column">Pembangunan</td>
                    <td class="kegiatan-column">Jalan Provinsi</td>
                    <td class="lokasi-column">Cugenang-Gasol</td>
                    <td class="volume-column">5 km</td>
                    <td class="harga-column">1,500,000,000</td>
                    <td class="jumlah-column">7,500,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Jalan Kabupaten</td>
                    <td class="lokasi-column">Cipanas-Sarampad</td>
                    <td class="volume-column">3.5 km</td>
                    <td class="harga-column">1,200,000,000</td>
                    <td class="jumlah-column">4,200,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Jembatan Penghubung</td>
                    <td class="lokasi-column">Sungai Cipanas</td>
                    <td class="volume-column">2 unit</td>
                    <td class="harga-column">1,800,000,000</td>
                    <td class="jumlah-column">3,600,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Penggantian</td>
                    <td class="kegiatan-column">Jembatan Rusak</td>
                    <td class="lokasi-column">Sungai Cisokan</td>
                    <td class="volume-column">3 unit</td>
                    <td class="harga-column">2,500,000,000</td>
                    <td class="jumlah-column">7,500,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Gorong-gorong Hancur</td>
                    <td class="lokasi-column">Cugenang</td>
                    <td class="volume-column">15 unit</td>
                    <td class="harga-column">200,000,000</td>
                    <td class="jumlah-column">3,000,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Pagar Pembatas Jalan</td>
                    <td class="lokasi-column">Gasol</td>
                    <td class="volume-column">8 km</td>
                    <td class="harga-column">150,000,000</td>
                    <td class="jumlah-column">1,200,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Penyediaan Bantuan</td>
                    <td class="kegiatan-column">Saluran Drainase</td>
                    <td class="lokasi-column">Warungkondang</td>
                    <td class="volume-column">2 km</td>
                    <td class="harga-column">2,425,000,000</td>
                    <td class="jumlah-column">4,850,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Material Urugan</td>
                    <td class="lokasi-column">Cipanas</td>
                    <td class="volume-column">500 m3</td>
                    <td class="harga-column">350,000</td>
                    <td class="jumlah-column">175,000,000</td>
                    <td class="keterangan-column">Prioritas Rendah</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Alat Berat Darurat</td>
                    <td class="lokasi-column">Sarampad</td>
                    <td class="volume-column">12 bulan</td>
                    <td class="harga-column">200,000,000</td>
                    <td class="jumlah-column">2,400,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>

                <!-- SEKTOR EKONOMI PRODUKTIF -->
                <tr>
                    <td rowspan="15" class="sector-column">Ekonomi Produktif</td>
                    <td rowspan="3" class="komponen-column">Pemulihan Fungsi</td>
                    <td class="kegiatan-column">Modal Usaha UMKM</td>
                    <td class="lokasi-column">Se-Kabupaten</td>
                    <td class="volume-column">500 UMKM</td>
                    <td class="harga-column">15,000,000</td>
                    <td class="jumlah-column">7,500,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Restocking Inventory Toko</td>
                    <td class="lokasi-column">Cugenang</td>
                    <td class="volume-column">150 toko</td>
                    <td class="harga-column">20,000,000</td>
                    <td class="jumlah-column">3,000,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Pemulihan Usaha Pertanian</td>
                    <td class="lokasi-column">Sarampad</td>
                    <td class="volume-column">200 petani</td>
                    <td class="harga-column">12,500,000</td>
                    <td class="jumlah-column">2,500,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Pengurangan Resiko</td>
                    <td class="kegiatan-column">Rehabilitasi Pasar</td>
                    <td class="lokasi-column">Gasol</td>
                    <td class="volume-column">2 unit</td>
                    <td class="harga-column">3,500,000,000</td>
                    <td class="jumlah-column">7,000,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Asuransi Usaha Mikro</td>
                    <td class="lokasi-column">Se-Kabupaten</td>
                    <td class="volume-column">300 UMKM</td>
                    <td class="harga-column">10,000,000</td>
                    <td class="jumlah-column">3,000,000,000</td>
                    <td class="keterangan-column">Prioritas Rendah</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Proteksi Lahan Pertanian</td>
                    <td class="lokasi-column">Cipanas</td>
                    <td class="volume-column">100 ha</td>
                    <td class="harga-column">25,000,000</td>
                    <td class="jumlah-column">2,500,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Pembangunan</td>
                    <td class="kegiatan-column">Bantuan Alat Pertanian</td>
                    <td class="lokasi-column">Cugenang</td>
                    <td class="volume-column">300 petani</td>
                    <td class="harga-column">25,000,000</td>
                    <td class="jumlah-column">7,500,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Pusat Pelatihan UMKM</td>
                    <td class="lokasi-column">Warungkondang</td>
                    <td class="volume-column">1 unit</td>
                    <td class="harga-column">2,500,000,000</td>
                    <td class="jumlah-column">2,500,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Sentra Produksi Pertanian</td>
                    <td class="lokasi-column">Sarampad</td>
                    <td class="volume-column">2 unit</td>
                    <td class="harga-column">1,750,000,000</td>
                    <td class="jumlah-column">3,500,000,000</td>
                    <td class="keterangan-column">Prioritas Rendah</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Penggantian</td>
                    <td class="kegiatan-column">Revitalisasi Koperasi</td>
                    <td class="lokasi-column">Se-Kabupaten</td>
                    <td class="volume-column">15 unit</td>
                    <td class="harga-column">200,000,000</td>
                    <td class="jumlah-column">3,000,000,000</td>
                    <td class="keterangan-column">Prioritas Rendah</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Penggantian Mesin Produksi</td>
                    <td class="lokasi-column">Cugenang</td>
                    <td class="volume-column">50 unit</td>
                    <td class="harga-column">45,000,000</td>
                    <td class="jumlah-column">2,250,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Penggantian Kendaraan Usaha</td>
                    <td class="lokasi-column">Gasol</td>
                    <td class="volume-column">25 unit</td>
                    <td class="harga-column">80,000,000</td>
                    <td class="jumlah-column">2,000,000,000</td>
                    <td class="keterangan-column">Prioritas Rendah</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Penyediaan Bantuan</td>
                    <td class="kegiatan-column">Restocking Ternak</td>
                    <td class="lokasi-column">Cipanas</td>
                    <td class="volume-column">200 peternak</td>
                    <td class="harga-column">20,000,000</td>
                    <td class="jumlah-column">4,000,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Bantuan Bibit Tanaman</td>
                    <td class="lokasi-column">Warungkondang</td>
                    <td class="volume-column">500 petani</td>
                    <td class="harga-column">5,000,000</td>
                    <td class="jumlah-column">2,500,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Pakan Ternak Darurat</td>
                    <td class="lokasi-column">Sarampad</td>
                    <td class="volume-column">100 ton</td>
                    <td class="harga-column">15,000,000</td>
                    <td class="jumlah-column">1,500,000,000</td>
                    <td class="keterangan-column">Prioritas Rendah</td>
                </tr>

                <!-- SEKTOR SOSIAL -->
                <tr>
                    <td rowspan="9" class="sector-column">Sosial</td>
                    <td rowspan="3" class="komponen-column">Pembangunan</td>
                    <td class="kegiatan-column">Puskesmas Rusak</td>
                    <td class="lokasi-column">Cugenang</td>
                    <td class="volume-column">2 unit</td>
                    <td class="harga-column">3,000,000,000</td>
                    <td class="jumlah-column">6,000,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Sekolah Tahan Gempa</td>
                    <td class="lokasi-column">Warungkondang</td>
                    <td class="volume-column">3 unit</td>
                    <td class="harga-column">2,200,000,000</td>
                    <td class="jumlah-column">6,600,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Pusat Kesehatan Masyarakat</td>
                    <td class="lokasi-column">Cipanas</td>
                    <td class="volume-column">1 unit</td>
                    <td class="harga-column">4,500,000,000</td>
                    <td class="jumlah-column">4,500,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Penggantian</td>
                    <td class="kegiatan-column">SD Rusak Berat</td>
                    <td class="lokasi-column">Gasol</td>
                    <td class="volume-column">3 unit</td>
                    <td class="harga-column">1,500,000,000</td>
                    <td class="jumlah-column">4,500,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">SMP Roboh Gempa</td>
                    <td class="lokasi-column">Cugenang</td>
                    <td class="volume-column">2 unit</td>
                    <td class="harga-column">2,500,000,000</td>
                    <td class="jumlah-column">5,000,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Posyandu Rusak</td>
                    <td class="lokasi-column">Cipanas</td>
                    <td class="volume-column">10 unit</td>
                    <td class="harga-column">150,000,000</td>
                    <td class="jumlah-column">1,500,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Penyediaan Bantuan</td>
                    <td class="kegiatan-column">Bantuan Trauma Healing</td>
                    <td class="lokasi-column">Se-Kabupaten</td>
                    <td class="volume-column">1000 orang</td>
                    <td class="harga-column">3,000,000</td>
                    <td class="jumlah-column">3,000,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Bantuan Obat-obatan</td>
                    <td class="lokasi-column">Warungkondang</td>
                    <td class="volume-column">5000 paket</td>
                    <td class="harga-column">500,000</td>
                    <td class="jumlah-column">2,500,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Bantuan Alat Sekolah</td>
                    <td class="lokasi-column">Sarampad</td>
                    <td class="volume-column">2000 siswa</td>
                    <td class="harga-column">750,000</td>
                    <td class="jumlah-column">1,500,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>

                <!-- SEKTOR LINTAS SEKTOR -->
                <tr>
                    <td rowspan="15" class="sector-column">Lintas Sektor</td>
                    <td rowspan="3" class="komponen-column">Pemulihan Fungsi</td>
                    <td class="kegiatan-column">Koordinasi Pemulihan</td>
                    <td class="lokasi-column">Se-Kabupaten</td>
                    <td class="volume-column">36 bulan</td>
                    <td class="harga-column">100,000,000</td>
                    <td class="jumlah-column">3,600,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Pemulihan Komunikasi</td>
                    <td class="lokasi-column">Cugenang</td>
                    <td class="volume-column">15 tower</td>
                    <td class="harga-column">150,000,000</td>
                    <td class="jumlah-column">2,250,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Pemulihan Listrik Darurat</td>
                    <td class="lokasi-column">Gasol</td>
                    <td class="volume-column">25 titik</td>
                    <td class="harga-column">80,000,000</td>
                    <td class="jumlah-column">2,000,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Pengurangan Resiko</td>
                    <td class="kegiatan-column">Sistem Peringatan Dini</td>
                    <td class="lokasi-column">Se-Kabupaten</td>
                    <td class="volume-column">10 unit</td>
                    <td class="harga-column">500,000,000</td>
                    <td class="jumlah-column">5,000,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Pemetaan Zona Bahaya</td>
                    <td class="lokasi-column">Warungkondang</td>
                    <td class="volume-column">50 km2</td>
                    <td class="harga-column">40,000,000</td>
                    <td class="jumlah-column">2,000,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Protokol Evakuasi</td>
                    <td class="lokasi-column">Cipanas</td>
                    <td class="volume-column">20 desa</td>
                    <td class="harga-column">75,000,000</td>
                    <td class="jumlah-column">1,500,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Pembangunan</td>
                    <td class="kegiatan-column">Pos Komando Tanggap Darurat</td>
                    <td class="lokasi-column">Cugenang</td>
                    <td class="volume-column">1 unit</td>
                    <td class="harga-column">2,000,000,000</td>
                    <td class="jumlah-column">2,000,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Center Operations Emergency</td>
                    <td class="lokasi-column">Gasol</td>
                    <td class="volume-column">1 unit</td>
                    <td class="harga-column">3,200,000,000</td>
                    <td class="jumlah-column">3,200,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Shelter Evakuasi Permanen</td>
                    <td class="lokasi-column">Warungkondang</td>
                    <td class="volume-column">3 unit</td>
                    <td class="harga-column">800,000,000</td>
                    <td class="jumlah-column">2,400,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Penggantian</td>
                    <td class="kegiatan-column">Pelatihan Kesiapsiagaan</td>
                    <td class="lokasi-column">Se-Kabupaten</td>
                    <td class="volume-column">50 kelompok</td>
                    <td class="harga-column">50,000,000</td>
                    <td class="jumlah-column">2,500,000,000</td>
                    <td class="keterangan-column">Prioritas Sedang</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Penggantian Radio Komunikasi</td>
                    <td class="lokasi-column">Cugenang</td>
                    <td class="volume-column">20 unit</td>
                    <td class="harga-column">75,000,000</td>
                    <td class="jumlah-column">1,500,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Penggantian Peralatan SAR</td>
                    <td class="lokasi-column">Gasol</td>
                    <td class="volume-column">1 set</td>
                    <td class="harga-column">1,800,000,000</td>
                    <td class="jumlah-column">1,800,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td rowspan="3" class="komponen-column">Penyediaan Bantuan</td>
                    <td class="kegiatan-column">Gudang Logistik Darurat</td>
                    <td class="lokasi-column">Gasol</td>
                    <td class="volume-column">2 unit</td>
                    <td class="harga-column">400,000,000</td>
                    <td class="jumlah-column">800,000,000</td>
                    <td class="keterangan-column">Prioritas Rendah</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Tenda Darurat</td>
                    <td class="lokasi-column">Warungkondang</td>
                    <td class="volume-column">500 unit</td>
                    <td class="harga-column">2,000,000</td>
                    <td class="jumlah-column">1,000,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
                <tr>
                    <td class="kegiatan-column">Bantuan Makanan Darurat</td>
                    <td class="lokasi-column">Cipanas</td>
                    <td class="volume-column">10000 paket</td>
                    <td class="harga-column">100,000</td>
                    <td class="jumlah-column">1,000,000,000</td>
                    <td class="keterangan-column">Prioritas Tinggi</td>
                </tr>
            </tbody>
        </table>

        <div class="footer-info">
            <div style="margin-top: 8px; padding: 4px; border: 1px solid #333; background-color: #f9f9f9;">
                <div style="font-weight: 600; margin-bottom: 2px;">PRIORITAS KEBUTUHAN:</div>
                <div>• <strong>Prioritas Tinggi:</strong> Hunian tetap, infrastruktur transportasi, modal UMKM</div>
                <div>• <strong>Prioritas Sedang:</strong> Infrastruktur air & sanitasi, bantuan pertanian, koperasi</div>
                <div>• <strong>Prioritas Rendah:</strong> Fasilitas pendukung, peningkatan kapasitas, monitoring</div>
            </div>

            <div style="margin-top: 8px; padding: 6px; border: 1px solid #333; background-color: #f9f9f9; border-radius: 3px;">
                <div style="font-weight: 600; margin-bottom: 4px; color: #333; font-size: 8pt;">PENANGGUNG JAWAB:</div>
                <div style="font-size: 7pt; line-height: 1.3;">• <strong>BPBD Kabupaten Cianjur:</strong> Koordinasi dan monitoring keseluruhan</div>
                <div style="font-size: 7pt; line-height: 1.3;">• <strong>Dinas PUPR:</strong> Infrastruktur dan perumahan</div>
                <div style="font-size: 7pt; line-height: 1.3;">• <strong>Dinas Koperasi & UMKM:</strong> Sektor ekonomi produktif</div>
                <div style="font-size: 7pt; line-height: 1.3;">• <strong>Dinas Sosial:</strong> Bantuan sosial dan pemberdayaan</div>
            </div>

            <div style="margin-top: 8px; padding: 6px; border: 2px solid #333; background-color: #fff; border-radius: 3px;">
                <div style="font-weight: 600; margin-bottom: 4px; color: #333; font-size: 9pt; text-align: center;">REKAPITULASI TOTAL KEBUTUHAN</div>
                <div style="font-size: 8pt; line-height: 1.4; text-align: center;">
                    <strong style="font-family: 'Courier New', monospace; font-size: 10pt;">Rp 246.775.000.000</strong><br>
                    <em>(Dua Ratus Empat Puluh Enam Miliar Tujuh Ratus Tujuh Puluh Lima Juta Rupiah)</em>
                </div>
                <div style="margin-top: 6px; font-size: 7pt; line-height: 1.3;">
                    <div>• <strong>Periode pelaksanaan:</strong> Januari 2023 - Desember 2025 (3 tahun)</div>
                    <div>• <strong>Total kegiatan:</strong> 63 kegiatan pemulihan (15 per sektor, 9 infrastruktur & sosial)</div>
                    <div>• <strong>Durasi per kegiatan:</strong> 6-36 bulan tergantung kompleksitas</div>
                    <div>• <strong>Sumber data:</strong> Hasil PDNA tim BPBD Kabupaten Cianjur per 15 Desember 2022</div>
                </div>
            </div>
        </div>
    </div>
</body> 
