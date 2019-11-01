<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employees\EmployeeMast;
use App\Models\Master\LeaveTypeMast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Employees\EmpLeave;
use App\Models\Master\LeaveMast;
use App\Models\Employees\LeaveApply;
use App\Models\Master\ApprovalAction;
use App\Models\Master\Designation;


class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$appr_sys = ApprovalSetup::where('emp_id', Auth::id())->first();
        $action = ApprovalAction::all();

        $employee = EmployeeMast::with(['leaveapplies'])->where('id', Auth::id())->first();

        return view('employee.leaves.index', compact('employee', 'action'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $depart = EmployeeMast::where('id', Auth::id())
                        ->select('dept_id')
                        ->first();

        $dept_name = EmployeeMast::where('dept_id', $depart->department->id)
                        ->get();
        $leave_type = LeaveTypeMast::all();

        return view('employee.leaves.create', compact('leave_type', 'dept_name'));
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
          'leave_type_id'   => 'required',
          'teamlead'        => 'required'
        ]);

        $id = Auth::id();

        //Uploading documents to hrmsupload directory

        if($request->hasFile('file_path')){

          $dir      = 'hrms_uploads/'.date("Y").'/'.date("F");
          $file_ext = $request->file('file_path')->extension();
          $filename = $id.'_'.time().'_leaves.'.$file_ext;
          $path     = $request->file('file_path')->storeAs($dir, $filename);

        }else{

          $path = null;

        }

        $leaveapply = new LeaveApply;
        $leaveapply->emp_id            = $id;
        $leaveapply->teamlead_id       = $data['teamlead'];
        $leaveapply->leave_type        = $data['leave_type_id'];
        $leaveapply->from              = $request->start_date;
        $leaveapply->to                = $request->end_date;
        $leaveapply->count             = 2;
        $leaveapply->reason            = $request->reason;
        $leaveapply->file_path         = $path;
        $leaveapply->addr_during_leave = $request->address_leave;
        $leaveapply->contact_no        = $request->contact_no;
        $leaveapply->status            = 'Pending';
        $leaveapply->applicant_remark  = $request->applicant_remark;
        $leaveapply->approver_remark   = null;
        $leaveapply->hr_remark         = null;
        $leaveapply->save();

       return back()->with('success','Successfully applied.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('employee.leaves.show');
    }

    public function apply_leaves($id){

    	return view('employee.leaves.apply');

    }

    public function applyform(){

        $leave_type = LeaveTypeMast::all();
        return $leave_type;

        return view('employee.leaves.create');
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
        

    }

    public function showindex(){

        $leaves = LeaveApply::findOrFail(Auth::id());
        return view('employee.leaves.index', compact('leaves'));
    }

    public function emp_leave()
    {
        $leave_type = DB::table('leave_type_mast')->get();
        return view('employee.leaves.leave',compact('leave_type'));
    }
}
