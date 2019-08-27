<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\EmployeeMast;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{

   	public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {		
  		$employees = EmployeeMast::all();
      return view('HRD.employees.index',compact('employees'));
    }
    public function export(){

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data['employee'] = EmployeeMast::findOrFail($id);
        return view('HRD.employees.edit',$data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $employee = EmployeeMast::find($id);
      $employee->delete();
			$employees = EmployeeMast::all();
      return view('HRD.employees.index',compact('employees'));
    }
}
