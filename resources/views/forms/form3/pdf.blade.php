<!DOCTYPE html>
<html>

<head>
    <title>Form 3 - Pendataan OPD</title>
    <style>
        @page {
            margin: 8mm;
            size: A4;
        }

        body {
            font-family: 'Times New Roman', serif;
            font-size: 8pt;
            line-height: 1.1;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .document-header {
            text-align: center;
            margin-bottom: 8px;
            border-bottom: 1px solid #000;
            padding-bottom: 4px;
        }

        .document-title {
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0 0 2px 0;
            letter-spacing: 0.5px;
        }

        .document-subtitle {
            font-size: 9pt;
            font-weight: normal;
            margin: 0;
        }

        .header-info {
            margin-bottom: 8px;
            background-color: #f8f9fa;
            padding: 4px;
            border: 1px solid #ddd;
        }

        .header-info p {
            margin: 1px 0;
            font-size: 8pt;
        }

        .section-header {
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #e9ecef;
            padding: 4px;
            margin: 8px 0 4px 0;
            border: 1px solid #000;
            text-align: center;
        }

        .subsection-header {
            font-size: 8pt;
            font-weight: bold;
            margin: 4px 0 2px 0;
            padding: 3px;
            background-color: #f8f9fa;
            border-left: 2px solid #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 3px 0;
            font-size: 7pt;
            table-layout: fixed;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th {
            background-color: #e9ecef;
            font-weight: bold;
            text-align: center;
            padding: 3px 2px;
            font-size: 7pt;
            word-wrap: break-word;
        }

        td {
            padding: 2px;
            text-align: left;
            vertical-align: top;
            font-size: 7pt;
            line-height: 1.1;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .category-cell {
            width: 20%;
            font-weight: bold;
            background-color: #f9f9f9;
            text-align: center;
            vertical-align: middle;
            font-size: 7pt;
            padding: 2px;
        }

        .subcategory-cell {
            width: 50%;
            font-size: 7pt;
            padding: 2px;
        }

        .answer-cell {
            width: 30%;
            text-align: right;
            font-size: 7pt;
            padding: 2px;
            padding-right: 6px;
        }

        .text-content {
            margin: 2px 0;
            padding: 3px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            font-size: 8pt;
            min-height: 15px;
        }

        .number-cell {
            text-align: right;
            padding-right: 6px;
            font-size: 7pt;
            width: 30%;
        }

        @media print {
            body {
                font-size: 7pt;
                line-height: 1.0;
            }

            .document-header {
                margin-bottom: 4px;
                padding-bottom: 2px;
            }

            .section-header {
                margin: 4px 0 2px 0;
                padding: 2px;
                font-size: 8pt;
            }

            .subsection-header {
                margin: 2px 0 1px 0;
                padding: 2px;
                font-size: 7pt;
            }

            table {
                margin: 1px 0;
            }

            th,
            td {
                padding: 1px;
                font-size: 7pt;
            }

            .category-cell {
                font-size: 6pt;
            }

            .subcategory-cell {
                font-size: 6pt;
            }

            .answer-cell {
                font-size: 6pt;
            }
        }

        @media print {
            body {
                font-size: 7pt;
                line-height: 1.0;
            }

            .document-header {
                margin-bottom: 4px;
                padding-bottom: 2px;
            }

            .section-header {
                margin: 4px 0 2px 0;
                padding: 2px;
                font-size: 8pt;
            }

            .subsection-header {
                margin: 2px 0 1px 0;
                padding: 2px;
                font-size: 7pt;
            }

            table {
                margin: 1px 0;
            }

            th,
            td {
                padding: 1px;
                font-size: 6pt;
            }

            .category-cell {
                font-size: 6pt;
            }

            .subcategory-cell {
                font-size: 6pt;
            }

            .answer-cell {
                font-size: 6pt;
            }
        }
    </style>
</head>
<<body>
    <div class="document-header">
        <div class="document-title">Formulir 3 - Pendataan Ke OPD</div>
        <div class="document-subtitle">Data Dasar dan Sekunder Akibat Bencana</div>
    </div>

    <div class="header-info">
        <p><strong>Bencana:</strong> {{ $form->bencana->kategori_bencana->nama }}</p>
        <p><strong>Tanggal Kejadian:</strong> {{ $form->bencana->tanggal }}</p>
        <p><strong>Lokasi:</strong>
            @foreach ($form->bencana->desa as $desa)
                {{ $desa->nama }}@if (!$loop->last)
                    ,
                @endif
            @endforeach
        </p>
    </div>

    <!-- 1. DATA DASAR SEBELUM BENCANA -->
    <div class="section-header">1. Data Dasar Sebelum Bencana</div>

    <table>
        <tr>
            <th style="width: 20%; font-size: 7pt;">Kategori</th>
            <th style="width: 50%; font-size: 7pt;">Sub-Kategori</th>
            <th style="width: 30%; font-size: 7pt;">Jawaban</th>
        </tr>        
        @foreach ($form->rows1 as $r)
            <tr>
                <td>{{ $r->kategori }}</td>
                <td>{{ $r->sub_kategori }}</td>
                <td>{!! nl2br(e($r->jawaban)) !!}</td>
            </tr>
        @endforeach
    </table>

    <!-- Sumber data -->
    <div style="font-size: 7pt; margin: 10px 0; font-style: italic;">
        Sumber data: badan pusat statistik (BPS), daerah (Prov, Kab/Kota) dalam angka, data kecamatan/kelurahan serta data program pembangunan
    </div>

    <!-- 2. FORMULIR ISIAN DATA SEKUNDER AKIBAT BENCANA (UMUM) -->
    <div class="section-header">2. Formulir Isian Data Sekunder Akibat Bencana (Umum)</div>

    <table>
        <tr>
            <th style="width: 50%; font-size: 7pt; background-color: #e9ecef;">Pertanyaan</th>
            <th style="width: 50%; font-size: 7pt; background-color: #e9ecef;">Jawaban</th>
        </tr>
        
        @foreach ($form->rows2 as $r)
            <tr>
                <td>{{ $r->pertanyaan }}</td>
                <td><strong>{!! nl2br(e($r->jawaban)) !!}</strong></td>
            </tr>
        @endforeach
    </table>

    <!-- 3. FORMULIR ISIAN DATA SEKUNDER AKIBAT BENCANA (KHUSUS) -->
    <div class="section-header">3. Formulir Isian Data Sekunder Akibat Bencana (Khusus)</div>

    <!-- Header Box -->
    <div style="border: 1px solid black; padding: 8px; margin-bottom: 15px;">
        <div style="margin-bottom: 8px;">
            <strong>Nama OPD :</strong> {{ $form->nama_opd_1 ? $form->nama_opd_1 : s }}
        </div>
        <div style="margin-bottom: 8px; font-style: italic; text-align: left; font-size: 6pt;">
            (OPD yang terkait dengan Bidang Pertanian dalam arti luas seperti: Dinas Pertanian, Perkebunan, Peternakan, Perikanan, Kehutanan)
        </div>
        <div>
            <strong>Tgl/Bln/Thn :</strong> {{ $form->tanggal_opd_1 ? $form->tanggal_opd_1 : '' }}
        </div>
    </div>

    <!-- Tabel Pokok Bahasan dengan format konsisten -->
    <table style="width: 100%; border-collapse: collapse; font-size: 7pt;">
        <thead>
            <tr>
                <th style="width: 8%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">NO</th>
                <th style="width: 92%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">POKOK BAHASAN</th>
            </tr>
        </thead>
        <tbody>
        @php
            $groups_data_sekunder_akibat_bencana_khusus_opd_1 = [
                'Rumah tangga yang terkena bencana dan terganggu kegiatan ekonominya:' => [1, 2, 3, 4, 5],
                'Bentuk gangguan kegiatan ekonomi, pada:' => [6, 7, 8, 9, 10],
                'Dampak pada produk pertanian lokal khas' => [11, 12, 13],
                'Dampak pada organisasi/lembaga pertanian' => [14, 15, 16, 17],
            ];
            // buat map cepat dari rows3 keyed by index (aman terhadap array atau collection)
            $rows3_map = collect($form->rows3)->keyBy(function($item, $k) {
                // asumsi: kalau ada properti index gunakan itu, kalau tidak gunakan key+1
                return $item->index ?? ($k + 1);
            });
        @endphp

        @foreach ($groups_data_sekunder_akibat_bencana_khusus_opd_1 as $groupName => $indexes)
            @foreach ($indexes as $idx)
                @php
                    // ambil row jika ada
                    $row = $rows3_map->get($idx);
                    // question slug (jika Anda punya mapping slug_data_sekunder_... gunakan itu)
                    $question = $slug_data_sekunder_akibat_bencana_khusus_opd_1[$idx] ?? ($row->pertanyaan ?? '');
                    $answer = $row->jawaban ?? '';
                @endphp

                <tr>
                    @if ($loop->first)
                        {{-- nomor grup (1,2,...) --}}
                        <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;" rowspan="{{ count($indexes) }}">
                            {{ $loop->parent->iteration }}
                        </td>
                    @endif

                    <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                        @if ($loop->first)
                            <strong>{{ $groupName }}</strong><br>
                        @endif

                        {{-- pertanyaan / label --}}
                        {!! $question !!}<br>

                        {{-- jawaban --}}
                        <strong>{!! nl2br(e($answer)) !!}</strong>
                    </td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>

    <!-- 4. FORMULIR LANJUTAN: SATUAN KERJA PERANGKAT DAERAH -->
    <div style="page-break-inside: avoid; page-break-before: auto;">
        <div class="section-header">4. FORMULIR LANJUTAN: SATUAN KERJA PERANGKAT DAERAH</div>

        <!-- Header Box -->
        <div style="border: 1px solid black; padding: 8px; margin-bottom: 15px;">
            <div style="margin-bottom: 8px;">
                <strong>Nama OPD :</strong> {{ $form->nama_opd_2 ? $form->nama_opd_2 : '' }}
            </div>
            <div style="margin-bottom: 8px; font-style: italic; text-align: left; font-size: 6pt;">
                (OPD yang terkait dengan Bidang Non Pertanian: Perdagangan,Perindustrian, Koperasi, Usaha Kecil Menengah dll)<br>

            </div>
            <div>
                <strong>Tgl/Bln/Thn :</strong> {{ $form->tanggal_opd_2 ? $form->tanggal_opd_2 : '' }}
            </div>
        </div>

        <!-- Tabel Pokok Bahasan dengan format konsisten dengan bagian 3 -->
        <table style="width: 100%; border-collapse: collapse; font-size: 7pt;">
            
            <thead>
                <tr>
                    <th style="width: 8%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">NO</th>
                    <th style="width: 92%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">POKOK BAHASAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $groups_data_sekunder_akibat_bencana_khusus_opd_2 = [
                    'Rumah tangga yang terkena bencana dan terganggu kegiatan ekonominya' => [1, 2, 3, 4, 5, 6, 7, 8],
                    'Bentuk gangguan kegiatan ekonomi, pada' => [9, 10, 11, 12, 13, 14],
                    'Dampak pada produk industri' => [15, 16, 17],
                    'Dampak organisasi/lembaga koperasi' => [18, 19, 20],
                    ];            
                    // buat map cepat dari rows3 keyed by index (aman terhadap array atau collection)
                    $rows4_map = collect($form->rows4)->keyBy(function($item, $k) {
                    // asumsi: kalau ada properti index gunakan itu, kalau tidak gunakan key+1
                    return $item->index ?? ($k + 1);
                    });
                @endphp
    
                @foreach ($groups_data_sekunder_akibat_bencana_khusus_opd_2 as $groupName => $indexes)
                    @foreach ($indexes as $idx)
                        @php
                            // ambil row jika ada
                            $row = $rows4_map->get($idx);
                            // question slug (jika Anda punya mapping slug_data_sekunder_... gunakan itu)
                            $question = $slug_data_sekunder_akibat_bencana_khusus_opd_2[$idx] ?? ($row->pertanyaan ?? '');
                            $answer = $row->jawaban ?? '';
                        @endphp
    
                        <tr>
                            @if ($loop->first)
                                {{-- nomor grup (1,2,...) --}}
                                <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;" rowspan="{{ count($indexes) }}">
                                    {{ $loop->parent->iteration }}
                                </td>
                            @endif
    
                            <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                                @if ($loop->first)
                                    <strong>{{ $groupName }}</strong><br>
                                @endif
    
                                {{-- pertanyaan / label --}}
                                {!! $question !!}<br>
    
                                {{-- jawaban --}}
                                <strong>{!! nl2br(e($answer)) !!}</strong>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <!-- Catatan -->
        <div style="font-size: 7pt; margin: 10px 0; line-height: 1.3;">
            <strong>Catatan :</strong> perlunya menjabarkan batasan operasional/pengertian dari setiap istilah<br>
            Perdagangan kecil adalah ...<br>
            Perdagangan besar adalah ...<br>
            Industry kecil adalah ...<br>
            Industry besar adalah ....
        </div>
    </div>

    <!-- SATUAN KERJA PERANGKAT DAERAH (TABEL KEDUA) -->
    <div style="page-break-inside: avoid; margin-top: 20px;">
        <div style="text-align: center; font-weight: bold; font-size: 8pt; margin-bottom: 10px;">
            SATUAN KERJA PERANGKAT DAERAH
        </div>

        <!-- Header Box -->
        <div style="border: 1px solid black; padding: 8px; margin-bottom: 15px;">
            <div style="margin-bottom: 8px;">
                <strong>Nama OPD :</strong> {{ $form->nama_opd_3 ? $form->nama_opd_3 : '' }}
            </div>
            <div style="margin-bottom: 8px; font-style: italic; text-align: left; font-size: 6pt;">
                (OPD yang terkait dengan Bidang Sosial dan Keagamaan)
            </div>
            <div>
                <strong>Tgl/Bln/Thn :</strong> {{ $form->tanggal_opd_3 ? $form->tanggal_opd_3 : '' }}
            </div>
        </div>

        <!-- Tabel Pokok Bahasan -->
        <table style="width: 100%; border-collapse: collapse; font-size: 7pt;">
            <thead>
                <tr>
                    <th style="width: 8%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">NO</th>
                    <th style="width: 92%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">POKOK BAHASAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $groups_data_sekunder_akibat_bencana_khusus_opd_3 = [
                        'rumah tangga' => [1],
                        'penyandang cacat' => [2, 3],
                        'kegiatan agama, sosial kemasyarakatan' => [4],
                        'penggerak kegiatan masyarakat' => [5],
                        'kondisi keberfungsian kegiatan masyarakat' => [6, 7],
                        'permasalahan sosial' => [8, 9],
                        'kearifan lokal' => [10],
                    ];

                    // buat map cepat dari rows9 keyed by index (aman terhadap array atau collection)
                    $rows5_map = collect($form->rows5)->keyBy(function($item, $k) {
                        // asumsi: kalau ada properti index gunakan itu, kalau tidak gunakan key+1
                        return $item->index ?? ($k + 1);
                    });
                @endphp
                
                @foreach ($groups_data_sekunder_akibat_bencana_khusus_opd_3 as $groupName => $indexes)
                    @foreach ($indexes as $idx)
                        @php
                            // ambil row jika ada
                            $row = $rows5_map->get($idx);
                            // question slug (jika Anda punya mapping slug_data_sekunder_... gunakan itu)
                            $question = $slug_data_sekunder_akibat_bencana_khusus_opd_3[$idx] ?? ($row->pertanyaan ?? '');
                            $answer = $row->jawaban ?? '';
                        @endphp
    
                        <tr>
                            @if ($loop->first)
                                {{-- nomor grup (1,2,...) --}}
                                <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;" rowspan="{{ count($indexes) }}">
                                    {{ $loop->parent->iteration }}
                                </td>
                            @endif
    
                            <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                                {{-- pertanyaan / label --}}
                                {!! $question !!}<br>
    
                                {{-- jawaban --}}
                                <strong>{!! nl2br(e($answer)) !!}</strong>
                            </td>
                        </tr>
                    @endforeach
                @endforeach                
            </tbody>
        </table>
    </div>

    <!-- SATUAN KERJA PERANGKAT DAERAH (TABEL KETIGA - DINAS PENDIDIKAN) -->
    <div style="page-break-inside: avoid; margin-top: 20px;">
        <div style="text-align: center; font-weight: bold; font-size: 8pt; margin-bottom: 10px;">
            SATUAN KERJA PERANGKAT DAERAH
        </div>

        <!-- Header Box -->
        <div style="border: 1px solid black; padding: 8px; margin-bottom: 15px;">
            <div style="margin-bottom: 8px;">
                <strong>Nama OPD :</strong> {{ $form->nama_opd_4 ? $form->nama_opd_4 : '' }}
            </div>
            <div style="margin-bottom: 8px; font-style: italic; text-align: left; font-size: 6pt;">
                (Dinas Pendidikan)
            </div>
            <div>
                <strong>Tgl/Bln/Thn :</strong> {{ $form->tanggal_opd_4 ? $form->tanggal_opd_4 : '' }}
            </div>
        </div>

        <!-- Tabel Pokok Bahasan -->
        <table style="width: 100%; border-collapse: collapse; font-size: 7pt;">
            <thead>
                <tr>
                    <th style="width: 8%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">NO</th>
                    <th style="width: 92%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">POKOK BAHASAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $groups_data_sekunder_akibat_bencana_khusus_opd_4 = [
                    'Permasalahan umum yang menghambat pelaksanaan pendidikan pada masa sebelum bencana' => [1],
                    'Trauma siswa dan/atau guru setelah bencana' => [2, 3],
                    'Permasalahan pendidikan akibat bencana' => [4, 5, 6],
                    'Guru yang meninggal/berpindah setelah bencana' => [7, 8],
                ];
                    // buat map cepat dari rows6 keyed by index (aman terhadap array atau collection)
                    $rows6_map = collect($form->rows6)->keyBy(function($item, $k) {
                    // asumsi: kalau ada properti index gunakan itu, kalau tidak gunakan key+1
                    return $item->index ?? ($k + 1);
                    });                    
                @endphp
                @foreach ($groups_data_sekunder_akibat_bencana_khusus_opd_4 as $groupName => $indexes)
                    @foreach ($indexes as $idx)
                        @php
                            // ambil row jika ada
                            $row = $rows6_map->get($idx);
                            // question slug (jika Anda punya mapping slug_data_sekunder_... gunakan itu)
                            $question = $slug_data_sekunder_akibat_bencana_khusus_opd_4[$idx] ?? ($row->pertanyaan ?? '');
                            $answer = $row->jawaban ?? '';
                        @endphp
    
                        <tr>
                            @if ($loop->first)
                                {{-- nomor grup (1,2,...) --}}
                                <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;" rowspan="{{ count($indexes) }}">
                                    {{ $loop->parent->iteration }}
                                </td>
                            @endif
    
                            <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                                {{-- pertanyaan / label --}}
                                {!! $question !!}<br>
    
                                {{-- jawaban --}}
                                <strong>{!! nl2br(e($answer)) !!}</strong>
                            </td>
                        </tr>
                    @endforeach
                @endforeach                
            </tbody>
        </table>
    </div>

    <!-- SATUAN KERJA PERANGKAT DAERAH (TABEL KEEMPAT - PEKERJAAN DAERAH) -->
    <div style="page-break-inside: avoid; margin-top: 20px;">
        <div style="text-align: center; font-weight: bold; font-size: 8pt; margin-bottom: 10px;">
            SATUAN KERJA PERANGKAT DAERAH
        </div>

        <!-- Header Box -->
        <div style="border: 1px solid black; padding: 8px; margin-bottom: 15px;">
            <div style="margin-bottom: 8px;">
                <strong>Nama OPD :</strong> {{ $form->nama_opd_5 ? $form->nama_opd_5 : '' }}
            </div>
            <div style="margin-bottom: 8px; font-style: italic; text-align: left; font-size: 6pt;">
                (Pekerjaan Daerah)
            </div>
            <div>
                <strong>Tgl/Bln/Thn :</strong> {{ $form->tanggal_opd_5 ? $form->tanggal_opd_5 : '' }}
            </div>
        </div>

        <!-- Tabel Pokok Bahasan -->
        <table style="width: 100%; border-collapse: collapse; font-size: 7pt;">
            <thead>
                <tr>
                    <th style="width: 8%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">NO</th>
                    <th style="width: 92%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">POKOK BAHASAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $groups_data_sekunder_akibat_bencana_khusus_opd_5 = [
                        'a' => [1, 2, 3],
                        'b' => [4, 5],
                        'c' => [6, 7],
                        'd' => [8, 9],
                        'e' => [10, 11],
                        'f' => [12, 13],
                    ];  
                    // buat map cepat dari rows7 keyed by index (aman terhadap array atau collection)
                    $rows7_map = collect($form->rows7)->keyBy(function($item, $k) {
                        // asumsi: kalau ada properti index gunakan itu, kalau tidak gunakan key+1
                        return $item->index ?? ($k + 1);
                    });
                @endphp
                @foreach ($groups_data_sekunder_akibat_bencana_khusus_opd_5 as $groupName => $indexes)
                    @foreach ($indexes as $idx)
                        @php
                            // ambil row jika ada
                            $row = $rows7_map->get($idx);
                            // question slug (jika Anda punya mapping slug_data_sekunder_... gunakan itu)
                            $question = $slug_data_sekunder_akibat_bencana_khusus_opd_5[$idx] ?? ($row->pertanyaan ?? '');
                            $answer = $row->jawaban ?? '';
                        @endphp
    
                        <tr>
                            @if ($loop->first)
                                {{-- nomor grup (1,2,...) --}}
                                <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;" rowspan="{{ count($indexes) }}">
                                    {{ $loop->parent->iteration }}
                                </td>
                            @endif
    
                            <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                                {{-- pertanyaan / label --}}
                                {!! $question !!}<br>
    
                                {{-- jawaban --}}
                                <strong>{!! nl2br(e($answer)) !!}</strong>
                            </td>
                        </tr>
                    @endforeach
                @endforeach           
            </tbody>
        </table>
    </div>

    <!-- SATUAN KERJA PERANGKAT DAERAH (TABEL KELIMA - DINAS KESEHATAN) -->
    <div style="page-break-inside: avoid; margin-top: 20px;">
        <div style="text-align: center; font-weight: bold; font-size: 8pt; margin-bottom: 10px;">
            SATUAN KERJA PERANGKAT DAERAH
        </div>

        <!-- Header Box -->
        <div style="border: 1px solid black; padding: 8px; margin-bottom: 15px;">
            <div style="margin-bottom: 8px;">
                <strong>Nama OPD :</strong> {{ $form->nama_opd_6 ? $form->nama_opd_6 : '' }}
            </div>
            <div style="margin-bottom: 8px; font-style: italic; text-align: left; font-size: 6pt;">
                (Dinas Kesehatan)
            </div>
            <div>
                <strong>Tgl/Bln/Thn :</strong> {{ $form->tanggal_opd_6 ? $form->tanggal_opd_6 : '' }}
            </div>
        </div>

        <!-- Tabel Pokok Bahasan -->
        <table style="width: 100%; border-collapse: collapse; font-size: 7pt;">
            <thead>
                <tr>
                    <th style="width: 8%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">NO</th>
                    <th style="width: 92%; border: 1px solid black; padding: 4px; text-align: center; font-weight: bold; background-color: #f0f0f0;">POKOK BAHASAN</th>
                </tr>
            </thead>
            <tbody>
                @php                    
                    $groups_data_sekunder_akibat_bencana_khusus_opd_6 = [
                        'a' => [1],
                        'b' => [2, 3],
                        'c' => [4],
                        'd' => [5, 6],
                        'e' => [7],
                        'f' => [8, 9, 10],
                        'g' => [11, 12, 13],
                        'h' => [14, 15, 16],
                        'i' => [17, 18],
                        'j' => [19],
                    ];
                    // buat map cepat dari rows8 keyed by index (aman terhadap array atau collection)
                    $rows8_map = collect($form->rows8)->keyBy(function($item, $k) {
                        // asumsi: kalau ada properti index gunakan itu, kalau tidak gunakan key+1
                        return $item->index ?? ($k + 1);
                    });
                @endphp

                @foreach ($groups_data_sekunder_akibat_bencana_khusus_opd_6 as $groupName => $indexes)
                    @foreach ($indexes as $idx)
                        @php
                            // ambil row jika ada
                            $row = $rows8_map->get($idx);
                            // question slug (jika Anda punya mapping slug_data_sekunder_... gunakan itu)
                            $question = $slug_data_sekunder_akibat_bencana_khusus_opd_6[$idx] ?? ($row->pertanyaan ?? '');
                            $answer = $row->jawaban ?? '';
                        @endphp
    
                        <tr>
                            @if ($loop->first)
                                {{-- nomor grup (1,2,...) --}}
                                <td style="border: 1px solid black; padding: 4px; vertical-align: top; text-align: center;" rowspan="{{ count($indexes) }}">
                                    {{ $loop->parent->iteration }}
                                </td>
                            @endif
    
                            <td style="border: 1px solid black; padding: 4px; vertical-align: top;">
                                {{-- pertanyaan / label --}}
                                {!! $question !!}<br>
    
                                {{-- jawaban --}}
                                <strong>{!! nl2br(e($answer)) !!}</strong>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px; border-top: 1px solid #000; padding-top: 10px; font-size: 8pt; color: #666;">
        <p><strong>Tanggal Pengisian:</strong> {{ $form->created_at ? $form->created_at->format('d F Y H:i') : 'Tidak tersedia' }}</p>
        <p><strong>Terakhir Diupdate:</strong> {{ $form->updated_at ? $form->updated_at->format('d F Y H:i') : 'Tidak tersedia' }}</p>
    </div>
    </body>

</html>
