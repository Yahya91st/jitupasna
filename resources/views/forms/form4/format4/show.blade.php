@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel agar lebih kompak seperti format1form4 */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
</style>

<div class="container mt-4">
    <h5 class="text-center fw-bold">Detail Data Sektor Perlindungan Sosial<br>Format 4</h5>
    
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
            <td style="width: 50%"><strong>NAMA KAMPUNG:</strong> {{ $formSosial->nama_kampung ?? '-' }}</td>
            <td><strong>NAMA DISTRIK:</strong> {{ $formSosial->nama_distrik ?? '-' }}</td>
        </tr>
    </table>

    <h6 class="fw-bold mt-4">I. KERUSAKAN FISIK BANGUNAN / SARANA PELAYANAN SOSIAL</h6>

    <!-- Kerusakan Fisik Bangunan -->
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" style="width: 15%">Jenis Bangunan</th>
                    <th colspan="2" class="text-danger">Rusak Berat</th>
                    <th colspan="2" class="text-warning">Rusak Sedang</th>
                    <th colspan="2" class="text-info">Rusak Ringan</th>
                    <th rowspan="2" style="width: 15%">Harga Satuan</th>
                </tr>
                <tr>
                    <th style="width: 8%">Negeri</th>
                    <th style="width: 8%">Swasta</th>
                    <th style="width: 8%">Negeri</th>
                    <th style="width: 8%">Swasta</th>
                    <th style="width: 8%">Negeri</th>
                    <th style="width: 8%">Swasta</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-start"><strong>Panti Asuhan</strong></td>
                    <td>{{ $formSosial->panti_sosial_rb_negeri ?? 0 }}</td>
                    <td>{{ $formSosial->panti_sosial_rb_swasta ?? 0 }}</td>
                    <td>{{ $formSosial->panti_sosial_rs_negeri ?? 0 }}</td>
                    <td>{{ $formSosial->panti_sosial_rs_swasta ?? 0 }}</td>
                    <td>{{ $formSosial->panti_sosial_rr_negeri ?? 0 }}</td>
                    <td>{{ $formSosial->panti_sosial_rr_swasta ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($formSosial->panti_sosial_harga_bangunan ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-start"><strong>Panti Wredha</strong></td>
                    <td>{{ $formSosial->panti_asuhan_rb_negeri ?? 0 }}</td>
                    <td>{{ $formSosial->panti_asuhan_rb_swasta ?? 0 }}</td>
                    <td>{{ $formSosial->panti_asuhan_rs_negeri ?? 0 }}</td>
                    <td>{{ $formSosial->panti_asuhan_rs_swasta ?? 0 }}</td>
                    <td>{{ $formSosial->panti_asuhan_rr_negeri ?? 0 }}</td>
                    <td>{{ $formSosial->panti_asuhan_rr_swasta ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($formSosial->panti_asuhan_harga_bangunan ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-start"><strong>Panti Tuna Grahita</strong></td>
                    <td>{{ $formSosial->balai_pelayanan_rb_negeri ?? 0 }}</td>
                    <td>{{ $formSosial->balai_pelayanan_rb_swasta ?? 0 }}</td>
                    <td>{{ $formSosial->balai_pelayanan_rs_negeri ?? 0 }}</td>
                    <td>{{ $formSosial->balai_pelayanan_rs_swasta ?? 0 }}</td>
                    <td>{{ $formSosial->balai_pelayanan_rr_negeri ?? 0 }}</td>
                    <td>{{ $formSosial->balai_pelayanan_rr_swasta ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($formSosial->balai_pelayanan_harga_bangunan ?? 0, 0, ',', '.') }}</td>
                </tr>
                @if($formSosial->lainnya_jenis)
                <tr>
                    <td class="text-start"><strong>{{ $formSosial->lainnya_jenis }}</strong></td>
                    <td>{{ $formSosial->lainnya_rb_negeri ?? 0 }}</td>
                    <td>{{ $formSosial->lainnya_rb_swasta ?? 0 }}</td>
                    <td>{{ $formSosial->lainnya_rs_negeri ?? 0 }}</td>
                    <td>{{ $formSosial->lainnya_rs_swasta ?? 0 }}</td>
                    <td>{{ $formSosial->lainnya_rr_negeri ?? 0 }}</td>
                    <td>{{ $formSosial->lainnya_rr_swasta ?? 0 }}</td>
                    <td class="text-end">Rp {{ number_format($formSosial->lainnya_harga_bangunan ?? 0, 0, ',', '.') }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <h6 class="fw-bold mt-4">II. PERKIRAAN KERUGIAN</h6>
    <h6 class="fw-bold mt-4">II. PERKIRAAN KERUGIAN</h6>

    <!-- Biaya Pembersihan Puing -->
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th colspan="4">1. BIAYA PEMBERSIHAN PUING</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 25%"><strong>Tenaga Kerja</strong></td>
                <td style="width: 25%">{{ $formSosial->biaya_tenaga_kerja_hok ?? 0 }} HOK</td>
                <td style="width: 25%">Rp {{ number_format($formSosial->biaya_tenaga_kerja_upah ?? 0, 0, ',', '.') }}</td>
                <td style="width: 25%" class="text-end"><strong>Rp {{ number_format(($formSosial->biaya_tenaga_kerja_hok ?? 0) * ($formSosial->biaya_tenaga_kerja_upah ?? 0), 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td><strong>Alat Berat</strong></td>
                <td>{{ $formSosial->biaya_alat_berat_hari ?? 0 }} Hari</td>
                <td>Rp {{ number_format($formSosial->biaya_alat_berat_harga ?? 0, 0, ',', '.') }}</td>
                <td class="text-end"><strong>Rp {{ number_format(($formSosial->biaya_alat_berat_hari ?? 0) * ($formSosial->biaya_alat_berat_harga ?? 0), 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Biaya Penyediaan Jatah Hidup -->
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th colspan="4">2. BIAYA PENYEDIAAN JATAH HIDUP</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 25%"><strong>Jumlah Penerima</strong></td>
                <td style="width: 25%">{{ number_format($formSosial->jumlah_penerima ?? 0, 0, ',', '.') }} orang</td>
                <td style="width: 25%">Rp {{ number_format($formSosial->bantuan_per_orang ?? 0, 0, ',', '.') }}/orang</td>
                <td style="width: 25%" class="text-end"><strong>Rp {{ number_format(($formSosial->jumlah_penerima ?? 0) * ($formSosial->bantuan_per_orang ?? 0), 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Tambahan Biaya Sosial -->
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th colspan="2">3. TAMBAHAN BIAYA SOSIAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 60%"><strong>Biaya Pelayanan Kesehatan</strong></td>
                <td class="text-end">Rp {{ number_format($formSosial->biaya_pelayanan_kesehatan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Biaya Pelayanan Pendidikan</strong></td>
                <td class="text-end">Rp {{ number_format($formSosial->biaya_pelayanan_pendidikan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Biaya Pendampingan Psikososial</strong></td>
                <td class="text-end">Rp {{ number_format($formSosial->biaya_pendampingan_psikososial ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Biaya Pelatihan Darurat</strong></td>
                <td class="text-end">Rp {{ number_format($formSosial->biaya_pelatihan_darurat ?? 0, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Total Summary -->
    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">REKAPITULASI TOTAL</h6>
        </div>
        <div class="card-body text-center">
            <h4 class="mb-1">Rp {{ number_format($formSosial->total_kerusakan ?? 0, 0, ',', '.') }}</h4>
            <small>Total Keseluruhan Format 4</small>
        </div>
    </div>

    <div class="alert alert-info mt-3">
        <strong>Catatan:</strong> Sesuai dengan pedoman terbaru, semua item kerugian telah dipindahkan ke dalam total kerusakan untuk memberikan gambaran dampak keseluruhan yang lebih akurat.
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 mb-4">
        <a href="{{ route('forms.form4.list-format4', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali
        </a>
        <div>
            <a href="{{ route('forms.form4.edit-format4', $formSosial->id) }}" class="btn btn-warning me-2">
                Edit Data
            </a>
            <a href="{{ route('forms.form4.pdf-format4', $formSosial->id) }}" class="btn btn-primary" target="_blank">
                Unduh PDF
            </a>
        </div>
    </div>
</div>
@endsection
