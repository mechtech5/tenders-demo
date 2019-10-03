<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpNominee extends Model
{
	use SoftDeletes;
    protected $table = 'emp_nominee';

    public function employee(){
    	
 	 	return $this->belongsTo('App\Models\Employees\EmployeeMast');
 }
}
