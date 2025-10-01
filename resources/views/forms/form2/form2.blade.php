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
    .form-label {
        display: inline-block;
        width: 160px;
    }
    .form-indent {
        margin-left: 160px;
    }
    p {
        margin-bottom: 0.8em;
        line-height: 1.5;
    }
    textarea.form-input {
        resize: vertical;
        min-height: 60px;
        border: 1px dotted #000;
        padding: 5px;
        line-height: 1.5;
    }
</style>

<form method="POST" action="{{ route('forms.form2.store') }}">
@csrf
<input type="hidden" name="form_type" value="form2">
<input type="hidden" name="bencana_id" value="{{ request('bencana_id') }}">
<input type="hidden" name="lokasi_hidden" value="{{ $lokasi_menimbang ?? '' }}">
 
<div class="container" style="max-width: 800px; font-family: Times New Roman, serif;">    
    <div class="text-center mb-4">
        <h5><strong>Formulir 02</strong></h5>
        <h5>Surat Keputusan Pembentukan Tim Kerja Pengkajian Kebutuhan Pascabencana</h5>
    </div>
    <div class="card">
        <div class="card-body">

            <p class="text-center"><strong>SURAT KEPUTUSAN</strong><br>
            No: <input type="text" name="nomor_surat" value="{{ $nomor_surat ?? '' }}" placeholder="Nomor Surat" class="form-input" style="width: 200px; background: transparent; border: none; border-bottom: 1px dotted #000; font-family: inherit; font-size: inherit; color: inherit; outline: none;"><br><br>        <strong>TENTANG</strong><br>    
                <strong>PEMBENTUKAN TIM KERJA PENGKAJIAN KEBUTUHAN PASCA BENCANA (PDNA) DI <span id="display_lokasi" style="text-decoration: underline; display: inline-block; min-width: 50px;">{{ $lokasi_menimbang ?? '' }}</span>
                </strong>
            </p>    
            <p>
            <strong>Menimbang</strong> : </p>      <ol type="a" style="padding-left: 20px;">
                <li>bahwa dalam rangka perencanaan rehabilitasi dan rekonstruksi pascabencana di <input type="text" name="lokasi_menimbang" value="{{ $lokasi_menimbang ?? '' }}" placeholder="Nama Lokasi" class="form-input" style="width: 150px; background: transparent; border: none; border-bottom: 1px dotted #000; font-family: inherit; font-size: inherit; color: inherit; outline: none;" oninput="updateLokasiDisplay(this.value)" onchange="updateLokasiDisplay(this.value)"> perlu dilaksanakan pengkajian kebutuhan pascabencana.</li>
                <li>bahwa untuk melaksanakan pengkajian kebutuhan pasca bencana perlu dibentuk tim kerja pengkajian kebutuhan pascabencana.</li>
                <li>bahwa untuk maksud tersebut huruf b, perlu ditetapkan dengan keputusan <input type="text" name="pejabat_keputusan" value="{{ $pejabat_keputusan ?? 'Deputi Rehabilitasi dan Rekonstruksi BNPB (atau Kepala BPBD...)' }}" placeholder="Nama Pejabat/Jabatan" class="form-input" style="width: 400px;" oninput="updatePejabat(this.value)" onchange="updatePejabat(this.value)"></li>
            </ol>

            <p><strong>Mengingat</strong> :</p>
            <ol type="a" style="padding-left: 20px;">
                <li>Undang-Undang no. 24 tahun 2007 tentang Penanggulangan Bencana.</li>
                <li>Peraturan Pemerintah no. 21 tahun 2008 tentang Penyelenggaraan Penanggulangan Bencana.</li>
                <li>Peraturan Kepala BNPB no. 17 tahun 2010 tentang Pedoman Umum Rehabilitasi dan Rekonstruksi.</li>
            </ol>

            <p class="text-center"><strong>MEMUTUSKAN</strong></p>

            <p><strong>Menetapkan</strong> :</p>

            <p><strong>PERTAMA</strong> : Membentuk Tim Kerja Pengkajian Kebutuhan Pascabencana di <span id="display_lokasi_pertama" style="text-decoration: underline; display: inline-block; min-width: 50px;">{{ $lokasi_menimbang ?? '' }}</span>, dengan susunan personil sebagaimana terdapat pada lampiran keputusan ini.</p>

            <p><strong>KEDUA</strong> : Tim dimaksud diktum pertama mempunyai tugas sebagai berikut:</p>

            <ol style="padding-left: 20px;">
                <li>Melakukan perencanaan dan persiapan pelaksanaan pengkajian kebutuhan pascabencana.</li>
                <li>Melakukan pengumpulan data.</li>
                <li>Melakukan pengolahan dan analisis data.</li>
                <li>Menyusun laporan pengkajian kebutuhan pascabencana.</li>
            </ol>

            <p><strong>KETIGA</strong> : Tim Kerja dalam melaksanakan tugasnya bertanggung jawab kepada <span id="display_pejabat_ketiga" style="text-decoration: underline; display: inline-block; min-width: 50px;">{{ $pejabat_keputusan ?? '' }}</span> </p>

            <p><strong>KEEMPAT</strong> : Keputusan ini berlaku sejak tanggal ditetapkan, apabila dikemudian hari terdapat kekeliruan dalam penetapan ini akan diperbaiki sebagaimana mestinya.</p>

            <br>    <p>Ditetapkan di &nbsp;&nbsp;&nbsp;: <input type="text" name="tempat_ditetapkan" value="{{ $tempat_ditetapkan ?? '' }}" placeholder="Nama Kota" class="form-input" style="width: 200px;"><br>
            Pada tanggal &nbsp;&nbsp;: <input type="date" name="tanggal_ditetapkan_date" value="{{ $tanggal_ditetapkan_date ?? '' }}" onchange="formatTanggalDitetapkan(this)" class="form-input" style="width: 200px;">
            <input type="hidden" name="tanggal_ditetapkan" value="{{ $tanggal_ditetapkan ?? '' }}">    <span id="display_tanggal_ditetapkan">{{ $tanggal_ditetapkan ?? '' }}</span></p>

            <div class="text-right" style="margin-right: 100px;">
                <p><span id="display_jabatan_penandatangan">{{ $pejabat_keputusan ?? '' }}</span></p>

                <br><br>
                <p><strong><input type="text" name="nama_penandatangan" value="{{ $nama_penandatangan ?? '' }}" placeholder="Nama Penandatangan" class="form-input" style="width: 200px; font-weight: bold;"></strong></p>
            </div><br>
            <p><strong>Tembusan Yth.</strong></p>
            <textarea name="tembusan" class="form-input" style="width: 100%; height: 100px; margin-top: 5px;">{{ $tembusan_text ?? '1. Kepala BNPB (atau Kepala Daerah)
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
function formatTanggalDitetapkan(dateInput) {
    if(dateInput.value) {
        const date = new Date(dateInput.value);
        const day = date.getDate();
        const month = date.getMonth() + 1; // Months are 0-indexed
        const year = date.getFullYear();
        
        // Format tanggal: DD Month YYYY (e.g., "15 Juni 2025")
        const formattedDate = day + " " + getMonthName(month) + " " + year;
        
        document.querySelector('input[name="tanggal_ditetapkan"]').value = formattedDate;
        const displayElement = document.getElementById('display_tanggal_ditetapkan');
        if (displayElement) {
            displayElement.textContent = formattedDate;
        }
    }
}

function getMonthName(month) {
    const monthNames = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    return monthNames[month-1];
}

// Initialize all fields when the page loads
document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM fully loaded!");
    
    // Debug info - check if all required elements exist
    console.log("Display elements on load:", {
        display_lokasi: document.getElementById('display_lokasi'),
        display_lokasi_pertama: document.getElementById('display_lokasi_pertama'),
        lokasi_input: document.querySelector('input[name="lokasi_menimbang"]')
    });
    
    // Initialize date field if it has a value
    const tanggalInput = document.querySelector('input[name="tanggal_ditetapkan_date"]');
    if (tanggalInput && tanggalInput.value) {
        formatTanggalDitetapkan(tanggalInput);
    }
    
    // Initialize location field if it has a value (similar to updateLokasiPdna in form1)
    const lokasiInput = document.querySelector('input[name="lokasi_menimbang"]');
    if (lokasiInput) {
        console.log("Found lokasi input with value:", lokasiInput.value);
        
        // Ensure initial value is loaded from default value
        setTimeout(() => {
            updateLokasiDisplay(lokasiInput.value);
        }, 100);
        
        // Add event listeners explicitly
        lokasiInput.addEventListener('input', function() {
            console.log("Input event triggered with value:", this.value);
            updateLokasiDisplay(this.value);
        });
        
        lokasiInput.addEventListener('change', function() {
            console.log("Change event triggered with value:", this.value);
            updateLokasiDisplay(this.value);
        });
    } else {
        console.error("Lokasi input element not found!");
    }
      // Initialize pejabat field if it has a value
    const pejabatInput = document.querySelector('input[name="pejabat_keputusan"]');
    if (pejabatInput) {
        console.log("Found pejabat input with value:", pejabatInput.value);
        
        // Ensure initial value is loaded
        setTimeout(() => {
            updatePejabat(pejabatInput.value);
        }, 100);
        
        // Add event listeners explicitly
        pejabatInput.addEventListener('input', function() {
            console.log("Pejabat input event triggered with value:", this.value);
            updatePejabat(this.value);
        });
        
        pejabatInput.addEventListener('change', function() {
            console.log("Pejabat change event triggered with value:", this.value);
            updatePejabat(this.value);
        });
    } else {
        console.error("Pejabat input element not found!");
    }
});

