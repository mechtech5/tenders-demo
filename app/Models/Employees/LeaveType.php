<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LeaveType extends Model
{

    use SoftDeletes;

    protected $table = 'leave_mast';
    protected $guarded = [];
}
