<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Phase;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $phases = Phase::with('sections.teachers')->get();
        $list_phases = Phase::all();
        $teachers = Teacher::all();
        return view('pages.Sections.Sections', compact('phases', 'list_phases', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formfields = $request->validate([
            'Name_Section' => 'required',
            'grade' => 'required',
            'phase' => 'required',
            'teacher' => 'required|array',

        ]);
        $section = new Section();
        $section->Name_Section = $formfields['Name_Section'];
        $section->grade_id = $request->grade;
        $section->phase_id = $request->phase;
        $section->save();
        $sectio = Section::latest()->first();
        $sectio->teachers()->attach($request->teacher);
        $newSection = Section::findOrFail($section->id)->with(['phases', 'grades']);

        // Construct the data to be returned in the response
        return to_route('section.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $section = Section::findOrFail($request->id);
        $section->Name_Section = $request->Name_Section;
        $section->grade_id = $request->grade;
        $section->phase_id = $request->phase;
        $formfields = $request->validate([
            'Name_Section' => 'required',
            'grade' => 'required',
            'phase' => 'required',
            'teacher' => 'required|array',

        ]);
        if (isset($request->Status)) {
            $section->Status = 1;
        } else {
            $section->Status = 2;
        }
        $section->save();
        $section->teachers()->syncWithoutDetaching($request->teacher);

        toastr()->success('Setion has been updated successfully!');

        return to_route('section.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $section = Section::findOrFail($id);
        if ($request->has('teacher_id')) {
            $teacherId = $request->teacher_id;
            $section->teachers()->detach($teacherId);
        }
        $section->delete();
        toastr()->success('Setion has been deleted successfully!');

        return to_route('section.index');
    }
    public function getgrade($id)
    {
        $list_phases = Phase::find($id)->grades()->pluck("grade_Name", "id");

        return $list_phases;
    }
}