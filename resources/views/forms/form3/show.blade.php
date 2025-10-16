@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Form 3 - Pendataan OPD</h3>
                <p class="text-subtitle text-muted">Data Dasar dan Sekunder Akibat Bencana</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <div class="float-end">
                    <a href="{{ route('forms.form3.edit', $form->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="{{ route('forms.form3.preview-pdf', $form->id) }}" class="btn btn-info" target="_blank">
                        <i class="bi bi-eye"></i> Pratinjau PDF
                    </a>
                    <a href="{{ route('forms.form3.pdf', $form->id) }}" class="btn btn-primary">
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
                    line-height: 1.3;
                    color: #000;
                    max-width: 900px;
                    margin: 0 auto;
                }
                
                .document-header {
                    text-align: center;
                    margin-bottom: 20px;
                    border-bottom: 2px solid #000;
                    padding-bottom: 12px;
                }
                
                .document-title {
                    font-size: 16pt;
                    font-weight: bold;
                    text-transform: uppercase;
                    margin: 0 0 8px 0;
                    letter-spacing: 1px;
                }
                
                .document-subtitle {
                    font-size: 12pt;
                    font-weight: normal;
                    margin: 0;
                }
                
                .header-info {
                    margin-bottom: 20px;
                    background-color: #f8f9fa;
                    padding: 12px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                }
                
                .header-info p {
                    margin: 5px 0;
                    font-size: 11pt;
                }
                
                .section-header {
                    font-size: 12pt;
                    font-weight: bold;
                    text-transform: uppercase;
                    background-color: #e9ecef;
                    padding: 10px;
                    margin: 20px 0 15px 0;
                    border: 1px solid #000;
                    text-align: center;
                }
                
                .subsection-header {
                    font-size: 11pt;
                    font-weight: bold;
                    margin: 15px 0 8px 0;
                    padding: 8px;
                    background-color: #f8f9fa;
                    border-left: 3px solid #000;
                }
                
                .document-table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 10px 0;
                    font-size: 10pt;
                }
                
                .document-table, .document-table th, .document-table td {
                    border: 1px solid #000;
                }
                
                .document-table th {
                    background-color: #e9ecef;
                    font-weight: bold;
                    text-align: center;
                    padding: 8px 6px;
                    font-size: 10pt;
                }
                
                .document-table td {
                    padding: 6px;
                    text-align: left;
                    vertical-align: top;
                }
                
                .text-content {
                    margin: 8px 0;
                    padding: 8px;
                    background-color: #f8f9fa;
                    border: 1px solid #ddd;
                    font-size: 11pt;
                    min-height: 25px;
                    border-radius: 4px;
                }
                
                .number-cell {
                    text-align: right;
                    padding-right: 12px;
                    font-weight: 500;
                }
                
                .btn-actions {
                    margin-top: 20px;
                    text-align: center;
                }
            </style>
            
            <div class="form-document">
                <!-- Header Formulir -->
                <div class="document-header">
                    <div class="document-title">Formulir 3 - Pendataan Ke OPD</div>
                    <div class="document-subtitle">Data Dasar dan Sekunder Akibat Bencana</div>
                </div>
                
                <!-- Info Bencana -->
                <div class="header-info">
                    <p><strong>Bencana:</strong> {{ $form->bencana->kategori_bencana->nama }}</p>
                    <p><strong>Tanggal Kejadian:</strong> {{ $form->bencana->tanggal }}</p>
                    <p><strong>Lokasi:</strong> 
                        @foreach($form->bencana->desa as $desa)
                            {{ $desa->nama }}@if(!$loop->last), @endif
                        @endforeach
                    </p>
                </div>
                
                <!-- 1. DATA DASAR SEBELUM BENCANA -->
                <div class="section-header">1. Data Dasar Sebelum Bencana</div>
                
                <div class="subsection-header">Wilayah Bencana</div>
                <div class="text-content">{{ $form->wilayah_bencana ?: 'Tidak ada data' }}</div>
                
                <div class="subsection-header">Penduduk-Wilayah</div>
                <table class="document-table">
                    <tr>
                        <th>Jumlah Laki-laki</th>
                        <th>Jumlah Perempuan</th>
                        <th>Jumlah Rumah Tangga</th>
                    </tr>
                    <tr>
                        <td class="number-cell">{{ number_format($form->jumlah_laki_laki) }} orang</td>
                        <td class="number-cell">{{ number_format($form->jumlah_perempuan) }} orang</td>
                        <td class="number-cell">{{ number_format($form->jumlah_rumah_tangga) }} RT</td>
                    </tr>
                </table>
                
                <div class="subsection-header">Kesehatan</div>
                <table class="document-table">
                    <tr>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                    </tr>
                    <tr>
                        <td>Rumah Sakit</td>
                        <td class="number-cell">{{ number_format($form->jumlah_rumah_sakit) }}</td>
                    </tr>
                    <tr>
                        <td>PUSKESMAS</td>
                        <td class="number-cell">{{ number_format($form->jumlah_puskesmas) }}</td>
                    </tr>
                    <tr>
                        <td>POSYANDU</td>
                        <td class="number-cell">{{ number_format($form->jumlah_posyandu) }}</td>
                    </tr>
                    <tr>
                        <td>Dokter</td>
                        <td class="number-cell">{{ number_format($form->jumlah_dokter) }}</td>
                    </tr>
                    <tr>
                        <td>Paramedis</td>
                        <td class="number-cell">{{ number_format($form->jumlah_paramedis) }}</td>
                    </tr>
                    <tr>
                        <td>Bidan</td>
                        <td class="number-cell">{{ number_format($form->jumlah_bidan) }}</td>
                    </tr>
                    <tr>
                        <td>Kunjungan PUSKESMAS</td>
                        <td class="number-cell">{{ number_format($form->jumlah_kunjungan_puskesmas) }}</td>
                    </tr>
                    <tr>
                        <td>Balita</td>
                        <td class="number-cell">{{ number_format($form->jumlah_balita) }}</td>
                    </tr>
                    <tr>
                        <td>Balita Gizi Buruk</td>
                        <td class="number-cell">{{ number_format($form->jumlah_balita_gizi_buruk) }}</td>
                    </tr>
                    <tr>
                        <td>Balita Gizi Kurang</td>
                        <td class="number-cell">{{ number_format($form->jumlah_balita_gizi_kurang) }}</td>
                    </tr>
                    <tr>
                        <td>Manula</td>
                        <td class="number-cell">{{ number_format($form->jumlah_manula) }}</td>
                    </tr>
                    <tr>
                        <td>Penerima JPS Kesehatan</td>
                        <td class="number-cell">{{ number_format($form->jumlah_penerima_jps_kesehatan) }}</td>
                    </tr>
                    <tr>
                        <td>Rumah dengan Air Bersih</td>
                        <td class="number-cell">{{ number_format($form->jumlah_rumah_air_bersih) }}</td>
                    </tr>
                    <tr>
                        <td>Rumah dengan Jamban</td>
                        <td class="number-cell">{{ number_format($form->jumlah_rumah_jamban) }}</td>
                    </tr>
                </table>
                
                <div class="subsection-header">Ekonomi</div>
                <table class="document-table">
                    <tr>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                    </tr>
                    <tr>
                        <td>Pasar</td>
                        <td class="number-cell">{{ number_format($form->jumlah_pasar) }}</td>
                    </tr>
                    <tr>
                        <td>Koperasi</td>
                        <td class="number-cell">{{ number_format($form->jumlah_koperasi) }}</td>
                    </tr>
                    <tr>
                        <td>Tempat Wisata</td>
                        <td class="number-cell">{{ number_format($form->jumlah_tempat_wisata) }}</td>
                    </tr>
                </table>
                
                <!-- 2. DATA SEKUNDER AKIBAT BENCANA -->
                <div class="section-header">2. Data Sekunder Akibat Bencana</div>
                
                <div class="subsection-header">Sejarah Bencana di Masa Lalu</div>
                <div class="text-content">{{ $form->sejarah_bencana ?: 'Tidak ada data' }}</div>
                
                <div class="subsection-header">Kronologis Kejadian Bencana Saat Ini</div>
                <div class="text-content">{{ $form->kronologis_bencana ?: 'Tidak ada data' }}</div>
                
                <div class="subsection-header">Wilayah Terdampak</div>
                <div class="text-content">{{ $form->wilayah_terdampak ?: 'Tidak ada data' }}</div>
                
                <div class="subsection-header">Jumlah Korban</div>
                <table class="document-table">
                    <tr>
                        <th>Meninggal</th>
                        <th>Luka-luka</th>
                        <th>Mengungsi</th>
                    </tr>
                    <tr>
                        <td class="number-cell">{{ number_format($form->jumlah_korban_meninggal) }} orang</td>
                        <td class="number-cell">{{ number_format($form->jumlah_korban_luka) }} orang</td>
                        <td class="number-cell">{{ number_format($form->jumlah_korban_mengungsi) }} orang</td>
                    </tr>
                </table>
                
                <div class="subsection-header">Kerusakan dan Kerugian</div>
                <div class="text-content">{{ $form->kerusakan_kerugian ?: 'Tidak ada data' }}</div>
                
                <!-- 3. DATA SEKUNDER AKIBAT BENCANA (KHUSUS) -->
                <div class="section-header">3. Data Sekunder Akibat Bencana (Khusus)</div>
                
                <div class="subsection-header">Bidang Pertanian</div>
                <table class="document-table">
                    <tr>
                        <th>Aspek</th>
                        <th>Keterangan</th>
                    </tr>
                    <tr>
                        <td>Gangguan Ekonomi</td>
                        <td>{{ $form->pertanian_gangguan_ekonomi ?: 'Tidak ada data' }}</td>
                    </tr>
                    <tr>
                        <td>Produk Pertanian Terdampak</td>
                        <td>{{ $form->pertanian_produk_terdampak ?: 'Tidak ada data' }}</td>
                    </tr>
                    <tr>
                        <td>Pemulihan yang Dibutuhkan</td>
                        <td>{{ $form->pertanian_pemulihan ?: 'Tidak ada data' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('forms.form3.list', ['bencana_id' => $form->bencana->id]) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Form 3
        </a>
        <a href="{{ route('forms.index', ['bencana_id' => $form->bencana->id]) }}" class="btn btn-outline-secondary">
            <i class="bi bi-list"></i> Daftar Semua Form
        </a>
    </div>
</div>
@endsection
