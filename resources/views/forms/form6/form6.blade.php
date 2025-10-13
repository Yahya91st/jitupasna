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
    
    .table td, .table th {
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
    
    /* Checkbox Styling */
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
                                <input type="checkbox" name="responden_l" id="resp_l">
                                <label for="resp_l">Laki-laki</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="responden_p" id="resp_p">
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
                                <input type="checkbox" name="umur_20" id="umur1">
                                <label for="umur1">≤ 20 tahun</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="umur_21_30" id="umur2">
                                <label for="umur2">21-30 tahun</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="umur_31_40" id="umur3">
                                <label for="umur3">31-40 tahun</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="umur_41_50" id="umur4">
                                <label for="umur4">41-50 tahun</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="umur_50plus" id="umur5">
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
                                <input type="checkbox" name="pend_sd" id="pend1">
                                <label for="pend1">SD</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="pend_sltp" id="pend2">
                                <label for="pend2">SLTP</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="pend_slta" id="pend3">
                                <label for="pend3">SLTA</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="pend_pt" id="pend4">
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
                                <input type="checkbox" name="krt_p_ya" id="krt1">
                                <label for="krt1">Ya</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="krt_p_tidak" id="krt2">
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
                                <input type="checkbox" name="anggota_3" id="anggota1">
                                <label for="anggota1">≤ 3 orang</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="anggota_3_5" id="anggota2">
                                <label for="anggota2">3-5 orang</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="anggota_5plus" id="anggota3">
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
                                <input type="checkbox" name="anak_1" id="anak1">
                                <label for="anak1">1 orang</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="anak_2" id="anak2">
                                <label for="anak2">2 orang</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="anak_3" id="anak3">
                                <label for="anak3">3 orang</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="anak_3plus" id="anak4">
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
                                <input type="checkbox" name="balita_1" id="balita1">
                                <label for="balita1">1 orang</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="balita_2" id="balita2">
                                <label for="balita2">2 orang</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="balita_3" id="balita3">
                                <label for="balita3">3 orang</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="balita_3plus" id="balita4">
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
                                <input type="checkbox" name="hunian_sendiri" id="hunian1">
                                <label for="hunian1">Rumah tinggal sendiri</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="hunian_tumpangan" id="hunian2">
                                <label for="hunian2">Rumah tumpangan</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="hunian_huntara" id="hunian3">
                                <label for="hunian3">Huntara</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="hunian_pengungsian" id="hunian4">
                                <label for="hunian4">Pengungsian</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="hunian_fasum" id="hunian5">
                                <label for="hunian5">Fasilitas umum</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="hunian_lain" id="hunian6">
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
                                    <input type="checkbox" name="nafkah_pre_suami" id="nafkah1">
                                    <label for="nafkah1">Suami</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="nafkah_pre_istri" id="nafkah2">
                                    <label for="nafkah2">Istri</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="nafkah_pre_anak" id="nafkah3">
                                    <label for="nafkah3">Anak (<18 tahun)</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="nafkah_pre_lain" id="nafkah4">
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
                                    <input type="checkbox" name="nafkah_post_suami" id="nafkah_post1">
                                    <label for="nafkah_post1">Suami</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="nafkah_post_istri" id="nafkah_post2">
                                    <label for="nafkah_post2">Istri</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="nafkah_post_anak" id="nafkah_post3">
                                    <label for="nafkah_post3">Anak (<18 tahun)</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="nafkah_post_lain" id="nafkah_post4">
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
                                    <input type="checkbox" name="sumber_pertanian" id="sumber1">
                                    <label for="sumber1">Pertanian</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="sumber_peternakan" id="sumber2">
                                    <label for="sumber2">Peternakan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="sumber_dagang" id="sumber3">
                                    <label for="sumber3">Perdagangan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="sumber_industri" id="sumber4">
                                    <label for="sumber4">Industri</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="sumber_jasa" id="sumber5">
                                    <label for="sumber5">Jasa</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="sumber_pegawai" id="sumber6">
                                    <label for="sumber6">Pegawai</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="sumber_pertukangan" id="sumber7">
                                    <label for="sumber7">Pertukangan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="sumber_lain" id="sumber8">
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
                                    <input type="checkbox" name="penghasilan_hilang_ada" id="penghasilan1">
                                    <label for="penghasilan1">Ada</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="penghasilan_hilang_tidak" id="penghasilan2">
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
                                    <input type="checkbox" name="bantuan_keterampilan" id="bantuan1">
                                    <label for="bantuan1">Keterampilan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="bantuan_peralatan" id="bantuan2">
                                    <label for="bantuan2">Peralatan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="bantuan_modal" id="bantuan3">
                                    <label for="bantuan3">Modal</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="bantuan_pasar" id="bantuan4">
                                    <label for="bantuan4">Akses Pasar</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="bantuan_lain" id="bantuan5">
                                    <label for="bantuan5">Lain-lain:</label>
                                    <input type="text" name="bantuan_lain_text" class="inline-input" style="width: 50%;" placeholder="Sebutkan">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>            <td>6</td>
                        <td>Sumber cadangan keluarga yang terganggu setelah bencana <br><em>(Pilih maksimal tiga)</em></td>
                        <td><input type="checkbox" name="cadangan_tabungan"> Tabungan <input type="checkbox" name="cadangan_pinjaman"> Pinjaman <input type="checkbox" name="cadangan_barang"> Barang <input type="checkbox" name="cadangan_ternak"> Ternak <input type="checkbox" name="cadangan_jamsos"> Jaminan Sosial <input type="checkbox" name="cadangan_lain"> Lainnya: <input type="text" name="cadangan_lain_text" style="width: 30%; border: none; border-bottom: 1px solid #ccc;"></td>
                    </tr>
                    <tr>
                        <td class="question-number">7</td>
                        <td class="question-cell">Dukungan untuk memulihkan sumber cadangan</td>
                        <td class="answer-cell">
                            <div class="checkbox-group">
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_koperasi" id="dukungan1">
                                    <label for="dukungan1">Koperasi</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_kelompok" id="dukungan2">
                                    <label for="dukungan2">Kelompok Usaha</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_pinjaman" id="dukungan3">
                                    <label for="dukungan3">Pinjaman</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_pemerintah" id="dukungan4">
                                    <label for="dukungan4">Bantuan pemerintah</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_lain" id="dukungan5">
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
                                    <input type="checkbox" name="perlindungan_meningkat" id="perlindungan1">
                                    <label for="perlindungan1">Meningkat</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="perlindungan_menurun" id="perlindungan2">
                                    <label for="perlindungan2">Menurun</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="perlindungan_sama" id="perlindungan3">
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
                                    <input type="checkbox" name="bantu_lindung_penyuluhan" id="bantu_lindung1">
                                    <label for="bantu_lindung1">Penyuluhan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="bantu_lindung_moral" id="bantu_lindung2">
                                    <label for="bantu_lindung2">Penguatan moral</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="bantu_lindung_polisi" id="bantu_lindung3">
                                    <label for="bantu_lindung3">Polisi keliling</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="bantu_lindung_pos" id="bantu_lindung4">
                                    <label for="bantu_lindung4">Pos Pengaduan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="bantu_lindung_rumah" id="bantu_lindung5">
                                    <label for="bantu_lindung5">Rumah aman</label>
                                </div>
                                <div class="checkbox-item">
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
                                    <input type="checkbox" name="masalah_rumah_relokasi" id="masalah_rumah1">
                                    <label for="masalah_rumah1">Harus relokasi</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="masalah_rumah_rusak" id="masalah_rumah2">
                                    <label for="masalah_rumah2">Rusak</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="masalah_rumah_belum" id="masalah_rumah3">
                                    <label for="masalah_rumah3">Belum punya rumah</label>
                                </div>
                                <div class="checkbox-item">
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
                                    <input type="checkbox" name="tindakan_rumah_stimulus" id="tindakan_rumah1">
                                    <label for="tindakan_rumah1">Stimulus rumah</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="tindakan_rumah_kredit" id="tindakan_rumah2">
                                    <label for="tindakan_rumah2">Kredit</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="tindakan_rumah_teknis" id="tindakan_rumah3">
                                    <label for="tindakan_rumah3">Bantuan teknis</label>
                                </div>
                                <div class="checkbox-item">
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
                                    <input type="checkbox" name="perkiraan_rumah_asal" id="perkiraan1">
                                    <label for="perkiraan1">Di rumah asal</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="perkiraan_desa_asal" id="perkiraan2">
                                    <label for="perkiraan2">Di desa asal</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="perkiraan_tempat_lain" id="perkiraan3">
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
                                    <input type="checkbox" name="makanan_bantuan" id="makanan1">
                                    <label for="makanan1">Bantuan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="makanan_cadangan" id="makanan2">
                                    <label for="makanan2">Cadangan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="makanan_tanaman" id="makanan3">
                                    <label for="makanan3">Sisa tanaman</label>
                                </div>
                                <div class="checkbox-item">
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
                                    <input type="checkbox" name="dukungan_pangan_langsung" id="dukungan_pangan1">
                                    <label for="dukungan_pangan1">Pangan langsung</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_pangan_pulih" id="dukungan_pangan2">
                                    <label for="dukungan_pangan2">Pemulihan pangan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_pangan_gotong" id="dukungan_pangan3">
                                    <label for="dukungan_pangan3">Gotong royong</label>
                                </div>
                                <div class="checkbox-item">
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
                                    <input type="checkbox" name="air_kurang" id="air1">
                                    <label for="air1">Kurang</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="air_kotor" id="air2">
                                    <label for="air2">Tidak bersih</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="air_simpan" id="air3">
                                    <label for="air3">Penyimpanan</label>
                                </div>
                                <div class="checkbox-item">
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
                                    <input type="checkbox" name="dukungan_air_sedia" id="dukungan_air1">
                                    <label for="dukungan_air1">Penyediaan air</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_air_pulih" id="dukungan_air2">
                                    <label for="dukungan_air2">Pemulihan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_air_simpan" id="dukungan_air3">
                                    <label for="dukungan_air3">Sarana simpan</label>
                                </div>
                                <div class="checkbox-item">
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
                                    <input type="checkbox" name="kesehatan_memadai" id="kesehatan1">
                                    <label for="kesehatan1">Memadai</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="kesehatan_tidak" id="kesehatan2">
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
                                    <input type="checkbox" name="perbaikan_obat" id="perbaikan1">
                                    <label for="perbaikan1">Obat</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="perbaikan_medis" id="perbaikan2">
                                    <label for="perbaikan2">Tenaga Medis</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="perbaikan_jarak" id="perbaikan3">
                                    <label for="perbaikan3">Jarak</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="perbaikan_biaya" id="perbaikan4">
                                    <label for="perbaikan4">Biaya</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="perbaikan_psiko" id="perbaikan5">
                                    <label for="perbaikan5">Psikososial</label>
                                </div>
                                <div class="checkbox-item">
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
                                    <input type="checkbox" name="sekolah_terganggu_ya" id="sekolah1">
                                    <label for="sekolah1">Ya</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="sekolah_terganggu_tidak" id="sekolah2">
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
                                    <input type="checkbox" name="dukungan_pend_guru" id="dukungan_pend1">
                                    <label for="dukungan_pend1">Guru</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_pend_alat" id="dukungan_pend2">
                                    <label for="dukungan_pend2">Perlengkapan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_pend_biaya" id="dukungan_pend3">
                                    <label for="dukungan_pend3">Biaya</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_pend_trans" id="dukungan_pend4">
                                    <label for="dukungan_pend4">Transport</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_pend_dekat" id="dukungan_pend5">
                                    <label for="dukungan_pend5">Dekat</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_pend_bangun" id="dukungan_pend6">
                                    <label for="dukungan_pend6">Bangunan</label>
                                </div>
                                <div class="checkbox-item">
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
                                    <input type="checkbox" name="agama_terganggu_ya" id="agama1">
                                    <label for="agama1">Ya</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="agama_terganggu_tidak" id="agama2">
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
                                    <input type="checkbox" name="dukungan_agama_stimulus" id="dukungan_agama1">
                                    <label for="dukungan_agama1">Stimulasi</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_agama_latih" id="dukungan_agama2">
                                    <label for="dukungan_agama2">Pelatihan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="dukungan_agama_izin" id="dukungan_agama3">
                                    <label for="dukungan_agama3">Perizinan</label>
                                </div>
                                <div class="checkbox-item">
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
                                    <input type="checkbox" name="cegah_info" id="cegah1">
                                    <label for="cegah1">Info</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="cegah_latih" id="cegah2">
                                    <label for="cegah2">Pelatihan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="cegah_rencana" id="cegah3">
                                    <label for="cegah3">Rencana</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="cegah_fasilitas" id="cegah4">
                                    <label for="cegah4">Fasilitas</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="cegah_warning" id="cegah5">
                                    <label for="cegah5">Peringatan</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="cegah_komunitas" id="cegah6">
                                    <label for="cegah6">Komunitas</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="cegah_budaya" id="cegah7">
                                    <label for="cegah7">Budaya</label>
                                </div>
                                <div class="checkbox-item">
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
                                    <input type="checkbox" name="butuh_anak" id="butuh1">
                                    <label for="butuh1">Anak-anak</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="butuh_lansia" id="butuh2">
                                    <label for="butuh2">Lansia</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="butuh_difabel" id="butuh3">
                                    <label for="butuh3">Difabel</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" name="butuh_hamil" id="butuh4">
                                    <label for="butuh4">Ibu hamil</label>
                                </div>
                                <div class="checkbox-item">
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

            <!-- Action Buttons -->
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
