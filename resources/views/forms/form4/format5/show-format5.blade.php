@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Detail Form Sektor Agama (Format 5)</h1>
    
    @if(session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="mb-4 flex justify-between">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali ke Form 4
        </a>
        <div class="flex gap-2">
            <a href="{{ route('forms.form4.list-format5', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
                <i class="fa fa-list mr-2"></i> Daftar Laporan
            </a>
            <a href="{{ route('forms.form4.format5form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-info">
                <i class="fa fa-plus mr-2"></i> Tambah Data Baru
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Sektor Agama</h6>
            <div class="btn-group">
                <a href="{{ route('forms.form4.format5.edit', $report->id) }}" class="btn btn-sm btn-warning">
                    <i class="fa fa-edit mr-1"></i> Edit
                </a>
                <a href="{{ route('forms.form4.format5.pdf', $report->id) }}" target="_blank" class="btn btn-sm btn-danger">
                    <i class="fa fa-file-pdf mr-1"></i> PDF
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light" style="width: 30%">Bencana</th>
                            <td>{{ $bencana->kategori_bencana->nama }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal</th>
                            <td>{{ $bencana->tanggal }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Kampung</th>
                            <td>{{ $report->nama_kampung }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Distrik</th>
                            <td>{{ $report->nama_distrik }}</td>
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
                                    <h4 class="text-primary">Rp {{ number_format($report->total_kerusakan, 0, ',', '.') }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1">Total Kerugian:</p>
                                    <h4 class="text-danger">Rp {{ number_format($report->total_kerugian, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail data sektor agama -->
            <h5 class="font-weight-bold mt-4 mb-3">Detail Kerusakan Fasilitas Keagamaan</h5>

            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th rowspan="2">Jenis Tempat Ibadah</th>
                            <th colspan="6">Jumlah Unit Rusak</th>
                            <th rowspan="2">Luas (m²)</th>
                            <th rowspan="2">Harga Bangunan (Rp)</th>
                            <th rowspan="2">Harga Peralatan (Rp)</th>
                        </tr>
                        <tr class="text-center">
                            <th>RB Negeri</th>
                            <th>RB Swasta</th>
                            <th>RS Negeri</th>
                            <th>RS Swasta</th>
                            <th>RR Negeri</th>
                            <th>RR Swasta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $facilities = [
                                ['label' => 'Gereja', 'prefix' => 'gereja'],
                                ['label' => 'Kapel', 'prefix' => 'kapel'],
                                ['label' => 'Masjid', 'prefix' => 'masjid'],
                                ['label' => 'Musholla', 'prefix' => 'musholla'],
                                ['label' => 'Pura', 'prefix' => 'pura'],
                                ['label' => 'Vihara', 'prefix' => 'vihara']
                            ];
                        @endphp
                        
                        @foreach($facilities as $facility)
                            @php
                                $rb_negeri = $report->{$facility['prefix'].'_rb_negeri'} ?? 0;
                                $rb_swasta = $report->{$facility['prefix'].'_rb_swasta'} ?? 0;
                                $rs_negeri = $report->{$facility['prefix'].'_rs_negeri'} ?? 0;
                                $rs_swasta = $report->{$facility['prefix'].'_rs_swasta'} ?? 0;
                                $rr_negeri = $report->{$facility['prefix'].'_rr_negeri'} ?? 0;
                                $rr_swasta = $report->{$facility['prefix'].'_rr_swasta'} ?? 0;
                                $luas = $report->{$facility['prefix'].'_luas'} ?? 0;
                                $harga_bangunan = $report->{$facility['prefix'].'_harga_bangunan'} ?? 0;
                                $harga_peralatan = $report->{$facility['prefix'].'_harga_peralatan'} ?? 0;
                                
                                $hasData = $rb_negeri > 0 || $rb_swasta > 0 || $rs_negeri > 0 || $rs_swasta > 0 || $rr_negeri > 0 || $rr_swasta > 0;
                            @endphp
                            
                            @if($hasData)
                            <tr>
                                <td><strong>{{ $facility['label'] }}</strong></td>
                                <td class="text-center">{{ $rb_negeri }}</td>
                                <td class="text-center">{{ $rb_swasta }}</td>
                                <td class="text-center">{{ $rs_negeri }}</td>
                                <td class="text-center">{{ $rs_swasta }}</td>
                                <td class="text-center">{{ $rr_negeri }}</td>
                                <td class="text-center">{{ $rr_swasta }}</td>
                                <td class="text-center">{{ number_format($luas, 2) }}</td>
                                <td class="text-right">Rp {{ number_format($harga_bangunan, 0, ',', '.') }}</td>
                                <td class="text-right">Rp {{ number_format($harga_peralatan, 0, ',', '.') }}</td>
                            </tr>
                            @endif
                        @endforeach
                        
                        @if(!collect($facilities)->some(function($facility) use ($report) {
                            return ($report->{$facility['prefix'].'_rb_negeri'} ?? 0) > 0 || 
                                   ($report->{$facility['prefix'].'_rb_swasta'} ?? 0) > 0 || 
                                   ($report->{$facility['prefix'].'_rs_negeri'} ?? 0) > 0 || 
                                   ($report->{$facility['prefix'].'_rs_swasta'} ?? 0) > 0 || 
                                   ($report->{$facility['prefix'].'_rr_negeri'} ?? 0) > 0 || 
                                   ($report->{$facility['prefix'].'_rr_swasta'} ?? 0) > 0;
                        }))
                        <tr>
                            <td colspan="10" class="text-center text-muted">Tidak ada data kerusakan fasilitas keagamaan</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            <!-- Tambahkan tabel kerugian dan informasi lainnya sesuai model -->
        </div>
    </div>
</div>
@endsection
