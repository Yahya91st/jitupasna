@extends('layouts.main')

@section('content')
<style>        
    .form-table {

        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 13px;
    }
      .form-table th, .form-table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
        vertical-align: top;
    }
      .form-table th {
        font-weight: bold;
        text-align: center;
    }
    .table-header {
        background-color: var(--bs-secondary) !important;
        color: white !important;
        text-align: center;
        font-weight: bold;
    }
    .form-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
        background: white;
    }
      .form-header {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 2px solid #000;
    }
      .form-title {
        font-size: 20px;
        font-weight: bold;
        margin: 5px 0;
        text-transform: uppercase;
    }
    
    .form-subtitle {
        font-size: 16px;
        font-weight: bold;
        margin-top: 5px;

    }
    #addRowBtn:hover {
        background-color: #45a049;
    }
      .data-row td {
        height: 28px;
    }
      [contenteditable="true"]:focus {
        outline: 2px solid #4CAF50;
        background-color: #f8f8f8;
    }
    
    [contenteditable="true"]:hover:not(:focus) {
        background-color: #f0f0f0;
    }
    
    .editing {
        background-color: #e8f5e9 !important;
    }
      @media print {
        .form-table {
            page-break-inside: auto;
            border: 2.5px solid #000 !important;
        }
        
        .form-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        
        .form-table td, 
        .form-table th {
            border: 1.5px solid #000 !important;
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }
        
        .form-table thead th {
            background-color: #b3b3b3 !important;
            border-bottom: 2.5px solid #000 !important;
        }
          .total-row td {
            border-top: 2.5px solid #000 !important;
            border-bottom: 2.5px solid #000 !important;
        }
        
        #addRowBtn, .no-print {
            display: none !important;
        }
    }
</style>

<div class="container">    
    <div class="text-center mb-4">
        <h5><strong>Formulir 08</strong></h5>
        <h5>Formulir Pengolahan dan Analisis Data Penilaian Kerusakan dan Kerugian</h5>
    </div>
    <div style="margin-top: 10px; margin-bottom: 20px; text-align: left;">
        <button id="addRowBtn" type="button" style="background-color: #4CAF50; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold;">+ Tambah Baris</button>
    </div>
    
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
    <table class="form-table">
        <thead>
            <tr>
                <th class="table-header" rowspan="3" style="width: 3%;">No</th>
                <th class="table-header" rowspan="3" style="width: 10%;">Sektor/Sub Sektor</th>
                <th class="table-header" rowspan="3" style="width: 15%;">Komponen Kerusakan dan Kerugian</th>
                <th class="table-header" rowspan="3" style="width: 10%;">Lokasi</th>                
                <th class="table-header" colspan="3">Data Kerusakan</th>
                <th class="table-header" colspan="3">Harga Satuan (Rp.)</th>
                <th class="table-header" colspan="3">Nilai Kerusakan (Damage)</th>
                <th class="table-header" rowspan="3" style="width: 8%;">Perkiraan Kerugian (Losses)</th>
                <th class="table-header" rowspan="3" style="width: 8%;">Kerusakan + Kerugian</th>
                <th class="table-header" rowspan="3" style="width: 8%;">Kebutuhan</th>
            </tr>            
            <tr class="text-center">
                <th class="table-header" style="width: 4%;">RB</th>
                <th class="table-header" style="width: 4%;">RS</th>
                <th class="table-header" style="width: 4%;">RR</th>
                <th class="table-header" style="width: 4%;">RB</th>
                <th class="table-header" style="width: 4%;">RS</th>
                <th class="table-header" style="width: 4%;">RR</th>
                <th class="table-header" style="width: 4%;">RB</th>
                <th class="table-header" style="width: 4%;">RS</th>
                <th class="table-header" style="width: 4%;">RR</th>
            </tr>
        </thead>        
        <tbody id="tableBody">            
            <tr class="data-row">
                <td style="text-align: center;">1</td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                @for ($j = 0; $j < 12; $j++)
                    <td contenteditable="true"></td>
                @endfor
            </tr>
            <tr class="total-row" style="font-weight: bold; text-align: center; background-color: #d1d1d1;">
                <td colspan="4">Jumlah Total</td>
                @for ($j = 0; $j < 12; $j++)
                    <td>&nbsp;</td>
                @endfor
            </tr>
        </tbody>    
    </table>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addRowBtn = document.getElementById('addRowBtn');
            const tableBody = document.getElementById('tableBody');
            
            // Function to setup event listeners for a row
            function setupRowListeners(row) {
                const cells = row.querySelectorAll('[contenteditable="true"]');
                cells.forEach(cell => {
                    cell.addEventListener('input', function() {
                        // Add any validation or calculation logic here if needed
                        // For example, if you need to calculate sums, etc.
                    });
                    
                    // Add focus/blur events for better UI
                    cell.addEventListener('focus', function() {
                        this.classList.add('editing');
                    });
                    
                    cell.addEventListener('blur', function() {
                        this.classList.remove('editing');
                    });
                });
            }
            
            // Setup listeners for initial row
            const initialRows = tableBody.querySelectorAll('.data-row');
            initialRows.forEach(row => {
                setupRowListeners(row);
            });
            
            addRowBtn.addEventListener('click', function() {
                // Get current number of data rows (excluding the total row)
                const dataRows = tableBody.querySelectorAll('.data-row');
                const rowCount = dataRows.length + 1;
                
                // Create new row
                const newRow = document.createElement('tr');
                newRow.className = 'data-row';
                
                // Create number cell
                const numberCell = document.createElement('td');
                numberCell.style.textAlign = 'center';
                numberCell.textContent = rowCount;
                newRow.appendChild(numberCell);
                
                // Create 15 editable cells (4 columns + 3x3 data columns + 3 extra columns)
                for (let i = 0; i < 15; i++) {
                    const cell = document.createElement('td');
                    cell.contentEditable = 'true';
                    newRow.appendChild(cell);
                }
                
                // Insert the new row before the total row
                const totalRow = tableBody.querySelector('.total-row');
                tableBody.insertBefore(newRow, totalRow);
                
                // Setup listeners for the new row
                setupRowListeners(newRow);
            });
        });
        
        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset semua data form?')) {
                // Reset all contenteditable cells
                const editableCells = document.querySelectorAll('[contenteditable="true"]');
                editableCells.forEach(cell => {
                    cell.textContent = '';
                });
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
            
            previewWindow.document.write(`
                <html>
                <head>
                    <title>Preview Form 8 - Analisis Kerusakan dan Kerugian</title>
                    <style>
                        body { font-family: 'Times New Roman', serif; padding: 20px; }
                        .form-table { border-collapse: collapse; width: 100%; font-size: 12px; }
                        .form-table td, .form-table th { border: 1px solid #000; padding: 4px; text-align: center; }
                        .table-header { background-color: #b3b3b3; }
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
