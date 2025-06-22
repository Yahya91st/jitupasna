<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analisa extends Model
{
    use HasFactory;
    
    protected $table = 'analisa';
    
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
        'updated_by',
    ];
    
    /**
     * Get the bencana that owns the analisa.
     */
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
    
    /**
     * Get the user who created the analisa.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    /**
     * Get the user who updated the analisa.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
