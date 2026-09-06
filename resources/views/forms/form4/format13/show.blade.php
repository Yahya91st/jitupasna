@extends('layouts.main')

@section('content')
<style>
    .table th, .table td { padding: 0.5rem; }
    .btn { margin: 0.25rem; }
    h5 { text-align: center; margin-bottom: 1rem; }
</style>

<div class="container-fluid">
    <h5>Data Format 13 - Sektor Industri & UMKM</h5>
    
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
    
    <h6 class="fw-bold">IDENTITAS LOKASI</h6>
    
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 30%">Lokasi</th>
                <th style="width: 70%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Nama Kampung</strong></td>
                <td>{{ $data['nama_kampung'] ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Nama Distrik</strong></td>
                <td>{{ $data['nama_distrik'] ?? '-' }}</td>
            </tr>
        </tbody>
    </table>
    <h6 class="fw-bold mt-4">I. KERUSAKAN BANGUNAN PRODUKSI</h6>
    
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 25%">Jenis Bangunan</th>
                <th style="width: 15%">Jumlah Rusak</th>
                <th style="width: 15%">Luas (m²)</th>
                <th style="width: 20%">Harga/m²</th>
                <th style="width: 25%">Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Unit Produksi</strong></td>
                <td class="text-center">{{ $data['unit_produksi_jumlah'] ?? 0 }} unit</td>
                <td class="text-center">{{ $data['unit_produksi_luas'] ?? 0 }} m²</td>
                <td class="text-end">Rp {{ number_format($data['unit_produksi_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['unit_produksi_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Gudang</strong></td>
                <td class="text-center">{{ $data['gudang_jumlah'] ?? 0 }} unit</td>
                <td class="text-center">{{ $data['gudang_luas'] ?? 0 }} m²</td>
                <td class="text-end">Rp {{ number_format($data['gudang_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['gudang_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Toko / Gerai</strong></td>
                <td class="text-center">{{ $data['toko_jumlah'] ?? 0 }} unit</td>
                <td class="text-center">{{ $data['toko_luas'] ?? 0 }} m²</td>
                <td class="text-end">Rp {{ number_format($data['toko_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['toko_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @if($data['lainnya_jenis_bangunan'])
            <tr>
                <td><strong>{{ $data['lainnya_jenis_bangunan'] }}</strong></td>
                <td class="text-center">{{ $data['lainnya_bangunan_jumlah'] ?? 0 }} unit</td>
                <td class="text-center">{{ $data['lainnya_bangunan_luas'] ?? 0 }} m²</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_bangunan_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_bangunan_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <h6 class="fw-bold mt-4">II. KERUSAKAN PERALATAN PRODUKSI</h6>
    
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 40%">Jenis Peralatan</th>
                <th style="width: 20%">Jumlah Rusak</th>
                <th style="width: 20%">Harga Satuan</th>
                <th style="width: 20%">Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Mesin Jahit</strong></td>
                <td class="text-center">{{ $data['mesin_jahit_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['mesin_jahit_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['mesin_jahit_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Alat Panggang / Oven</strong></td>
                <td class="text-center">{{ $data['oven_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['oven_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['oven_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Etalase / Display</strong></td>
                <td class="text-center">{{ $data['etalase_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['etalase_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['etalase_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @if($data['lainnya_jenis_peralatan'])
            <tr>
                <td><strong>{{ $data['lainnya_jenis_peralatan'] }}</strong></td>
                <td class="text-center">{{ $data['lainnya_peralatan_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_peralatan_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_peralatan_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endif
        </tbody>
    </table>
    <h6 class="fw-bold mt-4">III. KEHILANGAN PRODUKSI & PENDAPATAN</h6>
    
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 20%">Jenis Usaha</th>
                <th style="width: 20%">Produksi/Hari</th>
                <th style="width: 20%">Harga/Unit</th>
                <th style="width: 15%">Hari Tidak Produksi</th>
                <th style="width: 25%">Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Roti / Kue</strong></td>
                <td class="text-center">{{ $data['roti_produksi'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['roti_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $data['roti_hari'] ?? 0 }} hari</td>
                <td class="text-end">Rp {{ number_format($data['roti_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Pakaian</strong></td>
                <td class="text-center">{{ $data['pakaian_produksi'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['pakaian_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $data['pakaian_hari'] ?? 0 }} hari</td>
                <td class="text-end">Rp {{ number_format($data['pakaian_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Mebel</strong></td>
                <td class="text-center">{{ $data['mebel_produksi'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['mebel_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $data['mebel_hari'] ?? 0 }} hari</td>
                <td class="text-end">Rp {{ number_format($data['mebel_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @if($data['lainnya_jenis_usaha'])
            <tr>
                <td><strong>{{ $data['lainnya_jenis_usaha'] }}</strong></td>
                <td class="text-center">{{ $data['lainnya_usaha_produksi'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_usaha_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $data['lainnya_usaha_hari'] ?? 0 }} hari</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_usaha_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <h6 class="fw-bold mt-4">IV. BIAYA TAMBAHAN</h6>
    
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 60%">Jenis Biaya</th>
                <th style="width: 40%">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Sewa Tempat Sementara Produksi</strong></td>
                <td class="text-end">Rp {{ number_format($data['sewa_tempat'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Transportasi Bahan Baku</strong></td>
                <td class="text-end">Rp {{ number_format($data['transportasi_bahan'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Alat Bantu Darurat</strong></td>
                <td class="text-end">Rp {{ number_format($data['alat_bantu'] ?? 0, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Total Summary -->
    @php
        // Hitung total kerusakan bangunan
        $totalBangunan = ($data['unit_produksi_total'] ?? 0) + 
                         ($data['gudang_total'] ?? 0) + 
                         ($data['toko_total'] ?? 0) + 
                         ($data['lainnya_bangunan_total'] ?? 0);
        
        // Hitung total kerusakan peralatan
        $totalPeralatan = ($data['mesin_jahit_total'] ?? 0) + 
                          ($data['oven_total'] ?? 0) + 
                          ($data['etalase_total'] ?? 0) + 
                          ($data['lainnya_peralatan_total'] ?? 0);
        
        // Hitung total kehilangan produksi
        $totalProduksi = ($data['roti_total'] ?? 0) + 
                         ($data['pakaian_total'] ?? 0) + 
                         ($data['mebel_total'] ?? 0) + 
                         ($data['lainnya_usaha_total'] ?? 0);
        
        // Hitung total biaya tambahan
        $totalBiayaTambahan = ($data['sewa_tempat'] ?? 0) + 
                              ($data['transportasi_bahan'] ?? 0) + 
                              ($data['alat_bantu'] ?? 0);
        
        $grandTotal = $totalBangunan + $totalPeralatan + $totalProduksi + $totalBiayaTambahan;
    @endphp

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">REKAPITULASI TOTAL</h6>
        </div>
        <div class="card-body text-center">
            <h4 class="mb-1">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>
            <small>Total Keseluruhan Format 13</small>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 mb-4">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali
        </a>
        <div>
            <a href="{{ route('forms.form4.format13form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                Tambah Data Baru
            </a>
        </div>
    </div>
</div>
@endsection
