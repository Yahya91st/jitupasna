<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kajian extends Model
{
    use HasFactory;

    protected $table = 'kajians';

    protected $fillable = [
        'kehilangan_akses',
        'gangguan_fungsi',
        'penigkatan_resiko',
    ];
    protected $casts = [
        'kehilangan_akses' => 'text',
        'gangguan_fungsi' => 'text',
        'penigkatan_resiko' => 'text',
    ];

    public function rekap()
    {
        return $this->belongsTo(Rekap::class, 'rekap_id');
    }

}
