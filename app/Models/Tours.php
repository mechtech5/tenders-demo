<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tours extends Model
{
  use SoftDeletes;
  protected $table = 'tours';

  public function employee(){
 		return $this->belongsTo('App\Models\EmployeeMast','emp_id');
 	}

 	public function company(){
 		return $this->belongsTo('App\Models\CompMast','comp_code');
 	}

 	public function stages(){
 		return $this->hasMany('App\Models\TourStages','tour_id');
 	}

}
