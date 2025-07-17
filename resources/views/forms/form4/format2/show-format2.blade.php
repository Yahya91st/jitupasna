@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Detail Data Sektor Pendidikan (Format 2)</h5>
    <p class="fw-bold">Bencana: {{ $bencana->nama ?? '-' }}</p>
    <div class="mb-3">
        <a href="{{ route('forms.form4.list-format2', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary btn-sm">Kembali ke Daftar</a>
    </div>
    <div class="card mb-3">
        <div class="card-header">Info Lokasi</div>
        <div class="card-body">
            <div><b>Kampung:</b> {{ $formPendidikan->nama_kampung }}</div>
            <div><b>Distrik:</b> {{ $formPendidikan->nama_distrik }}</div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">Rekapitulasi</div>
        <div class="card-body">
            <div><b>Total Kerusakan:</b> Rp {{ number_format($formPendidikan->total_kerusakan, 0, ',', '.') }}</div>
            <div><b>Total Kerugian:</b> Rp {{ number_format($formPendidikan->total_kerugian, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">Rincian Lainnya</div>
        <div class="card-body">
            <div><b>Sekolah utk Pengungsian:</b> {{ $formPendidikan->sekolah_pengungsian }}</div>
            <div><b>Guru Korban Bencana:</b> {{ $formPendidikan->guru_korban }}</div>
            <div><b>Iuran Sekolah Swasta:</b> Rp {{ number_format($formPendidikan->iuran_sekolah, 0, ',', '.') }}</div>
            <div><b>Jumlah Sekolah Sementara:</b> {{ $formPendidikan->jumlah_sekolah_sementara }}</div>
            <div><b>Harga Sekolah Sementara:</b> Rp {{ number_format($formPendidikan->harga_sekolah_sementara, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="mb-4">
        <a href="{{ route('forms.form4.generatePdf-format2', $formPendidikan->id) }}" class="btn btn-secondary btn-sm">Download PDF</a>
    </div>
</div>
@endsection
