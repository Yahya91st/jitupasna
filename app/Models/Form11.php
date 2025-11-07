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
        'tanggal',
        'keterangan',    
    ];
    
    // Relationships
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

    public function rows()
    {
        return $this->hasMany(Form11Row::class, 'form11_id');
    }    
}
