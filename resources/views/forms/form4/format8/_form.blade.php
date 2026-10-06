@php
    $data = $formulir ?? null;
@endphp

<?php
/*
    |--------------------------------------------------------------------------
    | DATA FORMULIR
    |--------------------------------------------------------------------------
    */

$items = isset($formulir) ? $formulir->items : collect();

/*
    |--------------------------------------------------------------------------
    | HELPER MENGAMBIL ITEM
    |--------------------------------------------------------------------------
    */

$getItem = function ($kategori, $subKategori = null, $tingkatKerusakan = null) use ($items) {
    return $items->first(function ($item) use ($kategori, $subKategori, $tingkatKerusakan) {
        return $item->kategori === $kategori && $item->sub_kategori === $subKategori && $item->tingkat_kerusakan === $tingkatKerusakan;
    });
};

/*
    |--------------------------------------------------------------------------
    | HELPER MENGAMBIL ITEM BERDASARKAN KATEGORI SAJA
    |--------------------------------------------------------------------------
    */

$getCategoryItem = function ($kategori) use ($items) {
    return $items->first(function ($item) use ($kategori) {
        return $item->kategori === $kategori;
    });
};

/*
    |--------------------------------------------------------------------------
    | HELPER MENGAMBIL NILAI
    |--------------------------------------------------------------------------
    */

$getValue = function ($kategori, $subKategori = null, $tingkatKerusakan = null, $field = 'jumlah') use ($getItem) {
    $item = $getItem($kategori, $subKategori, $tingkatKerusakan);

    return $item?->{$field} ?? '';
};

/*
    |--------------------------------------------------------------------------
    | HELPER FORMAT RUPIAH
    |--------------------------------------------------------------------------
    */

$rupiah = function ($value) {
    return number_format((float) ($value ?? 0), 0, ',', '.');
};
?>

<style>
    /* Kurangi padding pada tabel dan input agar lebih kompak */
    .table th,
    .table td {
        padding: 0.25rem 0.3rem !important;
    }

    .table input.form-control {
        padding: 0.15rem 0.3rem !important;
        font-size: 0.95rem;
    }
