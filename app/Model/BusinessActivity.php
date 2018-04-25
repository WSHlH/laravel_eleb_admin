<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessActivity extends Model
{
    use softDeletes;

    protected $guarded=[];

    protected $dates = ['delete_at'];

}
