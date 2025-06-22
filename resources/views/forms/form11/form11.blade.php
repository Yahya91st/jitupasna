@extends('layouts.main')

@section('content')    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
            vertical-align: top;
            word-wrap: break-word;
        }
        th {
            text-align: center;
            background-color: #f2f2f2;
        }
        .judul {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 18px;
        }
        .kategori {
            font-weight: bold;
        }
        input[type="text"], input[type="number"] {
            padding: 4px;
        }
        input[type="number"]:focus {
            outline: 1px solid #4a90e2;
        }
        .btn-primary {
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-primary:hover {
            background-color: #3570b2;
        }
        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: inline-block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-md-3, .col-md-4, .col-md-8, .col-md-12 {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
        .col-md-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }
        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
        .col-md-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }
        .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .mb-3 {
            margin-bottom: 1rem !important;
        }
        h3 {
            margin-top: 20px;
            margin-bottom: 15px;
            font-weight: 500;
            line-height: 1.2;
            color: #333;
        }
        tbody tr {
            cursor: pointer;
        }
        tbody tr:hover {
            background-color: #f5f5f5;
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
                    for(let i = 0; i < sektorDropdown.options.length; i++) {
                        if(sektorDropdown.options[i].value === sektor) {
                            sektorDropdown.selectedIndex = i;
                            break;
                        }
                    }
                    
                    for(let i = 0; i < subSektorDropdown.options.length; i++) {
                        if(subSektorDropdown.options[i].value === subSektor) {
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
    </script>    <h3>Formulir Kebutuhan Pascabencana (PDNA)</h3>
    
    <form method="POST" action="{{ route('forms.form11.store') }}">
    @csrf
    <input type="hidden" name="form_type" value="form11">
    <input type="hidden" name="bencana_id" value="{{ request('bencana_id') }}">
    
    <div class="row mb-3">
        <div class="col-md-12">
            <h4>Form Input Data Kebutuhan</h4>
            <p class="mb-3">Masukkan data kebutuhan baru atau klik pada baris tabel referensi di bawah untuk mengisi form ini secara otomatis.</p>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sektor">Sektor</label>
                <select id="sektor" name="sektor" class="form-control">
                    <option value="">Pilih Sektor</option>
                    <option value="Perumahan & Permukiman">Perumahan & Permukiman</option>
                    <option value="Infrastruktur">Infrastruktur</option>
                    <option value="Ekonomi Produktif">Ekonomi Produktif</option>
                    <option value="Sosial">Sosial</option>
                    <option value="Lintas Sektor">Lintas Sektor</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sub_sektor">Komponen Kebutuhan</label>
                <select id="sub_sektor" name="sub_sektor" class="form-control">
                    <option value="">Pilih Komponen</option>
                    <option value="Pembangunan">Pembangunan</option>
                    <option value="Penggantian">Penggantian</option>
                    <option value="Penyediaan Bantuan">Penyediaan Bantuan</option>
                    <option value="Pemulihan Fungsi">Pemulihan Fungsi</option>
                    <option value="Pengurangan Resiko">Pengurangan Resiko</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" class="form-control" placeholder="Masukkan lokasi">
            </div>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <label for="jenis_kebutuhan">Kegiatan/Jenis Kebutuhan</label>
                <input type="text" id="jenis_kebutuhan" name="jenis_kebutuhan" class="form-control" placeholder="Masukkan jenis kegiatan atau kebutuhan">
            </div>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-group">
                <label for="jumlah_unit">Volume/Jumlah Unit</label>
                <input type="number" id="jumlah_unit" name="jumlah_unit" class="form-control" placeholder="Jumlah unit" step="0.01">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="harga_satuan">Harga Satuan (Rp)</label>
                <input type="number" id="harga_satuan" name="harga_satuan" class="form-control" placeholder="Harga per unit" step="0.01">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="total_kebutuhan">Total Kebutuhan (Rp)</label>
                <input type="number" id="total_kebutuhan" name="total_kebutuhan" class="form-control" readonly>
            </div>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan" class="form-control" rows="2" placeholder="Tambahkan keterangan jika diperlukan"></textarea>
            </div>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Simpan Data Kebutuhan</button>
        </div>
    </div>
    </form>
    
    <hr style="margin: 30px 0;">
    <h3>Referensi Kebutuhan Pascabencana (PDNA)</h3>
    
    {{-- TABEL REFERENSI --}}
    <table>
        <thead>
            <tr>
                <th style="width: 15%;">Sektor</th>
                <th style="width: 15%;">Komponen Kebutuhan</th>
                <th style="width: 20%;">Kegiatan</th>
                <th style="width: 12%;">Lokasi</th>
                <th style="width: 8%;">Volume</th>
                <th style="width: 10%;">Harga Satuan</th>
                <th style="width: 10%;">Jumlah</th>
                <th style="width: 10%;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            {{-- Perumahan & Permukiman --}}
            <tr>
                <td rowspan="5" class="kategori">Perumahan &<br>Permukiman</td>                <td>Pembangunan</td>
                <td><input type="text" name="perumahan_pembangunan_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_pembangunan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_pembangunan_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="perumahan_pembangunan_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="perumahan_pembangunan_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_pembangunan_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Penggantian</td>
                <td><input type="text" name="perumahan_penggantian_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_penggantian_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_penggantian_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="perumahan_penggantian_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="perumahan_penggantian_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_penggantian_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Penyediaan Bantuan</td>
                <td><input type="text" name="perumahan_bantuan_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_bantuan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_bantuan_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="perumahan_bantuan_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="perumahan_bantuan_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_bantuan_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Pemulihan Fungsi</td>
                <td><input type="text" name="perumahan_pemulihan_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_pemulihan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_pemulihan_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="perumahan_pemulihan_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="perumahan_pemulihan_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_pemulihan_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Pengurangan Resiko</td>
                <td><input type="text" name="perumahan_resiko_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_resiko_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_resiko_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="perumahan_resiko_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="perumahan_resiko_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="perumahan_resiko_keterangan" style="width: 100%; border: none;"></td>
            </tr>            {{-- Infrastruktur --}}
            <tr>
                <td rowspan="3" class="kategori">Infrastruktur</td>
                <td>Pembangunan</td>
                <td><input type="text" name="infra_pembangunan_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="infra_pembangunan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="infra_pembangunan_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="infra_pembangunan_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="infra_pembangunan_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="infra_pembangunan_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Penggantian</td>
                <td><input type="text" name="infra_penggantian_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="infra_penggantian_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="infra_penggantian_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="infra_penggantian_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="infra_penggantian_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="infra_penggantian_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Penyediaan Bantuan</td>
                <td><input type="text" name="infra_bantuan_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="infra_bantuan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="infra_bantuan_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="infra_bantuan_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="infra_bantuan_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="infra_bantuan_keterangan" style="width: 100%; border: none;"></td>
            </tr>            {{-- Ekonomi Produktif --}}
            <tr>
                <td rowspan="5" class="kategori">Ekonomi Produktif</td>
                <td>Pemulihan Fungsi</td>
                <td><input type="text" name="ekonomi_pemulihan_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_pemulihan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_pemulihan_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="ekonomi_pemulihan_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="ekonomi_pemulihan_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_pemulihan_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Pengurangan Resiko</td>
                <td><input type="text" name="ekonomi_resiko_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_resiko_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_resiko_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="ekonomi_resiko_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="ekonomi_resiko_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_resiko_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Pembangunan</td>
                <td><input type="text" name="ekonomi_pembangunan_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_pembangunan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_pembangunan_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="ekonomi_pembangunan_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="ekonomi_pembangunan_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_pembangunan_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Penggantian</td>
                <td><input type="text" name="ekonomi_penggantian_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_penggantian_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_penggantian_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="ekonomi_penggantian_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="ekonomi_penggantian_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_penggantian_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Penyediaan Bantuan</td>
                <td><input type="text" name="ekonomi_bantuan_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_bantuan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_bantuan_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="ekonomi_bantuan_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="ekonomi_bantuan_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="ekonomi_bantuan_keterangan" style="width: 100%; border: none;"></td>
            </tr>            {{-- Sosial --}}
            <tr>
                <td rowspan="3" class="kategori">Sosial</td>
                <td>Pembangunan</td>
                <td><input type="text" name="sosial_pembangunan_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="sosial_pembangunan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="sosial_pembangunan_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="sosial_pembangunan_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="sosial_pembangunan_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="sosial_pembangunan_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Penggantian</td>
                <td><input type="text" name="sosial_penggantian_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="sosial_penggantian_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="sosial_penggantian_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="sosial_penggantian_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="sosial_penggantian_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="sosial_penggantian_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Penyediaan Bantuan</td>
                <td><input type="text" name="sosial_bantuan_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="sosial_bantuan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="sosial_bantuan_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="sosial_bantuan_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="sosial_bantuan_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="sosial_bantuan_keterangan" style="width: 100%; border: none;"></td>
            </tr>            {{-- Lintas Sektor --}}
            <tr>
                <td rowspan="6" class="kategori">Lintas Sektor</td>
                <td>Pemulihan Fungsi</td>
                <td><input type="text" name="lintas_pemulihan_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_pemulihan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_pemulihan_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="lintas_pemulihan_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="lintas_pemulihan_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_pemulihan_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Pengurangan Resiko</td>
                <td><input type="text" name="lintas_resiko1_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_resiko1_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_resiko1_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="lintas_resiko1_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="lintas_resiko1_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_resiko1_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Pembangunan</td>
                <td><input type="text" name="lintas_pembangunan_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_pembangunan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_pembangunan_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="lintas_pembangunan_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="lintas_pembangunan_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_pembangunan_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Penggantian</td>
                <td><input type="text" name="lintas_penggantian_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_penggantian_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_penggantian_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="lintas_penggantian_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="lintas_penggantian_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_penggantian_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Penyediaan Bantuan</td>
                <td><input type="text" name="lintas_bantuan_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_bantuan_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_bantuan_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="lintas_bantuan_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="lintas_bantuan_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_bantuan_keterangan" style="width: 100%; border: none;"></td>
            </tr>
            <tr>
                <td>Pengurangan Resiko</td>
                <td><input type="text" name="lintas_resiko2_kegiatan" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_resiko2_lokasi" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_resiko2_volume" style="width: 100%; border: none;"></td>
                <td><input type="number" name="lintas_resiko2_harga" style="width: 100%; border: none;"></td>
                <td><input type="number" name="lintas_resiko2_jumlah" style="width: 100%; border: none;"></td>
                <td><input type="text" name="lintas_resiko2_keterangan" style="width: 100%; border: none;"></td>            </tr>
        </tbody>
    </table>    <div style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
        <p>Klik pada baris di tabel referensi untuk memilih data yang ingin dimasukkan ke formulir di atas.</p>
    </div>
@endsection
