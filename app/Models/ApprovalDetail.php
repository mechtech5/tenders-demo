<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApprovalDetail extends Model
{
  use SoftDeletes;
  protected $table = 'approval_detail';

  public function approval(){
  	return $this->belongsTo('App/Models/Approval');
  }

  public function tours(){
  	return $this->hasMany('App/Models/Tours','current_stage');
  }

  public function stages(){
 		return $this->hasMany('App/Models/TourStages','status');
 	}
}
