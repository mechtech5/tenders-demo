<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
  use SoftDeletes;
  protected $table = 'desg_mast';  	
  protected $fillable = ['title'];

  public function employees(){
 		return $this->hasMany('App\Models\Employees\EmployeeMast', 'desg_id');
 	}

 	public function company(){
 		return $this->belongsTo('App\Models\Master\CompMast','comp_id');
 	}
}
