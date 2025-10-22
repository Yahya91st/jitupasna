@extends('layouts.main')

@section('content')
    <style>
        .document-container {
            background: #fff;
            padding: 20px;
            margin: 20px auto;
            max-width: 1200px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-family: 'Times New Roman', serif;
            line-height: 1.3;
            color: #000;
            font-size: 14px;
        }

        .document-header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }

        .document-title {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0 0 5px 0;
            letter-spacing: 1px;
        }

        .document-subtitle {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }

        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .form-table th,
        .form-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        .form-table th {
            background-color: #e9ecef;
            font-weight: bold;
            text-align: center;
            color: #000;
        }

        .table-header {
            background-color: #6c757d !important;
            color: white !important;
            text-align: center;
            font-weight: bold;
        }

        .kategori {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            width: 120px;
            min-width: 120px;
            line-height: 1.2;
            padding: 8px 4px;
        }

        .form-table input {
            width: 100%;
            border: none;
            background: transparent;
            padding: 2px;
            font-size: 11px;
            font-family: 'Times New Roman', serif;
        }

        .form-table input:focus {
            outline: 2px solid #0066cc;
            background-color: #f8f9fa;
            border-radius: 2px;
        }

        .form-table input:hover:not(:focus) {
            background-color: #f0f0f0;
        }

        .form-table input[readonly] {
            background-color: #e9ecef;
            color: #6c757d;
            font-weight: bold;
        }

        .instruction-box {
            background: #e3f2fd;
            border: 1px solid #2196f3;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
            font-style: italic;
            color: #1976d2;
        }

        .btn-custom {
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .btn-success-custom {
            background: #28a745;
            color: white;
        }

        .btn-success-custom:hover {
            background: #218838;
            color: white;
            text-decoration: none;
        }

        .btn-warning-custom {
            background: #ffc107;
            color: #000;
        }

        .btn-warning-custom:hover {
            background: #e0a800;
            color: #000;
            text-decoration: none;
        }

        .btn-info-custom {
            background: #17a2b8;
            color: white;
        }

        .btn-info-custom:hover {
            background: #138496;
            color: white;
            text-decoration: none;
        }

        .btn-secondary-custom {
            background: #6c757d;
            color: white;
        }

        .btn-secondary-custom:hover {
            background: #545b62;
            color: white;
            text-decoration: none;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .highlight-row {
            background-color: #fff3cd !important;
            transition: background-color 0.3s ease;
        }

        .clickable-row {
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .clickable-row:hover {
            background-color: #f8f9fa;
        }

        @media print {
            .document-container {
                box-shadow: none;
                margin: 0;
                padding: 15px;
            }

            .form-table {
                page-break-inside: auto;
                border: 2px solid #000 !important;
                font-size: 10px;
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
                padding: 4px;
            }

            .form-table thead th {
                background-color: #e9ecef !important;
                border-bottom: 2px solid #000 !important;
            }

            .kategori {
                background-color: #f8f9fa !important;
            }

            .table-header {
                background-color: #6c757d !important;
                color: white !important;
            }

            .action-buttons,
            .instruction-box,
            .no-print {
                display: none !important;
            }

            .form-table input {
                border: none !important;
                background: transparent !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add clickable-row class to all table rows that don't have it
            const tableRows = document.querySelectorAll('tbody tr:not(.clickable-row)');
            tableRows.forEach(row => {
                row.classList.add('clickable-row');
            });

            // Update all inputs to have proper styling and placeholders
            const allInputs = document.querySelectorAll('.form-table input');
            allInputs.forEach(input => {
                // Remove inline styles
                input.removeAttribute('style');

                // Add placeholders based on input type and name
                if (input.name.includes('kegiatan')) {
                    input.placeholder = 'Masukkan kegiatan...';
                } else if (input.name.includes('lokasi')) {
                    input.placeholder = 'Lokasi...';
                } else if (input.name.includes('volume')) {
                    input.placeholder = '0';
                    input.step = '0.01';
                } else if (input.name.includes('harga')) {
                    input.placeholder = '0';
                    input.step = '0.01';
                } else if (input.name.includes('keterangan')) {
                    input.placeholder = 'Keterangan...';
                }
            });

            // Reference table calculations
            const volumeInputs = document.querySelectorAll('input[name$="_volume"]');
            const priceInputs = document.querySelectorAll('input[name$="_harga"]');

            // Function to calculate total for reference tables
            function calculateTotal(row) {
                const volumeInput = row.querySelector('input[name$="_volume"]');
                const priceInput = row.querySelector('input[name$="_harga"]');
                const totalInput = row.querySelector('input[name$="_jumlah"]');

                if (volumeInput && priceInput && totalInput) {
                    const volume = parseFloat(volumeInput.value) || 0;
                    const price = parseFloat(priceInput.value) || 0;
                    totalInput.value = (volume * price).toFixed(2);
                }
            }

            // Add event listeners for volume inputs in reference table
            volumeInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const row = this.closest('tr');
                    calculateTotal(row);
                });
            });

            // Add event listeners for price inputs in reference table
            priceInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const row = this.closest('tr');
                    calculateTotal(row);
                });
            });

            // Main form functionality
            const jumlahUnitInput = document.getElementById('jumlah_unit');
            const hargaSatuanInput = document.getElementById('harga_satuan');
            const totalKebutuhanInput = document.getElementById('total_kebutuhan');

            // Function to calculate total kebutuhan
            function calculateTotalKebutuhan() {
                const jumlahUnit = parseFloat(jumlahUnitInput.value) || 0;
                const hargaSatuan = parseFloat(hargaSatuanInput.value) || 0;
                totalKebutuhanInput.value = (jumlahUnit * hargaSatuan).toFixed(2);
            }

            // Add event listeners for main form calculations
            jumlahUnitInput.addEventListener('input', calculateTotalKebutuhan);
            hargaSatuanInput.addEventListener('input', calculateTotalKebutuhan);

            // Handle clicking on a reference row to highlight and show interaction
            const tableRows = document.querySelectorAll('tbody tr.clickable-row');
            tableRows.forEach(row => {
                // Add click effect
                row.addEventListener('click', function() {
                    // Remove highlight from other rows
                    tableRows.forEach(r => r.classList.remove('highlight-row'));

                    // Add highlight to clicked row
                    this.classList.add('highlight-row');

                    // Get data from the clicked row
                    const cells = this.querySelectorAll('td');

                    // Show notification
                    showNotification('Baris dipilih! Data siap untuk digunakan.', 'success');

                    // Optional: You can add more functionality here
                    // like populating a separate form or modal
                });

                // Add hover effect
                row.addEventListener('mouseenter', function() {
                    if (!this.classList.contains('highlight-row')) {
                        this.style.backgroundColor = '#e3f2fd';
                    }
                });

                row.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('highlight-row')) {
                        this.style.backgroundColor = '';
                    }
                });
            });

            // Function to show notifications
            function showNotification(message, type = 'info') {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
                notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
                notification.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;

                document.body.appendChild(notification);

                // Auto remove after 3 seconds
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 3000);
            }
        });
    </script>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('forms.form11.store') }}">
        @csrf
        <input type="hidden" name="form_type" value="form11">
        <input type="hidden" name="bencana_id" value="{{ request('bencana_id') }}">

        <div class="document-container">
            <!-- Header Formulir -->
            <div class="document-header">
                <div class="document-title">Formulir 11</div>
                <div class="document-subtitle">Rekapitulasi Kebutuhan Pascabencana</div>
            </div>

            {{-- TABEL REFERENSI --}}
            <table class="form-table">
                <tr>
                    <th class="table-header" style="width: 15%;">Sektor</th>
                    <th class="table-header" style="width: 15%;">Komponen Kebutuhan</th>
                    <th class="table-header" style="width: 20%;">Kegiatan</th>
                    <th class="table-header" style="width: 12%;">Lokasi</th>
                    <th class="table-header" style="width: 8%;">Volume</th>
                    <th class="table-header" style="width: 10%;">Harga Satuan</th>
                    <th class="table-header" style="width: 10%;">Jumlah</th>
                    <th class="table-header" style="width: 10%;">Keterangan</th>
                </tr>
                </thead>
                <tbody>
                    {{-- Perumahan & Permukiman --}}
                    <tr class="clickable-row">
                        <td rowspan="5" class="kategori">Perumahan &<br>Permukiman</td>
                        <td>Pembangunan</td>
                        <td><input type="text" name="perumahan_pembangunan_kegiatan" placeholder="Masukkan kegiatan..."></td>
                        <td><input type="text" name="perumahan_pembangunan_lokasi" placeholder="Lokasi..."></td>
                        <td><input type="number" name="perumahan_pembangunan_volume" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="perumahan_pembangunan_harga" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="perumahan_pembangunan_jumlah" readonly></td>
                        <td><input type="text" name="perumahan_pembangunan_keterangan" placeholder="Keterangan..."></td>
                    </tr>
                    <tr class="clickable-row">
                        <td>Penggantian</td>
                        <td><input type="text" name="perumahan_penggantian_kegiatan" placeholder="Masukkan kegiatan..."></td>
                        <td><input type="text" name="perumahan_penggantian_lokasi" placeholder="Lokasi..."></td>
                        <td><input type="number" name="perumahan_penggantian_volume" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="perumahan_penggantian_harga" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="perumahan_penggantian_jumlah" readonly></td>
                        <td><input type="text" name="perumahan_penggantian_keterangan" placeholder="Keterangan..."></td>
                    </tr>
                    <tr class="clickable-row">
                        <td>Penyediaan Bantuan</td>
                        <td><input type="text" name="perumahan_bantuan_kegiatan" placeholder="Masukkan kegiatan..."></td>
                        <td><input type="text" name="perumahan_bantuan_lokasi" placeholder="Lokasi..."></td>
                        <td><input type="number" name="perumahan_bantuan_volume" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="perumahan_bantuan_harga" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="perumahan_bantuan_jumlah" readonly></td>
                        <td><input type="text" name="perumahan_bantuan_keterangan" placeholder="Keterangan..."></td>
                    </tr>
                    <tr class="clickable-row">
                        <td>Pemulihan Fungsi</td>
                        <td><input type="text" name="perumahan_pemulihan_kegiatan" placeholder="Masukkan kegiatan..."></td>
                        <td><input type="text" name="perumahan_pemulihan_lokasi" placeholder="Lokasi..."></td>
                        <td><input type="number" name="perumahan_pemulihan_volume" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="perumahan_pemulihan_harga" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="perumahan_pemulihan_jumlah" readonly></td>
                        <td><input type="text" name="perumahan_pemulihan_keterangan" placeholder="Keterangan..."></td>
                    </tr>
                    <tr class="clickable-row">
                        <td>Pengurangan Resiko</td>
                        <td><input type="text" name="perumahan_resiko_kegiatan" placeholder="Masukkan kegiatan..."></td>
                        <td><input type="text" name="perumahan_resiko_lokasi" placeholder="Lokasi..."></td>
                        <td><input type="number" name="perumahan_resiko_volume" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="perumahan_resiko_harga" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="perumahan_resiko_jumlah" readonly></td>
                        <td><input type="text" name="perumahan_resiko_keterangan" placeholder="Keterangan..."></td>
                    </tr> {{-- Infrastruktur --}}
                    <tr class="clickable-row">
                        <td rowspan="3" class="kategori">Infrastruktur</td>
                        <td>Pembangunan</td>
                        <td><input type="text" name="infra_pembangunan_kegiatan" placeholder="Masukkan kegiatan..."></td>
                        <td><input type="text" name="infra_pembangunan_lokasi" placeholder="Lokasi..."></td>
                        <td><input type="number" name="infra_pembangunan_volume" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="infra_pembangunan_harga" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="infra_pembangunan_jumlah" readonly></td>
                        <td><input type="text" name="infra_pembangunan_keterangan" placeholder="Keterangan..."></td>
                    </tr>
                    <tr class="clickable-row">
                        <td>Penggantian</td>
                        <td><input type="text" name="infra_penggantian_kegiatan" placeholder="Masukkan kegiatan..."></td>
                        <td><input type="text" name="infra_penggantian_lokasi" placeholder="Lokasi..."></td>
                        <td><input type="number" name="infra_penggantian_volume" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="infra_penggantian_harga" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="infra_penggantian_jumlah" readonly></td>
                        <td><input type="text" name="infra_penggantian_keterangan" placeholder="Keterangan..."></td>
                    </tr>
                    <tr class="clickable-row">
                        <td>Penyediaan Bantuan</td>
                        <td><input type="text" name="infra_bantuan_kegiatan" placeholder="Masukkan kegiatan..."></td>
                        <td><input type="text" name="infra_bantuan_lokasi" placeholder="Lokasi..."></td>
                        <td><input type="number" name="infra_bantuan_volume" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="infra_bantuan_harga" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="infra_bantuan_jumlah" readonly></td>
                        <td><input type="text" name="infra_bantuan_keterangan" placeholder="Keterangan..."></td>
                    </tr> {{-- Ekonomi Produktif --}}
                    <tr class="clickable-row">
                        <td rowspan="5" class="kategori">Ekonomi Produktif</td>
                        <td>Pemulihan Fungsi</td>
                        <td><input type="text" name="ekonomi_pemulihan_kegiatan" placeholder="Masukkan kegiatan..."></td>
                        <td><input type="text" name="ekonomi_pemulihan_lokasi" placeholder="Lokasi..."></td>
                        <td><input type="number" name="ekonomi_pemulihan_volume" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="ekonomi_pemulihan_harga" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="ekonomi_pemulihan_jumlah" readonly></td>
                        <td><input type="text" name="ekonomi_pemulihan_keterangan" placeholder="Keterangan..."></td>
                    </tr>
                    <tr>
                        <td>Pengurangan Resiko</td>
                        <td><input type="text" name="ekonomi_resiko_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="ekonomi_resiko_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_resiko_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_resiko_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_resiko_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="ekonomi_resiko_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr>
                        <td>Pembangunan</td>
                        <td><input type="text" name="ekonomi_pembangunan_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="ekonomi_pembangunan_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_pembangunan_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_pembangunan_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_pembangunan_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="ekonomi_pembangunan_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr>
                        <td>Penggantian</td>
                        <td><input type="text" name="ekonomi_penggantian_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="ekonomi_penggantian_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_penggantian_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_penggantian_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_penggantian_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="ekonomi_penggantian_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr>
                        <td>Penyediaan Bantuan</td>
                        <td><input type="text" name="ekonomi_bantuan_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="ekonomi_bantuan_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_bantuan_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_bantuan_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_bantuan_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="ekonomi_bantuan_keterangan" style="width: 100%; border: none;"></td>
                    </tr> {{-- Sosial --}}
                    <tr class="clickable-row">
                        <td rowspan="3" class="kategori">Sosial</td>
                        <td>Pembangunan</td>
                        <td><input type="text" name="sosial_pembangunan_kegiatan" placeholder="Masukkan kegiatan..."></td>
                        <td><input type="text" name="sosial_pembangunan_lokasi" placeholder="Lokasi..."></td>
                        <td><input type="number" name="sosial_pembangunan_volume" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="sosial_pembangunan_harga" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="sosial_pembangunan_jumlah" readonly></td>
                        <td><input type="text" name="sosial_pembangunan_keterangan" placeholder="Keterangan..."></td>
                    </tr>
                    <tr class="clickable-row">
                        <td>Penggantian</td>
                        <td><input type="text" name="sosial_penggantian_kegiatan" placeholder="Masukkan kegiatan..."></td>
                        <td><input type="text" name="sosial_penggantian_lokasi" placeholder="Lokasi..."></td>
                        <td><input type="number" name="sosial_penggantian_volume" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="sosial_penggantian_harga" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="sosial_penggantian_jumlah" readonly></td>
                        <td><input type="text" name="sosial_penggantian_keterangan" placeholder="Keterangan..."></td>
                    </tr>
                    <tr class="clickable-row">
                        <td>Penyediaan Bantuan</td>
                        <td><input type="text" name="sosial_bantuan_kegiatan" placeholder="Masukkan kegiatan..."></td>
                        <td><input type="text" name="sosial_bantuan_lokasi" placeholder="Lokasi..."></td>
                        <td><input type="number" name="sosial_bantuan_volume" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="sosial_bantuan_harga" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="sosial_bantuan_jumlah" readonly></td>
                        <td><input type="text" name="sosial_bantuan_keterangan" placeholder="Keterangan..."></td>
                    </tr> {{-- Lintas Sektor --}}
                    <tr>
                        <td rowspan="6" class="kategori">Lintas Sektor</td>
                        <td>Pemulihan Fungsi</td>
                        <td><input type="text" name="lintas_pemulihan_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="lintas_pemulihan_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_pemulihan_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_pemulihan_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_pemulihan_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="lintas_pemulihan_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr>
                        <td>Pengurangan Resiko</td>
                        <td><input type="text" name="lintas_resiko1_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="lintas_resiko1_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_resiko1_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_resiko1_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_resiko1_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="lintas_resiko1_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr class="clickable-row">
                        <td>Pembangunan</td>
                        <td><input type="text" name="infra_bangun_kegiatan" placeholder="Masukkan kegiatan..."></td>
                        <td><input type="text" name="infra_bangun_lokasi" placeholder="Lokasi..."></td>
                        <td><input type="number" name="infra_bangun_volume" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="infra_bangun_harga" placeholder="0" step="0.01"></td>
                        <td><input type="number" name="infra_bangun_jumlah" readonly></td>
                        <td><input type="text" name="infra_bangun_keterangan" placeholder="Keterangan..."></td>
                    </tr>
                    <tr>
                        <td>Penggantian</td>
                        <td><input type="text" name="lintas_penggantian_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="lintas_penggantian_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_penggantian_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_penggantian_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_penggantian_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="lintas_penggantian_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr>
                        <td>Penyediaan Bantuan</td>
                        <td><input type="text" name="lintas_bantuan_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="lintas_bantuan_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_bantuan_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_bantuan_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_bantuan_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="lintas_bantuan_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                </tbody>
            </table>

            <!-- Instruction Box -->
            <div class="instruction-box">
                <p><strong>Petunjuk:</strong> Klik pada baris di tabel untuk memilih data yang ingin dimasukkan ke formulir. Kolom "Jumlah" akan otomatis dihitung berdasarkan Volume × Harga Satuan.</p>
                <p><em>Isi semua data sektor kebutuhan rehabilitasi dan rekonstruksi pascabencana sesuai dengan kondisi lapangan.</em></p>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button type="submit" class="btn-custom btn-success-custom">
                    <i class="bi bi-save"></i> Simpan Data Kebutuhan
                </button>
                <button type="reset" class="btn-custom btn-warning-custom" onclick="resetForm()">
                    <i class="bi bi-arrow-clockwise"></i> Reset Form
                </button>
                <button type="button" class="btn-custom btn-info-custom" onclick="printForm()">
                    <i class="bi bi-printer"></i> Cetak Dokumen
                </button>
                <button type="button" class="btn-custom btn-secondary-custom" onclick="previewForm()">
                    <i class="bi bi-eye"></i> Preview
                </button>
            </div>
        </div>
    </form>

    <script>
        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset semua data form?\n\nSemua data yang telah diisi akan hilang dan tidak dapat dikembalikan.')) {
                document.querySelector('form').reset();

                // Remove highlights from rows
                const highlightedRows = document.querySelectorAll('.highlight-row');
                highlightedRows.forEach(row => row.classList.remove('highlight-row'));

                // Show success notification
                showNotification('Form berhasil direset!', 'warning');
            }
        }

        function printForm() {
            // Show loading
            const loadingMsg = document.createElement('div');
            loadingMsg.className = 'alert alert-info position-fixed';
            loadingMsg.style.cssText = 'top: 20px; right: 20px; z-index: 9999;';
            loadingMsg.textContent = 'Mempersiapkan dokumen untuk dicetak...';
            document.body.appendChild(loadingMsg);

            setTimeout(() => {
                window.print();
                loadingMsg.remove();
            }, 500);
        }

        function previewForm() {
            // Show loading
            const loadingMsg = document.createElement('div');
            loadingMsg.className = 'alert alert-info position-fixed';
            loadingMsg.style.cssText = 'top: 20px; right: 20px; z-index: 9999;';
            loadingMsg.textContent = 'Mempersiapkan preview...';
            document.body.appendChild(loadingMsg);

            setTimeout(() => {
                // Create preview window
                const previewWindow = window.open('', '_blank', 'width=1000,height=700,scrollbars=yes,resizable=yes');
                const formContent = document.querySelector('.document-container').cloneNode(true);

                // Remove buttons and instruction box from preview
                const buttonsAndInstructions = formContent.querySelectorAll('.action-buttons, .instruction-box');
                buttonsAndInstructions.forEach(elem => elem.remove());

                // Convert inputs to static text for preview
                const inputs = formContent.querySelectorAll('input');
                inputs.forEach(input => {
                    const span = document.createElement('span');
                    span.textContent = input.value || '___________';
                    span.style.cssText = 'border-bottom: 1px solid #000; min-width: 80px; display: inline-block; padding: 2px;';
                    input.parentNode.replaceChild(span, input);
                });

                previewWindow.document.write(`
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>Preview - Formulir 11 Rekapitulasi Kebutuhan Pascabencana</title>
                        <style>
                            body { 
                                font-family: 'Times New Roman', serif; 
                                padding: 20px; 
                                background: #f5f5f5;
                                margin: 0;
                            }
                            .document-container {
                                background: white;
                                padding: 30px;
                                margin: 0 auto;
                                box-shadow: 0 0 15px rgba(0,0,0,0.1);
                                max-width: 1000px;
                            }
                            .form-table { 
                                border-collapse: collapse; 
                                width: 100%; 
                                margin: 15px 0;
                                font-size: 12px;
                            }
                            .form-table td, .form-table th { 
                                border: 1px solid #000; 
                                padding: 6px; 
                                text-align: left;
                            }
                            .form-table th {
                                background-color: #e9ecef;
                                font-weight: bold;
                                text-align: center;
                            }
                            .table-header {
                                background-color: #6c757d !important;
                                color: white !important;
                            }
                            .kategori {
                                background-color: #f8f9fa;
                                font-weight: bold;
                                text-align: center;
                                vertical-align: middle;
                            }
                            .document-header {
                                text-align: center;
                                margin-bottom: 20px;
                                border-bottom: 2px solid #000;
                                padding-bottom: 15px;
                            }
                            .document-title {
                                font-size: 18px;
                                font-weight: bold;
                                text-transform: uppercase;
                                margin: 0 0 5px 0;
                            }
                            .document-subtitle {
                                font-size: 16px;
                                font-weight: bold;
                                margin: 0;
                            }
                            @media print {
                                body { background: white; }
                                .document-container { box-shadow: none; }
                            }
                        </style>
                    </head>
                    <body>
                        ${formContent.outerHTML}
                        <div style="text-align: center; margin-top: 30px; color: #666; font-size: 12px;">
                            <p>Preview - Formulir 11 Rekapitulasi Kebutuhan Pascabencana</p>
                            <p>Tanggal Cetak: ${new Date().toLocaleDateString('id-ID', { 
                                year: 'numeric', 
                                month: 'long', 
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            })}</p>
                        </div>
                    </body>
                    </html>
                `);
                previewWindow.document.close();
                loadingMsg.remove();
            }, 500);
        }

        // Function to show notifications (if not already defined)
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 3000);
        }
    </script>
@endsection
