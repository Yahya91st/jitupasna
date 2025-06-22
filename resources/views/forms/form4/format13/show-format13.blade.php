@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Data Format 13 - Sektor Industri & UMKM</h1>
    
    @if($bencana)
        <div class="alert alert-light-primary color-primary mb-4">
            <p>Bencana: {{ $bencana->kategori_bencana->nama }}</p>
            <p>Tanggal: {{ $bencana->tanggal }}</p>
            <p>Lokasi: 
                @foreach($bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            </p>
        </div>
    @endif
    
    <div class="mb-4 flex justify-between">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali
        </a>
        <a href="{{ route('forms.form4.format13form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
            <i class="fa fa-plus mr-2"></i> Tambah Data Baru
        </a>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">Informasi Umum</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="30%">Nama Kampung</th>
                    <td>{{ $data['nama_kampung'] ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Distrik</th>
                    <td>{{ $data['nama_distrik'] ?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">A. Kerusakan Bangunan Produksi</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Bangunan</th>
                        <th>Jumlah Rusak</th>
                        <th>Rata-rata Luas (m²)</th>
                        <th>Harga Satuan / m²</th>
                        <th>Total Kerugian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Unit Produksi</td>
                        <td>{{ $data['unit_produksi_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['unit_produksi_luas'] ?? '-' }}</td>
                        <td>{{ $data['unit_produksi_harga'] ? 'Rp ' . number_format($data['unit_produksi_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['unit_produksi_total'] ? 'Rp ' . number_format($data['unit_produksi_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Gudang</td>
                        <td>{{ $data['gudang_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['gudang_luas'] ?? '-' }}</td>
                        <td>{{ $data['gudang_harga'] ? 'Rp ' . number_format($data['gudang_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['gudang_total'] ? 'Rp ' . number_format($data['gudang_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Toko / Gerai</td>
                        <td>{{ $data['toko_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['toko_luas'] ?? '-' }}</td>
                        <td>{{ $data['toko_harga'] ? 'Rp ' . number_format($data['toko_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['toko_total'] ? 'Rp ' . number_format($data['toko_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data['lainnya_jenis_bangunan'] ?? 'Lainnya:' }}</td>
                        <td>{{ $data['lainnya_bangunan_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_bangunan_luas'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_bangunan_harga'] ? 'Rp ' . number_format($data['lainnya_bangunan_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['lainnya_bangunan_total'] ? 'Rp ' . number_format($data['lainnya_bangunan_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">B. Kerusakan Peralatan Produksi</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Peralatan</th>
                        <th>Jumlah Rusak</th>
                        <th>Harga Satuan</th>
                        <th>Total Kerugian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mesin Jahit</td>
                        <td>{{ $data['mesin_jahit_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['mesin_jahit_harga'] ? 'Rp ' . number_format($data['mesin_jahit_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['mesin_jahit_total'] ? 'Rp ' . number_format($data['mesin_jahit_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Alat Panggang / Oven</td>
                        <td>{{ $data['oven_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['oven_harga'] ? 'Rp ' . number_format($data['oven_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['oven_total'] ? 'Rp ' . number_format($data['oven_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Etalase / Display</td>
                        <td>{{ $data['etalase_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['etalase_harga'] ? 'Rp ' . number_format($data['etalase_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['etalase_total'] ? 'Rp ' . number_format($data['etalase_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data['lainnya_jenis_peralatan'] ?? 'Lainnya:' }}</td>
                        <td>{{ $data['lainnya_peralatan_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_peralatan_harga'] ? 'Rp ' . number_format($data['lainnya_peralatan_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['lainnya_peralatan_total'] ? 'Rp ' . number_format($data['lainnya_peralatan_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">C. Kehilangan Produksi & Pendapatan</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Usaha</th>
                        <th>Rata-rata Produksi per Hari</th>
                        <th>Harga Jual per Unit</th>
                        <th>Hari Tidak Produksi</th>
                        <th>Total Kerugian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Roti / Kue</td>
                        <td>{{ $data['roti_produksi'] ?? '-' }}</td>
                        <td>{{ $data['roti_harga'] ? 'Rp ' . number_format($data['roti_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['roti_hari'] ?? '-' }}</td>
                        <td>{{ $data['roti_total'] ? 'Rp ' . number_format($data['roti_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Pakaian</td>
                        <td>{{ $data['pakaian_produksi'] ?? '-' }}</td>
                        <td>{{ $data['pakaian_harga'] ? 'Rp ' . number_format($data['pakaian_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['pakaian_hari'] ?? '-' }}</td>
                        <td>{{ $data['pakaian_total'] ? 'Rp ' . number_format($data['pakaian_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Mebel</td>
                        <td>{{ $data['mebel_produksi'] ?? '-' }}</td>
                        <td>{{ $data['mebel_harga'] ? 'Rp ' . number_format($data['mebel_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['mebel_hari'] ?? '-' }}</td>
                        <td>{{ $data['mebel_total'] ? 'Rp ' . number_format($data['mebel_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data['lainnya_jenis_usaha'] ?? 'Lainnya:' }}</td>
                        <td>{{ $data['lainnya_usaha_produksi'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_usaha_harga'] ? 'Rp ' . number_format($data['lainnya_usaha_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['lainnya_usaha_hari'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_usaha_total'] ? 'Rp ' . number_format($data['lainnya_usaha_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">D. Biaya Tambahan</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="60%">Sewa tempat sementara produksi</th>
                    <td>{{ $data['sewa_tempat'] ? 'Rp ' . number_format($data['sewa_tempat'], 0, ',', '.') : '-' }}</td>
                </tr>
                <tr>
                    <th>Transportasi bahan baku</th>
                    <td>{{ $data['transportasi_bahan'] ? 'Rp ' . number_format($data['transportasi_bahan'], 0, ',', '.') : '-' }}</td>
                </tr>
                <tr>
                    <th>Alat bantu darurat</th>
                    <td>{{ $data['alat_bantu'] ? 'Rp ' . number_format($data['alat_bantu'], 0, ',', '.') : '-' }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
