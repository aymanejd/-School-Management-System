<?php 

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Phase;

use Illuminate\Http\Request;

class PhaseController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {$grades=Phase::all();
    return view('pages.Phases.phase',compact('grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $formfields=$request->validate([
      'Name'=>'required|unique:phases|between:10,30'

    ]);
    Phase::create($formfields);
      toastr()->success('Phase has been created successfully!');

    return to_route('phase.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update( Request $request,$id)
  { $formfields=$request->validate([
    'Name'=>'required|between:10,30'
  ]);
  Phase::findOrFail($id)->update($formfields);
    toastr()->success('Phase updated successfully!');

    return to_route('phase.index');

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy( Request $request, $id)
  { $grade=Grade::where('phase_id',$id)->pluck('phase_id');
    if($grade->count()==0){
      Phase::find($id)->delete();
      toastr()->success('Phase deleted successfully!');
      return to_route('phase.index');
    }
    else{
      toastr()->warning('Pahse cannot be deleted because it has dependent grade ');
      return to_route('phase.index');

    }

  }
  
}

?>