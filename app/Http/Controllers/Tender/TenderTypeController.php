<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
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

		$data = $request->validate([
 			'name'	=> 'required|string|max:191',
 			'description'	=> 'required',
 		]);
 		$tender_type = new TenderType();
 		$tender_type->type_name  = $data['name'];
 		$tender_type->type_desc  = $data['description'];
 		$tender_type->save();
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

	 	$tender_type = TenderType::findOrFail($id);
   	$tender_type->type_name = $data['name'];
   	$tender_type->type_desc = $data['description'];
   	$tender_type->save();
   	
 		return redirect()->route('tender_type.index')->with('success','Updated Successfully.');
	}

	public function destroy($id)
	{
	 	$tender_type = TenderType::find($id);
  	$tender_type->delete();
  	return redirect()->route('tender_type.index')->with('success','Deleted Successfully.');
	}
}