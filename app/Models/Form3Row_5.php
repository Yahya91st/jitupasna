<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form3Row_5 extends Model
{
    protected $table = 'form3_rows_5';

    protected $fillable = [
        'form3_id',
    ];

    public function form3()
    {
        return $this->belongsTo(Form3::class, 'form8_id');
    }
}