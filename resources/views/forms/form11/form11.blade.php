@extends('layouts.main')

@section('content')
    <style>
        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .form-table th,
        .form-table td {
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

            #addRowBtn,
            .no-print {
                display: none !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            // Handle clicking on a reference row to populate the form
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('click', function() {
                    // Get data from the clicked row
                    const cells = this.querySelectorAll('td');

                    // Find sektor and sub_sektor values
                    const sektor = cells[0].textContent.trim();
                    const subSektor = cells[1].textContent.trim();

                    // Get data from inputs in the row
                    const kegiatan = this.querySelector('input[name$="_kegiatan"]').value || '';
                    const lokasi = this.querySelector('input[name$="_lokasi"]').value || '';
                    const volume = this.querySelector('input[name$="_volume"]').value || '';
                    const harga = this.querySelector('input[name$="_harga"]').value || '';
                    const keterangan = this.querySelector('input[name$="_keterangan"]').value || '';

                    // Populate the form with these values
                    const sektorDropdown = document.getElementById('sektor');
                    const subSektorDropdown = document.getElementById('sub_sektor');

                    // Try to select the matching option
                    for (let i = 0; i < sektorDropdown.options.length; i++) {
                        if (sektorDropdown.options[i].value === sektor) {
                            sektorDropdown.selectedIndex = i;
                            break;
                        }
                    }

                    for (let i = 0; i < subSektorDropdown.options.length; i++) {
                        if (subSektorDropdown.options[i].value === subSektor) {
                            subSektorDropdown.selectedIndex = i;
                            break;
                        }
                    }

                    // Set other form values
                    document.getElementById('lokasi').value = lokasi;
                    document.getElementById('jenis_kebutuhan').value = kegiatan;
                    document.getElementById('jumlah_unit').value = volume;
                    document.getElementById('harga_satuan').value = harga;
                    document.getElementById('keterangan').value = keterangan;

                    // Trigger calculation
                    calculateTotalKebutuhan();

                    // Scroll to top of form
                    window.scrollTo(0, 0);
                });
            });
        });
    </script>

    <form method="POST" action="{{ route('forms.form11.store') }}">
        @csrf
        <input type="hidden" name="form_type" value="form11">
        <input type="hidden" name="bencana_id" value="{{ request('bencana_id') }}">

        <div class="container" style="font-family: Times New Roman, serif;">
            <div class="text-center mb-4">
                <h5><strong>Formulir 11</strong></h5>
                <h5>Rekapitulasi Kebutuhan Pascabencana</h5>
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
                    <tr>
                        <td rowspan="5" class="kategori">Perumahan &<br>Permukiman</td>
                        <td>Pembangunan</td>
                        <td><input type="text" name="perumahan_pembangunan_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="perumahan_pembangunan_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_pembangunan_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_pembangunan_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_pembangunan_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="perumahan_pembangunan_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr>
                        <td>Penggantian</td>
                        <td><input type="text" name="perumahan_penggantian_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="perumahan_penggantian_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_penggantian_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_penggantian_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_penggantian_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="perumahan_penggantian_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr>
                        <td>Penyediaan Bantuan</td>
                        <td><input type="text" name="perumahan_bantuan_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="perumahan_bantuan_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_bantuan_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_bantuan_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_bantuan_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="perumahan_bantuan_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr>
                        <td>Pemulihan Fungsi</td>
                        <td><input type="text" name="perumahan_pemulihan_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="perumahan_pemulihan_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_pemulihan_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_pemulihan_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_pemulihan_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="perumahan_pemulihan_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr>
                        <td>Pengurangan Resiko</td>
                        <td><input type="text" name="perumahan_resiko_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="perumahan_resiko_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_resiko_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_resiko_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="perumahan_resiko_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="perumahan_resiko_keterangan" style="width: 100%; border: none;"></td>
                    </tr> {{-- Infrastruktur --}}
                    <tr>
                        <td rowspan="3" class="kategori">Infrastruktur</td>
                        <td>Pembangunan</td>
                        <td><input type="text" name="infra_pembangunan_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="infra_pembangunan_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="infra_pembangunan_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="infra_pembangunan_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="infra_pembangunan_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="infra_pembangunan_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr>
                        <td>Penggantian</td>
                        <td><input type="text" name="infra_penggantian_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="infra_penggantian_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="infra_penggantian_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="infra_penggantian_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="infra_penggantian_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="infra_penggantian_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr>
                        <td>Penyediaan Bantuan</td>
                        <td><input type="text" name="infra_bantuan_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="infra_bantuan_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="infra_bantuan_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="infra_bantuan_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="infra_bantuan_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="infra_bantuan_keterangan" style="width: 100%; border: none;"></td>
                    </tr> {{-- Ekonomi Produktif --}}
                    <tr>
                        <td rowspan="5" class="kategori">Ekonomi Produktif</td>
                        <td>Pemulihan Fungsi</td>
                        <td><input type="text" name="ekonomi_pemulihan_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="ekonomi_pemulihan_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_pemulihan_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_pemulihan_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="ekonomi_pemulihan_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="ekonomi_pemulihan_keterangan" style="width: 100%; border: none;"></td>
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
                    <tr>
                        <td rowspan="3" class="kategori">Sosial</td>
                        <td>Pembangunan</td>
                        <td><input type="text" name="sosial_pembangunan_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="sosial_pembangunan_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="sosial_pembangunan_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="sosial_pembangunan_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="sosial_pembangunan_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="sosial_pembangunan_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr>
                        <td>Penggantian</td>
                        <td><input type="text" name="sosial_penggantian_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="sosial_penggantian_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="sosial_penggantian_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="sosial_penggantian_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="sosial_penggantian_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="sosial_penggantian_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                    <tr>
                        <td>Penyediaan Bantuan</td>
                        <td><input type="text" name="sosial_bantuan_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="sosial_bantuan_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="sosial_bantuan_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="sosial_bantuan_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="sosial_bantuan_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="sosial_bantuan_keterangan" style="width: 100%; border: none;"></td>
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
                    <tr>
                        <td>Pembangunan</td>
                        <td><input type="text" name="lintas_pembangunan_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="lintas_pembangunan_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_pembangunan_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_pembangunan_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_pembangunan_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="lintas_pembangunan_keterangan" style="width: 100%; border: none;"></td>
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
                    <tr>
                        <td>Pengurangan Resiko</td>
                        <td><input type="text" name="lintas_resiko2_kegiatan" style="width: 100%; border: none;"></td>
                        <td><input type="text" name="lintas_resiko2_lokasi" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_resiko2_volume" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_resiko2_harga" style="width: 100%; border: none;"></td>
                        <td><input type="number" name="lintas_resiko2_jumlah" readonly style="width: 100%; border: none;"></td>
                        <td><input type="text" name="lintas_resiko2_keterangan" style="width: 100%; border: none;"></td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
                <p>Klik pada baris di tabel referensi untuk memilih data yang ingin dimasukkan ke formulir di atas.</p>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex gap-2 justify-content-center mt-4 mb-3">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan Data Kebutuhan
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
    </form>

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
            <title>Preview Form 11 - Analisa Kebutuhan</title>
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
