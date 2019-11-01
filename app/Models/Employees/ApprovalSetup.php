<?php

namespace App\Models\Employees;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class ApprovalSetup extends Model
{
    use SoftDeletes;

    protected $table = 'approval_setup_mast';
}
