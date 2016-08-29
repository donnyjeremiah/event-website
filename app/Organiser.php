<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organiser extends Model
{
    protected $table = 'organisers';

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function events() {
        return $this->hasMany('App\Event', 'user_id', 'user_id');
    }
}
