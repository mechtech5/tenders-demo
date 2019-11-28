<?php

namespace App\Models\Tenders;

use Illuminate\Database\Eloquent\Model;

class TenderItems extends Model
{
    protected $table   = 'tender_boq_items';
    protected $guarded = [];

    public function unit(){
		return $this->belongsTo('App\Models\Tenders\UnitsMast','unit_id');
 	}
}
