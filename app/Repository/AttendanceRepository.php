<?php


namespace App\Repository;


use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Phase;
use App\Models\Student;
use App\Models\Teacher;

class AttendanceRepository implements AttendanceRepositoryInterface
{

    public function index()
    {
        $Phases = Phase::with(['Sections'])->get();
        $list_phases = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Students.Attendance.Sections', compact('Phases', 'list_phases', 'teachers'));
    }

    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id', $id)->get();
        return view('pages.Students.Attendance.index', compact('students'));
    }

    public function store($request)
    {
        try {
            if (isset($request->attendences)) {
                foreach ($request->attendences as $studentid => $attendence) {

                    if ($attendence == 'presence') {
                        $attendence_status = true;
                    } else if ($attendence == 'absent') {
                        $attendence_status = false;
                    }

                    Attendance::create([
                        'student_id' => $studentid,
                        'phase_id' => $request->phase_id,
                        'grade_id' => $request->grade_id,
                        'section_id' => $request->section_id,
                        'teacher_id' => 1,
                        'attendence_date' => date('Y-m-d'),
                        'attendence_status' => $attendence_status
                    ]);
                }

                toastr()->success(trans('messages.success'));
            }

            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        // TODO: Implement update() method.
    }

    public function destroy($request)
    {
        // TODO: Implement destroy() method.
    }
}