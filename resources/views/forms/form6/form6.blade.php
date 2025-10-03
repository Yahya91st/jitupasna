@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('forms.form6.store') }}">
@csrf
<input type="hidden" name="form_type" value="form6">
<input type="hidden" name="bencana_id" value="{{ request('bencana_id') }}">

<div class="container" style="max-width: 800px; font-family: Times New Roman, serif;">    
    <div class="text-center mb-4">
        <h5><strong>Formulir 06</strong></h5>
        <h5>Pendataan Tingkat Rumahtangga</h5>
    </div>
    <div class="card">
        <div class="card-body">

            <table class="table table-bordered mt-4">
                <tr>            
                    <td>Pengumpulan data</td>
                </tr>
                <tr>
                    <td>Nama enumerator: <input type="text" name="enumerator" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> tanggal wawancara: <input type="date" name="tgl_wawancara" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"> Paraf: <input type="text" name="paraf_enum" style="width: 15%; border: none; border-bottom: 1px solid #ccc;"></td>
                </tr>
                <tr>
                    <td>Perekaman data</td>
                </tr>
                <tr>
                    <td>Data entry oleh: <input type="text" name="data_entry" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> tanggal: <input type="date" name="tgl_entry" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"> Paraf: <input type="text" name="paraf_entry" style="width: 15%; border: none; border-bottom: 1px solid #ccc;"></td>
                </tr>
            </table>

            <h6 class="mt-4"><strong>INFORMASI UMUM:</strong></h6>
            <table class="table table-bordered">
                <tr>            <td>Responden:</td>
                    <td><input type="checkbox" name="responden_l"> L &nbsp;&nbsp; <input type="checkbox" name="responden_p"> P</td>
                </tr>
                <tr>            <td>Umur:</td>
                    <td>
                        <input type="checkbox" name="umur_20"> ≤ 20 th &nbsp;&nbsp; 
                        <input type="checkbox" name="umur_21_30"> 21 th – 30 th &nbsp;&nbsp; 
                        <input type="checkbox" name="umur_31_40"> 31 th – 40 th &nbsp;&nbsp; 
                        <input type="checkbox" name="umur_41_50"> 41 th – 50 th &nbsp;&nbsp; 
                        <input type="checkbox" name="umur_50plus"> > 50 th
                    </td>
                </tr>
                <tr>            <td>Nama:</td>
                    <td><input type="text" name="nama" style="width: 100%; border: none; border-bottom: 1px solid #ccc;"></td>
                </tr>
                <tr>            <td>Desa/kelurahan:</td>
                    <td><input type="text" name="desa" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> Kecamatan: <input type="text" name="kecamatan" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> Kabupaten: <input type="text" name="kabupaten" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"></td>
                </tr>
                <tr>            <td>Pendidikan terakhir:</td>
                    <td><input type="checkbox" name="pend_sd"> SD &nbsp;&nbsp; <input type="checkbox" name="pend_sltp"> SLTP &nbsp;&nbsp; <input type="checkbox" name="pend_slta"> SLTA &nbsp;&nbsp; <input type="checkbox" name="pend_pt"> PT</td>
                </tr>
                <tr>            <td>Apakah anda kepala rumah tangga perempuan?</td>
                    <td><input type="checkbox" name="krt_p_ya"> Ya &nbsp;&nbsp; <input type="checkbox" name="krt_p_tidak"> Tidak</td>
                </tr>
                <tr>            <td>Jumlah anggota keluarga (sekarang):</td>
                    <td><input type="checkbox" name="anggota_3"> ≤ 3 &nbsp;&nbsp; <input type="checkbox" name="anggota_3_5"> 3 – 5 &nbsp;&nbsp; <input type="checkbox" name="anggota_5plus"> > 5</td>
                </tr>
                <tr>            <td>Jumlah anak (dibawah usia 18 tahun):</td>
                    <td><input type="checkbox" name="anak_1"> 1 orang &nbsp;&nbsp; <input type="checkbox" name="anak_2"> 2 orang &nbsp;&nbsp; <input type="checkbox" name="anak_3"> 3 orang &nbsp;&nbsp; <input type="checkbox" name="anak_3plus"> > 3 orang</td>
                </tr>
                <tr>            <td>Jumlah anak di bawah lima tahun (sekarang):</td>
                    <td><input type="checkbox" name="balita_1"> 1 orang &nbsp;&nbsp; <input type="checkbox" name="balita_2"> 2 orang &nbsp;&nbsp; <input type="checkbox" name="balita_3"> 3 orang &nbsp;&nbsp; <input type="checkbox" name="balita_3plus"> > 3 orang</td>
                </tr>
                <tr>            <td>Tipe hunian sekarang:</td>
                    <td>
                        <input type="checkbox" name="hunian_sendiri"> Rumah tinggal sendiri &nbsp;&nbsp;
                        <input type="checkbox" name="hunian_tumpangan"> Rumah tumpangan &nbsp;&nbsp;
                        <input type="checkbox" name="hunian_huntara"> Huntara <br>
                        <input type="checkbox" name="hunian_pengungsian"> Pengungsian &nbsp;&nbsp;
                        <input type="checkbox" name="hunian_fasum"> Fasilitas umum &nbsp;&nbsp;
                        <input type="checkbox" name="hunian_lain"> Lain-lain
                    </td>
                </tr>
            </table>

                <h6 class="mt-4"><strong>DAFTAR PERTANYAAN</strong></h6>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 55%;">Pertanyaan</th>
                        <th style="width: 40%;">Jawaban</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>            <td>1</td>
                        <td>Sebelum bencana, siapa sajakah pencari nafkah?</td>
                        <td><input type="checkbox" name="nafkah_pre_suami"> Suami <input type="checkbox" name="nafkah_pre_istri"> Istri <input type="checkbox" name="nafkah_pre_anak"> Anak (&lt;18 tahun) <input type="checkbox" name="nafkah_pre_lain"> Lainnya: <input type="text" name="nafkah_pre_lain_text" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>2</td>
                        <td>Setelah bencana, siapa pencari nafkah keluarga yang masih bekerja?</td>
                        <td><input type="checkbox" name="nafkah_post_suami"> Suami <input type="checkbox" name="nafkah_post_istri"> Istri <input type="checkbox" name="nafkah_post_anak"> Anak (&lt;18 tahun) <input type="checkbox" name="nafkah_post_lain"> Lainnya: <input type="text" name="nafkah_post_lain_text" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>3</td>
                        <td>Sebutkan tiga sumber utama penghasilan keluarga sebelum bencana</td>
                        <td><input type="checkbox" name="sumber_pertanian"> Pertanian <input type="checkbox" name="sumber_peternakan"> Peternakan <input type="checkbox" name="sumber_dagang"> Perdagangan <input type="checkbox" name="sumber_industri"> Industri <input type="checkbox" name="sumber_jasa"> Jasa <input type="checkbox" name="sumber_pegawai"> Pegawai <input type="checkbox" name="sumber_pertukangan"> Pertukangan <input type="checkbox" name="sumber_lain"> Lainnya: <input type="text" name="sumber_lain_text" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>4</td>
                        <td>Adakah sumber penghasilan keluarga yang hilang/menurun setelah bencana?</td>
                        <td><input type="checkbox" name="penghasilan_hilang_ada"> Ada <input type="checkbox" name="penghasilan_hilang_tidak"> Tidak</td>
                    </tr>
                    <tr>            <td>5</td>
                        <td>Bantuan yang paling dibutuhkan untuk memulihkan mata pencaharian?</td>
                        <td><input type="checkbox" name="bantuan_keterampilan"> Keterampilan <input type="checkbox" name="bantuan_peralatan"> Peralatan <input type="checkbox" name="bantuan_modal"> Modal <input type="checkbox" name="bantuan_pasar"> Akses Pasar <input type="checkbox" name="bantuan_lain"> Lain-lain: <input type="text" name="bantuan_lain_text" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>6</td>
                        <td>Sumber cadangan keluarga yang terganggu setelah bencana <br><em>(Pilih maksimal tiga)</em></td>
                        <td><input type="checkbox" name="cadangan_tabungan"> Tabungan <input type="checkbox" name="cadangan_pinjaman"> Pinjaman <input type="checkbox" name="cadangan_barang"> Barang <input type="checkbox" name="cadangan_ternak"> Ternak <input type="checkbox" name="cadangan_jamsos"> Jaminan Sosial <input type="checkbox" name="cadangan_lain"> Lainnya: <input type="text" name="cadangan_lain_text" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>7</td>
                        <td>Dukungan untuk memulihkan sumber cadangan</td>
                        <td><input type="checkbox" name="dukungan_koperasi"> Koperasi <input type="checkbox" name="dukungan_kelompok"> Kelompok Usaha <input type="checkbox" name="dukungan_pinjaman"> Pinjaman <input type="checkbox" name="dukungan_pemerintah"> Bantuan pemerintah <input type="checkbox" name="dukungan_lain"> Lainnya: <input type="text" name="dukungan_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>8</td>
                        <td>Perlindungan perempuan dan anak dari kekerasan</td>
                        <td><input type="checkbox" name="perlindungan_meningkat"> Meningkat <input type="checkbox" name="perlindungan_menurun"> Menurun <input type="checkbox" name="perlindungan_sama"> Sama saja</td>
                    </tr>
                    <tr>            <td>9</td>
                        <td>Bantuan untuk meningkatkan perlindungan perempuan & anak</td>
                        <td><input type="checkbox" name="bantu_lindung_penyuluhan"> Penyuluhan <input type="checkbox" name="bantu_lindung_moral"> Penguatan moral <input type="checkbox" name="bantu_lindung_polisi"> Polisi keliling <input type="checkbox" name="bantu_lindung_pos"> Pos Pengaduan <input type="checkbox" name="bantu_lindung_rumah"> Rumah aman <input type="checkbox" name="bantu_lindung_lain"> Lainnya: <input type="text" name="bantu_lindung_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>10</td>
                        <td>Masalah perumahan setelah bencana</td>
                        <td><input type="checkbox" name="masalah_rumah_relokasi"> Harus relokasi <input type="checkbox" name="masalah_rumah_rusak"> Rusak <input type="checkbox" name="masalah_rumah_belum"> Belum punya rumah <input type="checkbox" name="masalah_rumah_lain"> Lainnya: <input type="text" name="masalah_rumah_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>11</td>
                        <td>Tindakan untuk mengatasi masalah perumahan</td>
                        <td><input type="checkbox" name="tindakan_rumah_stimulus"> Stimulus rumah <input type="checkbox" name="tindakan_rumah_kredit"> Kredit <input type="checkbox" name="tindakan_rumah_teknis"> Bantuan teknis <input type="checkbox" name="tindakan_rumah_lain"> Lainnya: <input type="text" name="tindakan_rumah_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>12</td>
                        <td>Perkiraan tempat tinggal satu tahun dari sekarang</td>
                        <td><input type="checkbox" name="perkiraan_rumah_asal"> Di rumah asal <input type="checkbox" name="perkiraan_desa_asal"> Di desa asal <input type="checkbox" name="perkiraan_tempat_lain"> Di tempat lain: <input type="text" name="perkiraan_tempat_lain_text" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>13</td>
                        <td>Cara mendapatkan makanan dalam 3 minggu ke depan</td>
                        <td><input type="checkbox" name="makanan_bantuan"> Bantuan <input type="checkbox" name="makanan_cadangan"> Cadangan <input type="checkbox" name="makanan_tanaman"> Sisa tanaman <input type="checkbox" name="makanan_lain"> Lainnya: <input type="text" name="makanan_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>14</td>
                        <td>Dukungan untuk mengatasi masalah pangan</td>
                        <td><input type="checkbox" name="dukungan_pangan_langsung"> Pangan langsung <input type="checkbox" name="dukungan_pangan_pulih"> Pemulihan pangan <input type="checkbox" name="dukungan_pangan_gotong"> Gotong royong <input type="checkbox" name="dukungan_pangan_lain"> Lainnya: <input type="text" name="dukungan_pangan_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>15</td>
                        <td>Masalah air bersih yang dihadapi</td>
                        <td><input type="checkbox" name="air_kurang"> Kurang <input type="checkbox" name="air_kotor"> Tidak bersih <input type="checkbox" name="air_simpan"> Penyimpanan <input type="checkbox" name="air_lain"> Lainnya: <input type="text" name="air_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>16</td>
                        <td>Dukungan untuk mengatasi masalah air bersih</td>
                        <td><input type="checkbox" name="dukungan_air_sedia"> Penyediaan air <input type="checkbox" name="dukungan_air_pulih"> Pemulihan <input type="checkbox" name="dukungan_air_simpan"> Sarana simpan <input type="checkbox" name="dukungan_air_lain"> Lainnya: <input type="text" name="dukungan_air_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>17</td>
                        <td>Tingkat pelayanan kesehatan keluarga</td>
                        <td><input type="checkbox" name="kesehatan_memadai"> Memadai <input type="checkbox" name="kesehatan_tidak"> Tidak memadai</td>
                    </tr>
                    <tr>            <td>18</td>
                        <td>Perbaikan yang diperlukan untuk pelayanan kesehatan</td>
                        <td><input type="checkbox" name="perbaikan_obat"> Obat <input type="checkbox" name="perbaikan_medis"> Tenaga Medis <input type="checkbox" name="perbaikan_jarak"> Jarak <input type="checkbox" name="perbaikan_biaya"> Biaya <input type="checkbox" name="perbaikan_psiko"> Psikososial <input type="checkbox" name="perbaikan_lain"> Lainnya: <input type="text" name="perbaikan_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>19</td>
                        <td>Apakah kegiatan sekolah anak terganggu?</td>
                        <td><input type="checkbox" name="sekolah_terganggu_ya"> Ya <input type="checkbox" name="sekolah_terganggu_tidak"> Tidak</td>
                    </tr>
                    <tr>            <td>20</td>
                        <td>Dukungan pendidikan anak setelah bencana</td>
                        <td><input type="checkbox" name="dukungan_pend_guru"> Guru <input type="checkbox" name="dukungan_pend_alat"> Perlengkapan <input type="checkbox" name="dukungan_pend_biaya"> Biaya <input type="checkbox" name="dukungan_pend_trans"> Transport <input type="checkbox" name="dukungan_pend_dekat"> Dekat <input type="checkbox" name="dukungan_pend_bangun"> Bangunan <input type="checkbox" name="dukungan_pend_lain"> Lainnya: <input type="text" name="dukungan_pend_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>21</td>
                        <td>Apakah kegiatan tradisional/keagamaan terganggu?</td>
                        <td><input type="checkbox" name="agama_terganggu_ya"> Ya <input type="checkbox" name="agama_terganggu_tidak"> Tidak</td>
                    </tr>
                    <tr>            <td>22</td>
                        <td>Dukungan kegiatan tradisional/keagamaan</td>
                        <td><input type="checkbox" name="dukungan_agama_stimulus"> Stimulasi <input type="checkbox" name="dukungan_agama_latih"> Pelatihan <input type="checkbox" name="dukungan_agama_izin"> Perizinan <input type="checkbox" name="dukungan_agama_lain"> Lainnya: <input type="text" name="dukungan_agama_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>23</td>
                        <td>Kegiatan pencegahan dampak bencana di masa depan</td>
                        <td><input type="checkbox" name="cegah_info"> Info <input type="checkbox" name="cegah_latih"> Pelatihan <input type="checkbox" name="cegah_rencana"> Rencana <input type="checkbox" name="cegah_fasilitas"> Fasilitas <input type="checkbox" name="cegah_warning"> Peringatan <input type="checkbox" name="cegah_komunitas"> Komunitas <input type="checkbox" name="cegah_budaya"> Budaya <input type="checkbox" name="cegah_lain"> Lainnya: <input type="text" name="cegah_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>24</td>
                        <td>Kelompok yang paling membutuhkan bantuan</td>
                        <td><input type="checkbox" name="butuh_anak"> Anak-anak <input type="checkbox" name="butuh_lansia"> Lansia <input type="checkbox" name="butuh_difabel"> Difabel <input type="checkbox" name="butuh_hamil"> Ibu hamil <input type="checkbox" name="butuh_lain"> Lainnya: <input type="text" name="butuh_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>            <td>25</td>
                        <td>Penghasilan tiap bulan (sebelum bencana)</td>
                        <td>
                            Suami: <input type="text" name="penghasilan_suami" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> bidang: <input type="text" name="bidang_suami" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"><br>
                            Istri: <input type="text" name="penghasilan_istri" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> bidang: <input type="text" name="bidang_istri" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"><br>
                            Lainnya: <input type="text" name="penghasilan_lainnya" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> bidang: <input type="text" name="bidang_lainnya" style="width: 30%; border: none; border-bottom: 1px solid #ccc;">
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Tombol Aksi -->
            <div class="d-flex gap-2 justify-content-center mt-4 mb-3">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan Data
                </button>
                <button type="reset" class="btn btn-warning" onclick="resetForm()">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </button>
                <button type="button" class="btn btn-info" onclick="printForm()">
                    <i class="bi bi-printer"></i> Cetak
                </button>
                <button type="button" class="btn btn-secondary" onclick="previewForm()">
                    <i class="bi bi-eye"></i> Preview
                </button>
            </div>
        </div>
    </div>
