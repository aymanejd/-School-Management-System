<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    public function grades(){
        return $this->belongsTo(Grade::class,'grade_id');
    }
    public function phases(){
        return $this->belongsTo(Phase::class,'phase_id');
    }
    public function teachers(){
        return $this->belongsToMany(Teacher::class,'teacher_section')->withPivot('teacher_id');
    }
    
}