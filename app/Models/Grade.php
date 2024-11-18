<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{       protected $fillable=['grade_name','phase_id'];

    use HasFactory;
    public function phases (){
        return $this->belongsTo(Phase::class,'phase_id');
    }
}