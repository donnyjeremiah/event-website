<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventAddress extends Model
{
    protected $table = 'events_addresses';

    public function event() {
        return $this->belongsTo('App\Event', 'event_id', 'id');
    }
}
