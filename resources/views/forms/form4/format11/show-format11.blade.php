@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Data Format 11 - Sektor Peternakan</h1>
    
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
        <a href="{{ route('forms.form4.format11form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
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
            <h4 class="card-title">A. Kerusakan Bangunan & Sarana Peternakan</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Bangunan</th>
                        <th>Rusak Berat</th>
                        <th>Rusak Sedang</th>
                        <th>Rusak Ringan</th>
                        <th>Rata-rata Luas (m²)</th>
                        <th>Harga Satuan / m²</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Kandang Ternak</td>
                        <td>{{ $data['kandang_rb'] ?? '-' }}</td>
                        <td>{{ $data['kandang_rs'] ?? '-' }}</td>
                        <td>{{ $data['kandang_rr'] ?? '-' }}</td>
                        <td>{{ $data['kandang_luas'] ?? '-' }}</td>
                        <td>{{ $data['kandang_harga_m2'] ? 'Rp ' . number_format($data['kandang_harga_m2'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Gudang Pakan</td>
                        <td>{{ $data['gudang_pakan_rb'] ?? '-' }}</td>
                        <td>{{ $data['gudang_pakan_rs'] ?? '-' }}</td>
                        <td>{{ $data['gudang_pakan_rr'] ?? '-' }}</td>
                        <td>{{ $data['gudang_pakan_luas'] ?? '-' }}</td>
                        <td>{{ $data['gudang_pakan_harga_m2'] ? 'Rp ' . number_format($data['gudang_pakan_harga_m2'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Balai Inseminasi / Klinik Hewan</td>
                        <td>{{ $data['balai_inseminasi_rb'] ?? '-' }}</td>
                        <td>{{ $data['balai_inseminasi_rs'] ?? '-' }}</td>
                        <td>{{ $data['balai_inseminasi_rr'] ?? '-' }}</td>
                        <td>{{ $data['balai_inseminasi_luas'] ?? '-' }}</td>
                        <td>{{ $data['balai_inseminasi_harga_m2'] ? 'Rp ' . number_format($data['balai_inseminasi_harga_m2'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data['lainnya_jenis_bangunan'] ?? 'Lainnya:' }}</td>
                        <td>{{ $data['lainnya_bangunan_rb'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_bangunan_rs'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_bangunan_rr'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_bangunan_luas'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_bangunan_harga_m2'] ? 'Rp ' . number_format($data['lainnya_bangunan_harga_m2'], 0, ',', '.') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">B. Kerusakan Peralatan Peternakan</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Peralatan</th>
                        <th>Jumlah Rusak</th>
                        <th>Harga Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mesin Pencacah</td>
                        <td>{{ $data['mesin_pencacah_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['mesin_pencacah_harga'] ? 'Rp ' . number_format($data['mesin_pencacah_harga'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Mesin Pakan Ternak</td>
                        <td>{{ $data['mesin_pakan_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['mesin_pakan_harga'] ? 'Rp ' . number_format($data['mesin_pakan_harga'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Alat Penampung Susu</td>
                        <td>{{ $data['alat_penampung_susu_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['alat_penampung_susu_harga'] ? 'Rp ' . number_format($data['alat_penampung_susu_harga'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data['lainnya_jenis_peralatan'] ?? 'Lainnya:' }}</td>
                        <td>{{ $data['lainnya_peralatan_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_peralatan_harga'] ? 'Rp ' . number_format($data['lainnya_peralatan_harga'], 0, ',', '.') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">C. Kematian atau Hilangnya Ternak</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Ternak</th>
                        <th>Jumlah Ternak Hilang / Mati</th>
                        <th>Harga Rata-Rata / Ekor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sapi</td>
                        <td>{{ $data['sapi_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['sapi_harga'] ? 'Rp ' . number_format($data['sapi_harga'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Kambing</td>
                        <td>{{ $data['kambing_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['kambing_harga'] ? 'Rp ' . number_format($data['kambing_harga'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Ayam</td>
                        <td>{{ $data['ayam_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['ayam_harga'] ? 'Rp ' . number_format($data['ayam_harga'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Babi</td>
                        <td>{{ $data['babi_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['babi_harga'] ? 'Rp ' . number_format($data['babi_harga'], 0, ',', '.') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data['lainnya_jenis_ternak'] ?? 'Lainnya:' }}</td>
                        <td>{{ $data['lainnya_ternak_jumlah'] ?? '-' }}</td>
                        <td>{{ $data['lainnya_ternak_harga'] ? 'Rp ' . number_format($data['lainnya_ternak_harga'], 0, ',', '.') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card mb-5">
        <div class="card-header">
            <h4 class="card-title">D. Dampak Ekonomi dan Sosial</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="60%">Kehilangan Pendapatan Peternak</th>
                    <td>{{ $data['kehilangan_pendapatan'] ? 'Rp ' . number_format($data['kehilangan_pendapatan'], 0, ',', '.') : '-' }}</td>
                </tr>
                <tr>
                    <th>Penurunan Produksi (Susu, Daging, Telur)</th>
                    <td>{{ $data['penurunan_produksi'] ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Kenaikan Harga Pakan / Transportasi</th>
                    <td>{{ $data['kenaikan_harga_pakan'] ? 'Rp ' . number_format($data['kenaikan_harga_pakan'], 0, ',', '.') : '-' }}</td>
                </tr>
                <tr>
                    <th>Tambahan Biaya Kesehatan Ternak</th>
                    <td>{{ $data['biaya_kesehatan_ternak'] ? 'Rp ' . number_format($data['biaya_kesehatan_ternak'], 0, ',', '.') : '-' }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
