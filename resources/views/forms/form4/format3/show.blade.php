@extends('layouts.main')

@section('content')
    <style>
        /* Kurangi padding pada tabel agar lebih kompak seperti format1form4 */
        .table th,
        .table td {
            padding: 0.25rem 0.3rem !important;
        }
    </style>

    <div class="container mt-4">
        <h5 class="text-center fw-bold">Detail Data Sektor Kesehatan<br>Format 3</h5>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Informasi Bencana -->
        @if ($bencana)
            <div class="alert alert-light-primary color-primary mb-4">
                <strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama ?? $bencana->nama }}<br>
                <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($bencana->tanggal)->format('d F Y') }}<br>
                <strong>Lokasi:</strong>
                @if ($bencana->desa && count($bencana->desa) > 0)
                    @foreach ($bencana->desa as $desa)
                        {{ $desa->nama }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                @else
                    -
                @endif
            </div>
        @endif

        <h6 class="fw-bold mt-4">I. DATA SEKTOR KESEHATAN</h6>

        <table class="table table-bordered mt-3">
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
                <tr>
                    <td class="fw-bold bg-secondary text-white" colspan="12" style="padding-left: 15%;">PERKIRAAN KERUSAKAN</td>
                </tr>
                @foreach ([['Rumah Sakit', 'rs'], ['Puskesmas', 'puskesmas'], ['Poliklinik/Tempat Praktek Bersama', 'poliklinik'], ['Puskesmas Pembantu', 'pustu'], ['Polindes', 'polindes'], ['Posyandu', 'posyandu']] as [$label, $prefix])
                    <tr>
                        <td class="align-middle fw-bold">{{ $label }}</td>
                        <td>{{ $format3form4->rs_rb_negeri }}</td>
                        <td>{{ old($prefix . '_rb_swasta', $data->{$prefix . '_rb_swasta'} ?? '0') }}</td>
                        <td>{{ old($prefix . '_rs_negeri', $data->{$prefix . '_rs_negeri'} ?? '0') }}</td>
                        <td>{{ old($prefix . '_rs_swasta', $data->{$prefix . '_rs_swasta'} ?? '0') }}</td>
                        <td>{{ old($prefix . '_rr_negeri', $data->{$prefix . '_rr_negeri'} ?? '0') }}</td>
                        <td>{{ old($prefix . '_rr_swasta', $data->{$prefix . '_rr_swasta'} ?? '0') }}</td>
                        <td>{{ old($prefix . '_luas', $data->{$prefix . '_luas'} ?? '0') }}</td>
                        <td>{{ old($prefix . '_harga_bangunan', $data->{$prefix . '_harga_bangunan'} ?? '0') }}</td>
                        <td>{{ old($prefix . '_harga_obat', $data->{$prefix . '_harga_obat'} ?? '0') }}</td>
                        <td>{{ old($prefix . '_harga_meubelair', $data->{$prefix . '_harga_meubelair'} ?? '0') }}</td>
                        <td>{{ old($prefix . '_harga_peralatan', $data->{$prefix . '_harga_peralatan'} ?? '0') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h6 class="fw-bold mt-4">II. REKAPITULASI TOTAL SEKTOR KESEHATAN</h6>

        @php
            $totalRB = collect($format3form4)->flatten()->sum('rusak_berat');
            $totalRS = collect($format3form4)->flatten()->sum('rusak_sedang');
            $totalRR = collect($format3form4)->flatten()->sum('rusak_ringan');
            $totalBiaya = collect($format3form4)->flatten()->sum('total_biaya');
        @endphp

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Jenis Kerusakan</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-end">Total Biaya</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Total Rusak Berat</strong></td>
                    <td class="text-center">{{ $totalRB }}</td>
                    <td class="text-end">Rp {{ number_format(collect($format3form4)->flatten()->sum('biaya_rb'), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Total Rusak Sedang</strong></td>
                    <td class="text-center">{{ $totalRS }}</td>
                    <td class="text-end">Rp {{ number_format(collect($format3form4)->flatten()->sum('biaya_rs'), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Total Rusak Ringan</strong></td>
                    <td class="text-center">{{ $totalRR }}</td>
                    <td class="text-end">Rp {{ number_format(collect($format3form4)->flatten()->sum('biaya_rr'), 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Total Summary -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">REKAPITULASI TOTAL</h6>
            </div>
            <div class="card-body text-center">
                <h4 class="mb-1">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</h4>
                <small>Total Keseluruhan Format 3</small>
            </div>
        </div>

        <div class="alert alert-info mt-3">
            <h6>Belum Ada Data</h6>
            <p class="mb-0">Belum ada data laporan kesehatan untuk bencana ini.</p>
        </div>

        <!-- Navigation -->
        <div class="d-flex justify-content-between mt-4 mb-4">
            <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
                Kembali
            </a>
            <div>
                <a href="{{ route('forms.form4.format3form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                    Tambah Data Baru
                </a>
            </div>
        </div>
    </div>
@endsection
