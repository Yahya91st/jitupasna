<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh Formulir 06 - Pendataan Tingkat Rumahtangga</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.6;
            color: #000;
            margin: 20px;
            padding: 0;
            font-size: 12pt;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
        }
        .header h2 {
            margin: 5px 0;
            font-size: 16pt;
            font-weight: bold;
        }
        .header h3 {
            margin: 5px 0;
            font-size: 14pt;
            font-weight: normal;
        }
        .section-header {
            background: #f0f0f0;
            padding: 8px 12px;
            margin: 15px 0 10px 0;
            border: 1px solid #333;
            font-weight: bold;
            font-size: 12pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 8px 10px;
            text-align: left;
            font-size: 11pt;
        }
        th {
            background-color: #e9ecef;
            font-weight: bold;
        }
        .label-col {
            width: 35%;
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .value-col {
            width: 65%;
        }
        .checkbox-symbol {
            font-size: 14pt;
            font-weight: bold;
        }
        .checked {
            color: #0066cc;
        }
        .question-table {
            width: 100%;
            margin-bottom: 10px;
        }
        .question-number {
            width: 5%;
            text-align: center;
            font-weight: bold;
        }
        .question-text {
            width: 50%;
            font-weight: 500;
        }
        .answer-text {
            width: 45%;
        }
        .inline-group {
            display: inline-block;
            margin-right: 20px;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            padding-right: 50px;
        }
        .signature-box {
            margin-top: 60px;
            border-top: 1px solid #333;
            padding-top: 5px;
            display: inline-block;
            min-width: 200px;
            text-align: center;
        }
        .page-break {
            page-break-after: always;
        }
        @media print {
            body {
                margin: 10px;
            }
            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2><strong>Formulir 06</strong></h2>
            <h3>Pendataan Tingkat Rumahtangga</h3>
            <h3>JITUPASNA - Pengkajian Kebutuhan Pasca Bencana</h3>
        </div>

        <!-- Pengumpulan Data -->
        <div class="section-header">PENGUMPULAN DATA</div>
        <table>
            <tr>
                <th colspan="2" style="background-color: #e9ecef;">Pengumpulan data</th>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>Nama enumerator:</strong> {{ $form->enumerator }} &nbsp;&nbsp;&nbsp;
                    <strong>Tanggal wawancara:</strong> {{ \Carbon\Carbon::parse($form->tgl_wawancara)->format('d F Y') }} &nbsp;&nbsp;&nbsp;
                    <strong>Paraf:</strong> {{ $form->paraf_enum }}
                </td>
            </tr>
            <tr>
                <th colspan="2" style="background-color: #e9ecef;">Perekaman data</th>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>Data entry oleh:</strong> {{ $form->data_entry }} &nbsp;&nbsp;&nbsp;
                    <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($form->tgl_entry)->format('d F Y') }} &nbsp;&nbsp;&nbsp;
                    <strong>Paraf:</strong> {{ $form->paraf_entry }}
                </td>
            </tr>
        </table>

        <!-- Informasi Umum -->
        <div class="section-header">INFORMASI UMUM</div>
        <table>
            <tr>
                <td class="label-col">Responden:</td>
                <td class="value-col">
                    <span class="checkbox-symbol {{ $form->responden == 'l' ? 'checked' : '' }}">{{ $form->responden == 'l' ? '☑' : '☐' }}</span> Laki-laki &nbsp;&nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->responden == 'p' ? 'checked' : '' }}">{{ $form->responden == 'p' ? '☑' : '☐' }}</span> Perempuan
                </td>
            </tr>
            <tr>
                <td class="label-col">Umur:</td>
                <td class="value-col">
                    <span class="checkbox-symbol {{ $form->umur == '20' ? 'checked' : '' }}">{{ $form->umur == '20' ? '☑' : '☐' }}</span> ≤ 20 tahun &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->umur == '21_30' ? 'checked' : '' }}">{{ $form->umur == '21_30' ? '☑' : '☐' }}</span> 21-30 tahun &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->umur == '31_40' ? 'checked' : '' }}">{{ $form->umur == '31_40' ? '☑' : '☐' }}</span> 31-40 tahun &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->umur == '41_50' ? 'checked' : '' }}">{{ $form->umur == '41_50' ? '☑' : '☐' }}</span> 41-50 tahun &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->umur == '50plus' ? 'checked' : '' }}">{{ $form->umur == '50plus' ? '☑' : '☐' }}</span> > 50 tahun
                </td>
            </tr>
            <tr>
                <td class="label-col">Nama:</td>
                <td class="value-col">{{ $form->nama }}</td>
            </tr>
            <tr>
                <td class="label-col">Lokasi:</td>
                <td class="value-col">
                    <strong>Desa/kelurahan:</strong> {{ $form->desa }} &nbsp;&nbsp;&nbsp;
                    <strong>Kecamatan:</strong> {{ $form->kecamatan }} &nbsp;&nbsp;&nbsp;
                    <strong>Kabupaten:</strong> {{ $form->kabupaten }}
                </td>
            </tr>
            <tr>
                <td class="label-col">Pendidikan terakhir:</td>
                <td class="value-col">
                    <span class="checkbox-symbol {{ $form->pendidikan == 'sd' ? 'checked' : '' }}">{{ $form->pendidikan == 'sd' ? '☑' : '☐' }}</span> SD &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->pendidikan == 'sltp' ? 'checked' : '' }}">{{ $form->pendidikan == 'sltp' ? '☑' : '☐' }}</span> SLTP &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->pendidikan == 'slta' ? 'checked' : '' }}">{{ $form->pendidikan == 'slta' ? '☑' : '☐' }}</span> SLTA &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->pendidikan == 'pt' ? 'checked' : '' }}">{{ $form->pendidikan == 'pt' ? '☑' : '☐' }}</span> Perguruan Tinggi
                </td>
            </tr>
            <tr>
                <td class="label-col">Kepala rumah tangga perempuan?</td>
                <td class="value-col">
                    <span class="checkbox-symbol {{ $form->krt_perempuan == 'ya' ? 'checked' : '' }}">{{ $form->krt_perempuan == 'ya' ? '☑' : '☐' }}</span> Ya &nbsp;&nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->krt_perempuan == 'tidak' ? 'checked' : '' }}">{{ $form->krt_perempuan == 'tidak' ? '☑' : '☐' }}</span> Tidak
                </td>
            </tr>
            <tr>
                <td class="label-col">Jumlah anggota keluarga:</td>
                <td class="value-col">
                    <span class="checkbox-symbol {{ $form->jumlah_anggota == '3' ? 'checked' : '' }}">{{ $form->jumlah_anggota == '3' ? '☑' : '☐' }}</span> ≤ 3 orang &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->jumlah_anggota == '3_5' ? 'checked' : '' }}">{{ $form->jumlah_anggota == '3_5' ? '☑' : '☐' }}</span> 3-5 orang &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->jumlah_anggota == '5plus' ? 'checked' : '' }}">{{ $form->jumlah_anggota == '5plus' ? '☑' : '☐' }}</span> > 5 orang
                </td>
            </tr>
            <tr>
                <td class="label-col">Jumlah anak (<18 tahun):</td>
                <td class="value-col">
                    <span class="checkbox-symbol {{ $form->jumlah_anak == '1' ? 'checked' : '' }}">{{ $form->jumlah_anak == '1' ? '☑' : '☐' }}</span> 1 orang &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->jumlah_anak == '2' ? 'checked' : '' }}">{{ $form->jumlah_anak == '2' ? '☑' : '☐' }}</span> 2 orang &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->jumlah_anak == '3' ? 'checked' : '' }}">{{ $form->jumlah_anak == '3' ? '☑' : '☐' }}</span> 3 orang &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->jumlah_anak == '3plus' ? 'checked' : '' }}">{{ $form->jumlah_anak == '3plus' ? '☑' : '☐' }}</span> > 3 orang
                </td>
            </tr>
            <tr>
                <td class="label-col">Jumlah balita (<5 tahun):</td>
                <td class="value-col">
                    <span class="checkbox-symbol {{ $form->jumlah_balita == '1' ? 'checked' : '' }}">{{ $form->jumlah_balita == '1' ? '☑' : '☐' }}</span> 1 orang &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->jumlah_balita == '2' ? 'checked' : '' }}">{{ $form->jumlah_balita == '2' ? '☑' : '☐' }}</span> 2 orang &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->jumlah_balita == '3' ? 'checked' : '' }}">{{ $form->jumlah_balita == '3' ? '☑' : '☐' }}</span> 3 orang &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->jumlah_balita == '3plus' ? 'checked' : '' }}">{{ $form->jumlah_balita == '3plus' ? '☑' : '☐' }}</span> > 3 orang
                </td>
            </tr>
            <tr>
                <td class="label-col">Tipe hunian sekarang:</td>
                <td class="value-col">
                    <span class="checkbox-symbol {{ $form->tipe_hunian == 'sendiri' ? 'checked' : '' }}">{{ $form->tipe_hunian == 'sendiri' ? '☑' : '☐' }}</span> Rumah tinggal sendiri &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->tipe_hunian == 'tumpangan' ? 'checked' : '' }}">{{ $form->tipe_hunian == 'tumpangan' ? '☑' : '☐' }}</span> Rumah tumpangan &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->tipe_hunian == 'huntara' ? 'checked' : '' }}">{{ $form->tipe_hunian == 'huntara' ? '☑' : '☐' }}</span> Huntara &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->tipe_hunian == 'pengungsian' ? 'checked' : '' }}">{{ $form->tipe_hunian == 'pengungsian' ? '☑' : '☐' }}</span> Pengungsian &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->tipe_hunian == 'fasum' ? 'checked' : '' }}">{{ $form->tipe_hunian == 'fasum' ? '☑' : '☐' }}</span> Fasilitas umum &nbsp;&nbsp;
                    <span class="checkbox-symbol {{ $form->tipe_hunian == 'lain' ? 'checked' : '' }}">{{ $form->tipe_hunian == 'lain' ? '☑' : '☐' }}</span> Lain-lain
                </td>
            </tr>
        </table>

        <!-- Page Break -->
        <div class="page-break"></div>

        <!-- Daftar Pertanyaan -->
        <div class="section-header">DAFTAR PERTANYAAN</div>
        <table class="question-table">
            <thead>
                <tr>
                    <th class="question-number">No</th>
                    <th class="question-text">Pertanyaan</th>
                    <th class="answer-text">Jawaban</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="question-number">1</td>
                    <td>Sebelum bencana, siapa sajakah pencari nafkah?</td>
                    <td>
                        <span class="checkbox-symbol {{ in_array('suami', $form->nafkah_pre) ? 'checked' : '' }}">{{ in_array('suami', $form->nafkah_pre) ? '☑' : '☐' }}</span> Suami &nbsp;
                        <span class="checkbox-symbol {{ in_array('istri', $form->nafkah_pre) ? 'checked' : '' }}">{{ in_array('istri', $form->nafkah_pre) ? '☑' : '☐' }}</span> Istri &nbsp;
                        <span class="checkbox-symbol {{ in_array('anak', $form->nafkah_pre) ? 'checked' : '' }}">{{ in_array('anak', $form->nafkah_pre) ? '☑' : '☐' }}</span> Anak &nbsp;
                        <span class="checkbox-symbol {{ in_array('lainnya', $form->nafkah_pre) ? 'checked' : '' }}">{{ in_array('lainnya', $form->nafkah_pre) ? '☑' : '☐' }}</span> Lainnya
                    </td>
                </tr>
                <tr>
                    <td class="question-number">2</td>
                    <td>Setelah bencana, siapa pencari nafkah keluarga yang masih bekerja?</td>
                    <td>
                        <span class="checkbox-symbol {{ in_array('suami', $form->nafkah_post) ? 'checked' : '' }}">{{ in_array('suami', $form->nafkah_post) ? '☑' : '☐' }}</span> Suami &nbsp;
                        <span class="checkbox-symbol {{ in_array('istri', $form->nafkah_post) ? 'checked' : '' }}">{{ in_array('istri', $form->nafkah_post) ? '☑' : '☐' }}</span> Istri &nbsp;
                        <span class="checkbox-symbol {{ in_array('anak', $form->nafkah_post) ? 'checked' : '' }}">{{ in_array('anak', $form->nafkah_post) ? '☑' : '☐' }}</span> Anak &nbsp;
                        <span class="checkbox-symbol {{ in_array('lainnya', $form->nafkah_post) ? 'checked' : '' }}">{{ in_array('lainnya', $form->nafkah_post) ? '☑' : '☐' }}</span> Lainnya
                    </td>
                </tr>
                <tr>
                    <td class="question-number">3</td>
                    <td>Sebutkan tiga sumber utama penghasilan keluarga sebelum bencana</td>
                    <td>
                        <span class="checkbox-symbol {{ in_array('pertanian', $form->sumber_penghasilan) ? 'checked' : '' }}">{{ in_array('pertanian', $form->sumber_penghasilan) ? '☑' : '☐' }}</span> Pertanian &nbsp;
                        <span class="checkbox-symbol {{ in_array('peternakan', $form->sumber_penghasilan) ? 'checked' : '' }}">{{ in_array('peternakan', $form->sumber_penghasilan) ? '☑' : '☐' }}</span> Peternakan &nbsp;
                        <span class="checkbox-symbol {{ in_array('dagang', $form->sumber_penghasilan) ? 'checked' : '' }}">{{ in_array('dagang', $form->sumber_penghasilan) ? '☑' : '☐' }}</span> Perdagangan &nbsp;
                        <span class="checkbox-symbol {{ in_array('industri', $form->sumber_penghasilan) ? 'checked' : '' }}">{{ in_array('industri', $form->sumber_penghasilan) ? '☑' : '☐' }}</span> Industri &nbsp;
                        <span class="checkbox-symbol {{ in_array('jasa', $form->sumber_penghasilan) ? 'checked' : '' }}">{{ in_array('jasa', $form->sumber_penghasilan) ? '☑' : '☐' }}</span> Jasa
                    </td>
                </tr>
                <tr>
                    <td class="question-number">4</td>
                    <td>Adakah sumber penghasilan keluarga yang hilang/menurun setelah bencana?</td>
                    <td>
                        <span class="checkbox-symbol {{ $form->penghasilan_hilang == 'ada' ? 'checked' : '' }}">{{ $form->penghasilan_hilang == 'ada' ? '☑' : '☐' }}</span> Ada &nbsp;&nbsp;
                        <span class="checkbox-symbol {{ $form->penghasilan_hilang == 'tidak' ? 'checked' : '' }}">{{ $form->penghasilan_hilang == 'tidak' ? '☑' : '☐' }}</span> Tidak
                    </td>
                </tr>
                <tr>
                    <td class="question-number">5</td>
                    <td>Bantuan yang paling dibutuhkan untuk memulihkan mata pencaharian?</td>
                    <td>
                        <span class="checkbox-symbol {{ in_array('keterampilan', $form->bantuan_pencaharian) ? 'checked' : '' }}">{{ in_array('keterampilan', $form->bantuan_pencaharian) ? '☑' : '☐' }}</span> Keterampilan &nbsp;
                        <span class="checkbox-symbol {{ in_array('peralatan', $form->bantuan_pencaharian) ? 'checked' : '' }}">{{ in_array('peralatan', $form->bantuan_pencaharian) ? '☑' : '☐' }}</span> Peralatan &nbsp;
                        <span class="checkbox-symbol {{ in_array('modal', $form->bantuan_pencaharian) ? 'checked' : '' }}">{{ in_array('modal', $form->bantuan_pencaharian) ? '☑' : '☐' }}</span> Modal &nbsp;
                        <span class="checkbox-symbol {{ in_array('pasar', $form->bantuan_pencaharian) ? 'checked' : '' }}">{{ in_array('pasar', $form->bantuan_pencaharian) ? '☑' : '☐' }}</span> Akses Pasar
                    </td>
                </tr>
                <tr>
                    <td class="question-number">6</td>
                    <td>Sumber cadangan keluarga yang terganggu setelah bencana <br><em>(Pilih maksimal tiga)</em></td>
                    <td>
                        <span class="checkbox-symbol {{ in_array('tabungan', $form->cadangan) ? 'checked' : '' }}">{{ in_array('tabungan', $form->cadangan) ? '☑' : '☐' }}</span> Tabungan &nbsp;
                        <span class="checkbox-symbol {{ in_array('pinjaman', $form->cadangan) ? 'checked' : '' }}">{{ in_array('pinjaman', $form->cadangan) ? '☑' : '☐' }}</span> Pinjaman &nbsp;
                        <span class="checkbox-symbol {{ in_array('barang', $form->cadangan) ? 'checked' : '' }}">{{ in_array('barang', $form->cadangan) ? '☑' : '☐' }}</span> Barang &nbsp;
                        <span class="checkbox-symbol {{ in_array('ternak', $form->cadangan) ? 'checked' : '' }}">{{ in_array('ternak', $form->cadangan) ? '☑' : '☐' }}</span> Ternak &nbsp;
                        <span class="checkbox-symbol {{ in_array('jamsos', $form->cadangan) ? 'checked' : '' }}">{{ in_array('jamsos', $form->cadangan) ? '☑' : '☐' }}</span> Jaminan Sosial
                    </td>
                </tr>
                <tr>
                    <td class="question-number">7</td>
                    <td>Dukungan untuk memulihkan sumber cadangan</td>
                    <td>
                        <span class="checkbox-symbol {{ in_array('koperasi', $form->dukungan_cadangan) ? 'checked' : '' }}">{{ in_array('koperasi', $form->dukungan_cadangan) ? '☑' : '☐' }}</span> Koperasi &nbsp;
                        <span class="checkbox-symbol {{ in_array('kelompok', $form->dukungan_cadangan) ? 'checked' : '' }}">{{ in_array('kelompok', $form->dukungan_cadangan) ? '☑' : '☐' }}</span> Kelompok Usaha &nbsp;
                        <span class="checkbox-symbol {{ in_array('pinjaman', $form->dukungan_cadangan) ? 'checked' : '' }}">{{ in_array('pinjaman', $form->dukungan_cadangan) ? '☑' : '☐' }}</span> Pinjaman &nbsp;
                        <span class="checkbox-symbol {{ in_array('pemerintah', $form->dukungan_cadangan) ? 'checked' : '' }}">{{ in_array('pemerintah', $form->dukungan_cadangan) ? '☑' : '☐' }}</span> Bantuan pemerintah
                    </td>
                </tr>
                <tr>
                    <td class="question-number">8</td>
                    <td>Perlindungan perempuan dan anak dari kekerasan</td>
                    <td>
                        <span class="checkbox-symbol {{ $form->perlindungan == 'meningkat' ? 'checked' : '' }}">{{ $form->perlindungan == 'meningkat' ? '☑' : '☐' }}</span> Meningkat &nbsp;&nbsp;
                        <span class="checkbox-symbol {{ $form->perlindungan == 'menurun' ? 'checked' : '' }}">{{ $form->perlindungan == 'menurun' ? '☑' : '☐' }}</span> Menurun &nbsp;&nbsp;
                        <span class="checkbox-symbol {{ $form->perlindungan == 'sama' ? 'checked' : '' }}">{{ $form->perlindungan == 'sama' ? '☑' : '☐' }}</span> Sama saja
                    </td>
                </tr>
                <tr>
                    <td class="question-number">9</td>
                    <td>Bantuan untuk meningkatkan perlindungan perempuan & anak</td>
                    <td>
                        <span class="checkbox-symbol checked">☑</span> Penyuluhan &nbsp;
                        <span class="checkbox-symbol">☐</span> Penguatan moral &nbsp;
                        <span class="checkbox-symbol checked">☑</span> Polisi keliling &nbsp;
                        <span class="checkbox-symbol">☐</span> Pos Pengaduan
                    </td>
                </tr>
                <tr>
                    <td class="question-number">10</td>
                    <td>Masalah perumahan setelah bencana</td>
                    <td>
                        <span class="checkbox-symbol">☐</span> Harus relokasi &nbsp;
                        <span class="checkbox-symbol checked">☑</span> Rusak &nbsp;
                        <span class="checkbox-symbol">☐</span> Belum punya rumah
                    </td>
                </tr>
                <tr>
                    <td class="question-number">11</td>
                    <td>Tindakan untuk mengatasi masalah perumahan</td>
                    <td>
                        <span class="checkbox-symbol checked">☑</span> Stimulus rumah &nbsp;
                        <span class="checkbox-symbol">☐</span> Kredit &nbsp;
                        <span class="checkbox-symbol checked">☑</span> Bantuan teknis
                    </td>
                </tr>
                <tr>
                    <td class="question-number">12</td>
                    <td>Perkiraan tempat tinggal satu tahun dari sekarang</td>
                    <td>
                        <span class="checkbox-symbol checked">☑</span> Di rumah asal &nbsp;&nbsp;
                        <span class="checkbox-symbol">☐</span> Di desa asal &nbsp;&nbsp;
                        <span class="checkbox-symbol">☐</span> Di tempat lain
                    </td>
                </tr>
                <tr>
                    <td class="question-number">13</td>
                    <td>Cara mendapatkan makanan dalam 3 minggu ke depan</td>
                    <td>
                        <span class="checkbox-symbol checked">☑</span> Bantuan &nbsp;
                        <span class="checkbox-symbol checked">☑</span> Cadangan &nbsp;
                        <span class="checkbox-symbol">☐</span> Sisa tanaman
                    </td>
                </tr>
                <tr>
                    <td class="question-number">14</td>
                    <td>Dukungan untuk mengatasi masalah pangan</td>
                    <td>
                        <span class="checkbox-symbol checked">☑</span> Pangan langsung &nbsp;
                        <span class="checkbox-symbol">☐</span> Pemulihan pangan &nbsp;
                        <span class="checkbox-symbol">☐</span> Gotong royong
                    </td>
                </tr>
                <tr>
                    <td class="question-number">15</td>
                    <td>Masalah air bersih yang dihadapi</td>
                    <td>
                        <span class="checkbox-symbol checked">☑</span> Kurang &nbsp;
                        <span class="checkbox-symbol">☐</span> Tidak bersih &nbsp;
                        <span class="checkbox-symbol">☐</span> Penyimpanan
                    </td>
                </tr>
                <tr>
                    <td class="question-number">16</td>
                    <td>Dukungan untuk mengatasi masalah air bersih</td>
                    <td>
                        <span class="checkbox-symbol checked">☑</span> Penyediaan air &nbsp;
                        <span class="checkbox-symbol">☐</span> Pemulihan &nbsp;
                        <span class="checkbox-symbol checked">☑</span> Sarana simpan
                    </td>
                </tr>
                <tr>
                    <td class="question-number">17</td>
                    <td>Tingkat pelayanan kesehatan keluarga</td>
                    <td>
                        <span class="checkbox-symbol">☐</span> Memadai &nbsp;&nbsp;
                        <span class="checkbox-symbol checked">☑</span> Tidak memadai
                    </td>
                </tr>
                <tr>
                    <td class="question-number">18</td>
                    <td>Perbaikan yang diperlukan untuk pelayanan kesehatan</td>
                    <td>
                        <span class="checkbox-symbol checked">☑</span> Obat &nbsp;
                        <span class="checkbox-symbol checked">☑</span> Tenaga Medis &nbsp;
                        <span class="checkbox-symbol">☐</span> Jarak &nbsp;
                        <span class="checkbox-symbol">☐</span> Biaya
                    </td>
                </tr>
                <tr>
                    <td class="question-number">19</td>
                    <td>Apakah kegiatan sekolah anak terganggu?</td>
                    <td>
                        <span class="checkbox-symbol checked">☑</span> Ya &nbsp;&nbsp;
                        <span class="checkbox-symbol">☐</span> Tidak
                    </td>
                </tr>
                <tr>
                    <td class="question-number">20</td>
                    <td>Dukungan pendidikan anak setelah bencana</td>
                    <td>
                        <span class="checkbox-symbol">☐</span> Guru &nbsp;
                        <span class="checkbox-symbol checked">☑</span> Perlengkapan &nbsp;
                        <span class="checkbox-symbol checked">☑</span> Biaya &nbsp;
                        <span class="checkbox-symbol">☐</span> Transport
                    </td>
                </tr>
                <tr>
                    <td class="question-number">21</td>
                    <td>Apakah kegiatan tradisional/keagamaan terganggu?</td>
                    <td>
                        <span class="checkbox-symbol">☐</span> Ya &nbsp;&nbsp;
                        <span class="checkbox-symbol checked">☑</span> Tidak
                    </td>
                </tr>
                <tr>
                    <td class="question-number">22</td>
                    <td>Dukungan kegiatan tradisional/keagamaan</td>
                    <td>
                        <span class="checkbox-symbol checked">☑</span> Stimulasi &nbsp;
                        <span class="checkbox-symbol">☐</span> Pelatihan &nbsp;
                        <span class="checkbox-symbol">☐</span> Perizinan
                    </td>
                </tr>
                <tr>
                    <td class="question-number">23</td>
                    <td>Kegiatan pencegahan dampak bencana di masa depan</td>
                    <td>
                        <span class="checkbox-symbol checked">☑</span> Info &nbsp;
                        <span class="checkbox-symbol checked">☑</span> Pelatihan &nbsp;
                        <span class="checkbox-symbol">☐</span> Rencana &nbsp;
                        <span class="checkbox-symbol">☐</span> Fasilitas
                    </td>
                </tr>
                <tr>
                    <td class="question-number">24</td>
                    <td>Kelompok yang paling membutuhkan bantuan</td>
                    <td>
                        <span class="checkbox-symbol checked">☑</span> Anak-anak &nbsp;
                        <span class="checkbox-symbol checked">☑</span> Lansia &nbsp;
                        <span class="checkbox-symbol">☐</span> Difabel &nbsp;
                        <span class="checkbox-symbol">☐</span> Ibu hamil
                    </td>
                </tr>
                <tr>
                    <td class="question-number">25</td>
                    <td>Penghasilan tiap bulan (sebelum bencana)</td>
                    <td>
                        <strong>Suami:</strong> {{ $form->penghasilan_suami }} ({{ $form->bidang_suami }}) <br>
                        <strong>Istri:</strong> {{ $form->penghasilan_istri }} ({{ $form->bidang_istri }}) <br>
                        <strong>Lainnya:</strong> {{ $form->penghasilan_lainnya }} ({{ $form->bidang_lainnya }})
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Footer & Signature -->
        <div class="footer">
            <p>{{ $form->kabupaten }}, {{ \Carbon\Carbon::parse($form->tgl_wawancara)->format('d F Y') }}</p>
            <p>Petugas Pendataan</p>
            <div class="signature-box">
                <p><strong>{{ $form->enumerator }}</strong></p>
            </div>
        </div>

        <!-- Additional Info -->
        <div style="margin-top: 50px; border-top: 2px solid #333; padding-top: 10px; text-align: center; font-size: 10pt; color: #666;">
            <p><em>Ini adalah contoh formulir untuk referensi. Data yang ditampilkan adalah data dummy/contoh.</em></p>
            <p><strong>JITUPASNA</strong> - Sistem Informasi Pengkajian Kebutuhan Pasca Bencana</p>
        </div>
    </div>
</body>
</html>
