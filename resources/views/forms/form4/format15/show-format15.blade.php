@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Data Format 15 - Sektor Pariwisata</h1>
    
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
        <a href="{{ route('forms.form4.format15form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
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
            <h4 class="card-title">A. Kerusakan Sarana & Objek Wisata</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Sarana</th>
                        <th>Jumlah Rusak</th>
                        <th>Harga Satuan</th>
                        <th>Total Kerugian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Penginapan / Homestay</td>
                        <td>{{ $data['penginapan_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['penginapan_harga'] ? 'Rp ' . number_format($data['penginapan_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['penginapan_total'] ? 'Rp ' . number_format($data['penginapan_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Restoran / Warung Wisata</td>
                        <td>{{ $data['restoran_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['restoran_harga'] ? 'Rp ' . number_format($data['restoran_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['restoran_total'] ? 'Rp ' . number_format($data['restoran_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Objek Wisata (Pantai, Situs, dll)</td>
                        <td>{{ $data['objek_wisata_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['objek_wisata_harga'] ? 'Rp ' . number_format($data['objek_wisata_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['objek_wisata_total'] ? 'Rp ' . number_format($data['objek_wisata_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Pusat Informasi Wisata</td>
                        <td>{{ $data['pusat_info_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['pusat_info_harga'] ? 'Rp ' . number_format($data['pusat_info_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['pusat_info_total'] ? 'Rp ' . number_format($data['pusat_info_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">B. Kehilangan Pendapatan</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="60%">Jumlah Usaha Pariwisata Terdampak</th>
                    <td>{{ $data['jumlah_usaha_terdampak'] ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Rata-rata Pendapatan Harian</th>
                    <td>{{ $data['pendapatan_harian'] ? 'Rp ' . number_format($data['pendapatan_harian'], 0, ',', '.') : '-' }}</td>
                </tr>
                <tr>
                    <th>Jumlah Hari Tutup Operasi</th>
                    <td>{{ $data['hari_tutup'] ?? '-' }} hari</td>
                </tr>
                <tr>
                    <th>Kehilangan Wisatawan</th>
                    <td>{{ $data['kehilangan_wisatawan'] ?? '-' }} orang</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
