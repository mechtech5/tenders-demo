<?php

namespace App\Models\Tenders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenderCategory extends Model
{
	use SoftDeletes;
 	protected $table   = 'tender_catg_mast';
 	protected $guarded = [];
 
 	public function tenders(){
		return $this->hasMany('App\Models\Tenders\Tender', 'status_id');
 	}
}