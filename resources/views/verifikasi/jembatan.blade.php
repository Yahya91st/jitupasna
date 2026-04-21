@extends('layouts.main')
@section('content')
<style>
    .style-input-1 {
        width: 60%;
        margin-left: auto;
    } 
    .parent-input-1 {
        display: flex;
    }
</style>

<section id="verifikasi-infrastruktur">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Formulir Verifikasi Lapangan Sektor Infrastruktur (Jembatan)</h1>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <p> )* Coret yang tidak perlu</p>
                                    <p>)** Centang (√) salah satu</p>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="kabupaten">Kabupaten/Kota)*</label>
                                            <input type="text" id="kabupaten" name="kabupaten" class="style-input-1 form-control d-inline" >
                                        </td>
                                        <td class="col-4">
                                            <label for="kabupaten_img">Gambar</label>
                                            <input type="file" id="kabupaten_img" name="kabupaten_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_img" src="" alt="Preview Gambar" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="kecamatan">Kecamatan/Distrik)*</label>
                                            <input type="text" id="kecamatan" name="kecamatan" class="style-input-1 form-control style-input-1 d-inline d-inline">
                                        </td>                                                           
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="kelurahan">Kel/Desa/Dusun)*</label>
                                            <input type="text" id="kelurahan" name="kelurahan" class="form-control style-input-1 d-inline">
                                            <label for="rt/rw">
                                                RT: <input type="number" id="rt" name="rt" class="form-control style-input-1 d-inline" placeholder="RT">
                                                <br>
                                                RW: <input type="number" id="rw" name="rw" class="form-control style-input-1 d-inline" placeholder="RW">
                                            </label>
                                        </td>  
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="koordinat">Koordinat</label>
                                            <input type="text" id="koordinat" name="koordinat" class="form-control style-input-1 d-inline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="sub_sektor">Sub Sektor)**</label>
                                            <select name="sub_sektor" id="sub_sektor" class="form-control style-input-1 d-inline">
                                                <option value="">Pilih Sub Sektor</option>
                                                <option value="Transportasi Darat">Transportasi Darat</option>
                                                <option value="Transportasi Air">Transportasi Air</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="jenis_asset">Jenis Asset)**</label>
                                            <select id="jenis_asset" name="jenis_asset" class="form-control style-input-1 d-inline">
                                                <option value="">Pilih Jenis Asset</option>
                                                <option value="Jembatan Nasional">Jembatan Nasional</option>
                                                <option value="Jembatan Propinsi">Jembatan Propinsi</option>
                                                <option value="Jembatan Kab/Kota">Jembatan Kab/Kota</option>
                                                <option value="Jembatan Swasta">Jembatan Swasta</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="nama_jembatan">Nama Jembatan</label>
                                            <input type="text" id="nama_jembatan" name="nama_jembatan" class="form-control style-input-1 d-inline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="lebar_jembatan">Lebar Jembatan</label>
                                            <input type="number" id="lebar_jembatan" name="lebar_jembatan" class="form-control style-input-1 d-inline">
                                            <span class="input-group-text">M</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="panjang_jembatan">Panjang Jembatan</label>
                                            <input type="number" id="panjang_jembatan" name="panjang_jembatan" class="form-control style-input-1 d-inline">
                                            <span class="input-group-text">M/KM</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="jumlah_ruas">Jumlah Ruas</label>
                                            <input type="number" id="jumlah_ruas" name="jumlah_ruas" class="form-control style-input-1 d-inline"> <span class="input-group-text">Ruas</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="harga_satuan">Harga Satuan</label>
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" id="harga_satuan" name="harga_satuan" class="form-control style-input-1 d-inline">
                                        </td>
                                    </tr>
                                    </table>
                                    <table class="table table-bordered">
                                    <tr>
                                        <td colspan="4">
                                            <p>                                            
                                                Data Kerusakan Spot
                                            </p>                                            
                                        </td>
                                        <td>
                                            Bobot (%)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            Bagian Timbunan)**
                                        </td>
                                        <td class="radio-inline" colspan="3">
                                            <input type="radio" id="badan_jalan_1" name="jenis_kerusakan_badan_jalan" value="badan_jalan_1" class="d-inline">
                                            <label for="badan_jalan_1">
                                                Oprit amblas; sebagian tidak berfungsi dan sebagian masih berfungsi untuk dilalui oleh kendaraan
                                            </label>
                                        </td>
                                        <td>
                                            <input type="radio" id="badan_jalan_1_bobot" name="jenis_kerusakan_badan_jalan_bobot" value="25" class="d-inline">
                                            <label for="badan_jalan_1_bobot">4</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="radio-inline" colspan="3">
                                            <input type="radio" id="badan_jalan_2" name="jenis_kerusakan_badan_jalan" value="badan_jalan_2" class="d-inline">
                                            <label for="badan_jalan_2">
                                                Oprit longsor; tidak dapat berfungsi menyambungkan jalan dan atau jembatan
                                            </label>                                            
                                        </td>
                                        <td>
                                            <input type="radio" id="badan_jalan_2_bobot" name="jenis_kerusakan_badan_jalan_bobot" value="50" class="d-inline">
                                            <label for="badan_jalan_2_bobot">5</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">
                                            Bagian Bawah Jembatan)**
                                        </td>
                                        <td colspan="3" class="radio-inline">
                                            <input type="radio" id="bahu_jalan_1" name="bahu_jalan" value="bahu_jalan_1" class="d-inline">
                                            <label for="bahu_jalan_1">
                                                Tembok sayap jembatan retak menyeluruh; masih dapat menopang bagian atas jembatan
                                            </label>
                                        </td>
                                        <td>
                                            <input type="radio" id="bahu_jalan_1_bobot" name="bahu_jalan_bobot" value="10" class="d-inline">
                                            <label for="bahu_jalan_1_bobot">10</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="radio-inline">
                                            <input type="radio" id="bahu_jalan_2" name="bahu_jalan" value="bahu_jalan_2" class="d-inline">
                                            <label for="bahu_jalan_2">
                                                Pada jembatan lengkung; pelengkung roboh atau hancur tidak dapat menopang lantai jembatan
                                            </label>
                                        </td>
                                        <td>
                                            <input type="radio" id="bahu_jalan_2_bobot" name="bahu_jalan_bobot" value="15" class="d-inline">
                                            <label for="bahu_jalan_2_bobot">20</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="radio-inline">
                                            <input type="radio" id="bahu_jalan_2" name="bahu_jalan" value="bahu_jalan_2" class="d-inline">
                                            <label for="bahu_jalan_2">
                                                Abutment retak pada bagian struktur; masih dapat menopang bagian atas jembatan
                                            </label>
                                        </td>
                                        <td>
                                            <input type="radio" id="bahu_jalan_2_bobot" name="bahu_jalan_bobot" value="15" class="d-inline">
                                            <label for="bahu_jalan_2_bobot">50</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="radio-inline">
                                            <input type="radio" id="bahu_jalan_2" name="bahu_jalan" value="bahu_jalan_2" class="d-inline">
                                            <label for="bahu_jalan_2">
                                                Abutment roboh atau miring; tidak dapat menopang bagian atas jembatan
                                            </label>
                                        </td>
                                        <td>
                                            <input type="radio" id="bahu_jalan_2_bobot" name="bahu_jalan_bobot" value="15" class="d-inline">
                                            <label for="bahu_jalan_2_bobot">75</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="radio-inline">
                                            <input type="radio" id="bahu_jalan_2" name="bahu_jalan" value="bahu_jalan_2" class="d-inline">
                                            <label for="bahu_jalan_2">
                                                Pondasi atau pilar roboh atau miring; posisi jembatan tidak stabil
                                            </label>
                                        </td>
                                        <td>
                                            <input type="radio" id="bahu_jalan_2_bobot" name="bahu_jalan_bobot" value="15" class="d-inline">
                                            <label for="bahu_jalan_2_bobot">80</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">
                                            Bagian Atas Jembatan)**
                                        </td>
                                        <td colspan="3" class="radio-inline">
                                            <input type="radio" id="drainase_1" name="drainase" value="drainase_1" class="d-inline">
                                            <label for="drainase_1">
                                                Lantai jembatan retak dan atau berlubang; masih mampu dilalui kendaraan melalui rekayasa lalu lintas
                                            </label>
                                        </td>
                                        <td>
                                            <input type="radio" id="drainase_1_bobot" name="drainase_bobot" value="5" class="d-inline">
                                            <label for="drainase_1_bobot">10</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="radio-inline">
                                            <input  type="radio" id="drainase_2" name="drainase" value="drainase_2" class="d-inline">
                                            <label for="drainase_2">
                                                Lantai jembatan putus atau roboh; tidak dapat dilalui oleh kendaraan roda empat dan atau roda dua
                                            </label>
                                        </td>
                                        <td>
                                            <input type="radio" id="drainase_2_bobot" name="drainase_bobot" value="50" class="d-inline">
                                            <label for="drainase_2_bobot">15</label>
                                        </td>
                                    </tr>                         
                                </table>

                                <table class="table table-bordered">
                                    <tr>
                                        <td>
                                            <h1>
                                                Data Kerugian Akibat Bencana
                                            </h1>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                                Pembersihan material atau puing akibat bencana
                                            </h2>
                                        </td>
                                    </tr>               
                                    <tr>
                                        <td>
                                            <div>
                                                Jumlah alat yang dibutuhkan <input type="number" name="jumlah_alat" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> Unit,
                                            </div>
                                            <div>
                                                harga sewa alat Rp <input type="number" name="harga_sewa_alat" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> per jam/hari)*
                                            </div>
                                            <div>
                                                waktu yang diperlukan untuk pembersihan material atau puing <input type="number" name="waktu_pembersihan" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> hari
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                Jumlah tenaga kerja yang dibutuhkan <input type="number" name="jumlah_tenaga_kerja" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> Orang, 
                                            </div>
                                            <div>
                                                harga upah Rp <input type="number" name="harga_upah" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> Orang/Hari
                                            </div>
                                            <div>
                                                waktu yang diperlukan untuk pembersihan material atau puing <input type="number" name="waktu_pembersihan" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> hari  
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>Peningkatan biaya operasional atau biaya transportasi untuk pengguna transportasi</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!-- bagian 1 -->
                                            <div>
                                                Jumlah LHR kendaraan roda dua <input type="number" name="jumlah_fasilitas" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> Unit,
                                            </div>
                                            <div>
                                                penambahan jarak tempuh sepanjang <input type="number" name="harga_fasilitas" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> Km 
                                            </div>
                                            <div>
                                                pemakaian BBM rata-rata <input type="number" name="waktu_fasilitas" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> Liter/Km/Hari
                                            </div>
                                            <div>
                                                harga BBM Rp<input type="number" name="jumlah_bangunan" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> per Liter, 
                                            </div>
                                            <div>
                                                waktu yang diperlukan untuk pemulihan prasarana transportasi <input type="number" name="luas_bangunan" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> bulan 
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>                                            
                                            <!-- bagian 2 -->
                                            <div>
                                                Jumlah LHR kendaraan roda empat 
                                                <input type="text" name="jumlah_kendaraan_roda_empat" class="form-control d-inline-block" style="width:100px;display:inline-block;"> 
                                                Unit
                                            </div>
                                            <div>
                                                penambahan jarak tempuh sepanjang <input type="text" name="penambahan_jarak_tempuh" class="form-control d-inline-block" style="width:100px;display:inline-block;"> Km
                                            </div>
                                            <div>
                                                pemakaian BBM rata-rata <input type="text" name="pemakaian_bbm" class="form-control d-inline-block" style="width:100px;display:inline-block;"> Liter/Km/Hari,
                                            </div>
                                            <div>
                                                harga BBM Rp <input type="text" name="harga_bbm" class="form-control d-inline-block" style="width:100px;display:inline-block;"> per Liter,
                                            </div>
                                            <div>
                                                waktu yang diperlukan untuk pemulihan prasarana transportasi <input type="text" name="waktu_pemulihan" class="form-control d-inline-block" style="width:100px;display:inline-block;"> bulan
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>

                                            <!-- bagian 3 -->
                                            <div>
                                                Jumlah penumpang rata-rata <input type="text" name="jumlah_penumpang" class="form-control d-inline-block" style="width:100px;display:inline-block;"> Orang/Hari
                                            </div>
                                            <div>
                                                peningkatan biaya transportasi Rp <input type="text" name="peningkatan_biaya" class="form-control d-inline-block" style="width:150px;display:inline-block;">
                                            </div>
                                            <div>
                                                waktu yang diperlukan untuk pemulihan prasarana transportasi <input type="text" name="waktu_pemulihan" class="form-control d-inline-block" style="width:100px;display:inline-block;"> bulan
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!-- bagian 4 -->
                                            <div>
                                                Jumlah kendaraan <input type="text" name="jumlah_kendaraan" class="form-control d-inline-block" style="width:100px;display:inline-block;"> Unit,
                                            </div>
                                            <div>
                                                rata-rata service kendaraan <input type="text" name="rata_rata_service" class="form-control d-inline-block" style="width:100px;display:inline-block;"> kali per bulan/tahun)* 
                                            </div>
                                            <div>
                                                biaya rata-rata service kendaraan Rp <input type="text" name="biaya_rata_rata_service" class="form-control d-inline-block" style="width:150px;display:inline-block;">
                                            </div>
                                            <div>
                                                waktu yang diperlukan untuk pemulihan prasarana transportasi <input type="text" name="waktu_pemulihan" class="form-control d-inline-block" style="width:100px;display:inline-block;"> bulan/tahun)*
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>Kehilangan pendapatan atau pendapatan yang tidak jadi didapatkan bagi penyedia jasa transportasi darat/laut/udara)* akibat armada tidak beroperasi</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                Jumlah Kendaraan 
                                                <input type="number" name="jumlah_kehilangan" class="form-control d-inline-block" style="width:100px;display:inline-block;" min="0">
                                                Unit,
                                            </div>
                                            <div>
                                                pendapatan rata-rata per hari Rp
                                                <input type="number" name="pendapatan_rata_rata" class="form-control d-inline-block" style="width:120px;display:inline-block;" min="0">
                                            </div>
                                            <div>
                                                lama kehilangan pendapatan
                                                <input type="number" name="lama_kehilangan" class="form-control d-inline-block" style="width:80px;display:inline-block;" min="0"> 
                                                hari
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                Jumlah Ojeg
                                                <input type="number" name="jumlah_sewa" class="form-control d-inline-block" style="width:80px;display:inline-block;" min="0">
                                                Unit
                                            </div>
                                            <div>
                                                pendapatan rata-rata per hari Rp
                                                <input type="number" name="nilai_sewa" class="form-control d-inline-block" style="width:120px;display:inline-block;" min="0">
                                            </div>
                                            <div>
                                                lama kehilangan pendapatan
                                                <input type="number" name="lama_kehilangan_sewa" class="form-control d-inline-block" style="width:80px;display:inline-block;" min="0">
                                                hari
                                            </div>                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                                Biaya Pemasangan Infrastruktur Darurat atau Sementara
                                            </h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                Jumlah jembatan  
                                                <input type="text" name="panjang_jalan_darurat" class="form-control d-inline-block" style="width:100px;display:inline-block;">
                                                Unit 
                                            </div>
                                            <div>
                                                harga satuan Rp
                                                <input type="text" name="harga_satuan" class="form-control d-inline-block" style="width:150px;display:inline-block;">
                                                /unit  
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                                Kerugian lainnya
                                            </h2>
                                            <textarea name="kerugian_lainnya" id="kerugian_lainnya" class="form-control"></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <div align="right">
                                    <input type="date" name="tanggal_verifikasi" class="form-control d-inline-block" style="width:200px;display:inline-block;" min="0">
                                </div>
                                <div align="right">
                                    Petugas Verifikasi, <input type="text" name="petugas_verifikasi" class="form-control d-inline-block" style="width:200px;display:inline-block;">                                
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview_img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}
</script>
</section>
@endsection