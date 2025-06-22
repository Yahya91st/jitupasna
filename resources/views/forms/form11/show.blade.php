@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Detail Rekapitulasi Kebutuhan Pascabencana</h4>
                    <div>
                        <a href="{{ route('forms.form11.list', ['bencana_id' => $rekapitulasi->bencana_id]) }}" class="btn btn-secondary">
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
                                <p><strong>Bencana:</strong> {{ $rekapitulasi->bencana->kategori_bencana->nama }}</p>
                                <p><strong>Referensi:</strong> {{ $rekapitulasi->bencana->Ref }}</p>
                                <p><strong>Tanggal:</strong> {{ $rekapitulasi->bencana->tanggal }}</p>
                                <p><strong>Lokasi:</strong> 
                                    @foreach($rekapitulasi->bencana->desa as $desa)
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
                                    <td>{{ $rekapitulasi->sektor }}</td>
                                </tr>
                                <tr>
                                    <th>Sub Sektor</th>
                                    <td>{{ $rekapitulasi->sub_sektor }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <td>{{ $rekapitulasi->lokasi }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kebutuhan</th>
                                    <td>{{ $rekapitulasi->jenis_kebutuhan }}</td>
                                </tr>
                                <tr>
                                    <th>Rincian Kebutuhan</th>
                                    <td>{{ $rekapitulasi->rincian_kebutuhan }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Unit</th>
                                    <td>{{ number_format($rekapitulasi->jumlah_unit, 2) }} {{ $rekapitulasi->satuan }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Harga Satuan</th>
                                    <td>Rp {{ number_format($rekapitulasi->harga_satuan, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Total Kebutuhan</th>
                                    <td class="font-weight-bold text-primary">Rp {{ number_format($rekapitulasi->total_kebutuhan, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Prioritas</th>
                                    <td>
                                        @if($rekapitulasi->prioritas == 'Tinggi')
                                            <span class="badge bg-danger">Tinggi</span>
                                        @elseif($rekapitulasi->prioritas == 'Sedang')
                                            <span class="badge bg-warning">Sedang</span>
                                        @else
                                            <span class="badge bg-info">Rendah</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Durasi Penyelesaian</th>
                                    <td>{{ $rekapitulasi->durasi_penyelesaian }}</td>
                                </tr>
                                <tr>
                                    <th>Penanggung Jawab</th>
                                    <td>{{ $rekapitulasi->penanggung_jawab }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>{{ $rekapitulasi->keterangan ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 d-flex justify-content-between">
                            <div>
                                <a href="{{ route('forms.form11.edit', $rekapitulasi->id) }}" class="btn btn-warning">
                                    <i class="fa fa-edit"></i> Edit Data
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('forms.form11.previewPdf', $rekapitulasi->id) }}" class="btn btn-secondary" target="_blank">
                                    <i class="fa fa-search"></i> Lihat PDF
                                </a>
                                <a href="{{ route('forms.form11.pdf', $rekapitulasi->id) }}" class="btn btn-primary" target="_blank">
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
