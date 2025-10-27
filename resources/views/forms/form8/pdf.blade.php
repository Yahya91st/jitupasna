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

        @php
            // pad rows agar selalu 15 baris (opsional)
            $rowsPadded = array_pad($rows, 15, []);
        @endphp

        @foreach ($rowsPadded as $i => $r)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $r['sektor'] ?? '' }}</td>
                <td>{{ $r['komponen'] ?? '' }}</td>
                <td>{{ $r['lokasi'] ?? '' }}</td>
                <td>{{ $r['rb_kerusakan'] ?? '' }}</td>
                <td>{{ $r['rs_kerusakan'] ?? '' }}</td>
                <td>{{ $r['rr_kerusakan'] ?? '' }}</td>
                <td>{{ isset($r['rb_harga']) ? number_format($r['rb_harga'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($r['rs_harga']) ? number_format($r['rs_harga'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($r['rr_harga']) ? number_format($r['rr_harga'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($r['rb_nilai']) ? number_format($r['rb_nilai'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($r['rs_nilai']) ? number_format($r['rs_nilai'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($r['rr_nilai']) ? number_format($r['rr_nilai'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($r['kerugian']) ? number_format($r['kerugian'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($r['total']) ? number_format($r['total'], 0, ',', '.') : '' }}</td>
                <td>{{ isset($r['kebutuhan']) ? number_format($r['kebutuhan'], 0, ',', '.') : '' }}</td>
            </tr>
        @endforeach
        <tr class="total-row">
            <td colspan="16">Jumlah Total</td>
        </tr>
    </table>
</body>

</html>
