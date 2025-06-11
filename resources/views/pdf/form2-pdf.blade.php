<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keputusan Pembentukan Tim Kerja</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 2cm;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        h1, h2, h3, h4, h5 {
            text-align: center;
            margin: 5px 0;
        }
        .content {
            text-align: justify;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature-content {
            margin-right: 2cm;
        }
        .footer {
            margin-top: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        ol {
            margin-left: 20px;
            padding-left: 10px;
        }
        li {
            margin-bottom: 5px;
        }
        .tembusan {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>KEPUTUSAN {{ strtoupper($keputusan->pejabat_penandatangan) }}</h3>
        <h3>NOMOR: {{ $keputusan->nomor_surat }}</h3>
        <h3>TENTANG</h3>
        <h3>{{ strtoupper($keputusan->tentang) }}</h3>
        <h3>DI {{ strtoupper($keputusan->lokasi) }}</h3>
    </div>
    
    <div class="content">
        <h4 style="text-align: center;">{{ strtoupper($keputusan->pejabat_penandatangan) }}</h4>
        
        <div style="margin-top: 20px;">
            <p><b>Menimbang:</b></p>
            {!! nl2br(str_replace("Menimbang:", "", explode("Mengingat:", $keputusan->dasar_hukum)[0])) !!}
        </div>
        
        <div style="margin-top: 20px;">
            <p><b>Mengingat:</b></p>
            {!! nl2br(explode("Mengingat:", $keputusan->dasar_hukum)[1] ?? '') !!}
        </div>
        
        <div style="text-align: center; margin: 20px 0;">
            <h4>MEMUTUSKAN:</h4>
        </div>
        
        <div>
            <p><b>KESATU:</b> Membentuk Tim Kerja Pengkajian Kebutuhan Pascabencana dengan susunan tim sebagai berikut:</p>
            {!! nl2br($keputusan->tim_kerja) !!}
        </div>
        
        <div style="margin-top: 20px;">
            <p><b>KEDUA:</b> Tim sebagaimana dimaksud dalam Diktum KESATU mempunyai tugas sebagai berikut:</p>
            {!! nl2br($keputusan->tugas_tim) !!}
        </div>
        
        <div style="margin-top: 20px;">
            <p><b>KETIGA:</b> Dalam melaksanakan tugasnya, Tim bertanggung jawab kepada {{ $keputusan->penanggung_jawab }}.</p>
        </div>
        
        <div style="margin-top: 20px;">
            <p><b>KEEMPAT:</b> Keputusan ini mulai berlaku pada tanggal ditetapkan.</p>
        </div>
    </div>
    
    <div class="signature">
        <div class="signature-content">
            <p>Ditetapkan di : ............................</p>
            <p>pada tanggal : {{ \Carbon\Carbon::parse($keputusan->tanggal_ditetapkan)->isoFormat('D MMMM Y') }}</p>
            <p style="margin-top: 10px; margin-bottom: 80px;"><b>{{ $keputusan->pejabat_penandatangan }}</b></p>
            <p style="text-decoration: underline;">...........................................</p>
            <p>NIP. ..........................................</p>
        </div>
    </div>
    
    <div class="tembusan">
        <p>Tembusan:</p>
        {!! nl2br($keputusan->tembusan) !!}
    </div>
</body>
</html>
