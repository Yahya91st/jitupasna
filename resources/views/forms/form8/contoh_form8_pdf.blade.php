<!-- filepath: c:\laragon\www\jitupasna\jitupasnab\resources\views\forms\form8\contoh_form8_pdf.blade.php -->
<!DOCTYPE html>
<html lang="id">
<style>
    @page {
        size: A4 landscape;
        margin: 5mm;
    }

    body {
        font-family: 'Times New Roman', serif;
        font-size: 11pt;
        color: #000;
        margin: 10px;
    }

    /* ...existing CSS... */
</style>

<head>
    <meta charset="UTF-8">
    <title>Formulir 08 - Pengolahan dan Analisis Data Penilaian Kerusakan dan Kerugian</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 11pt;
            color: #000;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px 4px;
            text-align: center;
            font-size: 10pt;
        }

        th {
            background: #d3d3d3;
            font-weight: bold;
        }

        .sub-header {
            background: #e9ecef;
            font-weight: bold;
            font-size: 10pt;
        }

        .total-row td {
            font-weight: bold;
            text-align: left;
            background: #f3f3f3;
        }
    </style>
</head>

<body>
    <div class="header">
        <h3>Formulir 08</h3>
        <div>Formulir Pengolahan dan Analisis Data Penilaian Kerusakan dan Kerugian</div>
    </div>
    <table>
        <tr>
            <th rowspan="2" style="width: 3%;">No</th>
            <th rowspan="2" style="width: 10%;">Sektor/Sub Sektor</th>
            <th rowspan="2" style="width: 13%;">Komponen Kerusakan dan Kerugian</th>
            <th rowspan="2" style="width: 8%;">Lokasi</th>
            <th colspan="3" class="sub-header" style="width: 12%;">Data Kerusakan</th>
            <th colspan="3" class="sub-header" style="width: 12%;">Harga Satuan (Rp.)</th>
            <th colspan="3" class="sub-header" style="width: 12%;">Nilai Kerusakan (Damage)</th>
            <th rowspan="2" style="width: 8%;">Perkiraan Kerugian (Losses)</th>
            <th rowspan="2" style="width: 8%;">Kerusakan + Kerugian</th>
            <th rowspan="2" style="width: 8%;">Kebutuhan</th>
        </tr>
        <tr>
            <th style="width: 4%;">RB</th>
            <th style="width: 4%;">RS</th>
            <th style="width: 4%;">RR</th>
            <th style="width: 4%;">RB</th>
            <th style="width: 4%;">RS</th>
            <th style="width: 4%;">RR</th>
            <th style="width: 4%;">RB</th>
            <th style="width: 4%;">RS</th>
            <th style="width: 4%;">RR</th>
        </tr>
        @for ($i = 0; $i < 15; $i++)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $form[$i]['sektor'] ?? '' }}</td>
                <td>{{ $form[$i]['komponen'] ?? '' }}</td>
                <td>{{ $form[$i]['lokasi'] ?? '' }}</td>
                <td>{{ $form[$i]['rb_kerusakan'] ?? '' }}</td>
                <td>{{ $form[$i]['rs_kerusakan'] ?? '' }}</td>
                <td>{{ $form[$i]['rr_kerusakan'] ?? '' }}</td>
                <td>{{ isset($form[$i]['rb_harga']) ? number_format($form[$i]['rb_harga'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($form[$i]['rs_harga']) ? number_format($form[$i]['rs_harga'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($form[$i]['rr_harga']) ? number_format($form[$i]['rr_harga'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($form[$i]['rb_nilai']) ? number_format($form[$i]['rb_nilai'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($form[$i]['rs_nilai']) ? number_format($form[$i]['rs_nilai'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($form[$i]['rr_nilai']) ? number_format($form[$i]['rr_nilai'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($form[$i]['kerugian']) ? number_format($form[$i]['kerugian'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($form[$i]['total']) ? number_format($form[$i]['total'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($form[$i]['kebutuhan']) ? number_format($form[$i]['kebutuhan'], 0, ',', '.') : '' }}</td>
            </tr>
        @endfor
        <tr class="total-row">
            <td colspan="16">Jumlah Total</td>
        </tr>
    </table>
</body>

</html>
