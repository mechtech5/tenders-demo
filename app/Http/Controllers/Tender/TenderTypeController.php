<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
use App\Models\Tenders\Tender;
use App\Models\Tenders\TenderType;
use Illuminate\Http\Request;

class TenderTypeController extends Controller
{
	public function index()
	{
		$data['tender_types'] = TenderType::all(); 
		return view('tender.type.index',$data);
	}

	public function create()
	{
		
		return view('tender.type.create');
	}

	public function store(Request $request)
	{
		$data   = $request->validate([
 			    'name'       	=> 'required|string|max:191',
 			    'description'	=> 'required',
 		]);	
 		TenderType::create($data);
  	return redirect()->route('tender_type.index')->with('success','Created Successfully.');
	}

	public function show()
	{
		return view('tender.type.show');
	}

	public function edit($id)
	{
	  $tender_type = TenderType::find($id);
	  return view('tender.type.edit',compact('tender_type'));
	}

	public function update(Request $request, $id)
	{
	 	$data = $request->validate([
 			'name'	=> 'required|string|max:191',
 			'description'	=> 'required',
 		]);

 		TenderType::where('id',$id)->update($data);
	 	
 		return redirect()->route('tender_type.index')->with('success','Updated Successfully.');
	}

	public function destroy($id)
	{
		 $tender_master = Tender::where('type_id',$id)->first();
		 if($tender_master){
		 	return redirect()->route('tender_type.index')->with('error','It is being used by Tender, Unable to delete!');
		 }
	 	$tender_type = TenderType::find($id);
  	$tender_type->delete();
  	return redirect()->route('tender_type.index')->with('success','Deleted Successfully.');
	}
}