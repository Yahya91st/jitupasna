@extends('layouts.main')

@section('content')
<style>        
     /* Container & Layout - Kombinasi Form3 & Form6 */
    * {
        font-family: 'Times New Roman', serif;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background: white;
        color: #333;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    /* Header Styling - Dari Form6 */
    .form-header {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ddd;
    }
    
    .form-header h5 {
        margin: 0.5rem 0;
        font-weight: bold;
        color: #333;
    }

    .form-header h5:first-child {
        color: #0066cc;
        margin-bottom: 0.3rem;
    }
    
    /* Table Styling - Kombinasi Form3 & Form6 */
    .form-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 13px;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
    }
    
    .form-table th, .form-table td {
        border: 1px solid #333;
        padding: 6px 4px;
        text-align: center;
        vertical-align: middle;
        word-wrap: break-word;
        font-size: 11px;
        line-height: 1.3;
    }
    
    .form-table th {
        background-color: #f9f9f9;
        font-weight: 600;
        text-align: center;
        color: #333;
    }
    
    .form-table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
    
    .form-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .form-table tbody tr:hover {
        background-color: rgba(0, 102, 204, 0.05);
        transition: background-color 0.2s ease;
    }
    
    .table-header {
        background-color: white !important;
        color: #333 !important;
        text-align: center;
        font-weight: bold;
        border: 1px solid #333;
        padding: 6px 4px;
        font-size: 11px;
        line-height: 1.2;
        vertical-align: middle;
    }
    
    /* Data row styling */
    .data-row td {
        padding: 6px 4px;
        font-size: 11px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #333;
        min-height: 25px;
    }
    
    .data-row td:first-child {
        font-weight: bold;
        background-color: #f9f9f9;
    }
    
    .data-row td[contenteditable="true"] {
        cursor: text;
        background-color: white;
        transition: background-color 0.2s ease;
    }
    
    .data-row td[contenteditable="true"]:hover {
        background-color: #f0f8ff;
    }
    
    .data-row td[contenteditable="true"]:focus {
        background-color: #e6f3ff;
        outline: 2px solid #0066cc;
        outline-offset: -2px;
    }
    
    /* Total row styling */
    .total-row {
        font-weight: bold;
        text-align: center;
        background-color: #e9ecef !important;
        border-top: 2px solid #333;
    }
    
    .total-row td {
        background-color: #e9ecef !important;
        font-weight: 700;
        color: #333;
        border: 1px solid #333;
        padding: 8px 4px;
        font-size: 12px;
    }
    
    /* Button Styling - Kombinasi Form3 & Form6 */
    .form-button {
        margin: 0 5px;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        font-family: 'Times New Roman', serif;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }
    
    .btn-success {
        background: #28a745;
        color: white;
    }
    
    .btn-warning {
        background: #ffc107;
        color: #212529;
    }
    
    .btn-info {
        background: #17a2b8;
        color: white;
    }
    
    .btn-secondary {
        background: #6c757d;
        color: white;
    }
    
    /* Action buttons container - Dari Form3 */
    .d-flex {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    
    /* Responsive */
    @media (max-width: 1200px) {
        .container {
            max-width: 100%;
            padding: 10px;
        }
        
        .form-table {
            font-size: 11px;
        }
        
        .form-table th, .form-table td {
            padding: 4px;
        }
    }
    
    @media (max-width: 768px) {
        .form-table {
            font-size: 10px;
        }
        
        .form-button {
            margin: 2px;
            padding: 6px 12px;
            font-size: 12px;
        }
    }
    
    /* Print Styles */
    @media print {
        .form-table {
            page-break-inside: auto;
            border: 2px solid #000 !important;
        }
        
        .form-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        
        .form-table td, 
        .form-table th {
            border: 1px solid #000 !important;
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }
        
        .form-table thead th {
            background-color: #b3b3b3 !important;
            border-bottom: 2px solid #000 !important;
        }
        
        .total-row td {
            border-top: 2px solid #000 !important;
            border-bottom: 2px solid #000 !important;
            background-color: #e9ecef !important;
        }
        
        .form-button {
            display: none !important;
        }
        
        .container {
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

<form method="POST" action="{{ route('forms.form8.store') }}">
@csrf
<input type="hidden" name="form_type" value="form8">
<input type="hidden" name="bencana_id" value="{{ request('bencana_id') }}">

<div class="container">    
    <!-- Document Header - Style dari Form6 -->
    <div class="form-header">
        <h5><strong>Formulir 08</strong></h5>
        <h5>Formulir Pengolahan dan Analisis Data Penilaian Kerusakan dan Kerugian</h5>
    </div>
    
    <table class="form-table">
        <thead>
            <tr>
                <th class="table-header" rowspan="2" style="width: 3%;">No</th>
                <th class="table-header" rowspan="2" style="width: 12%;">Sektor/Sub Sektor</th>
                <th class="table-header" rowspan="2" style="width: 15%;">Komponen Kerusakan dan Kerugian</th>
                <th class="table-header" rowspan="2" style="width: 10%;">Lokasi</th>                
                <th class="table-header" colspan="3" style="width: 12%;">Data Kerusakan</th>
                <th class="table-header" colspan="3" style="width: 12%;">Harga Satuan (Rp.)</th>
                <th class="table-header" colspan="3" style="width: 12%;">Nilai Kerusakan (Damage)</th>
                <th class="table-header" rowspan="2" style="width: 8%;">Perkiraan Kerugian (Losses)</th>
                <th class="table-header" rowspan="2" style="width: 8%;">Kerusakan + Kerugian</th>
                <th class="table-header" rowspan="2" style="width: 8%;">Kebutuhan</th>
            </tr>            
            <tr>
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
            @for ($i = 1; $i <= 15; $i++)
            <tr class="data-row">
                <td style="text-align: center;">{{ $i }}</td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                @for ($j = 0; $j < 12; $j++)
                    <td contenteditable="true"></td>
                @endfor
            </tr>
            @endfor
            <tr class="total-row">
                <td colspan="4" style="text-align: center; font-weight: bold;">JUMLAH</td>
                @for ($j = 0; $j < 12; $j++)
                    <td style="text-align: center;">&nbsp;</td>
                @endfor
            </tr>
        </tbody>    
    </table>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to setup event listeners for a row
            function setupRowListeners(row) {
                const cells = row.querySelectorAll('[contenteditable="true"]');
                cells.forEach(cell => {
                    // Add focus/blur events for better UI
                    cell.addEventListener('focus', function() {
                        this.classList.add('editing');
                    });
                    
                    cell.addEventListener('blur', function() {
                        this.classList.remove('editing');
                    });
                });
            }
            
            // Setup listeners for all rows
            const allRows = document.querySelectorAll('.data-row');
            allRows.forEach(row => {
                setupRowListeners(row);
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
</div>
</form>

@endsection
