<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
use App\Models\Tenders\TenderStatus;
use Illuminate\Http\Request;

class TenderStatusController extends Controller
{
	public function index()
	{
		$tender_statuses  = TenderStatus::get();
		return view('tender.status.index',compact('tender_statuses'));
	}

	public function create()
	{
		return view('tender.status.create');
	}

	public function store(Request $request)
	{
		$data = $request->validate([
 			'name'	=> 'required|string|max:191',
 			'description'	=> 'required',
 		]);
 		$tender_status = new TenderStatus();
 		$tender_status->status_name  = $data['name'];
 		$tender_status->account_code  = 452;
 		$tender_status->status_desc  = $data['description'];
 		$tender_status->save();
  	return redirect()->route('tender_status.index')->with('success','Created Successfully.');
	}

	public function show()
	{
		return view('tender.status.show');
	}

	public function edit($id)
	{
		$tender_status = TenderStatus::find($id);
		return view('tender.status.edit',compact('tender_status'));
	}

	public function update(Request $request, $id)
	{
		 $data = $request->validate([
	   			'name'	=> 'required|string|max:191',
	   			'description'	=> 'required',
	   		]);

		 $tender_status = TenderStatus::find($id);
     $tender_status->status_name = $data['name'];
     $tender_status->status_desc = $data['description'];
     $tender_status->save();
 		return redirect()->route('tender_status.index')->with('success','Updated Successfully.');
	}

	public function destroy($id)
	{
		 $tender_status = TenderStatus::find($id);
      $tender_status->delete();
    	return redirect()->route('tender_status.index')->with('success','Deleted Successfully.');
	}
}