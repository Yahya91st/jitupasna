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
        <p class="fw-bold">Format 3: Sektor Kesehatan</p>
        <form action="{{ isset($edit) && $edit ? route('forms.form4.format3.update', $data->id) : route('forms.form4.format3.store') }}" method="POST">
            @csrf
            @if (isset($edit) && $edit)
                @method('PATCH')
            @endif
            <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
            <table class="table table-bordered">
                <tr>
                    <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                    <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
                </tr>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle" style="width: 100%;">
                    <thead>
                        <tr>
                            <th rowspan="3" class="align-middle" style="width: 20%;">Keterangan</th>
                            <th colspan="6" class="text-center" style="width: 40%;">Jumlah Unit yang Rusak</th>
                            <th rowspan="3" class="text-center" style="width: 40%;">Luas rata rata bangunan</th>
                            <th colspan="4" class="text-center" style="width: 40%;">HARGA SATUAN</th>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center" style="width: 13%;">RB</th>
                            <th colspan="2" class="text-center" style="width: 13%;">RS</th>
                            <th colspan="2" class="text-center" style="width: 14%;">RR</th>
                            <th rowspan="2" class="text-center" style="width: 14%;">Bangunan/m2</th>
                            <th rowspan="2" class="text-center" style="width: 14%;">Obat-obatan</th>
                            <th rowspan="2" class="text-center" style="width: 14%;">Meubelair</th>
                            <th rowspan="2" class="text-center" style="width: 14%;">Peralatan Lab Dan Lainnya</th>

                        </tr>
                        <tr>
                            <th class="text-center" style="width: 14%;">Negeri</th>
                            <th class="text-center" style="width: 14%;">Swasta</th>
                            <th class="text-center" style="width: 14%;">Negeri</th>
                            <th class="text-center" style="width: 14%;">Swasta</th>
                            <th class="text-center" style="width: 14%;">Negeri</th>
                            <th class="text-center" style="width: 14%;">Swasta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $faskes = [
                            'rs' => 'Rumah Sakit',
                            'puskesmas' => 'Puskesmas',
                            'poliklinik' => 'Poliklinik/Tempat Praktek Bersama',
                            'pustu' => 'Puskesmas Pembantu',
                            'polindes' => 'Polindes',
                            'posyandu' => 'Posyandu',
                        ];

                        $index = 0;
                        @endphp
                        @foreach ($faskes as $kategori => $label)

                    <tr>
                        <td class="fw-bold">{{ $label }}</td>

                        {{-- RB NEGERI --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="negeri">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="berat">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="3">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- RB SWASTA --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="swasta">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="berat">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="3">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- RS NEGERI --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="negeri">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="sedang">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="3">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- RS SWASTA --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="swasta">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="sedang">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="3">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- RR NEGERI --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="negeri">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="ringan">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="3">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- RR SWASTA --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="swasta">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="ringan">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="3">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- LUAS --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="dimensi[{{ $kategori }}]"
                                placeholder="m²">
                        </td>

                        {{-- HARGA BANGUNAN --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="harga_bangunan[{{ $kategori }}]">
                        </td>

                        {{-- HARGA OBAT --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="harga_obat[{{ $kategori }}]">
                        </td>

                        {{-- MEUBELAIR --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="harga_meubelair[{{ $kategori }}]">
                        </td>

                        {{-- PERALATAN --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="harga_peralatan[{{ $kategori }}]">
                        </td>

                    </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>

            <hr class="my-4">

            <h6 class="fw-bold">II. PERKIRAAN KERUGIAN</h6>
            
            @php
                $kerugian = [
                    [
                        'judul' => '1. BIAYA PEMBERSIHAN PUING',
                        'fields' => [
                            [
                                'label' => 'A. Biaya Tenaga Kerja',
                                'name1' => 'biaya_tenaga_kerja_hok',
                                'addon1' => 'HOK',
                                'name2' => 'upah_harian',
                                'addon2' => 'Rp',
                            ],
                            [
                                'label' => 'B. Biaya Alat Berat',
                                'name1' => 'biaya_alat_berat_hari',
                                'addon1' => 'Hari',
                                'name2' => 'biaya_alat_berat_tarif',
                                'addon2' => 'Rp',
                            ],
                        ]
                    ],
                    [
                        'judul' => '2. BIAYA PEMULASARAAN JENAZAH',
                        'fields' => [
                            [
                                'label' => 'Jumlah Jenazah',
                                'name1' => 'jumlah_jenazah',
                                'addon1' => 'Jenazah',
                                'name2' => 'biaya_per_jenazah',
                                'addon2' => 'Rp',
                            ],
                        ]
                    ],
                    [
                        'judul' => '3. BIAYA PERAWATAN KORBAN BENCANA',
                        'fields' => [
                            [
                                'label' => 'Jumlah Korban Dirawat',
                                'name1' => 'jumlah_pasien',
                                'addon1' => 'Orang',
                                'name2' => 'biaya_per_pasien',
                                'addon2' => 'Rp',
                            ],
                        ]
                    ],
                    [
                        'judul' => '4. FASILITAS KESEHATAN SEMENTARA',
                        'fields' => [
                            [
                                'label' => 'Jenis Faskes',
                                'type' => 'text',
                                'name1' => 'jenis_operasional',
                            ],
                            [
                                'label' => 'Jumlah Unit',
                                'name1' => 'jumlah_faskes',
                                'addon1' => 'Unit',
                                'name2' => 'biaya_pengadaan_faskes',
                                'addon2' => 'Rp',
                            ],
                        ]
                    ],
                    [
                        'judul' => '5. BIAYA PENANGANAN PSIKOLOGIS KORBAN BENCANA',
                        'fields' => [
                            [
                                'label' => 'Jumlah Korban',
                                'name1' => 'jumlah_korban_psikologis',
                                'addon1' => 'Orang',
                                'name2' => 'biaya_penanganan_psikologis',
                                'addon2' => 'Rp',
                            ],
                        ]
                    ],
                    [
                        'judul' => '6-7. PENCEGAHAN & TENAGA KESEHATAN',
                        'fields' => [
                            [
                                'label' => 'Biaya Pencegahan Penyakit Menular',
                                'name1' => 'biaya_pencegahan_penyakit',
                                'addon1' => 'Rp',
                                'single' => true,
                            ],
                            [
                                'label' => 'Jumlah Tenaga Kesehatan',
                                'name1' => 'jumlah_tenaga_kesehatan',
                                'addon1' => 'Orang',
                                'name2' => 'honorarium_tenaga_kesehatan',
                                'addon2' => 'Rp',
                            ],
                        ]
                    ],
                    [
                        'judul' => '8-9. HONOR & PENDAPATAN FASKES',
                        'fields' => [
                            [
                                'label' => 'Honorarium Tenaga Kesehatan',
                                'name1' => 'honorarium_tenaga_kesehatan',
                                'addon1' => 'Rp',
                                'single' => true,
                            ],
                            [
                                'label' => 'Pendapatan Faskes Swasta/Bulan',
                                'name1' => 'pendapatan_faskes_swasta',
                                'addon1' => 'Rp',
                                'single' => true,
                            ],
                        ]
                    ],
                ];

                $index = 0;
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
                        <td style="width: 15%">
                            {{ $field['label'] }}
                        </td>

                        {{-- FIELD 1 --}}
                        <td style="width: 35%">
                            <div class="input-group">

                                @if(isset($field['type']) && $field['type'] === 'text')
                                    <input type="text"
                                        class="form-control"
                                        name="{{ $field['name1'] }}"
                                        value="{{ old($field['name1'], $data->{$field['name1']} ?? '') }}">
                                @else
                                    <input type="number"
                                        class="form-control"
                                        name="{{ $field['name1'] }}"
                                        value="{{ old($field['name1'], $data->{$field['name1']} ?? '') }}">
                                @endif

                                @if(isset($field['addon1']))
                                    <span class="input-group-text">{{ $field['addon1'] }}</span>
                                @endif

                            </div>
                        </td>

                        {{-- FIELD 2 (optional) --}}
                        @if(isset($field['name2']))
                        <td style="width: 15%">
                            {{ $field['label2'] ?? 'Nilai' }}
                        </td>

                        <td style="width: 35%">
                            <div class="input-group">
                                <span class="input-group-text">{{ $field['addon2'] ?? '' }}</span>

                                <input type="number"
                                    class="form-control"
                                    name="{{ $field['name2'] }}"
                                    value="{{ old($field['name2'], $data->{$field['name2']} ?? '') }}">
                            </div>
                        </td>
                        @else
                        <td colspan="2"></td>
                        @endif

                    </tr>

                    @endforeach
                </tbody>
            </table>
            @endforeach

            <div class="row mb-4">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">{{ isset($edit) && $edit ? 'Update Data' : 'Simpan Data' }}</button>
                </div>
                <button type="button"
                        class="btn btn-warning"
                        id="fillDummy">
                    Isi Data Dummy
                </button>
            </div>
        </form>

        <hr class="my-4">

        <div class="card mt-4">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Total Kerusakan (Otomatis)</h5>
            </div>
            <div class="card-body text-center">
                @php
                    $totalKerusakan = 0;
                    $faskes = ['rs', 'puskesmas', 'poliklinik', 'pustu', 'polindes', 'posyandu'];
                    foreach ($faskes as $f) {
                        $totalKerusakan += ($data->{$f . '_berat'} ?? 0) * ($data->{$f . '_rb_harga'} ?? 0);
                        $totalKerusakan += ($data->{$f . '_sedang'} ?? 0) * ($data->{$f . '_rs_harga'} ?? 0);
                        $totalKerusakan += ($data->{$f . '_ringan'} ?? 0) * ($data->{$f . '_rr_harga'} ?? 0);
                    }
                    $totalKerusakan += ($data->biaya_tenaga_kerja_hok ?? 0) * ($data->upah_harian ?? 0);
                    $totalKerusakan += ($data->biaya_alat_berat_hari ?? 0) * ($data->biaya_alat_berat_tarif ?? 0);
                    $totalKerusakan += ($data->jumlah_jenazah ?? 0) * ($data->biaya_per_jenazah ?? 0);
                    $totalKerusakan += ($data->jumlah_pasien ?? 0) * ($data->biaya_per_pasien ?? 0);
                    $totalKerusakan += ($data->jumlah_faskes ?? 0) * ($data->biaya_pengadaan_faskes ?? 0);
                    $totalKerusakan += ($data->jumlah_korban_psikologis ?? 0) * ($data->biaya_penanganan_psikologis ?? 0);
                    $totalKerusakan += $data->biaya_pencegahan_penyakit ?? 0;
                    $totalKerusakan += ($data->jumlah_tenaga_kesehatan ?? 0) * ($data->honorarium_tenaga_kesehatan ?? 0);
                    $totalKerusakan += $data->pendapatan_faskes_swasta ?? 0;
                @endphp
                <h4 class="mb-1">Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</h4>
                <small>Total Kerusakan Format 3</small>
            </div>
        </div>

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
    </script>
@endsection
