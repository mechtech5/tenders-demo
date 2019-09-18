<?php

namespace App\Models\Master;


use Illuminate\Database\Eloquent\Model;

class DeptMast extends Model
{
  protected $table = 'dept_mast'; 
 	
 	public function employees(){
 		return $this->hasMany('App\Models\Employees\EmployeeMast', 'comp_id');
 	}

 	public function tours(){
 		return $this->hasMany('App\Models\Tours', 'comp_id');
 	}

 	public function designations(){
 		return $this->hasMany('App\Models\Master\Designation', 'comp_id');
 	}
}
