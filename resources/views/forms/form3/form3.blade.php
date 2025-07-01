@extends('layouts.main')

@section('content')
<style>
    /* Global table styles */
    .form-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        box-sizing: border-box;
    }
    
    .form-table th {
        background-color: #f8f9fa;
        font-weight: bold;
        text-align: center;
        padding: 8px;
    }
    
    .form-table td {
        padding: 8px;
        vertical-align: top;
    }
    
    .form-table ul {
        margin-bottom: 0;
        padding-left: 20px;
    }
    
    /* Three column table layout */
    .three-column-table th, .three-column-table td {
        box-sizing: border-box;
    }
    
    .three-column-table tr {
        display: table-row;
    }
    
    .three-column-table th:nth-child(1),
    .three-column-table td:nth-child(1) {
        width: 30%;
    }
    
    .three-column-table th:nth-child(2),
    .three-column-table td:nth-child(2) {
        width: 40%;
    }
    
    .three-column-table th:nth-child(3),
    .three-column-table td:nth-child(3) {
        width: 30%;
    }
    
    /* Two column table layout */
    .two-column-table th:nth-child(1),
    .two-column-table td:nth-child(1) {
        width: 40%;
    }
    
    .two-column-table th:nth-child(2),
    .two-column-table td:nth-child(2) {
        width: 60%;
    }
    
    /* Section headers */
    .section-header {
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 10px;
    }
    
    /* Form container */
    .form-container {
        max-width: 1000px;
        font-family: "Times New Roman", serif;
        line-height: 1.5;
        padding-bottom: 20px;
    }
    
    /* Divider */
    .section-divider {
        margin: 30px 0;
        border-top: 1px solid #dee2e6;
    }
    
    /* Form input styles */
    .form-input {
        border: none;
        border-bottom: 1px dotted #999;
        outline: none;
        background-color: transparent;
        width: 100%;
        min-width: 150px;
        font-family: "Times New Roman", serif;
        line-height: 1.5;
    }
    
    .form-label {
        display: inline-block;
        width: 160px;
        font-weight: normal;
        vertical-align: top;
        margin-right: 5px;
    }
    
    /* Answer cell styles */
    .three-column-table td:nth-child(3) {
        position: relative;
    }
    
    .three-column-table td:nth-child(3):after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 8px;
        right: 8px;
        border-bottom: 1px dotted #999;
    }
    
    /* Dotted line for form fields */
    .dotted-line {
        display: inline-block;
        border-bottom: 1px dotted #999;
        min-width: 300px;
        height: 1.2em;
        vertical-align: bottom;
    }
    
    /* List item spacing */
    .form-list-item {
        margin-bottom: 8px;
    }
    
    .form-list-item:last-child {
        margin-bottom: 0;
    }
