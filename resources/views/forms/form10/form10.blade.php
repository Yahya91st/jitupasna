@extends('layouts.main')

@section('content')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }
    th, td {
        border: 1px solid black;
        padding: 4px;
        vertical-align: top;
    }
    .bold {
        font-weight: bold;
    }
    input[type="text"] {
        width: 100%;
        padding: 4px;
        border: none;
        background-color: transparent;
    }
    input[type="text"]:focus {
        outline: 1px solid #4a90e2;
        background-color: #f8f8f8;
    }
    .btn-primary {
        background-color: #4a90e2;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }    .btn-primary:hover {
        background-color: #3570b2;
    }
    textarea {
        resize: vertical;
        min-height: 60px;
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

<h3 style="text-align: center; margin-bottom: 5px;">Formulir 10</h3>
<p style="text-align: center; margin-top: 0;">
    Analisa Data Akibat terhadap Akses, Fungsi dan Resiko, serta Analisa Kebutuhan
</p>

<form method="POST" action="{{ route('forms.form10.store') }}">
@csrf
<input type="hidden" name="form_type" value="form10">
<input type="hidden" name="bencana_id" value="{{ request('bencana_id') }}">

<table>
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Sektor-sub.sektor</th>
            <th rowspan="2">Lokasi bencana terjadi</th>
            <th colspan="3">Akibat terhadap akses, fungsi dan resiko</th>
            <th rowspan="2">Kebutuhan-kegiatan pemulihan</th>
        </tr>
        <tr>
            <th>Point penting hasil pengolahan data survey</th>
            <th>Point penting hasil wawancara/FGD</th>
            <th>Point penting hasil pendalaman</th>
        </tr>
    </thead>    <tbody>
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
@endsection
