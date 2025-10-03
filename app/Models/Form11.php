<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form11 extends Model
{
    use HasFactory;
    
    protected $table = 'form11';
    
    protected $fillable = [
        'bencana_id',
        'sektor',
        'sub_sektor',
        'lokasi',
        'jenis_kebutuhan',
        'rincian_kebutuhan',
        'jumlah_unit',
        'satuan',
        'harga_satuan',
        'total_kebutuhan',
        'prioritas',
        'durasi_penyelesaian',
        'penanggung_jawab',
        'keterangan',
        'created_by',
        'updated_by'
    ];
    
    protected $casts = [
        'jumlah_unit' => 'integer',
        'harga_satuan' => 'decimal:2',
        'total_kebutuhan' => 'decimal:2',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];
    
    // Relationships
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