</style>
<div class="container form-container">
    <div class="text-center mb-4">
        <h5><strong>Formulir 03</strong><br>Pendataan ke OPD</h5>
    </div>
    
    <h6 class="section-header">1. Formulir Isian Data Dasar Sebelum Bencana</h6>
    <p>
        <span class="form-label">Wilayah bencana</span>
        <span>Kab/kota/kecamatan: </span>
        <span class="dotted-line"><input type="text" class="form-input" style="width: 300px;"></span>
    </p>
    
    <table class="table table-bordered form-table three-column-table" border="1">
        <thead class="text-center">
            <tr>
                <th>Kategori</th>
                <th>Sub-Kategori</th>
                <th>Jawaban</th>
            </tr>

        </thead>
        <tbody>
            <!-- Penduduk-Wilayah -->
            <tr><td rowspan="3">Penduduk-Wilayah</td><td>Jumlah laki-laki</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah perempuan</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah rumah tangga</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <!-- Kesehatan -->
            <tr><td rowspan="5">Sarana Kesehatan</td><td>Jumlah rumah sakit</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah PUSKESMAS</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah PUSKESMAS Pembantu</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah POLINDES</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah POSYANDU</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <tr><td rowspan="4">Tenaga Kesehatan</td><td>Jumlah dokter</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah paramedis</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah bidan</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah kader kesehatan</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <tr><td>Kunjungan ke PUSKESMAS</td><td>Jumlah kunjungan ke PUSKESMAS</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <tr><td rowspan="4">Balita</td><td>Jumlah balita</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah balita gizi buruk</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah balita gizi kurang</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah balita ditimbang di Posyandu</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <tr><td>Manula</td><td>Jumlah manula</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <tr><td>Penerima JPS Kesehatan</td><td>Jumlah penerima JPS kesehatan</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <tr><td rowspan="2">Sanitasi</td><td>Jumlah cakupan rumah dengan air bersih</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah cakupan rumah dengan jamban (MCK)</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <!-- Ekonomi -->
            <tr><td rowspan="4">Kondisi Keluarga</td><td>Jumlah Keluarga Pra-Sejahtera/Miskin</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah Keluarga Sejahtera -1</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah Penduduk Miskin</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah Keluarga Penerima Beras Miskin</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <tr><td rowspan="10">Unit Kegiatan Ekonomi</td><td>Jumlah rumah tangga pertanian</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah rumah tangga peternak</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah rumah tangga perikanan</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah rumah tangga perkebunan</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah industri kecil-menengah</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah pedagang kecil-menengah</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah koperasi/lembaga ekonomi masyarakat</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah tempat wisata umum / tempat menarik</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah pasar</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah tambang</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <!-- Sosial dan Agama -->
            <tr><td rowspan="6">Sarana Ibadah</td>
                <td>Jumlah masjid</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah mushola</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah gereja Protestan/rumah kebaktian</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah gereja Katolik/kapel</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah vihara/sejenis</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah pura/sejenis</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <tr><td rowspan="8">Jumlah Lembaga Sosial Masyarakat</td>
                <td>Islam (termasuk Ponpes)</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Katolik</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Protestan</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Budha</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Hindu</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Kepercayaan</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Kepemudaan</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>            <tr><td>Adat istiadat</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <tr><td>Penyandang PMKS</td><td>Jumlah penyandang PMKS</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <!-- Perumahan -->
            <tr><td rowspan="3">Rumah</td><td>Jumlah rumah permanen</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah rumah semi permanen</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah rumah non-permanen</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <!-- Jalan -->
            <tr><td rowspan="3">Jalan</td><td>Panjang jalan negara</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Panjang jalan propinsi</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Panjang jalan kabupaten</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <!-- Bangunan dan Produksi -->
            <tr><td>Bangunan Bersejarah</td><td>Jumlah bangunan bersejarah</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <tr><td rowspan="5">Produksi</td><td>Jumlah produksi komoditas pertanian</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah produksi komoditas industri pengolahan</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Harga produksi (di tingkat produsen)</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Omset pedagang</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah penumpang transportasi</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <!-- Harga -->
            <tr><td rowspan="6">Harga</td><td>Harga konstruksi untuk per M2 untuk rumah</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Harga konstruksi untuk per M2 untuk bangunan gedung</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Harga konstruksi untuk per M2 untuk jalan</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Harga konstruksi untuk per M2 untuk jembatan</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Harga konstruksi untuk per M2 untuk dermaga/pelabuhan</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Harga sewa rumah</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
        </tbody>
    </table>    
    
    <p class="mt-3"><small><strong>Sumber data:</strong> Badan Pusat Statistik (BPS), data daerah (Provinsi, Kab/Kota) dalam angka, data kecamatan/kelurahan serta data OPD terkait</small></p>

    <div class="section-divider"></div>
    
    <h6 class="section-header">2. Formulir Isian Data Sekunder Akibat Bencana (Umum)</h6>
    <table class="table table-bordered form-table two-column-table" border="1">
        <thead class="text-center">
            <tr>
                <th>Pertanyaan</th>
                <th>Jawaban</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sejarah bencana di masa lalu</td>
                <td><textarea class="form-input" rows="3" style="width: 100%; border: none; border-bottom: 1px dotted #999;"></textarea></td>
            </tr>
            <tr>
                <td>Kronologis kejadian bencana saat ini</td>
                <td><textarea class="form-input" rows="3" style="width: 100%; border: none; border-bottom: 1px dotted #999;"></textarea></td>
            </tr>
            <tr>
                <td>Wilayah yang terdampak bencana saat ini</td>
                <td><textarea class="form-input" rows="3" style="width: 100%; border: none; border-bottom: 1px dotted #999;"></textarea></td>
            </tr>
            <tr>
                <td>Jumlah korban meninggal dunia</td>
                <td><input type="text" class="form-input" style="width: 100%;"></td>
            </tr>
            <tr>
                <td>Jumlah korban luka-luka</td>
                <td><input type="text" class="form-input" style="width: 100%;"></td>
            </tr>
            <tr>
                <td>Jumlah korban yang mengunsi</td>
                <td><input type="text" class="form-input" style="width: 100%;"></td>
            </tr>
            <tr>
                <td>Kerusakan dan kerugian yang dialami</td>
                <td><textarea class="form-input" rows="3" style="width: 100%; border: none; border-bottom: 1px dotted #999;"></textarea></td>
            </tr>
        </tbody>
    </table>

    <div class="section-divider"></div>
    
    <h6 class="section-header">3. Formulir Isian Data Sekunder Akibat Bencana (Khusus)</h6>
    <p><strong>Satuan Kerja Perangkat Daerah</strong></p>
    <table class="table table-bordered form-table" border="1">
        <tr>
            <td style="width: 30%;">Nama OPD</td>
            <td>: <input type="text" class="form-input" style="width: calc(100% - 10px);"></td>
        </tr>
        <tr>
            <td>Tgl/Bln/Thn</td>
            <td>: <input type="text" class="form-input" style="width: calc(100% - 10px);"></td>
        </tr>
    </table>
    
    <table class="table table-bordered form-table" style="margin-top: 20px; border: 1px solid #dee2e6;" border="1">
        <thead class="text-center">
            <tr>
                <th style="width: 5%;">No</th>
                <th>POKOK BAHASAN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1</td>
                <td>
                    <strong>Rumah tangga yang terkena bencana dan terganggu kegiatan ekonominya:</strong>
                    <ul>
                        <li class="form-list-item">Pertanian pangan dan sayuran: <input type="text" class="form-input" style="width: 300px;"></li>
                        <li class="form-list-item">Peternakan: <input type="text" class="form-input" style="width: 300px;"></li>
                        <li class="form-list-item">Perikanan: <input type="text" class="form-input" style="width: 300px;"></li>
                        <li class="form-list-item">Perkebunan: <input type="text" class="form-input" style="width: 300px;"></li>
                        <li class="form-list-item">Lainnya: <input type="text" class="form-input" style="width: 300px;"></li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td>
                    <strong>Bentuk gangguan kegiatan ekonomi, pada:</strong>
                    <ul>
                        <li class="form-list-item">Pertanian pangan dan sayuran: berupa <input type="text" class="form-input" style="width: 250px;"></li>
                        <li class="form-list-item">Peternakan: berupa <input type="text" class="form-input" style="width: 250px;"></li>
                        <li class="form-list-item">Perikanan: berupa <input type="text" class="form-input" style="width: 250px;"></li>
                        <li class="form-list-item">Perkebunan: berupa <input type="text" class="form-input" style="width: 250px;"></li>
                        <li class="form-list-item">Lainnya: berupa <input type="text" class="form-input" style="width: 250px;"></li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="text-center">3</td>
                <td>
                    <div class="mb-3">
                        <strong>Jenis produk pertanian lokal khas yang terkena dampak bencana:</strong><br>
                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #999; margin-top: 5px;"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Seberapa berat dampak bencana terhadap produk tersebut:</strong><br>
                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #999; margin-top: 5px;"></textarea>
                    </div>
                    
                    <div>
                        <strong>Kegiatan pemulihan yang dibutuhkan untuk pemulihan produk tersebut:</strong><br>
                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #999; margin-top: 5px;"></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center">4</td>
                <td>
                    <div class="mb-3">
                        <strong>Jumlah organisasi/lembaga pertanian di lokasi bencana yang terkena dampak bencana .... unit.</strong><br>
                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #999; margin-top: 5px;"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Sebutkan bentuk-bentuk organisasi/lembaga tersebut..........</strong><br>
                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #999; margin-top: 5px;"></textarea>
                    </div>
                    
                    <div>
                        <strong>Seberapa berat dampak bencana terhadap organisasi/lembaga pertanian tersebut.......</strong><br>
                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #999; margin-top: 5px;"></textarea>
                    </div>
                    <div>
                        <strong>Kegiatan pemulihan yang dibutuhkan untuk pemulihan organisasi/lembaga pertanian tersebut.......</strong><br>
                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #999; margin-top: 5px;"></textarea>
                    </div>
                    
                </td>
            </tr>
        </tbody>
    </table>
    
    <div class="section-divider"></div>

