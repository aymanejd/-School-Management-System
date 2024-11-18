<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    public $translatable = ['name'];
    use SoftDeletes;
    protected $guarded =[];
    public function phase()
    {
        return $this->belongsTo(Phase::class, 'phase_id');
    }



    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }


    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
}