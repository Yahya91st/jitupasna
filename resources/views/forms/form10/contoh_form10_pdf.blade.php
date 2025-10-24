{{-- 
    Formulir 10 PDF Template
    
    Cara penggunaan:
    1. Jika dipanggil dari controller dengan data: pass variabel $form
    2. Jika dipanggil tanpa data: akan menggunakan data contoh default
    
    Contoh pemanggilan dengan data:
    return view('forms.form10.contoh_form10_pdf', compact('form'));
--}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 10 - Analisa Data Akibat terhadap Akses, Fungsi dan Resiko</title>
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

        .main-table {
            page-break-inside: avoid;
            margin-bottom: 2px;
            border: 1px solid #333;
        }
        
        .main-table td {
            padding: 2px 3px;
            font-size: 7pt;
            line-height: 1.1;
            vertical-align: top;
        }
        
        .main-table th {
            padding: 4px 3px;
            font-size: 8pt;
            line-height: 1.2;
            font-weight: 600;
        }

        .sector-header {
            font-weight: 600;
            background-color: #fff !important;
            text-align: center !important;
            border: none !important;
            vertical-align: middle !important;
            padding: 8px 4px !important;
        }

        .sector-header-row {
            background-color: #fff !important;
        }

        .sector-header-row td {
            border: none !important;
            background-color: #fff !important;
            text-align: center !important;
            vertical-align: middle !important;
            padding: 8px 4px !important;
        }

        .sector-row {
            background-color: #fff;
        }

        tbody tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .sector-header-row:nth-child(even) td {
            background-color: #fff !important;
        }

        .number-cell {
            text-align: center;
            width: 4%;
            font-weight: 600;
        }

        .sector-cell {
            width: 12%;
            font-weight: 500;
        }

        .location-cell {
            width: 12%;
        }

        .analysis-cell {
            width: 18%;
        }

        .needs-cell {
            width: 18%;
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
            <h2>FORMULIR 10</h2>
            <h3>Analisa Data Akibat terhadap Akses, Fungsi dan Resiko, serta Analisa Kebutuhan</h3>
            <div style="font-size: 7pt; margin-top: 2px; color: #333;">JITUPASNA - Sistem Informasi Pengkajian Kebutuhan Pasca Bencana</div>
        </div>

        <!-- Intro Text -->
        <div class="intro-text">
            <span class="intro-label">Petunjuk Penggunaan:</span>
            Formulir ini digunakan untuk menganalisa dampak bencana terhadap berbagai sektor dan menentukan kebutuhan pemulihan. <em>Isi setiap kolom berdasarkan hasil pengumpulan data dari survei, wawancara/FGD, dan pendalaman lapangan.</em>
        </div>

        <!-- Main Analysis Table -->
        <table class="main-table">
            <thead>
                <tr>
                    <th class="number-cell" rowspan="2">No</th>
                    <th class="sector-cell" rowspan="2">Sektor-sub.sektor</th>
                    <th class="location-cell" rowspan="2">Lokasi bencana terjadi</th>
                    <th colspan="3">Akibat terhadap akses, fungsi dan resiko</th>
                    <th class="needs-cell" rowspan="2">Kebutuhan-kegiatan pemulihan</th>
                </tr>
                <tr>
                    <th class="analysis-cell">Point penting hasil pengolahan data survey</th>
                    <th class="analysis-cell">Point penting hasil wawancara/FGD</th>
                    <th class="analysis-cell">Point penting hasil pendalaman</th>
                </tr>
            </thead>
            <tbody>
                <!-- 1. PERUMAHAN -->
                <tr class="sector-header-row">
                    <td colspan="7" class="sector-header" style="text-align: center; font-weight: bold; padding: 8px; border: none;"><strong>1. PERUMAHAN</strong></td>
                </tr>
                <tr>
                    <td class="number-cell"></td>
                    <td>Rumah rusak berat</td>
                    <td>{{ $form->perumahan_1_lokasi ?? 'Desa Sukamaju RT 01-05' }}</td>
                    <td>{{ $form->perumahan_1_survey ?? '120 unit rumah rusak berat, 80% warga kehilangan tempat tinggal' }}</td>
                    <td>{{ $form->perumahan_1_wawancara ?? 'Warga membutuhkan bantuan material bangunan dan tenaga kerja untuk rekonstruksi' }}</td>
                    <td>{{ $form->perumahan_1_pendalaman ?? 'Kondisi tanah masih labil, perlu perkuatan fondasi khusus' }}</td>
                    <td>{{ $form->perumahan_1_pemulihan ?? 'Bantuan material bangunan, alat konstruksi, dan pelatihan teknik bangunan tahan gempa' }}</td>
                </tr>
                <tr>
                    <td class="number-cell"></td>
                    <td>Rumah rusak sedang</td>
                    <td>{{ $form->perumahan_2_lokasi ?? 'Desa Sukamaju RT 06-10' }}</td>
                    <td>{{ $form->perumahan_2_survey ?? '85 unit rumah rusak sedang, dapat diperbaiki dengan renovasi' }}</td>
                    <td>{{ $form->perumahan_2_wawancara ?? 'Prioritas perbaikan atap dan dinding yang retak' }}</td>
                    <td>{{ $form->perumahan_2_pendalaman ?? 'Struktur utama masih kuat, hanya perlu perbaikan minor' }}</td>
                    <td>{{ $form->perumahan_2_pemulihan ?? 'Bantuan seng, semen, cat, dan peralatan renovasi ringan' }}</td>
                </tr>
                <tr>
                    <td class="number-cell"></td>
                    <td>Sarana air bersih</td>
                    <td>{{ $form->perumahan_3_lokasi ?? 'Seluruh wilayah desa' }}</td>
                    <td>{{ $form->perumahan_3_survey ?? 'Sumur warga tertutup longsoran, 60% kehilangan akses air bersih' }}</td>
                    <td>{{ $form->perumahan_3_wawancara ?? 'Kebutuhan mendesak air bersih untuk konsumsi dan sanitasi' }}</td>
                    <td>{{ $form->perumahan_3_pendalaman ?? 'Sumber mata air utama tercemar material longsor' }}</td>
                    <td>{{ $form->perumahan_3_pemulihan ?? 'Pembersihan sumur, instalasi pipa air bersih, dan pompa air komunal' }}</td>
                </tr>

                <!-- 2. INFRASTRUKTUR -->
                <tr class="sector-header-row">
                    <td colspan="7" class="sector-header" style="text-align: center; font-weight: bold; padding: 8px; border: none;"><strong>2. INFRASTRUKTUR</strong></td>
                </tr>
                <tr>
                    <td class="number-cell"></td>
                    <td>Transportasi</td>
                    <td>{{ $form->transportasi_lokasi ?? 'Jalan utama desa sepanjang 2 km' }}</td>
                    <td>{{ $form->transportasi_survey ?? 'Jalan utama putus di 3 titik, akses kendaraan terganggu total' }}</td>
                    <td>{{ $form->transportasi_wawancara ?? 'Warga kesulitan akses ke pasar dan fasilitas kesehatan' }}</td>
                    <td>{{ $form->transportasi_pendalaman ?? 'Diperlukan alat berat untuk pembersihan material longsor' }}</td>
                    <td>{{ $form->transportasi_pemulihan ?? 'Pembersihan jalan, perbaikan aspal, dan pembuatan jalan alternatif sementara' }}</td>
                </tr>
                <tr>
                    <td class="number-cell"></td>
                    <td>Energi</td>
                    <td>{{ $form->energi_lokasi ?? 'Jaringan listrik desa' }}</td>
                    <td>{{ $form->energi_survey ?? 'Tiang listrik roboh, 90% wilayah padam listrik' }}</td>
                    <td>{{ $form->energi_wawancara ?? 'Kebutuhan listrik untuk penerangan dan aktivitas ekonomi' }}</td>
                    <td>{{ $form->energi_pendalaman ?? 'Transformer utama rusak, perlu penggantian' }}</td>
                    <td>{{ $form->energi_pemulihan ?? 'Penggantian tiang listrik, kabel, dan transformer baru' }}</td>
                </tr>

                <!-- 3. EKONOMI PRODUKTIF -->
                <tr class="sector-header-row">
                    <td colspan="7" class="sector-header" style="text-align: center; font-weight: bold; padding: 8px; border: none;"><strong>3. EKONOMI PRODUKTIF</strong></td>
                </tr>
                <tr>
                    <td class="number-cell"></td>
                    <td>Pertanian</td>
                    <td>{{ $form->pertanian_lokasi ?? 'Sawah dan ladang desa seluas 150 ha' }}</td>
                    <td>{{ $form->pertanian_survey ?? 'Sawah tertutup longsoran 40 ha, irigasi rusak sepanjang 3 km' }}</td>
                    <td>{{ $form->pertanian_wawancara ?? 'Petani kehilangan sumber mata pencaharian utama, butuh bantuan modal' }}</td>
                    <td>{{ $form->pertanian_pendalaman ?? 'Tanah sawah dapat dipulihkan dengan pembersihan intensif' }}</td>
                    <td>{{ $form->pertanian_pemulihan ?? 'Pembersihan lahan, perbaikan irigasi, bantuan bibit dan pupuk' }}</td>
                </tr>
                <tr>
                    <td class="number-cell"></td>
                    <td>Peternakan</td>
                    <td>{{ $form->peternakan_lokasi ?? 'Kandang ternak di 5 lokasi' }}</td>
                    <td>{{ $form->peternakan_survey ?? '25 ekor sapi, 150 ekor kambing hilang/mati' }}</td>
                    <td>{{ $form->peternakan_wawancara ?? 'Peternak kehilangan aset utama, butuh bantuan ternak pengganti' }}</td>
                    <td>{{ $form->peternakan_pendalaman ?? 'Kandang roboh total, perlu dibangun ulang' }}</td>
                    <td>{{ $form->peternakan_pemulihan ?? 'Bantuan ternak pengganti, pakan, dan pembangunan kandang baru' }}</td>
                </tr>

                <!-- 4. SOSIAL -->
                <tr class="sector-header-row">
                    <td colspan="7" class="sector-header" style="text-align: center; font-weight: bold; padding: 8px; border: none;"><strong>4. SOSIAL</strong></td>
                </tr>
                <tr>
                    <td class="number-cell"></td>
                    <td>Pendidikan</td>
                    <td>{{ $form->pendidikan_lokasi ?? 'SDN Sukamaju dan SMPN 1 Sukamaju' }}</td>
                    <td>{{ $form->pendidikan_survey ?? '2 gedung sekolah rusak berat, 450 siswa tidak dapat belajar' }}</td>
                    <td>{{ $form->pendidikan_wawancara ?? 'Guru dan siswa butuh ruang belajar sementara' }}</td>
                    <td>{{ $form->pendidikan_pendalaman ?? 'Buku dan alat tulis tertimbun, butuh penggantian' }}</td>
                    <td>{{ $form->pendidikan_pemulihan ?? 'Tenda sekolah darurat, buku paket, dan alat tulis untuk siswa' }}</td>
                </tr>
                <tr>
                    <td class="number-cell"></td>
                    <td>Kesehatan</td>
                    <td>{{ $form->kesehatan_lokasi ?? 'Puskesmas dan Posyandu desa' }}</td>
                    <td>{{ $form->kesehatan_survey ?? 'Puskesmas rusak, obat-obatan hilang, 1 tenaga medis cedera' }}</td>
                    <td>{{ $form->kesehatan_wawancara ?? 'Kebutuhan mendesak pelayanan kesehatan dan obat-obatan' }}</td>
                    <td>{{ $form->kesehatan_pendalaman ?? 'Alat medis rusak, perlu fasilitas kesehatan darurat' }}</td>
                    <td>{{ $form->kesehatan_pemulihan ?? 'Posko kesehatan darurat, obat-obatan, dan alat medis' }}</td>
                </tr>

                <!-- 5. LINTAS SEKTOR -->
                <tr class="sector-header-row">
                    <td colspan="7" class="sector-header" style="text-align: center; font-weight: bold; padding: 8px; border: none;"><strong>5. LINTAS SEKTOR</strong></td>
                </tr>
                <tr>
                    <td class="number-cell"></td>
                    <td>Pemerintahan</td>
                    <td>{{ $form->pemerintahan_lokasi ?? 'Kantor Desa Sukamaju' }}</td>
                    <td>{{ $form->pemerintahan_survey ?? 'Kantor desa rusak, dokumen administrasi hilang' }}</td>
                    <td>{{ $form->pemerintahan_wawancara ?? 'Butuh tempat sementara untuk pelayanan administrasi' }}</td>
                    <td>{{ $form->pemerintahan_pendalaman ?? 'Data kependudukan dapat dipulihkan dari backup kecamatan' }}</td>
                    <td>{{ $form->pemerintahan_pemulihan ?? 'Kantor sementara, komputer, dan peralatan administrasi' }}</td>
                </tr>
                <tr>
                    <td class="number-cell"></td>
                    <td>Lingkungan hidup</td>
                    <td>{{ $form->lingkungan_lokasi ?? 'Kawasan hutan dan sungai desa' }}</td>
                    <td>{{ $form->lingkungan_survey ?? 'Erosi berat di 10 titik, sungai tersumbat material longsor' }}</td>
                    <td>{{ $form->lingkungan_wawancara ?? 'Kekhawatiran banjir saat musim hujan tiba' }}</td>
                    <td>{{ $form->lingkungan_pendalaman ?? 'Perlu penanganan darurat pencegahan banjir dan longsor susulan' }}</td>
                    <td>{{ $form->lingkungan_pemulihan ?? 'Normalisasi sungai, penanaman pohon, dan pembuatan talud penahan longsor' }}</td>
                </tr>

                <!-- TOTAL KEBUTUHAN -->
                <tr class="sector-header-row">
                    <td colspan="6" class="sector-header" style="text-align: center; font-weight: bold; padding: 8px; border: none;"><strong>JUMLAH KEBUTUHAN</strong></td>
                    <td class="sector-header" style="text-align: center; font-weight: bold; padding: 8px; border: none;">{{ $form->jumlah_kebutuhan_form10 ?? 'Rp 2.5 Miliar (estimasi untuk pemulihan lengkap)' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Catatan -->
        <div style="margin-top: 8px; font-size: 7pt; line-height: 1.2; background-color: #f9f9f9; padding: 4px 6px; border-left: 2px solid #333; border-radius: 2px;">
            <div style="font-weight: 600; color: #333; margin-bottom: 3px;">Catatan Penting</div>
            <div style="color: #333;">
                <div style="margin-bottom: 1px;">✓ Data di atas merupakan hasil analisa komprehensif dari survei lapangan, wawancara dengan warga, dan FGD dengan tokoh masyarakat</div>
                <div style="margin-bottom: 1px;">✓ Prioritas pemulihan disesuaikan dengan tingkat kebutuhan mendesak dan ketersediaan sumber daya</div>
                <div style="margin-bottom: 1px;">✓ Estimasi biaya pemulihan memerlukan verifikasi lebih lanjut dengan ahli teknis</div>
                <div style="margin-bottom: 1px;">✓ Data ini menjadi dasar untuk perencanaan program rehabilitasi dan rekonstruksi pasca bencana</div>
                @if(!isset($form))
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
                            <div style="margin-bottom: 6px;">
                                <strong style="font-size: 8pt; color: #333;">TIM ANALISIS DATA</strong>
                            </div>
                            <div style="height: 30px;"></div>
                            <div style="border-top: 1px solid #333; width: 150px; margin: 0 auto; padding-top: 3px;">
                                <strong style="font-size: 8pt; color: #333;">{{ $form->tim_analisis ?? 'Dr. Budi Santoso, M.Si' }}</strong>
                            </div>
                        </td>
                        <td style="width: 50%; border: none; text-align: center; vertical-align: top; padding: 8px;">
                            <div style="margin-bottom: 3px; font-size: 7pt; color: #666; font-weight: 500;">
                                {{ isset($form->tanggal) ? \Carbon\Carbon::parse($form->tanggal)->format('d F Y') : date('d F Y') }}
                            </div>
                            <div style="margin-bottom: 6px;">
                                <strong style="font-size: 8pt; color: #333;">KEPALA BPBD</strong>
                            </div>
                            <div style="height: 30px;"></div>
                            <div style="border-top: 1px solid #333; width: 150px; margin: 0 auto; padding-top: 3px;">
                                <strong style="font-size: 8pt; color: #333;">{{ $form->kepala_bpbd ?? 'Drs. Ahmad Hidayat, M.M' }}</strong>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Footer Note di bagian paling bawah -->
        <div style="position: fixed; bottom: 0; left: 0; right: 0; margin: 0; padding: 0 0.8cm; border-top: 1px solid #ddd; background-color: #f9f9f9;">
            <p style="font-size: 8pt; color: #333; margin: 1px 0; font-style: italic; text-align: center;"><em>Formulir 10 - Analisa Data Akibat terhadap Akses, Fungsi dan Resiko, serta Analisa Kebutuhan</em></p>
            <p style="font-size: 9pt; font-weight: 600; margin: 1px 0; color: #333; text-align: center;">JITUPASNA</p>
            <p style="font-size: 7pt; color: #666; margin: 1px 0; text-align: center;">Sistem Informasi Pengkajian Kebutuhan Pasca Bencana</p>
        </div>

        <!-- Spacer untuk memberi ruang untuk signature dan footer fixed -->
        <div style="height: 120px;"></div>

    </div>
</body>

</html>