<h6 class="section-header">4. Formulir Lanjutan: Satuan Kerja Perangkat Daerah</h6>

<p><strong>SATUAN KERJA PERANGKAT DAERAH</strong></p>
<table class="table table-bordered form-table" border="1">
    <tr>
        <td style="width: 30%;">Nama OPD</td>
        <td>: ………………………………………………………………………………………………………………………………………<br>
            <em>(OPD yang terkait dengan Bidang Non Pertanian: Perdagangan, Perindustrian, Koperasi, Usaha Kecil Menengah dll)</em>
        </td>
    </tr>
    <tr>
        <td>Tgl/Bln/Thn</td>
        <td>: ………………………………………………………………………………………………………………………………………</td>
    </tr>
</table>

<table class="table table-bordered form-table" border="1" style="margin-top: 20px;">
    <thead class="text-center">
        <tr>
            <th style="width: 5%;">NO</th>
            <th>POKOK BAHASAN</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center">1</td>
            <td>
                Rumah tangga yang <strong>terkena bencana</strong> dan <strong>terganggu kegiatan ekonominya:</strong><br>
                Perdagangan kecil : …………………………………………<br>
                Perdagangan menengah : …………………………………………<br>
                Perdagangan besar : …………………………………………<br>
                Industri kecil (rakyat) : …………………………………………<br>
                Industri menengah : …………………………………………<br>
                <em>Lanjutan:</em><br>
                Industri besar : …………………………………………<br>
                Koperasi : …………………………………………<br>
                Lainnya ...... : …………………………………………
            </td>
        </tr>
        <tr>
            <td class="text-center">2</td>
            <td>
                Bentuk gangguan kegiatan ekonomi, pada:<br>
                Perdagangan kecil : berupa …………………………………………………………………………<br>
                Perdagangan menengah : berupa …………………………………………………………………………<br>
                Perdagangan besar : berupa …………………………………………………………………………<br>
                Industri kecil-menengah : berupa …………………………………………………………………………<br>
                Industri besar : berupa …………………………………………………………………………<br>
                Lainnya : berupa ...........<br>
            </td>
        </tr>
        <tr>
            <td class="text-center">3</td>
            <td>
                Jenis produk industri lokal khas yang terkena dampak bencana:<br>
                ……………………………………………………………………………………………………………………<br>
                ……………………………………………………………………………………………………………………<br><br>
                Seberapa berat dampak bencana terhadap produk tersebut:<br>
                ……………………………………………………………………………………………………………………<br>
                ……………………………………………………………………………………………………………………<br><br>
                Kegiatan yang dibutuhkan untuk pemulihan produk tersebut:<br>
                ……………………………………………………………………………………………………………………<br>
                ……………………………………………………………………………………………………………………
            </td>
        </tr>
        <tr>
            <td class="text-center">4</td>
            <td>
                Jumlah organisasi/lembaga koperasi di lokasi bencana yang terkena dampak bencana<br>
                …………………………… unit.<br><br>
                Seberapa berat dampak bencana terhadap organisasi/lembaga koperasi tersebut<br>
                ……………………………………………………………………………………………………………………<br><br>
                Kegiatan pemulihan yang dibutuhkan untuk pemulihan organisasi/lembaga koperasi tersebut<br>
                ……………………………………………………………………………………………………………………
            </td>
        </tr>
    </tbody>
