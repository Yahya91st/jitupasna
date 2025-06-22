<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model {
    use HasFactory;
    
    protected $table = 'penilaian';
    
    protected $fillable = [
        'bencana_id',
        'sektor',
        'sub_sektor',
        'komponen_kerusakan',
        'lokasi',
        'perkiraan_kerugian',
        'total_kerusakan_kerugian',
        'kebutuhan_rb',
        'kebutuhan_rs',
        'kebutuhan_rr',
        'harga_satuan',
        'nilai_kerusakan',
    ];
    
    // Relationship with Bencana
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
