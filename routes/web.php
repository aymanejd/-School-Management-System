<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\GraduatedController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TeacherController;
use App\Models\Phase;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('phase', PhaseController::class);
    Route::resource('grade', GradeController::class);
    Route::delete('delete_all',[GradeController::class,'deleteall'])->name('delete_all');
    Route::post('filter_grade',[GradeController::class,'filter_grade'])->name('filter_grade');
    Route::resource('section', SectionController::class);
    Route::get('phases/{id}', [SectionController::class,'getgrade']);
    Route::view('add_parent','livewire.show_Form');
    Route::resource('teacher', TeacherController::class);
    Route::resource('student', StudentController::class);
    Route::get('/Get_grade/{id}', [StudentController::class,'Get_grade']);
    Route::get('/Get_Sections/{id}',[ StudentController::class,'Get_Sections' ]);

    Route::resource('promotion', PromotionController::class);
    Route::resource('graduated', GraduatedController::class);

    Route::resource('attendance', AttendanceController::class);
});