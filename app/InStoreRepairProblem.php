<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InStoreRepairProblem extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
