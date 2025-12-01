<?php
namespace App\Models;

use App\Models\Form3;
use Illuminate\Database\Eloquent\Model;

class Form3Row_3 extends Model
{
    protected $table = 'form3_rows_3';
    protected $fillable = ['form3_id', 'grup', 'pertanyaan', 'jawaban'];

    public function form3()
    {
        return $this->belongsTo(Form3::class, 'form3_id');
    }
}
