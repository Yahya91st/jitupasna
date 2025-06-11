<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keputusan Tim Kerja PDNA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 3cm 2cm 2cm 2cm;
            font-size: 12pt;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        h1, h2, h3, h4, h5 {
            margin: 5px 0;
        }
        .content {
            text-align: justify;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
            margin-right: 100px;
        }
        .footer {
            margin-top: 30px;
        }
        .text-center {
            text-align: center;
        }
        .mt-5 {
            margin-top: 50px;
        }
        .mb-5 {
            margin-bottom: 50px;
        }
        .mb-3 {
            margin-bottom: 20px;
        }
        .mb-1 {
            margin-bottom: 10px;
        }
        .bold {
            font-weight: bold;
        }
        p {
            margin: 5px 0;
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
        <div class="text-center">
            <h4>{{ strtoupper($keputusan->pejabat_penandatangan) }}</h4>
        </div>
        
        @php
            // Parsing dasar hukum
            $dasar_hukum = $keputusan->dasar_hukum;
            $parts = explode("MENIMBANG:\n", $dasar_hukum);
            $menimbang_text = "";
            if (count($parts) > 1) {
                $tmp = explode("\n\nMENGINGAT:", $parts[1]);
                $menimbang_text = $tmp[0];
                $mengingat_text = $tmp[1] ?? "";
            }
            
            // Parsing keputusan
            $keputusan_text = $keputusan->keputusan;
            $parts = explode("TIM KERJA:\n", $keputusan_text);
            $tim_kerja_text = "";
            if (count($parts) > 1) {
                $tmp = explode("\n\nTUGAS TIM:", $parts[1]);
                $tim_kerja_text = $tmp[0];
                $tugas_tim_parts = explode("\n\nPENANGGUNG JAWAB:", $tmp[1] ?? "");
                $tugas_tim_text = $tugas_tim_parts[0];
                $penanggung_jawab_parts = explode("\n\nTEMBUSAN:", $tugas_tim_parts[1] ?? "");
                $penanggung_jawab = $penanggung_jawab_parts[0];
                $tembusan = $penanggung_jawab_parts[1] ?? "";
            }
        @endphp
        
        <div class="mb-3">
            <table width="100%">
                <tr>
                    <td width="15%" valign="top"><strong>Menimbang:</strong></td>
                    <td width="85%">{!! nl2br(e($menimbang_text)) !!}</td>
                </tr>
            </table>
        </div>
        
        <div class="mb-3">
            <table width="100%">
                <tr>
                    <td width="15%" valign="top"><strong>Mengingat:</strong></td>
                    <td width="85%">{!! nl2br(e($mengingat_text)) !!}</td>
                </tr>
            </table>
        </div>
        
        <div class="text-center mb-3">
            <h4>MEMUTUSKAN:</h4>
        </div>
        
        <div class="mb-3">
            <table width="100%">
                <tr>
                    <td width="15%" valign="top"><strong>KESATU:</strong></td>
                    <td width="85%">
                        <p>Membentuk Tim Kerja Pengkajian Kebutuhan Pascabencana dengan susunan tim sebagai berikut:</p>
                        <div style="margin-left: 20px;">
                            {!! nl2br(e($tim_kerja_text)) !!}
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="mb-3">
            <table width="100%">
                <tr>
                    <td width="15%" valign="top"><strong>KEDUA:</strong></td>
                    <td width="85%">
                        <p>Tim sebagaimana dimaksud dalam Diktum KESATU mempunyai tugas sebagai berikut:</p>
                        <div style="margin-left: 20px;">
                            {!! nl2br(e($tugas_tim_text)) !!}
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="mb-3">
            <table width="100%">
                <tr>
                    <td width="15%" valign="top"><strong>KETIGA:</strong></td>
                    <td width="85%">
                        <p>Dalam melaksanakan tugasnya, Tim bertanggung jawab kepada {{ $penanggung_jawab }}.</p>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="mb-3">
            <table width="100%">
                <tr>
                    <td width="15%" valign="top"><strong>KEEMPAT:</strong></td>
                    <td width="85%">
                        <p>Keputusan ini mulai berlaku pada tanggal ditetapkan.</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="signature">
        <p>Ditetapkan di : ...........................</p>
        <p>pada tanggal : {{ \Carbon\Carbon::parse($keputusan->tanggal_ditetapkan)->locale('id')->isoFormat('D MMMM Y') }}</p>
        <p class="mb-5"><strong>{{ $keputusan->pejabat_penandatangan }}</strong></p>
        <p><u>...................................</u></p>
        <p>NIP. ...........................</p>
    </div>
    
    <div class="footer">
        <p><strong>Tembusan:</strong></p>
        <div style="margin-left: 20px;">
            {!! nl2br(e($tembusan)) !!}
        </div>
    </div>
</body>
</html>
