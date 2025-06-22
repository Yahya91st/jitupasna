@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Detail Anggaran Kegiatan PKPB</h4>
                    <div>
                        <a href="{{ route('forms.form12.list', ['bencana_id' => $anggaran->bencana_id]) }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="alert alert-light-primary color-primary">
                                <h5>Informasi Bencana</h5>
                                <p><strong>Bencana:</strong> {{ $anggaran->bencana->kategori_bencana->nama }}</p>
                                <p><strong>Tanggal:</strong> {{ $anggaran->bencana->tanggal }}</p>
                                <p><strong>Lokasi:</strong> 
                                    @foreach($anggaran->bencana->desa as $desa)
                                        {{ $desa->nama }}@if(!$loop->last), @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Sektor</th>
                                    <td>{{ $anggaran->sektor }}</td>
                                </tr>
                                <tr>
                                    <th>Komponen Kebutuhan</th>
                                    <td>{{ $anggaran->komponen_kebutuhan }}</td>
                                </tr>
                                <tr>
                                    <th>Kegiatan</th>
                                    <td>{{ $anggaran->kegiatan }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <td>{{ $anggaran->lokasi }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Volume</th>
                                    <td>{{ number_format($anggaran->volume, 0) }} {{ $anggaran->satuan }}</td>
                                </tr>
                                <tr>
                                    <th>Harga Satuan</th>
                                    <td>Rp {{ number_format($anggaran->harga_satuan, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Total Biaya</th>
                                    <td class="font-weight-bold text-primary">Rp {{ number_format($anggaran->jumlah, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>{{ $anggaran->keterangan ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 d-flex justify-content-between">
                            <div>
                                <a href="{{ route('forms.form12.edit', $anggaran->id) }}" class="btn btn-warning">
                                    <i class="fa fa-edit"></i> Edit Data
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('forms.form12.previewPdf', $anggaran->id) }}" class="btn btn-secondary" target="_blank">
                                    <i class="fa fa-search"></i> Lihat PDF
                                </a>
                                <a href="{{ route('forms.form12.pdf', $anggaran->id) }}" class="btn btn-primary" target="_blank">
                                    <i class="fa fa-download"></i> Unduh PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
