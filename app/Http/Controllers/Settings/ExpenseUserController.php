<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmployeeMast;
use App\Models\ExpenseInUser;
use App\Models\CompGrpMast;
use App\User;
class ExpenseUserController extends Controller
{
   	
   	public function create(){
   		$olduser_id = ExpenseInUser::select('emp_id')->get();
   		// return $oldUser ;

   		$users = EmployeeMast::whereNotIn('emp_id',$olduser_id->toArray())->get();

   		$oldUsers = EmployeeMast::whereIn('emp_id',$olduser_id->toArray())->get();

   		return view('settings.expense_user.create',compact('users','oldUsers'));
   	}
   	public function store(Request $request){
   		$users = $request->users;
   		$grp_code = $request->grp_code;

   		$company_grp = CompGrpMast::find($grp_code);

   		$company_grp->expense_users()->sync($users);

   		return 'Expense User Added successfully';

   	}
}
