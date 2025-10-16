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
            <style>
                .form-document {
                    font-family: 'Times New Roman', serif;
                    line-height: 1.4;
                    color: #000;
                    max-width: 800px;
                    margin: 0 auto;
                }
                
                .document-header {
                    text-align: center;
                    margin-bottom: 25px;
                    border-bottom: 2px solid #000;
                    padding-bottom: 15px;
                }
                
                .document-header h4 {
                    font-size: 14pt;
                    font-weight: bold;
                    margin: 5px 0;
                    text-transform: uppercase;
                }
                
                .document-header .subtitle {
                    font-size: 12pt;
                    font-weight: normal;
                    margin: 3px 0;
                }
                
                .decree-title {
                    text-align: center;
                    margin: 25px 0;
                }
                
                .decree-title h3 {
                    font-size: 16pt;
                    font-weight: bold;
                    margin: 8px 0;
                    text-transform: uppercase;
                }
                
                .pejabat-name {
                    text-align: center;
                    margin: 20px 0;
                    font-weight: bold;
                    text-transform: uppercase;
                    font-size: 12pt;
                }
                
                .section {
                    margin: 15px 0;
                }
                
                .section-label {
                    font-weight: bold;
                    margin-bottom: 8px;
                    font-size: 11pt;
                }
                
                .section-content {
                    margin-left: 20px;
                    text-align: justify;
                }
                
                .section-content p {
                    margin: 5px 0;
                    text-indent: 0;
                    font-size: 11pt;
                }
                
                .memutuskan {
                    text-align: center;
                    font-weight: bold;
                    font-size: 13pt;
                    margin: 20px 0;
                    text-transform: uppercase;
                }
                
                .diktum {
                    margin: 12px 0;
                }
                
                .diktum-label {
                    font-weight: bold;
                    margin-bottom: 5px;
                    text-transform: uppercase;
                    font-size: 11pt;
                    display: inline-block;
                    width: 80px;
                }
                
                .diktum-content {
                    display: inline-block;
                    vertical-align: top;
                    width: calc(100% - 90px);
                    text-align: justify;
                    font-size: 11pt;
                }
                
                .diktum-content p {
                    margin: 3px 0;
                }
                
                .diktum-list {
                    margin-left: 20px;
                    margin-top: 8px;
                }
                
                .diktum-list p {
                    margin: 3px 0;
                }
                
                .signature-section {
                    margin-top: 40px;
                }
                
                .signature-left {
                    text-align: left;
                    margin-bottom: 15px;
                    font-size: 11pt;
                }
                
                .signature-right {
                    text-align: center;
                    margin-left: 60%;
                    font-size: 11pt;
                }
                
                .signature-space {
                    height: 60px;
                    margin: 20px 0;
                }
                
                .signature-name {
                    border-bottom: 1px solid #000;
                    padding-bottom: 5px;
                    margin-bottom: 8px;
                    font-weight: bold;
                }
                
                .tembusan {
                    margin-top: 30px;
                }
                
                .tembusan-title {
                    font-weight: bold;
                    margin-bottom: 8px;
                    font-size: 11pt;
                }
                
                .tembusan-list {
                    margin-left: 20px;
                }
                
                .tembusan-list p {
                    margin: 3px 0;
                    font-size: 11pt;
                }
            </style>
            
            <div class="form-document">
                <!-- Header Formulir -->
                <div class="document-header">
                    <h4>Formulir 02</h4>
                    <div class="subtitle">Surat Keputusan Pembentukan Tim Kerja</div>
                    <div class="subtitle">Pengkajian Kebutuhan Pasca Bencana (PDNA)</div>
                </div>

                <!-- Header Surat Keputusan -->
                <div class="decree-title">
                    <h3>Surat Keputusan</h3>
                    <div class="subtitle">No: {{ $form->nomor_surat ?? '................' }}</div>
                    <br>
                    <h3>Tentang</h3>
                    <br>
                    <h3>{{ strtoupper($form->tentang ?? 'PEMBENTUKAN TIM KERJA PENGKAJIAN KEBUTUHAN') }}</h3>
                    <h3>{{ strtoupper($form->lokasi ?? 'PASCA BENCANA (PDNA) DI ..............') }}</h3>
                </div>

                <!-- Nama Pejabat -->
                <div class="pejabat-name">
                    {{ strtoupper($form->pejabat_penandatangan ?? 'DEPUTI REHABILITASI DAN REKONSTRUKSI BNPB') }}
                </div>

                <!-- Bagian Menimbang -->
                <div class="section">
                    <div class="section-label">Menimbang</div>
                    <div class="section-content">
                        <p>a. bahwa dalam rangka perencanaan rehabilitasi dan rekonstruksi pascabencana di {{ $form->lokasi ?? '...........' }}, perlu dilaksanakan pengkajian kebutuhan pascabencana;</p>
                        <p>b. bahwa untuk melaksanakan pengkajian kebutuhan pasca bencana perlu dibentuk tim kerja pengkajian kebutuhan pascabencana;</p>
                        <p>c. bahwa untuk maksud tersebut huruf b, perlu ditetapkan dengan Keputusan {{ $form->pejabat_penandatangan ?? 'Deputi Rehabilitasi dan Rekonstruksi BNPB' }};</p>
                    </div>
                </div>

                <!-- Bagian Mengingat -->
                <div class="section">
                    <div class="section-label">Mengingat</div>
                    <div class="section-content">
                        <p>a. Undang-Undang no. 24 tahun 2007 tentang Penanggulangan Bencana;</p>
                        <p>b. Peraturan Pemerintah no. 21 tahun 2008 tentang Penyelenggaraan Penanggulangan Bencana;</p>
                        <p>c. Peraturan Kepala BNPB no. 17 tahun 2010 tentang Pedoman Umum Rehabilitasi dan Rekonstruksi;</p>
                    </div>
                </div>

                <!-- Memutuskan -->
                <div class="memutuskan">MEMUTUSKAN</div>

                <div class="section">
                    <div class="section-label">Menetapkan</div>
                </div>

                <!-- Diktum Pertama -->
                <div class="diktum">
                    <div class="diktum-label">PERTAMA</div>
                    <div class="diktum-content">
                        <p>: Membentuk Tim Kerja Pengkajian Kebutuhan Pascabencana di {{ $form->lokasi ?? '...........' }}, dengan susunan personil sebagaimana terdapat pada lampiran keputusan ini.</p>
                    </div>
                </div>

                <!-- Diktum Kedua -->
                <div class="diktum">
                    <div class="diktum-label">KEDUA</div>
                    <div class="diktum-content">
                        <p>: Tim dimaksud diktum pertama mempunyai tugas sebagai berikut:</p>
                        <div class="diktum-list">
                            <p>1. Melakukan perencanaan dan persiapan pelaksanaan pengkajian kebutuhan pascabencana.</p>
                            <p>2. Melakukan pengumpulan data.</p>
                            <p>3. Melakukan pengolahan dan analisis data.</p>
                            <p>4. Menyusun laporan pengkajian kebutuhan pascabencana.</p>
                        </div>
                    </div>
                </div>

                <!-- Diktum Ketiga -->
                <div class="diktum">
                    <div class="diktum-label">KETIGA</div>
                    <div class="diktum-content">
                        <p>: Tim Kerja dalam melaksanakan tugasnya bertanggung jawab kepada {{ $form->pejabat_penandatangan ?? 'Deputi Rehabilitasi dan Rekonstruksi BNPB' }}.</p>
                    </div>
                </div>

                <!-- Diktum Keempat -->
                <div class="diktum">
                    <div class="diktum-label">KEEMPAT</div>
                    <div class="diktum-content">
                        <p>: Keputusan ini berlaku sejak tanggal ditetapkan, apabila dikemudian hari terdapat kekeliruan dalam penetapan ini akan diperbaiki sebagaimana mestinya.</p>
                    </div>
                </div>

                <!-- Bagian Tanda Tangan -->
                <div class="signature-section">
                    <div class="signature-left">
                        <p>Ditetapkan di: {{ $form->lokasi ?? '...............' }}</p>
                        <p>Pada tanggal: {{ $form->tanggal_ditetapkan ?? '...............' }}</p>
                    </div>
                    
                    <div class="signature-right">
                        <p><strong>{{ strtoupper($form->pejabat_penandatangan ?? 'Deputi Rehabilitasi dan Rekonstruksi BNPB') }}</strong></p>
                        
                        <div class="signature-space"></div>
                        
                        <div class="signature-name">
                            <strong>{{ $form->nama_penandatangan ?? '...............................' }}</strong>
                        </div>
                        <p>NIP. {{ $form->nip_penandatangan ?? '...............................' }}</p>
                    </div>
                </div>

                <!-- Tembusan -->
                <div class="tembusan">
                    <div class="tembusan-title">Tembusan Yth.</div>
                    <div class="tembusan-list">
                        <p>1. Kepala BNPB (atau Kepala Daerah...)</p>
                        <p>2. Menteri..... Kepala Lembaga..... (atau Kepala OPD...)</p>
                    </div>
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
