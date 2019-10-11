<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpBankDetail extends Model
{
	use Softdeletes;

    protected $table = 'emp_bank_details';
}
