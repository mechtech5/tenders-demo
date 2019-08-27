<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data['grades'] = Grade::all();
       return view('settings.grades.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.grades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$data = $request->validate([
	   			'grade_code'	=> 'required|string|max:2|unique:emp_grade_mast',
	   			'amount'	=> 'required',
	   			'description'	=> 'required',
	   		]);

    	$grade = new grade();
    	$grade->grade_code = $data['grade_code'];
    	$grade->comp_grp = 1;
    	$grade->entitled_amt = $data['amount'];
    	$grade->description = $data['description'];
    	$grade->save();
  	 $data['grades'] = Grade::all();
     return view('settings.grades.index',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['grade'] = Grade::where('grade_code',$id)->first();
        return view('settings/grades/edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $data = $request->validate([
   			'grade_code'	=> 'required|string|max:2|unique:emp_grade_mast,grade_code,'.$id.',grade_code',
   			'amount'	=> 'required',
   			'description'	=> 'required',
   		]);
      $grade = Grade::findOrFail($id);
      $grade->grade_code = $request->grade_code;
      $grade->entitled_amt = $request->amount;
      $grade->description = $request->description;
      $grade->save();
      $data['grades'] = Grade::all();
    	return redirect()->route('grades.index')->with('success','Designation Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($grade_code)
    {
    		Grade::where('grade_code',$grade_code)->delete();
       return redirect()->route('grades.index')->with('success','Designation Deleted Successfully!');
    }
}
