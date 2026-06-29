@extends('layouts.main')

@section('content')
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

        /* Style khusus untuk judul utama */
        .main-title {
            background: linear-gradient(135deg, #ff8a50, #ff6b35);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
    <div class="container mt-4">
        <button></button>
        <h5 class="text-center fw-bold main-title">Formulir 04<br>Pengumpulan Data Sektor</h5>
        <p class="fw-bold">Format 1a: Pengumpulan Data Sektor Perumahan</p>

        <form action="{{ $action }}" method="POST">
            @csrf

            @if($edit)
                @method($method)
            @endif

            <input type="hidden" name="bencana_id" value="{{ request('bencana_id') ?? ($data->bencana_id ?? '') }}">
            {{-- <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}"> --}}

            <table class="table table-bordered">
                <tr>
                    <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                    <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
                </tr>
            </table>

            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th rowspan="2">Perkiraan Kerusakan</th>
                        <th colspan="3">Jumlah Rumah</th>
                        <th colspan="2">Harga Satuan</th>
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
                            'berat'        => '1b) JUMLAH RUMAH RUSAK BERAT',
                            'sedang'       => '1c) JUMLAH RUMAH RUSAK SEDANG',
                            'ringan'       => '1d) JUMLAH RUMAH RUSAK RINGAN',
                        ];
                    @endphp

                    @php $index = 0; @endphp

                    @foreach($tingkat_rusak as $tingkat => $label)
                        @php
                        $permanen = null;
                        $nonPermanen = null;

                        if (isset($formulir)) {
                            $permanen = $formulir->items->first(function ($item) use ($tingkat, $nomor_input) {
                                return $item->nomor_input == $nomor_input
                                    && $item->kategori == 'rumah'
                                    && $item->sub_kategori == 'permanen'
                                    && $item->tingkat_kerusakan == $tingkat;
                            });

                            $nonPermanen = $formulir->items->first(function ($item) use ($tingkat, $nomor_input) {
                                return $item->nomor_input == $nomor_input
                                    && $item->kategori == 'rumah'
                                    && $item->sub_kategori == 'non_permanen'
                                    && $item->tingkat_kerusakan == $tingkat;
                            });
                        }
                        @endphp
                    <tr>
                        <td>{{ $label }}</td>

                        @php
                            $permanenIndex = $index;
                            $index++;
                        @endphp

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $permanenIndex }}][jumlah]"
                                value="{{ old("details.$permanenIndex.jumlah", $permanen->jumlah ?? '') }}">

                            <input type="hidden"
                                name="details[{{ $permanenIndex }}][kategori]"
                                value="rumah">

                            <input type="hidden"
                                name="details[{{ $permanenIndex }}][sub_kategori]"
                                value="permanen">

                            <input type="hidden"
                                name="details[{{ $permanenIndex }}][tingkat_kerusakan]"
                                value="{{ $tingkat }}">

                            <input type="hidden"
                                name="details[{{ $permanenIndex }}][kriteria_id]"
                                value="1">

                            <input type="hidden"
                                name="details[{{ $permanenIndex }}][satuan]"
                                value="unit">
                        </td>

                        @php
                            $nonPermanenIndex = $index;
                            $index++;
                        @endphp

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $nonPermanenIndex }}][jumlah]"
                                value="{{ old("details.$nonPermanenIndex.jumlah", $nonPermanen->jumlah ?? '') }}">

                            <input type="hidden"
                                name="details[{{ $nonPermanenIndex }}][kategori]"
                                value="rumah">

                            <input type="hidden"
                                name="details[{{ $nonPermanenIndex }}][sub_kategori]"
                                value="non_permanen">

                            <input type="hidden"
                                name="details[{{ $nonPermanenIndex }}][tingkat_kerusakan]"
                                value="{{ $tingkat }}">

                            <input type="hidden"
                                name="details[{{ $nonPermanenIndex }}][kriteria_id]"
                                value="1">

                            <input type="hidden"
                                name="details[{{ $nonPermanenIndex }}][satuan]"
                                value="unit">
                        </td>

                        {{-- Total --}}
                        <td>
                            <input type="number"
                                class="form-control total-rumah"
                                readonly>
                        </td>

                        {{-- Harga Satuan Permanen --}}
                        <td>
                            <input type="number"
                                class="form-control"
                                name="details[{{ $permanenIndex }}][harga_satuan]"
                                value="{{ old("details.$permanenIndex.harga_satuan", $permanen->harga_satuan ?? '') }}">
                        </td>

                        {{-- Harga Satuan Non Permanen --}}
                        <td>
                            <input type="number"
                                class="form-control"
                                name="details[{{ $nonPermanenIndex }}][harga_satuan]"
                                value="{{ old("details.$nonPermanenIndex.harga_satuan", $nonPermanen->harga_satuan ?? '') }}">>
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
                    'kriteria_id' => 2,
                ],
                [
                    'judul' => '2.2 SALURAN AIR/GORONG-GORONG',
                    'kategori' => 'saluran',
                    'satuan' => 'm²',
                    'kriteria_id' => 2,
                ],
                [
                    'judul' => '2.3 BALAI PERTEMUAN RW/RT',
                    'kategori' => 'balai',
                    'satuan' => 'unit',
                    'kriteria_id' => 2,
                ],
            ];

            $tingkatKerusakan = [
                'berat' => 'Rusak Berat',
                'sedang' => 'Rusak Sedang',
                'ringan' => 'Rusak Ringan',
            ];
            @endphp

            @php $index = 100; @endphp

            @foreach($kerusakanPrasarana as $item)

            <table class="table table-bordered mt-3">
                <thead>
                    <tr class="bg-light">
                        <th colspan="5">{{ $item['judul'] }}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($tingkatKerusakan as $tingkat => $label)

                    <tr>

                        <td style="width:15%">
                            {{ $label }}
                        </td>

                        <td style="width:25%">
                            <div class="input-group">

                                <input
                                    type="number"
                                    class="form-control"
                                    name="details[{{ $index }}][jumlah]"
                                    placeholder="0">

                                <span class="input-group-text">
                                    {{ $item['satuan'] }}
                                </span>

                                <input type="hidden"
                                    name="details[{{ $index }}][kategori]"
                                    value="{{ $item['kategori'] }}">

                                <input type="hidden"
                                    name="details[{{ $index }}][tingkat_kerusakan]"
                                    value="{{ $tingkat }}">

                                <input type="hidden"
                                    name="details[{{ $index }}][kriteria_id]"
                                    value="{{ $item['kriteria_id'] }}">

                                <input type="hidden"
                                    name="details[{{ $index }}][satuan]"
                                    value="{{ $item['satuan'] }}">

                            </div>
                        </td>                      

                    </tr>

                    @php $index++; @endphp

                    @endforeach
                    <tr>
                        <td colspan="5">

                            <label>Harga Satuan {{ $item['judul'] }}</label>

                            <input
                                type="number"
                                class="form-control"
                                name="harga_satuan[{{ $item['kategori'] }}]"
                                placeholder="0">

                        </td>
                    </tr>

                </tbody>
            </table>

            @endforeach
        

            <hr class="my-4">

            <!-- <div class="card mt-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Total Kerusakan (Otomatis)</h5>
                </div>
                <div class="card-body text-center">
                    @php
                        $totalKerusakan = 0;
                        // 1. Perhitungan kerusakan rumah (gunakan logika yang benar: setiap jenis × harga masing-masing)
                        $totalKerusakan += ($data->rumah_hancur_total_permanen ?? 0) * ($data->harga_satuan_hancur_total_permanen ?? 0);
                        $totalKerusakan += ($data->rumah_hancur_total_non_permanen ?? 0) * ($data->harga_satuan_hancur_total_non_permanen ?? 0);
                        $totalKerusakan += ($data->rumah_rusak_berat_permanen ?? 0) * ($data->harga_satuan_rusak_berat_permanen ?? 0);
                        $totalKerusakan += ($data->rumah_rusak_berat_non_permanen ?? 0) * ($data->harga_satuan_rusak_berat_non_permanen ?? 0);
                        $totalKerusakan += ($data->rumah_rusak_sedang_permanen ?? 0) * ($data->harga_satuan_rusak_sedang_permanen ?? 0);
                        $totalKerusakan += ($data->rumah_rusak_sedang_non_permanen ?? 0) * ($data->harga_satuan_rusak_sedang_non_permanen ?? 0);
                        $totalKerusakan += ($data->rumah_rusak_ringan_permanen ?? 0) * ($data->harga_satuan_rusak_ringan_permanen ?? 0);
                        $totalKerusakan += ($data->rumah_rusak_ringan_non_permanen ?? 0) * ($data->harga_satuan_rusak_ringan_non_permanen ?? 0);

                        // 2. Perhitungan kerusakan prasarana lingkungan
                        $totalKerusakan += (($data->jalan_rusak_berat ?? 0) + ($data->jalan_rusak_sedang ?? 0) + ($data->jalan_rusak_ringan ?? 0)) * ($data->harga_satuan_jalan ?? 0);
                        $totalKerusakan += (($data->saluran_rusak_berat ?? 0) + ($data->saluran_rusak_sedang ?? 0) + ($data->saluran_rusak_ringan ?? 0)) * ($data->harga_satuan_saluran ?? 0);
                        $totalKerusakan += (($data->balai_rusak_berat ?? 0) + ($data->balai_rusak_sedang ?? 0) + ($data->balai_rusak_ringan ?? 0)) * ($data->harga_satuan_balai ?? 0);

                        // 3. Biaya pembersihan puing (dipindahkan dari kerugian ke kerusakan)
                        $totalKerusakan += ($data->tenaga_kerja_hok ?? 0) * ($data->upah_harian ?? 0);
                        $totalKerusakan += ($data->alat_berat_hari ?? 0) * ($data->biaya_per_hari ?? 0);

                        // 4. Biaya rumah sewa (dipindahkan dari kerugian ke kerusakan)
                        $totalKerusakan += ($data->jumlah_rumah_disewa ?? 0) * ($data->harga_sewa_per_bulan ?? 0) * ($data->durasi_sewa_bulan ?? 0);

                        // 5. Biaya hunian sementara (dipindahkan dari kerugian ke kerusakan)
                        $totalKerusakan += ($data->jumlah_tenda ?? 0) * ($data->harga_tenda ?? 0);
                        $totalKerusakan += ($data->jumlah_barak ?? 0) * ($data->harga_barak ?? 0);
                        $totalKerusakan += ($data->jumlah_rumah_sementara ?? 0) * ($data->harga_rumah_sementara ?? 0);
                    @endphp
                    <h4 class="mb-1">Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</h4>
                    <small>Total Kerusakan Format 1</small>
                </div>
            </div> -->
            <div class="mt-3 text-end">
                <button type="submit" id="submitBtn" class="btn btn-primary">
                    Simpan Data
                </button>
            </div>
            <button type="button"
                    class="btn btn-warning"
                    id="fillDummy">
                Isi Data Dummy
            </button>
        </form>       

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif       

    </div>

