<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
use App\Models\Tenders\Tender;
use App\Models\Tenders\TenderCategory;
use App\Models\Tenders\TenderType;
use Illuminate\Http\Request;
use App\Models\Tenders\TenderClient;
use App\Models\Tenders\TenderPrebid;

class TenderController extends Controller
{
	public function index()
	{
		$types      = TenderType::all();
		$categories = TenderCategory::all();
		$tenders    = Tender::with('category', 'type')->get();
		return view('tender.master.index', compact('tenders', 'types', 'categories'));
	}

	public function getForm(Request $request, $type)
	 {	 	
	 	$tender_id         = $request->tender_id; 
	 	$tender_types      = TenderType::all();
		$tender_categories = TenderCategory::all();
		$prebid            = TenderPrebid::where('tender_id',$tender_id)->get();
		$client            = TenderClient::where('tender_id',$tender_id)->get();
		$tender            = Tender::find($tender_id);
		$count             = count($client);

		if($count==0){
			$client->name ='';
			$client->email ='';
			$client->desig ='';
			$client->number ='';
			$client->id     ='';
			$client = array(0 => $client);
		}
		
	    return view('tender.master.forms.'.$type,compact('tender_types','tender_categories','tender_id','client','tender','prebid'));
	 }

	public function create()
	{
		$tender_types = TenderType::all();
		$tender_categories = TenderCategory::all();
		return view('tender.master.create',compact('tender_types','tender_categories'));
	}

	public function store(Request $request)
	{
		$data = $request->validate([
		 			'title'	=> 'required|string|max:255',
		 			'category_id'	=> 'required',
		 			'type_id'	=> 'required',
		 			'priority'	=> 'required'
		 		]);
 		$is_eligible = isset($request->is_eligible) ? $request->is_eligible : 0;
 		$tender               = new Tender();
 		$tender->title        = $data['title'];
 		$tender->account_code = 12345;
 		$tender->is_eligible  = $is_eligible;
 		$tender->category_id  = $data['category_id'];
 		$tender->type_id      = $data['type_id'];
 		$tender->priority     = $data['priority'];
 		$tender->tender_no    = mt_rand(00000000, 99999999);
 		$tender->save();
 		return redirect()->route('tender_master.index')->with('success','Created Successfully.');
	}

	public function show($id)
	{
		$tender = Tender::find($id);
		$tender_types = TenderType::all();
		$tender_categories = TenderCategory::all();
		return view('tender.master.show',compact('tender','tender_categories','tender_types','id'));
	}

	public function edit($id)
	{
		$tender_types = TenderType::all();
		$tender_categories = TenderCategory::all();
		$tender = Tender::find($id);
		return view('tender.master.edit',compact('tender','tender_types','tender_categories'));
	}

	public function update(Request $request,$id)
	{
		$data = $request->validate([
 			'title'	=> 'required|string|max:255',
 			'category_id'	=> 'required',
 			'type_id'	=> 'required',
 			'priority'	=> 'required'
 		]);
		$is_eligible = isset($request->is_eligible) ? $request->is_eligible : 0;
	 	$tender = Tender::find($id);
	    $tender->title = $data['title'];
	    $tender->is_eligible = $is_eligible;
	    $tender->category_id = $data['category_id'];
	    $tender->type_id = $data['type_id'];
	    $tender->priority = $data['priority'];
	    $tender->save();
 		return redirect()->route('tender_master.index')->with('success','Updated Successfully.');
	}

	public function destroy($id)
	{
		$tender = Tender::find($id);
    $tender->delete();
  	return redirect()->route('tender_master.index')->with('success','Deleted Successfully.');
	}

	public function save_details(Request $request)
	{			
		$form_type  = $request->form_type;
		$tender_id  = $request->tender_id;		
		if($form_type == 'details'){
		  	$data = array('title' =>$request->title,
		  				  'reference_no'=>$request->reference_no,
		  				  'publish_date'=>$request->publish_date,		  				  
		  				  'total_cost'=>$request->total_cost,
		  				  'document_cost'=>$request->document_cost,
		  				  'place'=>$request->place,
		  				  'departm'=>$request->departm,
		  				  'fill_company_office'=>$request->fill_company_office,
		  				  'descri'=>$request->descri);
		  	Tender::where('id',$tender_id)->update($data);

		  	$count = count($request->contact_name);	
		  	 if($count != 0){
		  	 	$x = 0;
		  	 	while($x < $count){
		  	 		if($request->contact_name[$x] !=''){
						 $client = array('name'     => $request->contact_name[$x],
						 				'email'     => $request->email[$x],
						 				'desig'     => $request->desig[$x],
						 				'number'    => $request->number[$x],
						 				'tender_id' => $tender_id );	
						if($request->update_id[$x] == ''){ 					  		
							TenderClient::create($client);							
						}
						else{
							TenderClient::where('id',$request->update_id[$x])->update($client);
						}
					}			  
		  	 		$x++;
		  	 	}
		  	 }
		  	return 'Tender Details Success Submited';  	 
		}

		if($form_type == 'data_subm'){
			$online_time = !empty($request->online_time)?$request->online_time:'12:00:00';
			$physical_time = !empty($request->physical_time)?$request->physical_time:'12:00:00';
			$technical_time = !empty($request->technical_time)?$request->technical_time:'12:00:00';
			$financial_time = !empty($request->online_time)?$request->financial_time:'12:00:00';

			$date_submi = array(
					'online_submission_date'    => $request->online_submission_date.' '.$online_time,
					'physical_submission_date'  => $request->physical_submission_date.' '.$physical_time,
					'technical_opening_date'    => $request->technical_opening_date.' '.$technical_time,
					'financial_opening_date'    => $request->financial_opening_date.' '.$financial_time);					
			Tender::where('id',$request->tender_id)->update($date_submi);

			return 'Tender Subnission Date Success Submited';  
		}

		if($form_type == 'prebid'){
			$prebid = array(
						'tender_id'=>$request->tender_id,
						'location' =>$request->location,
						'date'     =>$request->date,
						'remarks'  =>$request->remarks);
			if($request->location != '' ){
				TenderPrebid::create($prebid);
				$prebid = TenderPrebid::where('tender_id',$tender_id)->get();
				return view('tender.master.forms.prebid_table',compact('prebid'));
			}		

		}
	}

	public function delete_reco(Request $request){
		if($request->type == 'details_delete'){
			return 'details';
			$id = $request->id;
			$tender_id = $request->tender_id;
			TenderClient::where('id',$id)->delete();
			$tender = TenderClient::where('tender_id',$tender_id)->get();
			return count($tender);
		}
		if($request->type == 'delete_prebid'){
			return 'hello';
			// $id = $request->id;
			// $tender_id = $request->tender_id;
			// TenderClient::where('id',$id)->delete();
			// $tender = TenderClient::where('tender_id',$tender_id)->get();		
		}
	}

	public function update_meeting(Request $request){
		if($request->type == 'model'){
			$id   = $request->id;
			$data = TenderPrebid::find($id);
			return json_encode($data); 
		}
		if($request->type == 'save_data'){
			$tender_id = $request->tender_id;
			$update = array('location'=>$request->location,'date'=>$request->date,'remarks'=>$request->remarks);
			$save = TenderPrebid::where('id',$request->id)->update($update);
			$message = 'Successfully Updated';
			if($save){
				$prebid = TenderPrebid::where('tender_id',$tender_id)->get();
				return view('tender.master.forms.prebid_table',compact('prebid','message'));
			}
		}
	}
}