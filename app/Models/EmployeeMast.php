<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeMast extends Model
{
    protected $table = 'emp_mast';  	
  	protected $primaryKey = 'emp_id';
 	public $incrementing =false;
}