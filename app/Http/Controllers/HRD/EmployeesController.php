<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\Employees\EmpAcademic;
use App\Models\Employees\EmpExp;
use App\Models\Employees\EmployeeMast;
use App\Models\Master\CompMast;
use App\Models\Master\Designation;
use App\Models\Master\EmpStatus;
use App\Models\Master\EmpType;
use App\Models\Master\Grade;
use Illuminate\Http\Request;
use App\Models\Employees\EmpDocument;
use App\Models\Master\DocTypeMast;
use Illuminate\Support\Facades\Storage;
use App\Models\Employees\EmpNominee;
use DB;
use App\Models\Employees\EmpBankDetail;


class EmployeesController extends Controller
{
 	public function __construct(){
    $this->middleware('auth');
  }

  public function index()
  {		
		$employees = EmployeeMast::with('company','grade','designation')->get();
    return view('HRD.employees.index',compact('employees'));
  }

  public function insert_employee(Request $request){
  	$employee = new EmployeeMast();
  	$employee->emp_name = $request->name; //emp ID will updated in users
  	$employee->save();
  	return redirect()->route('employees.index')->with('success','Employee Created Successfully');
  }

  public function save_main(Request $request,$id){
	  $vdata = request()->validate([
			'name' => 'required|max:50',
			'email' => 'required|email|max:50',
			'contact' => 'required|max:10',
		],[
			'contact.required' => 'The contact number field is required.',
			'contact.max' => 'The contact number may not be greater than 10 digits.',
		]);
		$employee = EmployeeMast::findOrfail($id);
		$employee->emp_name = $vdata['name'];
		$employee->email = $vdata['email'];
		$employee->contact = $vdata['contact'];
		$employee->save();
		return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'main'])->with('success','Updated Successfully.');
  }

  public function save_academics(Request $request,$id){
	  $vdata = request()->validate([
			'domain_of_study' => 'max:90',
			'board_name' => 'max:90',
			'year_of_completion' => 'max:4',
			'grade_or_percent' => 'max:10',
		]);
		$employee = new EmpAcademic();
		$employee->emp_id = $id;
		$employee->domain_of_study = $vdata['domain_of_study'];
		$employee->name_of_unversity = $vdata['board_name'];
		$employee->completed_in_year = $vdata['year_of_completion'];
		$employee->grade_or_pct = $vdata['grade_or_percent'];
		$employee->note = $request->note;
		$employee->save();
		return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'academics'])->with('success','Updated Successfully.');
  }

  public function save_experience(Request $request,$id){
	  $vdata = request()->validate([
			'company_name' => 'required|max:100',
			'job_type' => 'max:50',
			'designation' => 'max:50',
			'comp_loc' => 'max:50',
			'comp_email' => 'max:100',
			'comp_website' => 'required|max:100',
			'monthly_ctc' => 'max:11|regex:/^\d{0,6}(\.\d{1,2})?$/'
		]);
		$academic = new EmpExp();
		$academic->emp_id = $id;
		$academic->comp_name = $vdata['company_name'];
		$academic->job_type = $vdata['job_type'];
		$academic->monthly_ctc = $vdata['monthly_ctc'];
		$academic->desg = $vdata['designation'];
		$academic->comp_loc = $vdata['comp_loc'];
		$academic->comp_email = $vdata['comp_email'];
		$academic->comp_website = $vdata['comp_website'];
		$academic->start_dt = $request->start_date;
		$academic->end_dt = $request->end_date;
		$academic->reason_of_leaving = $request->reason_of_leaving;
		$academic->save();
		return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'experience'])->with('success','Updated Successfully.');
  }

  public function save_official(Request $request,$id){
	  $vdata = request()->validate([
			'emp_code' => 'max:15',
			'emp_status' => 'max:10',
			'emp_type' => 'max:10',
			'bank_acc_name' => 'max:50',
			'bank_acc_no' => 'max:50',
			'bank_ifsc' => 'max:50',
			'bank_branch' => 'max:50',
		],[
			'contact.required' => 'The contact number field is required.',
			'contact.max' => 'The contact number may not be greater than 10 digits.',
		]);
		
		return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'official'])->with('success','Updated Successfully.');
  }

  public function save_personal(Request $request,$id){
	  $vdata = request()->validate([
			'emp_title' => 'required',
			'full_name' => 'required|max:45',
			'Contact_number' => 'max:15',
			'alternate_contact_number' => 'max:15',
			'email' => 'nullable|email|max:50',
			'alternate_email' => 'nullable|email|max:50',
		]);
		$employee = EmployeeMast::findOrfail($id);
		$employee->emp_name = $vdata['emp_title']." ".$vdata['full_name'];
		$employee->emp_gender = $request->emp_gender;
		$employee->emp_dob = $request->emp_dob;
		$employee->blood_grp = $request->blood_group;
		$employee->curr_addr = $request->curr_addr;
		$employee->perm_addr = $request->perm_addr;
		$employee->contact = $vdata['Contact_number'];
		$employee->alt_contact = $vdata['alternate_contact_number'];
		$employee->email = $vdata['email'];
		$employee->alt_email = $vdata['alternate_email'];
		$employee->save();
		return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'personal'])->with('success','Updated Successfully.');
  }


  public function save_nominee(Request $request, $id)
  {
    $vdata = request()->validate([
      'nominee_name'  => 'required',
      'email'         => 'email',
      'adhar_no'      => 'required|digits:12',
      'contact'       => 'regex:/^[0-9]+$/',
      'relation'      => 'required',
    ]);

    $nominee = new EmpNominee;
    $nominee->emp_id    = $id;
    $nominee->name      = $vdata['nominee_name'];
    $nominee->email     = $vdata['email'];
    $nominee->aadhar_no = $vdata['adhar_no'];
    $nominee->contact   = $vdata['contact'];
    $nominee->addr      = $request->address;
    $nominee->file_path = $request->file_path;
    $nominee->relation  = $vdata['relation'];
    $nominee->save();

    return redirect()->route('employee.show_page', ['id' => $id, '  tab' => 'nominee'])->with('success', 'Updated Successfully.');
  }

  public function save_documents(Request $request, $id)
  {
    $vdata = request()->validate([
      'doc_title' => 'required',
      'file_path' => 'required|max:5120',
      'doc_status'=> 'required|max:1',
      'remarks'=> 'required|string'
    ]);
    $doc_title = DB::table('doc_type_mast')->where('id', $vdata['doc_title'])->first();
		$dir = 'hrms_uploads/'.date("Y").'/'.date("F");
		$title = str_replace(' ', '_', $doc_title->name);
		$file_ext = $request->file('file_path')->extension();
		$filename = $id.'_'.time().'_'.$title.'.'.$file_ext;
		$path = $request->file('file_path')->storeAs(
							$dir, $filename
						);
    $document = new EmpDocument;
    $document->emp_id       = $id;
    $document->doc_type_id  = $vdata['doc_title'];
    $document->file_path    = $path;
    $document->doc_status   = $vdata['doc_status'];
    $document->remarks      = $request->remarks;
    $document->save();
    return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'documents'])->with('success', 'Updated Successfully.');
  }

  /*
    Toggle sections on employee detail page
  */
  public function show_page($id, $tab)
  {
  	$meta = array();
    $employee = EmployeeMast::findOrFail($id);
    $path = "HRD.employees.details.".$tab;
    if($tab == 'official'){
    	$meta['emp_types'] = EmpType::all();
    	$meta['emp_statuses'] = EmpStatus::all();
    }

    if($tab == 'academics'){
    	$employee = EmployeeMast::with('academics')->where('id',$id)->first();
    }

    if($tab == 'experience'){
    	$employee = EmployeeMast::with('experiences')->where('id',$id)->first();
    }

    if($tab == 'documents'){
      $meta['doc_types'] = DocTypeMast::all();
      $employee = EmployeeMast::with('documents')->where('id',$id)->first();
    }

    if($tab == 'nominee'){

    $employee = EmployeeMast::with('nominee')->where('id',$id)->first();
    }

    return view($path,compact('employee','meta'));
  }

  public function edit($id)
  {
    $data['employee'] = EmployeeMast::with('company','designation')->findOrFail($id);
	  $data['parent_ids'] = EmployeeMast::where('comp_id',$data['employee']->comp_id)->where('id','!=',$data['employee']->id)->get();
	   $data['grades'] = Grade::all();
		$data['designations'] = Designation::all();
    return view('HRD.employees.edit',$data);
  }

  public function update(Request $request, $id)
  {	
  	$data =  $request->validate([
			'name'	=> 'required|string|max:50',
 			'emp_code'	=> 'required|string|max:15',
 			'emp_gender'	=> 'required',
 			'emp_dob'	=> 'required',
 			'join_dt'	=> 'required',
 			'emp_desg'	=> 'required',
			],[
				'emp_dob.required' => 'The Date of Birth is requred.',
				'join_dt.required' => 'The Joining date is requred.',
				'emp_desg.required' => 'The Designation is requred.',
			]);
			$employee = EmployeeMast::findOrfail($id);
			$employee->emp_name = $vdata['emp_title']." ".$vdata['full_name'];
			$employee->emp_gender = $request->emp_gender;
			$employee->emp_dob = $request->emp_dob;
			$employee->blood_grp = $request->blood_group;
			$employee->curr_addr = $request->curr_addr;
			$employee->perm_addr = $request->perm_addr;
			$employee->contact = $vdata['Contact_number'];
			$employee->alt_contact = $vdata['alternate_contact_number'];
			$employee->email = $vdata['email'];
			$employee->alt_email = $vdata['alternate_email'];
			$employee->save();
			return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'personal'])->with('success','Updated Successfully.');
    }


    public function save_nominee(Request $request, $id){

      $vdata = request()->validate([
        'nominee_name'  => 'required',
        'email'         => 'email',
        'aadhaar_no'      => 'required|digits:12',
        'contact'       => 'regex:/^[0-9]+$/',
        'relation'      => 'required',
      ]);


      $nominee = new EmpNominee;
      $nominee->emp_id    = $id;
      $nominee->name      = $vdata['nominee_name'];
      $nominee->email     = $vdata['email'];
      $nominee->aadhar_no = $vdata['aadhaar_no'];
      $nominee->contact   = $vdata['contact'];
      $nominee->addr      = $request->address;
      $nominee->file_path = $request->file_path;
      $nominee->relation  = $vdata['relation'];
      $nominee->save();

      return redirect()->route('employee.show_page', ['id' => $id, '  tab' => 'nominee'])->with('success', 'Updated Successfully.');
    }


    public function save_bankdetails(Request $request, $id){

      $vdata = request()->validate([
        'acc_holder'=> 'required',
        'acc_no' => 'required',
        'bank_name' => 'required',
        'ifsc' => 'required',
        'branch' => 'required',
        'note'  => 'required'
        ],
        [
          'acc_holder.required' => 'Account holder name is required.',
          'acc_no.required'     => 'Account no is required',
          'bank_name.required'  => 'Bank name is required',
          'ifsc.required'       => 'IFSC code is required',
          'branch.required'     => 'Branch name is required',
        ]);

      if(empty($request->is_primary)){

        $is_primary = 0;
      }

      $ext = $request->file('file_path')->getClientOriginalExtension();
      $emp_name = strtolower(str_replace(' ', '', EmployeeMast::find($id)->emp_name));
      $time = date('mdY:hi', time());
      $new_name = 'nominee_'.$time.'.'.$ext;

      $path = $request->file('file_path')->storeAs('public/hrm/employees/'.$emp_name.'_'.$id, $new_name);


      $bankdetails              = new EmpBankDetail;
      $bankdetails->emp_id      = $id;
      $bankdetails->acc_holder  = $vdata['acc_holder'];
      $bankdetails->acc_no      = $vdata['acc_no'];
      $bankdetails->bank_name   = $vdata['bank_name'];
      $bankdetails->ifsc        = $vdata['ifsc'];
      $bankdetails->branch_name = $vdata['branch'];
      $bankdetails->file_path   = $emp_name.'_'.$id.'/'.$new_name;
      $bankdetails->is_primary  = $is_primary;
      $bankdetails->note        = $vdata['note'];
      $bankdetails->save();

      return back()->with('success', 'Updated Successfully.');
    }

    public function save_documents(Request $request, $id){


      $vdata = request()->validate([
        'doc_title' => 'required',
        'file_path' => 'required|max:5120',
        'doc_status' => 'required'
      ], [

          'doc_title.required' => 'This field is required',
          'file_path.required' => 'This field is required',
          'doc_status.required'  => 'This field is reqiured'

      ]);


      $doc_name = strtolower(str_replace(' ', '', DocTypeMast::find($request->doc_title)->name));

      $doc_ext = $request->file('file_path')->getClientOriginalExtension();

      $emp_name = strtolower(str_replace(' ', '', EmployeeMast::find($id)->emp_name));
      $time = date('mdY:hi', time());


      $new_name = $doc_name.'_'.$time.'.'.$doc_ext;

      $path = $request->file('file_path')->storeAs('public/hrm/employees/'.$emp_name.'_'.$id, $new_name);

      $document = new EmpDocument;
      $document->emp_id       = $id;
      $document->doc_type_id  = $vdata['doc_title'];
      $document->file_path    = $emp_name."_".$id.'/'.$new_name;
      $document->doc_status   = $vdata['doc_status'];
      $document->remark       = $request->remark;
      $document->date         = date('Y-m-d', time());
      $document->save();

      return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'documents'])
            ->with('success', 'Updated Successfully.');

    }

    public function store(Request $request)
    {
        
    }

	  public function show_page($id,$tab)
	  {
	  	$meta = array();
	    $employee = EmployeeMast::findOrFail($id);
	    $path = "HRD.employees.details.".$tab;
	    if($tab == 'official'){
	    	$meta['emp_types'] = EmpType::all();
	    	$meta['emp_statuses'] = EmpStatus::all();
	    }

	    if($tab == 'academics'){
	    	$employee = EmployeeMast::with('academics')->where('id',$id)->first();
	    }

	    if($tab == 'experience'){
	    	$employee = EmployeeMast::with('experiences')->where('id',$id)->first();
	    }

      if($tab == 'documents'){
        $meta['doc_types'] = DocTypeMast::all();
        $employee = EmployeeMast::with('documents')->where('id',$id)->first();
      }

      if($tab == 'bankdetails'){
        $employee = EmployeeMast::with('bankdetails')->where('id',$id)->first();
      }

      if($tab == 'nominee'){

        $employee = EmployeeMast::with('nominee')->where('id',$id)->first();
      }

	    return view($path,compact('employee','meta'));
	  }

   public function getForm(Request $request, $type)
   {
   	$data['employee'] = EmployeeMast::findOrFail($request->emp_id);
    return view('HRD.employees.forms.'.$type,$data);
   }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data['employee'] = EmployeeMast::with('company','designation')->findOrFail($id);
  			$data['parent_ids'] = EmployeeMast::where('comp_id',$data['employee']->comp_id)->where('id','!=',$data['employee']->id)->get();
  			 $data['grades'] = Grade::all();
  			$data['designations'] = Designation::all();
        return view('HRD.employees.edit',$data);
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
    	$data =  $request->validate([
    						'name'	=> 'required|string|max:50',
				   			'emp_code'	=> 'required|string|max:15',
				   			'emp_gender'	=> 'required',
				   			'emp_dob'	=> 'required',
				   			'join_dt'	=> 'required',
				   			'emp_desg'	=> 'required',
	    					],[
	    						'emp_dob.required' => 'The Date of Birth is requred.',
	    						'join_dt.required' => 'The Joining date is requred.',
	    						'emp_desg.required' => 'The Designation is requred.',
	    					]);
    	 $employee = EmployeeMast::find($id);
       $employee->emp_name = trim($data['name']);
       $employee->emp_code = $data['emp_code'];
       $employee->emp_gender = $data['emp_gender'];
       $employee->grade_id = $request->grade_id;
       $employee->emp_dob = $data['emp_dob'];
       $employee->join_dt = $data['join_dt'];
       $employee->desg_id = $data['emp_desg'];
       $employee->parent_id = $request->parent_id;
       $employee->save();
	   	return redirect()->route('employees.index')->with('success','Employee details Updated Successfully');
    }

    public function fetch_designation(Request $request){
    		$designations = Designation::where('comp_id',$request->comp_id)->get();
    		return $designations;

    }

    
    public function delete_row($db_table, $id){

      if($db_table == 'emp_nominee'){
        $nominee = EmpNominee::find($id);
        $nominee->delete();
      }
      if($db_table == 'emp_bank_details'){
        $bankdetails = EmpBankDetail::find($id);
        $bankdetails->delete();
      }
      if($db_table == 'emp_docs'){

        $documents = EmpDocument::find($id);
        $documents->delete();
      }
      
      return back()->with('success','Status deleted successfully.');

    }


  public function destroy($id)
  {
    $employee = EmployeeMast::find($id);
    $employee->delete();
		$employees = EmployeeMast::all();
    return view('HRD.employees.index',compact('employees'));
  }

  public function deleteEmp_detail(Request $request, $id)
  {
    DB::table($request->db_table)->where('id', $id)->update(['deleted_at' => date('Y-m-d H:i:s',time())]);
    return redirect()->route('employee.show_page');    
  }
}
