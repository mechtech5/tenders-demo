<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employees\EmployeeMast;
use App\Models\Employees\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$employee = EmployeeMast::find(auth()->user()->emp_id);
      return  view('employee.leaves.index',compact('employee'));
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
        $data = request()->validate([
      'leave_type' => 'required|not_in:0',
      'count' => 'required',
      'generates_in'=> 'required',
      'max_apply_once'=> 'required',
      'min_apply_once'=> 'required',
      'max_days_month'=> 'required',
      'max_apply_month'=> 'required',
      'max_apply_year'=> 'required',
      'carry_forward'=> 'required',
    ]);
       LeaveType::create($data);
       return redirect('emp_leave')->with('status','Successfully Inserted..!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    public function apply_leaves($id){
    	return view('employee.leaves.apply');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function emp_leave()
    {
        $leave_type = DB::table('leave_type_mast')->get();
        return view('employee.leaves.emp_leave',compact('leave_type'));
    }
}
