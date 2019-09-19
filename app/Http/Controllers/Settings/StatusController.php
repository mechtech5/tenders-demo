<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Master\EmpStatus;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
    	$statuses = EmpStatus::all();
      return view('settings.statuses.index',compact('statuses'));
    }
    public function create()
    {
       $statuses = EmpStatus::all();
       return view('settings.statuses.create',compact('statuses'));
    }
    public function store(Request $request)
    {
     	$data = $request->validate([
   			'name'	=> 'required|string|max:50'
   		]);
			$status  = new EmpStatus();
			$status->name = $data['name'];
			$status->desc = $request->description;
			$status->save();

    	return redirect()->route('statuses.index')->with('success','Status created successfully.');
    }
    public function show($id)
    {
        
    }
    public function edit($id)
    {
      $data['status'] = EmpStatus::find($id);
      return view('settings.statuses.edit',$data);
    }
    public function update(Request $request, $id)
    {
      $data = $request->validate([
   			'name'	=> 'required|string|max:50'
   		]);
			$status  = EmpStatus::find($id);
			$status->name = $data['name'];
			$status->desc = $request->description;
			$status->save();
    	return redirect()->route('statuses.index')->with('success','Status created successfully.');
    }
    public function destroy($id)
    {
       $status = EmpStatus::find($id);
       $status->delete();
       return redirect()->route('statuses.index')->with('success','Status deleted successfully.');
    }
}
