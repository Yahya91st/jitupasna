<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form2 extends Model
{
    use HasFactory;
    
    protected $table = 'form2';
    
    protected $fillable = [
        'bencana_id',
        'nomor_surat',
        'lokasi',
        'tanggal_ditetapkan',
        'tempat_ditetapkan',
        'pejabat_penandatangan',
        'nama_penandatangan',
        // 'keputusan',
        'penanggung_jawab',
        'tembusan',
        // 'created_by',
        'updated_by'
    ];
    
    protected $casts = [
        // tanggal_ditetapkan is string (formatted date from JS)
    ];
    
    // Relationships
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
