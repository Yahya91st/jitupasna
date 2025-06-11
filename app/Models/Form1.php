<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form1 extends Model
{
    use HasFactory;
    
    protected $table = 'form1';
      protected $fillable = [
        'bencana_id',
        'nomor_surat',
        'sifat',
        'lampiran',
        'perihal',
        'kepada',
        'lokasi_pdna',
        'hari_tanggal',
        'waktu',
        'tempat',
        'agenda',
        'nama_penandatangan',
        'jabatan_penandatangan',
        'tembusan',
        'tanggal_surat',
        'instansi_pengirim'
    ];
    
    // Dates
    protected $casts = [
        'hari_tanggal' => 'date',
        'tanggal_surat' => 'date',
        'waktu' => 'datetime:H:i'
    ];
      // Relationships
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}