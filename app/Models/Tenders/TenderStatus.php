<?php

namespace App\Models\Tenders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenderStatus extends Model
{
	use SoftDeletes;
 	protected $table = 'tender_status_mast';

 	public function tenders(){
		return $this->hasMany('App\Models\Tenders\Tender', 'status_id');
 	}
}