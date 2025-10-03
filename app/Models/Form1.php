<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form1 extends Model
{
    use HasFactory;
    
    protected $table = 'form1';    protected $fillable = [
        'bencana_id',
        'kop_surat',
        'nomor_surat',
        'nomor_surat_date',
        'sifat',
        'lampiran',
        'kepada_jabatan',
        'lokasi_pdna',
        'hari_tanggal',
        'waktu',
        'tempat',
        'agenda',
        'nama_penandatangan',
        'tembusan'
    ];
    
    // Dates  
    protected $casts = [
        'nomor_surat_date' => 'date',
        'lampiran' => 'integer'
    ];
      // Relationships
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}