<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Approval extends Model
{
  use SoftDeletes;
  protected $table = 'approval';

 	public function activity()
  {
    return $this->hasOne('App\Models\Activity');
  }

  public function details(){
  	 return $this->hasMany('App\Models\ApprovalDetail');
  }
 
}
