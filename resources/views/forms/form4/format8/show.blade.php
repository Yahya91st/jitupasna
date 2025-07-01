@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <h4 class="mb-3">Format 8. Data Sektor Listrik</h4>

    <div class="mb-3 d-flex justify-content-between">
        <div>
            <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Format
            </a>            <a href="{{ route('forms.form4.list-format8', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
                <i class="bi bi-list"></i> Daftar Data Listrik
            </a>
            <a href="{{ route('forms.form4.format8form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-info">
                <i class="bi bi-plus-circle"></i> Tambah Data Baru
            </a>
        </div>
        <div>
            <a href="{{ route('forms.form4.preview-pdf-format8', $formListrik->id) }}" class="btn btn-info" target="_blank">
                <i class="bi bi-eye"></i> Pratinjau PDF
            </a>
            <a href="{{ route('forms.form4.pdf-format8', $formListrik->id) }}" class="btn btn-primary" target="_blank">
                <i class="bi bi-download"></i> Unduh PDF
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Lokasi</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Kampung:</label>
                    <p>{{ $formListrik->nama_kampung }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Distrik:</label>
                    <p>{{ $formListrik->nama_distrik }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Kerusakan Infrastruktur Listrik</h5>
        </div>
        <div class="card-body">
            <h6 class="mb-3">Sistem Transmisi dan Distribusi</h6>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Komponen</th>
                            <th>Rusak Berat</th>
                            <th>Rusak Sedang</th>
                            <th>Rusak Ringan</th>
                            <th>Kapasitas</th>
                            <th>Harga Satuan</th>
                            <th>Estimasi Kerusakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kabel</td>
                            <td>{{ $formListrik->kabel_rb ?? 0 }} meter</td>
                            <td>{{ $formListrik->kabel_rs ?? 0 }} meter</td>
                            <td>{{ $formListrik->kabel_rr ?? 0 }} meter</td>
                            <td>-</td>
                            <td>Rp {{ number_format($formListrik->kabel_harga_meter ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($formListrik->getTotalCableDamage() ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Tiang</td>
                            <td>{{ $formListrik->tiang_rb ?? 0 }} unit</td>
                            <td>{{ $formListrik->tiang_rs ?? 0 }} unit</td>
                            <td>{{ $formListrik->tiang_rr ?? 0 }} unit</td>
                            <td>-</td>
                            <td>Rp {{ number_format($formListrik->tiang_harga_unit ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($formListrik->getTotalPolesDamage() ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Gardu/Trafo</td>
                            <td>{{ $formListrik->trafo_rb ?? 0 }} unit</td>
                            <td>{{ $formListrik->trafo_rs ?? 0 }} unit</td>
                            <td>{{ $formListrik->trafo_rr ?? 0 }} unit</td>
                            <td>{{ $formListrik->trafo_kapasitas ?? '-' }}</td>
                            <td>Rp {{ number_format($formListrik->trafo_harga_unit ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($formListrik->getTotalTransformerDamage() ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h6 class="mb-3 mt-4">Sistem Pembangkitan</h6>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Komponen</th>
                            <th>Rusak Berat</th>
                            <th>Rusak Sedang</th>
                            <th>Rusak Ringan</th>
                            <th>Kapasitas</th>
                            <th>Harga Satuan</th>
                            <th>Estimasi Kerusakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pembangkit (PLTA/PLTU/PLTD)</td>
                            <td>{{ $formListrik->pembangkit_rb ?? 0 }} unit</td>
                            <td>{{ $formListrik->pembangkit_rs ?? 0 }} unit</td>
                            <td>{{ $formListrik->pembangkit_rr ?? 0 }} unit</td>
                            <td>{{ $formListrik->pembangkit_kapasitas ?? '-' }}</td>
                            <td>Rp {{ number_format($formListrik->pembangkit_harga_unit ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($formListrik->getTotalPowerPlantDamage() ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        @if($formListrik->lainnya_jenis)
                        <tr>
                            <td>{{ $formListrik->lainnya_jenis }}</td>
                            <td>{{ $formListrik->lainnya_rb ?? 0 }} unit</td>
                            <td>{{ $formListrik->lainnya_rs ?? 0 }} unit</td>
                            <td>{{ $formListrik->lainnya_rr ?? 0 }} unit</td>
                            <td>{{ $formListrik->lainnya_kapasitas ?? '-' }}</td>
                            <td>Rp {{ number_format($formListrik->lainnya_harga_unit ?? 0, 0, ',', '.') }}</td>
                            <td>-</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <p><strong>Perkiraan Jangka Waktu Pemulihan:</strong> {{ $formListrik->durasi_gangguan_hari ?? 0 }} hari</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Pembangkit Listrik Darurat</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <p><strong>Jumlah Genset:</strong> {{ $formListrik->genset_jumlah ?? 0 }} unit</p>
                </div>
                <div class="col-md-3 mb-3">
                    <p><strong>Kapasitas Genset:</strong> {{ $formListrik->genset_kapasitas ?? 0 }} kVA</p>
                </div>
                <div class="col-md-3 mb-3">
                    <p><strong>Biaya Sewa per Unit per Hari:</strong> Rp {{ number_format($formListrik->genset_harga_sewa ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="col-md-3 mb-3">
                    <p><strong>Durasi Pemakaian:</strong> {{ $formListrik->genset_durasi_hari ?? 0 }} hari</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Total Biaya Pembangkit Darurat:</strong> Rp {{ number_format($formListrik->getTotalEmergencyPowerCosts() ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Perkiraan Kehilangan Pendapatan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <p><strong>Jumlah Pelanggan Terdampak:</strong> {{ $formListrik->jumlah_pelanggan_terdampak ?? 0 }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <p><strong>Rata-rata Penggunaan per Pelanggan:</strong> {{ $formListrik->rata_rata_penggunaan_per_pelanggan ?? 0 }} kWh/hari</p>
                </div>
                <div class="col-md-4 mb-3">
                    <p><strong>Tarif Listrik per kWh:</strong> Rp {{ number_format($formListrik->tarif_listrik_per_kwh ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Total Kehilangan Pendapatan:</strong> Rp {{ number_format($formListrik->getTotalRevenueLoss() ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Biaya Pembersihan dan Pemulihan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <p><strong>Jumlah Tenaga Kerja:</strong> {{ $formListrik->biaya_tenaga_kerja_hok ?? 0 }} HOK</p>
                </div>
                <div class="col-md-3 mb-3">
                    <p><strong>Upah per HOK:</strong> Rp {{ number_format($formListrik->biaya_tenaga_kerja_upah ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="col-md-3 mb-3">
                    <p><strong>Jumlah Hari Alat Berat:</strong> {{ $formListrik->biaya_alat_berat_hari ?? 0 }} hari</p>
                </div>
                <div class="col-md-3 mb-3">
                    <p><strong>Biaya Sewa Alat Berat:</strong> Rp {{ number_format($formListrik->biaya_alat_berat_sewa ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Total Biaya Pembersihan:</strong> Rp {{ number_format($formListrik->getTotalCleaningCosts() ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Rekapitulasi Kerusakan dan Kerugian</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Total Kerusakan:</h6>
                    <p class="fs-4">Rp {{ number_format($formListrik->getTotalDamage() ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="col-md-6">
                    <h6>Total Kerugian:</h6>
                    <p class="fs-4">Rp {{ number_format($formListrik->getTotalLoss() ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <h6>Total Kerusakan dan Kerugian:</h6>
                    <p class="fs-3 fw-bold">Rp {{ number_format(($formListrik->getTotalDamage() + $formListrik->getTotalLoss()) ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
