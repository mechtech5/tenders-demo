<?php

namespace App\Http\Controllers\Expenses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\CompMast;
use App\Vendor;
use App\ExpenseMode;    

class PaymentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

     public function index()
    {
        return view('expenses.payments.show');
    }

   
    public function create()
    {
        $vendors = Vendor::all();
        $companies = CompMast::all();
        $accounts = Db::table('account_mast')->get();

        $exp_mode = ExpenseMode::all();

        $exp_catg = DB::table('expense_catg_mast')->get();

        $exp_in_users = DB::table('exp_in_user')->join('emp_mast','emp_mast.user_id','exp_in_user.user_id')->get();

        $exp_permit_users = DB::table('exp_permit_user')->join('emp_mast','emp_mast.user_id','exp_permit_user.user_id')->get();

        return view('expenses.payments.create',compact('vendors','companies','accounts','exp_mode','exp_catg','exp_in_users','exp_permit_users'));
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
