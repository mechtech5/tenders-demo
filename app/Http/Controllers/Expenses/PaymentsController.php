<?php

namespace App\Http\Controllers\Expenses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePayments;
use App\Exports\PaymentsExport;
use App\Exports\ErrorPaymentExport;
use App\Imports\PaymentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use DB;
use App\Models\CompMast;
use App\Models\Vendor;
use App\Models\ExpenseMode;    
use App\Models\AccountMast;    
use App\Models\ExpenseCategory;    
use App\Models\ExpenseInUser;    
use App\Models\ExpensePermitUser;    
use App\Models\EmployeeMast;    
use App\Models\Payment;    
use PhpOffice\PhpSpreadsheet\Shared\Date;
class PaymentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $payments = Payment::with('account','company','expense_in_user','expense_permit_user','expense_mode','vendor')->with(['expense_category' => function($query){
            $query->where('enabled',1);
        }])->get();

        // return $payments;
        return view('expenses.payments.index',compact('payments'));
    }

   
    public function create()
    {
        $vendors = Vendor::all();
        $companies = CompMast::all();
        $accounts = AccountMast::all();

        $exp_mode = ExpenseMode::all();

        $exp_catg = ExpenseCategory::all();

        $exp_in_users = ExpenseInUser::join('emp_mast','emp_mast.emp_id','exp_in_user.emp_id')->get();

        $exp_permit_users = ExpensePermitUser::join('emp_mast','emp_mast.emp_id','exp_permit_user.emp_id')->get();

        return view('expenses.payments.create',compact('vendors','companies','accounts','exp_mode','exp_catg','exp_in_users','exp_permit_users'));
    }

    
    public function store(StorePayments $request)
    {
       
        $data = $request->validated();
        if($data['paid_at'] == '')
        {
            $data['paid_at'] = date('Y-m-d');
        }

        Payment::create($data);
        return redirect()->route('payments.index')->with('success','Payments inserted successfully');
    }

    
    public function show($id)
    {
        $payment = Payment::with('account','company','expense_in_user','expense_permit_user','expense_category','expense_mode','vendor')->where('id',$id)->first();
        // return $payment;
       return view('expenses.payments.show',compact('payment'));
    }

   
    public function edit($id)
    {
        $payment = Payment::find($id);
        $vendors = Vendor::all();
        $companies = CompMast::all();
        $accounts = AccountMast::all();
        $exp_mode = ExpenseMode::all();
        $exp_catg = ExpenseCategory::all();
        
        $exp_in_users = ExpenseInUser::join('emp_mast','emp_mast.emp_id','exp_in_user.emp_id')->get();

        $exp_permit_users = ExpensePermitUser::join('emp_mast','emp_mast.emp_id','exp_permit_user.emp_id')->get();

        return view('expenses.payments.edit',compact('vendors','companies','accounts','exp_mode','exp_catg','exp_in_users','exp_permit_users','payment'));
        
    }

  
    public function update(StorePayments $request, $id)
    {
        $data = $request->validated();
        Payment::where('id',$id)->update($data);

       return redirect()->route('payments.index')->with('success','Payments updated successfully');
    }

   
    public function destroy($id)
    {
        Payment::where('id',$id)->delete();
         return redirect()->back()->with('success','Payments deleted successfully');
    }
    public function account_mast(Request $request){
       
        $accounts = AccountMast::where('comp_code',$request->comp_code)->get();
        return $accounts;
    }
    public function vendor_mast(Request $request){
        $vendors = Vendor::where('comp_code',$request->comp_code)->get();
        return $vendors;
    }
    public function export(){
         return Excel::download(new PaymentsExport, 'demo.xlsx');
    }
    public function import(Request $request){
        $this->validate($request,[
                'file' => 'required|mimes:xls,xlsx',
        ]);


         $datas = Excel::toCollection(new PaymentsImport,$request->file('file'));
     
        $status = TRUE;
        $error =array();


        foreach ($datas as $data) {
            foreach ($data as $row) {
                 //Company Validation

            if($status == TRUE){
                if($row['company_name'] == ''){

                    $status = FALSE; 

                }
                else{
                    $company = CompMast::where('comp_name',$row['company_name'])->first();
                    if(!empty($company)){
                        $status =TRUE;
                    }
                    else{
                        
                        $status = FALSE; 
                    }
                }
                
            }

           //Company account check      
              if($status == TRUE){
                if($row['account_name'] == ''){
                   $account_id = null;
                   $status == TRUE;   
                  
                }
                else{
                    $account = AccountMast::where('name',$row['account_name'])->first();
                    if(!empty($account)){                                            
                        if($account->comp_code == $comp_code = $company->comp_code){
                            $status = TRUE;
                            $account_id = $account->id;
                        }
                        else{  
                                                     
                            $status = FALSE;
                        }
                    }
                    else{
                       
                        
                        $status = FALSE;
                    }
                   
                }

              }

              // Date check 
              if($status == TRUE){
                if($row['date'] == ''){
                    $status = TRUE;
                    $date = date('Y-m-d');
                }
                else{
                    
                     $date = date('Y-m-d',strtotime($row['date']));
                     // dd($date);   
                     $status = TRUE;                 
                }
              }

            //Amount check
              if($status == TRUE){
                if($row['amount'] == ''){
                    $status = FALSE;
                }
                else{
                    if(is_numeric($row['amount'])) {
                        $status = TRUE;
                        $amount = $row['amount'];
                    }
                    else{
                        $status = FALSE;
                    }                 
                   
                }
              }

            //vendor Check
              if($status == TRUE){
                if($row['vendor_name'] == '')
                {
                    $vendor_id = null;
                    $status = TRUE;
                }
                else{
                    $vendor = Vendor::where('name','LIKE', '%'.$row['vendor_name']. '%')->first();
                    if(!empty($vendor)){
                        if($vendor->comp_code == $company->comp_code){
                            $vendor_id = $vendor->id;
                            $status = TRUE; 
                        }
                        else{

                            $status =FALSE;
                        }
                    }
                    else{
                       $status = FALSE;                     
                    }                    
                }
              }

              // Narration check
              if($status == TRUE){
                if($row['narration'] == ''){
                    $status = FALSE;
                }
                else{
                    $status =TRUE;
                }
              }

            //expense_in_user check
              if($status == TRUE){
                if($row['expense_in_user'] == ''){
                    $exp_user_id = null;
                    $status = TRUE;
                }
                else{
                   $employee = EmployeeMast::where('emp_name','LIKE', '%'.$row['expense_in_user']. '%')->first();
                   if(!empty($employee)){
                        $exp_user = ExpenseInUser::where('emp_id',$employee->emp_id)->first();
                        if(!empty($exp_user)){
                            $exp_user_id = $exp_user->emp_id;
                            $status = TRUE;
                        }
                        else{
                        $status =FALSE;
                        }
                   }
                   else{
                     $status = FALSE;
                   }
                }
              }

              // expense_permit
              if($status == TRUE){
                if($row['expense_permit'] == ''){
                    $exp_permit_id = null;
                    $status = TRUE;
                }
                else{
                   $employee = EmployeeMast::where('emp_name','LIKE', '%'.$row['expense_permit']. '%')->first();

                   if(!empty($employee)){
                    $exp_permit = ExpensePermitUser::where('emp_id',$employee->emp_id)->first();

                    if(!empty($exp_permit)){
                        $exp_permit_id = $exp_permit->emp_id;
                        $status = TRUE;
                    }
                    else{
                        $status =FALSE;
                    }
                   }
                   else{
                     $status = FALSE;
                   }
                }
              }


            // Email Check
              if($status == TRUE){
                if($row['email'] == ''){
                    $email = null ;
                    $status = TRUE;
                }
                else{
                    $email_check = $this->valid_email($row['email']);
                    if($email_check == TRUE){
                        $email = $row['email'];
                        $status = TRUE;
                    }
                    else{
                        $status = FALSE;
                    }                    
                }
              }
              //payment_method check

              if($status == TRUE){
                if($row['payment_method'] == ''){
                    $status = FALSE ;
                }
                else{
                    $payment_method = ExpenseMode::where('name',$row['payment_method'])->first();
                    if(!empty($payment_method)){                   
                            $status = TRUE; 
                    }
                    else{
                         $status = FALSE;
                    }                                     
                }
              }

              // Payment_status check 
              if($status == TRUE){
                if($row['payment_status'] == ''){
                    if($payment_method->name == 'NEFT'){
                        $payment_status = 'P'; //Pending
                    }
                    else{
                       $payment_status = 'A';  //Approved
                    }
                   // $status = FALSE;
                }
                else{
                    if($payment_method->name == 'NEFT'){
                        if($row['payment_status'] == 'Pending' || $row['payment_status'] == 'pending'){
                            $status = TRUE;
                            $payment_status = 'P';
                           
                        }
                        else{
                            $status = FALSE;

                        }
                    }
                    else{
                        if($row['payment_status'] == 'Approved' || $row['payment_status'] == 'approved' ){
                            $payment_status = 'A';  
                            $status = TRUE;
                                                
                        }
                        elseif($row['payment_status'] == 'Pending' || $row['payment_status'] == 'pending'){
                            $payment_status = 'P';  
                            $status = TRUE;    
                            
                        }
                        elseif($row['payment_status'] == 'Hold' || $row['payment_status'] == 'hold'){
                            $payment_status = 'H';  
                            $status = TRUE; 
                           
                        }

                        elseif($row['payment_status'] == 'Declined' || $row['payment_status'] == 'declined'){
                            $payment_status = 'D';  
                            $status = TRUE; 
                             
                        }
                        else{

                            $status = FALSE; 
                        }
                        
                    }
                    
                }
              }

             // Request_approval
               if($status == TRUE){
                    if($row['request_approval'] == ''){
                        if($payment_method->name == 'NEFT'){
                            $req_approval = '1';
                        } 
                        else{
                             $req_approval = '0';
                        }
                    }
                    else{
                        if($payment_method->name == 'NEFT'){
                            if($row['request_approval'] == 'YES' || $row['request_approval'] == 'yes' || $row['request_approval'] == 'Yes'){
                                $req_approval = '1';
                                $status =TRUE;

                            }
                            else{
                                $status =FALSE;
                            }
                        }
                        else{
                            if($row['request_approval'] == 'YES' || $row['request_approval'] == 'yes' || $row['request_approval'] == 'Yes'){
                                $req_approval = '1';
                                $status =TRUE;
                               
                            }
                            else if($row['request_approval'] == 'NO' || $row['request_approval'] == 'no' || $row['request_approval'] == 'No'){
                                $req_approval = '0';
                                $status =TRUE;
                            }
                            else{
                                $status =FALSE;
                            }
                        }
                    }
               }

               // expense_category 

               if($status == TRUE){
                if($row['expense_category'] == ''){
                   $status = FALSE; 
                }
                else{
                    $exp_catg =ExpenseCategory::where('name',$row['expense_category'])->first();
                    if(!empty($exp_catg)){
                       
                        $status = TRUE;
                    }
                    else{
                        $status = FALSE;
                    }
                }
               }

              if($status == TRUE){
                 Payment::create([
                    'comp_code'         => $company->comp_code,
                    'account_id'        => $account_id,
                    'paid_at'           => $date,
                    'amount'            => $amount,
                    'vendor_id'         => $vendor_id,
                    'narration'         => $row['narration'],
                    'catg_id'           => $exp_catg->id,
                    'mode_id'           => $payment_method->id,
                    'exp_permit_user'   => $exp_permit_id,
                    'exp_in_user'       => $exp_user_id,
                    'email'             => $email,
                    'status'            => $payment_status,
                    'note'              => $row['note'],
                    'req_approval'      => $req_approval,
                    
                   
                ]);
              }
              else{
                $error[] =[
                    'sno'             => $row['sno'],
                    'company_name'    => $row['company_name'],
                    'account_name'    => $row['account_name'],
                    'date'            => $row['date'],
                    'amount'          => $row['amount'],
                    'vendor_name'     => $row['vendor_name'],
                    'narration'       => $row['narration'],
                    'expense_in_user' => $row['expense_in_user'],
                    'expense_permit'  => $row['expense_permit'],
                    'email'           => $row['email'],
                    'payment_method'  => $row['payment_method'],
                    'payment_status'  => $row['payment_status'],
                    'expense_category'=> $row['expense_category'],
                    'request_approval'=> $row['request_approval'],
                    'note'            => $row['note'],
                   
                ];

              }
                $status =TRUE;

            }
        }
        if(count($error) !=0){

            return Excel::download(new ErrorPaymentExport($error), 'errorpaymentimport.xlsx');
        }
    

        return back()->with('success','Excel imported successfully');
       

   
           
      

    
    }   
    public function valid_email($email) {
         return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
    }

    public function error_import_payment($error){

   
  
    }

    
}
