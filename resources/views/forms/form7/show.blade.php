@extends('layouts.main')

@section('content')
    <style>
        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .form-table th,
        .form-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        .form-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
        }

        .table-header {
            background-color: #e9ecef;
            font-weight: bold;
            text-align: center;
            padding: 10px;
        }

        .form-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-group-custom {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }
    </style>

    <div class="form-container">
        <div class="form-title">
            <h4><strong>Formulir 07</strong></h4>
            <h5>Focus Group Discussion (FGD) - Detail</h5>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Detail Data FGD</h5>
            </div>
            <div class="card-body">
                <!-- Informasi Bencana -->
                <div class="table-header">INFORMASI BENCANA</div>
                <table class="form-table">
                    <tr>
                        <th style="width: 30%;">Bencana</th>
                        <td>{{ $form->bencana->kategori_bencana->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Bencana</th>
                        <td>{{ $form->bencana->tanggal ? \Carbon\Carbon::parse($form->bencana->tanggal)->format('d F Y') : '-' }}</td>
                    </tr>
                </table>

                <!-- Informasi Lokasi -->
                <div class="table-header">INFORMASI LOKASI FGD</div>
                <table class="form-table">
                    <tr>
                        <th style="width: 30%;">Desa/Kelurahan</th>
                        <td>{{ $form->desa_kelurahan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Kecamatan</th>
                        <td>{{ $form->kecamatan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Kabupaten</th>
                        <td>{{ $form->kabupaten ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal FGD</th>
                        <td>{{ $form->tanggal ? \Carbon\Carbon::parse($form->tanggal)->format('d F Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jarak dari Lokasi Bencana</th>
                        <td>{{ $form->jarak_bencana ?? '-' }} km</td>
                    </tr>
                    <tr>
                        <th>Tempat Pelaksanaan Sesi</th>
                        <td>{{ $form->tempat_sesi ?? '-' }}</td>
                    </tr>
                </table>

                <!-- Informasi Peserta -->
                <div class="table-header">INFORMASI PESERTA</div>
                <table class="form-table">
                    <tr>
                        <th style="width: 30%;">Jumlah Peserta</th>
                        <td>{{ $form->jumlah_peserta ?? 0 }} orang</td>
                    </tr>
                    <tr>
                        <th>Jumlah Perempuan</th>
                        <td>{{ $form->jumlah_perempuan ?? 0 }} orang</td>
                    </tr>
                    <tr>
                        <th>Jumlah Laki-laki</th>
                        <td>{{ $form->jumlah_laki_laki ?? 0 }} orang</td>
                    </tr>
                    <tr>
                        <th>Komposisi Peserta</th>
                        <td>{!! nl2br(e($form->komposisi_peserta ?? '-')) !!}</td>
                    </tr>
                </table>

                <!-- Informasi Fasilitator -->
                <div class="table-header">INFORMASI FASILITATOR & PENCATAT</div>
                <table class="form-table">
                    <tr>
                        <th style="width: 30%;">Fasilitator</th>
                        <td>{{ $form->fasilitator ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Pencatat</th>
                        <td>{{ $form->pencatat ?? '-' }}</td>
                    </tr>
                </table>

                <!-- Hasil Diskusi -->
                <div class="table-header">HASIL DISKUSI</div>
                <table class="form-table">
                    <tr>
                        <th colspan="2" class="bg-info text-white">1. AKSES DAN HAK TERHADAP SUMBER DAYA</th>
                    </tr>
                    <tr>
                        <td colspan="2">{!! nl2br(e($form->akses_hak ?? '-')) !!}</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="bg-info text-white">2. FUNGSI PRANATA SOSIAL DAN KEAGAMAAN</th>
                    </tr>
                    <tr>
                        <td colspan="2">{!! nl2br(e($form->fungsi_pranata ?? '-')) !!}</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="bg-info text-white">3. RESIKO DAN KERENTANAN</th>
                    </tr>
                    <tr>
                        <td colspan="2">{!! nl2br(e($form->resiko_kerentanan ?? '-')) !!}</td>
                    </tr>
                </table>

                <!-- Informasi Pembuat -->
                @if ($form->created_by)
                    <div class="table-header">INFORMASI PEMBUAT</div>
                    <table class="form-table">
                        <tr>
                            <th style="width: 30%;">Dibuat Oleh</th>
                            <td>{{ $form->creator->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Dibuat</th>
                            <td>{{ $form->created_at ? $form->created_at->format('d F Y H:i') : '-' }}</td>
                        </tr>
                        @if ($form->updated_by)
                            <tr>
                                <th>Diubah Oleh</th>
                                <td>{{ $form->updater->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Diubah</th>
                                <td>{{ $form->updated_at ? $form->updated_at->format('d F Y H:i') : '-' }}</td>
                            </tr>
                        @endif
                    </table>
                @endif

                <!-- Action Buttons -->
                <div class="btn-group-custom">
                    <a href="{{ route('forms.form7.list', ['bencana_id' => $form->bencana_id]) }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('forms.form7.edit', $form->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('forms.form7.pdf', $form->id) }}" class="btn btn-danger" target="_blank">
                        <i class="bi bi-file-pdf"></i> Download PDF
                    </a>
                    <form action="{{ route('forms.form7.destroy', $form->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
