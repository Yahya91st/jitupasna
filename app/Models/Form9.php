<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form9 extends Model
{
    use HasFactory;
    
    protected $table = 'form9';
    
    protected $fillable = [
        'bencana_id',
        'nomor_kuesioner',
        'jenis_kelamin',
        'umur',
        'desa_kelurahan',
        'kecamatan',
        'tanggal',
    ];
    
    // Cast array data properly for multi-select fields
    protected $casts = [
        'dukungan_pangan_air' => 'array',
        // Add other array fields here as needed
    ];
    
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
