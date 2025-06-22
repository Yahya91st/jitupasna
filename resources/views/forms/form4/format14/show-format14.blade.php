@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Data Format 14 - Sektor Perdagangan</h1>
    
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
        <a href="{{ route('forms.form4.format14form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
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
            <h4 class="card-title">A. Kerusakan Fisik</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Bangunan Usaha</th>
                        <th>Jumlah Rusak</th>
                        <th>Luas Rata-rata (m²)</th>
                        <th>Harga Satuan / m²</th>
                        <th>Total Kerugian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Toko Kecil</td>
                        <td>{{ $data['toko_kecil_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['toko_kecil_luas'] ?? '-' }}</td>
                        <td>{{ $data['toko_kecil_harga'] ? 'Rp ' . number_format($data['toko_kecil_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['toko_kecil_total'] ? 'Rp ' . number_format($data['toko_kecil_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Kios Pasar</td>
                        <td>{{ $data['kios_pasar_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['kios_pasar_luas'] ?? '-' }}</td>
                        <td>{{ $data['kios_pasar_harga'] ? 'Rp ' . number_format($data['kios_pasar_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['kios_pasar_total'] ? 'Rp ' . number_format($data['kios_pasar_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Grosir</td>
                        <td>{{ $data['grosir_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['grosir_luas'] ?? '-' }}</td>
                        <td>{{ $data['grosir_harga'] ? 'Rp ' . number_format($data['grosir_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['grosir_total'] ? 'Rp ' . number_format($data['grosir_total'], 0, ',', '.') : '-' }}</td>
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
            <h4 class="card-title">B. Kerusakan Barang Dagangan</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total Kerugian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Beras</td>
                        <td>{{ $data['beras_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['beras_harga'] ? 'Rp ' . number_format($data['beras_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['beras_total'] ? 'Rp ' . number_format($data['beras_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Minyak Goreng</td>
                        <td>{{ $data['minyak_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['minyak_harga'] ? 'Rp ' . number_format($data['minyak_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['minyak_total'] ? 'Rp ' . number_format($data['minyak_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Pakaian</td>
                        <td>{{ $data['pakaian_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['pakaian_harga'] ? 'Rp ' . number_format($data['pakaian_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['pakaian_total'] ? 'Rp ' . number_format($data['pakaian_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Peralatan Elektronik</td>
                        <td>{{ $data['elektronik_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['elektronik_harga'] ? 'Rp ' . number_format($data['elektronik_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['elektronik_total'] ? 'Rp ' . number_format($data['elektronik_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data['lainnya_jenis_barang'] ?? 'Lainnya:' }}</td>
                        <td>{{ $data['lainnya_barang_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_barang_harga'] ? 'Rp ' . number_format($data['lainnya_barang_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['lainnya_barang_total'] ? 'Rp ' . number_format($data['lainnya_barang_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">C. Kehilangan Pendapatan</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="60%">Jumlah Pelaku Usaha</th>
                    <td>{{ $data['jumlah_pelaku_usaha'] ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Rata-rata Pendapatan Harian</th>
                    <td>{{ $data['pendapatan_harian'] ? 'Rp ' . number_format($data['pendapatan_harian'], 0, ',', '.') : '-' }}</td>
                </tr>
                <tr>
                    <th>Lama Tidak Operasi</th>
                    <td>{{ $data['lama_tidak_operasi'] ?? '-' }} hari</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
