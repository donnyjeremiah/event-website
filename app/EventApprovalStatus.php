<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventApprovalStatus extends Model
{
    protected $table = 'event_approval_statuses';

    public function events() {
        return $this->hasMany('App\Event', 'status_id', 'id');
    }
}
