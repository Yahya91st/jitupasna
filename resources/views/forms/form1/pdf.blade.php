<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Permohonan Keterlibatan dalam PDNA</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.2;
            font-size: 9pt;
            margin: 0.8cm;
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
            font-size: 10pt;
        }
        
        .document-title h5:first-child {
            color: #0066cc;
            margin-bottom: 0.1rem;
            font-size: 9pt;
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
            font-size: 9pt;
        }
        
        .form-section {
            margin-bottom: 4px;
        }
        
        .form-label {
            display: inline-block;
            width: 100px;
            vertical-align: top;
            font-weight: 500;
            color: #333;
            font-size: 9pt;
        }
        
        .form-indent {
            margin-left: 105px;
        }
        
        .meeting-details {
            margin: 4px 0;
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
        
        @page {
            margin: 0.8cm;
            size: A4;
        }
        
        /* Ensure single page */
        .page-break {
            display: none;
        }
        
        p {
            margin-bottom: 0.2em;
            text-align: justify;
            line-height: 1.1;
            font-size: 9pt;
        }
        
        /* Compact spacing for meeting details */
        .meeting-details p {
            margin-bottom: 0.1em;
        }
        
        /* Compact tembusan */
        .tembusan-section p {
            margin-bottom: 0.05em;
            font-size: 8pt;
        }
    </style>
</head>
<body>
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
            <span class="form-label">Nomor</span>: {{ $form->nomor_surat ?? '...........................' }}
            @if($form->nomor_surat_date)
                , {{ \Carbon\Carbon::parse($form->nomor_surat_date)->format('d F Y') }}
            @endif
        </p>
        
        <p>
            <span class="form-label">Sifat</span>: {{ $form->sifat ?? 'Segera' }}
        </p>
        
        <p>
            <span class="form-label">Lampiran</span>: {{ $form->lampiran ?? '-' }}{{ $form->lampiran ? ' lembar' : '' }}
        </p>
        
        <p>
            <span class="form-label">Perihal</span>: Permohonan Keterlibatan dalam<br>
            <span class="form-indent">Pengkajian Kebutuhan Pascabencana (PDNA)</span><br>
            <span class="form-indent">di {{ $form->lokasi_pdna ?? '.....' }}</span>
        </p>
    </div>
    
    <!-- Recipient Section -->
    <div class="form-section">
        <p style="margin-bottom: 0.2em; margin-top: 0.5em;">
            <span class="form-label" style="margin-bottom: 4px; display: block; margin-left: 105px;">
                <strong>Kepada Yth</strong>
            </span>
            <span class="form-indent">{{ $form->kepada_jabatan ?? 'Direktur ........ Kementerian/lembaga.....' }}</span>
            @if(!$form->kepada_jabatan)
                <br><span class="form-indent">(atau Kepala OPD .... )</span>
            @endif
            <br>
            <span class="form-indent">di {{ $form->lokasi_pdna ?? '................' }}</span>
        </p>
    </div>

    <!-- Letter Content -->
    <div class="form-section">
        <p style="text-align: justify; margin-bottom: 0.2em;">
            Berkenaan dengan akan diadakannya Pengkajian Kebutuhan 
            Pascabencana (PDNA) di <strong>{{ $form->lokasi_pdna ?? '................' }}</strong>, bersama ini kami memohon 
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
            <span class="form-label">Hari/tanggal</span>: {{ $form->hari_tanggal ?? '................................' }}
        </p>
        
        <p>
            <span class="form-label">Waktu</span>: {{ $form->waktu ?? '................................' }}
        </p>
        
        <p>
            <span class="form-label">Tempat</span>: {{ $form->tempat ?? '................................' }}
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
                <strong>Deputi Rehabilitasi dan Rekonstruksi BNPB</strong><br>
                <strong>(atau Kepala Pelaksana Harian BPBD...)</strong>
                
                <div style="margin-top: 3em;">
                    <strong>{{ $form->nama_penandatangan ?? 'Nama Jelas' }}</strong>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Copy Recipients -->
    <div class="tembusan-section">
        <p style="font-size: 9pt;"><strong>Tembusan Yth.</strong></p>
        @if(!empty($form->tembusan))
            @php
                $tembusan_lines = explode("\n", $form->tembusan);
                $counter = 1;
            @endphp
            @foreach($tembusan_lines as $line)
                @if(trim($line) && $counter <= 4)
                    <p style="margin-left: 15px; margin-bottom: 0.05em; font-size: 8pt;">
                        {{ $counter }}. {{ trim(str_replace(['1. ', '2. ', '3. ', '4. ', '5. ', '6. ', '7. ', '8. ', '9. '], '', $line)) }}
                    </p>
                    @php $counter++; @endphp
                @endif
            @endforeach
        @else
            <p style="margin-left: 15px; margin-bottom: 0.05em; font-size: 8pt;">1. Kepala BNPB (atau Kepala Daerah)</p>
            <p style="margin-left: 15px; margin-bottom: 0.05em; font-size: 8pt;">2. Menteri........./Kepala Lembaga..... (atau Kepala OPD ....)</p>
            <p style="margin-left: 15px; margin-bottom: 0.05em; font-size: 8pt;">3. Rektor ..... (Perguruan Tinggi)</p>
            <p style="margin-left: 15px; margin-bottom: 0.05em; font-size: 8pt;">4. Direktur/Manager/Koordinator .... (Organisasi Kemasyarakatan dan Dunia Usaha)</p>
        @endif
    </div>
</body>
</html>