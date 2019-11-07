<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
use App\Models\Tenders\Tender;
use App\Models\Tenders\TenderCategory;
use App\Models\Tenders\TenderType;
use Illuminate\Http\Request;

class TenderCategoryController extends Controller
{
	public function index()
	{
		$tender_categories  = TenderCategory::all();
		return view('tender.category.index',compact('tender_categories'));
	}

	public function create()
	{
		return view('tender.category.create');
	}

	public function store(Request $request)
	{
		$data = $request->validate([
 			'name'	=> 'required|string|max:191',
 			'description'	=> 'required',
 		]);
		$data['account_code'] = 10001;
 		TenderCategory::create($data);
 		return redirect()->route('tender_category.index')->with('success','Created Successfully.');
	}

	public function show()
	{
		return view('tender.category.show');
	}

	public function edit($id)
	{
		$tender_category = TenderCategory::find($id);
		return view('tender.category.edit',compact('tender_category'));
	}

	public function update(Request $request, $id)
	{
		 $data = $request->validate([
	   			'name'	=> 'required|string|max:191',
	   			'description'	=> 'required',
	   		]);

		TenderCategory::where('id',$id)->update($data);    
 		return redirect()->route('tender_category.index')->with('success','Updated Successfully.');
	}

	public function destroy($id)
	{
		 $tender_master = Tender::where('category_id',$id)->first();
		 if($tender_master){
		 	return redirect()->route('tender_category.index')->with('error','It is being used by Tender, Unable to delete!');
		 }
			$tender_category = TenderCategory::find($id);
	    $tender_category->delete();
	  	return redirect()->route('tender_category.index')->with('success','Deleted Successfully.');
	}
}