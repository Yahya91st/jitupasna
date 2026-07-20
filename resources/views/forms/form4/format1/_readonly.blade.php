<style>
    .table th,
    .table td {
        padding: 0.25rem 0.3rem !important;
        vertical-align: middle;
    }

    .main-title {
        background: linear-gradient(135deg, #ff8a50, #ff6b35);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>

<div class="container mt-4">

    <h5 class="text-center fw-bold main-title">
        Formulir 04<br>
        Pengumpulan Data Sektor
    </h5>

    <p class="fw-bold">
        Format 1a : Pengumpulan Data Sektor Perumahan
    </p>

    @if ($bencana)
        <div class="alert alert-light-primary">

            <strong>Jenis Bencana :</strong>
            {{ $bencana->jenis_bencana }}

            <br>

            <strong>Tanggal :</strong>
            {{ \Carbon\Carbon::parse($bencana->tanggal)->format('d F Y') }}

            <br>

            <strong>Lokasi :</strong>

            @foreach ($bencana->villages as $village)
                {{ $village['name'] }}@if (!$loop->last)
                    ,
                @endif
            @endforeach

        </div>
    @endif

    <table class="table table-bordered">
        <tr>

            <td width="50%">
                <strong>Nama Kampung</strong>
                <br>
                {{ $formulir->nama_kampung }}
            </td>

            <td>
                <strong>Nama Distrik</strong>
                <br>
                {{ $formulir->nama_distrik }}
            </td>

        </tr>
    </table>

    <table class="table table-bordered text-center align-middle">

        <thead>

            <tr>

                <th rowspan="2">
                    Perkiraan Kerusakan
                </th>

                <th colspan="3">
                    Jumlah Rumah
                </th>

                <th colspan="2">
                    Harga Satuan
                </th>

            </tr>

            <tr>

                <th>Rumah Permanen</th>

                <th>Rumah Non Permanen</th>

                <th>Jumlah</th>

                <th>Permanen</th>

                <th>Non Permanen</th>

            </tr>

        </thead>

        <tbody>

            @php

                $tingkat_rusak = [
                    'hancur_total' => '1a) JUMLAH RUMAH HANCUR TOTAL',

                    'berat' => '1b) JUMLAH RUMAH RUSAK BERAT',

                    'sedang' => '1c) JUMLAH RUMAH RUSAK SEDANG',

                    'ringan' => '1d) JUMLAH RUMAH RUSAK RINGAN',
                ];

            @endphp
            @foreach ($tingkat_rusak as $tingkat => $label)
                @php

                    $permanen = $formulir->items->first(function ($item) use ($tingkat) {
                        return $item->kategori == 'rumah' && $item->sub_kategori == 'permanen' && $item->tingkat_kerusakan == $tingkat;
                    });

                    $nonPermanen = $formulir->items->first(function ($item) use ($tingkat) {
                        return $item->kategori == 'rumah' && $item->sub_kategori == 'non_permanen' && $item->tingkat_kerusakan == $tingkat;
                    });

                    $jumlah = ($permanen->jumlah ?? 0) + ($nonPermanen->jumlah ?? 0);

                @endphp

                <tr>

                    <td class="text-start">
                        {{ $label }}
                    </td>

                    <td>
                        {{ $permanen->jumlah ?? '-' }}
                    </td>

                    <td>
                        {{ $nonPermanen->jumlah ?? '-' }}
                    </td>

                    <td class="fw-bold">
                        {{ $jumlah }}
                    </td>

                    <td>
                        @if ($permanen)
                            Rp {{ number_format($permanen->harga_satuan, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if ($nonPermanen)
                            Rp {{ number_format($nonPermanen->harga_satuan, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>
    @php

        $kerusakanPrasarana = [
            [
                'judul' => '2.1 JALAN LINGKUNGAN',
                'kategori' => 'jalan',
                'satuan' => 'm²',
            ],
            [
                'judul' => '2.2 SALURAN AIR/GORONG-GORONG',
                'kategori' => 'saluran',
                'satuan' => 'm²',
            ],
            [
                'judul' => '2.3 BALAI PERTEMUAN RW/RT',
                'kategori' => 'balai',
                'satuan' => 'unit',
            ],
        ];

        $tingkatKerusakan = [
            'berat' => 'Rusak Berat',
            'sedang' => 'Rusak Sedang',
            'ringan' => 'Rusak Ringan',
        ];

    @endphp

    @foreach ($kerusakanPrasarana as $prasarana)
        <table class="table table-bordered mt-4">

            <thead>

                <tr class="table-light">

                    <th colspan="3">
                        {{ $prasarana['judul'] }}
                    </th>

                </tr>

                <tr>

                    <th width="30%">
                        Tingkat Kerusakan
                    </th>

                    <th width="30%">
                        Jumlah
                    </th>

                    <th>
                        Harga Satuan
                    </th>

                </tr>

            </thead>

            <tbody>

                @php
                    $harga = 0;
                @endphp

                @foreach ($tingkatKerusakan as $tingkat => $label)
                    @php

                        $data = $formulir->items->first(function ($item) use ($prasarana, $tingkat) {
                            return $item->kategori == $prasarana['kategori'] && $item->tingkat_kerusakan == $tingkat;
                        });

                        if ($data) {
                            $harga = $data->harga_satuan;
                        }

                    @endphp

                    <tr>

                        <td>
                            {{ $label }}
                        </td>

                        <td>

                            {{ $data->jumlah ?? '-' }}

                            @if ($data)
                                {{ $data->satuan }}
                            @endif

                        </td>

                        <td>

                            @if ($data)
                                Rp {{ number_format($data->harga_satuan, 0, ',', '.') }}
                            @else
                                -
                            @endif

                        </td>

                    </tr>
                @endforeach

                <tr>

                    <td colspan="2" class="text-end fw-bold">

                        Harga Satuan {{ $prasarana['judul'] }}

                    </td>

                    <td>

                        Rp {{ number_format($harga, 0, ',', '.') }}

                    </td>

                </tr>

            </tbody>

        </table>
    @endforeach
    <hr class="my-4">

    <div class="card">

        <div class="card-header bg-primary text-white">

            <h6 class="mb-0">
                Rekapitulasi Total Kerusakan
            </h6>

        </div>

        <div class="card-body">

            <table class="table table-bordered mb-0">

                <tr>

                    <th width="40%">
                        Total Kerusakan
                    </th>

                    <td class="text-end">

                        Rp {{ number_format($totals['total_kerusakan'] ?? 0, 0, ',', '.') }}

                    </td>

                </tr>

                <tr>

                    <th>
                        Total Kerugian
                    </th>

                    <td class="text-end">

                        Rp {{ number_format($totals['total_kerugian'] ?? 0, 0, ',', '.') }}

                    </td>

                </tr>

                <tr class="table-warning">

                    <th>
                        Total Keseluruhan
                    </th>

                    <th class="text-end">

                        Rp {{ number_format($totals['total_keseluruhan'] ?? 0, 0, ',', '.') }}

                    </th>

                </tr>

            </table>

        </div>

    </div>

    @if (!isset($isPdf))
        <div class="d-flex justify-content-between mt-4">

            <a href="{{ route('forms.form4.format1.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">

                Kembali

            </a>

            <a href="{{ route('forms.form4.format1.preview', $formulir->id) }}" class="btn btn-danger">

                Preview PDF

            </a>

            <a href="{{ route('forms.form4.format1.pdf', $formulir->id) }}" class="btn btn-danger">

                Generate PDF

            </a>

        </div>
    @endif

</div>
