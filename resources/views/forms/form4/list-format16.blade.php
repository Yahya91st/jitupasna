@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Laporan Sektor Pemerintahan (Format 16)</h1>
    
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
    
    <div class="mb-4 flex justify-between">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali ke Form 4
        </a>          <div class="flex gap-2">
            <a href="{{ route('forms.form4.format16form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                <i class="fa fa-plus mr-2"></i> Tambah Laporan Baru
            </a>
            <a href="{{ route('forms.form4.show-format16', $bencana->id) }}" class="btn btn-info">
                <i class="fa fa-eye mr-2"></i> Lihat Ringkasan Laporan
            </a>
            <a href="{{ route('forms.form4.format16-preview-pdf', $bencana->id) }}" class="btn btn-secondary" target="_blank">
                <i class="fa fa-file-pdf mr-2"></i> Lihat PDF
            </a>
            <a href="{{ route('forms.form4.format16-pdf', $bencana->id) }}" class="btn btn-success" target="_blank">
                <i class="fa fa-download mr-2"></i> Unduh PDF
            </a>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        @if($governmentReports->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Fasilitas</th>
                    <th>Jumlah Rusak Berat</th>
                    <th>Jumlah Rusak Sedang</th>
                    <th>Jumlah Rusak Ringan</th>
                    <th>Total Kerusakan</th>
                    <th>Tanggal Input</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp                @foreach($governmentReports->where('jenis_fasilitas', '!=', 'Kerugian Lainnya') as $report)
                @php
                    $totalDamage = ($report->jumlah_rb * $report->harga_rb) + 
                                  ($report->jumlah_rs * $report->harga_rs) + 
                                  ($report->jumlah_rr * $report->harga_rr);
                @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $report->jenis_fasilitas }}</td>
                    <td>{{ $report->jumlah_rb }}</td>
                    <td>{{ $report->jumlah_rs }}</td>
                    <td>{{ $report->jumlah_rr }}</td>
                    <td>Rp {{ number_format($totalDamage, 0, ',', '.') }}</td>
                    <td>{{ $report->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info" onclick="alert('Fitur detail belum tersedia')">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-warning" onclick="alert('Fitur edit belum tersedia')">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                
                @if($governmentReports->where('jenis_fasilitas', '=', 'Kerugian Lainnya')->count() > 0)
                <tr class="bg-gray-100">
                    <td colspan="8" class="font-semibold">Data Kerugian Lainnya</td>
                </tr>
                @foreach($governmentReports->where('jenis_fasilitas', '=', 'Kerugian Lainnya') as $lossReport)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $lossReport->jenis_fasilitas }}</td>
                    <td colspan="3">
                        <p>Pembersihan Puing: {{ $lossReport->tenaga_kerja_hok }} HOK × Rp {{ number_format($lossReport->upah_harian, 0, ',', '.') }}</p>
                        <p>Alat Berat: {{ $lossReport->alat_berat_hari }} hari × Rp {{ number_format($lossReport->biaya_per_hari_alat_berat, 0, ',', '.') }}</p>
                        <p>Sewa Kantor: {{ $lossReport->jumlah_unit }} unit × Rp {{ number_format($lossReport->biaya_sewa_per_unit, 0, ',', '.') }}</p>
                        <p>Dokumen: {{ $lossReport->jumlah_arsip }} item × Rp {{ number_format($lossReport->harga_satuan, 0, ',', '.') }}</p>
                    </td>                    @php
                        $totalLoss = ($lossReport->tenaga_kerja_hok * $lossReport->upah_harian) +
                                    ($lossReport->alat_berat_hari * $lossReport->biaya_per_hari_alat_berat) +
                                    ($lossReport->jumlah_unit * $lossReport->biaya_sewa_per_unit) +
                                    ($lossReport->jumlah_arsip * $lossReport->harga_satuan);
                    @endphp
                    <td>Rp {{ number_format($totalLoss, 0, ',', '.') }}</td>
                    <td>{{ $lossReport->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info" onclick="alert('Fitur detail belum tersedia')">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-warning" onclick="alert('Fitur edit belum tersedia')">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        @else
        <div class="p-4 text-center">
            <p>Belum ada data laporan untuk sektor pemerintahan.</p>
            <a href="{{ route('forms.form4.format16form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary mt-2">
                <i class="fa fa-plus mr-2"></i> Tambah Data Sekarang
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
