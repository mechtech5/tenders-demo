<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpType extends Model
{
  use SoftDeletes;
  protected $table = 'emp_type_mast'; 
}
