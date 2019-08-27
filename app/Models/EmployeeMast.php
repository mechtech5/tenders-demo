<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeMast extends Model
{
	use SoftDeletes;
  protected $table = 'emp_mast';  	
  protected $primaryKey = 'emp_id';
 	public $incrementing =false;

	public function company(){
 		return $this->belongsTo('App\Models\CompMast');
 	}
}