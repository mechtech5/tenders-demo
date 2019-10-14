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
use App\Models\Master\DeptMast;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;
use App\Exports\EmployeesExport;
use App\Exports\ErrorEmployeeExport;

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
  	return redirect()->route('employees.index')->with('success','Employee Created successfully');
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
		return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'main'])->with('success','Updated successfully.');
  }

  public function save_academics(Request $request,$id){


    //return $request->all();
	  $vdata = request()->validate([
			'domain_of_study'    => 'max:90',
			'board_name'         => 'string|nullable|max:90',
			'year_of_completion' => 'string|nullable|max:4',
			'grade_or_percent'   => 'string|nullable|max:10',
		]);

    //Directory structure

    if($request->hasFile('file_path')){

      $dir      = 'hrms_uploads/'.date("Y").'/'.date("F");
      $file_ext = $request->file('file_path')->extension();
      $filename = $id.'_'.time().'_academic.'.$file_ext;
      $path     = $request->file('file_path')->storeAs($dir, $filename);
    }else{
      $path = null;
    }
		$employee = new EmpAcademic();
		$employee->emp_id = $id;
		$employee->domain_of_study    = $vdata['domain_of_study'];
		$employee->name_of_unversity  = $vdata['board_name'];
		$employee->completed_in_year  = $vdata['year_of_completion'];
		$employee->grade_or_pct       = $vdata['grade_or_percent'];
    $employee->file_path          = $path;
		$employee->note               = $request->special_note;
		$employee->save();

		return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'academics'])->with('success','Updated successfully.');
  }

  public function save_experience(Request $request,$id){

	  $vdata = request()->validate([
			'company_name' => 'required|max:100',
			'job_type'     => 'max:50',
			'designation'  => 'nullable|max:50',
			'comp_loc'     => 'nullable|max:50',
			'comp_email'   => 'email|nullable|max:100',
			'comp_website' => 'nullable|max:100',
			'monthly_ctc'  => 'nullable|max:11|regex:/^\d{0,6}(\.\d{1,2})?$/'
		]);

    if($request->hasFile('file_path')){

      $dir      = 'hrms_uploads/'.date("Y").'/'.date("F");
      $file_ext = $request->file('file_path')->extension();
      $filename = $id.'_'.time().'_experience.'.$file_ext;
      $path     = $request->file('file_path')->storeAs($dir, $filename);
    }else{
      $path = null;
    }

		$academic = new EmpExp();
		$academic->emp_id           = $id;
		$academic->comp_name        = $vdata['company_name'];
		$academic->job_type         = $vdata['job_type'];
		$academic->monthly_ctc      = $vdata['monthly_ctc'];
		$academic->desg             = $vdata['designation'];
		$academic->comp_loc         = $vdata['comp_loc'];
		$academic->comp_email       = $vdata['comp_email'];
		$academic->comp_website     = $vdata['comp_website'];
		$academic->start_dt         = $request->start_date;
		$academic->end_dt           = $request->end_date;
		$academic->reason_of_leaving= $request->reason_of_leaving;
    $academic->file_path        = $path;
		$academic->save();
		return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'experience'])->with('success','Updated successfully.');
  }

  public function save_official(Request $request,$id){

	  $vdata = request()->validate([
			'emp_code'  => 'string|max:15',
      'aadhar_no' => 'string|nullable|max:12',
      'pan_no'    => 'string|nullable|max:20',
      'voter_id'  => 'string|nullable|max:20',
      'old_pf'    => 'string|nullable|max:20',
      'new_pf'    => 'string|nullable|max:20',
      'driv_lic'  => 'string|nullable|max:20',
      'old_uan'   => 'string|nullable|max:20',
      'curr_uan'  => 'string|nullable|max:20',
      'old_esi'   => 'string|nullable|max:20',
      'curr_esi'  => 'string|nullable|max:20',
		]);

    $employee = EmployeeMast::findOrfail($id);
    $employee->emp_code   = $request->emp_code;
    $employee->parent_id  = $request->parent_id;
    $employee->emp_status = $request->emp_status;
    $employee->emp_type   = $request->emp_type;
    $employee->join_dt    = $request->join_date;
    $employee->leave_dt   = $request->leave_date;
    $employee->aadhar_no  = $request->aadhar_no;
    $employee->pan_no     = $request->pan_no;
    $employee->voter_id   = $request->voter_id;
    $employee->driv_lic   = $request->driv_lic;
    $employee->old_pf     = $request->old_pf;
    $employee->curr_pf    = $request->new_pf;
    $employee->old_uan    = $request->old_uan;
    $employee->curr_uan   = $request->curr_uan;
    $employee->old_esi    = $request->old_esi;
    $employee->curr_esi   = $request->curr_esi;
    $employee->comp_id    = $request->comp_id;
    $employee->dept_id    = $request->dept_id;
    $employee->grade_id   = $request->emp_grade;
    $employee->save();

    
		
		return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'official'])->with('success','Updated successfully.');
  }

  public function save_personal(Request $request,$id){
	  $vdata = request()->validate([
			'emp_title'      => 'required',
			'full_name'      => 'required|max:45',
			'contact_number' => 'digits_between:9,15',
			'alternate_contact_number' => 'digits_between:9,15',
			'email'          => 'nullable|email|max:50',
			'alternate_email'=> 'nullable|email|max:50',
		]);

    //Directory structure
    if($request->hasFile('file_path')){
      $dir      = 'hrms_uploads/'.date("Y").'/'.date("F");
      $file_ext = $request->file('file_path')->extension();
      $filename = $id.'_'.time().'_personal.'.$file_ext;
      $path     = $request->file('file_path')->storeAs($dir, $filename);
    }else{
      $path = 'emp_default_image.png';
    }

		$employee = EmployeeMast::findOrfail($id);
		$employee->emp_name   = $vdata['emp_title']." ".$vdata['full_name'];
		$employee->emp_gender = $request->emp_gender;
		$employee->emp_dob    = $request->emp_dob;
		$employee->blood_grp  = $request->blood_group;
		$employee->curr_addr  = $request->curr_addr;
		$employee->perm_addr  = $request->perm_addr;
		$employee->contact    = $vdata['contact_number'];
		$employee->alt_contact= $vdata['alternate_contact_number'];
		$employee->email      = $vdata['email'];
		$employee->alt_email  = $vdata['alternate_email'];
    $employee->driv_lic   = $request->drive_lic;
		$employee->save();
		return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'personal'])->with('success','Updated successfully.');
  }


  /*public function save_nominee(Request $request, $id)
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
*/
  public function save_documents(Request $request, $id)
  {
    $vdata = request()->validate([
      'doc_title' => 'required',
      'file_path' => 'required|max:5120',
      'doc_status'=> 'max:1',
      'remarks'   => 'string|nullable'
    ]);

    /*$var = EmployeeMast::findOrFail(1)->with('documents')->get();
    //return $var[0]['documents'][15]->doctypemast->name;
    return $var[0]['documents'][15];*/
    

    if($request->file('file_path')){
        $doc_title= DB::table('doc_type_mast')->where('id', $vdata['doc_title'])->first();
    		$dir      = 'hrms_uploads/'.date("Y").'/'.date("F");
    		$title    = str_replace(' ', '_', $doc_title->name);
    		$file_ext = $request->file('file_path')->extension();
    		$filename = $id.'_'.time().'_'.$title.'.'.$file_ext;
    		$path     = $request->file('file_path')->storeAs($dir, $filename);
    }else{
      $path = null;
    }

    $document = new EmpDocument;
    $document->emp_id       = $id;
    $document->doc_type_id  = $vdata['doc_title'];
    $document->file_path    = $path;
    $document->doc_status   = $vdata['doc_status'];
    $document->remark       = $request->remarks;
    $document->date         = date('Y-m-d', time());
    $document->save();
    return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'documents'])->with('success', 'Updated successfully.');
  }

  /*
    Toggle sections on employee detail page
  */
  public function show_page($id, $tab)
  {
  	$meta = array();
    $employee = EmployeeMast::findOrFail($id);
    $path     = "HRD.employees.details.".$tab;

    if($tab == 'official'){
    	$meta['emp_types']     = EmpType::all();
    	$meta['emp_statuses']  = EmpStatus::all();
      $meta['comp_mast']     = CompMast::all();
      $meta['dept_mast']     = DeptMast::all();
      $meta['grade_mast']    = Grade::all();
      $meta['emp_mast']      = EmployeeMast::all();

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
    $data['employee']     = EmployeeMast::with('company','designation')->findOrFail($id);
	  $data['parent_ids']   = EmployeeMast::where('comp_id',$data['employee']->comp_id)->where('id','!=',$data['employee']->id)->get();
	   $data['grades']      = Grade::all();
		$data['designations'] = Designation::all();

    return view('HRD.employees.edit',$data);
  }

  public function update(Request $request, $id)
  {	
  	$data =  $request->validate([
			'name'       => 'required|string|max:50',
 			'emp_code'   => 'required|string|max:15',
 			'emp_gender' => 'required',
 			'emp_dob'    => 'required',
 			'join_dt'    => 'required',
 			'emp_desg'   => 'required',
			],[
				'emp_dob.required'  => 'The Date of Birth is requred.',
				'join_dt.required'  => 'The Joining date is requred.',
				'emp_desg.required' => 'The Designation is requred.',
			]);
			$employee = EmployeeMast::findOrfail($id);
			$employee->emp_name   = $vdata['emp_title']." ".$vdata['full_name'];
			$employee->emp_gender = $request->emp_gender;
			$employee->emp_dob    = $request->emp_dob;
			$employee->blood_grp  = $request->blood_group;
			$employee->curr_addr  = $request->curr_addr;
			$employee->perm_addr  = $request->perm_addr;
			$employee->contact    = $vdata['Contact_number'];
			$employee->alt_contact= $vdata['alternate_contact_number'];
			$employee->email      = $vdata['email'];
			$employee->alt_email  = $vdata['alternate_email'];
			$employee->save();

			return redirect()->route('employee.show_page',['id'=>$id,'tab'=>'personal'])->with('success','Updated successfully.');
    }


    public function save_nominee(Request $request, $id){

      $vdata = request()->validate([
        'nominee_name'  => 'required',
        'email'         => 'nullable|email',
        'aadhaar_no'    => 'required|max:20',
        'contact'       => 'nullable|string',
        'relation'      => 'nullable',
      ]);

      $dir = 'hrms_uploads/'.date("Y").'/'.date("F");
      $file_ext = $request->file('file_path')->extension();
      $filename = $id.'_'.time().'_nominee.'.$file_ext;
      $path = $request->file('file_path')->storeAs($dir, $filename);

      $nominee = new EmpNominee;
      $nominee->emp_id    = $id;
      $nominee->name      = $vdata['nominee_name'];
      $nominee->email     = $vdata['email'];
      $nominee->aadhar_no = $vdata['aadhaar_no'];
      $nominee->contact   = $vdata['contact'];
      $nominee->addr      = $request->address;
      $nominee->file_path = $path;
      $nominee->relation  = $vdata['relation'];
      $nominee->save();

      return redirect()->route('employee.show_page', ['id' => $id, '  tab' => 'nominee'])->with('success', 'Updated successfully.');
    }


    public function save_bankdetails(Request $request, $id){

      //return $request->file('file_path');

      $vdata = request()->validate([
        'acc_holder'=> 'required',
        'acc_no'    => 'required',
        'bank_name' => 'required',
        'ifsc'      => 'required',
        'note'      => 'nullable|string'
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

      if($request->file('file_path')){
        $dir = 'hrms_uploads/'.date("Y").'/'.date("F");
        $file_ext = $request->file('file_path')->extension();
        $filename = $id.'_'.time().'_bank_detail.'.$file_ext;
        $path = $request->file('file_path')->storeAs($dir, $filename);
      }else{

        $path = null;
      }

      $bankdetails              = new EmpBankDetail;
      $bankdetails->emp_id      = $id;
      $bankdetails->acc_holder  = $vdata['acc_holder'];
      $bankdetails->acc_no      = $vdata['acc_no'];
      $bankdetails->bank_name   = $vdata['bank_name'];
      $bankdetails->ifsc        = $vdata['ifsc'];
      $bankdetails->branch_name = $request->branch;
      $bankdetails->file_path   = $path;
      $bankdetails->is_primary  = $is_primary;
      $bankdetails->note        = $vdata['note'];
      $bankdetails->save();

      return back()->with('success', 'Updated successfully.');
    }

    public function store(Request $request)
    {
        
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
    /*public function edit($id)
    {
       $data['employee'] = EmployeeMast::with('company','designation')->findOrFail($id);
  			$data['parent_ids'] = EmployeeMast::where('comp_id',$data['employee']->comp_id)->where('id','!=',$data['employee']->id)->get();
  			 $data['grades'] = Grade::all();
  			$data['designations'] = Designation::all();
        return view('HRD.employees.edit',$data);
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, $id)
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
*/
    public function fetch_designation(Request $request){
    		$designations = Designation::where('comp_id',$request->comp_id)->get();
    		return $designations;

    }


    public function delete_row($db_table, $id){

      if($db_table == 'emp_academics'){
        $academic = EmpAcademic::find($id);
        $academic->delete();
        Storage::delete($academic->file_path);
      }

      if($db_table == 'emp_exp'){
        $experience = EmpExp::find($id);
        $experience->delete();
        Storage::delete($experience->file_path);
      }
      if($db_table == 'emp_nominee'){
        $nominee = EmpNominee::find($id);
        $nominee->delete();
        Storage::delete($nominee->file_path);
      }
      if($db_table == 'emp_bank_details'){
        $bankdetails = EmpBankDetail::find($id);
        $bankdetails->delete();
        Storage::delete($bankdetails->file_path);
      }
      if($db_table == 'emp_docs'){

        $documents = EmpDocument::find($id);
        $documents->delete();
        Storage::delete($documents->file_path);
      }
      
      return back()->with('success','Status deleted successfully.');
    }

  //Employees Export

    public function export(){
      return Excel::download(new EmployeesExport, 'employee.xlsx');
      
    }


  //Employees Import

  public function import(Request $request){

    //return 68475;

    $this->validate($request, [
          'import' => 'required|mimes:xlsx,xls'
          ]);

    $records = Excel::toCollection(new EmployeesImport, $request->file('import'));

    $status = TRUE;
    $error  = [];

    foreach( $records as $record ){

      foreach( $record as $data ){


        if($status == TRUE){

          if($data['id'] == ''){

            $status = FALSE;

          }else{

            
            $status = TRUE;

          }

        }


        if($status == TRUE){

          if($data['parent_id'] == '' ){

            $status = TRUE;
            $data['parent_id'] = null;

          }else{
            $status = TRUE;

          }
        }

        if($status == TRUE){

          if($data['emp_code'] == ''){

            $status = TRUE;
            $data['emp_code'] = null;

          }else{

            $status = TRUE;

          }
        }

        if($status == TRUE){

          if($data['comp_id'] == ''){
            $status = TRUE;
            $data['comp_id'] = null;

          }else{

            $status = TRUE;

          }
        }

        if($status = TRUE){

          if($data['dept_id'] == ''){

            $status = TRUE;
            $data['dept_id'] = null;

          }else{

            $status = TRUE;

          }
        }

        if($status == TRUE){

          if($data['desg_id'] == ''){

            $status = FALSE;
          }else{

            $status = TRUE;
        
          }
        }

        if($status == TRUE){

          if($data['grade_id'] == ''){

            $status = TRUE;
            $data['grade_id'] = null;

          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['emp_name'] == ''){

            $status = FALSE;
            
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['emp_img'] == ''){

            $status = TRUE;
            $data['emp_img'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['emp_gender'] == ''){

            $status = TRUE;
            $data['emp_gender'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['emp_dob'] == ''){

            $status = TRUE;
            $data['emp_dob'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['curr_addr'] == ''){

            $status = TRUE;
            $data['curr_addr'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['perm_addr'] == ''){

            $status = TRUE;
            $data['perm_addr'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['blood_grp'] == ''){

            $status = TRUE;
            $data['blood_grp'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['contact'] == ''){

            $status = TRUE;
            $data['contact'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['alt_contact'] == ''){

            $status = TRUE;
            $data['alt_contact'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['email'] == ''){

            $status = TRUE;
            $data['email'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['alt_email'] == ''){

            $status = TRUE;
            $data['alt_email'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['driv_lic'] == ''){

            $status = TRUE;
            $data['driv_lic'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['aadhar_no'] == ''){

            $status = TRUE;
            $data['aadhar_no'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['voter_id'] == ''){

            $status = TRUE;
            $data['voter_id'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['pan_no'] == ''){

            $status = TRUE;
            $data['pan_no'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['emp_type'] == ''){

            $status = TRUE;
            $data['emp_type'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['emp_status'] == ''){

            $status = TRUE;
            $data['emp_status'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['old_uan'] == ''){

            $status = TRUE;
            $data['old_uan'] = null;
          }else{

            $status = TRUE;
          }
        }


        if($status == TRUE){

          if($data['curr_uan'] == ''){

            $status = TRUE;
            $data['curr_uan'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['old_pf'] == ''){

            $status = TRUE;
            $data['old_pf'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['curr_pf'] == ''){

            $status = TRUE;
            $data['curr_pf'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['old_esi'] == ''){

            $status = TRUE;
            $data['old_esi'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['curr_esi'] == ''){

            $status = TRUE;
            $data['curr_esi'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['join_dt'] == ''){

            $status = TRUE;
            $data['join_dt'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['leave_dt'] == ''){

            $status = TRUE;
            $data['leave_dt'] = null;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){

          if($data['active'] == ''){

            $status = TRUE;
            $data['active'] = 1;
          }else{

            $status = TRUE;
          }
        }

        if($status == TRUE){
          
         $data = $this->array_data($data);

         $emp = EmployeeMast::find($data['id']);

         if(!empty($emp)){

            EmployeeMast::where('id', $emp['id'])
              ->update($data);

         }else{
            EmployeeMast::create($data);
         }


        }else if($status == FALSE){
          
          $error[] = $this->array_data($data);
        
        }
       
        $status = TRUE;

      }
    }

    if(count($error) != 0){

      return Excel::download(new ErrorEmployeeExport($error), 'erroremployeeexport.xlsx');
    }

    return back()->with('success', 'Data imported successfully.');

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

  public function downloadDocs($db_table, $id){

    $docs = DB::table($db_table)
      ->where('id', $id)
      ->first();

    return Storage::download('/'.$docs->file_path);
  }
  public function exp_table(Request $request){
    $exp = DB::table('emp_exp')
                ->where('id', $request->exp_id)
                ->first();
   return view('HRD.employees.details.exp_table',compact('exp'));
    
  }


  public function array_data($data){
    return $data = [
                    'id'         => $data['id'],
                    'parent_id'  => $data['parent_id'],
                    'emp_code'   => $data['emp_code'],
                    'comp_id'    => $data['comp_id'],
                    'dept_id'    => $data['dept_id'],
                    'desg_id'    => $data['desg_id'],
                    'grade_id'   => $data['grade_id'],
                    'emp_name'   => $data['emp_name'],
                    'emp_img'    => $data['emp_img'],
                    'emp_gender' => $data['emp_gender'],
                    'emp_dob'    => $data['emp_dob'],
                    'curr_addr'  => $data['curr_addr'],
                    'perm_addr'  => $data['perm_addr'],
                    'blood_grp'  => $data['blood_grp'],
                    'contact'    => $data['contact'],
                    'alt_contact'=> $data['alt_contact'],
                    'email'      => $data['email'],
                    'alt_email'  => $data['alt_email'],
                    'driv_lic'   => $data['driv_lic'],
                    'aadhar_no'  => $data['aadhar_no'],
                    'voter_id'   => $data['voter_id'],
                    'pan_no'     => $data['pan_no'],
                    'emp_type'   => $data['emp_type'],
                    'emp_status' => $data['emp_status'],
                    'old_uan'    => $data['old_uan'],
                    'curr_uan'   => $data['curr_uan'],
                    'old_pf'     => $data['old_pf'],
                    'curr_pf'    => $data['curr_pf'],
                    'old_esi'    => $data['old_esi'],
                    'curr_esi'   => $data['curr_esi'],
                    'join_dt'    => $data['join_dt'],
                    'leave_dt'   => $data['leave_dt'],
                    'active'     => $data['active'],
                  ];
  }
}
