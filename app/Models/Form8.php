<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form8 extends Model
{
    use HasFactory;

    protected $table = 'form8';

    protected $fillable = [
        'bencana_id',
        'sektor',
        'sub_sektor',
        'komponen_kerusakan',
        'lokasi',
        
        // Data Kerusakan
        'data_kerusakan_rb',
        'data_kerusakan_rs',
        'data_kerusakan_rr',
        
        // Harga Satuan
        'harga_satuan_rb',
        'harga_satuan_rs',
        'harga_satuan_rr',
        
        // Nilai Kerusakan
        'nilai_kerusakan_rb',
        'nilai_kerusakan_rs',
        'nilai_kerusakan_rr',
        
        // Perkiraan Kerugian dan Total
        'perkiraan_kerugian',
        'total_kerusakan_kerugian',
        'kebutuhan',
        
        // Dynamic rows data
        'dynamic_rows',
    ];

    protected $casts = [
        'harga_satuan_rb' => 'decimal:2',
        'harga_satuan_rs' => 'decimal:2',
        'harga_satuan_rr' => 'decimal:2',
        'nilai_kerusakan_rb' => 'decimal:2',
        'nilai_kerusakan_rs' => 'decimal:2',
        'nilai_kerusakan_rr' => 'decimal:2',
        'perkiraan_kerugian' => 'decimal:2',
        'total_kerusakan_kerugian' => 'decimal:2',
        'kebutuhan' => 'decimal:2',
        'dynamic_rows' => 'array',
    ];

    /**
     * Relationship with Bencana
     */
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
