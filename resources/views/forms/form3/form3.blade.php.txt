@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-2xl font-bold">Formulir 03 - Pendataan ke OPD</h1>
        <a href="{{ route('forms.index', ['bencana_id' => isset($bencana) ? $bencana->id : '']) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Kembali ke Daftar Form
        </a>
    </div>
    
    @if(isset($bencana))
        <div class="alert alert-light-primary color-primary mb-4">
            <p>Bencana: {{ $bencana->kategori_bencana->nama }}</p>
            <p>Tanggal: {{ $bencana->tanggal }}</p>
            <p>Lokasi: 
                @foreach($bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            </p>
        </div>
    @endif
    
    <form action="{{ route('forms.form3.store') }}" method="POST" class="space-y-8">
        @csrf
        
        @if(isset($bencana))
            <input type="hidden" name="bencana_id" value="{{ $bencana->id }}">
        @endif
        
        <!-- Data Dasar Sebelum Bencana -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="py-4 px-4 text-xl font-semibold mb-4">1. DATA DASAR SEBELUM BENCANA</h2>
            
            <!-- Wilayah Bencana -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Wilayah Bencana</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Wilayah Bencana</label>
                        <input type="text" name="wilayah_bencana" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                        <small class="text-muted">Kabupaten/Kota/Kecamatan terdampak</small>
                    </div>
                </div>
            </div>
            
            <!-- Penduduk-Wilayah -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Penduduk-Wilayah</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Laki-laki</label>
                        <input type="number" name="jumlah_laki_laki" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Perempuan</label>
                        <input type="number" name="jumlah_perempuan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Rumah Tangga</label>
                        <input type="number" name="jumlah_rumah_tangga" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                </div>
            </div>
            
            <!-- Kesehatan -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Kesehatan</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Rumah Sakit</label>
                        <input type="number" name="jumlah_rumah_sakit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah PUSKESMAS</label>
                        <input type="number" name="jumlah_puskesmas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah POSYANDU</label>
                        <input type="number" name="jumlah_posyandu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Dokter</label>
                        <input type="number" name="jumlah_dokter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Paramedis</label>
                        <input type="number" name="jumlah_paramedis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Bidan</label>
                        <input type="number" name="jumlah_bidan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Kunjungan PUSKESMAS</label>
                        <input type="number" name="jumlah_kunjungan_puskesmas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Balita</label>
                        <input type="number" name="jumlah_balita" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Balita Gizi Buruk</label>
                        <input type="number" name="jumlah_balita_gizi_buruk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Balita Gizi Kurang</label>
                        <input type="number" name="jumlah_balita_gizi_kurang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Manula</label>
                        <input type="number" name="jumlah_manula" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Penerima JPS Kesehatan</label>
                        <input type="number" name="jumlah_penerima_jps_kesehatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Rumah dengan Air Bersih</label>
                        <input type="number" name="jumlah_rumah_air_bersih" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Rumah dengan Jamban</label>
                        <input type="number" name="jumlah_rumah_jamban" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                </div>
            </div>
            
            <!-- Ekonomi -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Ekonomi</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Pasar</label>
                        <input type="number" name="jumlah_pasar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Koperasi</label>
                        <input type="number" name="jumlah_koperasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Tempat Wisata</label>
                        <input type="number" name="jumlah_tempat_wisata" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                </div>
            </div>
            
            <!-- Sosial dan Agama -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Sosial dan Agama</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Masjid</label>
                        <input type="number" name="jumlah_masjid" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Gereja</label>
                        <input type="number" name="jumlah_gereja" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Wihara</label>
                        <input type="number" name="jumlah_wihara" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Pura</label>
                        <input type="number" name="jumlah_pura" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                </div>
            </div>
            
            <!-- Rumah dan Infrastruktur -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Rumah dan Infrastruktur</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Rumah Permanen</label>
                        <input type="number" name="jumlah_rumah_permanen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Rumah Semi Permanen</label>
                        <input type="number" name="jumlah_rumah_semi_permanen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Rumah Non Permanen</label>
                        <input type="number" name="jumlah_rumah_non_permanen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Panjang Jalan Negara (km)</label>
                        <input type="number" name="panjang_jalan_negara" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Panjang Jalan Provinsi (km)</label>
                        <input type="number" name="panjang_jalan_provinsi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Panjang Jalan Kabupaten (km)</label>
                        <input type="number" name="panjang_jalan_kabupaten" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Bangunan Bersejarah</label>
                        <input type="number" name="jumlah_bangunan_bersejarah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                </div>
            </div>
            
            <!-- Produksi dan Harga -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Produksi dan Harga</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Produksi Pertanian (ton)</label>
                        <input type="number" name="jumlah_produksi_pertanian" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Produksi Industri (unit)</label>
                        <input type="number" name="jumlah_produksi_industri" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga Konstruksi Rumah (Rp/m²)</label>
                        <input type="number" name="harga_konstruksi_rumah" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga Konstruksi Gedung (Rp/m²)</label>
                        <input type="number" name="harga_konstruksi_gedung" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga Konstruksi Jalan (Rp/km)</label>
                        <input type="number" name="harga_konstruksi_jalan" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga Konstruksi Jembatan (Rp/m)</label>
                        <input type="number" name="harga_konstruksi_jembatan" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga Konstruksi Pelabuhan (Rp/m²)</label>
                        <input type="number" name="harga_konstruksi_pelabuhan" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga Sewa Rumah (Rp/bulan)</label>
                        <input type="number" name="harga_sewa_rumah" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Data Sekunder Akibat Bencana -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="py-4 px-4 text-xl font-semibold mb-4">2. DATA SEKUNDER AKIBAT BENCANA</h2>
            
            <div class="px-4 mb-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Sejarah Bencana di Masa Lalu</label>
                    <textarea name="sejarah_bencana" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Kronologis Kejadian Bencana Saat Ini</label>
                    <textarea name="kronologis_bencana" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Wilayah Terdampak</label>
                    <textarea name="wilayah_terdampak" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Korban Meninggal</label>
                        <input type="number" name="jumlah_korban_meninggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Korban Luka-luka</label>
                        <input type="number" name="jumlah_korban_luka" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Korban Mengungsi</label>
                        <input type="number" name="jumlah_korban_mengungsi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control">
                    </div>
                </div>
                
                <div class="mb-4 mt-4">
                    <label class="block text-sm font-medium text-gray-700">Kerusakan dan Kerugian yang Dialami</label>
                    <textarea name="kerusakan_kerugian" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                </div>
            </div>
        </div>
        
        <!-- Data Sekunder Akibat Bencana (Khusus) -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="py-4 px-4 text-xl font-semibold mb-4">3. DATA SEKUNDER AKIBAT BENCANA (KHUSUS)</h2>
            
            <!-- Bidang Pertanian -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Bidang Pertanian</h3>
                <div class="px-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Gangguan Ekonomi</label>
                        <textarea name="pertanian_gangguan_ekonomi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Produk Pertanian Terdampak</label>
                        <textarea name="pertanian_produk_terdampak" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pemulihan yang Dibutuhkan</label>
                        <textarea name="pertanian_pemulihan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Bidang Non-Pertanian -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Bidang Non-Pertanian</h3>
                <div class="px-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Gangguan Ekonomi Perdagangan</label>
                        <textarea name="nonpertanian_gangguan_ekonomi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Dampak pada Industri</label>
                        <textarea name="nonpertanian_dampak_industri" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Dampak pada Koperasi</label>
                        <textarea name="nonpertanian_dampak_koperasi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pemulihan yang Dibutuhkan</label>
                        <textarea name="nonpertanian_pemulihan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Bidang Sosial dan Keagamaan -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Bidang Sosial dan Keagamaan</h3>
                <div class="px-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kehilangan Tempat Tinggal</label>
                        <textarea name="sosial_kehilangan_tempat_tinggal" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Penyandang Cacat/Disabilitas</label>
                        <textarea name="sosial_penyandang_cacat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kegiatan Sosial Terdampak</label>
                        <textarea name="sosial_kegiatan_terdampak" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Bidang Pendidikan -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Bidang Pendidikan</h3>
                <div class="px-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Gangguan Pendidikan</label>
                        <textarea name="pendidikan_gangguan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Trauma Siswa/Guru</label>
                        <textarea name="pendidikan_trauma" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pemulihan Pendidikan</label>
                        <textarea name="pendidikan_pemulihan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Bidang Pemerintahan -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Bidang Pemerintahan</h3>
                <div class="px-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Gangguan Administrasi</label>
                        <textarea name="pemerintahan_gangguan_administrasi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kehilangan Surat Penting</label>
                        <textarea name="pemerintahan_kehilangan_surat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Rencana Kontingensi</label>
                        <textarea name="pemerintahan_rencana_kontingensi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Bidang Kesehatan -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Bidang Kesehatan</h3>
                <div class="px-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Gangguan Layanan Kesehatan</label>
                        <textarea name="kesehatan_gangguan_layanan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Dampak Kesehatan Jangka Menengah</label>
                        <textarea name="kesehatan_dampak_menengah" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pemulihan Kesehatan</label>
                        <textarea name="kesehatan_pemulihan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="btn btn-primary px-6 py-2">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
