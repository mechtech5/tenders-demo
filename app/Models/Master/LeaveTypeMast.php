<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveTypeMast extends Model
{
    use SoftDeletes;
    protected $table = 'leave_type_mast';
    protected $guarded = [];
}
