@extends('layouts.main')

@section('content')
<style>
    .table th, .table td { padding: 0.5rem; }
    .btn { margin: 0.25rem; }
    h5 { text-align: center; margin-bottom: 1rem; }
</style>

<div class="container-fluid">
    <h5>Data Format 12 - Sektor Perikanan</h5>
    
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
    <h6 class="fw-bold mt-4">I. KERUSAKAN SARANA BUDIDAYA</h6>
    
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 30%">Jenis Sarana</th>
                <th style="width: 20%">Jumlah Rusak</th>
                <th style="width: 25%">Harga Satuan</th>
                <th style="width: 25%">Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Kolam Ikan</strong></td>
                <td class="text-center">{{ $data['kolam_ikan_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['kolam_ikan_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['kolam_ikan_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Tambak</strong></td>
                <td class="text-center">{{ $data['tambak_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['tambak_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['tambak_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Keramba</strong></td>
                <td class="text-center">{{ $data['keramba_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['keramba_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['keramba_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Hatchery (Balai Benih)</strong></td>
                <td class="text-center">{{ $data['hatchery_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['hatchery_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['hatchery_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @if($data['lainnya_jenis_sarana'])
            <tr>
                <td><strong>{{ $data['lainnya_jenis_sarana'] }}</strong></td>
                <td class="text-center">{{ $data['lainnya_sarana_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_sarana_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_sarana_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <h6 class="fw-bold mt-4">II. KERUSAKAN SARANA TANGKAP</h6>
    
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 30%">Jenis Alat Tangkap</th>
                <th style="width: 20%">Jumlah Rusak</th>
                <th style="width: 25%">Harga Satuan</th>
                <th style="width: 25%">Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Perahu Motor</strong></td>
                <td class="text-center">{{ $data['perahu_motor_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['perahu_motor_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['perahu_motor_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Perahu Dayung</strong></td>
                <td class="text-center">{{ $data['perahu_dayung_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['perahu_dayung_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['perahu_dayung_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Jaring Insang</strong></td>
                <td class="text-center">{{ $data['jaring_insang_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['jaring_insang_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['jaring_insang_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Jaring Purse Seine</strong></td>
                <td class="text-center">{{ $data['jaring_purse_seine_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['jaring_purse_seine_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['jaring_purse_seine_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Alat Penangkap Lain</strong></td>
                <td class="text-center">{{ $data['alat_penangkap_lain_jumlah'] ?? 0 }} unit</td>
                <td class="text-end">Rp {{ number_format($data['alat_penangkap_lain_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['alat_penangkap_lain_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <h6 class="fw-bold mt-4">III. KEMATIAN/HILANGNYA HASIL PERIKANAN</h6>
    
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 30%">Jenis Ikan</th>
                <th style="width: 20%">Jumlah (Kg)</th>
                <th style="width: 25%">Harga per Kg</th>
                <th style="width: 25%">Total Nilai Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Ikan Lele</strong></td>
                <td class="text-center">{{ $data['ikan_lele_jumlah'] ?? 0 }} kg</td>
                <td class="text-end">Rp {{ number_format($data['ikan_lele_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['ikan_lele_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Ikan Nila</strong></td>
                <td class="text-center">{{ $data['ikan_nila_jumlah'] ?? 0 }} kg</td>
                <td class="text-end">Rp {{ number_format($data['ikan_nila_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['ikan_nila_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Udang</strong></td>
                <td class="text-center">{{ $data['udang_jumlah'] ?? 0 }} kg</td>
                <td class="text-end">Rp {{ number_format($data['udang_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['udang_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Bandeng</strong></td>
                <td class="text-center">{{ $data['bandeng_jumlah'] ?? 0 }} kg</td>
                <td class="text-end">Rp {{ number_format($data['bandeng_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['bandeng_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @if($data['lainnya_jenis_ikan'])
            <tr>
                <td><strong>{{ $data['lainnya_jenis_ikan'] }}</strong></td>
                <td class="text-center">{{ $data['lainnya_ikan_jumlah'] ?? 0 }} kg</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_ikan_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_ikan_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <h6 class="fw-bold mt-4">IV. DAMPAK EKONOMI</h6>
    
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 60%">Jenis Dampak</th>
                <th style="width: 40%">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Kehilangan Pendapatan Harian Nelayan</strong></td>
                <td class="text-end">Rp {{ number_format($data['kehilangan_pendapatan_harian'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Rata-rata Hari Tidak Melaut</strong></td>
                <td class="text-center">{{ $data['hari_tidak_melaut'] ?? 0 }} hari</td>
            </tr>
            <tr>
                <td><strong>Biaya Sewa Alat Tangkap Darurat</strong></td>
                <td class="text-end">Rp {{ number_format($data['biaya_sewa_alat'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Kenaikan Harga Pakan/BBM</strong></td>
                <td class="text-end">Rp {{ number_format($data['kenaikan_harga_pakan'] ?? 0, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Total Summary -->
    @php
        // Hitung total kerusakan sarana budidaya
        $totalSaranaBudidaya = ($data['kolam_ikan_total'] ?? 0) + 
                               ($data['tambak_total'] ?? 0) + 
                               ($data['keramba_total'] ?? 0) + 
                               ($data['hatchery_total'] ?? 0) + 
                               ($data['lainnya_sarana_total'] ?? 0);
        
        // Hitung total kerusakan sarana tangkap
        $totalSaranaTangkap = ($data['perahu_motor_total'] ?? 0) + 
                              ($data['perahu_dayung_total'] ?? 0) + 
                              ($data['jaring_insang_total'] ?? 0) + 
                              ($data['jaring_purse_seine_total'] ?? 0) + 
                              ($data['alat_penangkap_lain_total'] ?? 0);
        
        // Hitung total kerugian ikan
        $totalKerugianIkan = ($data['ikan_lele_total'] ?? 0) + 
                             ($data['ikan_nila_total'] ?? 0) + 
                             ($data['udang_total'] ?? 0) + 
                             ($data['bandeng_total'] ?? 0) + 
                             ($data['lainnya_ikan_total'] ?? 0);
        
        // Hitung total dampak ekonomi
        $totalDampakEkonomi = ($data['kehilangan_pendapatan_harian'] ?? 0) + 
                              ($data['biaya_sewa_alat'] ?? 0) + 
                              ($data['kenaikan_harga_pakan'] ?? 0);
        
        $grandTotal = $totalSaranaBudidaya + $totalSaranaTangkap + $totalKerugianIkan + $totalDampakEkonomi;
    @endphp

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">REKAPITULASI TOTAL</h6>
        </div>
        <div class="card-body text-center">
            <h4 class="mb-1">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>
            <small>Total Keseluruhan Format 12</small>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 mb-4">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali
        </a>
        <div>
            <a href="{{ route('forms.form4.format12form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                Tambah Data Baru
            </a>
        </div>
    </div>
</div>
@endsection