</style>
<div class="container mt-4">
    <h5 class="text-center fw-bold" style="color: #F28705;">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 8: Sektor Listrik</p>

    <form action="{{ isset($edit) && $edit ? route('forms.form4.format8.update', $data->id) : route('forms.form4.format8.store') }}" method="POST">
        @csrf
        @if (isset($edit) && $edit)
            @method('PUT')
        @endif
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->bencana_id }}">

        <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? ($bencana->nama_kampung ?? '')) }}"></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? ($bencana->nama_distrik ?? '')) }}"></td>
            </tr>
        </table>
        @php
            $transmisi = [
                'kabel' => [
                    'label' => 'KABEL',
                    'satuan' => 'm',
                ],
                'tiang' => [
                    'label' => 'TIANG',
                    'satuan' => 'unit',
                ],
                'trafo' => [
                    'label' => 'GARDU / TRAFO',
                    'satuan' => 'unit',
                ],
            ];

            $pembangkit = [
                'plta' => 'PLTA',
                'pltu' => 'PLTU',
                'pltd' => 'PLTD',
                'pembangkit_lain' => 'PEMBANGKIT LAIN-LAIN',
            ];
        @endphp

        @php
            $pemulihanItem = $getItem('jangka_waktu_pemulihan', 'genset');
            $listrikItem = $getItem('pemintaan_listrik', 'listrik');
            $operasionalSebelumItem = $getItem('biaya_operasional_sebelum', 'jumlah');
            $operasionalPascaItem = $getItem('biaya_operasional_pasca', 'jumlah2');
        @endphp

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle small">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="5">PERKIRAAN KERUSAKAN</th>
                    </tr>
                    <tr>
                        <th style="width:25%">Uraian</th>
                        <th style="width:25%">Komponen</th>
                        <th>Satuan</th>
                        <th>Unit</th>
                        <th>Harga Satuan (Rp)</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="table-light fw-bold">
                        <td colspan="5">SISTEM TRANSMISI DAN DISTRIBUSI</td>
                    </tr>

                    @php $detailIndex = 1; @endphp

                    @foreach ($transmisi as $kategori => $item)
                        @php
                            $transmisiItem = $getItem($kategori, 'unit');
                        @endphp
                        <tr>

                            <td></td>

                            <td>{{ $item['label'] }}</td>

                            <td>{{ ucfirst($item['satuan']) }}</td>

                            {{-- Unit --}}
                            <td>
                                <input type="number" class="form-control" name="details[{{ $detailIndex }}][jumlah]" value="{{ old('details.' . $detailIndex . '.jumlah', $transmisiItem->jumlah ?? '') }}">

                                <input type="hidden" name="details[{{ $detailIndex }}][kategori]" value="{{ $kategori }}">

                                <input type="hidden" name="details[{{ $detailIndex }}][sub_kategori]" value="unit">

                                <input type="hidden" name="details[{{ $detailIndex }}][kriteria_id]" value="1">

                                <input type="hidden" name="details[{{ $detailIndex }}][satuan]" value="{{ $item['satuan'] }}">
                            </td>

                            {{-- Harga Satuan --}}
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>

                                    <input type="number" class="form-control" name="details[{{ $detailIndex }}][harga_satuan]" value="{{ old('details.' . $detailIndex . '.harga_satuan', $transmisiItem->harga_satuan ?? '') }}">
                                </div>

                            </td>

                            @php $detailIndex++; @endphp

                        </tr>
                    @endforeach

                    <tr class="table-light fw-bold">
                        <td colspan="5">SISTEM PEMBANGKITAN</td>
                    </tr>

                    @foreach ($pembangkit as $kategori => $label)
                        @php
                            $pembangkitItem = $getItem($kategori, 'unit');
                        @endphp
                        <tr>

                            <td></td>

                            <td>{{ $label }}</td>

                            <td>Unit</td>

                            {{-- Unit --}}
                            <td>
                                <input type="number" class="form-control" name="details[{{ $detailIndex }}][jumlah]" value="{{ old('details.' . $detailIndex . '.jumlah', $pembangkitItem->jumlah ?? '') }}">

                                <input type="hidden" name="details[{{ $detailIndex }}][kategori]" value="{{ $kategori }}">

                                <input type="hidden" name="details[{{ $detailIndex }}][sub_kategori]" value="unit">

                                <input type="hidden" name="details[{{ $detailIndex }}][kriteria_id]" value="1">

                                <input type="hidden" name="details[{{ $detailIndex }}][satuan]" value="unit">
                            </td>

                            {{-- Harga Satuan --}}
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>

                                    <input type="number" class="form-control" name="details[{{ $detailIndex }}][harga_satuan]" value="{{ old('details.' . $detailIndex . '.harga_satuan', $pembangkitItem->harga_satuan ?? '') }}">
                                </div>

                            </td>

                            @php $detailIndex++; @endphp

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="2">
                            PERKIRAAN KERUGIAN
                        </th>
                    </tr>
                    <tr>
                        <td>Perkiraan Jangka Waktu Pemulihan</td>

                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="global[durasi]" value="{{ old('global.durasi', $pemulihanItem->durasi ?? '') }}">
                                <input type="hidden" class="form-control" name="global[durasi_satuan]" value="bulan">

                                <span class="input-group-text">bulan</span>
                            </div>
                        </td>
                    </tr>
                </thead>

                <tbody>
                    <tr class="bg-secondary text-white">
                        <th colspan="2">
                            PEMULIHAN & DARURAT
                        </th>
                    </tr>

                    <tr>
                        <td>GENSET</td>

                        <td>
                            <div class="input-group">

                                <input type="number" class="form-control" name="pemulihan[jumlah]" value="{{ old('pemulihan.jumlah', $pemulihanItem->jumlah ?? '') }}">
                                <span class="input-group-text">
                                    unit
                                </span>
                            </div>

                            <input type="hidden" name="pemulihan[satuan]" value="unit">
                        </td>
                    </tr>
                    <tr>
                        <td>Biaya Pengadaan</td>

                        <td>
                            <div class="input-group">

                                <input type="number" class="form-control" name="pemulihan[harga_satuan]" value="{{ old('pemulihan.harga_satuan', $pemulihanItem->harga_satuan ?? '') }}">
                                <span class="input-group-text">
                                    Rp
                                </span>
                            </div>
                        </td>

                        <input type="hidden" name="pemulihan[kategori]" value="jangka_waktu_pemulihan">

                        <input type="hidden" name="pemulihan[sub_kategori]" value="genset">

                    </tr>

                    <tr class="bg-secondary text-white">
                        <th colspan="2">
                            PERKIRAAN KEHILANGAN / PENURUNAN PENDAPATAN
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <label class="fw-bold">
                                B. PERMINTAAN LISTRIK PER BULAN SEBELUM BENCANA
                            </label>
                        </td>
                        <td>

                            <div class="input-group">
                                <input type="number" class="form-control" name="listrik[jumlah]" value="{{ old('listrik.jumlah', $listrikItem->jumlah ?? '') }}">

                                <span class="input-group-text">
                                    KWH
                                </span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="fw-bold">
                                C. PERMINTAAN LISTRIK PER BULAN PASCA BENCANA
                            </label>
                        </td>
                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="listrik[jumlah2]" value="{{ old('listrik.jumlah2', $listrikItem->jumlah2 ?? '') }}">

                                <span class="input-group-text">
                                    KWH
                                </span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="fw-bold">
                                D. TARIF LISTRIK / KWH
                            </label>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="number" class="form-control" name="listrik[harga_satuan]" value="{{ old('listrik.harga_satuan', $listrikItem->harga_satuan ?? '') }}">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="fw-bold">
                                E. PENURUNAN PENDAPATAN = (B - C) × D × A
                            </label>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="number" class="form-control" readonly>
                            </div>
                        </td>
                        <input type="hidden" name="listrik[kategori]" value="pemintaan_listrik">

                        <input type="hidden" name="listrik[sub_kategori]" value="listrik">

                        <input type="hidden" name="listrik[satuan]" value="rp">
                    </tr>

                    @php
                        $operasional = [
                            [
                                'label' => 'B. Biaya Operasional Sebelum',
                                'kategori' => 'biaya_operasional_sebelum',
                                'field' => 'jumlah',
                            ],
                            [
                                'label' => 'C. Biaya Operasional Pasca',
                                'kategori' => 'biaya_operasional_pasca',
                                'field' => 'jumlah2',
                            ],
                        ];
                    @endphp

                    <tr class="bg-secondary text-white text-center">
                        <th colspan="2">
                            PERKIRAAN KENAIKAN BIAYA OPERASIONAL
                        </th>
                    </tr>

                    {{-- B & C --}}
                    @foreach ($operasional as $item)
                        <tr>
                            <td style="width:40%">
                                {{ $item['label'] }}
                            </td>

                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>

                                    <input type="number" class="form-control" name="operasional[{{ $item['field'] }}]" value="{{ old('operasional.' . $item['field'], $item['field'] === 'jumlah' ? $operasionalSebelumItem->jumlah ?? '' : $operasionalPascaItem->jumlah2 ?? '') }}">
                                </div>

                                <input type="hidden" name="operasional[kategori]" value="{{ $item['kategori'] }}">

                                <input type="hidden" name="operasional[sub_kategori]" value="{{ $item['field'] }}">

                                <input type="hidden" name="operasional[kriteria_id]" value="1">

                                <input type="hidden" name="operasional[satuan]" value="rp">
                            </td>
                        </tr>

                        @php $detailIndex++; @endphp
                    @endforeach

                    {{-- E (hasil perhitungan) --}}
                    <tr>
                        <td>
                            E. Kenaikan Biaya Operasional = (C - B) × A
                        </td>

                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="number" class="form-control" readonly>
                            </div>

                            {{-- kalau mau disimpan nanti --}}
                            <input type="hidden" name="operasional[kategori]" value="kenaikan_biaya_operasional">

                            <input type="hidden" name="operasional[sub_kategori]" value="total">

                            <input type="hidden" name="operasional[kriteria_id]" value="1">

                            <input type="hidden" name="operasional[satuan]" value="rp">
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">{{ isset($edit) && $edit ? 'Update Data' : 'Simpan Data' }}</button>
        </div>
        <div class="col-12 text-center">
            <button type="button" class="btn btn-warning" id="fillDummy">
                Isi Data Dummy
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('fillDummy').addEventListener('click', function() {

        // Semua input number yang kosong
        document.querySelectorAll(['input[type="number"]', 'input[type="text"]']).forEach(function(input) {

            if (input.value === '') {
                input.value = 1;
            }

        });

    });
</script>
