<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Format10Form4 extends Model
{
    protected $table = 'format10_form4s';
    protected $fillable = [
        'bencana_id',
        'nama_kampung',
        'nama_distrik',
        'padi_luas', 'padi_lama_tanam', 'padi_harga', 'padi_total',
        'palawija_luas', 'palawija_lama_tanam', 'palawija_harga', 'palawija_total',
        'holtikultura_luas', 'holtikultura_lama_tanam', 'holtikultura_harga', 'holtikultura_total',
        'perkebunan1_luas', 'perkebunan1_lama_tanam', 'perkebunan1_harga', 'perkebunan1_total',
        'perkebunan2_luas', 'perkebunan2_lama_tanam', 'perkebunan2_harga', 'perkebunan2_total',
        'perkebunan3_luas', 'perkebunan3_lama_tanam', 'perkebunan3_harga', 'perkebunan3_total',
        'total_kerusakan',
        'total_kerugian',
    ];
    protected $casts = [
        'padi_luas' => 'decimal:2', 'padi_harga' => 'decimal:2', 'padi_total' => 'decimal:2',
        'palawija_luas' => 'decimal:2', 'palawija_harga' => 'decimal:2', 'palawija_total' => 'decimal:2',
        'holtikultura_luas' => 'decimal:2', 'holtikultura_harga' => 'decimal:2', 'holtikultura_total' => 'decimal:2',
        'perkebunan1_luas' => 'decimal:2', 'perkebunan1_harga' => 'decimal:2', 'perkebunan1_total' => 'decimal:2',
        'perkebunan2_luas' => 'decimal:2', 'perkebunan2_harga' => 'decimal:2', 'perkebunan2_total' => 'decimal:2',
        'perkebunan3_luas' => 'decimal:2', 'perkebunan3_harga' => 'decimal:2', 'perkebunan3_total' => 'decimal:2',
        'total_kerusakan' => 'decimal:2',
        'total_kerugian' => 'decimal:2',
    ];

    /**
     * Get the bencana that owns the Format10Form4.
     */
    public function bencana(): BelongsTo
    {
        return $this->belongsTo(Bencana::class);
    }
}
