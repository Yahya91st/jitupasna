<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form6 extends Model
{
    use HasFactory;

    protected $table = 'form6';

    protected $fillable = [
        'bencana_id',
        'enumerator',

        'tgl_wawancara',
        'paraf_enum',
        'data_entry',
        'tgl_entry',
        'paraf_entry',
        'responden',
        'umur',
        'nama',
        'desa',
        'kecamatan',
        'kabupaten',
        'pendidikan',
        'krt_perempuan',
        'jumlah_anggota',
        'jumlah_anak',
        'jumlah_balita',
        'tipe_hunian',

        'nafkah_pre_suami',
        'nafkah_pre_istri',
        'nafkah_pre_anak',
        'nafkah_pre_lain',
        'nafkah_pre_lain_text',
        'nafkah_post_suami',
        'nafkah_post_istri',
        'nafkah_post_anak',
        
        
        'nafkah_post_lain',
        'nafkah_post_lain_text',
        'sumber_pertanian',
        'sumber_peternakan',
        'sumber_dagang',
        'sumber_industri',
        'sumber_jasa',
        'sumber_pegawai',
        'sumber_pertukangan',
        'sumber_lain',
        'sumber_lain_text',
        'penghasilan_hilang',
        'bantuan_keterampilan',
        'bantuan_peralatan','bantuan_modal','bantuan_pasar','bantuan_lain','bantuan_lain_text',
        'cadangan_tabungan','cadangan_pinjaman','cadangan_barang','cadangan_ternak','cadangan_jamsos','cadangan_lain','cadangan_lain_text',
        'dukungan_koperasi','dukungan_kelompok','dukungan_pinjaman','dukungan_pemerintah','dukungan_lain','dukungan_lain_text',
        'perlindungan',
        'bantu_lindung_penyuluhan','bantu_lindung_moral','bantu_lindung_polisi','bantu_lindung_pos','bantu_lindung_rumah','bantu_lindung_lain','bantu_lindung_lain_text',
        'masalah_rumah_relokasi','masalah_rumah_rusak','masalah_rumah_belum','masalah_rumah_lain','masalah_rumah_lain_text',
        'tindakan_rumah_stimulus','tindakan_rumah_kredit','tindakan_rumah_teknis','tindakan_rumah_lain','tindakan_rumah_lain_text',
        'perkiraan_tinggal','perkiraan_tempat_lain_text',
        'makanan_bantuan','makanan_cadangan','makanan_tanaman','makanan_lain','makanan_lain_text',
        'dukungan_pangan_langsung','dukungan_pangan_pulih','dukungan_pangan_gotong','dukungan_pangan_lain','dukungan_pangan_lain_text',
        'air_kurang','air_kotor','air_simpan','air_lain','air_lain_text',
        'dukungan_air_sedia','dukungan_air_pulih','dukungan_air_simpan','dukungan_air_lain','dukungan_air_lain_text',
        'pelayanan_kesehatan',
        'perbaikan_obat','perbaikan_medis','perbaikan_jarak','perbaikan_biaya','perbaikan_psiko','perbaikan_lain','perbaikan_lain_text',
        'sekolah_terganggu',
        'dukungan_pend_guru','dukungan_pend_alat','dukungan_pend_biaya','dukungan_pend_trans','dukungan_pend_dekat','dukungan_pend_bangun','dukungan_pend_lain','dukungan_pend_lain_text',
        'agama_terganggu',
        'dukungan_agama_stimulus','dukungan_agama_latih','dukungan_agama_izin','dukungan_agama_lain','dukungan_agama_lain_text',
        'cegah_info','cegah_latih','cegah_rencana','cegah_fasilitas','cegah_warning','cegah_komunitas','cegah_budaya','cegah_lain','cegah_lain_text',
        'butuh_anak','butuh_lansia','butuh_difabel','butuh_hamil','butuh_lain','butuh_lain_text',
        'penghasilan_suami','bidang_suami','penghasilan_istri','bidang_istri','penghasilan_lainnya','bidang_lainnya',
    ];

        protected $casts = [
        'tgl_wawancara' => 'date',
        'tgl_entry' => 'date',

        // booleans
        'nafkah_pre_suami' => 'boolean',
        'nafkah_pre_istri' => 'boolean',
        'nafkah_pre_anak' => 'boolean',
        'nafkah_pre_lain' => 'boolean',

        'nafkah_post_suami' => 'boolean',
        'nafkah_post_istri' => 'boolean',
        'nafkah_post_anak' => 'boolean',
        'nafkah_post_lain' => 'boolean',

        'sumber_pertanian' => 'boolean',
        'sumber_peternakan' => 'boolean',
        'sumber_dagang' => 'boolean',
        'sumber_industri' => 'boolean',
        'sumber_jasa' => 'boolean',
        'sumber_pegawai' => 'boolean',
        'sumber_pertukangan' => 'boolean',
        'sumber_lain' => 'boolean',

        'bantuan_keterampilan' => 'boolean',
        'bantuan_peralatan' => 'boolean',
        'bantuan_modal' => 'boolean',
        'bantuan_pasar' => 'boolean',
        'bantuan_lain' => 'boolean',

        'cadangan_tabungan' => 'boolean',
        'cadangan_pinjaman' => 'boolean',
        'cadangan_barang' => 'boolean',
        'cadangan_ternak' => 'boolean',
        'cadangan_jamsos' => 'boolean',
        'cadangan_lain' => 'boolean',

        'dukungan_koperasi' => 'boolean',
        'dukungan_kelompok' => 'boolean',
        'dukungan_pinjaman' => 'boolean',
        'dukungan_pemerintah' => 'boolean',
        'dukungan_lain' => 'boolean',

        'bantu_lindung_penyuluhan' => 'boolean',
        'bantu_lindung_moral' => 'boolean',
        'bantu_lindung_polisi' => 'boolean',
        'bantu_lindung_pos' => 'boolean',
        'bantu_lindung_rumah' => 'boolean',
        'bantu_lindung_lain' => 'boolean',

        'masalah_rumah_relokasi' => 'boolean',
        'masalah_rumah_rusak' => 'boolean',
        'masalah_rumah_belum' => 'boolean',
        'masalah_rumah_lain' => 'boolean',

        'tindakan_rumah_stimulus' => 'boolean',
        'tindakan_rumah_kredit' => 'boolean',
        'tindakan_rumah_teknis' => 'boolean',
        'tindakan_rumah_lain' => 'boolean',

        'makanan_bantuan' => 'boolean',
        'makanan_cadangan' => 'boolean',
        'makanan_tanaman' => 'boolean',
        'makanan_lain' => 'boolean',

        'dukungan_pangan_langsung' => 'boolean',
        'dukungan_pangan_pulih' => 'boolean',
        'dukungan_pangan_gotong' => 'boolean',
        'dukungan_pangan_lain' => 'boolean',

        'air_kurang' => 'boolean',
        'air_kotor' => 'boolean',
        'air_simpan' => 'boolean',
        'air_lain' => 'boolean',

        'dukungan_air_sedia' => 'boolean',
        'dukungan_air_pulih' => 'boolean',
        'dukungan_air_simpan' => 'boolean',
        'dukungan_air_lain' => 'boolean',

        'perbaikan_obat' => 'boolean',
        'perbaikan_medis' => 'boolean',
        'perbaikan_jarak' => 'boolean',
        'perbaikan_biaya' => 'boolean',
        'perbaikan_psiko' => 'boolean',
        'perbaikan_lain' => 'boolean',

        'dukungan_pend_guru' => 'boolean',
        'dukungan_pend_alat' => 'boolean',
        'dukungan_pend_biaya' => 'boolean',
        'dukungan_pend_trans' => 'boolean',
        'dukungan_pend_dekat' => 'boolean',
        'dukungan_pend_bangun' => 'boolean',
        'dukungan_pend_lain' => 'boolean',

        'dukungan_agama_stimulus' => 'boolean',
        'dukungan_agama_latih' => 'boolean',
        'dukungan_agama_izin' => 'boolean',
        'dukungan_agama_lain' => 'boolean',

        'cegah_info' => 'boolean',
        'cegah_latih' => 'boolean',
        'cegah_rencana' => 'boolean',
        'cegah_fasilitas' => 'boolean',
        'cegah_warning' => 'boolean',
        'cegah_komunitas' => 'boolean',
        'cegah_budaya' => 'boolean',
        'cegah_lain' => 'boolean',

        'butuh_anak' => 'boolean',
        'butuh_lansia' => 'boolean',
        'butuh_difabel' => 'boolean',
        'butuh_hamil' => 'boolean',
        'butuh_lain' => 'boolean',
    ];


    public function bencana()
    {
        return $this->belongsTo(\App\Models\Bencana::class);
    }
}