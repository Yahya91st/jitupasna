@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel agar lebih kompak seperti format1form4 */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
</style>

<div class="container mt-4">
    <h5 class="text-center fw-bold">Detail Data Sektor Peternakan<br>Format 11</h5>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Informasi Bencana -->
    @if($bencana)
    <div class="alert alert-light-primary color-primary mb-4">
        <strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama ?? $bencana->nama }}<br>
        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($bencana->tanggal)->format('d F Y') }}<br>
        <strong>Lokasi:</strong> 
        @if($bencana->desa && count($bencana->desa) > 0)
            @foreach($bencana->desa as $desa)
                {{ $desa->nama }}@if(!$loop->last), @endif
            @endforeach
        @else
            -
        @endif
    </div>
    @endif

    <!-- Identitas Lokasi -->
    <table class="table table-bordered">
        <tr>
            <td style="width: 50%"><strong>NAMA KAMPUNG:</strong> {{ $data['nama_kampung'] ?? '-' }}</td>
            <td><strong>NAMA DISTRIK:</strong> {{ $data['nama_distrik'] ?? '-' }}</td>
        </tr>
    </table>
    <h6 class="fw-bold mt-4">I. KERUSAKAN BANGUNAN & SARANA PETERNAKAN</h6>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" style="width: 25%">Jenis Bangunan</th>
                    <th colspan="3">Tingkat Kerusakan</th>
                    <th rowspan="2" style="width: 15%">Rata-rata Luas (m²)</th>
                    <th rowspan="2" style="width: 20%">Harga Satuan / m²</th>
                </tr>
                <tr>
                    <th style="width: 10%">Rusak Berat</th>
                    <th style="width: 10%">Rusak Sedang</th>
                    <th style="width: 10%">Rusak Ringan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-start"><strong>Kandang Ternak</strong></td>
                    <td>{{ $data['kandang_rb'] ?? 0 }}</td>
                    <td>{{ $data['kandang_rs'] ?? 0 }}</td>
                    <td>{{ $data['kandang_rr'] ?? 0 }}</td>
                    <td>{{ $data['kandang_luas'] ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($data['kandang_harga_m2'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-start"><strong>Gudang Pakan</strong></td>
                    <td>{{ $data['gudang_pakan_rb'] ?? 0 }}</td>
                    <td>{{ $data['gudang_pakan_rs'] ?? 0 }}</td>
                    <td>{{ $data['gudang_pakan_rr'] ?? 0 }}</td>
                    <td>{{ $data['gudang_pakan_luas'] ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($data['gudang_pakan_harga_m2'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-start"><strong>Balai Inseminasi / Klinik Hewan</strong></td>
                    <td>{{ $data['balai_inseminasi_rb'] ?? 0 }}</td>
                    <td>{{ $data['balai_inseminasi_rs'] ?? 0 }}</td>
                    <td>{{ $data['balai_inseminasi_rr'] ?? 0 }}</td>
                    <td>{{ $data['balai_inseminasi_luas'] ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($data['balai_inseminasi_harga_m2'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                @if($data['lainnya_jenis_bangunan'])
                <tr>
                    <td class="text-start"><strong>{{ $data['lainnya_jenis_bangunan'] }}</strong></td>
                    <td>{{ $data['lainnya_bangunan_rb'] ?? 0 }}</td>
                    <td>{{ $data['lainnya_bangunan_rs'] ?? 0 }}</td>
                    <td>{{ $data['lainnya_bangunan_rr'] ?? 0 }}</td>
                    <td>{{ $data['lainnya_bangunan_luas'] ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($data['lainnya_bangunan_harga_m2'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <h6 class="fw-bold mt-4">II. KERUSAKAN PERALATAN PETERNAKAN</h6>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 40%">Jenis Peralatan</th>
                <th style="width: 30%">Jumlah Rusak</th>
                <th style="width: 30%">Harga Satuan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Mesin Pencacah</strong></td>
                <td class="text-center">{{ $data['mesin_pencacah_jumlah'] ?? 0 }}</td>
                <td class="text-end">Rp {{ number_format($data['mesin_pencacah_harga'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Mesin Pakan Ternak</strong></td>
                <td class="text-center">{{ $data['mesin_pakan_jumlah'] ?? 0 }}</td>
                <td class="text-end">Rp {{ number_format($data['mesin_pakan_harga'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Alat Penampung Susu</strong></td>
                <td class="text-center">{{ $data['alat_penampung_susu_jumlah'] ?? 0 }}</td>
                <td class="text-end">Rp {{ number_format($data['alat_penampung_susu_harga'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @if($data['lainnya_jenis_peralatan'])
            <tr>
                <td><strong>{{ $data['lainnya_jenis_peralatan'] }}</strong></td>
                <td class="text-center">{{ $data['lainnya_peralatan_jumlah'] ?? 0 }}</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_peralatan_harga'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <h6 class="fw-bold mt-4">III. KEMATIAN ATAU HILANGNYA TERNAK</h6>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 40%">Jenis Ternak</th>
                <th style="width: 30%">Jumlah Ternak Hilang / Mati</th>
                <th style="width: 30%">Harga Rata-Rata / Ekor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Sapi</strong></td>
                <td class="text-center">{{ $data['sapi_jumlah'] ?? 0 }} ekor</td>
                <td class="text-end">Rp {{ number_format($data['sapi_harga'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Kambing</strong></td>
                <td class="text-center">{{ $data['kambing_jumlah'] ?? 0 }} ekor</td>
                <td class="text-end">Rp {{ number_format($data['kambing_harga'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Ayam</strong></td>
                <td class="text-center">{{ $data['ayam_jumlah'] ?? 0 }} ekor</td>
                <td class="text-end">Rp {{ number_format($data['ayam_harga'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Babi</strong></td>
                <td class="text-center">{{ $data['babi_jumlah'] ?? 0 }} ekor</td>
                <td class="text-end">Rp {{ number_format($data['babi_harga'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @if($data['lainnya_jenis_ternak'])
            <tr>
                <td><strong>{{ $data['lainnya_jenis_ternak'] }}</strong></td>
                <td class="text-center">{{ $data['lainnya_ternak_jumlah'] ?? 0 }} ekor</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_ternak_harga'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <h6 class="fw-bold mt-4">IV. DAMPAK EKONOMI DAN SOSIAL</h6>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 60%">Jenis Dampak</th>
                <th style="width: 40%">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Kehilangan Pendapatan Peternak</strong></td>
                <td class="text-end">Rp {{ number_format($data['kehilangan_pendapatan'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Penurunan Produksi (Susu, Daging, Telur)</strong></td>
                <td class="text-end">{{ $data['penurunan_produksi'] ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Kenaikan Harga Pakan / Transportasi</strong></td>
                <td class="text-end">Rp {{ number_format($data['kenaikan_harga_pakan'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Tambahan Biaya Kesehatan Ternak</strong></td>
                <td class="text-end">Rp {{ number_format($data['biaya_kesehatan_ternak'] ?? 0, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Total Summary -->
    @php
        // Hitung total kerusakan bangunan
        $totalBangunan = 0;
        $bangunanItems = ['kandang', 'gudang_pakan', 'balai_inseminasi', 'lainnya_bangunan'];
        foreach($bangunanItems as $item) {
            $rb = ($data[$item.'_rb'] ?? 0) * ($data[$item.'_luas'] ?? 0) * ($data[$item.'_harga_m2'] ?? 0);
            $rs = ($data[$item.'_rs'] ?? 0) * ($data[$item.'_luas'] ?? 0) * ($data[$item.'_harga_m2'] ?? 0) * 0.3;
            $rr = ($data[$item.'_rr'] ?? 0) * ($data[$item.'_luas'] ?? 0) * ($data[$item.'_harga_m2'] ?? 0) * 0.1;
            $totalBangunan += $rb + $rs + $rr;
        }
        
        // Hitung total kerusakan peralatan
        $totalPeralatan = 0;
        $peralatanItems = ['mesin_pencacah', 'mesin_pakan', 'alat_penampung_susu', 'lainnya_peralatan'];
        foreach($peralatanItems as $item) {
            $totalPeralatan += ($data[$item.'_jumlah'] ?? 0) * ($data[$item.'_harga'] ?? 0);
        }
        
        // Hitung total kerugian ternak
        $totalTernak = 0;
        $ternakItems = ['sapi', 'kambing', 'ayam', 'babi', 'lainnya_ternak'];
        foreach($ternakItems as $item) {
            $totalTernak += ($data[$item.'_jumlah'] ?? 0) * ($data[$item.'_harga'] ?? 0);
        }
        
        // Hitung total dampak ekonomi
        $totalDampak = ($data['kehilangan_pendapatan'] ?? 0) + ($data['kenaikan_harga_pakan'] ?? 0) + ($data['biaya_kesehatan_ternak'] ?? 0);
        
        $grandTotal = $totalBangunan + $totalPeralatan + $totalTernak + $totalDampak;
    @endphp

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">REKAPITULASI TOTAL</h6>
        </div>
        <div class="card-body text-center">
            <h4 class="mb-1">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>
            <small>Total Keseluruhan Format 11</small>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 mb-4">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali
        </a>
        <div>
            <a href="{{ route('forms.form4.format11form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                Tambah Data Baru
            </a>
        </div>
    </div>
</div>
@endsection
