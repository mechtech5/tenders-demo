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

 	public function approval_detail(){
 		return $this->belongsTo('App\Models\ApprovalDetail','id');
 	}
 	public function employee(){
 		return $this->belongsTo('App\Models\EmployeeMast','creator_id');
 	}

}
