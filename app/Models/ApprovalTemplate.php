<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApprovalTemplate extends Model
{
  use SoftDeletes;
  protected $table = 'approval_template';

  public function details(){
  	 return $this->belongsTo('App\Models\ApprovalMast');
  }
 
}
