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
                            <td>Nama enumerator:
                                <input type="text" name="enumerator" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> tanggal wawancara:
                                <input type="date" name="tgl_wawancara" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"> Paraf:
                                <input type="text" name="paraf_enum" style="width: 15%; border: none; border-bottom: 1px solid #ccc;">
                            </td>
                        </tr>
                        <tr>
                            <td>Perekaman data</td>
                        </tr>
                        <tr>
                            <td>Data entry oleh:
                                <input type="text" name="data_entry" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> tanggal:
                                <input type="date" name="tgl_entry" style="width: 20%; border: none; border-bottom: 1px solid #ccc;"> Paraf:
                                <input type="text" name="paraf_entry" style="width: 15%; border: none; border-bottom: 1px solid #ccc;">
                            </td>
                        </tr>
                    </table>

                    <h6 class="mt-4"><strong>INFORMASI UMUM:</strong></h6>
                    <table class="table table-bordered">
                        <tr>
                            <td>Responden:</td>
                            <td><input type="radio" name="gender_responden"> L
                                <input type="radio" name="gender_responden"> P
                            </td>
                        </tr>
                        <tr>
                            <td>Umur:</td>
                            <td>
                                <input type="radio" name="umur"> ≤ 20 th
                                <input type="radio" name="umur"> 21 th – 30 th
                                <input type="radio" name="umur"> 31 th – 40 th
                                <input type="radio" name="umur"> 41 th – 50 th
                                <input type="radio" name="umur"> > 50 th
                            </td>
                        </tr>
                        <tr>
                            <td>Nama:</td>
                            <td><input type="text" name="nama" style="width: 100%; border: none; border-bottom: 1px solid #ccc;"></td>
                        </tr>
                        <tr>
                            <td>Desa/kelurahan:</td>
                            <td><input type="text" name="desa" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> Kecamatan:
                                <input type="text" name="kecamatan" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> Kabupaten:
                                <input type="text" name="kabupaten" style="width: 30%; border: none; border-bottom: 1px solid #ccc;">
                            </td>
                        </tr>
                        <tr>
                            <td>Pendidikan terakhir:</td>
                            <td>
                                <input type="radio" name="pendidikan"> SD &nbsp;&nbsp;
                                <input type="radio" name="pendidikan"> SLTP &nbsp;&nbsp;
                                <input type="radio" name="pendidikan"> SLTA &nbsp;&nbsp;
                                <input type="radio" name="pendidikan"> PT
                            </td>
                        </tr>
                        <tr>
                            <td>Apakah anda kepala rumah tangga perempuan?</td>
                            <td>
                                <input type="radio" name="krt"> Ya &nbsp;&nbsp;
                                <input type="radio" name="krt"> Tidak
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah anggota keluarga (sekarang):</td>
                            <td>
                                <input type="radio" name="anggota_3"> ≤ 3 &nbsp;&nbsp;
                                <input type="radio" name="anggota_3_5"> 3 – 5 &nbsp;&nbsp;
                                <input type="radio" name="anggota_5plus"> > 5
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah anak (dibawah usia 18 tahun):</td>
                            <td>
                                <input type="radio" name="anak_1"> 1 orang &nbsp;&nbsp;
                                <input type="radio" name="anak_2"> 2 orang &nbsp;&nbsp;
                                <input type="radio" name="anak_3"> 3 orang &nbsp;&nbsp;
                                <input type="radio" name="anak_3plus"> > 3 orang
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah anak di bawah lima tahun (sekarang):</td>
                            <td>
                                <input type="radio" name="balita_1"> 1 orang &nbsp;&nbsp;
                                <input type="radio" name="balita_2"> 2 orang &nbsp;&nbsp;
                                <input type="radio" name="balita_3"> 3 orang &nbsp;&nbsp;
                                <input type="radio" name="balita_3plus"> > 3 orang
                            </td>
                        </tr>
                        <tr>
                            <td>Tipe hunian sekarang:</td>
                            <td>
                                <input type="radio" name="hunian"> Rumah tinggal sendiri &nbsp;&nbsp;
                                <input type="radio" name="hunian"> Rumah tumpangan &nbsp;&nbsp;
                                <input type="radio" name="hunian"> Huntara <br>
                                <input type="radio" name="hunian"> Pengungsian &nbsp;&nbsp;
                                <input type="radio" name="hunian"> Fasilitas umum &nbsp;&nbsp;
                                <input type="radio" name="hunian"> Lain-lain
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
                            <tr>
                                <td>1</td>
                                <td>Sebelum bencana, siapa sajakah pencari nafkah?</td>
                                <td>
                                    <input type="radio" name="nafkah_pre"> Suami
                                    <input type="radio" name="nafkah_pre"> Istri
                                    <input type="radio" name="nafkah_pre"> Anak (&lt;18 tahun)
                                    <input type="radio" name="nafkah_pre"> Lainnya:
                                    <input type="text" name="nafkah_pre" style="width: 30%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Setelah bencana, siapa pencari nafkah keluarga yang masih bekerja?</td>
                                <td><input type="radio" name="nafkah_post"> Suami
                                    <input type="radio" name="nafkah_post"> Istri
                                    <input type="radio" name="nafkah_post"> Anak (&lt;18 tahun)
                                    <input type="radio" name="nafkah_post"> Lainnya:
                                    <input type="text" name="nafkah_post" style="width: 30%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Sebutkan tiga sumber utama penghasilan keluarga sebelum bencana</td>
                                <td><input type="radio" name="sumber_lain"> Pertanian
                                    <input type="radio" name="sumber_lain"> Peternakan
                                    <input type="radio" name="sumber_lain"> Perdagangan
                                    <input type="radio" name="sumber_lain"> Industri
                                    <input type="radio" name="sumber_lain"> Jasa
                                    <input type="radio" name="sumber_lain"> Pegawai
                                    <input type="radio" name="sumber_lain"> Pertukangan
                                    <input type="radio" name="sumber_lain"> Lainnya:
                                    <input type="text" name="sumber_lain" style="width: 30%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Adakah sumber penghasilan keluarga yang hilang/menurun setelah bencana?</td>
                                <td><input type="radio" name="penghasilan_hilang"> Ada
                                    <input type="radio" name="penghasilan_hilang"> Tidak
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Bantuan yang paling dibutuhkan untuk memulihkan mata pencaharian?</td>
                                <td><input type="radio" name="bantuan"> Keterampilan
                                    <input type="radio" name="bantuan"> Peralatan
                                    <input type="radio" name="bantuan">Modal
                                    <input type="radio" name="bantuan"> Akses Pasar
                                    <input type="radio" name="bantuan"> Lain-lain:
                                    <input type="text" name="bantuan" style="width: 30%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Sumber cadangan keluarga yang terganggu setelah bencana <br><em>(Pilih maksimal
                                        tiga)</em></td>
                                <td><input type="radio" name="cadangan"> Tabungan
                                    <input type="radio" name="cadangan"> Pinjaman
                                    <input type="radio" name="cadangan"> Barang
                                    <input type="radio" name="cadangan"> Ternak
                                    <input type="radio" name="cadangan"> Jaminan Sosial
                                    <input type="radio" name="cadangan"> Lainnya:
                                    <input type="text" name="cadangan" style="width: 30%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Dukungan untuk memulihkan sumber cadangan</td>
                                <td><input type="radio" name="dukungan"> Koperasi
                                    <input type="radio" name="dukungan"> Kelompok Usaha
                                    <input type="radio" name="dukungan"> Pinjaman
                                    <input type="radio" name="dukungan"> Bantuan pemerintah
                                    <input type="radio" name="dukungan"> Lainnya:
                                    <input type="text" name="dukungan" style="width: 20%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Perlindungan perempuan dan anak dari kekerasan</td>
                                <td><input type="radio" name="perlindungan"> Meningkat
                                    <input type="radio" name="perlindungan"> Menurun
                                    <input type="radio" name="perlindungan"> Sama saja
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Bantuan untuk meningkatkan perlindungan perempuan & anak</td>
                                <td><input type="radio" name="bantu_lindung"> Penyuluhan
                                    <input type="radio" name="bantu_lindung"> Penguatan moral
                                    <input type="radio" name="bantu_lindung"> Polisi keliling
                                    <input type="radio" name="bantu_lindung"> Pos Pengaduan
                                    <input type="radio" name="bantu_lindung">Rumah aman
                                    <input type="radio" name="bantu_lindung"> Lainnya:
                                    <input type="text" name="bantu_lindung" style="width: 20%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Masalah perumahan setelah bencana</td>
                                <td><input type="radio" name="masalah_rumah"> Harus relokasi
                                    <input type="radio" name="masalah_rumah"> Rusak
                                    <input type="radio" name="masalah_rumah"> Belum punya rumah
                                    <input type="radio" name="masalah_rumah"> Lainnya:
                                    <input type="text" name="masalah_rumah" style="width: 20%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>Tindakan untuk mengatasi masalah perumahan</td>
                                <td><input type="radio" name="tindakan_rumah"> Stimulus rumah
                                    <input type="radio" name="tindakan_rumah"> Kredit
                                    <input type="radio" name="tindakan_rumah"> Bantuan teknis
                                    <input type="radio" name="tindakan_rumah"> Lainnya:
                                    <input type="text" name="tindakan_rumah" style="width: 20%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>Perkiraan tinggal satu tahun dari sekarang</td>
                                <td><input type="radio" name="perkiraan_tempat_tinggal"> Di rumah asal
                                    <input type="radio" name="perkiraan_tempat_tinggal"> Di desa asal
                                    <input type="radio" name="perkiraan_tempat_tinggal"> Di tempat lain:
                                    <input type="text" name="perkiraan_tempat_tinggal" style="width: 30%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>Cara mendapatkan makanan dalam 3 minggu ke depan</td>
                                <td><input type="radio" name="makanan"> Bantuan
                                    <input type="radio" name="makanan"> Cadangan
                                    <input type="radio" name="makanan">Sisa tanaman
                                    <input type="radio" name="makanan"> Lainnya:
                                    <input type="text" name="makanan" style="width: 20%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>14</td>
                                <td>Dukungan untuk mengatasi masalah pangan</td>
                                <td><input type="radio" name="dukungan_pangan"> Pangan langsung
                                    <input type="radio" name="dukungan_pangan"> Pemulihan pangan
                                    <input type="radio" name="dukungan_pangan"> Gotong royong
                                    <input type="radio" name="dukungan_pangan"> Lainnya:
                                    <input type="text" name="dukungan_pangan" style="width: 20%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>15</td>
                                <td>Masalah air bersih yang dihadapi</td>
                                <td><input type="radio" name="air"> Kurang
                                    <input type="radio" name="air"> Tidak bersih
                                    <input type="radio" name="air"> Penyimpanan
                                    <input type="radio" name="air"> Lainnya:
                                    <input type="text" name="air" style="width: 20%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td>Dukungan untuk mengatasi masalah air bersih</td>
                                <td><input type="radio" name="dukungan_air"> Penyediaan air
                                    <input type="radio" name="dukungan_air"> Pemulihan
                                    <input type="radio" name="dukungan_air"> Sarana simpan
                                    <input type="radio" name="dukungan_air"> Lainnya:
                                    <input type="text" name="dukungan_air" style="width: 20%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>17</td>
                                <td>Tingkat pelayanan kesehatan keluarga</td>
                                <td><input type="radio" name="kesehatan"> Memadai
                                    <input type="radio" name="kesehatan"> Tidak memadai
                                </td>
                            </tr>
                            <tr>
                                <td>18</td>
                                <td>Perbaikan yang diperlukan untuk pelayanan kesehatan</td>
                                <td><input type="radio" name="perbaikan"> Obat <input type="radio" name="perbaikan_medis"> Tenaga Medis <input type="radio" name="perbaikan_jarak"> Jarak
                                    <input type="radio" name="perbaikan"> Biaya
                                    <input type="radio" name="perbaikan"> Psikososial <input type="radio" name="perbaikan_lain"> Lainnya: <input type="text" name="perbaikan_lain_text" style="width: 20%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>19</td>
                                <td>Apakah kegiatan sekolah anak terganggu?</td>
                                <td><input type="radio" name="sekolah_terganggu"> Ya
                                    <input type="radio" name="sekolah_terganggu"> Tidak
                                </td>
                            </tr>
                            <tr>
                                <td>20</td>
                                <td>Dukungan pendidikan anak setelah bencana</td>
                                <td><input type="radio" name="dukungan_pend"> Guru
                                    <input type="radio" name="dukungan_pend"> Perlengkapan
                                    <input type="radio" name="dukungan_pend"> Biaya
                                    <input type="radio" name="dukungan_pend"> Transport
                                    <input type="radio" name="dukungan_pend"> Dekat
                                    <input type="radio" name="dukungan_pend"> Bangunan
                                    <input type="radio" name="dukungan_pend"> Lainnya:
                                    <input type="text" name="dukungan_pend" style="width: 20%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>21</td>
                                <td>Apakah kegiatan tradisional/keagamaan terganggu?</td>
                                <td><input type="radio" name="agama_terganggu"> Ya
                                    <input type="radio" name="agama_terganggu"> Tidak
                                </td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>Dukungan kegiatan tradisional/keagamaan</td>
                                <td>
                                    <input type="radio" name="dukungan_agama"> Stimulasi
                                    <input type="radio" name="dukungan_agama"> Pelatihan
                                    <input type="radio" name="dukungan_agama"> Perizinan
                                    <input type="radio" name="dukungan_agama"> Lainnya:
                                    <input type="text" name="dukungan_agama" style="width: 20%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>23</td>
                                <td>Kegiatan pencegahan dampak bencana di masa depan</td>
                                <td><input type="radio" name="cegah"> Info
                                    <input type="radio" name="cegah"> Pelatihan
                                    <input type="radio" name="cegah"> Rencana
                                    <input type="radio" name="cegah"> Fasilitas
                                    <input type="radio" name="cegah"> Peringatan
                                    <input type="radio" name="cegah"> Komunitas
                                    <input type="radio" name="cegah"> Budaya
                                    <input type="radio" name="cegah"> Lainnya:
                                    <input type="text" name="cegah" style="width: 20%; border: none; border-bottom: 1px solid #ccc;">
                                </td>

                            </tr>
                            <tr>
                                <td>24</td>
                                <td>Kelompok yang paling membutuhkan bantuan</td>
                                <td>
                                    <input type="radio" name="butuh_bantuan"> Anak-anak
                                    <input type="radio" name="butuh_bantuan"> Lansia
                                    <input type="radio" name="butuh_bantuan"> Difabel
                                    <input type="radio" name="butuh_bantuan"> Ibu hamil
                                    <input type="radio" name="butuh_bantuan"> Lainnya:
                                    <input type="text" name="butuh_bantuan" style="width: 20%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td>25</td>
                                <td>Penghasilan tiap bulan (sebelum bencana)</td>
                                <td>
                                    Suami:
                                    <input type="text" name="penghasilan_suami" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> bidang:
                                    <input type="text" name="bidang_suami" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"><br>
                                    Istri:
                                    <input type="text" name="penghasilan_istri" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> bidang:
                                    <input type="text" name="bidang_istri" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"><br>
                                    Lainnya:
                                    <input type="text" name="penghasilan_lainnya" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"> bidang:
                                    <input type="text" name="bidang_lainnya" style="width: 30%; border: none; border-bottom: 1px solid #ccc;">
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
                // Reset all radioes
                const radioes = document.querySelectorAll('input[type="radio"]');
                radioes.forEach(radio => radio.checked = false);

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

            // Handle radioes for preview
            const radioes = formContent.querySelectorAll('input[type="radio"]');
            radioes.forEach(radio => {
                const span = document.createElement('span');
                span.textContent = radio.checked ? '☑' : '☐';
                radio.parentNode.replaceChild(span, radio);
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
