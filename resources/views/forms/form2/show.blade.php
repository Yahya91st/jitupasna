@extends('layouts.main')

@section('content')
<style>
    .document-container {
        background: #fff;
        padding: 20px;
        margin: 20px auto;
        max-width: 800px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: 'Times New Roman', serif;
        line-height: 1.3;
        color: #000;
        font-size: 14px;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
    }

    .header h2 {
        font-size: 16px;
        font-weight: bold;
        margin: 3px 0;
        text-transform: uppercase;
    }

    .header h3 {
        font-size: 14px;
        font-weight: normal;
        margin: 2px 0;
    }

    .decree-header {
        text-align: center;
        margin: 20px 0;
    }

    .decree-header h1 {
        font-size: 16px;
        font-weight: bold;
        margin: 5px 0;
        text-transform: uppercase;
    }

    .decree-header h2 {
        font-size: 14px;
        font-weight: normal;
        margin: 3px 0;
    }

    .pejabat-section {
        text-align: center;
        margin: 20px 0;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 14px;
    }

    .section {
        margin: 10px 0;
    }

    .section-label {
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .section-content {
        margin-left: 15px;
        text-align: justify;
    }

    .section-content p {
        margin: 3px 0;
        text-indent: 0;
        font-size: 14px;
    }

    .memutuskan {
        text-align: center;
        font-weight: bold;
        font-size: 15px;
        margin: 15px 0;
        text-transform: uppercase;
    }

    .diktum {
        margin: 8px 0;
    }

    .diktum-label {
        font-weight: bold;
        margin-bottom: 3px;
        text-transform: uppercase;
        font-size: 14px;
    }

    .diktum-content {
        margin-left: 15px;
        text-align: justify;
    }

    .diktum-content p {
        margin: 2px 0;
        font-size: 14px;
    }

    .diktum-list {
        margin-left: 15px;
    }

    .diktum-list p {
        margin: 2px 0;
        font-size: 14px;
    }

    .signature-section {
        margin-top: 30px;
    }

    .signature-left {
        text-align: left;
        margin-bottom: 15px;
        font-size: 14px;
    }

    .signature-right {
        text-align: center;
        margin-left: 60%;
        font-size: 14px;
    }

    .signature-space {
        height: 50px;
        margin: 15px 0;
    }

    .signature-name {
        border-bottom: 1px solid #000;
        padding-bottom: 3px;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .tembusan {
        margin-top: 25px;
    }

    .tembusan-title {
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .tembusan-list {
        margin-left: 15px;
    }

    .tembusan-list p {
        margin: 2px 0;
        font-size: 14px;
    }

    .metadata-section {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid #ecf0f1;
        text-align: center;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
    }
    
    .action-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 2px solid #ecf0f1;
    }
    
    .btn-custom {
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .btn-primary-custom {
        background: #0066cc;
        color: white;
    }
    
    .btn-primary-custom:hover {
        background: #004499;
        color: white;
        text-decoration: none;
    }
    
    .btn-secondary-custom {
        background: #6c757d;
        color: white;
    }
    
    .btn-secondary-custom:hover {
        background: #545b62;
        color: white;
        text-decoration: none;
    }
    
    .btn-outline-custom {
        background: transparent;
        color: #0066cc;
        border: 2px solid #0066cc;
    }
    
    .btn-outline-custom:hover {
        background: #0066cc;
        color: white;
        text-decoration: none;
    }

    .btn-warning-custom {
        background: #ffc107;
        color: #000;
    }
    
    .btn-warning-custom:hover {
        background: #e0a800;
        color: #000;
        text-decoration: none;
    }

    .info-highlight {
        background: #e8f4f8;
        padding: 15px;
        border-radius: 5px;
        border-left: 4px solid #17a2b8;
        margin: 20px 0;
    }
</style>

<div class="page-heading">
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

    <div class="document-container">
        <!-- Header Formulir -->
        <div class="header">
            <h2>Formulir 02</h2>
            <h3>Surat Keputusan Pembentukan Tim Kerja</h3>
            <h3>Pengkajian Kebutuhan Pasca Bencana (PDNA)</h3>
        </div>

        <!-- Header Surat Keputusan -->
        <div class="decree-header">
            <h1>SURAT KEPUTUSAN</h1>
            <h2>No: {{ $form->nomor_surat ?? '................' }}</h2>
            <br>
            <h1>TENTANG</h1>
            <br>
            <h1>{{ strtoupper($form->tentang ?? 'PEMBENTUKAN TIM KERJA PENGKAJIAN KEBUTUHAN') }}</h1>
            <h1>{{ strtoupper($form->lokasi ?? 'PASCA BENCANA (PDNA) DI ..............') }}</h1>
        </div>

        <!-- Nama Pejabat -->
        <div class="pejabat-section">
            {{ strtoupper($form->pejabat_penandatangan ?? 'DEPUTI REHABILITASI DAN REKONSTRUKSI BNPB') }}
        </div>

        <!-- Bagian Menimbang -->
        <div class="section">
            <div class="section-label">Menimbang</div>
            <div class="section-content">
                <p>a. bahwa dalam rangka perencanaan rehabilitasi dan rekonstruksi pascabencana di {{ $form->lokasi ?? '...........' }}, perlu dilaksanakan pengkajian kebutuhan pascabencana;</p>
                <p>b. bahwa untuk melaksanakan pengkajian kebutuhan pasca bencana perlu dibentuk tim kerja pengkajian kebutuhan pascabencana;</p>
                <p>c. bahwa untuk maksud tersebut huruf b, perlu ditetapkan dengan Keputusan {{ $form->pejabat_penandatangan ?? 'Deputi Rehabilitasi dan Rekonstruksi BNPB' }} (atau Kepala BPBD...);</p>
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
                <p>: Tim Kerja dalam melaksanakan tugasnya bertanggung jawab kepada {{ $form->pejabat_penandatangan ?? 'Deputi Rehabilitasi dan Rekonstruksi BNPB' }} (atau Kepala Daerah....).</p>
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
                <p><strong>(atau Kepala Pelaksana Harian BPBD...)</strong></p>
                
                <div class="signature-space"></div>
                
                <div class="signature-name">
                    <strong>{{ $form->nama_penandatangan ?? 'Nama Jelas' }}</strong>
                </div>
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

        <!-- Informasi Bencana (Data Tambahan) -->
        <div class="info-highlight">
            <h5 style="margin-bottom: 10px; color: #0066cc; font-size: 14px;"><strong>Informasi Bencana Terkait</strong></h5>
            <p style="margin: 5px 0; font-size: 13px;"><strong>Jenis Bencana:</strong> {{ $form->bencana->kategori_bencana->nama }}</p>
            <p style="margin: 5px 0; font-size: 13px;"><strong>Tanggal Kejadian:</strong> {{ $form->bencana->tanggal }}</p>
            <p style="margin: 5px 0; font-size: 13px;"><strong>Lokasi Detail:</strong> 
                @foreach ($form->bencana->desa as $desa)
                    {{ $desa->nama }}@if (!$loop->last), @endif
                @endforeach
            </p>
        </div>
        <!-- Metadata -->
        <div class="metadata-section">
            <small>
                <strong>Dibuat pada:</strong> {{ $form->created_at->format('d F Y H:i') }} WIB<br>
                <strong>Terakhir diperbarui:</strong> {{ $form->updated_at->format('d F Y H:i') }} WIB
            </small>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('forms.index', ['bencana_id' => $form->bencana_id]) }}" class="btn-custom btn-secondary-custom">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Form
            </a>
            <div>
                <a href="{{ route('forms.form2.edit', $form->id) }}" class="btn-custom btn-warning-custom">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
                <a href="{{ route('forms.form2.preview-pdf', $form->id) }}" class="btn-custom btn-outline-custom" target="_blank">
                    <i class="bi bi-eye"></i> Pratinjau PDF
                </a>
                <a href="{{ route('forms.form2.pdf', $form->id) }}" class="btn-custom btn-primary-custom" target="_blank">
                    <i class="bi bi-download"></i> Unduh PDF
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
