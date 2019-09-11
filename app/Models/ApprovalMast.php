<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApprovalMast extends Model
{
  use SoftDeletes;
  protected $table = 'approval_mast';

  public function approval()
  {
    return $this->hasMany('App\Models\ApprovalTemplate');
  }
}
