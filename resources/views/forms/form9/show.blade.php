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

        .form-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            table-layout: fixed;
        }

        .form-table th,
        .form-table td {
            padding: 2px 2px;
            border: 1px solid #333;
            text-align: center;
            vertical-align: middle;
            word-break: break-word;
        }

        .form-table th {
            font-size: 10px;
        }

        .form-table input[type="text"] {
            width: 100%;
            font-size: 10px;
            padding: 2px 2px;
            box-sizing: border-box;
        }

        @media (max-width: 900px) {

            .form-table,
            .form-table th,
            .form-table td {
                font-size: 8px;
                padding: 1px 1px;
            }

            .form-table input[type="text"] {
                font-size: 8px;
                padding: 1px 1px;
            }
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

            .form-table th,
            .form-table td {
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

    <div>
        <div class="card-body text-center card border-success">
            <i class="bi bi-list-ol" style="font-size: 2rem; color: #28a745;"></i>
            <h6 class="mt-2">Format Per Baris</h6>
            <p class="text-muted small">Detail lengkap setiap item dalam card terpisah</p>

        </div>
        <div>
            <div class="container text-center">
                <a href="{{ route('forms.form9.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left mr-2"></i> Kembali ke List
                </a>
                <h5>FORMULIR 9</h5>
                <h5>Form9</h5>
                <h5>Form9</h5>
            </div>
            <div class="container mt-3 mb-10">

                <table class="table-responsive">
                    <thead>
                        <tr>
                            <td style="border: 1px solid black;">No.</td>
                            <td style="border: 1px solid black;">form9_id</td>
                            <td style="border: 1px solid black;">pertanyaan_no</td>
                            <td style="border: 1px solid black;">jawaban_index</td>
                            <td style="border: 1px solid black;">kuesioner_1</td>
                            <td style="border: 1px solid black;">kuesioner_2</td>
                            <td style="border: 1px solid black;">kuesioner_3</td>
                            <td style="border: 1px solid black;">kuesioner_4</td>
                            <td style="border: 1px solid black;">kuesioner_5</td>
                            <td style="border: 1px solid black;">kuesioner_6</td>
                            <td style="border: 1px solid black;">Jumlah</td>
                            <td style="border: 1px solid black;">Persentase</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allRows as $index => $row)
                            <tr>
                                <td style="border: 1px solid black;">{{ $index + 1 }}</td>
                                <td style="border: 1px solid black;">{{ $row->form9 ? $row->form9->id : $row->form9_id }}</td>
                                <td style="border: 1px solid black;">{{ $row->pertanyaan_no }}</td>
                                <td style="border: 1px solid black;">{{ $row->jawaban_index }}</td>
                                <td style="border: 1px solid black;">{{ $row->kuesioner_1 }}</td>
                                <td style="border: 1px solid black;">{{ $row->kuesioner_2 }}</td>
                                <td style="border: 1px solid black;">{{ $row->kuesioner_3 }}</td>
                                <td style="border: 1px solid black;">{{ $row->kuesioner_4 }}</td>
                                <td style="border: 1px solid black;">{{ $row->kuesioner_5 }}</td>
                                <td style="border: 1px solid black;">{{ $row->kuesioner_6 }}</td>
                                <td style="border: 1px solid black;">{{ $row->jumlah }}</td>
                                <td style="border: 1px solid black;">{{ $row->persentase }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
