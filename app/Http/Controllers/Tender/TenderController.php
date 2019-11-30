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
use App\Models\Tenders\TenderOthersDate;
use App\Models\Tenders\Location;
use App\Models\Tenders\Responsible;
use App\Models\Tenders\EMD;
use App\Models\Tenders\TenderResponsibilites;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helpers;
use Session;
use File;

class TenderController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
		$types      = TenderType::all();
		$categories = TenderCategory::all();		
		$tenders    = Tender::with('category', 'type','category')->get();
		return view('tender.master.index', compact('tenders', 'types', 'categories'));
	}

	public function getForm(Request $request, $type)
	 {	 	
	 	$tender_id         = $request->tender_id; 
	 	$tender_types      = TenderType::all();
		$tender_categories = TenderCategory::all();
		$location          = Location::all();
		$responsi          = Responsible::all();
		$client            = TenderClient::where('tender_id',$tender_id)->get();
		$document          = TenderDocument::where('tender_id',$tender_id)->get();
		$tender            = Tender::with(['prebids','clients','corrigendums','documents','tenderOtherDate','emd','responsibl'])->where('id',$tender_id)->first();
		$other_date        = TenderOthersDate::where('tender_id',$tender_id)->get();
		if(count($other_date) == 0){
			$other_date->title = '';
			$other_date->date = '';
			$other_date->id = '';
			$other_date->tender_id =$tender_id;
			$other_date->time  = '';
		}
		
	    return view('tender.master.forms.'.$type,compact('tender_types','tender_id','tender','other_date','location','responsi'));
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
		 		'title'	        => 'required|string|max:255',
		 		'category_id'	=> 'required',
		 		'type_id'	    => 'required',
		 		'priority'	    => 'required'
		 	]);
		
 		$is_eligible = isset($request->is_eligible) ? $request->is_eligible : 0;
 		$trnder_num  = Helpers::getNumber(); 		
 		$tender               = new Tender();
 		$tender->title        = $data['title'];
 		$tender->account_code = 12345;
 		$tender->is_eligible  = $is_eligible;
 		$tender->category_id  = $data['category_id'];
 		$tender->type_id      = $data['type_id'];
 		$tender->priority     = $data['priority'];
 		$tender->tender_no    = $trnder_num;
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
			$count = count($request->time);
			$x = 0;
			while($count > $x){
				
				if($request->time[$x] != '' && $request->date[$x] != '' && $request->title[$x] != ''){

					$timeData = array('tender_id'=>$request->tender_id,'title'=>$request->title[$x],'date'=>$request->date[$x],'time'=>$request->time[$x]);
					if(!empty($request->update_id)){						
						if($x < count($request->update_id)){
							TenderOthersDate::where('id',$request->update_id[$x])->update($timeData);
						}
						else{
							TenderOthersDate::create($timeData);
						}
					}
					else{
						TenderOthersDate::create($timeData);
					}
				}		
				$x++;		
			}

			return 'Tender Subnission Date Successfully Submited';  
		}

		elseif($form_type == 'prebid'){
			$time   = !empty($request->time)?$request->time:'12:00:00';
			$prebid = array(
						'tender_id'=>$request->tender_id,
						'location' =>$request->location,
						'date'     =>$request->date.' '.$time,
						'minutes_of_meeting'=>$request->minutes_of_meeting,
						'remarks'  =>$request->remarks);
			if($request->location != '' ){
				TenderPrebid::create($prebid);
				$prebid = TenderPrebid::where('tender_id',$tender_id)->get();
				return view('tender.master.forms.prebid_table',compact('prebid'));
			}		

		}

		elseif($form_type == 'corrigendum'){
			$time  = !empty($request->time)?$request->time:'12:00:00';

			$tender_details = Tender::find($tender_id);

			if($request->hasFile('file')){		
		        $filename = $request->file('file')->getClientOriginalName();
		        $extension = $request->file('file')->getClientOriginalExtension();
		        $fileNameToStore = date('d-m-Y').'_'.$filename;

                $chk_path = storage_path('app/public/'.$tender_details->tender_no);	

	            if(!File::exists($chk_path)){	            	
	                File::makeDirectory($chk_path, 0777, true, true);
	            }

	            $path = $request->file('file')->storeAs('public/'.$tender_details->tender_no.'/Corrigendum/',$fileNameToStore);
	        }
	        else{
	        	$fileNameToStore = '';
	        }

			$corrigendum = array(
						'tender_id'=>$request->tender_id,
						'date'     =>$request->date.' '.$time,
						'file'     => $fileNameToStore,
						'changes'  =>$request->changes
					    );

			if($request->date != '' ){
				TenderCorrigendum::create($corrigendum);
				$corrigendum = TenderCorrigendum::where('tender_id',$request->tender_id)->get();
				$tender = $tender_details;
				return view('tender.master.forms.corrige_ref_table',compact('corrigendum','tender'));
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

		elseif($form_type == 'emd_form'){
			$tender_id = $request->tender_id;
			$update_id  =!empty($request->update_id)?$request->update_id:'';

		    $tender_details = Tender::find($tender_id);

		    $doc = array(
			   'tender_id'     => $request->tender_id,
	        	"tender_emd_ac" => $request->tender_emd_ac,
      			"tender_emd_type" =>$request->tender_emd_type,
	      		"tender_emd_bank_name" =>$request->tender_emd_bank_name,
	      		"tender_emd_amt" =>$request->tender_emd_amt,
	      		"tender_emd_creat_dt" => $request->tender_emd_creat_dt,
	      		"tender_emd_creat_place" => $request->tender_emd_creat_place,
	      		"tender_emd_renable_dt" => $request->tender_emd_renable_dt,
			    "tender_emd_exp_dt" => $request->tender_emd_exp_dt,
			    "tender_emd_sub_client" => $request->tender_emd_sub_client,
			    "tender_emd_sub_person" => $request->tender_emd_sub_person,
			    "tender_emd_sub_date" => $request->tender_emd_sub_date,
			    "tender_emd_sub_loc" => $request->tender_emd_sub_loc,
			    "tender_emd_sub_by" => $request->tender_emd_sub_by,
			    "tender_emd_sub_to" => $request->tender_emd_sub_to,
			    "tender_emd_return_date" => $request->tender_emd_return_date,
			    "tender_emd_return_furthe" => $request->tender_emd_return_furthe,
			    "tender_emd_return_recei" => $request->tender_emd_return_recei,
			    "tender_emd_return_depo_loc" => $request->tender_emd_return_depo_loc,
			    "tender_emd_clos_bnk" => $request->tender_emd_clos_bnk,
			    "tender_emd_clos_loc" => $request->tender_emd_clos_loc,
			    "tender_emd_clos_dt" => $request->tender_emd_clos_dt,
			    "tender_emd_clos_sbmt_by" => $request->tender_emd_clos_sbmt_by			   
			); 

			if($request->hasFile('tender_emd_return_receipt')){		

		        $filename = $request->file('tender_emd_return_receipt')->getClientOriginalName();
		        $extension = $request->file('tender_emd_return_receipt')->getClientOriginalExtension();
		        $fileNameToStore = date('d-m-Y').'_'.$filename;

                $chk_path = storage_path('app/public/'.$tender_details->tender_no);	

	            if(!File::exists($chk_path)){	            	
	                File::makeDirectory($chk_path, 0777, true, true);
	            }

	            $path = $request->file('tender_emd_return_receipt')->storeAs('public/'.$tender_details->tender_no.'/EMD/',$fileNameToStore);

	            $doc['tender_emd_return_receipt'] = $fileNameToStore;
	        }

	            if(empty($update_id)){			            	
	            	$save = EMD::create($doc);	
	            }
	            else{

	            	$u_data = EMD::find($update_id);

	            	if($request->hasFile('tender_emd_return_receipt')){
	            
	            		$filename = $request->file('tender_emd_return_receipt')->getClientOriginalName();
				        $extension = $request->file('tender_emd_return_receipt')->getClientOriginalExtension();
				        $fileNameToStore = date('d-m-Y').'_'.$filename;
	            		$path = $request->file('tender_emd_return_receipt')->storeAs('public/'.$tender_details->tender_no.'/EMD/',$fileNameToStore);

	            		$doc['tender_emd_return_receipt'] = $fileNameToStore;
	            		
	            		Storage::delete('/public/'.$tender_details->tender_no.'/EMD/'.$u_data->tender_emd_return_receipt);
	            	}
	            	else{
	            		$doc['tender_emd_return_receipt'] = $u_data->tender_emd_return_receipt;
	            	}
	            	$save = EMD::where('id',$update_id)->update($doc);		
	            }
	           	$message = 'Document Updated Successfully';
	            Session::put('message',$message);
	            return $message;
		}

		elseif($form_type == 'responsibilites'){
		    $data = array(
		    	'tender_id' =>$request->tender_id,
		    	'synopsis_id'=>$request->synopsis_id,
		    	'filling_id' =>$request->filling_id,
		    	'market_survey_id'=>$request->market_survey_id,
		    	'rate_analysis_id'=>$request->rate_analysis_id
		    	);			
		    if(!empty($request->update_id)){
		    	TenderResponsibilites::where('id',$request->update_id)->update($data);
		    		$message = 'Updated Successfully';
			}
			else{
				TenderResponsibilites::create($data);
				$message = 'Created Successfully';
			}		   
	        Session::put('message',$message);
	           return $message;	
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
			$tender = Tender::find($tender_id);
			TenderCorrigendum::where('id',$id)->delete();
			$corrigendum = TenderCorrigendum::where('tender_id',$tender_id)->get();
			return view('tender.master.forms.corrige_ref_table',compact('corrigendum','tender'));		
		}

		elseif($request->type == 'doc_delete'){
			$id = $request->id;
			$tender_id = $request->tender_id;
			TenderDocument::where('id',$id)->delete();
			$data = TenderDocument::where('tender_id',$tender_id)->get();
			return view('tender.master.forms.refresh_doc_table',compact('data'));		
		}

		elseif($request->type == 'imp_date'){
			$id = $request->id;
			$tender_id = $request->tender_id;
			TenderOthersDate::where('id',$id)->delete();
			$data = TenderOthersDate::where('tender_id',$tender_id)->get();
			
			return count($data);		
		}
	}

	public function update_meeting(Request $request){

		if($request->type == 'model'){
			$id   = $request->id;
			$data = TenderPrebid::find($id);
			$timestamp      = strtotime($data->date);
			$date = date('Y-n-j', $timestamp);
			$time = date('H:i:s', $timestamp);
			$data1=array('id'=>$data->id,'tender_id'=>$data->tender_id,'location'=>$data->location,'date'=>$date,'time'=>$time,'minutes_of_meeting'=>$data->minutes_of_meeting,'remarks'=>$data->remarks);
			return json_encode($data1); 
		}

		elseif($request->type == 'save_data'){
			$tender_id = $request->tender_id;
			$update = array('location'=>$request->location,'date'=>$request->date.' '.$request->time,'remarks'=>$request->remarks,'minutes_of_meeting'=>$request->minutes);
			$save = TenderPrebid::where('id',$request->id)->update($update);
			$message = 'Successfully Updated';
			if($save){
				$prebid = TenderPrebid::where('tender_id',$tender_id)->get();
				Session::put('message',$message); 
				return view('tender.master.forms.prebid_table',compact('prebid','message'));
			}
			else{
				$data = array('error'=>'error');
				return $data;
			}
		} 

		elseif($request->type == 'corrige_model'){
			$id   = $request->id;
			$data = TenderCorrigendum::find($id);
			$timestamp      = strtotime($data->date);
			$date = date('Y-n-j', $timestamp);
			$time = date('H:i:s', $timestamp);
			$udata = array('date'=>$date,'time'=>$time,'changes'=>$data->changes,'tender_id'=>$data->tender_id);
			
			return json_encode($udata); 
		}

		elseif($request->type == 'save_data_corrige'){
			$tender_id   = $request->tender_id;
			$tender_details = Tender::find($tender_id);
			$udate = TenderCorrigendum::where('id',$request->id)->first();

			$update = array(
						'tender_id'=>$request->tender_id,
						'date'     =>$request->date.' '.$request->time,						
						'changes'  =>$request->changes
					    );

			if($request->hasFile('file')){		

		        $filename = $request->file('file')->getClientOriginalName();
		        $extension = $request->file('file')->getClientOriginalExtension();
		        $fileNameToStore = date('d-m-Y').'_'.$filename;

                $chk_path = storage_path('app/public/'.$tender_details->tender_no);	

	            if(!File::exists($chk_path)){	            	
	                File::makeDirectory($chk_path, 0777, true, true);
	            }

	            $path = $request->file('tender_emd_return_receipt')->storeAs('public/'.$tender_details->tender_no.'/Corrigendum/',$fileNameToStore);

	            Storage::delete('app/public/'.$tender_details->tender_no.'/'.$udate->file);

	            $update['file'] = $fileNameToStore;
	        }
	        else{
	        	$udate = TenderCorrigendum::where('id',$request->id)->first();
	        	$update['file'] = $udate->file;
	        }			
			
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