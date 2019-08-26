<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
   	protected $guarded = [];

   	public function account(){
    	return $this->belongsTo('App\Models\AccountMast','account_id');
    }
    public function company(){
    	return $this->belongsTo('App\Models\CompMast','comp_code');
    }
    public function expense_in_user(){
    	return $this->belongsTo('App\Models\EmployeeMast','exp_in_user');
    }
    public function expense_permit_user(){
    	return $this->belongsTo('App\Models\EmployeeMast','exp_permit_user');
    }
    public function expense_category(){
    	return $this->belongsTo('App\Models\ExpenseCategory','catg_id');
    }
    public function expense_mode(){
    	return $this->belongsTo('App\Models\ExpenseMode','mode_id');
    }
    public function vendor(){
        return $this->belongsTo('App\Models\Vendor','vendor_id');
    }
}
