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

    public function laporan()
    {
        return $this->belongsTo(LaporanBencana::class);
    }

    public function items()
    {
        return $this->hasMany(FormulirItem::class);
    }

    public function format()
    {
        return $this->belongsTo(FormatFormulir::class, 'format_id');
    }
}
