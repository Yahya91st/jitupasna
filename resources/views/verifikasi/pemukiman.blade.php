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

<section id="verifikasi-pemukiman">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Formulir Verifikasi Lapangan Sektor Permukiman</h1>
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
                                                <option value="Perumahan">Perumahan</option>
                                                <option value="Prasarana Sosial Masyarakat">Prasarana Sosial Masyarakat</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="jenis_asset">Jenis Asset)**</label>
                                            <select id="jenis_asset" name="jenis_asset" class="form-control style-input-1 d-inline">
                                                <option value="">Pilih Jenis Asset</option>
                                                <option value="Rumah Permanen">Rumah Permanen</option>
                                                <option value="Rumah Semi Permanen">Rumah Semi Permanen</option>
                                                <option value="Rumah Non Permanen">Rumah Non Permanen</option>
                                                <option value="Balai Pertemuan Warga">Balai Pertemuan Warga</option>
                                                <option value="Pos Keamanan">Pos Keamanan</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="nama_pemilik">Nama Pemilik</label>
                                            <input type="text" id="nama_pemilik" name="nama_pemilik" class="form-control style-input-1 d-inline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="fungsi_lain">Fungsi Lain Bangunan)**</label>
                                            <select name="fungsi_lain" id="fungsi_lain" class="form-control style-input-1 d-inline">
                                                <option value="">Pilih Fungsi Lain</option>
                                                <option value="Tempat Kost/Kontrakan">Tempat Kost/Kontrakan</option>
                                                <option value="Warung">Warung</option>
                                                <option value="Industri Rumah">Industri Rumah</option>
                                                <option value="Salon">Salon</option>
                                                <option value="Counter Hp">Counter Hp</option>
                                                <option value="Usaha Lainnya">Usaha Lainnya</option>
                                            </select>                                    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="luas">Luas )**</label>
                                            <select name="luas" id="luas" class="form-control style-input-1 d-inline">
                                                <option value="">Pilih Luas</option>
                                                <option value="36">36</option>
                                                <option value="45">45</option>
                                                <option value="54">54</option>
                                                <option value="63">63</option>
                                                <option value="70">70</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="jumlah_asset">Jumlah Asset</label>
                                            <input type="number" id="jumlah_asset" name="jumlah_asset" class="form-control style-input-1 d-inline"> <span class="input-group-text">unit</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="jumlah_lantai">Jumlah Lantai)**</label>
                                            <select name="jumlah_lantai" id="jumlah_lantai" class="form-control style-input-1 d-inline">
                                                <option value="">Pilih Jumlah Lantai</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="harga_satuan">Harga Satuan</label>
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" id="harga_satuan" name="harga_satuan" class="form-control style-input-1 d-inline">
                                            <p class="form-text text-muted">harga satuan setempat per m2/satuan lainnya</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="parent-input-1">
                                            <label for="keterangan_lain">Keterangan lain</label>
                                            <input type="text" id="keterangan_lain" name="keterangan_lain" class="form-control style-input-1 d-inline">
                                        </td>
                                    </tr>
                                    </table>
                                    <table>
                                    <tr>
                                        <td colspan="5">
                                            <p>                                            
                                                Data Kerusakan Akibat Bencana                                        
                                            </p>                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bagian Bangunan</td>
                                        <td>Jenis Kerusakan</td>
                                        <td>Jml</td>
                                        <td>Bobot (%)</td>
                                        <td>Foto</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">

                                            Pondasi/Sloof)**
                                        </td>
                                        <td>
                                            Retak terlihat jelas pada permukaan beton (lebar retakan kira-kira 1-2 mm)
                                        </td>
                                        <td>
                                            <select name="jml_pondasi" id="jml_pondasi">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_pondasi" id="bobot_pondasi">
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Kehancuran beton yang sangat nyata dengan tulangan beton terlihat
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="5">5</option>
                                                <option value="8">8</option>
                                                <option value="11">11</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Penurunan dan atau pondasi hancur
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="11">11</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">
                                            Kolom/Balok)**
                                        </td>
                                        <td>
                                            Retak rambut terlihat jelas pada permukaan beton (lebar retakan kira-kira 0,2-1 mm)
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="7">7</option>
                                                <option value="9">9</option>
                                                <option value="11">11</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Retakan yang sangat jelas (lebar retakan kira-kira 1-2 mm)
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="7">7</option>
                                                <option value="9">9</option>
                                                <option value="11">11</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Kehancuran beton, tulangan tertekuk, dan atau deformasi pada kolom dapat terlihat 
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="12">12</option>
                                                <option value="26">26</option>
                                                <option value="35">35</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            Rangka Atap/Kuda-kuda)**
                                        </td>
                                        <td>
                                            Reng dan atau usuk hancur sebagian atau seluruh
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="3">3</option>
                                                <option value="5">5</option>
                                                <option value="11">11</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Kuda-kuda roboh sebagian atau seluruh
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="11">11</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Penutup Atap/Genteng)**
                                        </td>
                                        <td>
                                            Berjatuhan menyebar sebagian atau seluruh
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="≥2">≥2</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">
                                            Dinding)**
                                        </td>
                                        <td>
                                            Plesteran dan atau terkelupas
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Retakan dapat terlihat jelas, tembus pada pasangan batu
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="5">5</option>
                                                <option value="8">8</option>
                                                <option value="11">11</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Dinding jatuh sebagian atau menyeluruh
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="11">11</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">
                                            Lantai)**
                                        </td>
                                        <td>
                                            Retak rambut menyebar sebagian atau seluruh
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Retak besar/terbelah/hancur menyebar sebagian atau seluruh
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Dinding jatuh sebagian atau menyeluruh
                                        </td>
                                        <td>
                                            <select name="jml_kolom" id="jml_kolom">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">≥3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="bobot_kolom" id="bobot_kolom">
                                                <option value="11">11</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" id="pondasi_img" name="pondasi_img" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img id="preview_pondasi" src="" alt="Preview Gambar Pondasi" style="display:none; max-width: 200px; margin-top: 10px;">
                                        </td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td colSpan="4">Data Kerusakan Isi Rumah</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Asset)**</td>
                                        <td>
                                            <select name="jenis_asset" id="jenis_asset" class="form-control">
                                                <option value="">Pilih Jenis Asset</option>
                                                <option value="Isi Rumah Permanen">Isi Rumah Permanen</option>
                                                <option value="Isi Rumah Semi Permanen">Isi Rumah Semi Permanen</option>
                                                <option value="Isi Rumah Non Permanen">Isi Rumah Non Permanen</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Isi Rumah</td>
                                        <td>
                                            <input type="text" name="nama_isi_rumah" id="nama_isi_rumah" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td>
                                            <input type="number" name="jml_isi_rumah" id="jml_isi_rumah" class="form-control" min="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-3">Harga Satuan</td>
                                        <td>
                                            <input type="number" name="harga_satuan" id="harga_satuan" class="form-control" min="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Data Kerusakan )**</td>
                                        <td>
                                            <select name="data_kerusakan" id="data_kerusakan" class="form-control">
                                                <option value="">Pilih Data Kerusakan</option>
                                                <option value="Rusak, masih berfungsi dan atau bisa diperbaiki">Rusak, masih berfungsi dan atau bisa diperbaiki</option>
                                                <option value="Rusak, tidak berfungsi dan atau tidak bisa diperbaiki">Rusak, tidak berfungsi dan atau tidak bisa diperbaiki</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Data Kerusakan )**</td>
                                        <td>
                                            <select name="data_kerusakan" id="data_kerusakan" class="form-control">
                                                <option value="">Pilih Data Kerusakan</option>
                                                <option value="Rusak, masih berfungsi dan atau bisa diperbaiki">Rusak, masih berfungsi dan atau bisa diperbaiki</option>
                                                <option value="Rusak, tidak berfungsi dan atau tidak bisa diperbaiki">Rusak, tidak berfungsi dan atau tidak bisa diperbaiki</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td>
                                            <h1>
                                                Data Kerugian Akibat Bencana
                                            </h1>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h2>Pembersihan material atau puing akibat bencana</h2></td>
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
                                            <h2>Penyediaan fasilitas tempat tinggal sementara</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                Sewa/beli)* tenda/barak/rumah/gedung/huntara)*sebanyak <input type="number" name="jumlah_fasilitas" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> Unit,
                                            </div>
                                            <div>
                                                harga sewa/beli)* fasilitas sementara Rp <input type="number" name="harga_fasilitas" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> per bulan/unit)* 
                                            </div>
                                            <div>
                                                jika sewa, waktu yang diperlukan untuk penyediaan fasilitas sementara <input type="number" name="waktu_fasilitas" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> bulan
                                            </div>
                                            <div>
                                                Jumlah fasilitas bangunan sosial masyarakat <input type="number" name="jumlah_bangunan" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> Unit, 
                                            </div>
                                            <div>
                                                luas rata-rata <input type="number" name="luas_bangunan" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0"> m² harga per  unit/m²)* 
                                            </div>
                                            <div>
                                                Rp <input type="number" name="harga_bangunan" style="width:100px;display:inline-block;" class="form-control d-inline-block" min="0">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>Kehilangan pendapatan atau pendapatan yang tidak jadi didapatkan akibat bencana</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                Jumlah anggota keluarga yang kehilangan pendapatan
                                                <input type="number" name="jumlah_kehilangan" class="form-control d-inline-block" style="width:100px;display:inline-block;" min="0">
                                                Orang,
                                            </div>
                                            <div>
                                                jumlah pendapatan rata-rata per hari/bulan)*
                                                Rp <input type="number" name="pendapatan_rata_rata" class="form-control d-inline-block" style="width:120px;display:inline-block;" min="0">
                                                per hari/bulan)* 
                                            </div>
                                            <div>

                                                lama kehilangan pendapatan
                                                <input type="number" name="lama_kehilangan" class="form-control d-inline-block" style="width:80px;display:inline-block;" min="0">
                                                hari/bulan)*
                                            </div>
                                            <div>
                                                Jika rumah disewakan, kehilangan pendapatan sewa dari rumah/kamar)* yang disewakan
                                                <input type="number" name="jumlah_sewa" class="form-control d-inline-block" style="width:80px;display:inline-block;" min="0">
                                                Unit, 
                                                <div>

                                                    nilai sewa rata-rata Rp
                                                    <input type="number" name="nilai_sewa" class="form-control d-inline-block" style="width:120px;display:inline-block;" min="0">
                                                </div>
                                                per bulan, lama kehilangan pendapatan
                                                <input type="number" name="lama_kehilangan_sewa" class="form-control d-inline-block" style="width:80px;display:inline-block;" min="0">bulan
                                            </div>
                                            <div>
                                                Jika rumah difungsikan sebagai tempat usaha, pendapatan usaha rata-rata Rp
                                                <input type="number" name="pendapatan_usaha" class="form-control d-inline-block" style="width:120px;display:inline-block;" min="0">
                                                per hari/bulan)*, 
                                            </div>
                                            <div>
                                                lama kehilangan pendapatan
                                                <input type="number" name="lama_kehilangan_usaha" class="form-control d-inline-block" style="width:80px;display:inline-block;" min="0">
                                                hari/bulan)*

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                                Kerugian lainnya
                                            </h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <textarea name="kerugian_lainnya" class="form-control" placeholder="Deskripsikan kerugian lainnya..."></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered mt-4">
                                    <tr>
                                        <td>
                                            Mengetahui
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" placeholder="Tulis Nama Lengkap" name="nama_mengetahui" class="form-control d-inline-block" style="width: 70%;">
                                        </td>
                                        <td>
                                            <p>Petugas Verifikasi</p>
                                            1.<input style="width: 70%;" type="text" placeholder="Tulis Nama Lengkap" name="nama_petugas" class="form-control d-inline-block" style="width: 70%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" placeholder="Tulis Nama Lengkap" name="nama_mengetahui" class="form-control d-inline-block" style="width: 70%;">
                                        </td>
                                        <td>
                                            2.<input style="width: 70%;" type="text" placeholder="Tulis Nama Lengkap" name="nama_petugas" class="form-control d-inline-block" style="width: 70%;">
                                        </td>
                                    </tr>
                                </table>
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