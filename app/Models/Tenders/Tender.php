<?php

namespace App\Models\Tenders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tender extends Model
{
 	protected $table = 'tender_mast';
 	use SoftDeletes;

 	public function status(){
		return $this->belongsTo('App\Models\Tenders\TenderStatus');
 	}

 	public function type(){
		return $this->belongsTo('App\Models\Tenders\TenderType');
 	}
}