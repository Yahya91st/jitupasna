@extends('layouts.main')

@section('content')
<style>        
    /* Container styling - dari Form6 */
    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 25px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        font-family: 'Times New Roman', serif;
    }
    
    /* Header styling - dari Form6 */
    .form-header {
        text-align: center;
        margin-bottom: 25px;
        padding: 20px 0;
        border-bottom: 3px solid #0066cc;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 8px;
    }
    
    .form-header h5 {
        margin: 8px 0;
        color: #333;
        font-weight: 600;
        font-size: 18px;
        font-family: 'Times New Roman', serif;
    }
    
    /* Table styling - Enhanced untuk Form9 */
    .form-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-family: 'Times New Roman', serif;
        font-size: 13px;
        table-layout: fixed;
        background: white;
        border: 2px solid #333;
    }
    
    .form-table th,
    .form-table td {
        border: 1px solid #333;
        padding: 10px 8px;
        text-align: center;
        vertical-align: middle;
        word-wrap: break-word;
        overflow-wrap: break-word;
        line-height: 1.4;
    }
    
    .table-header {
        background-color: white !important;
        color: #333 !important;
        text-align: center;
        font-weight: bold;
        border: 1px solid #333;
        padding: 12px 8px;
        font-size: 12px;
        line-height: 1.3;
        vertical-align: middle;
    }
    
    /* Data row styling */
    .form-table tbody tr td {
        padding: 8px 6px;
        font-size: 12px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #333;
        min-height: 35px;
    }
    
    .form-table tbody tr td:nth-child(1),
    .form-table tbody tr td:nth-child(2) {
        text-align: left;
        font-weight: 500;
        padding-left: 8px;
    }
    
    .form-table tbody tr td:nth-child(3) {
        text-align: left;
        padding-left: 10px;
    }
    
    /* Input styling */
    .form-control-sm {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 6px 8px;
        font-size: 12px;
        text-align: center;
        background-color: white;
        transition: all 0.2s ease;
        width: 100%;
        min-height: 28px;
    }
    
    .form-control-sm:focus {
        outline: 2px solid #0066cc;
        outline-offset: -2px;
        background-color: #f0f8ff;
        border-color: #0066cc;
    }
    
    .form-control-sm:hover {
        background-color: #f9f9f9;
        border-color: #0066cc;
    }
    
    /* Button Styling - Kombinasi Form3 & Form6 */
    .form-button {
        margin: 0 5px;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        font-family: 'Times New Roman', serif;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-button:hover {
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
    
    /* Action buttons container - Dari Form3 */
    .d-flex {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    
    /* Petunjuk styling */
    .mt-4 h6 {
        color: #333;
        font-weight: 600;
        margin-bottom: 15px;
        border-bottom: 2px solid #0066cc;
        padding-bottom: 8px;
        font-family: 'Times New Roman', serif;
    }
    
    .mt-4 ul {
        background: #f8f9fa;
        padding: 15px 20px;
        border-radius: 6px;
        border-left: 4px solid #0066cc;
    }
    
    .mt-4 ul li {
        margin-bottom: 8px;
        line-height: 1.5;
        color: #333;
    }
    
    /* Responsive */
    @media (max-width: 1200px) {
        .container {
            max-width: 100%;
            padding: 15px;
            margin: 10px;
        }
        
        .form-table {
            font-size: 12px;
        }
        
        .form-table th, .form-table td {
            padding: 6px 4px;
        }
        
        .form-control-sm {
            font-size: 11px;
            padding: 4px 6px;
            min-height: 24px;
        }
    }
    
    @media (max-width: 768px) {
        .form-table {
            font-size: 11px;
        }
        
        .form-table th, .form-table td {
            padding: 4px 3px;
        }
        
        .form-control-sm {
            font-size: 10px;
            padding: 3px 4px;
            min-height: 22px;
        }
        
        .form-button {
            margin: 2px;
            padding: 6px 12px;
            font-size: 12px;
        }
        
        .container {
            padding: 10px;
        }
    }
    
    /* Print Styles */
    @media print {
        .form-table {
            page-break-inside: auto;
            border: 2px solid #000 !important;
        }
        
        .form-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        
        .form-table td, 
        .form-table th {
            border: 1px solid #000 !important;
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }
        
        .form-table thead th {
            background-color: #b3b3b3 !important;
            border-bottom: 2px solid #000 !important;
        }
        
        .form-button, .no-print {
            display: none !important;
        }
        
        .container {
            box-shadow: none;
            margin: 0;
            padding: 10px;
        }
        
        body {
            font-size: 12pt;
            line-height: 1.4;
        }
        
        .form-control-sm {
            border: none !important;
            background: transparent !important;
        }
    }
</style>
<div class="container">    
    <!-- Document Header - Style dari Form6 -->
    <div class="form-header">
        <h5><strong>Formulir 09</strong></h5>
        <h5>Pengolahan Data dan Kuesioner</h5>
    </div>

    <form action="{{ route('forms.form9.store') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ request()->get('bencana_id') }}">

        <div>
            <table class="form-table text-center align-middle" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <th class="table-header" rowspan="2" style="vertical-align: middle;">No</th>
                        <th class="table-header" rowspan="2" style="vertical-align: middle;">Pertanyaan</th>
                        <th class="table-header" rowspan="2" style="vertical-align: middle;">Kategori jawaban</th>
                        <th class="table-header" colspan="6">Nomor Kuesioner*</th>
                        <th class="table-header" rowspan="2">Jumlah***</th>
                        <th class="table-header" rowspan="2">Persentase****</th>
                    </tr>
                    <tr>
                        <th class="table-header">1</th>
                        <th class="table-header">2</th>
                        <th class="table-header">3</th>
                        <th class="table-header">…</th>
                        <th class="table-header">…</th>
                        <th class="table-header">…</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $rows = [
                            ["no" => "a", "pertanyaan" => "Jenis kelamin responden", "jawaban" => ["Laki-laki", "Perempuan"]],
                            ["no" => "b", "pertanyaan" => "Umur", "jawaban" => ["≤ 20 th", "21 th – 30 th", "31 th – 40 th", "41 th – 50 th", "> 50 th"]],
                            ["no" => "c", "pertanyaan" => "Desa/kelurahan", "jawaban" => ["(Isi nama desa/kelurahan)"]],
                            ["no" => "d", "pertanyaan" => "Kecamatan", "jawaban" => ["(Isi nama kecamatan)"]],
                            ["no" => "e", "pertanyaan" => "Kabupaten", "jawaban" => ["(Isi nama kabupaten)"]],
                            ["no" => "f", "pertanyaan" => "Pendidikan terakhir", "jawaban" => ["SD", "SLTP", "SLTA", "PT"]],
                            ["no" => "g", "pertanyaan" => "Apakah responden kepala Rumah Tangga Perempuan", "jawaban" => ["Ya", "Tidak"]],
                            ["no" => "h", "pertanyaan" => "Jumlah anggota keluarga", "jawaban" => ["≤ 3", "3 – 5", "> 5"]],
                            ["no" => "i", "pertanyaan" => "Jumlah anak (di bawah 18 th)", "jawaban" => ["1", "2", "3", ">3"]],
                            ["no" => "g", "pertanyaan" => "Jumlah anak balita", "jawaban" => ["1", "2", "3", ">3"]],
                            ["no" => "h", "pertanyaan" => "Tipe hunian sekarang", "jawaban" => ["Rumah tinggal sendiri", "Rumah tumpangan", "Pengungsian", "Fasilitas umum", "Lain-lain"]],
                            ["no" => "1", "pertanyaan" => "Sebelum bencana, siapa sajakah pencari nafkah keluarga? (bisa pilih lebih dari satu)", "jawaban" => ["Suami", "Istri", "Anak (<18 tahun)", "Lainnya"]],
                            ["no" => "2", "pertanyaan" => "Setelah bencana, siapa pencari nafkah keluarga yang masih bekerja? (bisa pilih lebih dari satu)", "jawaban" => ["Suami", "Istri", "Anak (<18 tahun)", "Lainnya"]],
                            ["no" => "3", "pertanyaan" => "Sebutkan tiga sumber utama penghasilan keluarga sebelum bencana?", "jawaban" => ["Pertanian", "Peternakan", "Perdagangan", "Industri", "Jasa", "Pegawai", "Pertukangan", "Nelayan"]],
                            ["no" => "4", "pertanyaan" => "Adakah sumber penghasilan keluarga yang hilang/menurun setelah bencana?", "jawaban" => ["Ada", "Tidak"]],
                            ["no" => "5", "pertanyaan" => "Sebutkan satu bantuan yang paling dibutuhkan untuk mempertahankan / memulihkan / meningkatkan mata pencaharian keluarga?", "jawaban" => ["Ketrampilan", "Peralatan", "Modal", "Akses Pasar", "Lain-lain,................"]],
                            ["no" => "6", "pertanyaan" => "Apakah sumber cadangan keluarga Anda yang terganggu setelah bencana? (Pilih maksimal tiga)", "jawaban" => ["Tabungan", "Pinjaman", "Barang/Perhiasan dll", "Ternak/bibit/hasil pertanian,dll", "Jaminan Sosial Pemerintah", "Lainnya.........."]],
                            ["no" => "7", "pertanyaan" => "Dukungan apa saja yang dapat memulihkan sumber cadangan anda?", "jawaban" => ["Koperasi", "Kelompok Usaha Bersama", "Pinjaman", "Bantuan pemerintah", "Lain-lain............."]],
                            ["no" => "8", "pertanyaan" => "Saat ini, bagaimana perlindungan terhadap perempuan dan anak dari ancaman kekerasan dari dalam/luar rumah tangga?", "jawaban" => ["Meningkat", "Menurun", "Sama saja"]],
                            ["no" => "9", "pertanyaan" => "Setelah bencana ini, bantuan apa yang diperlukan oleh keluarga anda untuk memulihkan dan meningkatkan perlindungan terhadap perempuan dan anak dari ancaman kekerasan dalam/luar rumah tangga?", "jawaban" => ["Penyuluhan", "Penguatan moral", "Polisi keliling", "Pos Pengaduan", "Rumah perlindungan bagi korban kekerasan", "Lain-lain .........."]],
                            ["no" => "10", "pertanyaan" => "Setelah bencana ini, masalah perumahan apa yang dihadapi keluarga Anda?", "jawaban" => ["Harus relokasi", "Rumah & lingkungan perumahan rusak", "Masih belum mempunyai rumah", "Lainnya........"]],
                            ["no" => "11", "pertanyaan" => "Sehubungan dengan masalah perumahan di atas, apa yang perlu dilakukan untuk mengatasinya?", "jawaban" => ["Stimulus pembangunan rumah", "Kredit perumahan", "Bantuan teknis", "Lainnya..."]],
                            ["no" => "12", "pertanyaan" => "Satu tahun dari sekarang, kira-kira bapak/ibu akan tinggal di mana?", "jawaban" => ["Di rumah asal", "Di desa asal", "Di tempat lain, sebutkan..."]],
                            ["no" => "13", "pertanyaan" => "Dalam tiga minggu ke depan, bagaimanakah keluarga anda mendapatkan makanan?", "jawaban" => ["Bantuan pangan", "Cadangan keluarga", "Sisa tanaman yang terselamatkan", "Lainnya........"]],
                            ["no" => "14", "pertanyaan" => "Sehubungan dengan masalah pangan di atas, apa dukungan yang perlu dilakukan untuk mengatasinya?", "jawaban" => ["Bantuan pangan langsung", "Pemulihan sumber pangan", "Pemulihan sumber daya kemasyarakatan (lumbung & gotong royong)", "Lainnya"]],
                            ["no" => "15", "pertanyaan" => "Setelah bencana ini, masalah air bersih apa yang dihadapi keluarga Anda?", "jawaban" => ["Jumlah airnya kurang", "Airnya kurang bersih", "Sarana penyimpan", "Lainnya…."]],
                            ["no" => "16", "pertanyaan" => "Sehubungan dengan masalah air bersih di atas, apa dukungan yang perlu dilakukan untuk mengatasinya?", "jawaban" => ["Bantuan penyediaan air bersih", "Bantuan pemulihan sumber air bersih", "Bantuan sarana penyimpan", "Lainnya..................."]],
                            ["no" => "17", "pertanyaan" => "Saat ini, sebutkan tingkat pelayanan kesehatan untuk keluarga anda", "jawaban" => ["Memadai", "Tidak memadai"]],
                            ["no" => "18", "pertanyaan" => "Untuk memulihkan dan meningkatkan pelayanan kesehatan keluarga anda setelah bencana ini, hal-hal apa yang perlu diperbaiki?", "jawaban" => ["Keterbatasan Obat", "Keterbatasan Tenaga Medis", "Jauhnya Jarak", "Keterbatasan layanan psikososial", "Lainnya................"]],
                            ["no" => "19", "pertanyaan" => "Saat ini, apakah kegiatan bersekolah anak anda mengalami gangguan ?", "jawaban" => ["Ya", "Tidak"]],
                            ["no" => "20", "pertanyaan" => "Dukungan apa yang paling diperlukan untuk memulihkan pendidikan anak anda setelah bencana?", "jawaban" => ["Peningkatan kehadiran guru", "Perlengkapan anak untuk Sekolah", "Biaya sekolah", "Transportasi", "Sekolah yang lokasinya dekat", "Bangunan sekolah yang aman", "Lain-lain ............."]],
                            ["no" => "21", "pertanyaan" => "Saat ini, apakah kegiatan tradisional kemasyarakatan dan keagamaan terganggu?", "jawaban" => ["Ya", "Tidak"]],
                            ["no" => "22", "pertanyaan" => "Dukungan apa yang diperlukan untuk memulihkan dan meningkatkan kegiatan-kegiatan tradisional kemasyarakatan dan keagamaan?", "jawaban" => ["Bantuan stimulasi", "Pelatihan", "Perizinan dan administrasi", "Lain-lain .............."]],
                            ["no" => "23", "pertanyaan" => "Untuk mencegah Anda terkena dampak bencana lagi, apakah kegiatan atau dukungan yang diperlukan?", "jawaban" => ["Penyediaan informasi tentang bencana", "Pelatihan dan pendidikan", "Penyusunan rencana menghadapi bencana", "Penyediaan fasilitas", "Peringatan dini", "Penguatan komunitas", "Penguatan budaya", "Lain-lain"]],
                            ["no" => "24", "pertanyaan" => "Setelah bencana kali ini, kelompok mana yang paling membutuhkan bantuan?", "jawaban" => ["Anak-anak", "Lansia", "Difabel (cacat)", "Ibu hamil", "Lain-lain..."]],
                            ["no" => "25", "pertanyaan" => "Penghasilan keluarga setiap bulan (sebelum bencana):", "jawaban" => [
                                "< Rp 500.000",
                                "Rp 500.000 – Rp 1.500.000",
                                "Rp 1.500.000 – Rp 2.500.000",
                                "> Rp 2.500.000"
                            ]],
                        
                            ];
                    @endphp

                    @foreach ($rows as $row)
                        @foreach ($row['jawaban'] as $index => $jawaban)
                            <tr>
                                @if ($index === 0)
                                    <td rowspan="{{ count($row['jawaban']) }}">{{ $row['no'] }}</td>
                                    <td rowspan="{{ count($row['jawaban']) }}">{!! nl2br(e($row['pertanyaan'])) !!}</td>
                                @endif
                                <td class="text-start">{!! $jawaban !!}</td>
                                {{-- Input fields for Kuesioner 1-6 --}}
                                <td style="padding: 5px;"><input type="text" id="jawaban_{{ $row['no'] }}_{{ $index }}_1" name="jawaban[{{ $row['no'] }}][{{ $index }}][1]" class="form-control form-control-sm"></td>
                                <td style="padding: 5px;"><input type="text" id="jawaban_{{ $row['no'] }}_{{ $index }}_2" name="jawaban[{{ $row['no'] }}][{{ $index }}][2]" class="form-control form-control-sm"></td>
                                <td style="padding: 5px;"><input type="text" id="jawaban_{{ $row['no'] }}_{{ $index }}_3" name="jawaban[{{ $row['no'] }}][{{ $index }}][3]" class="form-control form-control-sm"></td>
                                <td style="padding: 5px;"><input type="text" id="jawaban_{{ $row['no'] }}_{{ $index }}_4" name="jawaban[{{ $row['no'] }}][{{ $index }}][4]" class="form-control form-control-sm"></td>
                                <td style="padding: 5px;"><input type="text" id="jawaban_{{ $row['no'] }}_{{ $index }}_5" name="jawaban[{{ $row['no'] }}][{{ $index }}][5]" class="form-control form-control-sm"></td>
                                <td style="padding: 5px;"><input type="text" id="jawaban_{{ $row['no'] }}_{{ $index }}_6" name="jawaban[{{ $row['no'] }}][{{ $index }}][6]" class="form-control form-control-sm"></td>
                                
                                {{-- Fields for Jumlah and Persentase --}}
                                <td style="padding: 5px;"><input type="text" id="jumlah_{{ $row['no'] }}_{{ $index }}" name="jumlah[{{ $row['no'] }}][{{ $index }}]" class="form-control form-control-sm"></td>
                                <td style="padding: 5px;"><input type="text" id="persentase_{{ $row['no'] }}_{{ $index }}" name="persentase[{{ $row['no'] }}][{{ $index }}]" class="form-control form-control-sm"></td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <h6 class="fw-bold">Petunjuk Pengisian:</h6>
            <ul>
                <li>* Isi nomor kuesioner yang sedang diolah datanya</li>
                <li>** Isi 1 bila kategori jawaban dipilih oleh responden (kategori jawaban dilingkari atau disilang)<br>
                    Isi 0 bila kategori jawaban tidak dipilih oleh responden (kategori jawaban tidak dilingkari atau disilang)</li>
                <li>* Isi jumlah dari tiap kategori jawaban responden.</li>
                <li>** Isi persentase dari jumlah tiap kategori jawaban responden terhadap jumlah total jawaban responden pada satu pertanyaan yang sama</li>
            </ul>
        </div>
        <!-- Tombol Aksi -->
        <div class="d-flex gap-2 justify-content-center mt-4 mb-3">
            <button type="submit" class="btn btn-success form-button">
                <i class="bi bi-save"></i> Simpan Data
            </button>
            <button type="reset" class="btn btn-warning form-button" onclick="resetForm()">
                <i class="bi bi-arrow-clockwise"></i> Reset
            </button>
            <button type="button" class="btn btn-info form-button" onclick="printForm()">
                <i class="bi bi-printer"></i> Cetak
            </button>
            <button type="button" class="btn btn-secondary form-button" onclick="previewForm()">
                <i class="bi bi-eye"></i> Preview
            </button>
        </div>
    </form>
</div>

<script>
function resetForm() {
    if (confirm('Apakah Anda yakin ingin mereset semua data form?')) {
        document.querySelector('form').reset();
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
    
    previewWindow.document.write(`
        <html>
        <head>
            <title>Preview Form 9 - Kuesioner</title>
            <style>
                body { font-family: 'Times New Roman', serif; padding: 20px; }
                .form-table { border-collapse: collapse; width: 100%; }
                .form-table td, .form-table th { border: 1px solid #000; padding: 8px; }
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
@endsection