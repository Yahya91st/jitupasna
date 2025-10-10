@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Surat Keputusan</h3>
                <p class="text-subtitle text-muted">Surat Keputusan Pembentukan Tim Kerja Pengkajian Kebutuhan Pascabencana</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <div class="float-end">
                    <a href="{{ route('forms.form2.edit', $form->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="{{ route('forms.form2.preview-pdf', $form->id) }}" class="btn btn-info" target="_blank">
                        <i class="bi bi-eye"></i> Pratinjau PDF
                    </a>
                    <a href="{{ route('forms.form2.pdf', $form->id) }}" class="btn btn-primary">
                        <i class="bi bi-download"></i> Unduh PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="card">
        <div class="card-body p-5">
            <div class="text-center mb-5">
                <h4>KEPUTUSAN {{ strtoupper($form->pejabat_penandatangan) }}</h4>
                <h4>NOMOR: {{ $form->nomor_surat }}</h4>
                <h4>TENTANG</h4>
                <h4>{{ strtoupper($form->tentang) }}</h4>
                <h4>DI {{ strtoupper($form->lokasi) }}</h4>
            </div>
            
            <div class="mb-4">
                <h5 class="text-center">{{ strtoupper($form->pejabat_penandatangan) }}</h5>
            </div>
              <div class="mb-4">
                @php
                    // Parsing dasar hukum
                    $menimbang_text = "";
                    $mengingat_text = "";
                    
                    if (count($parts) > 1) {
                        $tmp = explode("Mengingat:", $parts[1]);
                        $menimbang_text = trim($tmp[0]);
                        $mengingat_text = isset($tmp[1]) ? trim($tmp[1]) : "";
                    }
                    
                    // Use Tim Kerja and Tugas Tim from model fields directly
                    $tim_kerja_text = $form->tim_kerja;
                    $tugas_tim_text = $form->tugas_tim;
                    $penanggung_jawab = $form->penanggung_jawab;
                    $tembusan = $form->tembusan;
                @endphp
                
                <div class="row mb-3">
                    <div class="col-2">
                        <strong>Menimbang:</strong>
                    </div>
                    <div class="col-10">
                        {!! nl2br(e($menimbang_text)) !!}
                    </div>
                </div>
                
                <div class="row mb-5">
                    <div class="col-2">
                        <strong>Mengingat:</strong>
                    </div>
                    <div class="col-10">
                        {!! nl2br(e($mengingat_text)) !!}
                    </div>
                </div>
            </div>
            
            <div class="text-center mb-4">
                <h5>MEMUTUSKAN:</h5>
            </div>
            
            <div class="mb-4">
                <div class="row mb-3">
                    <div class="col-2">
                        <strong>KESATU:</strong>
                    </div>
                    <div class="col-10">
                        <p>Membentuk Tim Kerja Pengkajian Kebutuhan Pascabencana dengan susunan tim sebagai berikut:</p>
                        <div class="pl-4">
                            {!! nl2br(e($tim_kerja_text)) !!}
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-2">
                        <strong>KEDUA:</strong>
                    </div>
                    <div class="col-10">
                        <p>Tim sebagaimana dimaksud dalam Diktum KESATU mempunyai tugas sebagai berikut:</p>
                        <div class="pl-4">
                            {!! nl2br(e($tugas_tim_text)) !!}
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-2">
                        <strong>KETIGA:</strong>
                    </div>
                    <div class="col-10">
                        <p>Dalam melaksanakan tugasnya, Tim bertanggung jawab kepada {{ $penanggung_jawab }}.</p>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-2">
                        <strong>KEEMPAT:</strong>
                    </div>
                    <div class="col-10">
                        <p>Keputusan ini mulai berlaku pada tanggal ditetapkan.</p>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-6"></div>
                <div class="col-6 text-center">
                    <p>Ditetapkan di : ...........................</p>
                    <p>pada tanggal : {{ $form->tanggal_ditetapkan }}</p>
                    <p class="mb-5"><strong>{{ $form->pejabat_penandatangan }}</strong></p>
                    <p><u>...................................</u></p>
                    <p>NIP. ...........................</p>
                </div>
            </div>
            
            <div class="mt-5">
                <p><strong>Tembusan:</strong></p>
                <div class="pl-4">
                    {!! nl2br(e($tembusan)) !!}
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('forms.index', ['bencana_id' => $form->bencana_id]) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Form
        </a>
    </div>
</div>
@endsection
