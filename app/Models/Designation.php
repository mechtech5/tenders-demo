<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
  use SoftDeletes;
  protected $table = 'dsgn_mast';  	
  protected $fillable = ['title'];

  public function employee(){
 		return $this->belongsTo('App\Models\EmployeeMast');
 	}
}
