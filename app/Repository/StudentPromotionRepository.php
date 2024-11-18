<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\Phase;
use App\Models\promotion;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface
{

    public function index()
    {
        $promotions = Promotion::all();
        return view('pages.Students.promotion.management', compact('promotions'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {

            $students = Student::where('phase_id', $request->phase_id)->where('grade_id', $request->grade_id)->where('section_id', $request->section_id)->get();

            if ($students->count() < 1) {
                return redirect()->back()->with('error_promotions', __('There is no data in the student table'));
            }

            foreach ($students as $student) {

                $ids = explode(',', $student->id);
                student::whereIn('id', $ids)
                    ->update([
                        'phase_id' => $request->phase_id_new,
                        'grade_id' => $request->grade_id_new,
                        'section_id' => $request->section_id_new,
                    ]);

                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_phase' => $request->phase_id,
                    'from_grade' => $request->grade_id,
                    'from_section' => $request->section_id,
                    'to_phase' => $request->phase_id_new,
                    'to_grade' => $request->grade_id_new,
                    'to_section' => $request->section_id_new,
                ]);
            }
            DB::commit();
            toastr()->success(trans('Promotion applied successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function create()
    {
        $Phases = Phase::all();
        return view('pages.Students.promotion.index', compact('Phases'));
    }
    public function destroy($request)
    {
        DB::beginTransaction();

        try {

            if ($request->page_id == 1) {

                $Promotions = Promotion::all();
                foreach ($Promotions as $Promotion) {

                    $ids = explode(',', $Promotion->student_id);
                    student::whereIn('id', $ids)
                        ->update([
                            'phase_id' => $Promotion->from_phase,
                            'grade_id' => $Promotion->from_grade,
                            'section_id' => $Promotion->from_section,
                        ]);
                }
                DB::commit();

                Promotion::truncate();
            } else {

                $Promotion = Promotion::findorfail($request->id);

                student::where('id', $Promotion->student_id)
                    ->update([
                        'phase_id' => $Promotion->from_phase,
                        'grade_id' => $Promotion->from_grade,
                        'section_id' => $Promotion->from_section,
                    ]);


                Promotion::destroy($request->id);
                DB::commit();
                toastr()->error(trans('Promotion applied successfully'));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}