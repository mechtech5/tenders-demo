<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
  use SoftDeletes;
  protected $table = 'emp_grade_mast'; 
  protected $primaryKey = 'grade_code'; 
  public $incrementing = false;	

}
