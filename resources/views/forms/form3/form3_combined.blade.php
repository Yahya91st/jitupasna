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
            <tr><td rowspan="3">Kondisi Keluarga</td><td>Jumlah Keluarga Pra-Sejahtera/Miskin</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah Keluarga Sejahtera -1</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>
            <tr><td>Jumlah Penduduk Miskin</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

            <tr><td>Kondisi Ekonomi</td><td>Jumlah Keluarga Penerima Beras Miskin</td><td><input type="text" class="form-input" style="width: 100%;"></td></tr>

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
        </tbody>
    </table>
    
    <div class="row mt-5">
        <div class="col-md-6">
            <p>Mengetahui,</p>
            <p>Kepala OPD</p>
            <div style="height: 80px;"></div>
            <p class="mb-0"><input type="text" class="form-input" style="width: 300px;" placeholder="Nama Lengkap"></p>
            <p><input type="text" class="form-input" style="width: 300px;" placeholder="NIP/Jabatan"></p>
        </div>
        <div class="col-md-6 text-right">
            <p>..........................., <input type="text" class="form-input" style="width: 150px;" placeholder="Tanggal"></p>
            <p>Petugas,</p>
            <div style="height: 80px;"></div>
            <p class="mb-0"><input type="text" class="form-input" style="width: 300px;" placeholder="Nama Lengkap"></p>
            <p><input type="text" class="form-input" style="width: 300px;" placeholder="NIP/Jabatan"></p>
        </div>
    </div>
</div>
@endsection
