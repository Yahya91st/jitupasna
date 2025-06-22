<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekapitulasi extends Model
{
    use HasFactory;
    
    protected $table = 'rekapitulasi';
    
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
        'updated_by',
    ];
    
    /**
     * Get the bencana that owns the rekapitulasi.
     */
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
    
    /**
     * Get the user who created the rekapitulasi.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    /**
     * Get the user who updated the rekapitulasi.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
