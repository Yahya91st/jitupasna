@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel agar lebih kompak seperti format1form4 */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
</style>

<div class="container mt-4">
    <h5 class="text-center fw-bold">Detail Data Sektor Telekomunikasi<br>Format 9</h5>
    
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
            <td style="width: 50%"><strong>NAMA KAMPUNG:</strong> {{ $formTelekomunikasi->nama_kampung ?? '-' }}</td>
            <td><strong>NAMA DISTRIK:</strong> {{ $formTelekomunikasi->nama_distrik ?? '-' }}</td>
        </tr>
    </table>

    <h6 class="fw-bold mt-4">I. KERUSAKAN INFRASTRUKTUR TELEKOMUNIKASI</h6>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" style="width: 20%">Jenis Infrastruktur</th>
                    <th colspan="3">Tingkat Kerusakan</th>
                    <th rowspan="2" style="width: 20%">Harga Satuan</th>
                    <th rowspan="2" style="width: 20%">Total Kerusakan</th>
                </tr>
                <tr>
                    <th style="width: 10%">Rusak Berat</th>
                    <th style="width: 10%">Rusak Sedang</th>
                    <th style="width: 10%">Rusak Ringan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-start"><strong>Menara/BTS</strong></td>
                    <td>{{ $formTelekomunikasi->bts_rb ?? 0 }}</td>
                    <td>{{ $formTelekomunikasi->bts_rs ?? 0 }}</td>
                    <td>{{ $formTelekomunikasi->bts_rr ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($formTelekomunikasi->bts_harga_unit ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format(($formTelekomunikasi->kerusakan_1_jumlah_unit ?? 0) * ($formTelekomunikasi->kerusakan_1_harga_satuan ?? 0), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-start"><strong>Kantor</strong></td>
                    <td>{{ $formTelekomunikasi->kantor_rb ?? 0 }}</td>
                    <td>{{ $formTelekomunikasi->kantor_rs ?? 0 }}</td>
                    <td>{{ $formTelekomunikasi->kantor_rr ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($formTelekomunikasi->kantor_harga_m2 ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format(($formTelekomunikasi->kerusakan_2_jumlah_unit ?? 0) * ($formTelekomunikasi->kerusakan_2_harga_satuan ?? 0), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-start"><strong>Pemancar</strong></td>
                    <td>{{ $formTelekomunikasi->pemancar_rb ?? 0 }}</td>
                    <td>{{ $formTelekomunikasi->pemancar_rs ?? 0 }}</td>
                    <td>{{ $formTelekomunikasi->pemancar_rr ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($formTelekomunikasi->pemancar_harga_unit ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format(($formTelekomunikasi->kerusakan_3_jumlah_unit ?? 0) * ($formTelekomunikasi->kerusakan_3_harga_satuan ?? 0), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-start"><strong>Kabel</strong></td>
                    <td>{{ $formTelekomunikasi->kabel_rb ?? 0 }}</td>
                    <td>{{ $formTelekomunikasi->kabel_rs ?? 0 }}</td>
                    <td>{{ $formTelekomunikasi->kabel_rr ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($formTelekomunikasi->kabel_harga_meter ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format(($formTelekomunikasi->kerusakan_4_jumlah_unit ?? 0) * ($formTelekomunikasi->kerusakan_4_harga_satuan ?? 0), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-start"><strong>Server</strong></td>
                    <td>{{ $formTelekomunikasi->server_rb ?? 0 }}</td>
                    <td>{{ $formTelekomunikasi->server_rs ?? 0 }}</td>
                    <td>{{ $formTelekomunikasi->server_rr ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($formTelekomunikasi->server_harga_unit ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format(($formTelekomunikasi->jangka_waktu_unit ?? 0) * ($formTelekomunikasi->jangka_waktu_harga_satuan ?? 0), 0, ',', '.') }}</td>
                </tr>
                @if($formTelekomunikasi->lainnya_jenis)
                <tr>
                    <td class="text-start"><strong>{{ $formTelekomunikasi->lainnya_jenis }}</strong></td>
                    <td>{{ $formTelekomunikasi->lainnya_rb ?? 0 }}</td>
                    <td>{{ $formTelekomunikasi->lainnya_rs ?? 0 }}</td>
                    <td>{{ $formTelekomunikasi->lainnya_rr ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($formTelekomunikasi->lainnya_harga_unit ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format(0, 0, ',', '.') }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <h6 class="fw-bold mt-4">II. BIAYA PEMULIHAN DAN RESPONS DARURAT</h6>
            
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 30%">Jenis Kegiatan</th>
                <th style="width: 40%">Rincian Perhitungan</th>
                <th style="width: 30%">Total Biaya</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Tenaga Kerja Pembersihan</strong></td>
                <td>{{ $formTelekomunikasi->biaya_tenaga_kerja_hok ?? 0 }} HOK × Rp {{ number_format($formTelekomunikasi->biaya_tenaga_kerja_upah ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format(($formTelekomunikasi->biaya_tenaga_kerja_hok ?? 0) * ($formTelekomunikasi->biaya_tenaga_kerja_upah ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Alat Berat</strong></td>
                <td>{{ $formTelekomunikasi->biaya_alat_berat_hari ?? 0 }} Hari × Rp {{ number_format($formTelekomunikasi->biaya_alat_berat_sewa ?? 0, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format(($formTelekomunikasi->biaya_alat_berat_hari ?? 0) * ($formTelekomunikasi->biaya_alat_berat_sewa ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Komunikasi Darurat</strong></td>
                <td>{{ $formTelekomunikasi->alat_komunikasi_jumlah ?? 0 }} Unit × Rp {{ number_format($formTelekomunikasi->alat_komunikasi_harga_sewa ?? 0, 0, ',', '.') }} × {{ $formTelekomunikasi->alat_komunikasi_durasi_hari ?? 0 }} Hari</td>
                <td class="text-end">Rp {{ number_format(($formTelekomunikasi->biaya_operasional_pasca_unit ?? 0) * ($formTelekomunikasi->biaya_operasional_pasca_harga_satuan ?? 0), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
            
    <h6 class="fw-bold mt-4">III. KERUGIAN PENDAPATAN OPERASIONAL</h6>
            
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th style="width: 20%">Jumlah Pelanggan</th>
                <th style="width: 20%">Rata-rata Penggunaan</th>
                <th style="width: 20%">Tarif per Unit</th>
                <th style="width: 20%">Durasi Gangguan</th>
                <th style="width: 20%">Total Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">{{ number_format($formTelekomunikasi->jumlah_pelanggan_terdampak ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $formTelekomunikasi->rata_rata_penggunaan_per_pelanggan ?? 0 }}</td>
                <td class="text-center">Rp {{ number_format($formTelekomunikasi->tarif_komunikasi ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $formTelekomunikasi->durasi_gangguan_hari ?? 0 }} Hari</td>
                <td class="text-center">Rp {{ number_format(($formTelekomunikasi->penurunan_pendapatan_unit ?? 0) * ($formTelekomunikasi->penurunan_pendapatan_harga_satuan ?? 0), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Total Summary -->
    @php
        $totalKerusakan = $formTelekomunikasi->total_kerusakan ?? 0;
        $totalKerugian = $formTelekomunikasi->total_kerugian ?? 0;
        $grandTotal = $totalKerusakan + $totalKerugian;
    @endphp

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">REKAPITULASI TOTAL</h6>
        </div>
        <div class="card-body text-center">
            <h4 class="mb-1">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>
            <small>Total Keseluruhan Format 9</small>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 mb-4">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali
        </a>
        <div>
            <a href="{{ route('forms.form4.list-format9', ['bencana_id' => $bencana->id]) }}" class="btn btn-info me-2">
                Daftar Laporan
            </a>
            <a href="{{ route('forms.form4.format9.pdf', $formTelekomunikasi->id) }}" class="btn btn-primary" target="_blank">
                Unduh PDF
            </a>
        </div>
    </div>
</div>
@endsection
