<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable=[
        'student_id',
        'phase_id',
        'grade_id',
        'section_id',
        'teacher_id',
        'attendence_date',
        'attendence_status',
    ];
}