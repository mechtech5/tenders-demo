<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocTypeMast extends Model
{
    use SoftDeletes;
    protected $table = 'doc_type_mast';

    public function empdocument(){
    	return $this->hasMany('App\Models\Employees\Empdocument', 'doc_type_id');
    }
}
