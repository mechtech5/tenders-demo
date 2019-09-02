<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourStatus extends Model
{
  use SoftDeletes;
  protected $table = 'tour_status';

  public function tour_stages(){
 		return $this->hasMany('App\Models\TourStages','id','status');
 	}
}
