@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Detail Form Sektor Lingkungan Hidup (Format 17)</h1>
    
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
            <a href="{{ route('forms.form4.list-format17', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
                <i class="fa fa-list mr-2"></i> Daftar Laporan
            </a>            <a href="{{ route('forms.form4.format17form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-info">
                <i class="fa fa-plus mr-2"></i> Tambah Data Baru
            </a>
            <a href="{{ route('forms.form4.format17-preview-pdf', $bencana->id) }}" class="btn btn-secondary" target="_blank">
                <i class="fa fa-eye mr-2"></i> Lihat PDF
            </a>
            <a href="{{ route('forms.form4.format17-pdf', $bencana->id) }}" class="btn btn-primary" target="_blank">
                <i class="fa fa-download mr-2"></i> Unduh PDF
            </a>
        </div>
    </div>
    
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

    <!-- I. PERKIRAAN KERUSAKAN LINGKUNGAN HIDUP -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">I. PERKIRAAN KERUSAKAN LINGKUNGAN HIDUP</h2>
        
        @if(count(array_filter($damageReports)) > 0)
            @foreach($damageReports as $ekosistem => $reports)
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-4">{{ ucfirst($ekosistem) }} Ecosystem</h3>
                    <div class="overflow-x-auto">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Jenis Kerusakan</th>
                                    <th>Rusak Berat</th>
                                    <th>Rusak Sedang</th>
                                    <th>Rusak Ringan</th>
                                    <th>Harga RB</th>
                                    <th>Harga RS</th>
                                    <th>Harga RR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                <tr>
                                    <td>{{ $report->jenis_kerusakan }}</td>
                                    <td>{{ $report->rb }}</td>
                                    <td>{{ $report->rs }}</td>
                                    <td>{{ $report->rr }}</td>
                                    <td>Rp {{ number_format($report->harga_rb, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($report->harga_rs, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($report->harga_rr, 2, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info">
                <p>Belum ada data kerusakan lingkungan hidup yang tercatat untuk bencana ini.</p>
            </div>
        @endif
    </div>
    
    <!-- II. PERKIRAAN KERUGIAN LINGKUNGAN HIDUP -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">II. PERKIRAAN KERUGIAN LINGKUNGAN HIDUP</h2>
        
        @if(count(array_filter($lossReports)) > 0)
            @foreach($lossReports as $jenisKerugian => $reports)
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-4">
                        @switch($jenisKerugian)
                            @case('kehilangan_jasa_lingkungan')
                                Kehilangan Jasa Lingkungan
                                @break
                            @case('pencemaran_air')
                                Pencemaran Air
                                @break
                            @case('pencemaran_udara')
                                Pencemaran Udara
                                @break
                            @default
                                {{ ucfirst(str_replace('_', ' ', $jenisKerugian)) }}
                        @endswitch
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>Dasar Perhitungan</th>
                                    <th>RB</th>
                                    <th>RS</th>
                                    <th>RR</th>
                                    <th>Harga RB</th>
                                    <th>Harga RS</th>
                                    <th>Harga RR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                <tr>
                                    <td>{{ $report->jenis }}</td>
                                    <td>{{ $report->dasar_perhitungan }}</td>
                                    <td>{{ $report->rb }}</td>
                                    <td>{{ $report->rs }}</td>
                                    <td>{{ $report->rr }}</td>
                                    <td>Rp {{ number_format($report->harga_rb, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($report->harga_rs, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($report->harga_rr, 2, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info">
                <p>Belum ada data kerugian lingkungan hidup yang tercatat untuk bencana ini.</p>
            </div>
        @endif
    </div>

    <!-- III. RINGKASAN TOTAL -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">III. RINGKASAN TOTAL</h2>
        
        {{-- Calculation is now done in controller --}}
        
        <div class="overflow-x-auto">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Perkiraan Kerusakan</td>
                        <td class="font-semibold">Rp {{ number_format($totalKerusakan, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Total Perkiraan Kerugian</td>
                        <td class="font-semibold">Rp {{ number_format($totalKerugian, 2, ',', '.') }}</td>
                    </tr>
                    <tr class="table-success">
                        <td class="font-bold">TOTAL KESELURUHAN</td>
                        <td class="font-bold text-green-600">Rp {{ number_format($grandTotal, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
