<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveApprovalDetail extends Model
{
    use SoftDeletes;
    protected $table = 'leave_approval_detail';
    
}
