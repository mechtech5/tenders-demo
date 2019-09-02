<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CompMast extends Model
{
  protected $table = 'comp_mast'; 
  protected $primaryKey = 'comp_code';
 	public $incrementing = false; 	
 	
 	public function employees(){
 		return $this->hasMany('App\Models\EmployeeMast', 'comp_code', 'comp_code');
 	}

 	public function tours(){
 		return $this->hasMany('App\Models\Tours', 'comp_code', 'comp_code');
 	}

 	public function designations(){
 		return $this->hasMany('App\Models\Designation', 'comp_code', 'comp_code');
 	}
}
