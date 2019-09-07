<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
  use SoftDeletes;
  protected $table = 'desg_mast';  	
  protected $fillable = ['title'];

  public function employees(){
 		return $this->hasMany('App\Models\EmployeeMast', 'desg_id');
 	}

 	public function company(){
 		return $this->belongsTo('App\Models\CompMast','comp_id');
 	}
}
