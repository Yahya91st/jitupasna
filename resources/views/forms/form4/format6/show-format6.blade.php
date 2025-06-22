@extends('layouts.main')

@section('content')
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
        <a href="{{ route('forms.form4.format6form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
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
            <h4 class="card-title">A. Kerusakan Sarana Air Minum</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
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
                        <td>{{ $data['struktur_air_harga'] ? 'Rp ' . number_format($data['struktur_air_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['struktur_air_total'] ? 'Rp ' . number_format($data['struktur_air_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Instalasi Pemurnian Air</td>
                        <td>{{ $data['instalasi_pemurnian_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['instalasi_pemurnian_harga'] ? 'Rp ' . number_format($data['instalasi_pemurnian_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['instalasi_pemurnian_total'] ? 'Rp ' . number_format($data['instalasi_pemurnian_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Sistem Perpipaan</td>
                        <td>{{ $data['perpipaan_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['perpipaan_harga'] ? 'Rp ' . number_format($data['perpipaan_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['perpipaan_total'] ? 'Rp ' . number_format($data['perpipaan_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Sistem Penyimpanan</td>
                        <td>{{ $data['penyimpanan_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['penyimpanan_harga'] ? 'Rp ' . number_format($data['penyimpanan_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['penyimpanan_total'] ? 'Rp ' . number_format($data['penyimpanan_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Sumur</td>
                        <td>{{ $data['sumur_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['sumur_harga'] ? 'Rp ' . number_format($data['sumur_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['sumur_total'] ? 'Rp ' . number_format($data['sumur_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>WC Umum</td>
                        <td>{{ $data['wc_umum_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['wc_umum_harga'] ? 'Rp ' . number_format($data['wc_umum_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['wc_umum_total'] ? 'Rp ' . number_format($data['wc_umum_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    @if(isset($data['lainnya_jenis_sarana']) && !empty($data['lainnya_jenis_sarana']))
                    <tr>
                        <td>{{ $data['lainnya_jenis_sarana'] }}</td>
                        <td>{{ $data['lainnya_sarana_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_sarana_harga'] ? 'Rp ' . number_format($data['lainnya_sarana_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['lainnya_sarana_total'] ? 'Rp ' . number_format($data['lainnya_sarana_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">B. Kerusakan Sistem Sanitasi</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
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
                        <td>Jaringan Pembuangan</td>
                        <td>{{ $data['jaringan_pembuangan_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['jaringan_pembuangan_harga'] ? 'Rp ' . number_format($data['jaringan_pembuangan_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['jaringan_pembuangan_total'] ? 'Rp ' . number_format($data['jaringan_pembuangan_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Septic Tank</td>
                        <td>{{ $data['septic_tank_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['septic_tank_harga'] ? 'Rp ' . number_format($data['septic_tank_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['septic_tank_total'] ? 'Rp ' . number_format($data['septic_tank_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Sistem Pengumpulan Limbah Padat</td>
                        <td>{{ $data['limbah_padat_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['limbah_padat_harga'] ? 'Rp ' . number_format($data['limbah_padat_harga'], 0, ',', '.') : '-' }}</td>
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
            <h6 class="font-weight-bold">A. Kehilangan Pendapatan Instansi Terkait</h6>
            <table class="table">
                <tr>
                    <td>{{ $data['kehilangan_pendapatan'] ? 'Rp ' . number_format($data['kehilangan_pendapatan'], 0, ',', '.') : '-' }} / bulan</td>
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
                    <th>Biaya Pembersihan Sumur</th>
                    <td>{{ $data['biaya_pembersihan_sumur'] ? 'Rp ' . number_format($data['biaya_pembersihan_sumur'], 0, ',', '.') : '-' }}</td>
                </tr>
                <tr>
                    <th>Biaya Bahan Kimia Tambahan</th>
                    <td>{{ $data['biaya_bahan_kimia'] ? 'Rp ' . number_format($data['biaya_bahan_kimia'], 0, ',', '.') : '-' }}</td>
                </tr>
                @if(isset($data['biaya_lainnya_keterangan']) && !empty($data['biaya_lainnya_keterangan']))
                <tr>
                    <th>{{ $data['biaya_lainnya_keterangan'] }}</th>
                    <td>{{ $data['biaya_lainnya'] ? 'Rp ' . number_format($data['biaya_lainnya'], 0, ',', '.') : '-' }}</td>
                </tr>
                @endif
            </table>
            
            <h6 class="font-weight-bold mt-4">C. Jangka Waktu Pemulihan</h6>
            <table class="table">
                <tr>
                    <th width="60%">Rehabilitasi</th>
                    <td>{{ $data['rehabilitasi_bulan'] ?? '-' }} bulan</td>
                </tr>
                <tr>
                    <th>Rekonstruksi</th>
                    <td>{{ $data['rekonstruksi_bulan'] ?? '-' }} bulan</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
