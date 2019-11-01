<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveMast extends Model
{
    use SoftDeletes;
    protected $table = 'leave_mast';
    
}
