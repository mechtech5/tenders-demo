<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourStages extends Model
{
  use SoftDeletes;
  protected $table = 'tour_stages';

  public function tour(){
 		return $this->belongsTo('App\Models\Tours');
 	}

 	 public function status_info(){
 		return $this->belongsTo('App\Models\TourStatus','status');
 	}

 	public function employee(){
 		return $this->belongsTo('App\Models\EmployeeMast','creator_id');
 	}
}
