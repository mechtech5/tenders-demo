<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Master\Grade;
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
	   			'name'	=> 'required|string|max:50|unique:emp_grade_mast',
	   			'amount'	=> 'required',
	   		]);
    	$grade = new grade();
    	$grade->name = $data['name'];
    	$grade->comp_id = 1;
    	$grade->entitled_amt = $data['amount'];
    	$grade->desc = $request->desc;
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
        $data['grade'] = Grade::where('id',$id)->first();
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
   			'name'	=> 'required|string|max:50|unique:emp_grade_mast,name,'.$id,
   			'amount'	=> 'required',
   		]);
      $grade = Grade::findOrFail($id);
      $grade->name = $request->name;
      $grade->entitled_amt = $request->amount;
      $grade->desc = $request->desc;
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
    public function destroy($id)
    {
    		Grade::where('id',$id)->delete();
       return redirect()->route('grades.index')->with('success','Designation Deleted Successfully!');
    }
}
