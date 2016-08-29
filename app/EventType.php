<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $table = 'event_types';

    public function events() {
        return $this->hasMany('App\Event', 'type_id', 'id');
    }
}
