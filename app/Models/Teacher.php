<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = [];
    public function specializations()
    {
        return $this->belongsTo(Specialization::class,'Specialization_id');
    }
}