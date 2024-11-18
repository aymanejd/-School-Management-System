<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Teachers=Teacher::all();
        return view('Pages.Teachers.Teacher',compact('Teachers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $Specializations = Specialization::all();
        return view('Pages.Teachers.create',compact('Specializations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Email' => 'required|email|unique:teachers',
            'Password' => 'required',
            'Name' => 'required',
            'Specialization' => 'required',
            'Gender_id' => 'required',
            'Joining_Date' => 'required|date',
            'Address' => 'required',
        ]);
    
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validation failed', 'errors' => $validator->errors()]);
        }
    
        $teacher = new Teacher();
        $teacher->Email = $request->Email;
        $teacher->Password = $request->Password;
        $teacher->Name = $request->Name;
        $teacher->Specialization_id = $request->Specialization;
        $teacher->Gender = $request->Gender_id;
        $teacher->Joining_Date = $request->Joining_Date;
        $teacher->Address = $request->Address;
        $teacher->save();    
        return response()->json(['success' => true, 'message' => 'Teacher added successfully', 'teacher' => $teacher]);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {   $teacher=Teacher::findOrFail(($id));
        $specializations=Specialization::all();
        return view('pages.Teachers.Edit',compact('teacher','specializations')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator =$request->validate([
            'Email' => 'required|email|unique:teachers,Email,'.$id,
            'Password' => 'required',
            'Name' => 'required',
            'Specialization_id' => 'required',
            'Gender' => 'required',
            'Joining_Date' => 'required|date',
            'Address' => 'required',
        ]);
        Teacher::findOrFail($id)->update($validator);
        toastr()->success('Teacher updated successfully!');

        return redirect()->route('teacher.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request ,$id)
    {
        Teacher::destroy($id) ;  
        return response()->json(['success' => true ,'tr' => 'tr_' . $id]);

    }
}