{{-- 
    Formulir 09 PDF Template
    
    Cara penggunaan:
    1. Jika dipanggil dari controller dengan data: pass variabel $form
    2. Jika dipanggil tanpa data: akan menggunakan data contoh default
    
    Contoh pemanggilan dengan data:
    return view('forms.form9.contoh_form9_pdf', compact('form'));
--}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 09 - Pengolahan Data dan Kuesioner</title>
    <style>
        @page {
            margin: 0.8cm;
            size: A4;
        }

        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.2;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 9pt;
        }

        .container {
            width: 100%;
            max-width: 100%;
            margin: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 1px solid #ddd;
        }

        .header h2 {
            margin: 0.1rem 0;
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #333;
        }

        .header h3 {
            margin: 0.1rem 0;
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #333;
        }

        .intro-text {
            text-align: justify;
            font-size: 8pt;
            line-height: 1.2;
            margin-bottom: 6px;
            padding: 4px 6px;
            background-color: #f9f9f9;
            border-left: 2px solid #333;
            border-radius: 2px;
        }

        .intro-label {
            font-weight: 600;
            font-size: 8pt;
            margin-bottom: 1px;
            display: block;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3px;
            border: 1px solid #333;
            page-break-inside: avoid;
        }

        th,
        td {
            padding: 3px 4px;
            text-align: left;
            font-size: 8pt;
            vertical-align: top;
            border: 1px solid #333;
            line-height: 1.2;
        }

        th {
            background-color: #f9f9f9;
            font-weight: 600;
            text-align: center;
            padding: 4px 3px;
            border-bottom: 1px solid #333;
            color: #333;
            font-size: 8pt;
        }
        
        td {
            background-color: #fff;
        }

        tbody tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .main-table {
            page-break-inside: avoid;
            margin-bottom: 2px;
            border: 1px solid #333;
        }
        
        .main-table td {
            padding: 2px 3px;
            font-size: 7pt;
            line-height: 1.1;
        }
        
        .main-table th {
            padding: 4px 3px;
            font-size: 8pt;
            line-height: 1.2;
            font-weight: 600;
        }

        .question-cell {
            text-align: left;
            padding-left: 6px;
            width: 25%;
            font-weight: 600;
            color: #333;
        }

        .answer-cell {
            text-align: left;
            padding-left: 6px;
            width: 20%;
            font-weight: 500;
            color: #333;
        }

        .number-cell {
            text-align: center;
            width: 3%;
            font-weight: 600;
            background-color: #f9f9f9 !important;
            color: #333;
        }

        .kuesioner-cell {
            text-align: center;
            width: 5%;
            font-weight: 600;
        }

        .jumlah-cell {
            text-align: center;
            width: 6%;
            font-weight: 600;
            background-color: #f9f9f9 !important;
            color: #333;
        }

        .persentase-cell {
            text-align: center;
            width: 6%;
            font-weight: 600;
            background-color: #f9f9f9 !important;
            color: #333;
        }

        .small-text {
            font-size: 7pt;
            line-height: 1.2;
        }

        .small-text strong {
            font-size: 7pt;
            font-weight: 600;
        }

        .signature-table {
            margin-top: 15px;
            border: none;
        }

        .signature-table td {
            border: none;
            padding: 6px;
        }

        .signature-box {
            text-align: center;
            margin-top: 20px;
        }

        .signature-line {
            border-top: 1px solid #333;
            width: 150px;
            margin: 0 auto;
            padding-top: 3px;
            font-weight: 600;
        }

        .page-break {
            page-break-after: always;
        }

        /* Additional Professional Styling */
        .checkmark {
            color: #333;
            font-weight: 600;
            font-size: 8pt;
        }

        .empty-cell {
            color: #999;
            font-size: 6pt;
        }

        /* Enhanced Print Styles */
        @media print {
            @page {
                margin: 0.8cm;
            }

            body {
                margin: 0;
                font-size: 9pt;
            }

            .page-break {
                page-break-after: always;
            }

            table {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>FORMULIR 09</h2>
            <h3>Pengolahan Data dan Kuesioner</h3>
            <div style="font-size: 7pt; margin-top: 2px; color: #333;">JITUPASNA - Sistem Informasi Pengkajian Kebutuhan Pasca Bencana</div>
        </div>

        <!-- Intro Text -->
        <div class="intro-text">
            <span class="intro-label">Petunjuk Penggunaan:</span>
            Formulir ini digunakan untuk mengolah dan menganalisis data hasil kuesioner yang telah dikumpulkan. <em>Isi setiap kolom dengan cermat sesuai dengan data yang tersedia dari kuesioner yang telah diisi responden.</em>
        </div>

        <!-- Keterangan -->
        <div style="margin-bottom: 6px; font-size: 7pt; line-height: 1.2; background-color: #f9f9f9; padding: 4px 6px; border-left: 2px solid #333; border-radius: 2px;">
            <div style="font-weight: 600; color: #333; margin-bottom: 2px;">Keterangan Kolom:</div>
            <div style="display: flex; flex-wrap: wrap;">
                <div style="width: 50%; margin-bottom: 1px;">• Nomor Kuesioner = Nomor urut responden</div>
                <div style="width: 50%; margin-bottom: 1px;">• Kategori Jawaban = Pilihan yang tersedia</div>
                <div style="width: 50%; margin-bottom: 1px;">• Jumlah = Total yang memilih jawaban</div>
                <div style="width: 50%; margin-bottom: 1px;">• Persentase = (Jumlah ÷ Total) × 100%</div>
            </div>
        </div>

        <!-- Main Table -->
        <table class="main-table">
            <thead>
                <tr>
                    <th class="number-cell" rowspan="2">No</th>
                    <th class="question-cell" rowspan="2">Pertanyaan</th>
                    <th class="answer-cell" rowspan="2">Kategori Jawaban</th>
                    <th colspan="6">Nomor Kuesioner</th>
                    <th class="jumlah-cell" rowspan="2">Jumlah</th>
                    <th class="persentase-cell" rowspan="2">Persentase</th>
                </tr>
                <tr>
                    <th class="kuesioner-cell">1</th>
                    <th class="kuesioner-cell">2</th>
                    <th class="kuesioner-cell">3</th>
                    <th class="kuesioner-cell">4</th>
                    <th class="kuesioner-cell">5</th>
                    <th class="kuesioner-cell">6</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($form) && $form->rows && $form->rows->count() > 0)
                    @foreach($form->rows as $row)
                    <tr>
                        <td class="number-cell">{{ $row->pertanyaan_no }}</td>
                        <td class="question-cell">
                            @php
                                $questions = [
                                    'a' => 'Jenis kelamin responden',
                                    'b' => 'Umur',
                                    'c' => 'Status perkawinan',
                                    'd' => 'Jumlah anggota keluarga',
                                    'e' => 'Anak balita dalam keluarga',
                                    'f' => 'Pendidikan terakhir',
                                    'g' => 'Apakah responden kepala Rumah Tangga Perempuan',
                                    '1' => 'Sebelum bencana, siapa sajakah pencari nafkah keluarga?',
                                    '2' => 'Berapa penghasilan rata-rata keluarga per bulan sebelum bencana?',
                                    '3' => 'Sebutkan tiga sumber utama penghasilan keluarga sebelum bencana?',
                                    '4' => 'Apakah ada anggota keluarga yang kehilangan pekerjaan karena bencana?',
                                    '5' => 'Sebutkan satu bantuan yang paling dibutuhkan untuk mempertahankan / memulihkan / meningkatkan mata pencaharian keluarga?'
                                ];
                            @endphp
                            {{ $questions[$row->pertanyaan_no] ?? 'Pertanyaan ' . $row->pertanyaan_no }}
                        </td>
                        <td class="answer-cell">
                            @php
                                $answers = [
                                    'a' => ['1' => 'Laki-laki', '2' => 'Perempuan'],
                                    'b' => ['1' => '≤ 20 th', '2' => '21 th – 30 th', '3' => '31 th – 40 th', '4' => '41 th – 50 th', '5' => '> 50 th'],
                                    'c' => ['1' => 'Belum kawin', '2' => 'Kawin', '3' => 'Cerai hidup', '4' => 'Cerai mati'],
                                    'd' => ['1' => '1-2 orang', '2' => '3-4 orang', '3' => '5-6 orang', '4' => '> 6 orang'],
                                    'e' => ['1' => 'Tidak ada', '2' => '1 orang', '3' => '2 orang', '4' => '> 2 orang'],
                                    'f' => ['1' => 'SD', '2' => 'SLTP', '3' => 'SLTA', '4' => 'PT'],
                                    'g' => ['1' => 'Ya', '2' => 'Tidak'],
                                    '1' => ['1' => 'Suami', '2' => 'Istri', '3' => 'Anak (<18 tahun)', '4' => 'Lainnya'],
                                    '2' => ['1' => '< 500 ribu', '2' => '500rb - 1jt', '3' => '1jt - 2jt', '4' => '> 2jt'],
                                    '3' => ['1' => 'Pertanian', '2' => 'Peternakan', '3' => 'Perdagangan', '4' => 'Industri', '5' => 'Jasa', '6' => 'Pegawai', '7' => 'Pertukangan', '8' => 'Nelayan'],
                                    '4' => ['1' => 'Ya', '2' => 'Tidak'],
                                    '5' => ['1' => 'Keterampilan', '2' => 'Peralatan', '3' => 'Modal', '4' => 'Akses Pasar', '5' => 'Lain-lain']
                                ];
                            @endphp
                            {{ $answers[$row->pertanyaan_no][$row->jawaban_index] ?? 'Jawaban ' . $row->jawaban_index }}
                        </td>
                        <td class="kuesioner-cell">{{ $row->kuesioner_1 ? '✓' : '' }}</td>
                        <td class="kuesioner-cell">{{ $row->kuesioner_2 ? '✓' : '' }}</td>
                        <td class="kuesioner-cell">{{ $row->kuesioner_3 ? '✓' : '' }}</td>
                        <td class="kuesioner-cell">{{ $row->kuesioner_4 ? '✓' : '' }}</td>
                        <td class="kuesioner-cell">{{ $row->kuesioner_5 ? '✓' : '' }}</td>
                        <td class="kuesioner-cell">{{ $row->kuesioner_6 ? '✓' : '' }}</td>
                        <td class="jumlah-cell">{{ $row->jumlah }}</td>
                        <td class="persentase-cell">{{ $row->persentase }}%</td>
                    </tr>
                    @endforeach
                @else
                    <!-- Data Contoh jika tidak ada data asli -->
                    <!-- Jenis Kelamin -->
                    <tr>
                        <td class="number-cell" rowspan="2">a</td>
                        <td class="question-cell" rowspan="2">Jenis kelamin responden</td>
                        <td class="answer-cell">Laki-laki</td>
                        <td class="kuesioner-cell"><span class="checkmark">✓</span></td>
                        <td class="kuesioner-cell"><span class="empty-cell">—</span></td>
                        <td class="kuesioner-cell"><span class="checkmark">✓</span></td>
                        <td class="kuesioner-cell"><span class="checkmark">✓</span></td>
                        <td class="kuesioner-cell"><span class="empty-cell">—</span></td>
                        <td class="kuesioner-cell"><span class="checkmark">✓</span></td>
                        <td class="jumlah-cell">4</td>
                        <td class="persentase-cell">67%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Perempuan</td>
                        <td class="kuesioner-cell"><span class="empty-cell">—</span></td>
                        <td class="kuesioner-cell"><span class="checkmark">✓</span></td>
                        <td class="kuesioner-cell"><span class="empty-cell">—</span></td>
                        <td class="kuesioner-cell"><span class="empty-cell">—</span></td>
                        <td class="kuesioner-cell"><span class="checkmark">✓</span></td>
                        <td class="kuesioner-cell"><span class="empty-cell">—</span></td>
                        <td class="jumlah-cell">2</td>
                        <td class="persentase-cell">33%</td>
                    </tr>

                    <!-- Contoh data lainnya tetap sama seperti sebelumnya -->
                    <tr>
                        <td class="number-cell" rowspan="5">b</td>
                        <td class="question-cell" rowspan="5">Umur</td>
                        <td class="answer-cell">≤ 20 th</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">1</td>
                        <td class="persentase-cell">17%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">21 th – 30 th</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">3</td>
                        <td class="persentase-cell">50%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">31 th – 40 th</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="jumlah-cell">2</td>
                        <td class="persentase-cell">33%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">41 th – 50 th</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">0</td>
                        <td class="persentase-cell">0%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">> 50 th</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">0</td>
                        <td class="persentase-cell">0%</td>
                    </tr>

                    <!-- Pendidikan -->
                    <tr>
                        <td class="number-cell" rowspan="4">f</td>
                        <td class="question-cell" rowspan="4">Pendidikan terakhir</td>
                        <td class="answer-cell">SD</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="jumlah-cell">2</td>
                        <td class="persentase-cell">33%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">SLTP</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">2</td>
                        <td class="persentase-cell">33%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">SLTA</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">2</td>
                        <td class="persentase-cell">33%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">PT</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">0</td>
                        <td class="persentase-cell">0%</td>
                    </tr>

                    <!-- Kepala RT Perempuan -->
                    <tr>
                        <td class="number-cell" rowspan="2">g</td>
                        <td class="question-cell" rowspan="2">Apakah responden kepala Rumah Tangga Perempuan</td>
                        <td class="answer-cell">Ya</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">2</td>
                        <td class="persentase-cell">33%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Tidak</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="jumlah-cell">4</td>
                        <td class="persentase-cell">67%</td>
                    </tr>

                    <!-- Mata Pencaharian Sebelum Bencana -->
                    <tr>
                        <td class="number-cell" rowspan="4">1</td>
                        <td class="question-cell" rowspan="4">Sebelum bencana, siapa sajakah pencari nafkah keluarga?</td>
                        <td class="answer-cell">Suami</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="jumlah-cell">6</td>
                        <td class="persentase-cell">100%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Istri</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">3</td>
                        <td class="persentase-cell">50%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Anak (<18 tahun)</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">0</td>
                        <td class="persentase-cell">0%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Lainnya</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">1</td>
                        <td class="persentase-cell">17%</td>
                    </tr>

                    <!-- Sumber Penghasilan -->
                    <tr>
                        <td class="number-cell" rowspan="8">3</td>
                        <td class="question-cell" rowspan="8">Sebutkan tiga sumber utama penghasilan keluarga sebelum bencana?</td>
                        <td class="answer-cell">Pertanian</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="jumlah-cell">5</td>
                        <td class="persentase-cell">83%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Peternakan</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">3</td>
                        <td class="persentase-cell">50%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Perdagangan</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="jumlah-cell">4</td>
                        <td class="persentase-cell">67%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Industri</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">0</td>
                        <td class="persentase-cell">0%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Jasa</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="jumlah-cell">2</td>
                        <td class="persentase-cell">33%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Pegawai</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">0</td>
                        <td class="persentase-cell">0%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Pertukangan</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">1</td>
                        <td class="persentase-cell">17%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Nelayan</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">0</td>
                        <td class="persentase-cell">0%</td>
                    </tr>

                    <!-- Bantuan yang Dibutuhkan -->
                    <tr>
                        <td class="number-cell" rowspan="5">5</td>
                        <td class="question-cell" rowspan="5">Sebutkan satu bantuan yang paling dibutuhkan untuk mempertahankan / memulihkan / meningkatkan mata pencaharian keluarga?</td>
                        <td class="answer-cell">Keterampilan</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">1</td>
                        <td class="persentase-cell">17%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Peralatan</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="jumlah-cell">3</td>
                        <td class="persentase-cell">50%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Modal</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell">✓</td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">2</td>
                        <td class="persentase-cell">33%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Akses Pasar</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">0</td>
                        <td class="persentase-cell">0%</td>
                    </tr>
                    <tr>
                        <td class="answer-cell">Lain-lain</td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="kuesioner-cell"></td>
                        <td class="jumlah-cell">0</td>
                        <td class="persentase-cell">0%</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Catatan -->
        <div style="margin-top: 8px; font-size: 7pt; line-height: 1.2; background-color: #f9f9f9; padding: 4px 6px; border-left: 2px solid #333; border-radius: 2px;">
            <div style="font-weight: 600; color: #333; margin-bottom: 3px;">Catatan Penting</div>
            <div style="color: #333;">
                @if(isset($form) && $form->rows && $form->rows->count() > 0)
                <div style="margin-bottom: 1px;">✓ Total data kuesioner: <strong>{{ $form->rows->count() }} item</strong></div>
                <div style="margin-bottom: 1px;">✓ Data diambil dari database sistem JITUPASNA</div>
                <div style="margin-bottom: 1px;">✓ Persentase dihitung berdasarkan jumlah responden yang memilih jawaban tersebut</div>
                <div style="margin-bottom: 1px;">✓ Data valid per tanggal: <strong>{{ isset($form->tanggal) ? \Carbon\Carbon::parse($form->tanggal)->format('d F Y') : date('d F Y') }}</strong></div>
                @else
                <div style="margin-bottom: 1px;">✓ Total responden dalam contoh ini adalah <strong>6 orang</strong></div>
                <div style="margin-bottom: 1px;">✓ Beberapa pertanyaan memungkinkan jawaban <strong>multiple choice</strong></div>
                <div style="margin-bottom: 1px;">✓ Persentase dihitung berdasarkan jumlah responden yang memilih jawaban tersebut</div>
                <div style="margin-bottom: 1px;">✓ Data di atas adalah <strong>contoh pengisian</strong>, sesuaikan dengan data aktual dari lapangan</div>
                <div style="margin-bottom: 1px; font-style: italic; color: #666;">✓ Template ini dapat diisi dengan data dinamis jika dipanggil dengan variabel $form</div>
                @endif
            </div>
        </div>

        <!-- Spacer untuk mendorong signature ke bawah -->
        <div style="flex-grow: 1; min-height: 50px;"></div>

        <!-- Signature Section -->
        <div class="signature-table" style="position: fixed; bottom: 60px; left: 0; right: 0; margin: 0; padding: 0 0.8cm;">
            <div style="border-top: 1px solid #333; padding-top: 8px;">
                <table style="border: none; width: 100%;">
                    <tr>
                        <td style="width: 50%; border: none; text-align: center; vertical-align: top; padding: 8px;">
                            <div style="margin-bottom: 4px;">
                                <strong style="font-size: 9pt; color: #333;">PENGOLAH DATA</strong>
                            </div>
                            <div style="height: 30px;"></div>
                            <div style="border-top: 1px solid #333; width: 150px; margin: 0 auto; padding-top: 3px;">
                                <strong style="font-size: 9pt; color: #333;">{{ $form->pengolah_data ?? 'Siti Nurhaliza, S.Kom' }}</strong>
                            </div>
                        </td>
                        <td style="width: 50%; border: none; text-align: center; vertical-align: top; padding: 8px;">
                            <div style="margin-bottom: 2px; font-size: 8pt; color: #333;">
                                Cianjur, {{ isset($form->tanggal) ? \Carbon\Carbon::parse($form->tanggal)->format('d F Y') : date('d F Y') }}
                            </div>
                            <div style="margin-bottom: 4px;">
                                <strong style="font-size: 9pt; color: #333;">KOORDINATOR SURVEI</strong>
                            </div>
                            <div style="height: 30px;"></div>
                            <div style="border-top: 1px solid #333; width: 150px; margin: 0 auto; padding-top: 3px;">
                                <strong style="font-size: 9pt; color: #333;">{{ $form->koordinator ?? 'Dr. Ahmad Hidayat, M.Si' }}</strong>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Footer Note di bagian paling bawah -->
        <div style="position: fixed; bottom: 0; left: 0; right: 0; margin: 0; padding: 0 0.8cm; border-top: 1px solid #ddd; background-color: #f9f9f9;">
            <p style="font-size: 8pt; color: #333; margin: 1px 0; font-style: italic; text-align: center;"><em>Formulir 09 - Pengolahan Data dan Kuesioner</em></p>
            <p style="font-size: 9pt; font-weight: 600; margin: 1px 0; color: #333; text-align: center;">JITUPASNA</p>
            <p style="font-size: 7pt; color: #666; margin: 1px 0; text-align: center;">Sistem Informasi Pengkajian Kebutuhan Pasca Bencana</p>
        </div>

        <!-- Spacer untuk memberi ruang untuk signature dan footer fixed -->
        <div style="height: 120px;"></div>

    </div>
</body>

</html>
