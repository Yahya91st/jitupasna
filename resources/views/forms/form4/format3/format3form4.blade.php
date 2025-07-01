@extends('layouts.main')

@section('content')
<div style="font-family: Arial, sans-serif; font-size: 14px;">

    {{-- Format 3: Pengumpulan Data Sektor Kesehatan --}}
    <h4 style="margin-top: 20px;">Format 3. Pengumpulan Data Sektor Kesehatan</h4>
    <form method="POST" action="{{ route('forms.form4.format3.store') }}">
    @csrf
    
    <p>NAMA KAMPUNG: <input type="text" name="nama_kampung" class="form-control form-control-sm d-inline" style="width:200px;"> &nbsp;&nbsp;&nbsp;&nbsp; NAMA DISTRIK: <input type="text" name="nama_distrik" class="form-control form-control-sm d-inline" style="width:200px;"></p>    
    <table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th rowspan="2">Perkiraan Kerusakan</th>
                <th colspan="6">Jumlah Unit yang Rusak</th>
                <th rowspan="2">Rata-Rata Luas Bangunan</th>
                <th colspan="4">Harga satuan</th>
            </tr>
            <tr>
                <th>Berat Negeri</th><th>Berat Swasta</th>
                <th>Sedang Negeri</th><th>Sedang Swasta</th>
                <th>Ringan Negeri</th><th>Ringan Swasta</th>
                <th>Bangunan/m2</th><th>Obat-Obatan</th><th>Meubelair</th><th>Peralatan Lab dan Lainnya</th>
            </tr>
        </thead>
        <tbody>
            <tr>                <td>Rumah Sakit</td>
                <td><input type="number" name="rs_rb_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="rs_rb_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="rs_rs_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="rs_rs_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="rs_rr_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="rs_rr_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="rs_luas" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="rs_harga_bangunan" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="rs_harga_obat" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="rs_harga_meubelair" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="rs_harga_peralatan" class="form-control form-control-sm" style="width:80px;"></td>
            </tr>
            <tr>                <td>Puskesmas</td>
                <td><input type="number" name="puskesmas_rb_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="puskesmas_rb_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="puskesmas_rs_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="puskesmas_rs_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="puskesmas_rr_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="puskesmas_rr_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="puskesmas_luas" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="puskesmas_harga_bangunan" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="puskesmas_harga_obat" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="puskesmas_harga_meubelair" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="puskesmas_harga_peralatan" class="form-control form-control-sm" style="width:80px;"></td>
            </tr>
            <tr>                <td>Poliklinik/Tempat Praktek Bersama</td>
                <td><input type="number" name="poliklinik_rb_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="poliklinik_rb_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="poliklinik_rs_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="poliklinik_rs_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="poliklinik_rr_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="poliklinik_rr_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="poliklinik_luas" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="poliklinik_harga_bangunan" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="poliklinik_harga_obat" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="poliklinik_harga_meubelair" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="poliklinik_harga_peralatan" class="form-control form-control-sm" style="width:80px;"></td>
            </tr>
            <tr>                <td>Puskesmas Pembantu</td>
                <td><input type="number" name="pustu_rb_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="pustu_rb_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="pustu_rs_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="pustu_rs_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="pustu_rr_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="pustu_rr_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="pustu_luas" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="pustu_harga_bangunan" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="pustu_harga_obat" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="pustu_harga_meubelair" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="pustu_harga_peralatan" class="form-control form-control-sm" style="width:80px;"></td>
            </tr>
            <tr>                <td>Polindes</td>
                <td><input type="number" name="polindes_rb_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="polindes_rb_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="polindes_rs_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="polindes_rs_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="polindes_rr_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="polindes_rr_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="polindes_luas" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="polindes_harga_bangunan" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="polindes_harga_obat" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="polindes_harga_meubelair" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="polindes_harga_peralatan" class="form-control form-control-sm" style="width:80px;"></td>
            </tr>
            <tr>                <td>Posyandu</td>
                <td><input type="number" name="posyandu_rb_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="posyandu_rb_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="posyandu_rs_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="posyandu_rs_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="posyandu_rr_negeri" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="posyandu_rr_swasta" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="posyandu_luas" class="form-control form-control-sm" style="width:70px;"></td>
                <td><input type="number" name="posyandu_harga_bangunan" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="posyandu_harga_obat" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="posyandu_harga_meubelair" class="form-control form-control-sm" style="width:80px;"></td>
                <td><input type="number" name="posyandu_harga_peralatan" class="form-control form-control-sm" style="width:80px;"></td>
            </tr>
        </tbody>
    </table>

    <br>
    <strong>Perkiraan Kerugian</strong> <strong>Satuan</strong>    <p><strong>Biaya pembersihan puing</strong><br>
    A. Biaya Tenaga Kerja: <input type="number" name="biaya_tenaga_kerja_hok" class="form-control form-control-sm d-inline" style="width:100px;"> HOK<br>
    *Rp <input type="number" name="biaya_tenaga_kerja_upah" class="form-control form-control-sm d-inline" style="width:150px;"> Upah Harian<br>
    B. Biaya Sewa Alat Berat: <input type="number" name="biaya_alat_berat_hari" class="form-control form-control-sm d-inline" style="width:100px;"> Hari*<br>
    Rp <input type="number" name="biaya_alat_berat_harga" class="form-control form-control-sm d-inline" style="width:150px;"><br><br>    <strong>Biaya Pemulasaraan Jenazah</strong><br>
    Perkiraan Jumlah Jenazah yang perlu ditangani <input type="number" name="jumlah_jenazah" class="form-control form-control-sm d-inline" style="width:100px;"> Jenazah</p>

    Rata-Rata Biaya Penanganan Jenazah <input type="number" name="biaya_per_jenazah" class="form-control form-control-sm d-inline" style="width:150px;"> Rupiah</p>    <p><strong>Biaya Perawatan Korban Bencana</strong><br>
    Perkiraan Jumlah Korban yang Dirawat <input type="number" name="jumlah_pasien" class="form-control form-control-sm d-inline" style="width:100px;"> Orang<br>
    Rata-Rata Biaya Perawatan/Per Korban <input type="number" name="biaya_per_pasien" class="form-control form-control-sm d-inline" style="width:150px;"> Rupiah</p>    <p><strong>Jumlah Fasilitas Kesehatan Sementara yang Dibutuhkan</strong><br>
    <span style="font-style: italic;">(berikan keterangan jenis faskes yang dibutuhkan, contoh: Puskesmas Keliling, dll)  </span>
    <input type="text" name="jenis_operasional" class="form-control form-control-sm d-inline" style="width:200px;">
    <input type="number" name="jumlah_faskes" class="form-control form-control-sm d-inline" style="width:100px;"> Unit<br>
    Biaya Pengadaan Faskes Sementara <input type="number" name="biaya_pengadaan_faskes" class="form-control form-control-sm d-inline" style="width:150px;"> Rupiah</p><p><strong>Biaya Penanganan Psikologis Korban Bencana</strong><br>
    Perkiraan Jumlah Korban yang perlu penanganan psikologis <input type="number" name="jumlah_korban_psikologis" class="form-control form-control-sm d-inline" style="width:100px;"> Orang<br>
    Rata-rata Biaya Penanganan Psikologis/Per Korban <input type="number" name="biaya_penanganan_psikologis" class="form-control form-control-sm d-inline" style="width:150px;"> Rupiah</p>

    <p><strong>Biaya Pencegahan Penyakit Menular</strong> <input type="number" name="biaya_pencegahan_penyakit" class="form-control form-control-sm d-inline" style="width:150px;"> Rupiah<br>
    <strong>Jumlah Bantuan Tenaga Kesehatan yang Diperlukan</strong> <input type="number" name="jumlah_tenaga_kesehatan" class="form-control form-control-sm d-inline" style="width:100px;"> Orang</p>

    <p>Rata-rata Biaya Honorarium Tenaga Kesehatan Bantuan <input type="number" name="honorarium_tenaga_kesehatan" class="form-control form-control-sm d-inline" style="width:150px;"> Rupiah<br>
    Rata-Rata Pendapatan Fasilitas Kesehatan Swasta/Bulan <input type="number" name="pendapatan_faskes_swasta" class="form-control form-control-sm d-inline" style="width:150px;"> Rupiah</p>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </div>
    
    </form>
</div>
@endsection