</table>

<p class="mt-3"><em>Catatan: perlunya menjabarkan batasan operasional/pengertian dari setiap istilah:</em><br>
Perdagangan kecil adalah …<br>
Perdagangan besar adalah …<br>
Industri kecil adalah …<br>
Industri besar adalah ….
</p>

<div class="section-divider"></div>

        <p><strong>SATUAN KERJA PERANGKAT DAERAH</strong></p>
        <table class="table table-bordered form-table" border="1">
            <tr>
                <td style="width: 30%;">Nama OPD</td>
                <td>: ………………………………………………………………………………………………………………………………………<br>
                    <em>(OPD yang terkait dengan Bidang Sosial dan Keagamaan)</em>
                </td>
            </tr>
            <tr>
                <td>Tgl/Bln/Thn</td>
                <td>: ………………………………………………………………………………………………………………………………………</td>
            </tr>
        </table>

        <table class="table table-bordered form-table" border="1" style="margin-top: 20px;">
            <thead class="text-center">
                <tr>
                    <th style="width: 5%;">NO</th>
                    <th>POKOK BAHASAN</th>
                </tr>
            </thead>
            <tbody>
                <tr><td class="text-center">1</td><td>Jumlah rumah tangga yang kehilangan akses terhadap naungan yang layak (rumah rusak berat dan rusak sedang)</td></tr>
                <tr><td class="text-center">2</td><td>Jumlah penyandang cacat akibat bencana ....<br>
                     Kegiatan yang dibutuhkan untuk membantu rehabilitasi penyandang cacat akibat bencana.......</td></tr>
                <tr><td class="text-center">3</td><td>Kegiatan agama, sosial kemasyarakatan yang terkena dampak bencana : <br>
                jelaskan............</td></tr>
                <tr><td class="text-center">4</td><td>Penggerak kegiatan masyarakat tersebut : <br>
                ..............................</td></tr>
                <tr><td class="text-center">5</td><td>Kondisi Keberfungsian kegiatan masyarakat tersebut setelah mengalami bencana.....<br>
                Kegiatan yang dubutuhkan untuk pemulihan kegiatan tersebut..................</td></tr>
                <tr><td class="text-center">6</td><td>Adakah permasalahan sosial akibat bencana?<br>
                Jelaskan<br>
                .................<br>
                Kegiatan yang dibutuhkan untuk pengurangan permasalahan sosial tersebut<br>
                .....................................</td>
                </tr>
                <tr><td class="text-center">7</td><td>Adakah pengetahuan/kearifan lokal yang dapat digunakan untuk mengurangi resiko akibat bencana?<br>
                Jelaskan<br>
                ...............................................</td></tr>
            </tbody>
        </table>


