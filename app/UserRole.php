<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_roles';

    public function users() {
        // return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
        // foreign_key = child table column, local_key = this table column
        return $this->hasMany('App\User', 'role_id', 'id'); // Note: backslash NOT forwardslash
    }
}
