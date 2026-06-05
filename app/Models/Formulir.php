<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_id',
        'user_id',
        'format_id',
        'status',
    ];

    public function laporanBencana()
    {
        return $this->belongsTo(LaporanBencana::class, 'laporan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function formatFormulir()
    {
        return $this->belongsTo(FormatFormulir::class, 'format_id');
    }
}
