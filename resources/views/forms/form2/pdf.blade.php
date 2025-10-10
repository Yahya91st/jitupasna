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
        <h3>KEPUTUSAN {{ strtoupper($form->pejabat_penandatangan) }}</h3>
        <h3>NOMOR: {{ $form->nomor_surat }}</h3>
        <h3>TENTANG</h3>
        <h3>{{ strtoupper($form->tentang) }}</h3>
        <h3>DI {{ strtoupper($form->lokasi) }}</h3>
    </div>
    
    <div class="content">
        <div class="text-center">
            <h4>{{ strtoupper($form->pejabat_penandatangan) }}</h4>
        </div>
        
        <div class="mb-3">
            <table width="100%">
                <tr>
                    <td width="15%" valign="top"><strong>Menimbang:</strong></td>
                </tr>
            </table>
        </div>
        
        <div class="mb-3">
            <table width="100%">
                <tr>
                    <td width="15%" valign="top"><strong>Mengingat:</strong></td>
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
                        <p>Dalam melaksanakan tugasnya, Tim bertanggung jawab kepada ... .</p>
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
        <p>pada tanggal : {{ $form->tanggal_ditetapkan}}</p>
        <p class="mb-5"><strong>{{ $form->pejabat_penandatangan }}</strong></p>
        <p><u>...................................</u></p>
        <p>NIP. ...........................</p>
    </div>
    
    <div class="footer">
        <p><strong>Tembusan:</strong></p>
        <div style="margin-left: 20px;">
        </div>
    </div>
</body>
</html>
