<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Format15Form4 extends Model
{
    protected $table = 'format15_form4s';
    protected $fillable = [
        'bencana_id',
        'kabupaten',
        'nama_kampung',
        'nama_distrik',
        // Fasilitas
        'fasilitas_1_jenis', 'fasilitas_1_rb_tingkat', 'fasilitas_1_rs_tingkat', 'fasilitas_1_rr_tingkat', 'fasilitas_1_rb_harga', 'fasilitas_1_rs_harga', 'fasilitas_1_rr_harga',
        'fasilitas_2_jenis', 'fasilitas_2_rb_tingkat', 'fasilitas_2_rs_tingkat', 'fasilitas_2_rr_tingkat', 'fasilitas_2_rb_harga', 'fasilitas_2_rs_harga', 'fasilitas_2_rr_harga',
        'fasilitas_3_jenis', 'fasilitas_3_rb_tingkat', 'fasilitas_3_rs_tingkat', 'fasilitas_3_rr_tingkat', 'fasilitas_3_rb_harga', 'fasilitas_3_rs_harga', 'fasilitas_3_rr_harga',
        // Kerugian
        'kerugian_1_jenis', 'kerugian_1_rb_nilai', 'kerugian_1_rs_nilai',
        'kerugian_2_jenis', 'kerugian_2_rb_nilai', 'kerugian_2_rs_nilai',
        'kerugian_3_jenis', 'kerugian_3_rb_nilai', 'kerugian_3_rs_nilai',
        'kerugian_4_jenis', 'kerugian_4_rb_nilai', 'kerugian_4_rs_nilai',
    ];
    protected $casts = [
        // Fasilitas
        'fasilitas_1_rb_tingkat' => 'integer', 'fasilitas_1_rs_tingkat' => 'integer', 'fasilitas_1_rr_tingkat' => 'integer',
        'fasilitas_1_rb_harga' => 'decimal:2', 'fasilitas_1_rs_harga' => 'decimal:2', 'fasilitas_1_rr_harga' => 'decimal:2',
        'fasilitas_2_rb_tingkat' => 'integer', 'fasilitas_2_rs_tingkat' => 'integer', 'fasilitas_2_rr_tingkat' => 'integer',
        'fasilitas_2_rb_harga' => 'decimal:2', 'fasilitas_2_rs_harga' => 'decimal:2', 'fasilitas_2_rr_harga' => 'decimal:2',
        'fasilitas_3_rb_tingkat' => 'integer', 'fasilitas_3_rs_tingkat' => 'integer', 'fasilitas_3_rr_tingkat' => 'integer',
        'fasilitas_3_rb_harga' => 'decimal:2', 'fasilitas_3_rs_harga' => 'decimal:2', 'fasilitas_3_rr_harga' => 'decimal:2',
        // Kerugian
        'kerugian_1_rb_nilai' => 'decimal:2', 'kerugian_1_rs_nilai' => 'decimal:2',
        'kerugian_2_rb_nilai' => 'decimal:2', 'kerugian_2_rs_nilai' => 'decimal:2',
        'kerugian_3_rb_nilai' => 'decimal:2', 'kerugian_3_rs_nilai' => 'decimal:2',
        'kerugian_4_rb_nilai' => 'decimal:2', 'kerugian_4_rs_nilai' => 'decimal:2',
    ];

    /**
     * Get the bencana that owns the Format15Form4.
     */
    public function bencana(): BelongsTo
    {
        return $this->belongsTo(Bencana::class);
    }
}