<script>
    document.getElementById('fillDummy').addEventListener('click', function () {

        // Semua input number yang kosong
        document.querySelectorAll('input[type="number"]').forEach(function(input) {

            if (input.value === '') {
                input.value = 1;
            }

        });

    });
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-calculate totals for housing damage
        function calculateHouseTotal(type) {
            const permanen = parseInt(document.querySelector(`input[name="rumah_${type}_permanen"]`).value) || 0;
            const nonPermanen = parseInt(document.querySelector(`input[name="rumah_${type}_non_permanen"]`).value) || 0;
            const totalField = document.querySelector(`input[name="${type}_jumlah"]`);
            if (totalField) {
                totalField.value = permanen + nonPermanen;
            }
        }

        // Add event listeners for house damage calculations
        ['hancur_total', 'rusak_sedang', 'rusak_ringan', 'rusak_berat'].forEach(type => {
            const permanenField = document.querySelector(`input[name="rumah_${type}_permanen"]`);
            const nonPermanenField = document.querySelector(`input[name="rumah_${type}_non_permanen"]`);

            if (permanenField) {
                permanenField.addEventListener('input', () => calculateHouseTotal(type));
            }
            if (nonPermanenField) {
                nonPermanenField.addEventListener('input', () => calculateHouseTotal(type));
            }
        });

        // Form submission with loading state
        const submitBtn = document.querySelector('button[type="submit"]');
        const form = document.querySelector('form');

        if (form && submitBtn) {
            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
            });
        }
    });
</script>
@endsection
