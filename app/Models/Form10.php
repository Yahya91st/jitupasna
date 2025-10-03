<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form10 extends Model
{
    use HasFactory;
    
    protected $table = 'form10';
    
    protected $fillable = [
        'bencana_id',
        'sektor',
        'sub_sektor',
        'lokasi',
        'hasil_survey',
        'hasil_wawancara',
        'hasil_pendataan_skpd',
        'kebutuhan_pemulihan',
        'created_by',
        'updated_by'
    ];
    
    protected $casts = [
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];
    
    // Relationships
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
