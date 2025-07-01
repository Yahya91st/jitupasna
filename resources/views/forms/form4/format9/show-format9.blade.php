@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h2 class="text-center mb-4">Format 9: Sektor Telekomunikasi</h2>
    
    @if(session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
    @endif      <div class="mb-4 d-flex justify-content-between">
        <a href="{{ route('form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left me-2"></i> Kembali ke Form 4
        </a>
        <div class="d-flex gap-2">
            <a href="{{ route('list-format9', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
                <i class="fa fa-list me-2"></i> Daftar Laporan
            </a>
            <a href="{{ route('format9form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-info">
                <i class="fa fa-plus me-2"></i> Tambah Data Baru
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Detail Laporan Kerusakan Sektor Telekomunikasi</h6>            <div class="btn-group">
                <a href="{{ route('format9.pdf', $formTelekomunikasi->id) }}" target="_blank" class="btn btn-sm btn-danger">
                    <i class="fa fa-file-pdf me-1"></i> PDF
                </a>
                <a href="{{ route('format9.preview-pdf', $formTelekomunikasi->id) }}" target="_blank" class="btn btn-sm btn-secondary">
                    <i class="fa fa-eye me-1"></i> Pratinjau PDF
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light" style="width: 30%">Bencana</th>
                            <td>{{ $bencana->kategori_bencana->nama ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal</th>
                            <td>{{ $bencana->tanggal ?? 'Data tidak tersedia' }}</td>
                        </tr>                        <tr>
                            <th class="bg-light">Kampung</th>
                            <td>{{ $formTelekomunikasi->nama_kampung }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Distrik</th>
                            <td>{{ $formTelekomunikasi->nama_distrik }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="font-weight-bold">Rekapitulasi:</h6>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="mb-1">Total Kerusakan:</p>
                                    <h4 class="text-primary">Rp {{ number_format($formTelekomunikasi->getTotalDamage(), 0, ',', '.') }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1">Total Kerugian:</p>
                                    <h4 class="text-danger">Rp {{ number_format($formTelekomunikasi->getTotalLoss(), 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Kerusakan Infrastruktur -->
            <h5 class="font-weight-bold mt-4 mb-3">Detail Kerusakan Infrastruktur Telekomunikasi</h5>

            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle">Infrastruktur</th>
                            <th class="text-center">Rusak Berat</th>
                            <th class="text-center">Rusak Sedang</th>
                            <th class="text-center">Rusak Ringan</th>
                            <th class="text-center">Harga Satuan (Rp)</th>
                            <th class="text-center">Total Kerusakan (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Menara/BTS</td>
                            <td class="text-center">{{ $formTelekomunikasi->bts_rb }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->bts_rs }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->bts_rr }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->bts_harga_unit, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->getTotalBTSDamage(), 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Kantor</td>
                            <td class="text-center">{{ $formTelekomunikasi->kantor_rb }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->kantor_rs }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->kantor_rr }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->kantor_harga_m2, 0, ',', '.') }} / m² × {{ $formTelekomunikasi->kantor_luas }} m²</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->getTotalOfficeDamage(), 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Pemancar</td>
                            <td class="text-center">{{ $formTelekomunikasi->pemancar_rb }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->pemancar_rs }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->pemancar_rr }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->pemancar_harga_unit, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->getTotalTransmitterDamage(), 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Kabel (meter)</td>
                            <td class="text-center">{{ $formTelekomunikasi->kabel_rb }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->kabel_rs }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->kabel_rr }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->kabel_harga_meter, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->getTotalCableDamage(), 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Server</td>
                            <td class="text-center">{{ $formTelekomunikasi->server_rb }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->server_rs }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->server_rr }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->server_harga_unit, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->getTotalServerDamage(), 0, ',', '.') }}</td>
                        </tr>
                        @if($formTelekomunikasi->lainnya_jenis)
                        <tr>
                            <td>{{ $formTelekomunikasi->lainnya_jenis }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->lainnya_rb }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->lainnya_rs }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->lainnya_rr }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->lainnya_harga_unit, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->getTotalOtherDamage(), 0, ',', '.') }}</td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot class="bg-light font-weight-bold">
                        <tr>
                            <td colspan="5" class="text-end">Total Kerusakan Infrastruktur</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->getTotalDamage(), 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <!-- Biaya Pembersihan dan Emergency Response -->
            <h5 class="font-weight-bold mt-4 mb-3">Biaya Pembersihan & Respons Darurat</h5>
            
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Uraian</th>
                            <th>Detail</th>
                            <th class="text-center">Total (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Biaya Tenaga Kerja Pembersihan</td>
                            <td>{{ $formTelekomunikasi->biaya_tenaga_kerja_hok }} HOK × Rp {{ number_format($formTelekomunikasi->biaya_tenaga_kerja_upah, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->biaya_tenaga_kerja_hok * $formTelekomunikasi->biaya_tenaga_kerja_upah, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Biaya Alat Berat</td>
                            <td>{{ $formTelekomunikasi->biaya_alat_berat_hari }} Hari × Rp {{ number_format($formTelekomunikasi->biaya_alat_berat_sewa, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->biaya_alat_berat_hari * $formTelekomunikasi->biaya_alat_berat_sewa, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Alat Komunikasi Darurat</td>
                            <td>{{ $formTelekomunikasi->alat_komunikasi_jumlah }} Unit × Rp {{ number_format($formTelekomunikasi->alat_komunikasi_harga_sewa, 0, ',', '.') }} × {{ $formTelekomunikasi->alat_komunikasi_durasi_hari }} Hari</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->getTotalEmergencyCommunicationCosts(), 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                    <tfoot class="bg-light font-weight-bold">
                        <tr>
                            <td colspan="2" class="text-end">Total Biaya Pembersihan & Darurat</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->getTotalCleaningCosts() + $formTelekomunikasi->getTotalEmergencyCommunicationCosts(), 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <!-- Kerugian Pendapatan -->
            <h5 class="font-weight-bold mt-4 mb-3">Kerugian Pendapatan</h5>
            
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Jumlah Pelanggan</th>
                            <th>Rata-rata Penggunaan</th>
                            <th>Tarif (Rp)</th>
                            <th>Durasi Gangguan (Hari)</th>
                            <th>Total Kerugian (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ number_format($formTelekomunikasi->jumlah_pelanggan_terdampak, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->rata_rata_penggunaan_per_pelanggan }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->tarif_komunikasi, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $formTelekomunikasi->durasi_gangguan_hari }}</td>
                            <td class="text-end">{{ number_format($formTelekomunikasi->getTotalRevenueLoss(), 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>            
            <!-- Total Summary -->
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Rekapitulasi Total Kerusakan dan Kerugian</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6 class="card-title">Total Kerusakan</h6>
                                    <h3 class="text-primary">Rp {{ number_format($formTelekomunikasi->getTotalDamage(), 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6 class="card-title">Total Kerugian</h6>
                                    <h3 class="text-danger">Rp {{ number_format($formTelekomunikasi->getTotalLoss(), 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6 class="card-title">Total Keseluruhan</h6>
                                    <h3 class="text-success">Rp {{ number_format($formTelekomunikasi->getTotalDamage() + $formTelekomunikasi->getTotalLoss(), 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
