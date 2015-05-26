<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Assignment extends Model
{

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }

    public function attendance()
    {
        return $this->hasMany('App\Attendance')->where('day_attendance',date("Y-m-d"));
    }

}