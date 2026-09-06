@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel agar lebih kompak seperti format1form4 */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
</style>

<div class="container mt-4">
    <h5 class="text-center fw-bold">Detail Data Sektor Perdagangan<br>Format 14</h5>
    
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
            <td style="width: 50%"><strong>NAMA KAMPUNG:</strong> {{ $data['nama_kampung'] ?? '-' }}</td>
            <td><strong>NAMA DISTRIK:</strong> {{ $data['nama_distrik'] ?? '-' }}</td>
        </tr>
    </table>

    <h6 class="fw-bold mt-4">I. KERUSAKAN FISIK BANGUNAN USAHA</h6>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 25%">Jenis Bangunan Usaha</th>
                    <th style="width: 15%">Jumlah Rusak</th>
                    <th style="width: 15%">Luas Rata-rata (m²)</th>
                    <th style="width: 20%">Harga Satuan / m²</th>
                    <th style="width: 25%">Total Kerugian</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-start"><strong>Toko Kecil</strong></td>
                    <td>{{ $data['toko_kecil_jumlah'] ?? 0 }}</td>
                    <td>{{ $data['toko_kecil_luas'] ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($data['toko_kecil_harga'] ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($data['toko_kecil_total'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-start"><strong>Kios Pasar</strong></td>
                    <td>{{ $data['kios_pasar_jumlah'] ?? 0 }}</td>
                    <td>{{ $data['kios_pasar_luas'] ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($data['kios_pasar_harga'] ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($data['kios_pasar_total'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-start"><strong>Grosir</strong></td>
                    <td>{{ $data['grosir_jumlah'] ?? 0 }}</td>
                    <td>{{ $data['grosir_luas'] ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($data['grosir_harga'] ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($data['grosir_total'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                @if($data['lainnya_jenis_bangunan'])
                <tr>
                    <td class="text-start"><strong>{{ $data['lainnya_jenis_bangunan'] }}</strong></td>
                    <td>{{ $data['lainnya_bangunan_jumlah'] ?? 0 }}</td>
                    <td>{{ $data['lainnya_bangunan_luas'] ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($data['lainnya_bangunan_harga'] ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($data['lainnya_bangunan_total'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <h6 class="fw-bold mt-4">II. KERUSAKAN BARANG DAGANGAN</h6>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 40%">Jenis Barang</th>
                <th style="width: 20%">Jumlah</th>
                <th style="width: 20%">Harga Satuan</th>
                <th style="width: 20%">Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Beras</strong></td>
                <td class="text-center">{{ $data['beras_jumlah'] ?? 0 }}</td>
                <td class="text-end">Rp {{ number_format($data['beras_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['beras_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Minyak Goreng</strong></td>
                <td class="text-center">{{ $data['minyak_jumlah'] ?? 0 }}</td>
                <td class="text-end">Rp {{ number_format($data['minyak_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['minyak_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Pakaian</strong></td>
                <td class="text-center">{{ $data['pakaian_jumlah'] ?? 0 }}</td>
                <td class="text-end">Rp {{ number_format($data['pakaian_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['pakaian_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Peralatan Elektronik</strong></td>
                <td class="text-center">{{ $data['elektronik_jumlah'] ?? 0 }}</td>
                <td class="text-end">Rp {{ number_format($data['elektronik_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['elektronik_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @if($data['lainnya_jenis_barang'])
            <tr>
                <td><strong>{{ $data['lainnya_jenis_barang'] }}</strong></td>
                <td class="text-center">{{ $data['lainnya_barang_jumlah'] ?? 0 }}</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_barang_harga'] ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($data['lainnya_barang_total'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <h6 class="fw-bold mt-4">III. KEHILANGAN PENDAPATAN</h6>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 60%">Jenis Dampak</th>
                <th style="width: 40%">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Jumlah Pelaku Usaha</strong></td>
                <td class="text-center">{{ $data['jumlah_pelaku_usaha'] ?? 0 }} orang</td>
            </tr>
            <tr>
                <td><strong>Rata-rata Pendapatan Harian</strong></td>
                <td class="text-end">Rp {{ number_format($data['pendapatan_harian'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Lama Tidak Operasi</strong></td>
                <td class="text-center">{{ $data['lama_tidak_operasi'] ?? 0 }} hari</td>
            </tr>
        </tbody>
    </table>

    <!-- Total Summary -->
    @php
        $totalKerusakanBangunan = ($data['toko_kecil_total'] ?? 0) + ($data['kios_pasar_total'] ?? 0) + ($data['grosir_total'] ?? 0) + ($data['lainnya_bangunan_total'] ?? 0);
        $totalKerusakanBarang = ($data['beras_total'] ?? 0) + ($data['minyak_total'] ?? 0) + ($data['pakaian_total'] ?? 0) + ($data['elektronik_total'] ?? 0) + ($data['lainnya_barang_total'] ?? 0);
        $totalKehilanganPendapatan = ($data['jumlah_pelaku_usaha'] ?? 0) * ($data['pendapatan_harian'] ?? 0) * ($data['lama_tidak_operasi'] ?? 0);
        $grandTotal = $totalKerusakanBangunan + $totalKerusakanBarang + $totalKehilanganPendapatan;
    @endphp

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">REKAPITULASI TOTAL</h6>
        </div>
        <div class="card-body text-center">
            <h4 class="mb-1">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>
            <small>Total Keseluruhan Format 14</small>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 mb-4">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali
        </a>
        <div>
            <a href="{{ route('forms.form4.format14form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                Tambah Data Baru
            </a>
        </div>
    </div>
</div>
@endsection
