<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function customer()//该命名和取值相关
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
