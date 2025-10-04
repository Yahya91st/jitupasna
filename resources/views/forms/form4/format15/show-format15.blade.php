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
                    <td>{{ $formData->nama_kampung ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Distrik</th>
                    <td>{{ $formData->nama_distrik ?? '-' }}</td>
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
                    @php
                        // Fasilitas 1 (Penginapan)
                        $fasilitas1_total_jumlah = ($formData->fasilitas_1_rb_tingkat ?? 0) + ($formData->fasilitas_1_rs_tingkat ?? 0) + ($formData->fasilitas_1_rr_tingkat ?? 0);
                        $fasilitas1_avg_harga = (($formData->fasilitas_1_rb_harga ?? 0) + ($formData->fasilitas_1_rs_harga ?? 0) + ($formData->fasilitas_1_rr_harga ?? 0)) / 3;
                        $fasilitas1_total_biaya = (($formData->fasilitas_1_rb_tingkat ?? 0) * ($formData->fasilitas_1_rb_harga ?? 0)) + 
                                                 (($formData->fasilitas_1_rs_tingkat ?? 0) * ($formData->fasilitas_1_rs_harga ?? 0)) + 
                                                 (($formData->fasilitas_1_rr_tingkat ?? 0) * ($formData->fasilitas_1_rr_harga ?? 0));
                        
                        // Fasilitas 2 (Restoran)
                        $fasilitas2_total_jumlah = ($formData->fasilitas_2_rb_tingkat ?? 0) + ($formData->fasilitas_2_rs_tingkat ?? 0) + ($formData->fasilitas_2_rr_tingkat ?? 0);
                        $fasilitas2_avg_harga = (($formData->fasilitas_2_rb_harga ?? 0) + ($formData->fasilitas_2_rs_harga ?? 0) + ($formData->fasilitas_2_rr_harga ?? 0)) / 3;
                        $fasilitas2_total_biaya = (($formData->fasilitas_2_rb_tingkat ?? 0) * ($formData->fasilitas_2_rb_harga ?? 0)) + 
                                                 (($formData->fasilitas_2_rs_tingkat ?? 0) * ($formData->fasilitas_2_rs_harga ?? 0)) + 
                                                 (($formData->fasilitas_2_rr_tingkat ?? 0) * ($formData->fasilitas_2_rr_harga ?? 0));
                        
                        // Fasilitas 3 (Objek Wisata)
                        $fasilitas3_total_jumlah = ($formData->fasilitas_3_rb_tingkat ?? 0) + ($formData->fasilitas_3_rs_tingkat ?? 0) + ($formData->fasilitas_3_rr_tingkat ?? 0);
                        $fasilitas3_avg_harga = (($formData->fasilitas_3_rb_harga ?? 0) + ($formData->fasilitas_3_rs_harga ?? 0) + ($formData->fasilitas_3_rr_harga ?? 0)) / 3;
                        $fasilitas3_total_biaya = (($formData->fasilitas_3_rb_tingkat ?? 0) * ($formData->fasilitas_3_rb_harga ?? 0)) + 
                                                 (($formData->fasilitas_3_rs_tingkat ?? 0) * ($formData->fasilitas_3_rs_harga ?? 0)) + 
                                                 (($formData->fasilitas_3_rr_tingkat ?? 0) * ($formData->fasilitas_3_rr_harga ?? 0));
                    @endphp
                    
                    <tr>
                        <td>{{ $formData->fasilitas_1_jenis ?? 'Penginapan / Homestay' }}</td>
                        <td>{{ $fasilitas1_total_jumlah > 0 ? $fasilitas1_total_jumlah : '-' }}</td>
                        <td>{{ $fasilitas1_avg_harga > 0 ? 'Rp ' . number_format($fasilitas1_avg_harga, 0, ',', '.') : '-' }}</td>
                        <td>{{ $fasilitas1_total_biaya > 0 ? 'Rp ' . number_format($fasilitas1_total_biaya, 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $formData->fasilitas_2_jenis ?? 'Restoran / Warung Wisata' }}</td>
                        <td>{{ $fasilitas2_total_jumlah > 0 ? $fasilitas2_total_jumlah : '-' }}</td>
                        <td>{{ $fasilitas2_avg_harga > 0 ? 'Rp ' . number_format($fasilitas2_avg_harga, 0, ',', '.') : '-' }}</td>
                        <td>{{ $fasilitas2_total_biaya > 0 ? 'Rp ' . number_format($fasilitas2_total_biaya, 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $formData->fasilitas_3_jenis ?? 'Objek Wisata (Pantai, Situs, dll)' }}</td>
                        <td>{{ $fasilitas3_total_jumlah > 0 ? $fasilitas3_total_jumlah : '-' }}</td>
                        <td>{{ $fasilitas3_avg_harga > 0 ? 'Rp ' . number_format($fasilitas3_avg_harga, 0, ',', '.') : '-' }}</td>
                        <td>{{ $fasilitas3_total_biaya > 0 ? 'Rp ' . number_format($fasilitas3_total_biaya, 0, ',', '.') : '-' }}</td>
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
                    <th width="60%">{{ $formData->kerugian_1_jenis ?? 'Jumlah Usaha Pariwisata Terdampak' }}</th>
                    <td>{{ $formData->kerugian_1_rb_nilai ?? ($formData->kerugian_1_rs_nilai ?? '-') }}</td>
                </tr>
                <tr>
                    <th>{{ $formData->kerugian_2_jenis ?? 'Rata-rata Pendapatan Harian' }}</th>
                    <td>{{ $formData->kerugian_2_rb_nilai ? 'Rp ' . number_format($formData->kerugian_2_rb_nilai, 0, ',', '.') : ($formData->kerugian_2_rs_nilai ? 'Rp ' . number_format($formData->kerugian_2_rs_nilai, 0, ',', '.') : '-') }}</td>
                </tr>
                <tr>
                    <th>{{ $formData->kerugian_3_jenis ?? 'Jumlah Hari Tutup Operasi' }}</th>
                    <td>{{ $formData->kerugian_3_rb_nilai ?? ($formData->kerugian_3_rs_nilai ?? '-') }} {{ $formData->kerugian_3_jenis ? '' : 'hari' }}</td>
                </tr>
                <tr>
                    <th>{{ $formData->kerugian_4_jenis ?? 'Kehilangan Wisatawan' }}</th>
                    <td>{{ $formData->kerugian_4_rb_nilai ?? ($formData->kerugian_4_rs_nilai ?? '-') }} {{ $formData->kerugian_4_jenis ? '' : 'orang' }}</td>
                </tr>
            </table>
        </div>
    </div>
    
    <!-- Total Summary -->
    <div class="card mb-5">
        <div class="card-header bg-success text-white">
            <h4 class="card-title">Total Ringkasan</h4>
        </div>
        <div class="card-body">
            @php
                $totalKerusakan = $fasilitas1_total_biaya + $fasilitas2_total_biaya + $fasilitas3_total_biaya;
                $totalKerugian = ($formData->kerugian_1_rb_nilai ?? 0) + ($formData->kerugian_1_rs_nilai ?? 0) +
                                ($formData->kerugian_2_rb_nilai ?? 0) + ($formData->kerugian_2_rs_nilai ?? 0) +
                                ($formData->kerugian_3_rb_nilai ?? 0) + ($formData->kerugian_3_rs_nilai ?? 0) +
                                ($formData->kerugian_4_rb_nilai ?? 0) + ($formData->kerugian_4_rs_nilai ?? 0);
                $grandTotal = $totalKerusakan + $totalKerugian;
            @endphp
            
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center">
                        <h5>Total Kerusakan Fasilitas</h5>
                        <h3 class="text-danger">Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <h5>Total Kerugian</h5>
                        <h3 class="text-warning">Rp {{ number_format($totalKerugian, 0, ',', '.') }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <h5>Grand Total</h5>
                        <h3 class="text-success">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
