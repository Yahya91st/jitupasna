@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Data Format 4 - Sektor Perlindungan Sosial</h1>
    
    @if($bencana)
        <div class="alert alert-light-primary color-primary mb-4">
            <p><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama }}</p>
            <p><strong>Tanggal:</strong> {{ $bencana->tanggal }}</p>
            <p><strong>Lokasi:</strong> 
                @foreach($bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            </p>
        </div>
    @endif
    
    <div class="mb-4 d-flex justify-content-between">
        <a href="{{ route('forms.form4.list-format4', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali ke List
        </a>
        <a href="{{ route('forms.form4.edit-format4', $formSosial->id) }}" class="btn btn-warning">
            <i class="fa fa-edit mr-2"></i> Edit Data
        </a>
    </div>
    
    <!-- Data Lokasi -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Lokasi</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama Kampung:</strong> {{ $formSosial->nama_kampung }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Nama Distrik:</strong> {{ $formSosial->nama_distrik }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Kerusakan Fisik Bangunan -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">A. Kerusakan Fisik Bangunan / Sarana Pelayanan Sosial</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Jenis Bangunan</th>
                            <th>Rusak Berat (Negeri)</th>
                            <th>Rusak Berat (Swasta)</th>
                            <th>Rusak Sedang (Negeri)</th>
                            <th>Rusak Sedang (Swasta)</th>
                            <th>Rusak Ringan (Negeri)</th>
                            <th>Rusak Ringan (Swasta)</th>
                            <th>Harga Satuan Bangunan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Panti Asuhan</strong></td>
                            <td>{{ $formSosial->panti_sosial_rb_negeri ?? 0 }}</td>
                            <td>{{ $formSosial->panti_sosial_rb_swasta ?? 0 }}</td>
                            <td>{{ $formSosial->panti_sosial_rs_negeri ?? 0 }}</td>
                            <td>{{ $formSosial->panti_sosial_rs_swasta ?? 0 }}</td>
                            <td>{{ $formSosial->panti_sosial_rr_negeri ?? 0 }}</td>
                            <td>{{ $formSosial->panti_sosial_rr_swasta ?? 0 }}</td>
                            <td>Rp {{ number_format($formSosial->panti_sosial_harga_bangunan ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Panti Wredha</strong></td>
                            <td>{{ $formSosial->panti_asuhan_rb_negeri ?? 0 }}</td>
                            <td>{{ $formSosial->panti_asuhan_rb_swasta ?? 0 }}</td>
                            <td>{{ $formSosial->panti_asuhan_rs_negeri ?? 0 }}</td>
                            <td>{{ $formSosial->panti_asuhan_rs_swasta ?? 0 }}</td>
                            <td>{{ $formSosial->panti_asuhan_rr_negeri ?? 0 }}</td>
                            <td>{{ $formSosial->panti_asuhan_rr_swasta ?? 0 }}</td>
                            <td>Rp {{ number_format($formSosial->panti_asuhan_harga_bangunan ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Panti Tuna Grahita</strong></td>
                            <td>{{ $formSosial->balai_pelayanan_rb_negeri ?? 0 }}</td>
                            <td>{{ $formSosial->balai_pelayanan_rb_swasta ?? 0 }}</td>
                            <td>{{ $formSosial->balai_pelayanan_rs_negeri ?? 0 }}</td>
                            <td>{{ $formSosial->balai_pelayanan_rs_swasta ?? 0 }}</td>
                            <td>{{ $formSosial->balai_pelayanan_rr_negeri ?? 0 }}</td>
                            <td>{{ $formSosial->balai_pelayanan_rr_swasta ?? 0 }}</td>
                            <td>Rp {{ number_format($formSosial->balai_pelayanan_harga_bangunan ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        @if($formSosial->lainnya_jenis)
                        <tr>
                            <td><strong>{{ $formSosial->lainnya_jenis }}</strong></td>
                            <td>{{ $formSosial->lainnya_rb_negeri ?? 0 }}</td>
                            <td>{{ $formSosial->lainnya_rb_swasta ?? 0 }}</td>
                            <td>{{ $formSosial->lainnya_rs_negeri ?? 0 }}</td>
                            <td>{{ $formSosial->lainnya_rs_swasta ?? 0 }}</td>
                            <td>{{ $formSosial->lainnya_rr_negeri ?? 0 }}</td>
                            <td>{{ $formSosial->lainnya_rr_swasta ?? 0 }}</td>
                            <td>Rp {{ number_format($formSosial->lainnya_harga_bangunan ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Perkiraan Kerugian (yang sudah masuk ke kerusakan) -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">B. Perkiraan Kerugian (Telah Dipindahkan ke Total Kerusakan)</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="fw-bold">1) Biaya Pembersihan Puing</h6>
                    <p>Tenaga Kerja: {{ $formSosial->biaya_tenaga_kerja_hok ?? 0 }} HOK × Rp {{ number_format($formSosial->biaya_tenaga_kerja_upah ?? 0, 0, ',', '.') }} = Rp {{ number_format(($formSosial->biaya_tenaga_kerja_hok ?? 0) * ($formSosial->biaya_tenaga_kerja_upah ?? 0), 0, ',', '.') }}</p>
                    <p>Alat Berat: {{ $formSosial->biaya_alat_berat_hari ?? 0 }} Hari × Rp {{ number_format($formSosial->biaya_alat_berat_harga ?? 0, 0, ',', '.') }} = Rp {{ number_format(($formSosial->biaya_alat_berat_hari ?? 0) * ($formSosial->biaya_alat_berat_harga ?? 0), 0, ',', '.') }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold">2) Biaya Penyediaan Jatah Hidup</h6>
                    <p>Jumlah Penerima: {{ number_format($formSosial->jumlah_penerima ?? 0, 0, ',', '.') }} orang</p>
                    <p>Bantuan per Orang: Rp {{ number_format($formSosial->bantuan_per_orang ?? 0, 0, ',', '.') }}</p>
                    <p>Total: Rp {{ number_format(($formSosial->jumlah_penerima ?? 0) * ($formSosial->bantuan_per_orang ?? 0), 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <h6 class="fw-bold">3) Tambahan Biaya Sosial</h6>
                    <ul>
                        <li>Biaya Pelayanan Kesehatan: Rp {{ number_format($formSosial->biaya_pelayanan_kesehatan ?? 0, 0, ',', '.') }}</li>
                        <li>Biaya Pelayanan Pendidikan: Rp {{ number_format($formSosial->biaya_pelayanan_pendidikan ?? 0, 0, ',', '.') }}</li>
                        <li>Biaya Pendampingan Psikososial: Rp {{ number_format($formSosial->biaya_pendampingan_psikososial ?? 0, 0, ',', '.') }}</li>
                        <li>Biaya Pelatihan Darurat: Rp {{ number_format($formSosial->biaya_pelatihan_darurat ?? 0, 0, ',', '.') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Perhitungan -->
    <div class="card mb-4 border-success">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">TOTAL PERHITUNGAN</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center p-3 border rounded bg-light">
                        <h4 class="text-success fw-bold">Rp {{ number_format($formSosial->total_kerusakan ?? 0, 0, ',', '.') }}</h4>
                        <p class="mb-0 fw-bold">Total Kerusakan</p>
                        <small class="text-muted">(Termasuk semua item kerugian)</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center p-3 border rounded bg-light">
                        <h4 class="text-secondary fw-bold">Rp {{ number_format($formSosial->total_kerugian ?? 0, 0, ',', '.') }}</h4>
                        <p class="mb-0 fw-bold">Total Kerugian</p>
                        <small class="text-muted">(Sudah dipindahkan ke kerusakan)</small>
                    </div>
                </div>
            </div>
            <div class="alert alert-info mt-3 mb-0">
                <i class="fas fa-info-circle"></i>
                <strong>Catatan:</strong> Sesuai dengan pedoman terbaru, semua item kerugian telah dipindahkan ke dalam total kerusakan untuk memberikan gambaran dampak keseluruhan yang lebih akurat.
            </div>
        </div>
    </div>
</div>
@endsection
