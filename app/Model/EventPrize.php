<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    protected $guarded=[];

    public function event()
    {
        return $this->belongsTo(Event::class,'events_id');
    }

    public function business()
    {
        return $this->belongsTo(BusinessList::class,'business_lists_id');
    }
}
