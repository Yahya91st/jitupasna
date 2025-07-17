<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Format14Form4 extends Model
{
    protected $table = 'format14_form4s';
    protected $fillable = [
        'bencana_id',
        'kabupaten',
        'nama_kampung',
        'nama_distrik',
        // Tempat Usaha
        'tempatusaha_1_jenis', 'tempatusaha_1_rb_jumlah', 'tempatusaha_1_rs_jumlah', 'tempatusaha_1_rr_jumlah', 'tempatusaha_1_rb_harga', 'tempatusaha_1_rs_harga', 'tempatusaha_1_rr_harga',
        'tempatusaha_2_jenis', 'tempatusaha_2_rb_jumlah', 'tempatusaha_2_rs_jumlah', 'tempatusaha_2_rr_jumlah', 'tempatusaha_2_rb_harga', 'tempatusaha_2_rs_harga', 'tempatusaha_2_rr_harga',
        'tempatusaha_3_jenis', 'tempatusaha_3_rb_jumlah', 'tempatusaha_3_rs_jumlah', 'tempatusaha_3_rr_jumlah', 'tempatusaha_3_rb_harga', 'tempatusaha_3_rs_harga', 'tempatusaha_3_rr_harga',
        // Peralatan
        'peralatan_1_jenis', 'peralatan_1_rb_jumlah', 'peralatan_1_rs_jumlah', 'peralatan_1_rr_jumlah', 'peralatan_1_rb_harga', 'peralatan_1_rs_harga', 'peralatan_1_rr_harga',
        'peralatan_2_jenis', 'peralatan_2_rb_jumlah', 'peralatan_2_rs_jumlah', 'peralatan_2_rr_jumlah', 'peralatan_2_rb_harga', 'peralatan_2_rs_harga', 'peralatan_2_rr_harga',
        'peralatan_3_jenis', 'peralatan_3_rb_jumlah', 'peralatan_3_rs_jumlah', 'peralatan_3_rr_jumlah', 'peralatan_3_rb_harga', 'peralatan_3_rs_harga', 'peralatan_3_rr_harga',
        // Barang Dagangan
        'barangdagangan_1_jenis', 'barangdagangan_1_rb_jumlah', 'barangdagangan_1_rs_jumlah', 'barangdagangan_1_rr_jumlah', 'barangdagangan_1_rb_harga', 'barangdagangan_1_rs_harga', 'barangdagangan_1_rr_harga',
        'barangdagangan_2_jenis', 'barangdagangan_2_rb_jumlah', 'barangdagangan_2_rs_jumlah', 'barangdagangan_2_rr_jumlah', 'barangdagangan_2_rb_harga', 'barangdagangan_2_rs_harga', 'barangdagangan_2_rr_harga',
        'barangdagangan_3_jenis', 'barangdagangan_3_rb_jumlah', 'barangdagangan_3_rs_jumlah', 'barangdagangan_3_rr_jumlah', 'barangdagangan_3_rb_harga', 'barangdagangan_3_rs_harga', 'barangdagangan_3_rr_harga',
    ];
    protected $casts = [
        // Tempat Usaha
        'tempatusaha_1_rb_jumlah' => 'integer', 'tempatusaha_1_rs_jumlah' => 'integer', 'tempatusaha_1_rr_jumlah' => 'integer',
        'tempatusaha_1_rb_harga' => 'decimal:2', 'tempatusaha_1_rs_harga' => 'decimal:2', 'tempatusaha_1_rr_harga' => 'decimal:2',
        'tempatusaha_2_rb_jumlah' => 'integer', 'tempatusaha_2_rs_jumlah' => 'integer', 'tempatusaha_2_rr_jumlah' => 'integer',
        'tempatusaha_2_rb_harga' => 'decimal:2', 'tempatusaha_2_rs_harga' => 'decimal:2', 'tempatusaha_2_rr_harga' => 'decimal:2',
        'tempatusaha_3_rb_jumlah' => 'integer', 'tempatusaha_3_rs_jumlah' => 'integer', 'tempatusaha_3_rr_jumlah' => 'integer',
        'tempatusaha_3_rb_harga' => 'decimal:2', 'tempatusaha_3_rs_harga' => 'decimal:2', 'tempatusaha_3_rr_harga' => 'decimal:2',
        // Peralatan
        'peralatan_1_rb_jumlah' => 'integer', 'peralatan_1_rs_jumlah' => 'integer', 'peralatan_1_rr_jumlah' => 'integer',
        'peralatan_1_rb_harga' => 'decimal:2', 'peralatan_1_rs_harga' => 'decimal:2', 'peralatan_1_rr_harga' => 'decimal:2',
        'peralatan_2_rb_jumlah' => 'integer', 'peralatan_2_rs_jumlah' => 'integer', 'peralatan_2_rr_jumlah' => 'integer',
        'peralatan_2_rb_harga' => 'decimal:2', 'peralatan_2_rs_harga' => 'decimal:2', 'peralatan_2_rr_harga' => 'decimal:2',
        'peralatan_3_rb_jumlah' => 'integer', 'peralatan_3_rs_jumlah' => 'integer', 'peralatan_3_rr_jumlah' => 'integer',
        'peralatan_3_rb_harga' => 'decimal:2', 'peralatan_3_rs_harga' => 'decimal:2', 'peralatan_3_rr_harga' => 'decimal:2',
        // Barang Dagangan
        'barangdagangan_1_rb_jumlah' => 'integer', 'barangdagangan_1_rs_jumlah' => 'integer', 'barangdagangan_1_rr_jumlah' => 'integer',
        'barangdagangan_1_rb_harga' => 'decimal:2', 'barangdagangan_1_rs_harga' => 'decimal:2', 'barangdagangan_1_rr_harga' => 'decimal:2',
        'barangdagangan_2_rb_jumlah' => 'integer', 'barangdagangan_2_rs_jumlah' => 'integer', 'barangdagangan_2_rr_jumlah' => 'integer',
        'barangdagangan_2_rb_harga' => 'decimal:2', 'barangdagangan_2_rs_harga' => 'decimal:2', 'barangdagangan_2_rr_harga' => 'decimal:2',
        'barangdagangan_3_rb_jumlah' => 'integer', 'barangdagangan_3_rs_jumlah' => 'integer', 'barangdagangan_3_rr_jumlah' => 'integer',
        'barangdagangan_3_rb_harga' => 'decimal:2', 'barangdagangan_3_rs_harga' => 'decimal:2', 'barangdagangan_3_rr_harga' => 'decimal:2',
    ];
}
