<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Phase;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $phases=Phase::all();
        $grade=Grade::find(1);
        $grades = Grade::all();
       
        return view('pages.Grades.grades',compact('grades','phases'));  
      }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Grade::With('pahses')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
     {    
        $formfields=$request->validate([
         'grade_name'=>'unique:grades',

  
       ]);
        $phase_lists=$request->List_Phases ;
        foreach($phase_lists as $phase_list){
            $phase=Phase::find($phase_list['Grade_id']);
            $grade= new Grade($phase_list);
            
            $phase->grades()->save($grade);
            

        }
        toastr()->success('Grade created successfully!');

        return  to_route('grade.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $grade=Grade::findOrFail($id);
        $grade->update(['grade_name'=>$request->grade_name
    ,'phase_id'=>$request->phase_id]);
        toastr()->success('Grade updated successfully!');

        return  to_route('grade.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        Grade::findOrFail($id)->delete();
        toastr()->success('Grade delted successfully!');

        return  to_route('grade.index');
    }
    public function deleteall(Request $request){
      
        $delete_all_id=explode(',',$request->delete_all_id);
        Grade::whereIn('id',$delete_all_id)->delete();
        toastr()->error('Grades deleted successfully!');

        return  to_route('grade.index');
    }
    public function filter_grade(Request $request){
        $grades=Grade::all();
        $phases=Phase::all();
       // dd($request->phase_id);
        $searchgrade=Grade::select('*')->where('phase_id',$request->phase_id)->get();

        return view('pages.Grades.grades',compact('grades','phases','searchgrade'));  

    }
}