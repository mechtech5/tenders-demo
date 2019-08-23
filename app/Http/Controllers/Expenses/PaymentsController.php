<?php

namespace App\Http\Controllers\Expenses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePayments;
use App\Exports\PaymentsExport;
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
use App\Models\Payment;    

class PaymentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $payments = Payment::with('account','company','employee_in_user','employee_permit_user','expense_mode','vendor')->with(['expense_category' => function($query){
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
        $payment = Payment::with('account','company','employee_in_user','employee_permit_user','expense_category','expense_mode','vendor')->where('id',$id)->first();
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


         Excel::import(new PaymentsImport,$request->file('file'));
           
        // return back();
    
    }   
}
