<?php

namespace App\Models\Tenders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TenderType extends Model
{
	use SoftDeletes;
 	protected $table = 'tender_type_mast';
 	protected $guarded = [];

 	public function tenders(){
		return $this->hasMany('App\Models\Tenders\Tender', 'type_id');
 	}
}