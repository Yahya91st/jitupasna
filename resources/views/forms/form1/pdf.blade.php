<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Permohonan Keterlibatan dalam PDNA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            font-size: 12pt;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .header h2, .header h3 {
            margin: 5px 0;
        }
        .info-surat {
            margin-bottom: 20px;
        }
        .info-surat table {
            width: 100%;
        }
        .info-surat td {
            padding: 2px 0;
            vertical-align: top;
        }
        .tujuan {
            margin-bottom: 20px;
        }
        .isi-surat {
            text-align: justify;
            margin-bottom: 30px;
        }
        .table-konsolidasi {
            width: 70%;
            margin-left: 30px;
            margin-bottom: 20px;
        }
        .table-konsolidasi td:first-child {
            width: 150px;
        }
        .ttd {
            float: right;
            width: 40%;
            text-align: center;
            margin-top: 20px;
        }
        .ttd .nama {
            margin-top: 70px;
            font-weight: bold;
            text-decoration: underline;
        }
        .clear {
            clear: both;
        }
        .tembusan {
            margin-top: 50px;
        }
        .page-break {
            page-break-after: always;
        }
        @page {
            margin: 2cm;
        }
    </style>
</head>
<body>
    <!-- Kop Surat -->
    <div class="header">
        <!-- <img src="{{ public_path('assets/images/logo_bnpb.png') }}" alt="Logo BNPB"> -->
        <h2>BADAN NASIONAL PENANGGULANGAN BENCANA</h2>
        <p>Jl. Pramuka No. 38, Jakarta Timur 13120<br>
        Telepon: (021) 29827793, Fax: (021) 21281200<br>
        Website: https://bnpb.go.id</p>
        <hr>
    </div>
    
    <!-- Informasi Surat -->
    <div class="info-surat">
        <table>
            <tr>                <td width="80">Nomor</td>
                <td width="10">:</td>
                <td>
                    {{ $form->nomor_surat ?? '-'}} 
                </td>
                <td style="text-align: right;">
                    {{ $form->tanggal_surat 
                        ? ($form->tanggal_surat instanceof \Carbon\Carbon 
                            ? $form->tanggal_surat->format('d F Y') 
                            : (\Carbon\Carbon::parse($form->tanggal_surat)->format('d F Y'))) 
                        : '-' 
                    }}                
                </td>
            </tr>
            <tr>
                <td>Sifat</td>
                <td>:</td>
                <td colspan="2">
                    {{ $form->sifat ?? '-'}}
                </td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td colspan="2">
                    {{ $form->lampiran ?: '-' }}
                </td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td colspan="2">
                    {{ $form->perihal ?? '-'}}
                </td>
            </tr>
        </table>
    </div>
    
    <!-- Tujuan Surat -->
    <div class="tujuan">
        <p>
            Kepada Yth.<br>
            {{ $form->kepada ?? '-'}}<br>
            di tempat
        </p>
    </div>
    
    <!-- Isi Surat -->
    <div class="isi-surat">        
        <p>Dengan hormat,
    </p>
        
        <p>Berdasarkan kejadian bencana 
            {{ $form->bencana->kategori_bencana->nama ?? '-' }} 
            yang terjadi pada tanggal 
            {{ $form->bencana->tanggal instanceof \Carbon\Carbon ? $form->bencana->tanggal->format('d F Y') : \Carbon\Carbon::parse($form->bencana->tanggal)->format('d F Y') ?? '-'}} 
            di 
        @foreach($form->bencana->desa ?? [] as $desa)
            {{ $desa->nama ?? '-' }}
        @endforeach, 
        serta dalam rangka melaksanakan koordinasi pemulihan pasca bencana, bersama ini kami sampaikan hal-hal sebagai berikut:</p>
        
        <p>BNPB akan melaksanakan pengkajian kebutuhan pasca bencana (PDNA) di 
            {{ $form->lokasi_pdna ?? '-'}}
            . Sehubungan dengan hal tersebut, kami mohon kesediaan Saudara untuk menugaskan perwakilan resmi dari 
            {{ $form->kepada ?? '-'}} 
            untuk hadir dalam kegiatan konsolidasi awal PDNA yang akan dilaksanakan pada:</p>
          <table class="table-konsolidasi">
            <tr>
                <td>Hari/Tanggal</td>
                <td>: 
                    {{ $form->hari_tanggal ?? '-' }}
                </td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>: 
                    {{ \Carbon\Carbon::parse($form->waktu)->format('H:i') ?? '-' }}
                     WIB</td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td>: 
                    {{ $form->tempat ?? '-'}}
                </td>
            </tr>
            <tr>
                <td>Agenda</td>
                <td>: 
                    {{ $form->agenda ?? '-'}}
                </td>
            </tr>
        </table>
        
        <p>Mengingat pentingnya hal tersebut, kami mengharapkan kehadiran perwakilan dari 
            {{ $form->kepada ?? '-'}} 
            untuk berkontribusi dalam kegiatan PDNA ini.</p>
        
        <p>Atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
    </div>
    
    <!-- Tanda Tangan -->
    <div class="ttd">
        <p>
            {{ $form->jabatan_penandatangan ?? '-'}}
        </p>
        <div class="nama">
            {{ $form->nama_penandatangan ?? '-'}}
        </div>
    </div>
    
    <div class="clear"></div>
    
    <!-- Tembusan -->
    @if(!empty($form->tembusan))
    <div class="tembusan">
        <p>Tembusan:</p>
        <ol>
            @foreach(explode("\n", $form->tembusan) as $tujuan)
                <li>
                    <li>{{ $tujuan ?: '-' }}</li>
                </li>
            @endforeach
        </ol>
    </div>
    @endif
</body>
</html>