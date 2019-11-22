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
 	public function prebids(){
 		return $this->hasMany('App\Models\Tenders\TenderPrebid', 'tender_id');
 	}
 	public function clients(){
 		return $this->hasMany('App\Models\Tenders\TenderClient','tender_id');
 	}
 	public function corrigendums(){
 		return $this->hasMany('App\Models\Tenders\TenderCorrigendum','tender_id');
 	}
 	public function documents(){
 		return $this->hasMany('App\Models\Tenders\TenderDocument','tender_id');
 	}
 	public function tenderOtherDate(){
 		return $this->hasMany('App\Models\Tenders\TenderOthersDate','tender_id');
 	}
 	public function emd(){
 		return $this->belongsTo('App\Models\Tenders\EMD','id','tender_id');
 	}
}