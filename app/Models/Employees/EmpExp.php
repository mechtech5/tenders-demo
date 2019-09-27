<?php

namespace App\Models\Employees;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class EmpExp extends Model
{
 use SoftDeletes;
 protected $table = 'emp_exp';  

 public function employee(){
 	 	return $this->belongsTo('App\Models\Employees\EmployeeMast');
 }
}
