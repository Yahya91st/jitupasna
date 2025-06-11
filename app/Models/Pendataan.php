<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendataan extends Model {
    use HasFactory;
    
    protected $table = 'form3';
    
    protected $fillable = [
        'wilayah_bencana',
        'jumlah_laki_laki',
        'jumlah_perempuan',
        'jumlah_rumah_tangga',
        'jumlah_rumah_sakit',
        'jumlah_puskesmas',
        'jumlah_posyandu',
        'jumlah_dokter',
        'jumlah_paramedis',
        'jumlah_bidan',
        'jumlah_kunjungan_puskesmas',
        'jumlah_balita',
        'jumlah_balita_gizi_buruk',
        'jumlah_balita_gizi_kurang',
        'jumlah_manula',
        'jumlah_penerima_jps_kesehatan',
        'jumlah_rumah_air_bersih',
        'jumlah_rumah_jamban',
        'jumlah_pasar',
        'jumlah_koperasi',
        'jumlah_tempat_wisata',
        'jumlah_masjid',
        'jumlah_gereja',
        'jumlah_wihara',
        'jumlah_pura',
        'jumlah_rumah_permanen',
        'jumlah_rumah_semi_permanen',
        'jumlah_rumah_non_permanen',
        'panjang_jalan_negara',
        'panjang_jalan_provinsi',
        'panjang_jalan_kabupaten',
        'jumlah_bangunan_bersejarah',
        'jumlah_produksi_pertanian',
        'jumlah_produksi_industri',
        'harga_konstruksi_rumah',
        'harga_konstruksi_gedung',
        'harga_konstruksi_jalan',
        'harga_konstruksi_jembatan',
        'harga_konstruksi_pelabuhan',
        'harga_sewa_rumah',
        'sejarah_bencana',
        'kronologis_bencana',
        'wilayah_terdampak',
        'jumlah_korban_meninggal',
        'jumlah_korban_luka',
        'jumlah_korban_mengungsi',
        'kerusakan_kerugian',
        'pertanian_gangguan_ekonomi',
        'pertanian_produk_terdampak',
        'pertanian_pemulihan',
        'nonpertanian_gangguan_ekonomi',
        'nonpertanian_dampak_industri',
        'nonpertanian_dampak_koperasi',
        'nonpertanian_pemulihan',
        'sosial_kehilangan_tempat_tinggal',
        'sosial_penyandang_cacat',
        'sosial_kegiatan_terdampak',
        'pendidikan_gangguan',
        'pendidikan_trauma',
        'pendidikan_pemulihan',
        'pemerintahan_gangguan_administrasi',
        'pemerintahan_kehilangan_surat',
        'pemerintahan_rencana_kontingensi',
        'kesehatan_gangguan_layanan',
        'kesehatan_dampak_menengah',
        'kesehatan_pemulihan',
        'bencana_id',
    ];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
