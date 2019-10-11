<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpDocument extends Model
{

    use SoftDeletes;

    protected $table = 'emp_docs';
    protected $with = ['doctypemast'];

    public function doctypemast(){
    	return $this->belongsTo('App\Models\Master\DocTypeMast','doc_type_id');
    }

    //public function 
}
