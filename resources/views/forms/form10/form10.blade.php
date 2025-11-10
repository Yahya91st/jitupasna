@extends('layouts.main')

@section('content')
    <style>
        /* Container styling - dari Form6 */
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            font-family: 'Times New Roman', serif;
        }

        /* Header styling - dari Form6 */
        .form-header {
            text-align: center;
            margin-bottom: 25px;
            padding: 20px 0;
            border-bottom: 3px solid #0066cc;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
        }

        .form-header h5 {
            margin: 8px 0;
            color: #333;
            font-weight: 600;
            font-size: 18px;
            font-family: 'Times New Roman', serif;
        }

        /* Table styling - Enhanced untuk Form10 */
        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: 'Times New Roman', serif;
            font-size: 12px;
            table-layout: fixed;
            background: white;
            border: 2px solid #333;
        }

        .form-table th,
        .form-table td {
            border: 1px solid #333;
            padding: 6px 4px;
            text-align: left;
            vertical-align: middle;
            word-wrap: break-word;
            overflow-wrap: break-word;
            line-height: 1.3;
        }

        .table-header {
            background-color: white !important;
            color: #333 !important;
            text-align: center;
            font-weight: bold;
            border: 1px solid #333;
            padding: 8px 4px;
            font-size: 11px;
            line-height: 1.2;
            vertical-align: middle;
        }

        /* Data row styling */
        .form-table tbody tr td {
            padding: 4px 3px;
            font-size: 11px;
            vertical-align: middle;
            border: 1px solid #333;
            min-height: 28px;
        }

        .form-table tbody tr td.bold {
            font-weight: bold;
            text-align: center;
            background-color: #f9f9f9;
        }

        /* Input styling - Enhanced untuk textarea */
        .form-table input[type="text"] {
            width: 100% !important;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 3px 4px;
            font-size: 11px;
            background-color: white;
            transition: all 0.2s ease;
            min-height: 20px;
            font-family: 'Times New Roman', serif;
        }

        .form-table input[type="text"]:focus {
            outline: 2px solid #0066cc;
            outline-offset: -2px;
            background-color: #f0f8ff;
            border-color: #0066cc;
        }

        .form-table input[type="text"]:hover {
            background-color: #f9f9f9;
            border-color: #0066cc;
        }

        /* Textarea styling for auto-converted inputs */
        .form-table textarea {
            width: 100% !important;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 3px 4px;
            font-size: 11px;
            background-color: white;
            transition: all 0.2s ease;
            min-height: 20px;
            font-family: 'Times New Roman', serif;
            resize: vertical;
        }

        .form-table textarea:focus {
            outline: 2px solid #0066cc;
            outline-offset: -2px;
            background-color: #f0f8ff;
            border-color: #0066cc;
        }

        .form-table textarea:hover {
            background-color: #f9f9f9;
            border-color: #0066cc;
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
                padding: 15px;
                margin: 10px;
            }

            .form-table {
                font-size: 12px;
            }

            .form-table th,
            .form-table td {
                padding: 6px 4px;
            }

            .form-table input[type="text"],
            .form-table textarea {
                font-size: 11px;
                padding: 4px 6px;
                min-height: 24px;
            }
        }

        @media (max-width: 768px) {
            .form-table {
                font-size: 11px;
            }

            .form-table th,
            .form-table td {
                padding: 4px 3px;
            }

            .form-table input[type="text"],
            .form-table textarea {
                font-size: 10px;
                padding: 3px 4px;
                min-height: 22px;
            }

            .form-button {
                margin: 2px;
                padding: 6px 12px;
                font-size: 12px;
            }

            .container {
                padding: 10px;
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

            .form-button,
            .no-print {
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

            .form-table input[type="text"],
            .form-table textarea {
                border: none !important;
                background: transparent !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Convert input fields to textareas for better data entry
            const cells = document.querySelectorAll('td input[type="text"]');
            cells.forEach(input => {
                // Create a textarea
                const textarea = document.createElement('textarea');
                textarea.name = input.name;
                textarea.className = input.className;
                textarea.style.width = '100%';
                textarea.style.border = 'none';
                textarea.style.padding = '4px';
                textarea.style.minHeight = '20px';
                textarea.style.height = 'auto';
                textarea.style.overflow = 'hidden';

                // Replace input with textarea
                input.parentNode.replaceChild(textarea, input);

                // Auto resize functionality
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            });
        });
    </script>
    <div class="container">
        <!-- Document Header - Style dari Form6 -->
        <div class="form-header">
            <h5><strong>Formulir 10</strong></h5>
            <h5>Analisa Data Akibat terhadap Akses, Fungsi dan Resiko, serta Analisa Kebutuhan</h5>
        </div>

        <form method="POST" action="{{ route('forms.form10.store') }}">
            @csrf
            <input type="hidden" name="form_type" value="form10">
            <input type="hidden" name="bencana_id" value="{{ request('bencana_id') }}">

            <table class="form-table">
                <thead>
                    <tr>
                        <th class="table-header" rowspan="2">No</th>
                        <th class="table-header" rowspan="2">Sektor-sub.sektor</th>
                        <th class="table-header" rowspan="2">Lokasi bencana terjadi</th>
                        <th class="table-header" colspan="3">Akibat terhadap akses, fungsi dan resiko</th>
                        <th class="table-header" rowspan="2">Kebutuhan-kegiatan pemulihan</th>
                    </tr>
                    <tr>
                        <th class="table-header">Point penting hasil pengolahan data survey</th>
                        <th class="table-header">Point penting hasil wawancara/FGD</th>
                        <th class="table-header">Point penting hasil pendalaman</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="bold">1</td>
                        <td class="bold">Perumahan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    @for ($i = 1; $i <= 5; $i++)
                        <tr>
                            <td></td>
                            <td></td>
                            <td><input type="text" name="perumahan_row_lokasi_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="perumahan_row_hasil_survey_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="perumahan_row_hasil_wawancara_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="perumahan_row_hasil_pendalaman_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="perumahan_row_kebutuhan_pemulihan_{{ $i }}" style="width: 100%; border: none;"></td>
                        </tr>
                    @endfor
                    <tr>
                        <td class="bold">2</td>
                        <td class="bold">Infrastruktur</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    @php
                        // mapping index ke slug sesuai permintaan
                        $slugs_infrastruktur = [
                            1 => 'transportasi',
                            2 => 'energi',
                            3 => 'dll',
                        ];
                    @endphp

                    @for ($i = 1; $i <= 3; $i++)
                        @php $slug = $slugs_infrastruktur[$i] ?? 'dll'; @endphp
                        <tr>
                            <td></td>
                            <td>{{ $slug }}</td>
                            <td><input type="text" name="{{ $slug }}_row_lokasi_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_hasil_survey_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_hasil_wawancara_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_hasil_pendalaman_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_kebutuhan_pemulihan_{{ $i }}" style="width: 100%; border: none;"></td>
                        </tr>
                    @endfor

                    <tr>
                        <td class="bold">3</td>
                        <td class="bold">Ekonomi Produktif</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @php
                        // mapping index ke slug sesuai permintaan
                        $slugs_ekonomi_produktif = [
                            1 => 'pertanian',
                            2 => 'peternakan',
                            3 => 'perikanan',
                            4 => 'dll',
                        ];
                    @endphp

                    @for ($i = 1; $i <= 4; $i++)
                        @php $slug = $slugs_ekonomi_produktif[$i] ?? 'dll'; @endphp
                        <tr>
                            <td></td>
                            <td>{{ $slug }}</td>
                            <td><input type="text" name="{{ $slug }}_row_lokasi_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_hasil_survey_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_hasil_wawancara_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_hasil_pendalaman_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_kebutuhan_pemulihan_{{ $i }}" style="width: 100%; border: none;"></td>
                        </tr>
                    @endfor

                    <tr>
                        <td class="bold">4</td>
                        <td class="bold">Sosial</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    @php
                        // mapping index ke slug sesuai permintaan
                        $slugs_sosial = [
                            1 => 'pendidikan',
                            2 => 'kesehatan',
                            3 => 'agama',
                            4 => 'budaya',
                            5 => 'dll',
                        ];
                    @endphp

                    @for ($i = 1; $i <= 5; $i++)
                        @php $slug = $slugs_sosial[$i] ?? 'dll'; @endphp
                        <tr>
                            <td></td>
                            <td>{{ $slug }}</td>
                            <td><input type="text" name="{{ $slug }}_row_lokasi_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_hasil_survey_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_hasil_wawancara_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_hasil_pendalaman_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_kebutuhan_pemulihan_{{ $i }}" style="width: 100%; border: none;"></td>
                        </tr>
                    @endfor

                    <tr>
                        <td class="bold">5</td>
                        <td class="bold">Lintas sektor</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    @php
                        // mapping index ke slug sesuai permintaan
                        $slugs_lintas_sektor = [
                            1 => 'pemerintahan',
                            2 => 'lingkungan_hidup',
                            3 => 'dll',
                        ];
                    @endphp

                    @for ($i = 1; $i <= 3; $i++)
                        @php $slug = $slugs_lintas_sektor[$i] ?? 'dll'; @endphp
                        <tr>
                            <td></td>
                            <td>{{ ucwords(str_replace('_', ' ', $slug)) }}</td>
                            <td><input type="text" name="{{ $slug }}_row_lokasi_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_hasil_survey_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_hasil_wawancara_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_hasil_pendalaman_{{ $i }}" style="width: 100%; border: none;"></td>
                            <td><input type="text" name="{{ $slug }}_row_kebutuhan_pemulihan_{{ $i }}" style="width: 100%; border: none;"></td>
                        </tr>
                    @endfor

                    <tr>
                        <td colspan="2" class="bold" style="text-align: center;">Jumlah Kebutuhan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" name="jumlah_kebutuhan_form10" style="width: 100%; border: none;"></td>
                    </tr>
                </tbody>
            </table>

            <!-- Tombol Aksi -->
            <div class="d-flex gap-2 justify-content-center mt-4 mb-3">
                <button type="submit" class="btn btn-success form-button">
                    <i class="bi bi-save"></i> Simpan Data
                </button>
                <button type="reset" class="btn btn-warning form-button" onclick="resetForm()">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </button>
                <button type="button" class="btn btn-info form-button" onclick="printForm()">
                    <i class="bi bi-printer"></i> Cetak
                </button>
                <button type="button" class="btn btn-secondary form-button" onclick="previewForm()">
                    <i class="bi bi-eye"></i> Preview
                </button>
            </div>
        </form>
    </div>

    <script>
        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset semua data form?')) {
                document.querySelector('form').reset();
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
            const inputs = formContent.querySelectorAll('input, select, textarea');
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
            <title>Preview Form 10 - Analisa Pendidikan</title>
            <style>
                body { font-family: 'Times New Roman', serif; padding: 20px; }
                .form-table { border-collapse: collapse; width: 100%; }
                .form-table td, .form-table th { border: 1px solid #000; padding: 8px; }
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
