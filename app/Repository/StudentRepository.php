<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Phase;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;


class StudentRepository implements StudentRepositoryInterface
{

    public function Create_Student()
    {

        $data['my_classes'] = Phase::all();
        $data['parents'] = My_Parent::all();
        $data['nationals'] = Nationalitie::all();
        return view('pages.Students.add', $data);
    }
    public function Get_Student()
    {
        $students = Student::all();
        return view('pages.Students.index', compact('students'));
    }

    public function Get_grade($id)
    {

        $list_classes = Grade::where("phase_id", $id)->pluck("id", "grade_name");
        return $list_classes;
    }

    //Get Sections
    public function Get_Sections($id)
    {

        $list_sections = Section::where("grade_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
    }

    public function Store_Student($request)
    {

        try {
            $students = new Student();
            $students->name = $request->Name;
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->Gender = $request->gender;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->phase_id = $request->phase_id;
            $students->grade_id = $request->grade_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('student.create');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
   

    public function Edit_Student($id)
    {
        $data['Phases'] = Phase::all();
        $data['parents'] = My_Parent::all();
        $data['nationals'] = Nationalitie::all();
        $Students =  Student::findOrFail($id);
        return view('pages.Students.edit',$data,compact('Students'));    }

    public function Get_classrooms($id)
    {
        // Implement get classrooms logic here
    }

    public function Update_Student($request)
    {
        try {
            $student = Student::findOrFail($request->id); // Assuming you have an 'id' field in your form
    
            $student->name = $request->Name;
            $student->email = $request->email;
            // You may want to check if the password field is not empty before updating it
            if (!empty($request->password)) {
                $student->password = Hash::make($request->password);
            }
            $student->Gender = $request->Gender;
            $student->nationalitie_id = $request->nationalitie_id;
            $student->Date_Birth = $request->Date_Birth;
            $student->phase_id = $request->phase_id;
            $student->grade_id = $request->grade_id;
            $student->section_id = $request->section_id;
            $student->parent_id = $request->parent_id;
            $student->academic_year = $request->academic_year;
            $student->save();
    
            toastr()->success(trans('messages.success'));
            return redirect()->route('student.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function Delete_Student($request)
{
    try {
        $student = Student::findOrFail($request->id);
        $student->delete();
        toastr()->success(trans('Sturdent Deleted successfully'));
        return redirect()->route('student.index');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}
}