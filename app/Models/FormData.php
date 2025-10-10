<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  form extends Model
{
    protected $fillable = [
        'form_type',
        'bencana_id',
        'category',
        'name',
        'data',
    ];

    protected $casts = [
        'data' => 'json'
    ];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class);
    }
}
