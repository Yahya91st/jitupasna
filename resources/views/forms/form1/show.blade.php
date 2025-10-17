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
        line-height: 1.2;
        font-size: 14px;
        color: #333;
    }
    
    .document-title {
        text-align: center;
        margin-bottom: 8px;
        padding-bottom: 4px;
        border-bottom: 1px solid #ddd;
    }
    
    .document-title h5 {
        margin: 0.1rem 0;
        font-weight: bold;
        color: #333;
        font-size: 16px;
    }
    
    .document-title h5:first-child {
        color: #0066cc;
        margin-bottom: 0.1rem;
        font-size: 14px;
    }

    .letter-header {
        text-align: center;
        margin-bottom: 6px;
        padding: 3px;
        background: #f9f9f9;
        border-radius: 2px;
    }

    .letter-header p {
        margin: 0;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }
    
    .form-section {
        margin-bottom: 4px;
    }
    
    .form-section p {
        margin-bottom: 0.2em;
        text-align: justify;
        line-height: 1.1;
        font-size: 14px;
    }
    
    .form-label {
        display: inline-block;
        width: 100px;
        vertical-align: top;
        font-weight: 500;
        color: #333;
        font-size: 14px;
    }
    
    .form-indent {
        margin-left: 105px;
    }
    
    .meeting-details {
        margin: 4px 0;
    }
    
    .meeting-details p {
        margin-bottom: 0.1em;
    }
    
    .signature-section {
        text-align: right;
        margin: 8px 40px 8px 0;
    }
    
    .signature-content {
        text-align: left;
        margin-bottom: 4px;
    }
    
    .signature-name {
        text-align: center;
        font-weight: bold;
        width: 150px;
        margin-top: 20px;
        border-bottom: 1px solid #333;
        padding-bottom: 1px;
    }
    
    .tembusan-section {
        margin-top: 8px;
    }
    
    .tembusan-section p {
        margin-bottom: 0.05em;
        font-size: 13px;
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
</style>

    <div class="page-heading">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="document-container">
            <!-- Document Header -->
            <div class="document-title">
                <h5><strong>Formulir 01</strong></h5>
                <h5>Surat Permohonan Keterlibatan dalam Pengkajian Kebutuhan Pascabencana (PDNA)</h5>
            </div>
            
            <!-- Letter Header -->
            <div class="letter-header">
                <p><strong>Kop Surat BNPB (atau BPBD)</strong></p>
            </div>
            
            <!-- Letter Details -->
            <div class="form-section">
                <p>
                    <span class="form-label">Nomor</span>: {{ $form->nomor_surat }}
                    @if($form->nomor_surat_date)
                        , {{ $form->nomor_surat_date->format('d F Y') }}
                    @endif
                </p>
                
                <p>
                    <span class="form-label">Sifat</span>: {{ $form->sifat }}
                </p>
                
                <p>
                    <span class="form-label">Lampiran</span>: {{ $form->lampiran ?: '-' }}{{ $form->lampiran ? ' lembar' : '' }}
                </p>
                
                <p>
                    <span class="form-label">Perihal</span>: {{ $form->perihal ?: 'Permohonan Keterlibatan dalam' }}<br>
                    <span class="form-indent">{{ $form->perihal ? '' : 'Pengkajian Kebutuhan Pascabencana (PDNA)' }}</span>
                    @if($form->perihal)
                        <br><span class="form-indent">di {{ $form->lokasi_pdna }}</span>
                    @else
                        <br><span class="form-indent">di {{ $form->lokasi_pdna }}</span>
                    @endif
                </p>
            </div>

            <!-- Recipient Section -->
            <div class="form-section">
                <p style="margin-bottom: 0.2em; margin-top: 0.5em;">
                    <span class="form-label" style="margin-bottom: 4px; display: block; margin-left: 105px;">
                        <strong>Kepada Yth</strong>
                    </span>
                    <span class="form-indent">{{ $form->kepada }}</span>
                    <br>
                    <span class="form-indent">di {{ $form->lokasi_pdna }}</span>
                </p>
            </div>

            <!-- Letter Content -->
            <div class="form-section">
                <p style="text-align: justify; margin-bottom: 0.2em;">
                    Berkenaan dengan akan diadakannya Pengkajian Kebutuhan 
                    Pascabencana (PDNA) di <strong>{{ $form->lokasi_pdna }}</strong>, bersama ini kami memohon 
                    keterlibatan perwakilan resmi instansi Bapak/Ibu dalam kegiatan tersebut.
                </p>
                
                <p style="margin-bottom: 0.2em;">
                    Untuk konsolidasi awal, mohon kiranya perwakilan resmi instansi 
                    Bapak/Ibu dapat hadir pada pertemuan yang akan diadakan pada:
                </p>
            </div>
            
            <!-- Meeting Details -->
            <div class="meeting-details">
                <p>
                    <span class="form-label">Hari/tanggal</span>: {{ $form->hari_tanggal }}
                </p>
                
                <p>
                    <span class="form-label">Waktu</span>: {{ \Carbon\Carbon::parse($form->waktu)->format('H:i') }} WIB
                </p>
                
                <p>
                    <span class="form-label">Tempat</span>: {{ $form->tempat }}
                </p>
                
                <p>
                    <span class="form-label">Agenda</span>: 
                    @if($form->agenda)
                        @php
                            $agenda_lines = explode("\n", $form->agenda);
                            $formatted_agenda = [];
                            foreach($agenda_lines as $line) {
                                $line = trim($line);
                                if($line) {
                                    // Jika tidak dimulai dengan dash atau nomor, tambahkan dash
                                    if(!preg_match('/^[-•\d]/', $line)) {
                                        $line = '- ' . $line;
                                    }
                                    $formatted_agenda[] = $line;
                                }
                            }
                        @endphp
                        @foreach($formatted_agenda as $index => $line)
                            @if($index == 0)
                                {{ $line }}
                            @else
                                <br><span style="margin-left: 105px;">{{ $line }}</span>
                            @endif
                        @endforeach
                    @else
                        - Konsolidasi awal<br>
                        <span style="margin-left: 105px;">- Persiapan Pengkajian Kebutuhan Pascabencana (PDNA)</span>
                    @endif
                </p>
            </div>

            <div class="form-section">
                <p>Demikian atas kerjasamanya diucapkan terima kasih.</p>
            </div>

            <!-- Signature Section -->
            <div class="signature-section">
                <div style="text-align: right; margin-top: 0.5em; margin-right: 0;">
                    <div style="text-align: center; width: 200px; margin-left: auto;">
                        <strong>{{ $form->jabatan_penandatangan ?: 'Deputi Rehabilitasi dan Rekonstruksi BNPB' }}</strong><br>
                        <strong>(atau Kepala Pelaksana Harian BPBD {{ $form->instansi_pengirim ? $form->instansi_pengirim : '...' }})</strong>
                        
                        <div style="margin-top: 3em;">
                            <strong>{{ $form->nama_penandatangan }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copy Recipients -->
            <div class="tembusan-section">
                <p style="font-size: 14px;"><strong>Tembusan Yth.</strong></p>
                @if(!empty($form->tembusan))
                    @php
                        $tembusan_lines = explode("\n", $form->tembusan);
                        $counter = 1;
                    @endphp
                    @foreach($tembusan_lines as $line)
                        @if(trim($line) && $counter <= 4)
                            <p style="margin-left: 15px; margin-bottom: 0.05em; font-size: 13px;">
                                {{ $counter }}. {{ trim(str_replace(['1. ', '2. ', '3. ', '4. ', '5. ', '6. ', '7. ', '8. ', '9. '], '', $line)) }}
                            </p>
                            @php $counter++; @endphp
                        @endif
                    @endforeach
                @else
                    <p style="margin-left: 15px; margin-bottom: 0.05em; font-size: 13px;">1. Kepala BNPB (atau Kepala Daerah)</p>
                    <p style="margin-left: 15px; margin-bottom: 0.05em; font-size: 13px;">2. Menteri........./Kepala Lembaga..... (atau Kepala OPD ....)</p>
                    <p style="margin-left: 15px; margin-bottom: 0.05em; font-size: 13px;">3. Rektor ..... (Perguruan Tinggi)</p>
                    <p style="margin-left: 15px; margin-bottom: 0.05em; font-size: 13px;">4. Direktur/Manager/Koordinator .... (Organisasi Kemasyarakatan dan Dunia Usaha)</p>
                @endif
            </div>

            <!-- Informasi Bencana (Data Tambahan) -->
            <div style="margin-top: 20px; padding: 15px; background: #e8f4f8; border-radius: 5px; border-left: 4px solid #17a2b8;">
                <h5 style="margin-bottom: 10px; color: #0066cc; font-size: 14px;"><strong>Informasi Bencana Terkait</strong></h5>
                <p style="margin: 5px 0; font-size: 13px;"><strong>Jenis Bencana:</strong> {{ $form->bencana->kategori_bencana->nama }}</p>
                <p style="margin: 5px 0; font-size: 13px;"><strong>Tanggal Kejadian:</strong> {{ $form->bencana->tanggal }}</p>
                <p style="margin: 5px 0; font-size: 13px;"><strong>Lokasi Detail:</strong> 
                    @foreach ($form->bencana->desa as $desa)
                        {{ $desa->nama }}@if (!$loop->last), @endif
                    @endforeach
                </p>
                @if($form->instansi_pengirim)
                    <p style="margin: 5px 0; font-size: 13px;"><strong>Instansi Pengirim:</strong> {{ $form->instansi_pengirim }}</p>
                @endif
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
                <a href="{{ route('forms.form1.list', ['bencana_id' => $form->bencana_id]) }}" class="btn-custom btn-secondary-custom">
                    <i class="fa fa-arrow-left"></i> Kembali ke Daftar
                </a>
                <div>
                    <a href="{{ route('forms.form1.preview-pdf', $form->id) }}" class="btn-custom btn-outline-custom" target="_blank">
                        <i class="fa fa-search"></i> Pratinjau PDF
                    </a>
                    <a href="{{ route('forms.form1.pdf', $form->id) }}" class="btn-custom btn-primary-custom" target="_blank">
                        <i class="fa fa-download"></i> Unduh PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
