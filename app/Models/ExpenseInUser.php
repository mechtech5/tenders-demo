<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseInUser extends Model
{
    protected $table = 'expense_in_user';
	public $timestamps = false;
	protected $guarded = [] ;
 	protected $primaryKey = 'emp_id';
 	public $incrementing =false;

 	public function users(){
 		return $this->belongsToMany('App\CompGrpMast','exp_in_user','emp_id','grp_code');
 	}
}
