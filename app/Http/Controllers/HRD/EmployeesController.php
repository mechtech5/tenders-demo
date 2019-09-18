<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\Master\CompMast;
use App\Models\Master\Designation;
use App\Models\Employees\EmployeeMast;
use App\Models\Master\Grade;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{

   	public function __construct(){
        $this->middleware('auth');
    }
    public function inactiveEmployees()
    {		
  		$employees = EmployeeMast::with('company','grade','designation')->where('active',"!=",1)->get();
      return view('HRD.employees.index',compact('employees'));
    }
    public function index()
    {		
  		$employees = EmployeeMast::with('company','grade','designation')->where('active',1)->get();
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
        
    }

    public function insert_employee(Request $request){
    	$employee = new EmployeeMast();
    	$employee->emp_name = $request->name;
    	$employee->login_user = $request->id;
    	$employee->save();
    	return redirect()->route('employees.index')->with('success','Employee Created Successfully');
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
      $employee = EmployeeMast::findOrFail($id);
      return view('HRD.employees.show',compact('employee'));
    }

   public function getForm(Request $request, $type)
   {
   	$data['employee'] = EmployeeMast::findOrFail($request->emp_id);
    return view('HRD.employees.forms.'.$type,$data);
   }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data['employee'] = EmployeeMast::with('company','designation')->findOrFail($id);
  			$data['parent_ids'] = EmployeeMast::where('comp_id',$data['employee']->comp_id)->where('id','!=',$data['employee']->id)->get();
  			 $data['grades'] = Grade::all();
  			$data['designations'] = Designation::all();
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
    	$data =  $request->validate([
    						'name'	=> 'required|string|max:50',
				   			'emp_code'	=> 'required|string|max:15',
				   			'emp_gender'	=> 'required',
				   			'emp_dob'	=> 'required',
				   			'join_dt'	=> 'required',
				   			'emp_desg'	=> 'required',
	    					],[
	    						'emp_dob.required' => 'The Date of Birth is requred.',
	    						'join_dt.required' => 'The Joining date is requred.',
	    						'emp_desg.required' => 'The Designation is requred.',
	    					]);
    	 $employee = EmployeeMast::find($id);
       $employee->emp_name = trim($data['name']);
       $employee->emp_code = $data['emp_code'];
       $employee->emp_gender = $data['emp_gender'];
       $employee->grade_id = $request->grade_id;
       $employee->emp_dob = $data['emp_dob'];
       $employee->join_dt = $data['join_dt'];
       $employee->desg_id = $data['emp_desg'];
       $employee->parent_id = $request->parent_id;
       $employee->active = $request->active;
       $employee->save();
	   	return redirect()->route('employees.index')->with('success','Employee details Updated Successfully');
    }

    public function fetch_designation(Request $request){
    		$designations = Designation::where('comp_id',$request->comp_id)->get();
    		return $designations;

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
