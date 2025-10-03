@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel agar lebih kompak seperti format1form4 */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
</style>

<div class="container mt-4">
    <h5 class="text-center fw-bold">Detail Data Sektor Perumahan<br>Format 1a</h5>
    
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
            <td style="width: 50%"><strong>NAMA KAMPUNG:</strong> {{ $formPerumahan->nama_kampung ?? '-' }}</td>
            <td><strong>NAMA DISTRIK:</strong> {{ $formPerumahan->nama_distrik ?? '-' }}</td>
        </tr>
    </table>

    <h6 class="fw-bold mt-4">I. PERKIRAAN KERUSAKAN</h6>

    <!-- Tabel Kerusakan Rumah -->
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
            <tr>
                <td>1a) JUMLAH RUMAH HANCUR TOTAL</td>
                <td>{{ $formPerumahan->rumah_hancur_total_permanen ?? 0 }}</td>
                <td>{{ $formPerumahan->rumah_hancur_total_non_permanen ?? 0 }}</td>
                <td>{{ ($formPerumahan->rumah_hancur_total_permanen ?? 0) + ($formPerumahan->rumah_hancur_total_non_permanen ?? 0) }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_satuan_hancur_total_permanen ?? 0, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_satuan_hancur_total_non_permanen ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>1b) JUMLAH RUMAH RUSAK BERAT</td>
                <td>{{ $formPerumahan->rumah_rusak_berat_permanen ?? 0 }}</td>
                <td>{{ $formPerumahan->rumah_rusak_berat_non_permanen ?? 0 }}</td>
                <td>{{ ($formPerumahan->rumah_rusak_berat_permanen ?? 0) + ($formPerumahan->rumah_rusak_berat_non_permanen ?? 0) }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_satuan_rusak_berat_permanen ?? 0, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_satuan_rusak_berat_non_permanen ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>1c) JUMLAH RUMAH RUSAK SEDANG</td>
                <td>{{ $formPerumahan->rumah_rusak_sedang_permanen ?? 0 }}</td>
                <td>{{ $formPerumahan->rumah_rusak_sedang_non_permanen ?? 0 }}</td>
                <td>{{ ($formPerumahan->rumah_rusak_sedang_permanen ?? 0) + ($formPerumahan->rumah_rusak_sedang_non_permanen ?? 0) }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_satuan_rusak_sedang_permanen ?? 0, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_satuan_rusak_sedang_non_permanen ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>1d) JUMLAH RUMAH RUSAK RINGAN</td>
                <td>{{ $formPerumahan->rumah_rusak_ringan_permanen ?? 0 }}</td>
                <td>{{ $formPerumahan->rumah_rusak_ringan_non_permanen ?? 0 }}</td>
                <td>{{ ($formPerumahan->rumah_rusak_ringan_permanen ?? 0) + ($formPerumahan->rumah_rusak_ringan_non_permanen ?? 0) }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_satuan_rusak_ringan_permanen ?? 0, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_satuan_rusak_ringan_non_permanen ?? 0, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h6 class="fw-bold mt-4">2. KERUSAKAN PRASARANA LINGKUNGAN</h6>

    <!-- 2.1 JALAN LINGKUNGAN -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr class="bg-light">
                <th colspan="5">2.1 JALAN LINGKUNGAN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 15%">Rusak Berat</td>
                <td style="width: 25%">{{ $formPerumahan->jalan_rusak_berat ?? 0 }} m²</td>
                <td style="width: 15%">Harga Satuan/M²</td>
                <td style="width: 25%">Rp {{ number_format($formPerumahan->harga_satuan_jalan ?? 0, 0, ',', '.') }}</td>
                <td style="width: 20%"></td>
            </tr>
            <tr>
                <td>Rusak Sedang</td>
                <td>{{ $formPerumahan->jalan_rusak_sedang ?? 0 }} m²</td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td>Rusak Ringan</td>
                <td>{{ $formPerumahan->jalan_rusak_ringan ?? 0 }} m²</td>
                <td colspan="3"></td>
            </tr>
        </tbody>
    </table>

    <!-- 2.2 SALURAN AIR/GORONG-GORONG -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr class="bg-light">
                <th colspan="5">2.2 SALURAN AIR/GORONG-GORONG</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 15%">Rusak Berat</td>
                <td style="width: 25%">{{ $formPerumahan->saluran_rusak_berat ?? 0 }} m</td>
                <td style="width: 15%">Harga Satuan/M</td>
                <td style="width: 25%">Rp {{ number_format($formPerumahan->harga_satuan_saluran ?? 0, 0, ',', '.') }}</td>
                <td style="width: 20%"></td>
            </tr>
            <tr>
                <td>Rusak Sedang</td>
                <td>{{ $formPerumahan->saluran_rusak_sedang ?? 0 }} m</td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td>Rusak Ringan</td>
                <td>{{ $formPerumahan->saluran_rusak_ringan ?? 0 }} m</td>
                <td colspan="3"></td>
            </tr>
        </tbody>
    </table>

    <!-- 2.3 BALAI PERTEMUAN RW/RT -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr class="bg-light">
                <th colspan="5">2.3 BALAI PERTEMUAN RW/RT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 15%">Rusak Berat</td>
                <td style="width: 25%">{{ $formPerumahan->balai_rusak_berat ?? 0 }} UNIT</td>
                <td style="width: 15%">Harga Satuan/UNIT</td>
                <td style="width: 25%">Rp {{ number_format($formPerumahan->harga_satuan_balai ?? 0, 0, ',', '.') }}</td>
                <td style="width: 20%"></td>
            </tr>
            <tr>
                <td>Rusak Sedang</td>
                <td>{{ $formPerumahan->balai_rusak_sedang ?? 0 }} UNIT</td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td>Rusak Ringan</td>
                <td>{{ $formPerumahan->balai_rusak_ringan ?? 0 }} UNIT</td>
                <td colspan="3"></td>
            </tr>
        </tbody>
    </table>
    
    <h6 class="fw-bold mt-4">II. PERKIRAAN KERUGIAN</h6>
    
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Item</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tenaga Kerja (HOK)</td>
                <td>{{ $formPerumahan->tenaga_kerja_hok ?? 0 }}</td>
                <td>Rp {{ number_format($formPerumahan->upah_harian ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Alat Berat (Hari)</td>
                <td>{{ $formPerumahan->alat_berat_hari ?? 0 }}</td>
                <td>Rp {{ number_format($formPerumahan->biaya_per_hari ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Harga Sewa per Bulan</td>
                <td>-</td>
                <td>Rp {{ number_format($formPerumahan->harga_sewa_per_bulan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tenda</td>
                <td>{{ $formPerumahan->jumlah_tenda ?? 0 }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_tenda ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Barak</td>
                <td>{{ $formPerumahan->jumlah_barak ?? 0 }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_barak ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Rumah Sementara</td>
                <td>{{ $formPerumahan->jumlah_rumah_sementara ?? 0 }}</td>
                <td>Rp {{ number_format($formPerumahan->harga_rumah_sementara ?? 0, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Total Summary -->
    @php
        $totalKerusakanRumah = 0;
        $totalKerusakanRumah += ($formPerumahan->rumah_hancur_total_permanen ?? 0) * ($formPerumahan->harga_satuan_hancur_total_permanen ?? 0);
        $totalKerusakanRumah += ($formPerumahan->rumah_hancur_total_non_permanen ?? 0) * ($formPerumahan->harga_satuan_hancur_total_non_permanen ?? 0);
        $totalKerusakanRumah += ($formPerumahan->rumah_rusak_berat_permanen ?? 0) * ($formPerumahan->harga_satuan_rusak_berat_permanen ?? 0);
        $totalKerusakanRumah += ($formPerumahan->rumah_rusak_berat_non_permanen ?? 0) * ($formPerumahan->harga_satuan_rusak_berat_non_permanen ?? 0);
        $totalKerusakanRumah += ($formPerumahan->rumah_rusak_sedang_permanen ?? 0) * ($formPerumahan->harga_satuan_rusak_sedang_permanen ?? 0);
        $totalKerusakanRumah += ($formPerumahan->rumah_rusak_sedang_non_permanen ?? 0) * ($formPerumahan->harga_satuan_rusak_sedang_non_permanen ?? 0);
        $totalKerusakanRumah += ($formPerumahan->rumah_rusak_ringan_permanen ?? 0) * ($formPerumahan->harga_satuan_rusak_ringan_permanen ?? 0);
        $totalKerusakanRumah += ($formPerumahan->rumah_rusak_ringan_non_permanen ?? 0) * ($formPerumahan->harga_satuan_rusak_ringan_non_permanen ?? 0);
        
        $totalKerusakanPrasarana = 0;
        $totalKerusakanPrasarana += (($formPerumahan->jalan_rusak_berat ?? 0) + ($formPerumahan->jalan_rusak_sedang ?? 0) + ($formPerumahan->jalan_rusak_ringan ?? 0)) * ($formPerumahan->harga_satuan_jalan ?? 0);
        $totalKerusakanPrasarana += (($formPerumahan->saluran_rusak_berat ?? 0) + ($formPerumahan->saluran_rusak_sedang ?? 0) + ($formPerumahan->saluran_rusak_ringan ?? 0)) * ($formPerumahan->harga_satuan_saluran ?? 0);
        $totalKerusakanPrasarana += (($formPerumahan->balai_rusak_berat ?? 0) + ($formPerumahan->balai_rusak_sedang ?? 0) + ($formPerumahan->balai_rusak_ringan ?? 0)) * ($formPerumahan->harga_satuan_balai ?? 0);
        
        $totalKerugian = 0;
        $totalKerugian += ($formPerumahan->tenaga_kerja_hok ?? 0) * ($formPerumahan->upah_harian ?? 0);
        $totalKerugian += ($formPerumahan->alat_berat_hari ?? 0) * ($formPerumahan->biaya_per_hari ?? 0);
        $totalKerugian += ($formPerumahan->jumlah_tenda ?? 0) * ($formPerumahan->harga_tenda ?? 0);
        $totalKerugian += ($formPerumahan->jumlah_barak ?? 0) * ($formPerumahan->harga_barak ?? 0);
        $totalKerugian += ($formPerumahan->jumlah_rumah_sementara ?? 0) * ($formPerumahan->harga_rumah_sementara ?? 0);
        
        $grandTotal = $totalKerusakanRumah + $totalKerusakanPrasarana + $totalKerugian;
    @endphp

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">REKAPITULASI TOTAL</h6>
        </div>
        <div class="card-body text-center">
            <h4 class="mb-1">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>
            <small>Total Keseluruhan Format 1</small>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 mb-4">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali
        </a>
        <div>
            <a href="{{ route('forms.form4.preview-pdf', $formPerumahan->id) }}" class="btn btn-info" target="_blank">
                Lihat PDF
            </a>
            <a href="{{ route('forms.form4.pdf', $formPerumahan->id) }}" class="btn btn-primary" target="_blank">
                Unduh PDF
            </a>
        </div>
    </div>
</div>
@endsection