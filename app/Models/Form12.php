<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form12 extends Model
{
    use HasFactory;
    
    protected $table = 'form12';
    
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
        'updated_by'
    ];
    
    protected $casts = [
        'volume' => 'integer',
        'harga_satuan' => 'decimal:2',
        'jumlah' => 'decimal:2',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];
    
    // Relationships
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
