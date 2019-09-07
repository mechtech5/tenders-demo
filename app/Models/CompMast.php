<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompMast extends Model
{
    protected $table = 'comp_mast'; 
 	
 	public function expense_users(){
        return $this->belongsToMany('App\Models\ExpenseInUser', 'exp_in_user', 'comp_id','emp_id');
    }

    public function expense_permit_users(){
        return $this->belongsToMany('App\Models\ExpensePermitUser', 'exp_permit_user', 'comp_id','emp_id');
    }
}