function updateLokasiDisplay(value) {
    console.log("Updating location to:", value);
    
    // Debug info - check if elements exist
    console.log("Display elements:", 
        document.getElementById('display_lokasi'), 
        document.getElementById('display_lokasi_pertama')
    );
    
    // Update all display spans with the location value (like in lines 47 and 67)
    const displayElement1 = document.getElementById('display_lokasi');
    if (displayElement1) {
        displayElement1.textContent = value || '';
        console.log("Updated display_lokasi to:", displayElement1.textContent);
    } else {
        console.error("Element with ID 'display_lokasi' not found!");
    }
    
    const displayElement2 = document.getElementById('display_lokasi_pertama');
    if (displayElement2) {
        displayElement2.textContent = value || '';
        console.log("Updated display_lokasi_pertama to:", displayElement2.textContent);
    } else {
        console.error("Element with ID 'display_lokasi_pertama' not found!");
    }
    
    // Set hidden input value if needed
    const hiddenInput = document.querySelector('input[name="lokasi_hidden"]');
    if (hiddenInput) {
        hiddenInput.value = value;
    }
    
    // Also update any other instances that might use this value
    const lokasiInputs = document.querySelectorAll('input[name="lokasi_menimbang"]');
    lokasiInputs.forEach(input => {
        if (input !== document.activeElement) {  // Don't update the currently focused input
            input.value = value;
        }
    });
}

