<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompGrpMast extends Model
{
    protected $table = 'comp_grp';  	
  	protected $primaryKey = 'grp_code';
 	public $incrementing =false;
 	
 	public function expense_users(){
        return $this->belongsToMany('App\Models\ExpenseInUser', 'exp_in_user', 'grp_code','emp_id');
    }

    public function expense_permit_users(){
        return $this->belongsToMany('App\Models\ExpensePermitUser', 'exp_permit_user', 'grp_code','emp_id');
    }
}
