@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <h3>Detail Surat Permohonan Keterlibatan PDNA</h3>
        <p class="text-subtitle text-muted">Detail formulir permohonan keterlibatan dalam Pengkajian Kebutuhan Pascabencana</p>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data Surat Permohonan</h4>
            <div>
                <a href="{{ route('forms.form1.preview-pdf', $form->id) }}" class="btn btn-secondary" target="_blank">
                    <i class="fa fa-search"></i> Pratinjau PDF
                </a>
                <a href="{{ route('forms.form1.pdf', $form->id) }}" class="btn btn-primary" target="_blank">
                    <i class="fa fa-download"></i> Unduh PDF
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Data Bencana -->
            <div class="mb-4">
                <h5>Informasi Bencana</h5>
                <div class="alert alert-light-primary color-primary">
                    <p><strong>Bencana:</strong> {{ $form->bencana->kategori_bencana->nama }}</p>
                    <p><strong>Tanggal:</strong> {{ $form->bencana->tanggal }}</p>
                    <p><strong>Lokasi:</strong> 
                        @foreach($form->bencana->desa as $desa)
                            {{ $desa->nama }}@if(!$loop->last), @endif
                        @endforeach
                    </p>
                </div>
            </div>
            
            <!-- Informasi Surat -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5>Informasi Surat</h5>
                </div>
                <div class="col-md-4 mb-2">
                    <p><strong>Nomor Surat:</strong> {{ $form->nomor_surat }}</p>
                </div>
                <div class="col-md-4 mb-2">
                    <p><strong>Sifat:</strong> {{ $form->sifat }}</p>
                </div>
                <div class="col-md-4 mb-2">
                    <p><strong>Lampiran:</strong> {{ $form->lampiran ?: '-' }}</p>
                </div>
                <div class="col-md-4 mb-2">
                    <p><strong>Perihal:</strong> {{ $form->perihal }}</p>
                </div>
                <div class="col-md-4 mb-2">
                    <p><strong>Tanggal Surat:</strong> {{ $form->nomor_surat_date->format('d F Y') }}</p>
                </div>
                <div class="col-md-4 mb-2">
                    <p><strong>Kepada:</strong> {{ $form->kepada }}</p>
                </div>
            </div>

            <!-- Informasi PDNA -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5>Informasi PDNA</h5>
                </div>
                <div class="col-md-4 mb-2">
                    <p><strong>Lokasi PDNA:</strong> {{ $form->lokasi_pdna }}</p>
                </div>
                <div class="col-md-4 mb-2">
                    <p><strong>Tanggal Konsolidasi:</strong> {{ $form->hari_tanggal}}</p>
                </div>
                <div class="col-md-4 mb-2">
                    <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($form->waktu)->format('H:i') }}</p>
                </div>
                <div class="col-md-4 mb-2">
                    <p><strong>Tempat:</strong> {{ $form->tempat }}</p>
                </div>
                <div class="col-md-8 mb-2">
                    <p><strong>Agenda:</strong> {{ $form->agenda }}</p>
                </div>
            </div>

            <!-- Informasi Penandatangan -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5>Informasi Penandatangan</h5>
                </div>
                <div class="col-md-6 mb-2">
                    <p><strong>Nama:</strong> {{ $form->nama_penandatangan }}</p>
                </div>
                <div class="col-md-6 mb-2">
                    <p><strong>Jabatan:</strong> {{ $form->jabatan_penandatangan }}</p>
                </div>
            </div>

            <!-- Tembusan dan Instansi -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5>Tembusan dan Instansi</h5>
                </div>
                <div class="col-md-6 mb-2">
                    <p><strong>Tembusan:</strong></p>
                    <div class="pl-3">
                        @if($form->tembusan)
                            @foreach(explode("\n", $form->tembusan) as $tujuan)
                                <p>- {{ $tujuan }}</p>
                            @endforeach
                        @else
                            <p>Tidak ada tembusan</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <p><strong>Instansi Pengirim:</strong> {{ $form->instansi_pengirim ?? 'Tidak ada data instansi' }}</p>
                </div>
            </div>

            <!-- Metadata -->
            <div class="row">
                <div class="col-md-12">
                    <hr>
                    <p class="text-muted">
                        <small>Dibuat pada: {{ $form->created_at->format('d F Y H:i') }}</small>
                        <br>
                        <small>Terakhir diperbarui: {{ $form->updated_at->format('d F Y H:i') }}</small>
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('forms.form1.list-form1', ['bencana_id' => $form->bencana_id]) }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali ke Daftar
            </a>
            <div>
                <a href="{{ route('forms.form1.preview-pdf', $form->id) }}" class="btn btn-secondary" target="_blank">
                    <i class="fa fa-search"></i> Pratinjau PDF
                </a>
                <a href="{{ route('forms.form1.pdf', $form->id) }}" class="btn btn-primary" target="_blank">
                    <i class="fa fa-download"></i> Unduh PDF
                </a>
            </div>
        </div>
    </div>
</div>
@endsection