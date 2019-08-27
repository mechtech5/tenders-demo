<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpensePermitUser extends Model
{
    protected $table = 'expense_permit_user';
	public $timestamps = false;
	protected $guarded = [] ;
 	protected $primaryKey = 'emp_id';
 	public $incrementing =false;

 	public function users(){
 		return $this->belongsToMany('App\CompGrpMast','exp_permit_user','emp_id','grp_code');
 	}
}
