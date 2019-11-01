<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\DeptMast;
use App\Models\Employees\EmployeeMast;
use App\Models\Master\ActivityMast;
use App\Models\Master\ApprovalSetup;
use App\Models\Master\ApprovalAction;
use App\Models\Master\Designation;
use App\Models\Master\ApprovalMast;
use Requests;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$department = DeptMast::all();
        $employees = EmployeeMast::all();
        $department = DeptMast::all();
        $act = ActivityMast::all();
        $actions = ApprovalAction::all();*/
        //return $action;

        $approval_index = ApprovalMast::with('designation')->get();

        //dd($approval_index[0]->designation);


        return view('settings.permissions.index', compact('approval_index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::all();

        $approval = ApprovalMast::all();

        //dd($approval[0]);

        return view('settings.permissions.create', compact('designations', 'approval'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        for($i=1; $i<=count($request->all()) -1; $i++){
            $permission = new ApprovalMast;
            $permission->desg_id    = $request->desig[$i];
            $permission->approve    = $request->filled('approve.'.$i) ? 1 : 0;
            $permission->decline    = $request->filled('decline.'.$i) ? 1 : 0;
            $permission->priority   = $request->filled('priority.'.$i)? $request->priority[$i] : null;
            $permission->save();
        }

        return view('settings.permissions.index')->with('success', 'Updated successfully');

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
}
