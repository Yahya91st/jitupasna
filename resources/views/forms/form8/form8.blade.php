@extends('layouts.main')

@section('content')
<style>    @page {
        size: landscape;
        margin: 1cm;
    }
    
    body {
        margin: 0;
        padding: 10px;
        background-color: #fff;
    }
    
    .report-container {
        max-width: 100%;
        margin: 0 auto;
        font-family: Arial, sans-serif;
    }
      .report-header {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 2px solid #000;
    }
      .report-title {
        font-size: 20px;
        font-weight: bold;
        margin: 5px 0;
        text-transform: uppercase;
    }
    
    .report-subtitle {
        font-size: 16px;
        font-weight: bold;
        margin-top: 5px;
    }.report-table {
        width: 100%;
        font-size: 14px;
        border-collapse: collapse;
        border: 3px solid #000;
        box-shadow: 0 0 3px rgba(0,0,0,0.2);
    }
      .report-table th,
    .report-table td {
        border: 1.5px solid #000;
        padding: 4px;
        vertical-align: middle;
    }
      .report-table th {
        background-color: #d1d1d1;
        font-weight: bold;
        text-align: center;
        border-bottom: 2px solid #000;
    }
    
    .report-table thead th {
        background-color: #b3b3b3;
        border-bottom: 3px solid #000;
        padding: 6px 4px;
    }
      .gray-header {
        background-color: #b3b3b3;
        border-bottom: 2px solid #000 !important;
    }
    
    .text-center {
        text-align: center;
    }
    
    .text-right {
        text-align: right;
    }
      .total-row {
        font-weight: bold;
        background-color: #d1d1d1;
        border-top: 2px solid #000;
        border-bottom: 2px solid #000;
    }
      .breakable-column {
        word-wrap: break-word;
        max-width: 150px;
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
        .report-table {
            page-break-inside: auto;
            border: 2.5px solid #000 !important;
        }
        
        .report-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        
        .report-table td, 
        .report-table th {
            border: 1.5px solid #000 !important;
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }
        
        .report-table thead th {
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

<div class="report-container">    <div class="report-header">
        <p style="margin: 0;">-</p>
        <div class="report-title">Formulir 08</div>
        <div class="report-subtitle">Formulir Pengolahan dan Analisis Data Penilaian Kerusakan dan Kerugian</div>
    </div>
    <table class="report-table">
        <thead>
            <tr>
                <th rowspan="3" style="width: 3%;">No</th>
                <th rowspan="3" style="width: 10%;">Sektor/Sub Sektor</th>
                <th rowspan="3" style="width: 15%;">Komponen Kerusakan dan Kerugian</th>
                <th rowspan="3" style="width: 10%;">Lokasi</th>                <th colspan="3" style="border-bottom: 2px solid #000; background-color: #b8b8b8;">Data Kerusakan</th>
                <th colspan="3" style="border-bottom: 2px solid #000; background-color: #b8b8b8;">Harga Satuan (Rp.)</th>
                <th colspan="3" style="border-bottom: 2px solid #000; background-color: #b8b8b8;">Nilai Kerusakan (Damage)</th>
                <th rowspan="3" style="width: 8%;">Perkiraan Kerugian (Losses)</th>
                <th rowspan="3" style="width: 8%;">Kerusakan + Kerugian</th>
                <th rowspan="3" style="width: 8%;">Kebutuhan</th>
            </tr>            <tr class="text-center">
                <th style="width: 4%; background-color: #c6c6c6;">RB</th>
                <th style="width: 4%; background-color: #c6c6c6;">RS</th>
                <th style="width: 4%; background-color: #c6c6c6;">RR</th>
                <th style="width: 6%; background-color: #c6c6c6;">RB</th>
                <th style="width: 6%; background-color: #c6c6c6;">RS</th>
                <th style="width: 6%; background-color: #c6c6c6;">RR</th>
                <th style="width: 6%; background-color: #c6c6c6;">RB</th>
                <th style="width: 6%; background-color: #c6c6c6;">RS</th>
                <th style="width: 6%; background-color: #c6c6c6;">RR</th>
            </tr>
        </thead>        <tbody id="tableBody">            <tr class="data-row">
                <td style="text-align: center;">1</td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                @for ($j = 0; $j < 12; $j++)
                    <td contenteditable="true"></td>
                @endfor
            </tr>
            <tr class="total-row" style="font-weight: bold; text-align: center; background-color: #d1d1d1;">
                <td colspan="4" style="border-top: 2px solid #000; border-bottom: 2px solid #000;">Jumlah Total</td>
                @for ($j = 0; $j < 12; $j++)
                    <td style="border-top: 2px solid #000; border-bottom: 2px solid #000;">&nbsp;</td>
                @endfor
            </tr>
        </tbody>    </table>
      <div style="margin-top: 10px; margin-bottom: 20px; text-align: left;">
        <button id="addRowBtn" type="button" style="background-color: #4CAF50; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold;">+ Tambah Baris</button>
    </div>    <script>
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
    </script>
@endsection
