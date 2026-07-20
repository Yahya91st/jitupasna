<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <style>

        body{
            font-family: DejaVu Sans;
            font-size:12px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-bottom:20px;
        }

        table,th,td{
            border:1px solid #000;
        }

        th,td{
            padding:6px;
        }

        h2,h3{
            text-align:center;
        }

    </style>

</head>

<body>

<h2>DOKUMEN KAJIAN PASCA BENCANA</h2>

<h3>JITUPASNA</h3>

<br>

<table>

<tr>
    <th width="30%">Jenis Bencana</th>
    <td>{{ $laporan->bencana->jenis_bencana }}</td>
</tr>

<tr>
    <th>Tanggal</th>
    <td>{{ $laporan->bencana->tanggal }}</td>
</tr>

</table>

<h4>Ringkasan Pendataan</h4>

<table>

<thead>

<tr>

<th>Kampung</th>
<th>Distrik</th>
<th>Format</th>
<th>Kerusakan</th>
<th>Kerugian</th>

</tr>

</thead>

<tbody>

@php

$totalKerusakan=0;
$totalKerugian=0;

@endphp

@foreach($summaries as $row)

@php

$totalKerusakan += $row['total_kerusakan'];
$totalKerugian += $row['total_kerugian'];

@endphp

<tr>

<td>{{ $row['nama_kampung'] }}</td>

<td>{{ $row['nama_distrik'] }}</td>

<td>{{ $row['format'] }}</td>

<td>Rp {{ number_format($row['total_kerusakan'],0,',','.') }}</td>

<td>Rp {{ number_format($row['total_kerugian'],0,',','.') }}</td>

</tr>

@endforeach

<tr>

<th colspan="3">TOTAL</th>

<th>Rp {{ number_format($totalKerusakan,0,',','.') }}</th>

<th>Rp {{ number_format($totalKerugian,0,',','.') }}</th>

</tr>

</tbody>

</table>

<h4>Hasil Kajian</h4>

<table>

<tr>

<th width="30%">
Gangguan Akses
</th>

<td>

{!! nl2br(e($kajian->kehilangan_akses)) !!}

</td>

</tr>

<tr>

<th>
Gangguan Fungsi
</th>

<td>

{!! nl2br(e($kajian->gangguan_fungsi)) !!}

</td>

</tr>

<tr>

<th>
Peningkatan Risiko
</th>

<td>

{!! nl2br(e($kajian->peningkatan_resiko)) !!}

</td>

</tr>

</table>

<br><br>

<table style="border:none">

<tr style="border:none">

<td style="border:none;text-align:right">

Pengkaji,

<br><br><br><br>

_____________________

</td>

</tr>

</table>

</body>

</html>