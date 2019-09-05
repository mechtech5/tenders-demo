<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenderType extends Model
{
 	protected $table = 'tender_type_mast';

 	public function tenders(){
		return $this->hasMany('App\Models\Tenders\Tender', 'type_id');
 	}
}