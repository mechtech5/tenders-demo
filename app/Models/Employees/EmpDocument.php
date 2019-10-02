<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EmpDocument extends Model
{

    use SoftDeletes;

    protected $table = 'emp_docs';

    public function doctypemast(){
    	return $this->belongsTo('App\Models\Master\DocTypeMast');
    }
}
