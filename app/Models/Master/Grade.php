<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
  use SoftDeletes;
  protected $table = 'emp_grade_mast'; 

  public function employees(){
  	return $this->hasMany('App\Models\Employees\EmployeeMast');
  }
}
