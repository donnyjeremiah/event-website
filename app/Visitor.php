<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitors';

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
