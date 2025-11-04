@extends('layouts.main')

@section('content')
<style>
    * {
        font-family: 'Times New Roman', serif;
    }

    .container {
        max-width: 900px;
        margin: 30px auto;
        padding: 30px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .form-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #0066cc;
    }

    .form-header h4 {
        color: #0066cc;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .form-header p {
        color: #666;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        font-family: 'Times New Roman', serif;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #0066cc;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 16px;
        font-weight: bold;
        color: #0066cc;
        margin: 25px 0 15px;
        padding-bottom: 8px;
        border-bottom: 1px solid #e0e0e0;
    }

    .btn-group {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
    }

    .btn {
        padding: 10px 25px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        font-family: 'Times New Roman', serif;
    }

    .btn-primary {
        background: #0066cc;
        color: white;
    }

    .btn-primary:hover {
        background: #0052a3;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 102, 204, 0.3);
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
    }

    .alert {
        padding: 12px 15px;
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .container {
            padding: 20px;
            margin: 15px;
        }
    }
</style>

<div class="container">
    <div class="form-header">
        <h4>Edit Data Form 8 Row</h4>
        <p>Edit data kerusakan dan kerugian per baris</p>
        @if(isset($bencana))
        <p style="margin-top: 10px;"><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama ?? 'N/A' }} - {{ $bencana->tanggal ? \Carbon\Carbon::parse($bencana->tanggal)->format('d F Y') : 'N/A' }}</p>
        @endif
    </div>

    @if($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan:</strong>
        <ul style="margin: 10px 0 0 20px; padding: 0;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('forms.form8.row.update', $row->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="section-title">Informasi Dasar</div>
        
        <div class="form-group">
            <label for="sektor_sub_sektor">Sektor/Sub Sektor *</label>
            <input type="text" class="form-control" id="sektor_sub_sektor" name="sektor_sub_sektor" 
                   value="{{ old('sektor_sub_sektor', $row->sektor_sub_sektor) }}" required>
        </div>

        <div class="form-group">
            <label for="komponen_kerusakan">Komponen Kerusakan *</label>
            <input type="text" class="form-control" id="komponen_kerusakan" name="komponen_kerusakan" 
                   value="{{ old('komponen_kerusakan', $row->komponen_kerusakan) }}" required>
        </div>

        <div class="form-group">
            <label for="lokasi">Lokasi *</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" 
                   value="{{ old('lokasi', $row->lokasi) }}" required>
        </div>

        <div class="section-title">Data Kerusakan</div>
        <div class="form-row">
            <div class="form-group">
                <label for="data_kerusakan_rb">Rusak Berat (RB)</label>
                <input type="number" step="0.01" class="form-control" id="data_kerusakan_rb" name="data_kerusakan_rb" 
                       value="{{ old('data_kerusakan_rb', $row->data_kerusakan_rb) }}">
            </div>
            <div class="form-group">
                <label for="data_kerusakan_rs">Rusak Sedang (RS)</label>
                <input type="number" step="0.01" class="form-control" id="data_kerusakan_rs" name="data_kerusakan_rs" 
                       value="{{ old('data_kerusakan_rs', $row->data_kerusakan_rs) }}">
            </div>
            <div class="form-group">
                <label for="data_kerusakan_rr">Rusak Ringan (RR)</label>
                <input type="number" step="0.01" class="form-control" id="data_kerusakan_rr" name="data_kerusakan_rr" 
                       value="{{ old('data_kerusakan_rr', $row->data_kerusakan_rr) }}">
            </div>
        </div>

        <div class="section-title">Harga Satuan (Rp)</div>
        <div class="form-row">
            <div class="form-group">
                <label for="harga_satuan_rb">RB</label>
                <input type="number" step="0.01" class="form-control" id="harga_satuan_rb" name="harga_satuan_rb" 
                       value="{{ old('harga_satuan_rb', $row->harga_satuan_rb) }}">
            </div>
            <div class="form-group">
                <label for="harga_satuan_rs">RS</label>
                <input type="number" step="0.01" class="form-control" id="harga_satuan_rs" name="harga_satuan_rs" 
                       value="{{ old('harga_satuan_rs', $row->harga_satuan_rs) }}">
            </div>
            <div class="form-group">
                <label for="harga_satuan_rr">RR</label>
                <input type="number" step="0.01" class="form-control" id="harga_satuan_rr" name="harga_satuan_rr" 
                       value="{{ old('harga_satuan_rr', $row->harga_satuan_rr) }}">
            </div>
        </div>

        <div class="section-title">Nilai Kerusakan (Rp)</div>
        <div class="form-row">
            <div class="form-group">
                <label for="nilai_kerusakan_rb">RB</label>
                <input type="number" step="0.01" class="form-control" id="nilai_kerusakan_rb" name="nilai_kerusakan_rb" 
                       value="{{ old('nilai_kerusakan_rb', $row->nilai_kerusakan_rb) }}">
            </div>
            <div class="form-group">
                <label for="nilai_kerusakan_rs">RS</label>
                <input type="number" step="0.01" class="form-control" id="nilai_kerusakan_rs" name="nilai_kerusakan_rs" 
                       value="{{ old('nilai_kerusakan_rs', $row->nilai_kerusakan_rs) }}">
            </div>
            <div class="form-group">
                <label for="nilai_kerusakan_rr">RR</label>
                <input type="number" step="0.01" class="form-control" id="nilai_kerusakan_rr" name="nilai_kerusakan_rr" 
                       value="{{ old('nilai_kerusakan_rr', $row->nilai_kerusakan_rr) }}">
            </div>
        </div>

        <div class="section-title">Kerugian dan Kebutuhan</div>
        <div class="form-row">
            <div class="form-group">
                <label for="perkiraan_kerugian">Perkiraan Kerugian (Rp)</label>
                <input type="number" step="0.01" class="form-control" id="perkiraan_kerugian" name="perkiraan_kerugian" 
                       value="{{ old('perkiraan_kerugian', $row->perkiraan_kerugian) }}">
            </div>
            <div class="form-group">
                <label for="jumlah_kerusakan_kerugian">Jumlah Kerusakan & Kerugian (Rp)</label>
                <input type="number" step="0.01" class="form-control" id="jumlah_kerusakan_kerugian" name="jumlah_kerusakan_kerugian" 
                       value="{{ old('jumlah_kerusakan_kerugian', $row->jumlah_kerusakan_kerugian) }}">
            </div>
            <div class="form-group">
                <label for="kebutuhan">Kebutuhan (Rp)</label>
                <input type="number" step="0.01" class="form-control" id="kebutuhan" name="kebutuhan" 
                       value="{{ old('kebutuhan', $row->kebutuhan) }}">
            </div>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('forms.form8.form8-per-baris', ['bencana_id' => $row->form8->bencana_id]) }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection
