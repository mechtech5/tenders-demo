<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
  use SoftDeletes;
  protected $table = 'dsgn_mast';  	
  protected $fillable = ['title'];

  public function employees(){
 		return $this->hasMany('App\Models\EmployeeMast', 'emp_desg', 'id');
 	}
}
