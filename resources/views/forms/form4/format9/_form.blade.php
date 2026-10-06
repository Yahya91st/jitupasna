@php
    $data = $formulir ?? null;
@endphp

<?php
$items = isset($formulir) ? $formulir->items : collect();

$getItem = function ($kategori, $subKategori = null) use ($items) {
    return $items->first(function ($item) use ($kategori, $subKategori) {
        return $item->kategori === $kategori && ($subKategori === null || $item->sub_kategori === $subKategori);
    });
};

$pemulihanItem = $items->first(function ($item) {
    return $item->durasi !== null;
});
$penurunanPendapatanItem = $getItem('permintaan_telekomunikasi');
$operasionalItem = $getItem('operasional');
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
    <p class="fw-bold">Format 9: Sektor Telkom</p>
    <form action="{{ isset($edit) && $edit ? route('forms.form4.format9.update', $data->id) : route('forms.form4.format9.store') }}" method="POST">
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
            $komponenKerusakan = range(1, 4);
            $detailIndex = 0;
        @endphp

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="4">
                            PERKIRAAN KERUSAKAN
                        </th>
                    </tr>

                    <tr>
                        <th style="width:40%">
                            Komponen
                        </th>

                        <th>
                            Satuan
                        </th>

                        <th>
                            Jumlah
                        </th>

                        <th>
                            Harga Satuan
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($komponenKerusakan as $urut)
                        @php
                            $kerusakanItem = $getItem('kerusakan_sarana_prasarana', 'komponen_' . $urut);
                        @endphp
                        <tr>

                            <td>
                                <input type="text" class="form-control" name="details[{{ $detailIndex }}][komponen]" placeholder="Nama Komponen" value="{{ old('details.' . $detailIndex . '.komponen', '') }}">
                            </td>

                            <td>
                                <input type="text" class="form-control" name="details[{{ $detailIndex }}][satuan]" placeholder="Satuan" value="{{ old('details.' . $detailIndex . '.satuan', $kerusakanItem->satuan ?? 'unit') }}">
                            </td>

                            <td>
                                <input type="number" class="form-control" name="details[{{ $detailIndex }}][jumlah]" value="{{ old('details.' . $detailIndex . '.jumlah', $kerusakanItem->jumlah ?? '') }}">
                            </td>

                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        Rp
                                    </span>

                                    <input type="number" class="form-control" name="details[{{ $detailIndex }}][harga_satuan]" value="{{ old('details.' . $detailIndex . '.harga_satuan', $kerusakanItem->harga_satuan ?? '') }}">
                                </div>
                            </td>

                            <input type="hidden" name="details[{{ $detailIndex }}][kategori]" value="kerusakan_sarana_prasarana">

                            <input type="hidden" name="details[{{ $detailIndex }}][sub_kategori]" value="komponen_{{ $urut }}">

                        </tr>

                        @php $detailIndex++; @endphp
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
                </thead>

                <tbody>
                    {{-- DURASI --}}
                    <tr>
                        <td style="width:40%">
                            Jangka Waktu Pemulihan
                        </td>

                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="global[durasi]" value="{{ old('global.durasi', $pemulihanItem->durasi ?? '') }}">
                                <input type="hidden" class="form-control" name="global[durasi_satuan]" value="bulan">

                                <span class="input-group-text">bulan</span>
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-secondary text-white">
                        <th colspan="2">
                            PERKIRAAN KEHILANGAN / PENURUNAN PENDAPATAN
                        </th>
                    </tr>
                    <input type="hidden" class="form-control" name="penurunan_pendapatan[kategori]" value="permintaan_telekomunikasi">
                    <input type="hidden" class="form-control" name="penurunan_pendapatan[satuan]" value="permintaan">
                    {{-- JUMLAH SEBELUM (jumlah1) --}}
                    <tr>
                        <td>
                            Permintaan Sebelum Bencana
                        </td>

                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="penurunan_pendapatan[jumlah]" value="{{ old('penurunan_pendapatan.jumlah', $penurunanPendapatanItem->jumlah ?? '') }}">

                                <span class="input-group-text">pelanggan</span>
                            </div>
                        </td>
                    </tr>

                    {{-- JUMLAH SESUDAH (jumlah2) --}}
                    <tr>
                        <td>
                            Permintaan Pasca Bencana
                        </td>

                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="penurunan_pendapatan[jumlah2]" value="{{ old('penurunan_pendapatan.jumlah2', $penurunanPendapatanItem->jumlah2 ?? '') }}">

                                <span class="input-group-text">pelanggan</span>
                            </div>
                        </td>
                    </tr>

                    {{-- HARGA SATUAN --}}
                    <tr>
                        <td>
                            Tarif
                        </td>

                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="number" class="form-control" name="penurunan_pendapatan[harga_satuan]" value="{{ old('penurunan_pendapatan.harga_satuan', $penurunanPendapatanItem->harga_satuan ?? '') }}">
                            </div>
                        </td>
                    </tr>

                    {{-- TOTAL (HASIL HITUNG) --}}
                    <tr>
                        <td>
                            Penurunan Pendapatan
                        </td>

                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="number" class="form-control" name="penurunan_pendapatan[total]" readonly>
                            </div>
                        </td>
                    </tr>

                    <tr class="bg-secondary text-white">
                        <th colspan="2">
                            PERKIRAAN KENAIKAN BIAYA OPERASIONAL
                        </th>
                    </tr>
                    <input type="hidden" class="form-control" name="operasional[kategori]" value="operasional">
                    <input type="hidden" class="form-control" name="operasional[satuan]" value="rp">

                    {{-- B: SEBELUM --}}
                    <tr>
                        <td style="width:40%">
                            Biaya Operasional Sebelum
                        </td>

                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="number" class="form-control" name="operasional[jumlah]" value="{{ old('operasional.jumlah', $operasionalItem->jumlah ?? '') }}">
                            </div>
                        </td>
                    </tr>

                    {{-- C: PASCA --}}
                    <tr>
                        <td>
                            Biaya Operasional Pasca
                        </td>

                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="number" class="form-control" name="operasional[jumlah2]" value="{{ old('operasional.jumlah2', $operasionalItem->jumlah2 ?? '') }}">
                            </div>
                        </td>
                    </tr>

                    {{-- A: BULAN --}}
                    <tr>
                        <td>
                            Jangka Waktu (Bulan)
                        </td>

                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="operasional[bulan]" value="{{ old('operasional.bulan', $operasionalItem->durasi ?? '') }}">

                                <span class="input-group-text">bulan</span>
                            </div>
                        </td>
                    </tr>

                    {{-- E: HASIL --}}
                    <tr>
                        <td>
                            Kenaikan Biaya Operasional
                        </td>

                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="number" class="form-control" name="operasional[total]" readonly>
                            </div>
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

        document.querySelectorAll('input[type="number"]:not([readonly]), input[type="text"]:not([readonly])')
            .forEach(function(input) {

                if (input.value === '') {
                    input.value = 1;
                }

            });

    });
</script>
