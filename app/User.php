<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'users';

    /**
     * Model Relationships
     *
     */
    public function role() {
        // return $this->belongsTo('App\Post', 'foreign_key', 'other_key');
        // foreign_key = this table column, other_key = parent table column
        return $this->belongsTo('App\UserRole', 'role_id', 'id'); // Note: backslash NOT forwardslash
    }

    public function info() {
        //$role = App\UserRole::where('id', $this->id)->value('name');
        $role = $this->role->name; //or role()?
        if($role = "Visitor") {
            // return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
            // foreign_key = child table column, local_key = this table column
            return $this->hasOne('App\Visitor', 'user_id', 'id');
        }
        else if($role = "Organiser") {
            return $this->hasOne('App\Organiser', 'user_id', 'id');
        }
        else if($role = "Admin") {
            return $this->hasOne('App\Admin', 'user_id', 'id');
        }
    }

    /**
     * Model Events
     *
     */
    public static function boot() {
        parent::boot();

        static::deleting(function($user) {
            //$role = App\UserRole::where('id', $this->id)->value('name');
            $role = $this->role()->name;
            if($role = "Visitor") {
                $user->info()->delete();
            }
            else if($role = "Organiser") {
                $user->info()->delete();
            }
            else if($role = "Admin") {
                $user->info()->delete();
            }
        });
    }
}
