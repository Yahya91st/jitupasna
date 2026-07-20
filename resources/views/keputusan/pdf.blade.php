<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>
        Keputusan Pimpinan
    </title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th {
            width: 35%;
            background: #f2f2f2;
            text-align: left;
            padding: 10px;
        }

        td {
            padding: 10px;
        }

        .ttd {
            margin-top: 60px;
            width: 100%;
            text-align: right;
        }
    </style>

</head>

<body>

    <div class="header">

        <h2>
            KEPUTUSAN PIMPINAN
        </h2>

        <p>
            Sistem Informasi JITUPASNA
        </p>

    </div>

    <table>

        <tr>

            <th>
                Jenis Bencana
            </th>

            <td>
                {{ config('bencana')[$bencana->jenis_bencana] ?? $bencana->jenis_bencana }}
            </td>

        </tr>

        <tr>

            <th>
                Tanggal Kejadian
            </th>

            <td>
                {{ $bencana->tanggal->format('d-m-Y') }}
            </td>

        </tr>

        <tr>

            <th>
                Lokasi
            </th>

            <td>
                {{ $bencana->lokasi ?? '-' }}
            </td>

        </tr>

        <tr>

            <th>
                Tingkat Prioritas
            </th>

            <td>
                {{ ucfirst($keputusan->prioritas) }}
            </td>

        </tr>

        <tr>

            <th>
                Keputusan Pimpinan
            </th>

            <td>
                {{ $keputusan->keputusan }}
            </td>

        </tr>

    </table>

    <div class="ttd">

        <p>
            Pimpinan
        </p>

        <br><br><br>

        <p>
            ___________________
        </p>

    </div>

</body>

</html>