<div class="section-divider"></div>

<p><strong>SATUAN KERJA PERANGKAT DAERAH</strong></p>
<table class="table table-bordered form-table" border="1">
    <tr>
        <td style="width: 30%;">Nama OPD</td>
        <td>: ………………………………………………………………………………………………………………………………………<br>
            <em>(OPD yang terkait dengan Pendidikan)</em>
        </td>
    </tr>
    <tr>
        <td>Tgl/Bln/Thn</td>
        <td>: ………………………………………………………………………………………………………………………………………</td>
    </tr>
</table>

<table class="table table-bordered form-table" border="1" style="margin-top: 20px;">
    <thead class="text-center">
        <tr>
            <th style="width: 5%;">NO</th>
            <th>POKOK BAHASAN</th>
        </tr>
    </thead>
    <tbody>
        <tr><td class="text-center">1</td><td>Permasalahan umum yang menghambat pelaksanaan pendidikan pada masa sebelum bencana. (dari faktor pemberi layanan, penduduk, infrastruktur maupun bentang alam).........</td></tr>
        <tr><td class="text-center">2</td><td>Adakah indikasi siswa dan/atau guru terkena trauma setelah bencana?:..........<br>
Berapa jumlah/persentase diantara mereka yang terindikasi mengalami trauma?..........</td></tr>
        <tr><td class="text-center">3</td><td>Permasalahan pendidikan akibat bencana?
