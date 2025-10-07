@extends('layouts.main')

@section('content')
<style>
    .compact-table td, .compact-table th {
        padding: 4px 8px !important;
    }
</style>
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Data Format 6 - Sarana Air Minum & Sanitasi</h1>
    
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
        <div>
            <a href="{{ route('forms.form4.format6.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                <i class="fa fa-plus mr-2"></i> Tambah Data Baru
            </a>
            <a href="{{ route('forms.form4.format6.edit', $data['id']) }}" class="btn btn-warning">
                <i class="fa fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('forms.form4.format6.pdf', $data['id']) }}" class="btn btn-danger" target="_blank">
                <i class="fa fa-file-pdf mr-2"></i> PDF
            </a>
        </div>
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
            <h4 class="card-title">A. Kerusakan Sarana Air Minum</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered compact-table">
                <thead>
                    <tr>
                        <th>Komponen</th>
                        <th>Jumlah Kerusakan Unit</th>
                        <th>Harga Satuan</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Struktur Pengambilan Air</td>
                        <td>{{ $data['struktur_air_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['struktur_air_harga_satuan'] ? 'Rp ' . number_format($data['struktur_air_harga_satuan'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['struktur_air_total'] ? 'Rp ' . number_format($data['struktur_air_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Instalasi Pemurnian Air</td>
                        <td>{{ $data['instalasi_pemurnian_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['instalasi_pemurnian_harga_satuan'] ? 'Rp ' . number_format($data['instalasi_pemurnian_harga_satuan'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['instalasi_pemurnian_total'] ? 'Rp ' . number_format($data['instalasi_pemurnian_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Sistem Perpipaan</td>
                        <td>{{ $data['perpipaan_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['perpipaan_harga_satuan'] ? 'Rp ' . number_format($data['perpipaan_harga_satuan'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['perpipaan_total'] ? 'Rp ' . number_format($data['perpipaan_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Sistem Penyimpanan</td>
                        <td>{{ $data['penyimpanan_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['penyimpanan_harga_satuan'] ? 'Rp ' . number_format($data['penyimpanan_harga_satuan'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['penyimpanan_total'] ? 'Rp ' . number_format($data['penyimpanan_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Sumur</td>
                        <td>{{ $data['sumur_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['sumur_harga_satuan'] ? 'Rp ' . number_format($data['sumur_harga_satuan'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['sumur_total'] ? 'Rp ' . number_format($data['sumur_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>WC Umum</td>
                        <td>{{ $data['wc_umum_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['wc_umum_harga_satuan'] ? 'Rp ' . number_format($data['wc_umum_harga_satuan'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['wc_umum_total'] ? 'Rp ' . number_format($data['wc_umum_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    {{-- Field lainnya_sarana tidak ada di model Format6Form4 --}}
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">B. Kerusakan Sistem Sanitasi</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered compact-table">
                <thead>
                    <tr>
                        <th>Komponen</th>
                        <th>Jumlah Kerusakan Unit</th>
                        <th>Harga Satuan</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sistem Sanitasi</td>
                        <td>{{ $data['sanitasi_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['sanitasi_harga_satuan'] ? 'Rp ' . number_format($data['sanitasi_harga_satuan'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['sanitasi_total'] ? 'Rp ' . number_format($data['sanitasi_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Drainase</td>
                        <td>{{ $data['drainase_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['drainase_harga_satuan'] ? 'Rp ' . number_format($data['drainase_harga_satuan'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['drainase_total'] ? 'Rp ' . number_format($data['drainase_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Sistem Pengumpulan Limbah Padat</td>
                        <td>{{ $data['limbah_padat_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['limbah_padat_harga_satuan'] ? 'Rp ' . number_format($data['limbah_padat_harga_satuan'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['limbah_padat_total'] ? 'Rp ' . number_format($data['limbah_padat_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">C. Perkiraan Dampak Ekonomi</h4>
        </div>
        <div class="card-body">
            <h6 class="font-weight-bold">A. Kehilangan Pendapatan PDAM</h6>
            <table class="table">
                <tr>
                    <td>{{ $data['kehilangan_pendapatan_pdam'] ? 'Rp ' . number_format($data['kehilangan_pendapatan_pdam'], 0, ',', '.') : '-' }} / bulan</td>
                </tr>
            </table>
            
            <h6 class="font-weight-bold mt-4">B. Kenaikan Biaya</h6>
            <table class="table">
                <tr>
                    <th width="60%">Biaya Pemurnian Air Tambahan</th>
                    <td>{{ $data['biaya_pemurnian'] ? 'Rp ' . number_format($data['biaya_pemurnian'], 0, ',', '.') : '-' }}</td>
                </tr>
                <tr>
                    <th>Biaya Distribusi Air Tambahan</th>
                    <td>{{ $data['biaya_distribusi'] ? 'Rp ' . number_format($data['biaya_distribusi'], 0, ',', '.') : '-' }}</td>
                </tr>
                <tr>
                    <th>Biaya Pembersihan</th>
                    <td>{{ $data['biaya_pembersihan'] ? 'Rp ' . number_format($data['biaya_pembersihan'], 0, ',', '.') : '-' }}</td>
                </tr>
                <tr>
                    <th>Biaya Bahan Kimia Tambahan</th>
                    <td>{{ $data['biaya_bahan_kimia'] ? 'Rp ' . number_format($data['biaya_bahan_kimia'], 0, ',', '.') : '-' }}</td>
                </tr>
                @if(isset($data['biaya_lain']) && !empty($data['biaya_lain']))
                <tr>
                    <th>Biaya Lain-lain</th>
                    <td>{{ $data['biaya_lain'] ? 'Rp ' . number_format($data['biaya_lain'], 0, ',', '.') : '-' }}</td>
                </tr>
                @endif
            </table>
            
            <h6 class="font-weight-bold mt-4">C. Total Perhitungan</h6>
            <table class="table table-bordered">
                <tr>
                    <th width="60%" class="bg-light">Total Kerusakan</th>
                    <td class="fw-bold">{{ $data['total_kerusakan'] ? 'Rp ' . number_format($data['total_kerusakan'], 0, ',', '.') : 'Rp 0' }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Total Kerugian</th>
                    <td class="fw-bold">{{ $data['total_kerugian'] ? 'Rp ' . number_format($data['total_kerugian'], 0, ',', '.') : 'Rp 0' }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
