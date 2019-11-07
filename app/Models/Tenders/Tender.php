<?php

namespace App\Models\Tenders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tender extends Model
{
 	protected $table   = 'tender_mast';
 	protected $guarded = [];
 	use SoftDeletes;

 	public function category(){
		return $this->belongsTo('App\Models\Tenders\TenderCategory');
 	}

 	public function type(){
		return $this->belongsTo('App\Models\Tenders\TenderType');
 	}
}