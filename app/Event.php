<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $table = 'events';

    protected $guarded = ['id'];

    /**
     * Model Relationships
     *
     */
    public function type() {
        return $this->belongsTo('App\EventType', 'type_id', 'id');
    }

    public function status() {
        return $this->belongsTo('App\EventApprovalStatus', 'status_id', 'id');
    }

    public function organiser() {
        return $this->belongsTo('App\Organiser', 'user_id', 'user_id');
    }

    public function user() {
        return $this->organiser->user;
    }

    public function address() {
        return $this->hasOne('App\EventAddress', 'event_id', 'id');
    }

    /**
     * Accessors and Mutators
     *
     */
     public function setDateStartAttribute($date) {
        $this->attributes['date_start'] = Carbon::createFromFormat('d/m/Y', $date);
     }

     public function setDateEndAttribute($date) {
        if($date)
            $this->attributes['date_end'] = Carbon::createFromFormat('d/m/Y', $date);
     }

     // fields that should return as Carbon instances on request
     protected $dates = ['date_start', 'date_end'];

     // '1:00pm' to '13:00:00'
     public function setTimeAttribute($time) {
        $this->attributes['time'] = $this->modifyTime12To24($time);
     }

     // '13:00:00' to '1:00 PM'
     public function getTimeAttribute($time) {
         return $this->modifyTime24To12($time);
     }



    /**
     * Model Events
     */
    public static function boot() {
        parent::boot();

        static::deleting(function($event) {
            $event->address->delete();
        });
    }

    // '1:00pm' to '13:00:00'
    public function modifyTime12To24($time) {
        $is_am = (substr($time, -2) == 'am')? true: false;
        $time = substr($time, 0, -2).':00'; // removes am
        $hours = substr($time, 0, strpos($time,':')); // get hours
        if($is_am && $hours == '12') {
            $time = '00'.substr($time, -6);
        }
        else if($hours < 12) {
            $time = ($hours += 12).substr($time, -6);
        }
        return $time;
    }

    // '13:00:00' to '1:00 PM'
    public function modifyTime24To12($time) {
        $hours = substr($time, 0, strpos($time,':')); // get hours
        $minutes = substr($time, 2, 3);
        if($hours > '12') {
            $time = ($hours -= 12).$minutes.' PM';
        } else if ($hours == '00' || $hours == '12') {
            $time = '12'.$minutes.(($hours == '00')?' AM':' PM');
        } else {
            $time = (int)$hours.$minutes.' AM';
        }
        return $time;
    }
}
