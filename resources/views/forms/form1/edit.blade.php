{{-- filepath: c:\laragon\www\jitupasna\jitupasnab\resources\views\forms\form1\edit.blade.php --}}
@extends('layouts.main')

@section('content')
<style>
    .form-input {
        background: transparent;
        border: none;
        border-bottom: 1px dotted #000;
        font-family: inherit;
        font-size: inherit;
        color: inherit;
        outline: none;
    }
    textarea.form-input {
        resize: vertical;
        min-height: 60px;
        border: 1px dotted #000;
        padding: 5px;
        line-height: 1.5;
    }
    .form-label {
        display: inline-block;
        width: 160px;
        vertical-align: top;
    }
    .form-indent {
        margin-left: 160px;
    }
    p {
        margin-bottom: 0.8em;
        line-height: 1.5;
    }
    .form-row {
        display: flex;
        margin-bottom: 0.5em;
    }
    .form-row .form-label {
        flex: 0 0 160px;
    }
    .form-row .form-content {
        flex: 1;
    }
</style>

<div class="container" style="max-width: 800px; font-family: Times New Roman, serif;">
    <div class="text-center mb-4">
        <h5><strong>Edit Formulir 01</strong></h5>
        <h5>Surat Permohonan Keterlibatan dalam Pengkajian Kebutuhan Pascabencana (PDNA)</h5>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('forms.form1.update', $form->id) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="bencana_id" value="{{ $form->bencana_id }}">

                <p class="text-center">
                    <input type="text" name="kop_surat" value="{{ old('kop_surat', $form->kop_surat ?? 'Kop Surat BNPB (atau BPBD)') }}" class="form-input" style="width: 80%; text-align: center; font-style: italic;">
                </p>
                <p>
                    <span class="form-label">Nomor</span>:
                    <input type="text" name="nomor_surat" value="{{ old('nomor_surat', $form->nomor_surat) }}" class="form-input" style="width: 20%;">
                    ,
                    <input type="date" name="nomor_surat_date" value="{{ old('nomor_surat_date', $form->nomor_surat_date) }}" class="form-input" style="width: 25%;">
                </p>
                <p>
                    <span class="form-label">Sifat</span>:
                    <select name="sifat" class="form-input" style="width: auto;">
                        <option value="Segera" {{ old('sifat', $form->sifat) == 'Segera' ? 'selected' : '' }}>Segera</option>
                        <option value="Biasa" {{ old('sifat', $form->sifat) == 'Biasa' ? 'selected' : '' }}>Biasa</option>
                        <option value="Rahasia" {{ old('sifat', $form->sifat) == 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                    </select>
                </p>
                <p>
                    <span class="form-label">Lampiran</span>:
                    <input type="number" name="lampiran" value="{{ old('lampiran', $form->lampiran) }}" min="0" class="form-input" style="width: 50px;"> lembar
                </p>
                <p>
                    <span class="form-label">Perihal</span>: Permohonan Keterlibatan dalam<br>
                    <span class="form-indent">Pengkajian Kebutuhan Pascabencana (PDNA)</span><br>
                </p>
                <p style="margin-bottom: 1.5em;">
                    <span class="form-label" style="margin-bottom: 10px; display: block; margin-left: 160px; margin-top: 20px;">Kepada Yth</span>
                    <span class="form-indent">
                        <textarea name="kepada_jabatan" class="form-input" style="width: 80%; height: 60px; margin-bottom: 10px;">{{ old('kepada_jabatan', $form->kepada_jabatan ?? '') }}</textarea>
                    </span><br>
                    <span class="form-indent">di</span>
                    <input type="text" name="lokasi_pdna" value="{{ old('lokasi_pdna', $form->lokasi_pdna) }}" class="form-input" style="width: 50%;">
                </p>
                <p>
                    Berkenaan dengan akan diadakannya Pengkajian Kebutuhan Pascabencana (PDNA) di <span id="display_lokasi_pdna">{{ old('lokasi_pdna', $form->lokasi_pdna) }}</span>, bersama ini kami memohon keterlibatan perwakilan resmi instansi Bapak/Ibu dalam kegiatan tersebut.<br><br>
                    Untuk konsolidasi awal, mohon kiranya perwakilan resmi instansi Bapak/Ibu dapat hadir pada pertemuan yang akan diadakan pada:
                </p>
                <p>
                    <span class="form-label">Hari/tanggal</span>:
                    <input type="date" name="hari_tanggal_date" value="{{ old('hari_tanggal_date', $form->hari_tanggal_date) }}" class="form-input" style="width: 30%;">
                    <input type="hidden" name="hari_tanggal" value="{{ old('hari_tanggal', $form->hari_tanggal) }}">
                    <span id="display_hari_tanggal">{{ old('hari_tanggal', $form->hari_tanggal) }}</span><br>
                    <span class="form-label">Waktu</span>:
                    <input type="time" name="waktu_time" value="{{ old('waktu_time', $form->waktu_time) }}" class="form-input" style="width: 30%;">
                    <input type="hidden" name="waktu" value="{{ old('waktu', $form->waktu) }}">
                    <span id="display_waktu">{{ old('waktu', $form->waktu) }}</span><br>
                    <span class="form-label">Tempat</span>:
                    <input type="text" name="tempat" value="{{ old('tempat', $form->tempat) }}" class="form-input" style="width: 60%;"><br>
                    <span class="form-label">Agenda</span>:
                    <textarea name="agenda" class="form-input" style="width: 60%; height: 60px;">{{ old('agenda', $form->agenda) }}</textarea>
                </p>
                <p>Demikian atas kerjasamanya diucapkan terima kasih.</p>
                <br>
                <div style="text-align: right; margin-right: 100px;">
                    <div style="text-align: left; margin-bottom: 10px;">
                        <strong>Kepada:</strong>
                    </div>
                    <span id="display_kepada_jabatan" style="display: inline-block; margin-left: 5px; text-decoration: underline;">{{ old('kepada_jabatan', $form->kepada_jabatan) }}</span>
                    <br><br>
                    <input type="text" name="nama_penandatangan" value="{{ old('nama_penandatangan', $form->nama_penandatangan) }}" class="form-input" style="text-align: center; font-weight: bold; width: 350px;">
                </div>
                <br>
                <p><strong>Tembusan Yth.</strong></p>
                <textarea name="tembusan" class="form-input" style="width: 100%; height: 100px; margin-top: 5px;">{{ old('tembusan', $form->tembusan) }}</textarea>

                <div class="d-flex gap-2 justify-content-center mt-4 mb-3">
                    <a href="{{ route('forms.form1.show', $form->id) }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection