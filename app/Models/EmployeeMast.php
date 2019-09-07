<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeMast extends Model
{
	use SoftDeletes;
  protected $table = 'emp_mast';  

	public function company(){
 		return $this->belongsTo('App\Models\CompMast', 'comp_id');
 	}

 	public function tours(){
 		return $this->hasMany('App\Models\Tours','emp_id');
 	}

 	public function designation(){
 		return $this->belongsTo('App\Models\Designation', 'desg_id');
 	}

 	public function user(){
 		return $this->hasOne('App\User','id');
 	}

 	public function stages(){
 		return $this->hasMany('App\Models\TourStages','emp_id');
 	}
}