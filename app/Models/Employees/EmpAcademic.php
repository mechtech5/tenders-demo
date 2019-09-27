<?php

namespace App\Models\Employees;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class EmpAcademic extends Model
{
 use SoftDeletes;
 protected $table = 'emp_academics';  

 public function employee(){
 	 	return $this->belongsTo('App\Models\Employees\EmployeeMast');
 }
}
