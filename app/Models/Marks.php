<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;
    protected $guarded = [];
   
    public function term()
    {
        return $this->belongsTo('App\Models\Term');
    }
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
}
