@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel agar lebih kompak seperti format1form4 */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
</style>

<div class="container mt-4">
    <h5 class="text-center fw-bold">Detail Data Sektor Pariwisata<br>Format 15</h5>
    
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
            <td style="width: 50%"><strong>NAMA KAMPUNG:</strong> {{  $form->nama_kampung ?? '-' }}</td>
            <td><strong>NAMA DISTRIK:</strong> {{  $form->nama_distrik ?? '-' }}</td>
        </tr>
    </table>

    <h6 class="fw-bold mt-4">I. KERUSAKAN SARANA & OBJEK WISATA</h6>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 25%">Jenis Sarana</th>
                    <th style="width: 15%">Jumlah Rusak</th>
                    <th style="width: 20%">Harga Satuan</th>
                    <th style="width: 25%">Total Kerugian</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Fasilitas 1 (Penginapan)
                    $fasilitas1_total_jumlah = ( $form->fasilitas_1_rb_tingkat ?? 0) + ( $form->fasilitas_1_rs_tingkat ?? 0) + ( $form->fasilitas_1_rr_tingkat ?? 0);
                    $fasilitas1_avg_harga = (( $form->fasilitas_1_rb_harga ?? 0) + ( $form->fasilitas_1_rs_harga ?? 0) + ( $form->fasilitas_1_rr_harga ?? 0)) / 3;
                    $fasilitas1_total_biaya = (( $form->fasilitas_1_rb_tingkat ?? 0) * ( $form->fasilitas_1_rb_harga ?? 0)) + 
                                             (( $form->fasilitas_1_rs_tingkat ?? 0) * ( $form->fasilitas_1_rs_harga ?? 0)) + 
                                             (( $form->fasilitas_1_rr_tingkat ?? 0) * ( $form->fasilitas_1_rr_harga ?? 0));
                    
                    // Fasilitas 2 (Restoran)
                    $fasilitas2_total_jumlah = ( $form->fasilitas_2_rb_tingkat ?? 0) + ( $form->fasilitas_2_rs_tingkat ?? 0) + ( $form->fasilitas_2_rr_tingkat ?? 0);
                    $fasilitas2_avg_harga = (( $form->fasilitas_2_rb_harga ?? 0) + ( $form->fasilitas_2_rs_harga ?? 0) + ( $form->fasilitas_2_rr_harga ?? 0)) / 3;
                    $fasilitas2_total_biaya = (( $form->fasilitas_2_rb_tingkat ?? 0) * ( $form->fasilitas_2_rb_harga ?? 0)) + 
                                             (( $form->fasilitas_2_rs_tingkat ?? 0) * ( $form->fasilitas_2_rs_harga ?? 0)) + 
                                             (( $form->fasilitas_2_rr_tingkat ?? 0) * ( $form->fasilitas_2_rr_harga ?? 0));
                    
                    // Fasilitas 3 (Objek Wisata)
                    $fasilitas3_total_jumlah = ( $form->fasilitas_3_rb_tingkat ?? 0) + ( $form->fasilitas_3_rs_tingkat ?? 0) + ( $form->fasilitas_3_rr_tingkat ?? 0);
                    $fasilitas3_avg_harga = (( $form->fasilitas_3_rb_harga ?? 0) + ( $form->fasilitas_3_rs_harga ?? 0) + ( $form->fasilitas_3_rr_harga ?? 0)) / 3;
                    $fasilitas3_total_biaya = (( $form->fasilitas_3_rb_tingkat ?? 0) * ( $form->fasilitas_3_rb_harga ?? 0)) + 
                                             (( $form->fasilitas_3_rs_tingkat ?? 0) * ( $form->fasilitas_3_rs_harga ?? 0)) + 
                                             (( $form->fasilitas_3_rr_tingkat ?? 0) * ( $form->fasilitas_3_rr_harga ?? 0));
                @endphp
                
                <tr>
                    <td class="text-start"><strong>{{  $form->fasilitas_1_jenis ?? 'Penginapan / Homestay' }}</strong></td>
                    <td>{{ $fasilitas1_total_jumlah }}</td>
                    <td class="text-end">Rp {{ number_format($fasilitas1_avg_harga, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($fasilitas1_total_biaya, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-start"><strong>{{  $form->fasilitas_2_jenis ?? 'Restoran / Warung Wisata' }}</strong></td>
                    <td>{{ $fasilitas2_total_jumlah }}</td>
                    <td class="text-end">Rp {{ number_format($fasilitas2_avg_harga, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($fasilitas2_total_biaya, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-start"><strong>{{  $form->fasilitas_3_jenis ?? 'Objek Wisata (Pantai, Situs, dll)' }}</strong></td>
                    <td>{{ $fasilitas3_total_jumlah }}</td>
                    <td class="text-end">Rp {{ number_format($fasilitas3_avg_harga, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($fasilitas3_total_biaya, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h6 class="fw-bold mt-4">II. KEHILANGAN PENDAPATAN</h6>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 60%">Jenis Dampak</th>
                <th style="width: 40%">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>{{  $form->kerugian_1_jenis ?? 'Jumlah Usaha Pariwisata Terdampak' }}</strong></td>
                <td class="text-center">{{  $form->kerugian_1_rb_nilai ?? ( $form->kerugian_1_rs_nilai ?? 0) }} unit</td>
            </tr>
            <tr>
                <td><strong>{{  $form->kerugian_2_jenis ?? 'Rata-rata Pendapatan Harian' }}</strong></td>
                <td class="text-end">Rp {{ number_format( $form->kerugian_2_rb_nilai ?? ( $form->kerugian_2_rs_nilai ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>{{  $form->kerugian_3_jenis ?? 'Jumlah Hari Tutup Operasi' }}</strong></td>
                <td class="text-center">{{  $form->kerugian_3_rb_nilai ?? ( $form->kerugian_3_rs_nilai ?? 0) }} hari</td>
            </tr>
            <tr>
                <td><strong>{{  $form->kerugian_4_jenis ?? 'Kehilangan Wisatawan' }}</strong></td>
                <td class="text-center">{{  $form->kerugian_4_rb_nilai ?? ( $form->kerugian_4_rs_nilai ?? 0) }} orang</td>
            </tr>
        </tbody>
    </table>

    <!-- Total Summary -->
    @php
        $totalKerusakan = $fasilitas1_total_biaya + $fasilitas2_total_biaya + $fasilitas3_total_biaya;
        $totalKerugian = ( $form->kerugian_1_rb_nilai ?? 0) + ( $form->kerugian_1_rs_nilai ?? 0) +
                        ( $form->kerugian_2_rb_nilai ?? 0) + ( $form->kerugian_2_rs_nilai ?? 0) +
                        ( $form->kerugian_3_rb_nilai ?? 0) + ( $form->kerugian_3_rs_nilai ?? 0) +
                        ( $form->kerugian_4_rb_nilai ?? 0) + ( $form->kerugian_4_rs_nilai ?? 0);
        $grandTotal = $totalKerusakan + $totalKerugian;
    @endphp

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">REKAPITULASI TOTAL</h6>
        </div>
        <div class="card-body text-center">
            <h4 class="mb-1">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>
            <small>Total Keseluruhan Format 15</small>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 mb-4">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali
        </a>
        <div>
            <a href="{{ route('forms.form4.format15form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                Tambah Data Baru
            </a>
        </div>
    </div>
</div>
@endsection
