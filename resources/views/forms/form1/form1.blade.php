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
    }.form-label {
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

<form method="POST" action="{{ route('forms.form1.store') }}">
@csrf
    <input type="hidden" name="form_type" value="form1">
    <input type="hidden" name="bencana_id" value="{{ request('bencana_id') }}">

    <div class="container" style="max-width: 800px; font-family: Times New Roman, serif;">    
        <div class="text-center mb-4">
            <h5><strong>Formulir 01</strong></h5>
            <h5>Surat Permohonan Keterlibatan dalam Pengkajian Kebutuhan Pascabencana (PDNA)</h5>
        </div>
        <div class="card">
            <div class="card-body">
                
                <p class="text-center">
                    <input type="text" name="kop_surat" value="{{ $kop_surat ?? 'Kop Surat BNPB (atau BPBD)' }}" class="form-input" style="width: 80%; text-align: center; font-style: italic;">
                </p>    
                <p>
                    <span class="form-label">Nomor</span>: 
                    <input type="text" name="nomor_surat" value="{{ $nomor_surat ?? '' }}" placeholder="Nomor" class="form-input" style="width: 20%;">, 
                    <input type="date" name="nomor_surat_date" value="{{ $nomor_surat_date ?? '' }}" onchange="formatDate(this)" class="form-input" style="width: 25%;">
                    {{-- <input type="hidden" name="nomor_surat_part2" value="{{ $nomor_surat_part2 ?? '' }}">  --}}
                    {{-- <input type="text" name="nomor_surat_part3" value="{{ $nomor_surat_part3 ?? '' }}" placeholder="Tahun" class="form-input" style="width: 20%;"> --}}
                </p>

                <p>
                    <span class="form-label">Sifat</span>: 
                    <select name="sifat" class="form-input" style="width: auto; display: inline-block; padding: 2px 0;">
                        <option value="Segera" {{ ($sifat ?? '') == 'Segera' ? 'selected' : '' }}>Segera</option>
                        <option value="Biasa" {{ ($sifat ?? '') == 'Biasa' ? 'selected' : '' }}>Biasa</option>
                        <option value="Rahasia" {{ ($sifat ?? '') == 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                    </select>
                </p>    
                <p>
                    <span class="form-label">Lampiran</span>: 
                    <input type="number" name="lampiran" value="{{ $lampiran ?? '' }}" min="0" placeholder="0" class="form-input" style="width: 50px;"> lembar
                </p>    
                <p>
                    <span class="form-label">Perihal</span>: Permohonan Keterlibatan dalam<br>        <span class="form-indent">Pengkajian Kebutuhan Pascabencana (PDNA)</span><br>
                </p>    
                <p style="margin-bottom: 1.5em;">
                    <span class="form-label" style="margin-bottom: 10px; display: block; margin-left: 160px; margin-top: 20px;">Kepada Yth</span>
                    <span class="form-indent">
                        <textarea name="kepada_jabatan" class="form-input" style="width: 80%; height: 60px; margin-bottom: 10px;" oninput="updateKepadaJabatan(this.value)" onchange="updateKepadaJabatan(this.value)">{{ $kepada_jabatan ?? 'Direktur Kementerian/Lembaga(atau Kepala OPD ....)' }}</textarea>
                    </span><br>
                    <span class="form-indent">di</span><input type="text" name="lokasi_pdna" value="{{ $lokasi_pdna ?? '' }}" placeholder="Lokasi" class="form-input" style="width: 50%;" oninput="updateLokasiPdna(this.value)">
                </p>

                <p>
                    Berkenaan dengan akan diadakannya Pengkajian Kebutuhan Pascabencana (PDNA) di <span id="display_lokasi_pdna">{{ $lokasi_pdna ?? '' }}</span>, bersama ini kami memohon keterlibatan perwakilan resmi instansi Bapak/Ibu dalam kegiatan tersebut.<br><br>
                    Untuk konsolidasi awal, mohon kiranya perwakilan resmi instansi Bapak/Ibu dapat hadir pada pertemuan yang akan diadakan pada:
                </p>    
                <p>        
                    <span class="form-label">Hari/tanggal</span>: 
                    <input type="date" name="hari_tanggal_date" value="{{ $hari_tanggal_date ?? '' }}" onchange="formatHariTanggal(this)" class="form-input" style="width: 30%;">
                    <input type="hidden" name="hari_tanggal" value="{{ $hari_tanggal ?? '' }}">
                    <span id="display_hari_tanggal">{{ $hari_tanggal ?? '' }}</span><br>
                    
                    <span class="form-label">Waktu</span>: 
                    <input type="time" name="waktu_time" value="{{ $waktu_time ?? '' }}" onchange="formatWaktu(this)" class="form-input" style="width: 30%;">
                    <input type="hidden" name="waktu" value="{{ $waktu ?? '' }}">
                    <span id="display_waktu">{{ $waktu ?? '' }}</span><br>        <span class="form-label">Tempat</span>: 
                    <input type="text" name="tempat" value="{{ $tempat ?? '' }}" placeholder="Lokasi pertemuan" class="form-input" style="width: 60%;"><br>        
                    <span class="form-label">Agenda</span>: <textarea name="agenda" class="form-input" style="width: 60%; height: 60px; vertical-align: middle;">{{ $agenda ?? '- Konsolidasi awal
                    - Persiapan Pengkajian Kebutuhan Pascabencana (PDNA)' }}</textarea>
                </p>
                <p>Demikian atas kerjasamanya diucapkan terima kasih.</p>    <br>    <div style="text-align: right; margin-right: 100px;">
                    <div style="text-align: left; margin-bottom: 10px;">
                        <strong>Kepada:</strong> 
                    </div>
                    <span id="display_kepada_jabatan" style="display: inline-block; margin-left: 5px; text-decoration: underline;">{{ $kepada_jabatan ?? 'Direktur Kementerian/Lembaga (atau Kepala OPD ....)' }}</span>

                    <br><br>
                    <input type="text" name="nama_penandatangan" value="{{ $nama_penandatangan ?? 'Nama Jelas' }}" class="form-input" style="text-align: center; font-weight: bold; width: 350px;">
                </div><br>
                <p><strong>Tembusan Yth.</strong></p>    <textarea name="tembusan" class="form-input" style="width: 100%; height: 100px; margin-top: 5px;">{{ $tembusan_text ?? '1. Kepala BNPB (atau Kepala Daerah)
                2. ... Menteri/Kepala Lembaga ... (atau Kepala OPD ....)
                3. Rektor .... (Perguruan Tinggi)
                4. Direktur/Manager/Koordinator .... (Organisasi Kemasyarakatan dan Dunia Usaha)' }}</textarea>

                <!-- Tombol Aksi -->
                <div class="d-flex gap-2 justify-content-center mt-4 mb-3">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan Data
                    </button>
                    <button type="reset" class="btn btn-warning" onclick="resetForm()">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </button>
                    <button type="button" class="btn btn-info" onclick="printForm()">
                        <i class="bi bi-printer"></i> Cetak
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="previewForm()">
                        <i class="bi bi-eye"></i> Preview
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function updateLokasiPdna(value) {
    // Update the displayed location in the paragraph text
    const displayElement = document.getElementById('display_lokasi_pdna');
    if (displayElement) {
        displayElement.textContent = value || '';
    }
    
    // Also update any other instances that might use this value
    const lokasiInputs = document.querySelectorAll('input[name="lokasi_pdna"]');
    lokasiInputs.forEach(input => {
        if (input !== document.activeElement) {  // Don't update the currently focused input
            input.value = value;
        }
    });
}

function updateKepadaJabatan(value) {
    console.log("Updating kepada jabatan to:", value);
    
    // Update the displayed kepada jabatan in the div
    const displayElement = document.getElementById('display_kepada_jabatan');
    if (displayElement) {
        displayElement.textContent = value || '';
        console.log("Updated display_kepada_jabatan to:", displayElement.textContent);
    } else {
        console.error("Element with ID 'display_kepada_jabatan' not found!");
    }
    
    // Also update any other instances that might use this value
    const kepadaInputs = document.querySelectorAll('textarea[name="kepada_jabatan"]');
    kepadaInputs.forEach(input => {
        if (input !== document.activeElement) {  // Don't update the currently focused input
            input.value = value;
        }
    });
}

function formatHariTanggal(dateInput) {
    if(dateInput.value) {
        const date = new Date(dateInput.value);
        const dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        const dayOfWeek = dayNames[date.getDay()];
        const day = date.getDate();
        const month = date.getMonth() + 1; // Months are 0-indexed
        const year = date.getFullYear();
        
        // Format: Hari, Tanggal Bulan Tahun (e.g., "Senin, 15 Juni 2025")
        const formattedDate = dayOfWeek + ", " + day + " " + getMonthName(month) + " " + year;
        
        // Update hidden input and display span
        document.querySelector('input[name="hari_tanggal"]').value = formattedDate;
        const displayElement = document.getElementById('display_hari_tanggal');
        if (displayElement) {
            displayElement.textContent = formattedDate;
        }
    }
}

function formatWaktu(timeInput) {
    if(timeInput.value) {
        const timeParts = timeInput.value.split(':');
        const hours = parseInt(timeParts[0]);
        const minutes = parseInt(timeParts[1]);
        
        // Format time in 24-hour format with WIB (Indonesia Western Time)
        const formattedTime = hours.toString().padStart(2, '0') + "." + minutes.toString().padStart(2, '0') + " WIB";
        
        // Update hidden input and display span
        document.querySelector('input[name="waktu"]').value = formattedTime;
        const displayElement = document.getElementById('display_waktu');
        if (displayElement) {
            displayElement.textContent = formattedTime;
        }
    }
}

// Initialize with any existing value on load
document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM fully loaded for form1!");
    
    // Debug info - check if all required elements exist
    console.log("Form1 elements on load:", {
        display_lokasi_pdna: document.getElementById('display_lokasi_pdna'),
        display_kepada_jabatan: document.getElementById('display_kepada_jabatan'),
        lokasi_input: document.querySelector('input[name="lokasi_pdna"]'),
        kepada_input: document.querySelector('textarea[name="kepada_jabatan"]')
    });
    
    const lokasiInput = document.querySelector('input[name="lokasi_pdna"]');
    if (lokasiInput && lokasiInput.value) {
        updateLokasiPdna(lokasiInput.value);
    }
    
    // Initialize kepada jabatan field if it has a value
    const kepadaInput = document.querySelector('textarea[name="kepada_jabatan"]');
    if (kepadaInput) {
        console.log("Found kepada jabatan input with value:", kepadaInput.value);
        
        // Ensure initial value is loaded from default value
        setTimeout(() => {
            updateKepadaJabatan(kepadaInput.value);
        }, 100);
        
        // Add event listeners explicitly
        kepadaInput.addEventListener('input', function() {
            console.log("Kepada jabatan input event triggered with value:", this.value);
            updateKepadaJabatan(this.value);
        });
        
        kepadaInput.addEventListener('change', function() {
            console.log("Kepada jabatan change event triggered with value:", this.value);
            updateKepadaJabatan(this.value);
        });
    }
    
    // Initialize date and time fields if they have values
    const tanggalInput = document.querySelector('input[name="hari_tanggal_date"]');
    if (tanggalInput && tanggalInput.value) {
        formatHariTanggal(tanggalInput);
    }
    
    const waktuInput = document.querySelector('input[name="waktu_time"]');
    if (waktuInput && waktuInput.value) {
        formatWaktu(waktuInput);
    }
});
function formatDate(dateInput) {
    if(dateInput.value) {
        const date = new Date(dateInput.value);
        const day = date.getDate();
        const month = date.getMonth() + 1; // Months are 0-indexed
        const formattedDate = day + ' ' + getMonthName(month);
        document.querySelector('input[name="nomor_surat_part2"]').value = formattedDate;
    }
}

function getMonthName(month) {
    const monthNames = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    return monthNames[month-1];
}

function resetForm() {
    if (confirm('Apakah Anda yakin ingin mereset semua data form?')) {
        document.querySelector('form').reset();
        // Reset display elements
        document.getElementById('display_lokasi_pdna').textContent = '';
        document.getElementById('display_hari_tanggal').textContent = '';
        document.getElementById('display_waktu').textContent = '';
        document.getElementById('display_kepada_jabatan').textContent = '';
    }
}

function printForm() {
    window.print();
}

function previewForm() {
    // Create preview window
    const previewWindow = window.open('', '_blank', 'width=800,height=600,scrollbars=yes');
    const formContent = document.querySelector('.container').cloneNode(true);
    
    // Remove buttons from preview
    const buttons = formContent.querySelectorAll('button');
    buttons.forEach(btn => btn.style.display = 'none');
    
    // Remove input borders for preview
    const inputs = formContent.querySelectorAll('.form-input');
    inputs.forEach(input => {
        const span = document.createElement('span');
        span.textContent = input.value || input.placeholder || '';
        span.style.borderBottom = '1px solid #000';
        span.style.minWidth = '100px';
        span.style.display = 'inline-block';
        input.parentNode.replaceChild(span, input);
    });
    
    previewWindow.document.write(`
        <html>
        <head>
            <title>Preview Form 1</title>
            <style>
                body { font-family: 'Times New Roman', serif; padding: 20px; }
                .card { border: none; }
                .card-body { padding: 0; }
            </style>
        </head>
        <body>
            ${formContent.outerHTML}
        </body>
        </html>
    `);
    previewWindow.document.close();
}
</script>     
@endsection
