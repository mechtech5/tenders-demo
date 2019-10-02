<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;

class EmpNominee extends Model
{
    protected $table = 'emp_nominee';

    public function employee(){
    	
 	 	return $this->belongsTo('App\Models\Employees\EmployeeMast');
 }
}
