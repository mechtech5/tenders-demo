<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompMast extends Model
{
    protected $table = 'comp_mast';  	
  	protected $primaryKey = 'comp_code';
 	public $incrementing =false;
}
