<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
use App\Models\Tenders\Tender;
use App\Models\Tenders\TenderCategory;
use App\Models\Tenders\TenderType;
use Illuminate\Http\Request;
use App\Models\Tenders\TenderClient;
use App\Models\Tenders\TenderPrebid;
use App\Models\Tenders\TenderCorrigendum;
use App\Models\Tenders\TenderDocument;
use Illuminate\Support\Facades\Storage;
use Session;
use File;

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
		$corrigendum       = TenderCorrigendum::where('tender_id',$tender_id)->get();
		$document          = TenderDocument::where('tender_id',$tender_id)->get();
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
		
	    return view('tender.master.forms.'.$type,compact('tender_types','tender_categories','tender_id','client','tender','prebid','corrigendum','document'));
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

		elseif($form_type == 'data_subm'){
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

			return 'Tender Subnission Date Successfully Submited';  
		}

		elseif($form_type == 'prebid'){
			$time   = !empty($request->time)?$request->time:'12:00:00';
			$prebid = array(
						'tender_id'=>$request->tender_id,
						'location' =>$request->location,
						'date'     =>$request->date.' '.$time,
						'remarks'  =>$request->remarks);
			if($request->location != '' ){
				TenderPrebid::create($prebid);
				$prebid = TenderPrebid::where('tender_id',$tender_id)->get();
				return view('tender.master.forms.prebid_table',compact('prebid'));
			}		

		}

		elseif($form_type == 'corrigendum'){

			$time  = !empty($request->time)?$request->time:'12:00:00';

			$corrigendum = array(
						'tender_id'=>$request->tender_id,
						'date'     =>$request->date.' '.$time,
						'changes'  =>$request->changes);

			if($request->date != '' ){
				TenderCorrigendum::create($corrigendum);
				$corrigendum = TenderCorrigendum::where('tender_id',$request->tender_id)->get();

				return view('tender.master.forms.corrige_ref_table',compact('corrigendum'));
			}		
		}

		elseif($form_type == 'qualification'){
			$qualification = array('allotment_status'=>$request->status);
			$tender_id     = $request->tender_id;
		
			if($request->status != '' ){
				Tender::where('id',$tender_id)->update($qualification);	
							
				return 'Allotment Status Successfully Updated';
			}	
		}

		elseif($form_type == 'doc'){
			
			$tender_id = $request->tender_id;
		    $tender_details = Tender::find($tender_id);			   
			
			if($request->hasFile('file')){		
		        $filename = $request->file('file')->getClientOriginalName();
		        $extension = $request->file('file')->getClientOriginalExtension();
		        $fileNameToStore = date('d-m-Y').'_'.$filename;

                $chk_path = storage_path('app/public/'.$tender_details->tender_no);	

	            if(! File::exists($chk_path)){
	                File::makeDirectory($chk_path, 0777, true, true);
	            }

	            $path = $request->file('file')->storeAs('public/'.$tender_details->tender_no,$fileNameToStore);		           

	            $doc = array('doc_title'=>$request->doc_title,'file'=>$fileNameToStore,'note'=>$request->note,'tender_id'=>$request->tender_id);			
	            $save = TenderDocument::create($doc);	
	           	$data    = TenderDocument::where('tender_id',$tender_id)->get();
	           	$message = 'Document Updated Successfully';
	            Session::put('message',$message);
	            return view('tender.master.forms.refresh_doc_table',compact('data'));
	        }
		}
	}

	public function delete_reco(Request $request){
		if($request->type == 'details_delete'){			
			$id = $request->id;
			$tender_id = $request->tender_id;
			TenderClient::where('id',$id)->delete();
			$tender = TenderClient::where('tender_id',$tender_id)->get();
			return count($tender);
		}
		elseif($request->type == 'prebid_delete'){

			$id = $request->id;
			$tender_id = $request->tender_id;
			TenderPrebid::where('id',$id)->delete();
			$prebid = TenderPrebid::where('tender_id',$tender_id)->get();
			return view('tender.master.forms.prebid_table',compact('prebid'));		
		}

		elseif($request->type == 'corrige_delete'){
			$id = $request->id;
			$tender_id = $request->tender_id;
			TenderCorrigendum::where('id',$id)->delete();
			$corrigendum = TenderCorrigendum::where('tender_id',$tender_id)->get();
			return view('tender.master.forms.corrige_ref_table',compact('corrigendum'));		
		}

		elseif($request->type == 'doc_delete'){
			$id = $request->id;
			$tender_id = $request->tender_id;
			TenderDocument::where('id',$id)->delete();
			$data = TenderDocument::where('tender_id',$tender_id)->get();
			return view('tender.master.forms.refresh_doc_table',compact('data'));		
		}
	}

	public function update_meeting(Request $request){

		if($request->type == 'model'){
			$id   = $request->id;
			$data = TenderPrebid::find($id);
			return json_encode($data); 
		}

		elseif($request->type == 'save_data'){
			$tender_id = $request->tender_id;
			$update = array('location'=>$request->location,'date'=>$request->date,'remarks'=>$request->remarks);
			$save = TenderPrebid::where('id',$request->id)->update($update);
			$message = 'Successfully Updated';
			if($save){
				$prebid = TenderPrebid::where('tender_id',$tender_id)->get();
				Session::put('message',$message); 
				return view('tender.master.forms.prebid_table',compact('prebid','message'));
			}
		} 

		elseif($request->type == 'corrige_model'){
			$id   = $request->id;
			$data = TenderCorrigendum::find($id);
			return json_encode($data); 
		}

		elseif($request->type == 'save_data_corrige'){
			$tender_id   = $request->tender_id;
			$update      = array('date'=>$request->date,'changes'=>$request->changes);
			$corrigendum = TenderCorrigendum::where('id',$request->id)->update($update);
			$message     = 'Successfully Updated';
			if($corrigendum){
				$corrigendum = TenderCorrigendum::where('tender_id',$tender_id)->get();
				Session::put('message',$message); 
				return view('tender.master.forms.corrige_ref_table',compact('corrigendum'));
			}
		} 

		elseif($request->type == 'doc_model'){
			$id   = $request->id;
			$data = TenderDocument::find($request->id);
			return json_encode($data);		
		}

		elseif($request->type == 'update_doc'){
			$tender_id      = $request->tender_id;
		    $tender_doc     = TenderDocument::find($request->u_id);				      
		    $tender_details = Tender::find($tender_doc->tender_id);
			
			if($request->hasFile('file')){	

		        $filename = $request->file('file')->getClientOriginalName();
		        $extension = $request->file('file')->getClientOriginalExtension();
		        $fileNameToStore = date('d-m-Y').'_'.$filename;

                $chk_path = storage_path('app/public/'.$tender_details->tender_no);	

	            if(! File::exists($chk_path)){
	                File::makeDirectory($chk_path, 0777, true, true);
	            }

	            $path = $request->file('file')->storeAs('public/'.$tender_details->tender_no.'/',$fileNameToStore);		           

	            $doc = array('doc_title'=>$request->doc_title,'file'=>$fileNameToStore,'note'=>$request->note,'tender_id'=>$request->tender_id);			
	            $save = TenderDocument::where('id',$request->u_id)->update($doc);	

	            if($request->file('file')){
	            	
	           		Storage::delete('app/public/'.$tender_details->tender_no.'/'.$tender_details->file);
       			}

	           	$data    = TenderDocument::where('tender_id',$tender_id)->get();
	           	$message = 'Document Updated Successfully';
	            Session::put('message',$message);
	            return view('tender.master.forms.refresh_doc_table',compact('data'));
			}
			else{
				$doc = array('doc_title'=>$request->doc_title,'note'=>$request->note,'tender_id'=>$request->tender_id);			
	            $save = TenderDocument::where('id',$request->u_id)->update($doc);
	            if($save){
	              	$data = TenderDocument::where('tender_id',$tender_id)->get();
	              	return view('tender.master.forms.refresh_doc_table',compact('data'));
	            }
			}
		}
	}
}