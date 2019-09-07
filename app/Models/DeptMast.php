<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DeptMast extends Model
{
  protected $table = 'dept_mast'; 
 	
 	public function employees(){
 		return $this->hasMany('App\Models\EmployeeMast', 'comp_id');
 	}

 	public function tours(){
 		return $this->hasMany('App\Models\Tours', 'comp_id');
 	}

 	public function designations(){
 		return $this->hasMany('App\Models\Designation', 'comp_id');
 	}
}
