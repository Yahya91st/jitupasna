<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Format17Form4 extends Model
{
    protected $table = 'format17_form4s';
    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        // Ekosistem Darat (3 baris)
        'ekosistem_darat_1_jenis', 'ekosistem_darat_1_rb', 'ekosistem_darat_1_rs', 'ekosistem_darat_1_rr', 'ekosistem_darat_1_rb_harga', 'ekosistem_darat_1_rs_harga', 'ekosistem_darat_1_rr_harga',
        'ekosistem_darat_2_jenis', 'ekosistem_darat_2_rb', 'ekosistem_darat_2_rs', 'ekosistem_darat_2_rr', 'ekosistem_darat_2_rb_harga', 'ekosistem_darat_2_rs_harga', 'ekosistem_darat_2_rr_harga',
        'ekosistem_darat_3_jenis', 'ekosistem_darat_3_rb', 'ekosistem_darat_3_rs', 'ekosistem_darat_3_rr', 'ekosistem_darat_3_rb_harga', 'ekosistem_darat_3_rs_harga', 'ekosistem_darat_3_rr_harga',
        // Ekosistem Laut (3 baris)
        'ekosistem_laut_1_jenis', 'ekosistem_laut_1_rb', 'ekosistem_laut_1_rs', 'ekosistem_laut_1_rr', 'ekosistem_laut_1_rb_harga', 'ekosistem_laut_1_rs_harga', 'ekosistem_laut_1_rr_harga',
        'ekosistem_laut_2_jenis', 'ekosistem_laut_2_rb', 'ekosistem_laut_2_rs', 'ekosistem_laut_2_rr', 'ekosistem_laut_2_rb_harga', 'ekosistem_laut_2_rs_harga', 'ekosistem_laut_2_rr_harga',
        'ekosistem_laut_3_jenis', 'ekosistem_laut_3_rb', 'ekosistem_laut_3_rs', 'ekosistem_laut_3_rr', 'ekosistem_laut_3_rb_harga', 'ekosistem_laut_3_rs_harga', 'ekosistem_laut_3_rr_harga',
        // Ekosistem Udara (3 baris)
        'ekosistem_udara_1_jenis', 'ekosistem_udara_1_rb', 'ekosistem_udara_1_rs', 'ekosistem_udara_1_rr', 'ekosistem_udara_1_rb_harga', 'ekosistem_udara_1_rs_harga', 'ekosistem_udara_1_rr_harga',
        'ekosistem_udara_2_jenis', 'ekosistem_udara_2_rb', 'ekosistem_udara_2_rs', 'ekosistem_udara_2_rr', 'ekosistem_udara_2_rb_harga', 'ekosistem_udara_2_rs_harga', 'ekosistem_udara_2_rr_harga',
        'ekosistem_udara_3_jenis', 'ekosistem_udara_3_rb', 'ekosistem_udara_3_rs', 'ekosistem_udara_3_rr', 'ekosistem_udara_3_rb_harga', 'ekosistem_udara_3_rs_harga', 'ekosistem_udara_3_rr_harga',
        // Kerugian Lingkungan (3 baris)
        'kerugian_1_jenis', 'kerugian_1_rb', 'kerugian_1_rs', 'kerugian_1_rr', 'kerugian_1_rb_harga', 'kerugian_1_rs_harga', 'kerugian_1_rr_harga',
        'kerugian_2_jenis', 'kerugian_2_rb', 'kerugian_2_rs', 'kerugian_2_rr', 'kerugian_2_rb_harga', 'kerugian_2_rs_harga', 'kerugian_2_rr_harga',
        'kerugian_3_jenis', 'kerugian_3_rb', 'kerugian_3_rs', 'kerugian_3_rr', 'kerugian_3_rb_harga', 'kerugian_3_rs_harga', 'kerugian_3_rr_harga',
        // Total Kerusakan
        'total_kerusakan',
    ];
    protected $casts = [
        // Ekosistem Darat
        'ekosistem_darat_1_rb' => 'integer', 'ekosistem_darat_1_rs' => 'integer', 'ekosistem_darat_1_rr' => 'integer',
        'ekosistem_darat_1_rb_harga' => 'decimal:2', 'ekosistem_darat_1_rs_harga' => 'decimal:2', 'ekosistem_darat_1_rr_harga' => 'decimal:2',
        'ekosistem_darat_2_rb' => 'integer', 'ekosistem_darat_2_rs' => 'integer', 'ekosistem_darat_2_rr' => 'integer',
        'ekosistem_darat_2_rb_harga' => 'decimal:2', 'ekosistem_darat_2_rs_harga' => 'decimal:2', 'ekosistem_darat_2_rr_harga' => 'decimal:2',
        'ekosistem_darat_3_rb' => 'integer', 'ekosistem_darat_3_rs' => 'integer', 'ekosistem_darat_3_rr' => 'integer',
        'ekosistem_darat_3_rb_harga' => 'decimal:2', 'ekosistem_darat_3_rs_harga' => 'decimal:2', 'ekosistem_darat_3_rr_harga' => 'decimal:2',
        // Ekosistem Laut
        'ekosistem_laut_1_rb' => 'integer', 'ekosistem_laut_1_rs' => 'integer', 'ekosistem_laut_1_rr' => 'integer',
        'ekosistem_laut_1_rb_harga' => 'decimal:2', 'ekosistem_laut_1_rs_harga' => 'decimal:2', 'ekosistem_laut_1_rr_harga' => 'decimal:2',
        'ekosistem_laut_2_rb' => 'integer', 'ekosistem_laut_2_rs' => 'integer', 'ekosistem_laut_2_rr' => 'integer',
        'ekosistem_laut_2_rb_harga' => 'decimal:2', 'ekosistem_laut_2_rs_harga' => 'decimal:2', 'ekosistem_laut_2_rr_harga' => 'decimal:2',
        'ekosistem_laut_3_rb' => 'integer', 'ekosistem_laut_3_rs' => 'integer', 'ekosistem_laut_3_rr' => 'integer',
        'ekosistem_laut_3_rb_harga' => 'decimal:2', 'ekosistem_laut_3_rs_harga' => 'decimal:2', 'ekosistem_laut_3_rr_harga' => 'decimal:2',
        // Ekosistem Udara
        'ekosistem_udara_1_rb' => 'integer', 'ekosistem_udara_1_rs' => 'integer', 'ekosistem_udara_1_rr' => 'integer',
        'ekosistem_udara_1_rb_harga' => 'decimal:2', 'ekosistem_udara_1_rs_harga' => 'decimal:2', 'ekosistem_udara_1_rr_harga' => 'decimal:2',
        'ekosistem_udara_2_rb' => 'integer', 'ekosistem_udara_2_rs' => 'integer', 'ekosistem_udara_2_rr' => 'integer',
        'ekosistem_udara_2_rb_harga' => 'decimal:2', 'ekosistem_udara_2_rs_harga' => 'decimal:2', 'ekosistem_udara_2_rr_harga' => 'decimal:2',
        'ekosistem_udara_3_rb' => 'integer', 'ekosistem_udara_3_rs' => 'integer', 'ekosistem_udara_3_rr' => 'integer',
        'ekosistem_udara_3_rb_harga' => 'decimal:2', 'ekosistem_udara_3_rs_harga' => 'decimal:2', 'ekosistem_udara_3_rr_harga' => 'decimal:2',
        // Kerugian Lingkungan
        'kerugian_1_rb' => 'integer', 'kerugian_1_rs' => 'integer', 'kerugian_1_rr' => 'integer',
        'kerugian_1_rb_harga' => 'decimal:2', 'kerugian_1_rs_harga' => 'decimal:2', 'kerugian_1_rr_harga' => 'decimal:2',
        'kerugian_2_rb' => 'integer', 'kerugian_2_rs' => 'integer', 'kerugian_2_rr' => 'integer',
        'kerugian_2_rb_harga' => 'decimal:2', 'kerugian_2_rs_harga' => 'decimal:2', 'kerugian_2_rr_harga' => 'decimal:2',
        'kerugian_3_rb' => 'integer', 'kerugian_3_rs' => 'integer', 'kerugian_3_rr' => 'integer',
        'kerugian_3_rb_harga' => 'decimal:2', 'kerugian_3_rs_harga' => 'decimal:2', 'kerugian_3_rr_harga' => 'decimal:2',
    ];

    // Hitung total kerusakan seluruh ekosistem dan simpan ke kolom total_kerusakan
    public function getTotalKerusakanAttribute()
    {
        return $this->attributes['total_kerusakan'] ?? 0;
    }

    protected static function booted()
    {
        static::saving(function ($format17) {
            $total = 0;
            // Ekosistem Darat
            for ($i = 1; $i <= 3; $i++) {
                $total += ($format17->{"ekosistem_darat_{$i}_rb"} * $format17->{"ekosistem_darat_{$i}_rb_harga"});
                $total += ($format17->{"ekosistem_darat_{$i}_rs"} * $format17->{"ekosistem_darat_{$i}_rs_harga"});
                $total += ($format17->{"ekosistem_darat_{$i}_rr"} * $format17->{"ekosistem_darat_{$i}_rr_harga"});
            }
            // Ekosistem Laut
            for ($i = 1; $i <= 3; $i++) {
                $total += ($format17->{"ekosistem_laut_{$i}_rb"} * $format17->{"ekosistem_laut_{$i}_rb_harga"});
                $total += ($format17->{"ekosistem_laut_{$i}_rs"} * $format17->{"ekosistem_laut_{$i}_rs_harga"});
                $total += ($format17->{"ekosistem_laut_{$i}_rr"} * $format17->{"ekosistem_laut_{$i}_rr_harga"});
            }
            // Ekosistem Udara
            for ($i = 1; $i <= 3; $i++) {
                $total += ($format17->{"ekosistem_udara_{$i}_rb"} * $format17->{"ekosistem_udara_{$i}_rb_harga"});
                $total += ($format17->{"ekosistem_udara_{$i}_rs"} * $format17->{"ekosistem_udara_{$i}_rs_harga"});
                $total += ($format17->{"ekosistem_udara_{$i}_rr"} * $format17->{"ekosistem_udara_{$i}_rr_harga"});
            }
            $format17->total_kerusakan = $total;
        });
    }

    /**
     * Get the bencana that owns the Format17Form4.
     */
    public function bencana(): BelongsTo
    {
        return $this->belongsTo(Bencana::class);
    }
}
