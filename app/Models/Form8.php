<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form8 extends Model
{
    use HasFactory;

    protected $table = 'form8';

    protected $fillable = [
        'bencana_id',
        'tanggal',
        'keterangan',    
    ];

    /**
     * Relationship with Bencana
     */
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

    public function rows()
    {
        return $this->hasMany(Form8Row::class, 'form8_id');
    }
}
