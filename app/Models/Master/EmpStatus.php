<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpStatus extends Model
{
  use SoftDeletes;
  protected $table = 'emp_status_mast';  

  public function employees(){
 		return $this->hasMany('App\Models\Employees\EmployeeMast', 'emp_status');
 	}
}
