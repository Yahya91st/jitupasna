@extends('layouts.main')

@section('content')
<style>        
    .form-table {

        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 13px;
    }
      .form-table th, .form-table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
        vertical-align: top;
    }
      .form-table th {
        font-weight: bold;
        text-align: center;
    }
    .table-header {
        background-color: var(--bs-secondary) !important;
        color: white !important;
        text-align: center;
        font-weight: bold;
    }
    .form-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
        background: white;
    }
      .form-header {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 2px solid #000;
    }
      .form-title {
        font-size: 20px;
        font-weight: bold;
        margin: 5px 0;
        text-transform: uppercase;
    }
    
    .form-subtitle {
        font-size: 16px;
        font-weight: bold;
        margin-top: 5px;

    }
    #addRowBtn:hover {
        background-color: #45a049;
    }
      .data-row td {
        height: 28px;
    }
      [contenteditable="true"]:focus {
        outline: 2px solid #4CAF50;
        background-color: #f8f8f8;
    }
    
    [contenteditable="true"]:hover:not(:focus) {
        background-color: #f0f0f0;
    }
    
    .editing {
        background-color: #e8f5e9 !important;
    }
      @media print {
        .form-table {
            page-break-inside: auto;
            border: 2.5px solid #000 !important;
        }
        
        .form-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        
        .form-table td, 
        .form-table th {
            border: 1.5px solid #000 !important;
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }
        
        .form-table thead th {
            background-color: #b3b3b3 !important;
            border-bottom: 2.5px solid #000 !important;
        }
          .total-row td {
            border-top: 2.5px solid #000 !important;
            border-bottom: 2.5px solid #000 !important;
        }
        
        #addRowBtn, .no-print {
            display: none !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Convert input fields to textareas for better data entry
        const cells = document.querySelectorAll('td input[type="text"]');
        cells.forEach(input => {
            // Create a textarea
            const textarea = document.createElement('textarea');
            textarea.name = input.name;
            textarea.className = input.className;
            textarea.style.width = '100%';
            textarea.style.border = 'none';
            textarea.style.padding = '4px';
            textarea.style.minHeight = '20px';
            textarea.style.height = 'auto';
            textarea.style.overflow = 'hidden';
            
            // Replace input with textarea
            input.parentNode.replaceChild(textarea, input);
            
            // Auto resize functionality
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
    });
</script>
<div class="container" style="font-family: Times New Roman, serif;">    
    <div class="text-center mb-4">
        <h5><strong>Formulir 10</strong></h5>
        <h5>Analisa Data Akibat terhadap Akses, Fungsi dan Resiko, serta Analisa Kebutuhan</h5>
    </div>

    <form method="POST" action="{{ route('forms.form10.store') }}">
    @csrf
    <input type="hidden" name="form_type" value="form10">
    <input type="hidden" name="bencana_id" value="{{ request('bencana_id') }}">

    <table class="form-table">
        <thead>
            <tr>
                <th class="table-header" rowspan="2">No</th>
                <th class="table-header" rowspan="2">Sektor-sub.sektor</th>
                <th class="table-header" rowspan="2">Lokasi bencana terjadi</th>
                <th class="table-header" colspan="3">Akibat terhadap akses, fungsi dan resiko</th>
                <th class="table-header" rowspan="2">Kebutuhan-kegiatan pemulihan</th>
            </tr>
            <tr>
                <th class="table-header">Point penting hasil pengolahan data survey</th>
                <th class="table-header">Point penting hasil wawancara/FGD</th>
                <th class="table-header">Point penting hasil pendalaman</th>
            </tr>
        </thead>    
            <tbody>
            <tr>
                <td class="bold">1</td>
                <td class="bold">Perumahan</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="text" name="perumahan_1_form10" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_1_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_1_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_1_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_1_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_1_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="text" name="perumahan_2_form10" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_2_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_2_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_2_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_2_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_2_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="text" name="perumahan_3_form10" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_3_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_3_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_3_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_3_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_3_pemulihan" style="width: 100%; border: none;"></td>
            </tr>        
            <tr>
                <td></td>
                <td><input type="text" name="perumahan_4_form10" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_4_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_4_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_4_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_4_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_4_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="text" name="perumahan_5_form10" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_5_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_5_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_5_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_5_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_5_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td class="bold">2</td>
                <td class="bold">Infrastruktur</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Transportasi</td>
                <td><input type="text" name="transportasi_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="transportasi_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="transportasi_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="transportasi_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="transportasi_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td>Energi</td>
                <td><input type="text" name="energi_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="energi_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="energi_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="energi_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="energi_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td>dll</td>
                <td><input type="text" name="infrastruktur_lain_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="infrastruktur_lain_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="infrastruktur_lain_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="infrastruktur_lain_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="infrastruktur_lain_pemulihan" style="width: 100%; border: none;"></td>
            </tr>        <tr>
                <td class="bold">3</td>
                <td class="bold">Ekonomi Produktif</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Pertanian</td>
                <td><input type="text" name="pertanian_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="pertanian_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="pertanian_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="pertanian_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="pertanian_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td>Peternakan</td>
                <td><input type="text" name="peternakan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="peternakan_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="peternakan_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="peternakan_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="peternakan_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td>Perikanan</td>
                <td><input type="text" name="perikanan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perikanan_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perikanan_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perikanan_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perikanan_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td>dll</td>
                <td><input type="text" name="ekonomi_lain_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_lain_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_lain_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_lain_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_lain_pemulihan" style="width: 100%; border: none;"></td>
            </tr>        <tr>
                <td class="bold">4</td>
                <td class="bold">Sosial</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Pendidikan</td>
                <td><input type="text" name="pendidikan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="pendidikan_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="pendidikan_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="pendidikan_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="pendidikan_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td>Kesehatan</td>
                <td><input type="text" name="kesehatan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="kesehatan_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="kesehatan_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="kesehatan_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="kesehatan_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td>Agama</td>
                <td><input type="text" name="agama_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="agama_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="agama_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="agama_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="agama_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td>Budaya</td>
                <td><input type="text" name="budaya_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="budaya_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="budaya_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="budaya_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="budaya_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td>dll</td>
                <td><input type="text" name="sosial_lain_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="sosial_lain_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="sosial_lain_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="sosial_lain_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="sosial_lain_pemulihan" style="width: 100%; border: none;"></td>
            </tr>        <tr>
                <td class="bold">5</td>
                <td class="bold">Lintas sektor</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Pemerintahan</td>
                <td><input type="text" name="pemerintahan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="pemerintahan_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="pemerintahan_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="pemerintahan_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="pemerintahan_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td>Lingkungan hidup</td>
                <td><input type="text" name="lingkungan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lingkungan_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lingkungan_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lingkungan_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lingkungan_pemulihan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td></td>
                <td>dll</td>
                <td><input type="text" name="lintas_lain_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_lain_survey" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_lain_wawancara" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_lain_pendalaman" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_lain_pemulihan" style="width: 100%; border: none;"></td>
            </tr><tr>
                <td colspan="2" class="bold" style="text-align: center;">Jumlah Kebutuhan</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="text" name="jumlah_kebutuhan_form10" style="width: 100%; border: none;"></td>
            </tr>
        </tbody>
    </table>

    <div style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </div>
</form>
</div>
@endsection
