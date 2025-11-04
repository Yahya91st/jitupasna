@extends('layouts.main')

@section('content')
    <style>
        /* Container & Layout */
        .form-container {
            max-width: 900px;
            font-family: 'Times New Roman', serif;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Header Styling */
        .form-header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }

        .form-header h5 {
            margin: 0.5rem 0;
            font-weight: bold;
            color: #333;
        }

        .form-header h5:first-child {
            color: #0066cc;
            margin-bottom: 0.3rem;
        }

        /* Card Styling */
        .main-card {
            background: white;
            border-radius: 4px;
            overflow: hidden;
        }

        .card-body {
            padding: 20px;
        }

        /* Table Styling */
        .table {
            border: 1px solid #ddd;
            margin-bottom: 1.5rem;
            font-size: 14px;
            border-radius: 4px;
            overflow: hidden;
        }

        .table td,
        .table th {
            padding: 8px 12px;
            border: 1px solid #ddd;
            vertical-align: middle;
        }

        .table thead th {
            background: #f9f9f9;
            color: #333;
            font-weight: 600;
            text-align: center;
            border-bottom: 2px solid #ddd;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 102, 204, 0.05);
            transition: background-color 0.2s ease;
        }

        /* Section Headers */
        .section-header {
            background: #f9f9f9;
            color: #333;
            font-weight: 600;
            padding: 10px 15px;
            margin: 20px 0 15px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Form Inputs */
        .inline-input {
            background: transparent;
            border: none;
            border-bottom: 1px dotted #333;
            font-family: 'Times New Roman', serif;
            font-size: 14px;
            color: inherit;
            outline: none;
            padding: 2px 4px;
            transition: border-color 0.3s ease;
        }

        .inline-input:focus {
            border-bottom-color: #0066cc;
            background-color: rgba(0, 102, 204, 0.05);
        }

        /* Income Group Styling for Question 25 */
        .income-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding: 0.5rem 0;
        }

        .income-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 0.3rem;
        }

        .income-row strong {
            min-width: 60px;
            font-weight: bold;
            color: #000;
        }

        /* Radio Button Styling */
        input[type="radio"],
        input[type="checkbox"] {
            transform: scale(1.1);
            margin-right: 0.5rem;
            margin-left: 0.2rem;
            accent-color: #0066cc;
            vertical-align: middle;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            align-items: center;
            padding: 0.3rem 0;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            margin-right: 1.2rem;
            margin-bottom: 0.4rem;
            white-space: nowrap;
        }

        .checkbox-item label {
            margin: 0;
            font-weight: 500;
            cursor: pointer;
            user-select: none;
            color: #333;
        }

        /* Question Table */
        .question-table {
            border: 1px solid #ddd;
        }

        .question-table .question-cell {
            background-color: #f9f9f9;
            font-weight: 500;
            border-right: 1px solid #ddd;
            color: #333;
        }

        .question-table .answer-cell {
            background-color: white;
            padding: 12px;
        }

        .question-number {
            background: #f9f9f9;
            color: #333;
            font-weight: bold;
            text-align: center;
            width: 40px;
            border: 1px solid #ddd;
        }

        /* Button Styling */
        .action-buttons {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .btn {
            margin: 0 5px;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-warning {
            background: #ffc107;
            color: #212529;
        }

        .btn-info {
            background: #17a2b8;
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                padding: 10px;
            }

            .table {
                font-size: 12px;
            }

            .inline-input {
                font-size: 12px;
            }

            .checkbox-group {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn {
                margin: 2px;
                padding: 6px 12px;
                font-size: 12px;
            }
        }

        /* Print Styles */
        @media print {
            .action-buttons {
                display: none !important;
            }

            .form-container {
                box-shadow: none;
                margin: 0;
                padding: 10px;
            }

            .main-card {
                box-shadow: none;
                border: 1px solid #000;
            }

            body {
                font-size: 12pt;
                line-height: 1.4;
            }
        }
    </style>

    <form method="POST" action="{{ route('forms.form6.store') }}">
        @csrf
        <input type="hidden" name="form_type" value="form6">
        <input type="hidden" name="bencana_id" value="{{ request('bencana_id') }}">

        <div class="form-container">
            <!-- Document Header -->
            <div class="form-header">
                <h5><strong>Formulir 06</strong></h5>
                <h5>Pendataan Tingkat Rumahtangga</h5>
            </div>

            <div class="main-card">
                <div class="card-body">

                    <!-- Data Collection Section -->
                    <div class="section-header">
                        PENGUMPULAN DATA
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td style="background-color: #e9ecef; font-weight: 600;">Pengumpulan data</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox-group">
                                    <span><strong>Nama enumerator:</strong></span>
                                    <input type="text" name="enumerator" class="inline-input" style="width: 25%;" placeholder="Nama enumerator">
                                    <span><strong>Tanggal wawancara:</strong></span>
                                    <input type="date" name="tgl_wawancara" class="inline-input" style="width: 20%;">
                                    <span><strong>Paraf:</strong></span>
                                    <input type="text" name="paraf_enum" class="inline-input" style="width: 15%;" placeholder="Paraf">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #e9ecef; font-weight: 600;">Perekaman data</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox-group">
                                    <span><strong>Data entry oleh:</strong></span>
                                    <input type="text" name="data_entry" class="inline-input" style="width: 25%;" placeholder="Nama data entry">
                                    <span><strong>Tanggal:</strong></span>
                                    <input type="date" name="tgl_entry" class="inline-input" style="width: 20%;">
                                    <span><strong>Paraf:</strong></span>
                                    <input type="text" name="paraf_entry" class="inline-input" style="width: 15%;" placeholder="Paraf">
                                </div>
                            </td>
                        </tr>
                    </table>

                    <!-- General Information Section -->
                    <div class="section-header">
                        INFORMASI UMUM
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 30%; font-weight: 600; background-color: #f8f9fa;">Responden:</td>
                            <td>
                                <div class="checkbox-group">
                                    <div class="checkbox-item">
                                        <input type="radio" name="responden" value="l" id="resp_l">
                                        <label for="resp_l">Laki-laki</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="responden" value="p" id="resp_p">
                                        <label for="resp_p">Perempuan</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; background-color: #f8f9fa;">Umur:</td>
                            <td>
                                <div class="checkbox-group">
                                    <div class="checkbox-item">
                                        <input type="radio" name="umur" value="20" id="umur1">
                                        <label for="umur1">≤ 20 tahun</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="umur" value="21_30" id="umur2">
                                        <label for="umur2">21-30 tahun</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="umur" value="31_40" id="umur3">
                                        <label for="umur3">31-40 tahun</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="umur" value="41_50" id="umur4">
                                        <label for="umur4">41-50 tahun</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="umur" value="50plus" id="umur5">
                                        <label for="umur5">> 50 tahun</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; background-color: #f8f9fa;">Nama:</td>
                            <td><input type="text" name="nama" class="inline-input" style="width: 100%;" placeholder="Masukkan nama lengkap"></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; background-color: #f8f9fa;">Lokasi:</td>
                            <td>
                                <div class="checkbox-group">
                                    <span><strong>Desa/kelurahan:</strong></span>
                                    <input type="text" name="desa" class="inline-input" style="width: 25%;" placeholder="Desa">
                                    <span><strong>Kecamatan:</strong></span>
                                    <input type="text" name="kecamatan" class="inline-input" style="width: 25%;" placeholder="Kecamatan">
                                    <span><strong>Kabupaten:</strong></span>
                                    <input type="text" name="kabupaten" class="inline-input" style="width: 25%;" placeholder="Kabupaten">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; background-color: #f8f9fa;">Pendidikan terakhir:</td>
                            <td>
                                <div class="checkbox-group">
                                    <div class="checkbox-item">
                                        <input type="radio" name="pendidikan" value="sd" id="pend1">
                                        <label for="pend1">SD</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="pendidikan" value="sltp" id="pend2">
                                        <label for="pend2">SLTP</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="pendidikan" value="slta" id="pend3">
                                        <label for="pend3">SLTA</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="pendidikan" value="pt" id="pend4">
                                        <label for="pend4">Perguruan Tinggi</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; background-color: #f8f9fa;">Kepala rumah tangga perempuan?</td>
                            <td>
                                <div class="checkbox-group">
                                    <div class="checkbox-item">
                                        <input type="radio" name="krt_perempuan" value="ya" id="krt1">
                                        <label for="krt1">Ya</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="krt_perempuan" value="tidak" id="krt2">
                                        <label for="krt2">Tidak</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; background-color: #f8f9fa;">Jumlah anggota keluarga:</td>
                            <td>
                                <div class="checkbox-group">
                                    <div class="checkbox-item">
                                        <input type="radio" name="jumlah_anggota" value="3" id="anggota1">
                                        <label for="anggota1">≤ 3 orang</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="jumlah_anggota" value="3_5" id="anggota2">
                                        <label for="anggota2">3-5 orang</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="jumlah_anggota" value="5plus" id="anggota3">
                                        <label for="anggota3">> 5 orang</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; background-color: #f8f9fa;">Jumlah anak (<18 tahun):</td>
                            <td>
                                <div class="checkbox-group">
                                    <div class="checkbox-item">
                                        <input type="radio" name="jumlah_anak" value="1" id="anak1">
                                        <label for="anak1">1 orang</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="jumlah_anak" value="2" id="anak2">
                                        <label for="anak2">2 orang</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="jumlah_anak" value="3" id="anak3">
                                        <label for="anak3">3 orang</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="jumlah_anak" value="3plus" id="anak4">
                                        <label for="anak4">> 3 orang</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; background-color: #f8f9fa;">Jumlah balita (<5 tahun):</td>
                            <td>
                                <div class="checkbox-group">
                                    <div class="checkbox-item">
                                        <input type="radio" name="jumlah_balita" value="1" id="balita1">
                                        <label for="balita1">1 orang</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="jumlah_balita" value="2" id="balita2">
                                        <label for="balita2">2 orang</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="jumlah_balita" value="3" id="balita3">
                                        <label for="balita3">3 orang</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="jumlah_balita" value="3plus" id="balita4">
                                        <label for="balita4">> 3 orang</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; background-color: #f8f9fa;">Tipe hunian sekarang:</td>
                            <td>
                                <div class="checkbox-group">
                                    <div class="checkbox-item">
                                        <input type="radio" name="tipe_hunian" value="sendiri" id="hunian1">
                                        <label for="hunian1">Rumah tinggal sendiri</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="tipe_hunian" value="tumpangan" id="hunian2">
                                        <label for="hunian2">Rumah tumpangan</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="tipe_hunian" value="huntara" id="hunian3">
                                        <label for="hunian3">Huntara</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="tipe_hunian" value="pengungsian" id="hunian4">
                                        <label for="hunian4">Pengungsian</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="tipe_hunian" value="fasum" id="hunian5">
                                        <label for="hunian5">Fasilitas umum</label>
                                    </div>
                                    <div class="checkbox-item">
                                        <input type="radio" name="tipe_hunian" value="lain" id="hunian6">
                                        <label for="hunian6">Lain-lain</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <!-- Questions Section -->
                    <div class="section-header">
                        DAFTAR PERTANYAAN
                    </div>
                    <table class="table question-table">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 55%;">Pertanyaan</th>
                                <th style="width: 40%;">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="question-number">1</td>
                                <td class="question-cell">Sebelum bencana, siapa sajakah pencari nafkah?</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="nafkah_pre_suami" value="0">
                                            <input type="checkbox" name="nafkah_pre_suami" id="nafkah1" value="1">
                                            <label for="nafkah1">Suami</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="nafkah_pre_istri" value="0">
                                            <input type="checkbox" name="nafkah_pre_istri" id="nafkah2" value="1">
                                            <label for="nafkah2">Istri</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="nafkah_pre_anak" value="0">
                                            <input type="checkbox" name="nafkah_pre_anak" id="nafkah3" value="1">
                                            <label for="nafkah3">Anak (<18 tahun)>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="nafkah_pre_lain" value="0">
                                            <input type="checkbox" name="nafkah_pre_lain" id="nafkah4" value="1">
                                            <label for="nafkah4">Lainnya:</label>
                                            <input type="text" name="nafkah_pre_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">2</td>
                                <td class="question-cell">Setelah bencana, siapa pencari nafkah keluarga yang masih bekerja?</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="nafkah_post_suami" value="0">
                                            <input type="checkbox" name="nafkah_post_suami" id="nafkah_post1" value="1">
                                            <label for="nafkah_post1">Suami</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="nafkah_post_istri" value="0">
                                            <input type="checkbox" name="nafkah_post_istri" id="nafkah_post2" value="1">
                                            <label for="nafkah_post2">Istri</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="nafkah_post_anak" value="0">
                                            <input type="checkbox" name="nafkah_post_anak" id="nafkah_post3" value="1">
                                            <label for="nafkah_post3">Anak (<18 tahun)>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="nafkah_post_lain" value="0">
                                            <input type="checkbox" name="nafkah_post_lain" id="nafkah_post4" value="1">
                                            <label for="nafkah_post4">Lainnya:</label>
                                            <input type="text" name="nafkah_post_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">3</td>
                                <td class="question-cell">Sebutkan tiga sumber utama penghasilan keluarga sebelum bencana</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="sumber_pertanian" value="0">
                                            <input type="checkbox" name="sumber_pertanian" id="sumber1" value="1">
                                            <label for="sumber1">Pertanian</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="sumber_peternakan" value="0">
                                            <input type="checkbox" name="sumber_peternakan" id="sumber2" value="1">
                                            <label for="sumber2">Peternakan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="sumber_dagang" value="0">
                                            <input type="checkbox" name="sumber_dagang" id="sumber3" value="1">
                                            <label for="sumber3">Perdagangan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="sumber_industri" value="0">
                                            <input type="checkbox" name="sumber_industri" id="sumber4" value="1">
                                            <label for="sumber4">Industri</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="sumber_jasa" value="0">
                                            <input type="checkbox" name="sumber_jasa" id="sumber5" value="1">
                                            <label for="sumber5">Jasa</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="sumber_pegawai" value="0">
                                            <input type="checkbox" name="sumber_pegawai" id="sumber6" value="1">
                                            <label for="sumber6">Pegawai</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="sumber_pertukangan" value="0">
                                            <input type="checkbox" name="sumber_pertukangan" id="sumber7" value="1">
                                            <label for="sumber7">Pertukangan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="sumber_lain" value="0">
                                            <input type="checkbox" name="sumber_lain" id="sumber8" value="1">
                                            <label for="sumber8">Lainnya:</label>
                                            <input type="text" name="sumber_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">4</td>
                                <td class="question-cell">Adakah sumber penghasilan keluarga yang hilang/menurun setelah bencana?</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="radio" name="penghasilan_hilang" value="ada" id="penghasilan1">
                                            <label for="penghasilan1">Ada</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="radio" name="penghasilan_hilang" value="tidak" id="penghasilan2">
                                            <label for="penghasilan2">Tidak</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">5</td>
                                <td class="question-cell">Bantuan yang paling dibutuhkan untuk memulihkan mata pencaharian?</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="bantuan_keterampilan" value="0">
                                            <input type="checkbox" name="bantuan_keterampilan" id="bantuan1" value="1">
                                            <label for="bantuan1">Keterampilan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="bantuan_peralatan" value="0">
                                            <input type="checkbox" name="bantuan_peralatan" id="bantuan2" value="1">
                                            <label for="bantuan2">Peralatan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="bantuan_modal" value="0">
                                            <input type="checkbox" name="bantuan_modal" id="bantuan3" value="1">
                                            <label for="bantuan3">Modal</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="bantuan_pasar" value="0">
                                            <input type="checkbox" name="bantuan_pasar" id="bantuan4" value="1">
                                            <label for="bantuan4">Akses Pasar</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="bantuan_lain" value="0">
                                            <input type="checkbox" name="bantuan_lain" id="bantuan5" value="1">
                                            <label for="bantuan5">Lain-lain:</label>
                                            <input type="text" name="bantuan_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Sumber cadangan keluarga yang terganggu setelah bencana <br><em>(Pilih maksimal tiga)</em></td>
                                <td>
                                    <input type="hidden" name="cadangan_tabungan" value="0">
                                    <input type="checkbox" name="cadangan_tabungan" value="1"> Tabungan
                                    <input type="hidden" name="cadangan_pinjaman" value="0">
                                    <input type="checkbox" name="cadangan_pinjaman" value="1"> Pinjaman
                                    <input type="hidden" name="cadangan_barang" value="0">
                                    <input type="checkbox" name="cadangan_barang" value="1"> Barang
                                    <input type="hidden" name="cadangan_ternak" value="0">
                                    <input type="checkbox" name="cadangan_ternak" value="1"> Ternak
                                    <input type="hidden" name="cadangan_jamsos" value="0">
                                    <input type="checkbox" name="cadangan_jamsos" value="1"> Jaminan Sosial
                                    <input type="hidden" name="cadangan_lain" value="0">
                                    <input type="checkbox" name="cadangan_lain"> Lainnya: <input type="text" name="cadangan_lain_text" style="width: 30%; border: none; border-bottom: 1px solid #ccc;">
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">7</td>
                                <td class="question-cell">Dukungan untuk memulihkan sumber cadangan</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_koperasi" value="0">
                                            <input type="checkbox" name="dukungan_koperasi" id="dukungan1" value="1">
                                            <label for="dukungan1">Koperasi</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_kelompok" value="0">
                                            <input type="checkbox" name="dukungan_kelompok" id="dukungan2" value="1">
                                            <label for="dukungan2">Kelompok Usaha</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_pinjaman" value="0">
                                            <input type="checkbox" name="dukungan_pinjaman" id="dukungan3" value="1">
                                            <label for="dukungan3">Pinjaman</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_pemerintah" value="0">
                                            <input type="checkbox" name="dukungan_pemerintah" id="dukungan4" value="1">
                                            <label for="dukungan4">Bantuan pemerintah</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_lain" value="0">
                                            <input type="checkbox" name="dukungan_lain" id="dukungan5" value="1">
                                            <label for="dukungan5">Lainnya:</label>
                                            <input type="text" name="dukungan_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">8</td>
                                <td class="question-cell">Perlindungan perempuan dan anak dari kekerasan</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="radio" name="perlindungan" value="meningkat" id="perlindungan1" value="1">
                                            <label for="perlindungan1">Meningkat</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="radio" name="perlindungan" value="menurun" id="perlindungan2" value="1">
                                            <label for="perlindungan2">Menurun</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="radio" name="perlindungan" value="sama" id="perlindungan3" value="1">
                                            <label for="perlindungan3">Sama saja</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">9</td>
                                <td class="question-cell">Bantuan untuk meningkatkan perlindungan perempuan & anak</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="bantu_lindung_penyuluhan" value="0">
                                            <input type="checkbox" name="bantu_lindung_penyuluhan" id="bantu_lindung1" value="1">
                                            <label for="bantu_lindung1">Penyuluhan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="bantu_lindung_moral" value="0">
                                            <input type="checkbox" name="bantu_lindung_moral" id="bantu_lindung2" value="1">
                                            <label for="bantu_lindung2">Penguatan moral</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="bantu_lindung_polisi" value="0">
                                            <input type="checkbox" name="bantu_lindung_polisi" id="bantu_lindung3" value="1">
                                            <label for="bantu_lindung3">Polisi keliling</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="bantu_lindung_pos" value="0">
                                            <input type="checkbox" name="bantu_lindung_pos" id="bantu_lindung4" value="1">
                                            <label for="bantu_lindung4">Pos Pengaduan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="bantu_lindung_rumah" value="0">
                                            <input type="checkbox" name="bantu_lindung_rumah" id="bantu_lindung5" value="1">
                                            <label for="bantu_lindung5">Rumah aman</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="bantu_lindung_lain" value="0">
                                            <input type="checkbox" name="bantu_lindung_lain" id="bantu_lindung6">
                                            <label for="bantu_lindung6">Lainnya:</label>
                                            <input type="text" name="bantu_lindung_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">10</td>
                                <td class="question-cell">Masalah perumahan setelah bencana</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="masalah_rumah_relokasi" value="0">
                                            <input type="checkbox" name="masalah_rumah_relokasi" id="masalah_rumah1" value="1">
                                            <label for="masalah_rumah1">Harus relokasi</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="masalah_rumah_rusak" value="0">
                                            <input type="checkbox" name="masalah_rumah_rusak" id="masalah_rumah2" value="1">
                                            <label for="masalah_rumah2">Rusak</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="masalah_rumah_belum" value="0">
                                            <input type="checkbox" name="masalah_rumah_belum" id="masalah_rumah3" value="1">
                                            <label for="masalah_rumah3">Belum punya rumah</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="masalah_rumah_lain" value="0">
                                            <input type="checkbox" name="masalah_rumah_lain" id="masalah_rumah4">
                                            <label for="masalah_rumah4">Lainnya:</label>
                                            <input type="text" name="masalah_rumah_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">11</td>
                                <td class="question-cell">Tindakan untuk mengatasi masalah perumahan</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="tindakan_rumah_stimulus" value="0">
                                            <input type="checkbox" name="tindakan_rumah_stimulus" id="tindakan_rumah1" value="1">
                                            <label for="tindakan_rumah1">Stimulus rumah</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="tindakan_rumah_kredit" value="0">
                                            <input type="checkbox" name="tindakan_rumah_kredit" id="tindakan_rumah2" value="1">
                                            <label for="tindakan_rumah2">Kredit</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="tindakan_rumah_teknis" value="0">
                                            <input type="checkbox" name="tindakan_rumah_teknis" id="tindakan_rumah3" value="1">
                                            <label for="tindakan_rumah3">Bantuan teknis</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="tindakan_rumah_lain" value="0">
                                            <input type="checkbox" name="tindakan_rumah_lain" id="tindakan_rumah4">
                                            <label for="tindakan_rumah4">Lainnya:</label>
                                            <input type="text" name="tindakan_rumah_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">12</td>
                                <td class="question-cell">Perkiraan tempat tinggal satu tahun dari sekarang</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="radio" name="perkiraan_tinggal" value="rumah_asal" id="perkiraan1" value="1">
                                            <label for="perkiraan1">Di rumah asal</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="radio" name="perkiraan_tinggal" value="desa_asal" id="perkiraan2" value="1">
                                            <label for="perkiraan2">Di desa asal</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="radio" name="perkiraan_tinggal" value="tempat_lain" id="perkiraan3">
                                            <label for="perkiraan3">Di tempat lain:</label>
                                            <input type="text" name="perkiraan_tempat_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan tempat">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">13</td>
                                <td class="question-cell">Cara mendapatkan makanan dalam 3 minggu ke depan</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="makanan_bantuan" value="0">
                                            <input type="checkbox" name="makanan_bantuan" id="makanan1" value="1">
                                            <label for="makanan1">Bantuan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="makanan_cadangan" value="0">
                                            <input type="checkbox" name="makanan_cadangan" id="makanan2" value="1">
                                            <label for="makanan2">Cadangan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="makanan_tanaman" value="0">
                                            <input type="checkbox" name="makanan_tanaman" id="makanan3" value="1">
                                            <label for="makanan3">Sisa tanaman</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="makanan_lain" value="0">
                                            <input type="checkbox" name="makanan_lain" id="makanan4">
                                            <label for="makanan4">Lainnya:</label>
                                            <input type="text" name="makanan_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">14</td>
                                <td class="question-cell">Dukungan untuk mengatasi masalah pangan</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_pangan_langsung" value="0">
                                            <input type="checkbox" name="dukungan_pangan_langsung" id="dukungan_pangan1" value="1">
                                            <label for="dukungan_pangan1">Pangan langsung</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_pangan_pulih" value="0">
                                            <input type="checkbox" name="dukungan_pangan_pulih" id="dukungan_pangan2" value="1">
                                            <label for="dukungan_pangan2">Pemulihan pangan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_pangan_gotong" value="0">
                                            <input type="checkbox" name="dukungan_pangan_gotong" id="dukungan_pangan3" value="1">
                                            <label for="dukungan_pangan3">Gotong royong</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_pangan_lain" value="0">
                                            <input type="checkbox" name="dukungan_pangan_lain" id="dukungan_pangan4">
                                            <label for="dukungan_pangan4">Lainnya:</label>
                                            <input type="text" name="dukungan_pangan_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">15</td>
                                <td class="question-cell">Masalah air bersih yang dihadapi</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="air_kurang" value="0">
                                            <input type="checkbox" name="air_kurang" id="air1" value="1">
                                            <label for="air1">Kurang</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="air_kotor" value="0">
                                            <input type="checkbox" name="air_kotor" id="air2" value="1">
                                            <label for="air2">Tidak bersih</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="air_simpan" value="0">
                                            <input type="checkbox" name="air_simpan" id="air3" value="1">
                                            <label for="air3">Penyimpanan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="air_lain" value="0">
                                            <input type="checkbox" name="air_lain" id="air4">
                                            <label for="air4">Lainnya:</label>
                                            <input type="text" name="air_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">16</td>
                                <td class="question-cell">Dukungan untuk mengatasi masalah air bersih</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_air_sedia" value="0">
                                            <input type="checkbox" name="dukungan_air_sedia" id="dukungan_air1" value="1">
                                            <label for="dukungan_air1">Penyediaan air</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_air_pulih" value="0">
                                            <input type="checkbox" name="dukungan_air_pulih" id="dukungan_air2" value="1">
                                            <label for="dukungan_air2">Pemulihan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_air_simpan" value="0">
                                            <input type="checkbox" name="dukungan_air_simpan" id="dukungan_air3" value="1">
                                            <label for="dukungan_air3">Sarana simpan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_air_lain" value="0">
                                            <input type="checkbox" name="dukungan_air_lain" id="dukungan_air4">
                                            <label for="dukungan_air4">Lainnya:</label>
                                            <input type="text" name="dukungan_air_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">17</td>
                                <td class="question-cell">Tingkat pelayanan kesehatan keluarga</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="radio" name="pelayanan_kesehatan" value="memadai" id="kesehatan1" value="1">
                                            <label for="kesehatan1">Memadai</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="radio" name="pelayanan_kesehatan" value="tidak" id="kesehatan2" value="1">
                                            <label for="kesehatan2">Tidak memadai</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">18</td>
                                <td class="question-cell">Perbaikan yang diperlukan untuk pelayanan kesehatan</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="perbaikan_obat" value="0">
                                            <input type="checkbox" name="perbaikan_obat" id="perbaikan1" value="1">
                                            <label for="perbaikan1">Obat</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="perbaikan_medis" value="0">
                                            <input type="checkbox" name="perbaikan_medis" id="perbaikan2" value="1">
                                            <label for="perbaikan2">Tenaga Medis</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="perbaikan_jarak" value="0">
                                            <input type="checkbox" name="perbaikan_jarak" id="perbaikan3" value="1">
                                            <label for="perbaikan3">Jarak</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="perbaikan_biaya" value="0">
                                            <input type="checkbox" name="perbaikan_biaya" id="perbaikan4" value="1">
                                            <label for="perbaikan4">Biaya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="perbaikan_psiko" value="0">
                                            <input type="checkbox" name="perbaikan_psiko" id="perbaikan5" value="1">
                                            <label for="perbaikan5">Psikososial</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="perbaikan_lain" value="0">
                                            <input type="checkbox" name="perbaikan_lain" id="perbaikan6">
                                            <label for="perbaikan6">Lainnya:</label>
                                            <input type="text" name="perbaikan_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">19</td>
                                <td class="question-cell">Apakah kegiatan sekolah anak terganggu?</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="radio" name="sekolah_terganggu" value="ya" id="sekolah1" value="1">
                                            <label for="sekolah1">Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="radio" name="sekolah_terganggu" value="tidak" id="sekolah2" value="1">
                                            <label for="sekolah2">Tidak</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">20</td>
                                <td class="question-cell">Dukungan pendidikan anak setelah bencana</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_pend_guru" value="0">
                                            <input type="checkbox" name="dukungan_pend_guru" id="dukungan_pend1" value="1">
                                            <label for="dukungan_pend1">Guru</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_pend_alat" value="0">
                                            <input type="checkbox" name="dukungan_pend_alat" id="dukungan_pend2" value="1">
                                            <label for="dukungan_pend2">Perlengkapan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_pend_biaya" value="0">
                                            <input type="checkbox" name="dukungan_pend_biaya" id="dukungan_pend3" value="1">
                                            <label for="dukungan_pend3">Biaya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_pend_trans" value="0">
                                            <input type="checkbox" name="dukungan_pend_trans" id="dukungan_pend4" value="1">
                                            <label for="dukungan_pend4">Transport</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_pend_dekat" value="0">
                                            <input type="checkbox" name="dukungan_pend_dekat" id="dukungan_pend5" value="1">
                                            <label for="dukungan_pend5">Dekat</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_pend_bangun" value="0">
                                            <input type="checkbox" name="dukungan_pend_bangun" id="dukungan_pend6" value="1">
                                            <label for="dukungan_pend6">Bangunan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_pend_lain" value="0">
                                            <input type="checkbox" name="dukungan_pend_lain" id="dukungan_pend7">
                                            <label for="dukungan_pend7">Lainnya:</label>
                                            <input type="text" name="dukungan_pend_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">21</td>
                                <td class="question-cell">Apakah kegiatan tradisional/keagamaan terganggu?</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="radio" name="agama_terganggu" value="ya" id="agama1" value="1">
                                            <label for="agama1">Ya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="radio" name="agama_terganggu" value="tidak" id="agama2" value="1">
                                            <label for="agama2">Tidak</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">22</td>
                                <td class="question-cell">Dukungan kegiatan tradisional/keagamaan</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_agama_stimulus" value="0">
                                            <input type="checkbox" name="dukungan_agama_stimulus" id="dukungan_agama1" value="1">
                                            <label for="dukungan_agama1">Stimulasi</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_agama_latih" value="0">
                                            <input type="checkbox" name="dukungan_agama_latih" id="dukungan_agama2" value="1">
                                            <label for="dukungan_agama2">Pelatihan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_agama_izin" value="0">
                                            <input type="checkbox" name="dukungan_agama_izin" id="dukungan_agama3" value="1">
                                            <label for="dukungan_agama3">Perizinan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="dukungan_agama_lain" value="0">
                                            <input type="checkbox" name="dukungan_agama_lain" id="dukungan_agama4">
                                            <label for="dukungan_agama4">Lainnya:</label>
                                            <input type="text" name="dukungan_agama_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">23</td>
                                <td class="question-cell">Kegiatan pencegahan dampak bencana di masa depan</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="cegah_info" value="0">
                                            <input type="checkbox" name="cegah_info" id="cegah1" value="1">
                                            <label for="cegah1">Info</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="cegah_latih" value="0">
                                            <input type="checkbox" name="cegah_latih" id="cegah2" value="1">
                                            <label for="cegah2">Pelatihan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="cegah_rencana" value="0">
                                            <input type="checkbox" name="cegah_rencana" id="cegah3" value="1">
                                            <label for="cegah3">Rencana</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="cegah_fasilitas" value="0">
                                            <input type="checkbox" name="cegah_fasilitas" id="cegah4" value="1">
                                            <label for="cegah4">Fasilitas</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="cegah_warning" value="0">
                                            <input type="checkbox" name="cegah_warning" id="cegah5" value="1">
                                            <label for="cegah5">Peringatan</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="cegah_komunitas" value="0">
                                            <input type="checkbox" name="cegah_komunitas" id="cegah6" value="1">
                                            <label for="cegah6">Komunitas</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="cegah_budaya" value="0">
                                            <input type="checkbox" name="cegah_budaya" id="cegah7" value="1">
                                            <label for="cegah7">Budaya</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="cegah_lain" value="0">
                                            <input type="checkbox" name="cegah_lain" id="cegah8">
                                            <label for="cegah8">Lainnya:</label>
                                            <input type="text" name="cegah_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">24</td>
                                <td class="question-cell">Kelompok yang paling membutuhkan bantuan</td>
                                <td class="answer-cell">
                                    <div class="checkbox-group">
                                        <div class="checkbox-item">
                                            <input type="hidden" name="butuh_anak" value="0">
                                            <input type="checkbox" name="butuh_anak" id="butuh1" value="1">
                                            <label for="butuh1">Anak-anak</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="butuh_lansia" value="0">
                                            <input type="checkbox" name="butuh_lansia" id="butuh2" value="1">
                                            <label for="butuh2">Lansia</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="butuh_difabel" value="0">
                                            <input type="checkbox" name="butuh_difabel" id="butuh3" value="1">
                                            <label for="butuh3">Difabel</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="butuh_hamil" value="0">
                                            <input type="checkbox" name="butuh_hamil" id="butuh4" value="1">
                                            <label for="butuh4">Ibu hamil</label>
                                        </div>
                                        <div class="checkbox-item">
                                            <input type="hidden" name="butuh_lain" value="0">
                                            <input type="checkbox" name="butuh_lain" id="butuh5">
                                            <label for="butuh5">Lainnya:</label>
                                            <input type="text" name="butuh_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="question-number">25</td>
                                <td class="question-cell">Penghasilan tiap bulan (sebelum bencana)</td>
                                <td class="answer-cell">
                                    <div class="income-group">
                                        <div class="income-row">
                                            <strong>Suami:</strong>
                                            <input type="text" name="penghasilan_suami" class="inline-input" style="width: 30%;" placeholder="Jumlah">
                                            <strong>bidang:</strong>
                                            <input type="text" name="bidang_suami" class="inline-input" style="width: 30%;" placeholder="Bidang pekerjaan">
                                        </div>
                                        <div class="income-row">
                                            <strong>Istri:</strong>
                                            <input type="text" name="penghasilan_istri" class="inline-input" style="width: 30%;" placeholder="Jumlah">
                                            <strong>bidang:</strong>
                                            <input type="text" name="bidang_istri" class="inline-input" style="width: 30%;" placeholder="Bidang pekerjaan">
                                        </div>
                                        <div class="income-row">
                                            <strong>Lainnya:</strong>
                                            <input type="text" name="penghasilan_lainnya" class="inline-input" style="width: 30%;" placeholder="Jumlah">
                                            <strong>bidang:</strong>
                                            <input type="text" name="bidang_lainnya" class="inline-input" style="width: 30%;" placeholder="Bidang pekerjaan">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="action-buttons">
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
                        <!-- Auto Fill button -->
                        <button type="button" class="btn btn-secondary" onclick="autoFillForm()">
                            <i class="bi bi-lightning-fill"></i> Auto Fill
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <script>
        // skip saving inputs that have data-nosave
        function shouldSaveInput(input) {
            return !input.hasAttribute('data-nosave');
        }

        function saveFormData() {
            const formData = {};
            document.querySelectorAll('input').forEach(input => {
                if (!shouldSaveInput(input) || !input.name) return;

                if (input.type === 'text' || input.type === 'date') {
                    formData[input.name] = input.value;
                } else if (input.type === 'radio' && input.checked) {
                    formData[input.name] = input.value;
                } else if (input.type === 'checkbox') {
                    formData[input.name] = input.checked;
                }
            });
            localStorage.setItem('form6_data', JSON.stringify(formData));
        }

        function loadFormData() {
            const savedData = localStorage.getItem('form6_data');
            if (!savedData) return;

            const formData = JSON.parse(savedData);

            Object.keys(formData).forEach(key => {
                const inputs = document.querySelectorAll(`input[name="${key}"]`);
                if (!inputs.length) return;

                inputs.forEach(input => {
                    if (!shouldSaveInput(input)) return;

                    if (input.type === 'text' || input.type === 'date') {
                        input.value = formData[key];
                    } else if (input.type === 'radio' && input.value === formData[key]) {
                        input.checked = true;
                    } else if (input.type === 'checkbox') {
                        input.checked = formData[key];
                    }
                });
            });
        }

        function clearFormData() {
            localStorage.removeItem('form6_data');
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadFormData();

            document.querySelectorAll('input').forEach(input => {
                if (!shouldSaveInput(input)) return;
                input.addEventListener('change', saveFormData);
                input.addEventListener('input', saveFormData);
            });

            // Hapus localStorage setelah submit
            const formEl = document.querySelector('form');
            if (formEl) formEl.addEventListener('submit', function() {
                clearFormData();
            });
        });

        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset semua data form?')) {
                // Reset radios, teks dan checkbox (tetapi tidak menyentuh input yang dikecualikan)
                document.querySelectorAll('input').forEach(input => {
                    if (input.hasAttribute('data-nosave')) return;
                    if (input.type === 'radio' || input.type === 'checkbox') input.checked = false;
                    if (input.type === 'text' || input.type === 'date') input.value = '';
                });
                clearFormData();
            }
        }

        function printForm() {
            window.print();
        }

        function previewForm() {
            const previewWindow = window.open('', '_blank', 'width=800,height=600,scrollbars=yes');
            const formContent = document.querySelector('.form-container').cloneNode(true);

            const buttons = formContent.querySelectorAll('button');
            buttons.forEach(btn => btn.style.display = 'none');

            const inputs = formContent.querySelectorAll('input[type="text"], input[type="date"]');
            inputs.forEach(input => {
                const span = document.createElement('span');
                span.textContent = input.value || '________________';
                span.style.borderBottom = '1px solid #000';
                span.style.minWidth = '100px';
                span.style.display = 'inline-block';
                input.parentNode.replaceChild(span, input);
            });

            const radioes = formContent.querySelectorAll('input[type="radio"], input[type="checkbox"]');
            radioes.forEach(radio => {
                const span = document.createElement('span');
                span.textContent = radio.checked ? '☑' : '☐';
                radio.parentNode.replaceChild(span, radio);
            });

            previewWindow.document.write(`
                <html>
                <head><title>Preview Form 6</title></head>
                <body>${formContent.outerHTML}</body>
                </html>
            `);
            previewWindow.document.close();
        }

        // Auto fill contoh data (respekt data-nosave)
        function autoFillForm() {
            if (!confirm('Isi otomatis form dengan data contoh?')) return;

            const today = new Date().toISOString().slice(0, 10);

            // simple helper
            const setValue = (selector, value) => {
                const el = document.querySelector(selector);
                if (!el || el.hasAttribute('data-nosave')) return;
                if (el.type === 'checkbox' || el.type === 'radio') el.checked = !!value;
                else el.value = value;
            };

            // header / meta
            setValue('input[name="enumerator"]', 'ENUM01');
            setValue('input[name="tgl_wawancara"]', today);
            setValue('input[name="paraf_enum"]', 'PE01');
            setValue('input[name="data_entry"]', 'DATA01');
            setValue('input[name="tgl_entry"]', today);
            setValue('input[name="paraf_entry"]', 'PE01');

            // texts
            const texts = {
                'nama': 'Nama Contoh',
                'desa': 'Desa Contoh',
                'kecamatan': 'Kecamatan Contoh',
                'kabupaten': 'Kabupaten Contoh',
                'penghasilan_suami': '1000000',
                'bidang_suami': 'Pertanian',
                'penghasilan_istri': '500000',
                'bidang_istri': 'Jasa',
                'penghasilan_lainnya': '300000',
                'bidang_lainnya': 'Perdagangan'
            };
            Object.entries(texts).forEach(([k, v]) => setValue(`input[name="${k}"]`, v));

            // radios (set beberapa default)
            const radios = {
                'responden': 'l',
                'umur': '31_40',
                'pendidikan': 'slta',
                'krt_perempuan': 'tidak',
                'jumlah_anggota': '3_5',
                'jumlah_anak': '2',
                'jumlah_balita': '1',
                'tipe_hunian': 'sendiri',
                'penghasilan_hilang': 'ada',
                'perlindungan': 'sama',
                'perkiraan_tinggal': 'rumah_asal',
                'pelayanan_kesehatan': 'memadai',
                'sekolah_terganggu': 'tidak',
                'agama_terganggu': 'tidak'
            };
            Object.entries(radios).forEach(([name, val]) => {
                const r = document.querySelector(`input[name="${name}"][value="${val}"]`);
                if (r && !r.hasAttribute('data-nosave')) r.checked = true;
            });

            // checkboxes to tick
            const checks = [
                'nafkah_pre_suami', 'nafkah_pre_istri', 'sumber_dagang', 'bantuan_keterampilan',
                'cadangan_tabungan', 'dukungan_koperasi', 'bantu_lindung_rumah', 'masalah_rumah_rusak',
                'tindakan_rumah_teknis', 'makanan_bantuan', 'dukungan_pangan_langsung', 'air_kurang',
                'dukungan_air_sedia', 'perbaikan_jarak', 'dukungan_pend_guru', 'dukungan_agama_stimulus',
                'cegah_info', 'butuh_anak'
            ];
            checks.forEach(name => {
                // pilih semua input dengan nama tersebut (ada hidden + checkbox)
                const inputs = document.querySelectorAll(`input[name="${name}"]`);
                if (!inputs.length) return;
                inputs.forEach(el => {
                    if (el.hasAttribute('data-nosave')) return;
                    if (el.type === 'checkbox') {
                        el.checked = true;
                    }
                });
            });


            // contoh isi untuk beberapa text area / custom fields if present
            const extras = {
                'nafkah_pre_lain_text': 'Pekerja lepas',
                'nafkah_post_lain_text': 'Pekerja harian',
                'sumber_lain_text': 'Sumber lain',
                'bantuan_lain_text': 'Modal usaha kecil'
            };
            Object.entries(extras).forEach(([k, v]) => setValue(`input[name="${k}"]`, v));

            // simpan ke localStorage agar konsisten dengan mekanik auto-save
            if (typeof saveFormData === 'function') saveFormData();
            alert('Form telah diisi contoh. Silakan cek dan simpan jika cocok.');
        }
    </script>
@endsection
