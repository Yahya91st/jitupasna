@extends('layouts.main')

@section('content')
    <style>
        /* Container & Layout */
        .form-container {
            max-width: 900px;
            font-family: 'Times New Roman', serif;
            margin: 0 auto;
            padding: 20px;
            background: white;
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
            color: #F28705;
            margin-bottom: 0.3rem;
        }

        /* Section Headers - Dari Form3 */
        .section-header {
            background: #f9f9f9;
            color: #333;
            font-weight: 600;
            padding: 10px 15px;
            margin: 20px 0 15px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Table Styling */
        .table {
            border: 1px solid #ddd;
            margin-bottom: 1.5rem;
            font-size: 14px;
            border-radius: 4px;
            overflow: hidden;
        }

        .table td,
        .table th {
            padding: 8px 12px;
            border: 1px solid #ddd;
            vertical-align: middle;
        }

        .table thead th {
            background: #f9f9f9;
            color: #333;
            font-weight: 600;
            text-align: center;
            border-bottom: 2px solid #ddd;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: rgba(242, 135, 5, 0.05);
            transition: background-color 0.2s ease;
        }

        .table-header {
            background-color: #333 !important;
            color: white !important;
            text-align: center;
            font-weight: bold;
        }

        /* Form Inputs */
        .inline-input {
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

        .inline-input:focus {
            border-bottom-color: #F28705;
            background-color: rgba(242, 135, 5, 0.05);
        }

        /* Radio Button/Checkbox Styling */
        input[type="radio"],
        input[type="checkbox"] {
            transform: scale(1.1);
            margin-right: 0.5rem;
            margin-left: 0.2rem;
            accent-color: #F28705;
            vertical-align: middle;
        }

        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            align-items: flex-start;
            padding: 0.2rem 0;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.2rem;
            white-space: nowrap;
            line-height: 1.4;
        }

        .checkbox-item label {
            margin: 0;
            font-weight: 500;
            cursor: pointer;
            user-select: none;
            color: #333;
        }

        /* Card Styling */
        .main-card {
            background: white;
            border-radius: 4px;
               overflow: hidden;
        }

        .card-body {
            padding: 20px;
        }

        /* Button Styling */
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
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .btn:hover {
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

        /* Alert Styling */
        .alert {
            border-radius: 4px;
            margin-bottom: 20px;
            padding: 12px 16px;
            border: 1px solid transparent;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        /* Action buttons container - Dari Form3 */
        .d-flex {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                padding: 10px;
            }

            .table {
                font-size: 12px;
            }

            .inline-input {
                font-size: 12px;
            }

            .checkbox-group {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn {
                margin: 2px;
                padding: 6px 12px;
                font-size: 12px;
            }
        }

        /* Print Styles */
        @media print {
            .action-buttons {
                display: none !important;
            }

            .form-container {
                box-shadow: none;
                margin: 0;
                padding: 10px;
            }

            .main-card {
                box-shadow: none;
                border: 1px solid #000;
            }

            body {
                font-size: 12pt;
                line-height: 1.4;
            }
        }
    </style>
    <div class="form-container">
        <!-- Document Header -->
        <div class="form-header">
            <h5><strong>Formulir 07</strong></h5>
            <h5>Diskusi Kelompok Terfokus (FGD)</h5>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="main-card">
            <div class="card-body">
                    <form action="{{ route('forms.form7.store') }}" method="POST" class="form form-vertical">
                        @csrf

                        <!-- Section Header - Style dari Form3 -->
                        <div class="section-header">
                            INFORMASI UMUM
                        </div>

                        <table class="table table-bordered">
                            <tbody>
                                <!-- Hidden Bencana Selection -->
                                <tr style="display: none;">
                                    <td colspan="4">
                                        @if (request()->has('bencana_id') && is_object($bencana))
                                            <input type="hidden" name="bencana_id" value="{{ $bencana->id }}">
                                        @else
                                            <select class="form-select @error('bencana_id') is-invalid @enderror" id="bencana_id" name="bencana_id" required>
                                                <option value="">-- Pilih Bencana --</option>
                                                @foreach ($bencana as $b)
                                                    <option value="{{ $b->id }}" {{ old('bencana_id') == $b->id ? 'selected' : '' }}>
                                                        {{ $b->Ref }} - {{ $b->kategori_bencana->nama }} ({{ $b->tanggal }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%">Desa/kelurahan asal:</td>
                                    <td width="25%"><input type="text" name="desa_kelurahan" class="inline-input @error('desa_kelurahan') is-invalid @enderror" value="{{ old('desa_kelurahan') }}" required></td>
                                    <td width="25%">Kecamatan asal:</td>
                                    <td width="25%"><input type="text" name="kecamatan" class="inline-input @error('kecamatan') is-invalid @enderror" value="{{ old('kecamatan') }}" required></td>
                                </tr>
                                <tr>
                                    <td>Kabupaten asal:</td>
                                    <td><input type="text" name="kabupaten" class="inline-input @error('kabupaten') is-invalid @enderror" value="{{ old('kabupaten') }}" required></td>
                                    <td>Tanggal:</td>
                                    <td><input type="date" name="tanggal" class="inline-input @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required></td>
                                </tr>
                                <tr>
                                    <td>Km dari Bencana:</td>
                                    <td><input type="number" name="jarak_bencana" class="inline-input @error('jarak_bencana') is-invalid @enderror" value="{{ old('jarak_bencana') }}" required min="0"></td>
                                    <td colspan="2"><small>(diisi oleh fasilitator/pencatat)</small></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Section Header - Style dari Form3 -->
                        <div class="section-header">
                            INFORMASI SESI
                        </div>

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td width="25%">Tempat sesi:</td>
                                    <td width="25%"><input type="text" name="tempat_sesi" class="inline-input @error('tempat_sesi') is-invalid @enderror" value="{{ old('tempat_sesi') }}" required></td>
                                    <td width="15%">Desa/kel:</td>
                                    <td width="35%"><input type="text" name="desa_sesi" class="inline-input" value="{{ old('desa_sesi') }}"></td>
                                </tr>
                                <tr>
                                    <td>Kec:</td>
                                    <td colspan="3"><input type="text" name="kec_sesi" class="inline-input" value="{{ old('kec_sesi') }}"></td>
                                </tr>
                                <tr>
                                    <td>Jumlah peserta:</td>
                                    <td><input type="number" id="jumlah_peserta" name="jumlah_peserta" class="inline-input @error('jumlah_peserta') is-invalid @enderror" value="{{ old('jumlah_peserta') }}" required min="1"></td>
                                    <td colspan="2">
                                        (perempuan: <input type="number" id="jumlah_perempuan" name="jumlah_perempuan" class="inline-input @error('jumlah_perempuan') is-invalid @enderror" value="{{ old('jumlah_perempuan') }}" required min="0" style="width: 50px; display: inline;">
                                        laki-laki: <input type="number" id="jumlah_laki_laki" name="jumlah_laki_laki" class="inline-input @error('jumlah_laki_laki') is-invalid @enderror" value="{{ old('jumlah_laki_laki') }}" required min="0" style="width: 50px; display: inline;">)
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <strong>Gambaran komposisi peserta, misalnya pekerjaan, status sosial, kelompok umur, dsb.</strong><br>
                                        <textarea name="komposisi_peserta" class="inline-input @error('komposisi_peserta') is-invalid @enderror" rows="3" style="height: 60px; width: 100%;" required>{{ old('komposisi_peserta') }}</textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Section Header - Style dari Form3 -->
                        <div class="section-header">
                            PENYELENGGARA
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="50%">Penyelenggara</th>
                                    <th width="50%">Paraf</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Fasilitator: <input type="text" name="fasilitator" class="inline-input @error('fasilitator') is-invalid @enderror" value="{{ old('fasilitator') }}" required></td>
                                    <td style="height: 40px;"></td>
                                </tr>
                                <tr>
                                    <td>Pencatat: <input type="text" name="pencatat" class="inline-input @error('pencatat') is-invalid @enderror" value="{{ old('pencatat') }}" required></td>
                                    <td style="height: 40px;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Section Header - Style dari Form3 -->
                        <div class="section-header">
                            CHECKLIST PERSIAPAN
                        </div>

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td width="5%">1.</td>
                                    <td width="70%">Persiapan pra-FGD:</td>
                                    <td width="25%">
                                        <div class="checkbox-group">
                                            <div class="checkbox-item">
                                                <input type="radio" id="prep_ya" name="persiapan_pra_fgd" value="1">
                                                <label for="prep_ya"> Ya</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input type="radio" id="prep_tidak" name="persiapan_pra_fgd" value="0">
                                                <label for="prep_tidak"> Tidak</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Pembagian tugas pelaksana</td>
                                    <td>
                                        <div class="checkbox-group">
                                            <div class="checkbox-item">
                                                <input type="radio" id="tugas_ya" name="pembagian_tugas_pelaksana" value="1">
                                                <label for="tugas_ya"> Ya</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input type="radio" id="tugas_tidak" name="pembagian_tugas_pelaksana" value="0">
                                                <label for="tugas_tidak"> Tidak</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Perkenalan dan pengantar</td>
                                    <td>
                                        <div class="checkbox-group">
                                            <div class="checkbox-item">
                                                <input type="radio" id="perkenalan_ya" name="perkenalan_pengantar" value="1">
                                                <label for="perkenalan_ya"> Ya</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input type="radio" id="perkenalan_tidak" name="perkenalan_pengantar" value="0">
                                                <label for="perkenalan_tidak"> Tidak</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Pembahasan</td>
                                    <td>
                                        <div class="checkbox-group">
                                            <div class="checkbox-item">
                                                <input type="radio" id="pembahasan_ya" name="pembahasan" value="1">
                                                <label for="pembahasan_ya"> Ya</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input type="radio" id="pembahasan_tidak" name="pembahasan" value="0">
                                                <label for="pembahasan_tidak"> Tidak</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>Pendalaman/Tanya jawab</td>
                                    <td>
                                        <div class="checkbox-group">
                                            <div class="checkbox-item">
                                                <input type="radio" id="tanya_ya" name="pendalaman_tanya_jawab" value="1">
                                                <label for="tanya_ya"> Ya</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input type="radio" id="tanya_tidak" name="pendalaman_tanya_jawab" value="0">
                                                <label for="tanya_tidak"> Tidak</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>Penyimpulan dan penutupan</td>
                                    <td>
                                        <div class="radio-group">
                                            <div class="radio-item">
                                                <input type="radio" id="penutupan_ya" name="penyimpulan_penutupan" value="1">
                                                <label for="penutupan_ya"> Ya</label>
                                            </div>
                                            <div class="radio-item">
                                                <input type="radio" id="penutupan_tidak" name="penyimpulan_penutupan" value="0">
                                                <label for="penutupan_tidak"> Tidak</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Section Header - Style dari Form3 -->
                        <div class="section-header">
                            PERTANYAAN DISKUSI
                        </div>

                        <table class="form-table">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 55%;">Pertanyaan</th>
                                    <th style="width: 40%;">Jawaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3"><strong>A. Akses Hak</strong></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Bagaimana akses terhadap hak bekerja setelah bencana?</td>
                                    <td>
                                        <textarea name="akses_hak_bekerja" class="inline-input" rows="2" style="height: 60px; width: 100%;">{{ old('akses_hak_bekerja') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Bagaimana akses terhadap jaminan sosial setelah bencana?</td>
                                    <td>
                                        <textarea name="akses_hak_jamsos" class="inline-input" rows="2" style="height: 60px; width: 100%;">{{ old('akses_hak_jamsos') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Bagaimana perlindungan keluarga setelah bencana?</td>
                                    <td>
                                        <textarea name="akses_hak_perlindungan" class="inline-input" rows="2" style="height: 60px; width: 100%;">{{ old('akses_hak_perlindungan') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Bagaimana akses terhadap pelayanan kesehatan setelah bencana?</td>
                                    <td>
                                        <textarea name="akses_hak_kesehatan" class="inline-input" rows="2" style="height: 60px; width: 100%;">{{ old('akses_hak_kesehatan') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Bagaimana akses terhadap pendidikan setelah bencana?</td>
                                    <td>
                                        <textarea name="akses_hak_pendidikan" class="inline-input" rows="2" style="height: 60px; width: 100%;">{{ old('akses_hak_pendidikan') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><strong>B. Fungsi Pranata</strong></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Bagaimana fungsi pranata sosial setelah bencana?</td>
                                    <td>
                                        <textarea name="fungsi_pranata_sosial" class="inline-input" rows="2" style="height: 60px; width: 100%;">{{ old('fungsi_pranata_sosial') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Bagaimana fungsi pranata ekonomi setelah bencana?</td>
                                    <td>
                                        <textarea name="fungsi_pranata_ekonomi" class="inline-input" rows="2" style="height: 60px; width: 100%;">{{ old('fungsi_pranata_ekonomi') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Bagaimana fungsi pranata agama setelah bencana?</td>
                                    <td>
                                        <textarea name="fungsi_pranata_agama" class="inline-input" rows="2" style="height: 60px; width: 100%;">{{ old('fungsi_pranata_agama') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Bagaimana fungsi pranata pemerintahan setelah bencana?</td>
                                    <td>
                                        <textarea name="fungsi_pranata_pemerintahan" class="inline-input" rows="2" style="height: 60px; width: 100%;">{{ old('fungsi_pranata_pemerintahan') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><strong>C. Resiko Kerentanan</strong></td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Karakter sosial yang paling rentan dan cara membantu</td>
                                    <td>
                                        <textarea name="resiko_kerentanan_sosial" class="inline-input" rows="3" style="height: 80px; width: 100%;">{{ old('resiko_kerentanan_sosial') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Karakter ekonomi yang paling rentan dan cara membantu</td>
                                    <td>
                                        <textarea name="resiko_kerentanan_ekonomi" class="inline-input" rows="3" style="height: 80px; width: 100%;">{{ old('resiko_kerentanan_ekonomi') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>Karakter geografis yang paling rentan dan cara membantu</td>
                                    <td>
                                        <textarea name="resiko_kerentanan_geografis" class="inline-input" rows="3" style="height: 80px; width: 100%;">{{ old('resiko_kerentanan_geografis') }}</textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Tombol Aksi -->
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // JavaScript untuk memastikan jumlah perempuan + laki-laki = jumlah peserta total
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahPeserta = document.getElementById('jumlah_peserta');
            const jumlahPerempuan = document.getElementById('jumlah_perempuan');
            const jumlahLakiLaki = document.getElementById('jumlah_laki_laki');

            function validateTotalParticipants() {
                const total = parseInt(jumlahPeserta.value) || 0;
                const perempuan = parseInt(jumlahPerempuan.value) || 0;
                const lakiLaki = parseInt(jumlahLakiLaki.value) || 0;

                // Using more flexible validation to avoid floating point or parsing issues
                if (Math.abs((perempuan + lakiLaki) - total) > 0.001) {
                    jumlahPeserta.setCustomValidity('Jumlah peserta harus sama dengan total peserta perempuan dan laki-laki');
                } else {
                    jumlahPeserta.setCustomValidity('');
                }
            }

            jumlahPeserta.addEventListener('input', validateTotalParticipants);
            jumlahPerempuan.addEventListener('input', validateTotalParticipants);
            jumlahLakiLaki.addEventListener('input', validateTotalParticipants);
            // Auto-calculate total participants
            function updateTotalParticipants() {
                const perempuan = parseInt(jumlahPerempuan.value) || 0;
                const lakiLaki = parseInt(jumlahLakiLaki.value) || 0;
                jumlahPeserta.value = perempuan + lakiLaki;
                jumlahPeserta.setCustomValidity(''); // Clear any error when auto-calculating
            }

            jumlahPerempuan.addEventListener('input', updateTotalParticipants);
            jumlahLakiLaki.addEventListener('input', updateTotalParticipants);

            // Additional check on form submission
            document.querySelector('form').addEventListener('submit', function(e) {
                validateTotalParticipants();
                if (jumlahPeserta.validationMessage) {
                    e.preventDefault();
                    alert('Harap periksa kembali: ' + jumlahPeserta.validationMessage);
                    return 0;
                }
            });

            // Radio buttons automatically handle mutual exclusion - no additional JavaScript needed
        });

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
            const formContent = document.querySelector('.container').cloneNode(1);

            // Remove buttons from preview
            const buttons = formContent.querySelectorAll('button');
            buttons.forEach(btn => btn.style.display = 'none');

            // Remove input borders for preview
            const inputs = formContent.querySelectorAll('.form-input, input');
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
                <title>Preview Form 7 - FGD</title>
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
@endpush
