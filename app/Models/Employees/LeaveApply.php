<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveApply extends Model
{
    use SoftDeletes;

    protected $table = 'emp_leave_applies';
    protected $with	 =	['leavetype', 'employees'];

    public function leavetype(){
    	
    	return $this->belongsTo('App\Models\Master\LeaveTypeMast', 'leave_type');
    }

    public function employees(){

    	return $this->belongsTo('App\Models\Employees\EmployeeMast', 'emp_id');
    }
    
}
