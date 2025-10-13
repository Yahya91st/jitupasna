@extends('layouts.main')

@section('content')
<style>
    /* Form Input Styling - Improved */
    .form-input {
        background: transparent;
        border: none;
        border-bottom: 1px dotted #333;
        font-family: 'Times New Roman', serif;
        font-size: 14px;
        color: inherit;
        outline: none;
        padding: 2px 4px;
        transition: border-color 0.3s ease;
    }
    
    .form-input:focus {
        border-bottom-color: #0066cc;
        background-color: rgba(0, 102, 204, 0.05);
    }
    
    textarea.form-input {
        resize: vertical;
        min-height: 60px;
        border: 1px dotted #333;
        padding: 8px;
        line-height: 1.5;
        border-radius: 3px;
    }
    
    textarea.form-input:focus {
        border-color: #0066cc;
        background-color: rgba(0, 102, 204, 0.05);
    }

    select.form-input {
        border: 1px solid #ccc;
        padding: 4px 8px;
        border-radius: 3px;
        background-color: white;
    }
    
    /* Layout Styling - Consistent */
    .form-label {
        display: inline-block;
        width: 160px;
        vertical-align: top;
        font-weight: 500;
        color: #333;
    }
    
    .form-indent {
        margin-left: 160px;
    }
    
    /* Typography - Improved */
    p {
        margin-bottom: 0.8em;
        line-height: 1.6;
        text-align: justify;
        color: #333;
    }
    
    /* Container - Simple improvement */
    .form-container {
        max-width: 800px;
        font-family: 'Times New Roman', serif;
        margin: 0 auto;
        padding: 20px;
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    /* Title - Better styling */
    .document-title {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ddd;
    }

    .document-title h5 {
        margin: 0.5rem 0;
        font-weight: bold;
        color: #333;
    }

    .document-title h5:first-child {
        color: #0066cc;
        margin-bottom: 0.3rem;
    }

    /* Header section - Subtle improvement */
    .letter-header {
        text-align: center;
        margin-bottom: 20px;
        padding: 10px;
        background: #f9f9f9;
        border-radius: 4px;
    }

    .letter-header p {
        margin: 0;
        font-weight: 600;
        color: #333;
    }

    /* Buttons - Simple improvement */
    .action-buttons {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .btn {
        margin: 0 5px;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    /* Display elements - Highlight */
    #display_lokasi_pdna,
    #display_hari_tanggal,
    #display_waktu,
    #display_kepada_jabatan {
        font-weight: 600;
        color: #0066cc;
    }

    /* Print styles */
    @media print {
        .action-buttons {
            display: none !important;
        }
        
        .form-container {
            box-shadow: none;
            margin: 0;
            padding: 10px;
        }
        
        body {
            font-size: 12pt;
            line-height: 1.4;
        }
    }
</style>

<form method="POST" action="{{ route('forms.form1.store') }}">
@csrf
    <input type="hidden" name="form_type" value="form1">
    <input type="hidden" name="bencana_id" value="{{ request('bencana_id') }}">

    <div class="form-container">
        <!-- Document Header -->
        <div class="document-title">
            <h5><strong>Formulir 01</strong></h5>
            <h5>Surat Permohonan Keterlibatan dalam Pengkajian Kebutuhan Pascabencana (PDNA)</h5>
        </div>
        
        <div class="card">
            <div class="card-body">
                <!-- Letter Header -->
                <div class="letter-header">
                    <p><strong>Kop Surat BNPB (atau BPBD)</strong></p>
                </div>    
                                
                
                <!-- Letter Details -->
                <p>
                    <span class="form-label">Nomor</span>: 
                    <input type="text" name="nomor_surat" value="{{ $nomor_surat ?? '' }}" 
                           placeholder="Nomor surat" class="form-input" style="width: 200px;">, 
                    <input type="date" name="nomor_surat_date" value="{{ $nomor_surat_date ?? '' }}" 
                           onchange="formatDate(this)" class="form-input" style="width: 150px;">
                </p>

                <p>
                    <span class="form-label">Sifat</span>: 
                    <select name="sifat" class="form-input" style="width: auto;">
                        <option value="Segera" {{ ($sifat ?? '') == 'Segera' ? 'selected' : '' }}>Segera</option>
                        <option value="Biasa" {{ ($sifat ?? '') == 'Biasa' ? 'selected' : '' }}>Biasa</option>
                        <option value="Rahasia" {{ ($sifat ?? '') == 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                    </select>
                </p>
                
                <p>
                    <span class="form-label">Lampiran</span>: 
                    <input type="number" name="lampiran" value="{{ $lampiran ?? '' }}" 
                           min="0" placeholder="0" class="form-input" style="width: 60px;"> lembar
                </p>
                
                <p>
                    <span class="form-label">Perihal</span>: Permohonan Keterlibatan dalam<br>
                    <span class="form-indent">Pengkajian Kebutuhan Pascabencana (PDNA)</span>
                </p>                <!-- Recipient Section -->
                <div class="form-section recipient-section">
                    <p style="margin-bottom: 1.5em;">
                        <span class="form-label" style="margin-bottom: 10px; display: block; margin-left: 150px; margin-top: 20px;">
                            <strong>Kepada Yth</strong>
                        </span>
                        <span class="form-indent">
                            <textarea name="kepada_jabatan" class="form-input" 
                                      style="width: 80%; height: 60px; margin-bottom: 10px;" 
                                      oninput="updateKepadaJabatan(this.value)" 
                                      onchange="updateKepadaJabatan(this.value)"
                                      placeholder="Contoh: Direktur Kementerian/Lembaga (atau Kepala OPD ....)">{{ old('kepada_jabatan', $kepada_jabatan ?? '') }}</textarea>
                        </span><br>
                        <span class="form-indent">di </span>
                        <input type="text" name="lokasi_pdna" value="{{ $lokasi_pdna ?? '' }}" 
                               placeholder="Lokasi" class="form-input" style="width: 300px;" 
                               oninput="updateLokasiPdna(this.value)">
                    </p>
                </div>

                <!-- Letter Content -->
                <div class="form-section">
                    <p>
                        Berkenaan dengan akan diadakannya Pengkajian Kebutuhan Pascabencana (PDNA) di 
                        <span id="display_lokasi_pdna">{{ $lokasi_pdna ?? '' }}</span>, 
                        bersama ini kami memohon keterlibatan perwakilan resmi instansi Bapak/Ibu dalam kegiatan tersebut.
                    </p>
                    
                    <p>
                        Untuk konsolidasi awal, mohon kiranya perwakilan resmi instansi Bapak/Ibu dapat hadir pada pertemuan yang akan diadakan pada:
                    </p>
                </div>    
                
                <!-- Meeting Details -->
                <p>
                    <span class="form-label">Hari/tanggal</span>: 
                    <input type="date" name="hari_tanggal_date" value="{{ $hari_tanggal_date ?? '' }}" 
                           onchange="formatHariTanggal(this)" class="form-input" style="width: 30%;">
                    <input type="hidden" name="hari_tanggal" value="{{ $hari_tanggal ?? '' }}">
                    <span id="display_hari_tanggal" style="margin-left: 10px; font-style: italic; color: #666;">{{ $hari_tanggal ?? '' }}</span>
                </p>
                
                <p>
                    <span class="form-label">Waktu</span>: 
                    <input type="time" name="waktu_time" value="{{ $waktu_time ?? '' }}" 
                           onchange="formatWaktu(this)" class="form-input" style="width: 30%;">
                    <input type="hidden" name="waktu" value="{{ $waktu ?? '' }}">
                    <span id="display_waktu" style="margin-left: 10px; font-style: italic; color: #666;">{{ $waktu ?? '' }}</span>
                </p>
                
                <p>
                    <span class="form-label">Tempat</span>: 
                    <input type="text" name="tempat" value="{{ $tempat ?? '' }}" 
                           placeholder="Lokasi pertemuan" class="form-input" style="width: 60%;">
                </p>
                
                <p>
                    <span class="form-label">Agenda</span>: 
                    <textarea name="agenda" class="form-input" 
                              style="width: 60%; height: 60px; vertical-align: middle;"
                              placeholder="Agenda pertemuan">{{ $agenda ?? '- Konsolidasi awal
- Persiapan Pengkajian Kebutuhan Pascabencana (PDNA)' }}</textarea>
                </p>
                
                <p>Demikian atas kerjasamanya diucapkan terima kasih.</p>                
                <!-- Signature Section -->
                <div style="text-align: right; margin: 25px 100px 25px 0;">
                    <div style="text-align: left; margin-bottom: 15px;">
                        <strong>Kepada:</strong> 
                        <span id="display_kepada_jabatan" style="text-decoration: underline; margin-left: 10px; min-width: 200px; display: inline-block;">
                            {{ $kepada_jabatan ?? 'Direktur Kementerian/Lembaga (atau Kepala OPD ....)' }}
                        </span>
                    </div>

                    <input type="text" name="nama_penandatangan" 
                           value="{{ $nama_penandatangan ?? 'Nama Jelas' }}" 
                           class="form-input" 
                           style="text-align: center; font-weight: bold; width: 300px; margin-top: 50px; border-bottom: 2px solid #333;">
                </div>
                
                <!-- Copy Recipients -->
                <p><strong>Tembusan Yth.</strong></p>
                <textarea name="tembusan" class="form-input" 
                          style="width: 100%; height: 100px; margin-top: 8px;"
                          placeholder="Daftar tembusan">{{ $tembusan_text ?? '1. Kepala BNPB (atau Kepala Daerah)
2. ... Menteri/Kepala Lembaga ... (atau Kepala OPD ....)
3. Rektor .... (Perguruan Tinggi)
4. Direktur/Manager/Koordinator .... (Organisasi Kemasyarakatan dan Dunia Usaha)' }}</textarea>

                <!-- Action Buttons -->
                <div class="action-buttons">
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
    try {
        const previewWindow = window.open('', '_blank', 'width=800,height=600,scrollbars=yes');
        if (!previewWindow) {
            alert('Popup diblokir. Mohon izinkan popup untuk preview.');
            return;
        }
        
        const formContent = document.querySelector('.form-container').cloneNode(true);
        
        // Remove action buttons from preview
        const actionButtons = formContent.querySelector('.action-buttons');
        if (actionButtons) actionButtons.remove();
        
        // Replace inputs with their values for preview
        const inputs = formContent.querySelectorAll('.form-input');
        inputs.forEach(input => {
            const span = document.createElement('span');
            span.textContent = input.value || input.placeholder || '';
            span.style.borderBottom = '1px solid #000';
            span.style.minWidth = '100px';
            span.style.display = 'inline-block';
            span.style.padding = '2px 0';
            
            if (input.parentNode) {
                input.parentNode.replaceChild(span, input);
            }
        });
        
        previewWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Preview Form 1 - PDNA</title>
                <style>
                    body { 
                        font-family: 'Times New Roman', serif; 
                        padding: 20px; 
                        line-height: 1.6;
                        font-size: 14px;
                    }
                    .card { 
                        border: none; 
                        box-shadow: none;
                    }
                    .card-body { 
                        padding: 0; 
                    }
                    .form-container {
                        max-width: 100%;
                        box-shadow: none;
                    }
                    .document-title {
                        text-align: center;
                        margin-bottom: 2rem;
                        background: none !important;
                        border: none !important;
                    }
                </style>
            </head>
            <body>
                ${formContent.outerHTML}
            </body>
            </html>
        `);
        previewWindow.document.close();
    } catch (error) {
        console.error('Error creating preview:', error);
        alert('Terjadi kesalahan saat membuat preview.');
    }
}
</script>     
@endsection
