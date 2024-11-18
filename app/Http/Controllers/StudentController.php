<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentsRequest;
use App\Models\Student;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $Student;

    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }
    
    public function index()
    {
       // return Student::with(['phase','grade','section'])->get();
        return $this->Student->Get_Student();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Student->Create_Student();
    }

    /**
     * Store a newly created resource in storage.
     */
    
     public function store(StoreStudentsRequest $request)
     {
        return $this->Student->Store_Student($request);
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
    public function edit(string $id)
    {
        return $this->Student->Edit_Student($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(([
            'Name' => 'required',
            'email' => 'required|email|unique:students,email,'.$request->id,
            'password' => 'required|string|min:6|max:20',
            'nationalitie_id' => 'required',
            'Date_Birth' => 'required|date|date_format:Y-m-d',
            'Gender' => 'required',
            'phase_id' => 'required',
            'section_id' => 'required',
            'parent_id' => 'required',
            'academic_year' => 'required',
        ]));

        return $this->Student->Update_Student($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        return $this->Student->Delete_Student($request);

    }
    
    public function Get_grade($id)
    {
       return $this->Student->Get_grade($id);
    }

    public function Get_Sections($id)
    {
        return $this->Student->Get_Sections($id);
    }
}