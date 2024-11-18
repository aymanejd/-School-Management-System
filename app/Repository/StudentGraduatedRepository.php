<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\Phase;
use App\Models\Student;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface
{

    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.Students.Graduated.index',compact('students'));
    }

    public function create()
    {
        $Phases = Phase::all();
        return view('pages.Students.Graduated.create',compact('Phases'));
    }

    public function SoftDelete($request)
    {
        $students = student::where('phase_id',$request->phase_id)->where('grade_id',$request->grade_id)->where('section_id',$request->section_id)->get();

        if($students->count() < 1){
            return redirect()->back()->with('error_Graduated', __(' There is no data in the student table'));
        }

        foreach ($students as $student){
            $ids = explode(',',$student->id);
            student::whereIn('id', $ids)->Delete();
        }

        toastr()->success(trans('Graduated applied successfully'));
        return redirect()->route('graduated.index');
    }

    public function ReturnData($request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->restore();
        toastr()->success(trans('Student returned  successfully'));
        return redirect()->back();
    }

    public function destroy($request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
        toastr()->error(trans('Student deleted  successfully'));
        return redirect()->back();
    }


}