Jelaskan..........................<br>
Kegiatan yang dibutuhkan untuk pengurangan permasalahan tersebut.....................<br>
Jumlah sasaran........</td></tr>
        <tr><td class="text-center">4</td><td>Jumlah guru yang meninggal/berpindah setelah bencana :......<br>
Kegiatan yang dibutuhkan untuk mengatasi permasalahan guru yang meninggal/berpindah..................</td></tr>
    </tbody>
</table>

<div class="section-divider"></div>

<p><strong>SATUAN KERJA PERANGKAT DAERAH</strong></p>
<table class="table table-bordered form-table" border="1">
    <tr>
        <td style="width: 30%;">Nama OPD</td>
        <td>: ………………………………………………………………………………………………………………………………………<br>
            <em>(OPD Sekretariat Daerah)</em>
        </td>
    </tr>
    <tr>
        <td>Tgl/Bln/Thn</td>
        <td>: ………………………………………………………………………………………………………………………………………</td>
    </tr>
</table>

<table class="table table-bordered form-table" border="1" style="margin-top: 20px;">
    <thead class="text-center">
        <tr>
            <th style="width: 5%;">NO</th>
            <th>POKOK BAHASAN</th>
        </tr>
    </thead>
    <tbody>
        <tr><td class="text-center">1</td><td>Jumlah Rukun Tetangga/Rukun Warga/Kelurahan,Kecamatan yang teranggu akibat bencana ..............<br>
        Jenis gangguan..........<br>
        Kebutuhan dukungan untuk pemulihan .................</td></tr>
        <tr><td class="text-center">2</td><td>Adakah komunitas desa yang memiliki sistem pemeliharaan dan sarana desa?: Bila ada jelaskan :...........<br>
        Apakah sistem tersebut terganggu akibat bencana? <br>
        Jelaskan..................................</td></tr>
        <tr><td class="text-center">3</td><td>Adakah komunitas desa yang memiliki ketahanan pangan desa (lumbung dll) ?: Bila ada jelaskan :......<br>
Apakah sistem tersebut terganggu akibat bencana? Jelaskan......</td></tr>
        <tr><td class="text-center">4</td><td>Jumlah penduduk/keluarga yang kehilangan surat-surat penting (sertifikat tanah, KTP dan lain sebagainya).....<br>
Kegiatan yang dibutuhkan untuk mengatasi hal tersebut.........</td></tr>
        <tr><td class="text-center">5</td><td>Apakah pemerintah daerah memiliki rencana kontingensi untuk permasalahan administrasi penduduk? : Jelaskan.........<br>
Kegiatan yang dibutuhkan untuk pengurangan permasalahan tersebut.........</td></tr>
        <tr><td class="text-center">6</td><td>Jumlah pegawai pemerintah yang meninggal/berpindah :........<br>
Dukungan yang dibutuhkan untuk mengatasi permasalahan tersebut:.........</td></tr>
    </tbody>
</table>

<div class="section-divider"></div>

<p><strong>SATUAN KERJA PERANGKAT DAERAH</strong></p>
<table class="table table-bordered form-table" border="1">
    <tr>
        <td style="width: 30%;">Nama OPD</td>
        <td>: ………………………………………………………………………………………………………………………………………<br>
            <em>(Dinas Kesehatan)</em>
        </td>
    </tr>
    <tr>
        <td>Tgl/Bln/Thn</td>
        <td>: ………………………………………………………………………………………………………………………………………</td>
    </tr>
</table>

