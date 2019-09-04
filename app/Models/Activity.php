<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
  use SoftDeletes;
  protected $table = 'activity';

  public function approval()
  {
    return $this->hasOne('App\Models\Approval');
  }
}
