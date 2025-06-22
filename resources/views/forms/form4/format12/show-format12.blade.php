@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Data Format 12 - Sektor Perikanan</h1>
    
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
        <a href="{{ route('forms.form4.format12form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
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
            <h4 class="card-title">A. Kerusakan Sarana Budidaya</h4>
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
                        <td>Kolam Ikan</td>
                        <td>{{ $data['kolam_ikan_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['kolam_ikan_harga'] ? 'Rp ' . number_format($data['kolam_ikan_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['kolam_ikan_total'] ? 'Rp ' . number_format($data['kolam_ikan_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tambak</td>
                        <td>{{ $data['tambak_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['tambak_harga'] ? 'Rp ' . number_format($data['tambak_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['tambak_total'] ? 'Rp ' . number_format($data['tambak_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Keramba</td>
                        <td>{{ $data['keramba_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['keramba_harga'] ? 'Rp ' . number_format($data['keramba_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['keramba_total'] ? 'Rp ' . number_format($data['keramba_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Hatchery (Balai Benih)</td>
                        <td>{{ $data['hatchery_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['hatchery_harga'] ? 'Rp ' . number_format($data['hatchery_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['hatchery_total'] ? 'Rp ' . number_format($data['hatchery_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data['lainnya_jenis_sarana'] ?? 'Lainnya:' }}</td>
                        <td>{{ $data['lainnya_sarana_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_sarana_harga'] ? 'Rp ' . number_format($data['lainnya_sarana_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['lainnya_sarana_total'] ? 'Rp ' . number_format($data['lainnya_sarana_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">B. Kerusakan Sarana Tangkap</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Alat Tangkap</th>
                        <th>Jumlah Rusak</th>
                        <th>Harga Satuan</th>
                        <th>Total Kerugian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Perahu Motor</td>
                        <td>{{ $data['perahu_motor_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['perahu_motor_harga'] ? 'Rp ' . number_format($data['perahu_motor_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['perahu_motor_total'] ? 'Rp ' . number_format($data['perahu_motor_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Perahu Dayung</td>
                        <td>{{ $data['perahu_dayung_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['perahu_dayung_harga'] ? 'Rp ' . number_format($data['perahu_dayung_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['perahu_dayung_total'] ? 'Rp ' . number_format($data['perahu_dayung_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Jaring Insang</td>
                        <td>{{ $data['jaring_insang_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['jaring_insang_harga'] ? 'Rp ' . number_format($data['jaring_insang_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['jaring_insang_total'] ? 'Rp ' . number_format($data['jaring_insang_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Jaring Purse Seine</td>
                        <td>{{ $data['jaring_purse_seine_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['jaring_purse_seine_harga'] ? 'Rp ' . number_format($data['jaring_purse_seine_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['jaring_purse_seine_total'] ? 'Rp ' . number_format($data['jaring_purse_seine_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Alat Penangkap Lain</td>
                        <td>{{ $data['alat_penangkap_lain_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['alat_penangkap_lain_harga'] ? 'Rp ' . number_format($data['alat_penangkap_lain_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['alat_penangkap_lain_total'] ? 'Rp ' . number_format($data['alat_penangkap_lain_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">C. Kematian/Hilangnya Hasil Perikanan</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Ikan</th>
                        <th>Jumlah (Kg)</th>
                        <th>Harga per Kg</th>
                        <th>Total Nilai Kerugian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ikan Lele</td>
                        <td>{{ $data['ikan_lele_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['ikan_lele_harga'] ? 'Rp ' . number_format($data['ikan_lele_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['ikan_lele_total'] ? 'Rp ' . number_format($data['ikan_lele_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Ikan Nila</td>
                        <td>{{ $data['ikan_nila_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['ikan_nila_harga'] ? 'Rp ' . number_format($data['ikan_nila_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['ikan_nila_total'] ? 'Rp ' . number_format($data['ikan_nila_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Udang</td>
                        <td>{{ $data['udang_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['udang_harga'] ? 'Rp ' . number_format($data['udang_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['udang_total'] ? 'Rp ' . number_format($data['udang_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Bandeng</td>
                        <td>{{ $data['bandeng_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['bandeng_harga'] ? 'Rp ' . number_format($data['bandeng_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['bandeng_total'] ? 'Rp ' . number_format($data['bandeng_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data['lainnya_jenis_ikan'] ?? 'Lainnya:' }}</td>
                        <td>{{ $data['lainnya_ikan_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_ikan_harga'] ? 'Rp ' . number_format($data['lainnya_ikan_harga'], 0, ',', '.') : '-' }}</td>
                        <td>{{ $data['lainnya_ikan_total'] ? 'Rp ' . number_format($data['lainnya_ikan_total'], 0, ',', '.') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">D. Dampak Ekonomi</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="60%">Kehilangan Pendapatan Harian Nelayan</th>
                    <td>{{ $data['kehilangan_pendapatan_harian'] ? 'Rp ' . number_format($data['kehilangan_pendapatan_harian'], 0, ',', '.') : '-' }}</td>
                </tr>
                <tr>
                    <th>Rata-rata Hari Tidak Melaut</th>
                    <td>{{ $data['hari_tidak_melaut'] ?? '-' }} hari</td>
                </tr>
                <tr>
                    <th>Biaya Sewa Alat Tangkap Darurat</th>
                    <td>{{ $data['biaya_sewa_alat'] ? 'Rp ' . number_format($data['biaya_sewa_alat'], 0, ',', '.') : '-' }}</td>
                </tr>
                <tr>
                    <th>Kenaikan Harga Pakan/BBM</th>
                    <td>{{ $data['kenaikan_harga_pakan'] ? 'Rp ' . number_format($data['kenaikan_harga_pakan'], 0, ',', '.') : '-' }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