</div>
</form>

<script>
function resetForm() {
    if (confirm('Apakah Anda yakin ingin mereset semua data form?')) {
        // Reset all checkboxes
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => checkbox.checked = false);
        
        // Reset all text inputs
        const textInputs = document.querySelectorAll('input[type="text"], input[type="date"]');
        textInputs.forEach(input => input.value = '');
    }
}

function printForm() {
    window.print();
}

function previewForm() {
    // Create preview window
    const previewWindow = window.open('', '_blank', 'width=800,height=600,scrollbars=yes');
    const formContent = document.querySelector('.container').cloneNode(true);
    
    // Remove buttons from preview
    const buttons = formContent.querySelectorAll('button');
    buttons.forEach(btn => btn.style.display = 'none');
    
    // Remove input borders for preview
    const inputs = formContent.querySelectorAll('input[type="text"], input[type="date"]');
    inputs.forEach(input => {
        const span = document.createElement('span');
        span.textContent = input.value || '________________';
        span.style.borderBottom = '1px solid #000';
        span.style.minWidth = '100px';
        span.style.display = 'inline-block';
        input.parentNode.replaceChild(span, input);
    });
    
    // Handle checkboxes for preview
    const checkboxes = formContent.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        const span = document.createElement('span');
        span.textContent = checkbox.checked ? '☑' : '☐';
        checkbox.parentNode.replaceChild(span, checkbox);
    });
    
    previewWindow.document.write(`
        <html>
        <head>
            <title>Preview Form 6 - Pendataan Tingkat Rumahtangga</title>
            <style>
                body { font-family: 'Times New Roman', serif; padding: 20px; }
                .table { border-collapse: collapse; width: 100%; }
                .table td, .table th { border: 1px solid #000; padding: 8px; }
            </style>
        </head>
        <body>
            ${formContent.outerHTML}
        </body>
        </html>
    `);
    previewWindow.document.close();
}
</script>

</div>
@endsection
