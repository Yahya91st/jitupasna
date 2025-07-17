@extends('layouts.main')

@section('content')
<div style="font-family: Arial, sans-serif; font-size: 14px;">

    {{-- Format 3: Pengumpulan Data Sektor Kesehatan --}}
    <h4 style="margin-top: 20px;">Format 3. Pengumpulan Data Sektor Kesehatan</h4>
    <form method="POST" action="{{ isset($edit) && $edit ? route('forms.form4.format3.update', $data->id) : route('forms.form4.format3.store') }}">
    @csrf
    @if(isset($edit) && $edit)
        @method('PATCH')
    @endif
    <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
    <p>NAMA KAMPUNG: <input type="text" name="nama_kampung" class="form-control form-control-sm d-inline" style="width:200px;" value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"> &nbsp;&nbsp;&nbsp;&nbsp; NAMA DISTRIK: <input type="text" name="nama_distrik" class="form-control form-control-sm d-inline" style="width:200px;" value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></p>    
    <div class="table-responsive">
        <table border="1" cellpadding="4" cellspacing="0" class="table table-bordered table-hover w-100" style="border-collapse: collapse; min-width: 1200px;">
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
                    <th>Bangunan/m2</th>
                    <th>Obat-Obatan</th><th>Meubelair</th><th>Peralatan Lab dan Lainnya</th>
                </tr>
            </thead>
            <tbody>
                <tr>                <td>Rumah Sakit</td>
                    <td><input type="number" name="rs_rb_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('rs_rb_negeri', $data->rs_rb_negeri ?? '') }}"></td>
                    <td><input type="number" name="rs_rb_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('rs_rb_swasta', $data->rs_rb_swasta ?? '') }}"></td>
                    <td><input type="number" name="rs_rs_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('rs_rs_negeri', $data->rs_rs_negeri ?? '') }}"></td>
                    <td><input type="number" name="rs_rs_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('rs_rs_swasta', $data->rs_rs_swasta ?? '') }}"></td>
                    <td><input type="number" name="rs_rr_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('rs_rr_negeri', $data->rs_rr_negeri ?? '') }}"></td>
                    <td><input type="number" name="rs_rr_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('rs_rr_swasta', $data->rs_rr_swasta ?? '') }}"></td>
                    <td><input type="number" name="rs_luas" class="form-control form-control-sm" style="width:70px;" value="{{ old('rs_luas', $data->rs_luas ?? '') }}"></td>
                    <td><input type="number" name="rs_harga_bangunan" class="form-control form-control-sm" style="width:80px;" value="{{ old('rs_harga_bangunan', $data->rs_harga_bangunan ?? '') }}"></td>
                    <td><input type="text" name="rs_harga_obat" class="form-control form-control-sm" style="width:80px;" value="{{ old('rs_harga_obat', $data->rs_harga_obat ?? '') }}"></td>
                    <td><input type="text" name="rs_harga_meubelair" class="form-control form-control-sm" style="width:80px;" value="{{ old('rs_harga_meubelair', $data->rs_harga_meubelair ?? '') }}"></td>
                    <td><input type="text" name="rs_harga_peralatan" class="form-control form-control-sm" style="width:80px;" value="{{ old('rs_harga_peralatan', $data->rs_harga_peralatan ?? '') }}"></td>
                </tr>
                <tr>                <td>Puskesmas</td>
                    <td><input type="number" name="puskesmas_rb_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('puskesmas_rb_negeri', $data->puskesmas_rb_negeri ?? '') }}"></td>
                    <td><input type="number" name="puskesmas_rb_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('puskesmas_rb_swasta', $data->puskesmas_rb_swasta ?? '') }}"></td>
                    <td><input type="number" name="puskesmas_rs_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('puskesmas_rs_negeri', $data->puskesmas_rs_negeri ?? '') }}"></td>
                    <td><input type="number" name="puskesmas_rs_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('puskesmas_rs_swasta', $data->puskesmas_rs_swasta ?? '') }}"></td>
                    <td><input type="number" name="puskesmas_rr_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('puskesmas_rr_negeri', $data->puskesmas_rr_negeri ?? '') }}"></td>
                    <td><input type="number" name="puskesmas_rr_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('puskesmas_rr_swasta', $data->puskesmas_rr_swasta ?? '') }}"></td>
                    <td><input type="number" name="puskesmas_luas" class="form-control form-control-sm" style="width:70px;" value="{{ old('puskesmas_luas', $data->puskesmas_luas ?? '') }}"></td>
                    <td><input type="number" name="puskesmas_harga_bangunan" class="form-control form-control-sm" style="width:80px;" value="{{ old('puskesmas_harga_bangunan', $data->puskesmas_harga_bangunan ?? '') }}"></td>
                    <td><input type="text" name="puskesmas_harga_obat" class="form-control form-control-sm" style="width:80px;" value="{{ old('puskesmas_harga_obat', $data->puskesmas_harga_obat ?? '') }}"></td>
                    <td><input type="text" name="puskesmas_harga_meubelair" class="form-control form-control-sm" style="width:80px;" value="{{ old('puskesmas_harga_meubelair', $data->puskesmas_harga_meubelair ?? '') }}"></td>
                    <td><input type="text" name="puskesmas_harga_peralatan" class="form-control form-control-sm" style="width:80px;" value="{{ old('puskesmas_harga_peralatan', $data->puskesmas_harga_peralatan ?? '') }}"></td>
                </tr>
                <tr>                <td>Poliklinik/Tempat Praktek Bersama</td>
                    <td><input type="number" name="poliklinik_rb_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('poliklinik_rb_negeri', $data->poliklinik_rb_negeri ?? '') }}"></td>
                    <td><input type="number" name="poliklinik_rb_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('poliklinik_rb_swasta', $data->poliklinik_rb_swasta ?? '') }}"></td>
                    <td><input type="number" name="poliklinik_rs_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('poliklinik_rs_negeri', $data->poliklinik_rs_negeri ?? '') }}"></td>
                    <td><input type="number" name="poliklinik_rs_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('poliklinik_rs_swasta', $data->poliklinik_rs_swasta ?? '') }}"></td>
                    <td><input type="number" name="poliklinik_rr_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('poliklinik_rr_negeri', $data->poliklinik_rr_negeri ?? '') }}"></td>
                    <td><input type="number" name="poliklinik_rr_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('poliklinik_rr_swasta', $data->poliklinik_rr_swasta ?? '') }}"></td>
                    <td><input type="number" name="poliklinik_luas" class="form-control form-control-sm" style="width:70px;" value="{{ old('poliklinik_luas', $data->poliklinik_luas ?? '') }}"></td>
                    <td><input type="number" name="poliklinik_harga_bangunan" class="form-control form-control-sm" style="width:80px;" value="{{ old('poliklinik_harga_bangunan', $data->poliklinik_harga_bangunan ?? '') }}"></td>
                    <td><input type="text" name="poliklinik_harga_obat" class="form-control form-control-sm" style="width:80px;" value="{{ old('poliklinik_harga_obat', $data->poliklinik_harga_obat ?? '') }}"></td>
                    <td><input type="text" name="poliklinik_harga_meubelair" class="form-control form-control-sm" style="width:80px;" value="{{ old('poliklinik_harga_meubelair', $data->poliklinik_harga_meubelair ?? '') }}"></td>
                    <td><input type="text" name="poliklinik_harga_peralatan" class="form-control form-control-sm" style="width:80px;" value="{{ old('poliklinik_harga_peralatan', $data->poliklinik_harga_peralatan ?? '') }}"></td>
                </tr>
                <tr>                <td>Puskesmas Pembantu</td>
                    <td><input type="number" name="pustu_rb_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('pustu_rb_negeri', $data->pustu_rb_negeri ?? '') }}"></td>
                    <td><input type="number" name="pustu_rb_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('pustu_rb_swasta', $data->pustu_rb_swasta ?? '') }}"></td>
                    <td><input type="number" name="pustu_rs_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('pustu_rs_negeri', $data->pustu_rs_negeri ?? '') }}"></td>
                    <td><input type="number" name="pustu_rs_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('pustu_rs_swasta', $data->pustu_rs_swasta ?? '') }}"></td>
                    <td><input type="number" name="pustu_rr_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('pustu_rr_negeri', $data->pustu_rr_negeri ?? '') }}"></td>
                    <td><input type="number" name="pustu_rr_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('pustu_rr_swasta', $data->pustu_rr_swasta ?? '') }}"></td>
                    <td><input type="number" name="pustu_luas" class="form-control form-control-sm" style="width:70px;" value="{{ old('pustu_luas', $data->pustu_luas ?? '') }}"></td>
                    <td><input type="number" name="pustu_harga_bangunan" class="form-control form-control-sm" style="width:80px;" value="{{ old('pustu_harga_bangunan', $data->pustu_harga_bangunan ?? '') }}"></td>
                    <td><input type="text" name="pustu_harga_obat" class="form-control form-control-sm" style="width:80px;" value="{{ old('pustu_harga_obat', $data->pustu_harga_obat ?? '') }}"></td>
                    <td><input type="text" name="pustu_harga_meubelair" class="form-control form-control-sm" style="width:80px;" value="{{ old('pustu_harga_meubelair', $data->pustu_harga_meubelair ?? '') }}"></td>
                    <td><input type="text" name="pustu_harga_peralatan" class="form-control form-control-sm" style="width:80px;" value="{{ old('pustu_harga_peralatan', $data->pustu_harga_peralatan ?? '') }}"></td>
                </tr>
                <tr>                <td>Polindes</td>
                    <td><input type="number" name="polindes_rb_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('polindes_rb_negeri', $data->polindes_rb_negeri ?? '') }}"></td>
                    <td><input type="number" name="polindes_rb_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('polindes_rb_swasta', $data->polindes_rb_swasta ?? '') }}"></td>
                    <td><input type="number" name="polindes_rs_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('polindes_rs_negeri', $data->polindes_rs_negeri ?? '') }}"></td>
                    <td><input type="number" name="polindes_rs_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('polindes_rs_swasta', $data->polindes_rs_swasta ?? '') }}"></td>
                    <td><input type="number" name="polindes_rr_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('polindes_rr_negeri', $data->polindes_rr_negeri ?? '') }}"></td>
                    <td><input type="number" name="polindes_rr_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('polindes_rr_swasta', $data->polindes_rr_swasta ?? '') }}"></td>
                    <td><input type="number" name="polindes_luas" class="form-control form-control-sm" style="width:70px;" value="{{ old('polindes_luas', $data->polindes_luas ?? '') }}"></td>
                    <td><input type="number" name="polindes_harga_bangunan" class="form-control form-control-sm" style="width:80px;" value="{{ old('polindes_harga_bangunan', $data->polindes_harga_bangunan ?? '') }}"></td>
                    <td><input type="text" name="polindes_harga_obat" class="form-control form-control-sm" style="width:80px;" value="{{ old('polindes_harga_obat', $data->polindes_harga_obat ?? '') }}"></td>
                    <td><input type="text" name="polindes_harga_meubelair" class="form-control form-control-sm" style="width:80px;" value="{{ old('polindes_harga_meubelair', $data->polindes_harga_meubelair ?? '') }}"></td>
                    <td><input type="text" name="polindes_harga_peralatan" class="form-control form-control-sm" style="width:80px;" value="{{ old('polindes_harga_peralatan', $data->polindes_harga_peralatan ?? '') }}"></td>
                </tr>
                <tr>                <td>Posyandu</td>
                    <td><input type="number" name="posyandu_rb_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('posyandu_rb_negeri', $data->posyandu_rb_negeri ?? '') }}"></td>
                    <td><input type="number" name="posyandu_rb_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('posyandu_rb_swasta', $data->posyandu_rb_swasta ?? '') }}"></td>
                    <td><input type="number" name="posyandu_rs_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('posyandu_rs_negeri', $data->posyandu_rs_negeri ?? '') }}"></td>
                    <td><input type="number" name="posyandu_rs_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('posyandu_rs_swasta', $data->posyandu_rs_swasta ?? '') }}"></td>
                    <td><input type="number" name="posyandu_rr_negeri" class="form-control form-control-sm" style="width:70px;" value="{{ old('posyandu_rr_negeri', $data->posyandu_rr_negeri ?? '') }}"></td>
                    <td><input type="number" name="posyandu_rr_swasta" class="form-control form-control-sm" style="width:70px;" value="{{ old('posyandu_rr_swasta', $data->posyandu_rr_swasta ?? '') }}"></td>
                    <td><input type="number" name="posyandu_luas" class="form-control form-control-sm" style="width:70px;" value="{{ old('posyandu_luas', $data->posyandu_luas ?? '') }}"></td>
                    <td><input type="number" name="posyandu_harga_bangunan" class="form-control form-control-sm" style="width:80px;" value="{{ old('posyandu_harga_bangunan', $data->posyandu_harga_bangunan ?? '') }}"></td>
                    <td><input type="text" name="posyandu_harga_obat" class="form-control form-control-sm" style="width:80px;" value="{{ old('posyandu_harga_obat', $data->posyandu_harga_obat ?? '') }}"></td>
                    <td><input type="text" name="posyandu_harga_meubelair" class="form-control form-control-sm" style="width:80px;" value="{{ old('posyandu_harga_meubelair', $data->posyandu_harga_meubelair ?? '') }}"></td>
                    <td><input type="text" name="posyandu_harga_peralatan" class="form-control form-control-sm" style="width:80px;" value="{{ old('posyandu_harga_peralatan', $data->posyandu_harga_peralatan ?? '') }}"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <br>
    <strong>Perkiraan Kerugian</strong> <strong>Satuan</strong>    <p><strong>Biaya pembersihan puing</strong><br>
    A. Biaya Tenaga Kerja: <input type="number" name="biaya_tenaga_kerja_hok" class="form-control form-control-sm d-inline" style="width:100px;" value="{{ old('biaya_tenaga_kerja_hok', $data->biaya_tenaga_kerja_hok ?? '') }}"> HOK<br>
    *Rp <input type="number" name="biaya_tenaga_kerja_upah" class="form-control form-control-sm d-inline" style="width:150px;" value="{{ old('biaya_tenaga_kerja_upah', $data->biaya_tenaga_kerja_upah ?? '') }}"> Upah Harian<br>
    B. Biaya Sewa Alat Berat: <input type="number" name="biaya_alat_berat_hari" class="form-control form-control-sm d-inline" style="width:100px;" value="{{ old('biaya_alat_berat_hari', $data->biaya_alat_berat_hari ?? '') }}"> Hari*<br>
    Rp <input type="number" name="biaya_alat_berat_harga" class="form-control form-control-sm d-inline" style="width:150px;" value="{{ old('biaya_alat_berat_harga', $data->biaya_alat_berat_harga ?? '') }}"><br><br>    <strong>Biaya Pemulasaraan Jenazah</strong><br>
    Perkiraan Jumlah Jenazah yang perlu ditangani <input type="number" name="jumlah_jenazah" class="form-control form-control-sm d-inline" style="width:100px;" value="{{ old('jumlah_jenazah', $data->jumlah_jenazah ?? '') }}"> Jenazah</p>

    Rata-Rata Biaya Penanganan Jenazah <input type="number" name="biaya_per_jenazah" class="form-control form-control-sm d-inline" style="width:150px;" value="{{ old('biaya_per_jenazah', $data->biaya_per_jenazah ?? '') }}"> Rupiah</p>    <p><strong>Biaya Perawatan Korban Bencana</strong><br>
    Perkiraan Jumlah Korban yang Dirawat <input type="number" name="jumlah_pasien" class="form-control form-control-sm d-inline" style="width:100px;" value="{{ old('jumlah_pasien', $data->jumlah_pasien ?? '') }}"> Orang<br>
    Rata-Rata Biaya Perawatan/Per Korban <input type="number" name="biaya_per_pasien" class="form-control form-control-sm d-inline" style="width:150px;" value="{{ old('biaya_per_pasien', $data->biaya_per_pasien ?? '') }}"> Rupiah</p>    <p><strong>Jumlah Fasilitas Kesehatan Sementara yang Dibutuhkan</strong><br>
    <span style="font-style: italic;">(berikan keterangan jenis faskes yang dibutuhkan, contoh: Puskesmas Keliling, dll)  </span>
    <input type="text" name="jenis_operasional" class="form-control form-control-sm d-inline" style="width:200px;" value="{{ old('jenis_operasional', $data->jenis_operasional ?? '') }}">
    <input type="number" name="jumlah_faskes" class="form-control form-control-sm d-inline" style="width:100px;" value="{{ old('jumlah_faskes', $data->jumlah_faskes ?? '') }}"> Unit<br>
    Biaya Pengadaan Faskes Sementara <input type="number" name="biaya_pengadaan_faskes" class="form-control form-control-sm d-inline" style="width:150px;" value="{{ old('biaya_pengadaan_faskes', $data->biaya_pengadaan_faskes ?? '') }}"> Rupiah</p><p><strong>Biaya Penanganan Psikologis Korban Bencana</strong><br>
    Perkiraan Jumlah Korban yang perlu penanganan psikologis <input type="number" name="jumlah_korban_psikologis" class="form-control form-control-sm d-inline" style="width:100px;" value="{{ old('jumlah_korban_psikologis', $data->jumlah_korban_psikologis ?? '') }}"> Orang<br>
    Rata-rata Biaya Penanganan Psikologis/Per Korban <input type="number" name="biaya_penanganan_psikologis" class="form-control form-control-sm d-inline" style="width:150px;" value="{{ old('biaya_penanganan_psikologis', $data->biaya_penanganan_psikologis ?? '') }}"> Rupiah</p>

    <p><strong>Biaya Pencegahan Penyakit Menular</strong> <input type="number" name="biaya_pencegahan_penyakit" class="form-control form-control-sm d-inline" style="width:150px;" value="{{ old('biaya_pencegahan_penyakit', $data->biaya_pencegahan_penyakit ?? '') }}"> Rupiah<br>
    <strong>Jumlah Bantuan Tenaga Kesehatan yang Diperlukan</strong> <input type="number" name="jumlah_tenaga_kesehatan" class="form-control form-control-sm d-inline" style="width:100px;" value="{{ old('jumlah_tenaga_kesehatan', $data->jumlah_tenaga_kesehatan ?? '') }}"> Orang</p>

    <p>Rata-rata Biaya Honorarium Tenaga Kesehatan Bantuan <input type="number" name="honorarium_tenaga_kesehatan" class="form-control form-control-sm d-inline" style="width:150px;" value="{{ old('honorarium_tenaga_kesehatan', $data->honorarium_tenaga_kesehatan ?? '') }}"> Rupiah<br>
    Rata-Rata Pendapatan Fasilitas Kesehatan Swasta/Bulan <input type="number" name="pendapatan_faskes_swasta" class="form-control form-control-sm d-inline" style="width:150px;" value="{{ old('pendapatan_faskes_swasta', $data->pendapatan_faskes_swasta ?? '') }}"> Rupiah</p>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">{{ isset($edit) && $edit ? 'Update Data' : 'Simpan Data' }}</button>
    </div>
    
    </form>
</div>
@endsection
