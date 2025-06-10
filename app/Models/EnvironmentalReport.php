<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnvironmentalReport extends Model
{
    use HasFactory;
    
    protected $table = 'environmental_reports';
    
    protected $fillable = [
        'bencana_id',
        'report_type', // 'damage' atau 'loss' untuk membedakan jenis laporan
        'ekosistem', // 'darat', 'laut', 'udara' untuk damage
        'jenis_kerugian', // 'kehilangan_jasa_lingkungan', 'pencemaran_air', 'pencemaran_udara' untuk loss
        'jenis_kerusakan', // untuk damage
        'jenis', // untuk loss
        'dasar_perhitungan', // untuk loss
        'rb',
        'rs',
        'rr',
        'harga_rb',
        'harga_rs',
        'harga_rr',
        'catatan',
    ];
    
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
    
    // Scope untuk menampilkan hanya data kerusakan
    public function scopeDamage($query)
    {
        return $query->where('report_type', 'damage');
    }
    
    // Scope untuk menampilkan hanya data kerugian
    public function scopeLoss($query)
    {
        return $query->where('report_type', 'loss');
    }
}