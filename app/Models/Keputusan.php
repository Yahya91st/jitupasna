<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keputusan extends Model
{
    use HasFactory;

    protected $table = 'keputusan';
    
    protected $fillable = [
        'nomor_surat',
        'tentang',
        'lokasi',
        'tanggal_ditetapkan',
        'pejabat_penandatangan',
        'dasar_hukum',
        'keputusan',
        'tim_kerja',
        'tugas_tim',
        'penanggung_jawab',
        'tembusan',
        'bencana_id',
        'created_by',
        'updated_by'
    ];

    /**
     * Get the bencana that owns the keputusan.
     */
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

    /**
     * Get the user that created the keputusan.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    /**
     * Get the user that last updated the keputusan.
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}