function updatePejabat(value) {
    console.log("Updating pejabat to:", value);
    
    // Debug info - check if elements exist
    console.log("Pejabat display elements:", 
        document.getElementById('display_jabatan_penandatangan'),
        document.getElementById('display_pejabat_ketiga')
    );
    
    // Update the penandatangan display with the pejabat value (line 87)
    const displayElement1 = document.getElementById('display_jabatan_penandatangan');
    if (displayElement1) {
        displayElement1.textContent = value || 'Deputi Rehabilitasi dan Rekonstruksi BNPB (atau Kepala BPBD...)';
        console.log("Updated display_jabatan_penandatangan to:", displayElement1.textContent);
    } else {
        console.error("Element with ID 'display_jabatan_penandatangan' not found!");
    }
    
    // Update the KETIGA section display with the pejabat value (line 78)
    const displayElement2 = document.getElementById('display_pejabat_ketiga');
    if (displayElement2) {
        displayElement2.textContent = value || 'Deputi Rehabilitasi dan Rekonstruksi BNPB atau Kepala Daerah';
        console.log("Updated display_pejabat_ketiga to:", displayElement2.textContent);
    } else {
        console.error("Element with ID 'display_pejabat_ketiga' not found!");
    }
    
    // Also update any other instances that might use this value
    const pejabatInputs = document.querySelectorAll('input[name="pejabat_keputusan"]');
    pejabatInputs.forEach(input => {
        if (input !== document.activeElement) {  // Don't update the currently focused input
            input.value = value;
        }
    });
}

function resetForm() {
    if (confirm('Apakah Anda yakin ingin mereset semua data form?')) {
        document.querySelector('form').reset();
        // Reset display elements
        document.getElementById('display_lokasi').textContent = '';
        document.getElementById('display_tanggal_ditetapkan').textContent = '';
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
            <title>Preview Form 2</title>
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
