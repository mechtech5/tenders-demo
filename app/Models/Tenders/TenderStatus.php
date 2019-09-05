<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenderStatus extends Model
{
 	protected $table = 'tender_status_mast';

 	public function tenders(){
		return $this->hasMany('App\Models\Tenders\Tender', 'status_id');
 	}
}