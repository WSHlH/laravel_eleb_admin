<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    protected $fillable = [
        'name', 'image',
    ];
}
