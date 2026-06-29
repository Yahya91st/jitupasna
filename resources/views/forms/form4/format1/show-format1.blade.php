@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel agar lebih kompak seperti format1form4 */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
</style>

<div class="container mt-4">
    <h5 class="text-center fw-bold">Detail Data Sektor Perumahan<br>Format 1a</h5>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Informasi Bencana -->
    @if($bencana)
    <div class="alert alert-light-primary color-primary mb-4">
        <strong>Bencana:</strong> {{ $bencana->jenis_bencana ?? '-' }}<br>
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
            <td style="width: 50%"><strong>ID FORMULIR:</strong> {{ $formulir->id }}</td>
            <td><strong>JUMLAH ITEM:</strong> {{ count($items) }}</td>
        </tr>
    </table>

    <h6 class="fw-bold mt-4">Rincian Item</h6>

    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Sub Kategori</th>
                <th>Tingkat Kerusakan</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $item['kategori'] }}</td>
                    <td>{{ $item['sub_kategori'] ?? '-' }}</td>
                    <td>{{ $item['tingkat_kerusakan'] ?? '-' }}</td>
                    <td>{{ $item['jumlah'] ?? 0 }} {{ $item['satuan'] ?? '' }}</td>
                    <td>Rp {{ number_format($item['harga_satuan'] ?? 0, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item['subtotal'] ?? 0, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada item</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">REKAPITULASI TOTAL</h6>
        </div>
        <div class="card-body text-center">
            <h4 class="mb-1">Rp {{ number_format($totals['total_keseluruhan'] ?? 0, 0, ',', '.') }}</h4>
            <small>Total Keseluruhan Format 1</small>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 mb-4">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali
        </a>
        <div>
            <a href="{{ route('forms.form4.format1.pdf', [
                    'formulir' => $formulir->id,
                    'nomor_input' => $nomorInput
                ]) }}" class="btn btn-info btn-sm">
                Lihat PDF
            </a>
        </div>
    </div>
</div>
@endsection