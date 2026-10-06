@extends('layouts.main')

@section('content')
    <style>
        .table th,
        .table td {
            padding: 0.25rem 0.3rem !important;
            vertical-align: middle !important;
            text-align: center;
        }

        .table input.form-control {
            padding: 0.15rem 0.3rem !important;
            font-size: 0.95rem;
        }
    </style>
    <div class="container mt-4">
        <h5 class="text-center fw-bold" style="color: #F28705;">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
        <p class="fw-bold">Format 5: Pengumpulan Data Sektor Keagamaan</p>
        <form action="{{ isset($edit) && $edit ? route('forms.form4.format5.update', $formulir->id) : route('forms.form4.format5.store') }}" method="POST">
            @csrf
            @if (isset($edit) && $edit)
                @method('PATCH')
            @endif
            <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">

            <table class="table table-bordered mb-2">
                <tr>
                    <td style="width: 50%">
                        NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $formulir->nama_kampung ?? '') }}">
                    </td>
                    <td>
                        NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $formulir->nama_distrik ?? '') }}">
                    </td>
                </tr>
            </table>

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle small">
                    <thead>
                        <tr>
                            <th rowspan="2">Jenis Bangunan</th>
                            <th colspan="6">Jumlah Unit Rusak</th>
                            <th rowspan="2">Rata-rata Luas Bangunan</th>
                            <th colspan="4">Harga Satuan</th>
                        </tr>
                        <tr>
                            <th>Berat Negeri</th>
                            <th>Berat Swasta</th>
                            <th>Sedang Negeri</th>
                            <th>Sedang Swasta</th>
                            <th>Ringan Negeri</th>
                            <th>Ringan Swasta</th>
                            <th>Bangunan/m²</th>
                            <th>Peralatan Keagamaan</th>
                        </tr>
                    </thead>
                    @php
                        $items = isset($formulir) ? $formulir->items : collect();

                        $getItem = function ($kategori, $subKategori = null, $tingkatKerusakan = null) use ($items) {
                            return $items->first(function ($item) use ($kategori, $subKategori, $tingkatKerusakan) {
                                return $item->kategori === $kategori && $item->sub_kategori === $subKategori && $item->tingkat_kerusakan === $tingkatKerusakan;
                            });
                        };

                        $getCategoryItem = function ($kategori) use ($items) {
                            return $items->first(function ($item) use ($kategori) {
                                return $item->kategori === $kategori;
                            });
                        };

                        $bangunan = [
                            'gereja' => 'Gereja',
                            'kapel' => 'Kapel',
                            'masjid' => 'Masjid',
                            'musholla' => 'Musholla',
                            'pura' => 'Pura',
                            'vihara' => 'Vihara',
                        ];

                        $index = 0;
                    @endphp

                    <tbody>
                        @foreach ($bangunan as $kategori => $label)
                            <tr>
                                <td>{{ $label }}</td>

                                @foreach ([['berat', 'negeri'], ['berat', 'swasta'], ['sedang', 'negeri'], ['sedang', 'swasta'], ['ringan', 'negeri'], ['ringan', 'swasta']] as [$kerusakan, $status])
                                    <td>
                                        @php
                                            $item = $getItem($kategori, $status, $kerusakan);
                                        @endphp
                                        <input type="number" class="form-control auto-row" name="details[{{ $index }}][jumlah]" value="{{ old('details.' . $index . '.jumlah', $item->jumlah ?? '') }}">

                                        <input type="hidden" name="details[{{ $index }}][kategori]" value="{{ $kategori }}">

                                        <input type="hidden" name="details[{{ $index }}][sub_kategori]" value="{{ $status }}">

                                        <input type="hidden" name="details[{{ $index }}][tingkat_kerusakan]" value="{{ $kerusakan }}">

                                        <input type="hidden" name="details[{{ $index }}][kriteria_id]" value="1">

                                        <input type="hidden" name="details[{{ $index }}][satuan]" value="unit">
                                    </td>

                                    @php $index++; @endphp
                                @endforeach

                                <td>
                                    @php
                                        $dimensiItem = $getCategoryItem($kategori);
                                    @endphp
                                    <input type="number" class="form-control" name="dimensi[{{ $kategori }}]" value="{{ old('dimensi.' . $kategori, $dimensiItem->dimensi ?? '') }}" placeholder="m²">
                                </td>

                                <td>
                                    @php
                                        $hargaBangunan = $items->first(function ($item) use ($kategori) {
                                            return $item->kategori === $kategori && $item->sub_kategori === 'bangunan';
                                        });
                                    @endphp
                                    <input type="number" class="form-control" name="harga_bangunan[{{ $kategori }}]" value="{{ old('harga_bangunan.' . $kategori, $hargaBangunan->harga_satuan ?? '') }}">
                                </td>

                                <td>
                                    @php
                                        $hargaPeralatan = $items->first(function ($item) use ($kategori) {
                                            return $item->kategori === $kategori && $item->sub_kategori === 'peralatan';
                                        });
                                    @endphp
                                    <input type="number" class="form-control" name="harga_peralatan[{{ $kategori }}]" value="{{ old('harga_peralatan.' . $kategori, $hargaPeralatan->harga_satuan ?? '') }}">
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <h6 class="fw-bold mt-3 mb-2">Perkiraan Kerugian</h6>
            @php
                $kerugian = [
                    [
                        'judul' => '1. BIAYA PEMBERSIHAN PUING',
                        'fields' => [
                            [
                                'label' => 'A. Biaya Tenaga Kerja',
                                'name1' => 'tenaga_kerja_jumlah',
                                'addon1' => 'HOK',

                                'label2' => 'Upah Harian',
                                'name2' => 'tenaga_kerja_harga',
                                'addon2' => 'Rp',
                            ],

                            [
                                'label' => 'B. Biaya Alat Berat',
                                'name1' => 'alat_berat_jumlah',
                                'addon1' => 'Hari',

                                'label2' => 'Tarif per Hari',
                                'name2' => 'alat_berat_harga',
                                'addon2' => 'Rp',
                            ],
                        ],
                    ],
                ];
            @endphp

            @foreach ($kerugian as $section)
                <table class="table table-bordered mt-3">

                    <thead>
                        <tr class="bg-secondary text-white">
                            <th colspan="4">{{ $section['judul'] }}</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($section['fields'] as $field)
                            <tr>

                                @php
                                    $kategoriKerugian = str_contains($field['name1'], 'tenaga') ? 'tenaga_kerja' : 'alat_berat';
                                    $itemKerugian = $getCategoryItem($kategoriKerugian);
                                @endphp

                                <td width="15%">
                                    {{ $field['label'] }}
                                </td>

                                <td width="35%">
                                    <div class="input-group">

                                        <input type="number" class="form-control" name="{{ $field['name1'] }}" value="{{ old($field['name1'], $itemKerugian->jumlah ?? '') }}">

                                        @if (isset($field['addon1']))
                                            <span class="input-group-text">
                                                {{ $field['addon1'] }}
                                            </span>
                                        @endif

                                    </div>
                                </td>

                                <td width="15%">
                                    {{ $field['label2'] }}
                                </td>

                                <td width="35%">
                                    <div class="input-group">

                                        <span class="input-group-text">
                                            {{ $field['addon2'] }}
                                        </span>

                                        <input type="number" class="form-control" name="{{ $field['name2'] }}" value="{{ old($field['name2'], $itemKerugian->harga_satuan ?? '') }}">

                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>
            @endforeach

            <div class="row mb-4">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">{{ isset($edit) && $edit ? 'Update Data' : 'Simpan Data' }}</button>
                </div>
                <div>
                    <button type="button" class="btn btn-warning" id="fillDummy">
                        Isi Data Dummy
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('fillDummy').addEventListener('click', function() {

            // Semua input number yang kosong
            document.querySelectorAll('input[type="number"]').forEach(function(input) {

                if (input.value === '') {
                    input.value = 1;
                }

            });

        });
    </script>
@endsection