<table class="table table-bordered form-table" border="1" style="margin-top: 20px;">
    <thead class="text-center">
        <tr><th>NO</th><th>POKOK BAHASAN</th></tr>
    </thead>
    <tbody>
        <tr><td class="text-center">1</td><td>Permasalahan umum yang menghambat pelaksanaan pelayanan kesehatan pada masa sebelum bencana. (dari faktor pemberi layanan, penduduk, infrastruktur maupun bentang alam).......</td></tr>
        <tr><td class="text-center">2</td><td>Adakah indikasi penduduk trauma setelah bencana?:........<br>
                                                Berapa jumlah/persentase diantara mereka yang terindikasi mengalami trauma?......</td></tr>        <tr><td class="text-center">3</td><td>Adakah program/kegiatan kesehatan masal dalam penanggulangan dampak bencana? Jelaskan
                                            <input type="text" name="program_kesehatan_masal" class="form-input" style="width: 70%; display: inline-block;"></td></tr>
        <tr><td class="text-center">4</td><td>Permasalahan kesehatan yang umum akibat bencana?: Jelaskan <input type="text" name="permasalahan_kesehatan" class="form-input" style="width: 60%; display: inline-block;"> 
                                            Kegiatan yang dibutuhkan untuk pengurangan permasalahan tersebut <input type="text" name="kegiatan_permasalahan_kesehatan" class="form-input" style="width: 60%; display: inline-block;"></td></tr>
        <tr><td class="text-center">5</td><td>Adakah program pemberian makanan tambahan untuk balita/ anak sekolah? : Jelaskan <input type="text" name="program_makanan_tambahan" class="form-input" style="width: 70%; display: inline-block;"></td></tr>        <tr><td class="text-center">6</td><td>Jumlah balita yang terdampak bencana <input type="number" name="jumlah_balita_terdampak" class="form-input" style="width: 100px; display: inline-block;"><br>
                                                Jelaskan dampak bencana terhadap balita <input type="text" name="dampak_balita" class="form-input" style="width: 60%; display: inline-block;"><br>
                                                Kegiatan yang dibutuhkan untuk mengatasi dampak bencana terhadap balita <input type="text" name="kegiatan_balita" class="form-input" style="width: 60%; display: inline-block;"></td></tr>        <tr><td class="text-center">7</td><td>Jumlah ibu hamil yang terdampak bencana <input type="number" name="jumlah_ibu_hamil_terdampak" class="form-input" style="width: 100px; display: inline-block;"><br>
                                            Jelaskan dampak bencana terhadap ibu hamil <input type="text" name="dampak_ibu_hamil" class="form-input" style="width: 60%; display: inline-block;">
                                            Kegiatan yang dibutuhkan untuk mengatasi dampak bencana terhadap ibu hamil <input type="text" name="kegiatan_ibu_hamil" class="form-input" style="width: 60%; display: inline-block;"></td></tr>        <tr><td class="text-center">8</td><td>Jumlah lansia yang terdampak bencana <input type="number" name="jumlah_lansia_terdampak" class="form-input" style="width: 100px; display: inline-block;">
                                            Jelaskan dampak bencana terhadap lansia <input type="text" name="dampak_lansia" class="form-input" style="width: 60%; display: inline-block;">
                                            Kegiatan yang dibutuhkan untuk mengatasi dampak bencana terhadap lansia <input type="text" name="kegiatan_lansia" class="form-input" style="width: 60%; display: inline-block;"></td></tr>        <tr><td class="text-center">9</td><td>Perkiraan dampak kesehatan jangka menengah akibat bencana <br>
                                            Jelaskan <input type="text" name="dampak_kesehatan_menengah" class="form-input" style="width: 70%; display: inline-block;">
                                            Kegiatan yang dibutuhkan untuk pengurangan permasalahan tersebut <input type="text" name="kegiatan_dampak_kesehatan" class="form-input" style="width: 60%; display: inline-block;"></td></tr>        <tr><td class="text-center">10</td><td>Adakah rencana kontingensi terkait bidang kesehatan dalam mengurangi risiko akibat bencana?
                                            Jelaskan <input type="text" name="rencana_kontingensi_kesehatan" class="form-input" style="width: 70%; display: inline-block;"></td></tr>
    </tbody>
</table>

@endsection
