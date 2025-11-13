<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form10 extends Model
{
    use HasFactory;
    
    protected $table = 'form10';
    
    protected $fillable = [
        'bencana_id',
        'tanggal',
        'keterangan',    
    ];

    protected $casts = [
        'tanggal' => 'datetime', 
    ];

    // Relationships
    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }

    public function rows()
    {
        return $this->hasMany(Form10Row::class, 'Form10_id');
    }    
}
