<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    protected $table = 'anggaran';
    
    protected $fillable = [
        'bencana_id',
        'sektor',
        'komponen_kebutuhan',
        'kegiatan',
        'lokasi',
        'volume',
        'satuan',
        'harga_satuan',
        'jumlah',
        'keterangan',
        'created_by',
        'updated_by',
    ];
    
    /**
     * Get the bencana that owns the anggaran.
     */
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
