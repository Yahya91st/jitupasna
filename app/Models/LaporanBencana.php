<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBencana extends Model
{
    use HasFactory;

    protected $table = 'laporan_bencanas';

    protected $fillable = [
        'user_id',
        'bencana_id',
        'tanggal_lapor',
        'status_laporan',
        'total_kerusakan',
        'total_kerugian',
    ];

    protected $casts = [
        'tanggal_lapor' => 'date',
    ];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
    
    public function kajian()
    {
    return $this->hasOne(Kajian::class, 'laporan_id');
    }        
    
    public function keputusan()
    {
    return $this->hasOne(Keputusan::class, 'laporan_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formulirs()
    {
        return $this->hasMany(Formulir::class, 'laporan_id');
    }
    
}
