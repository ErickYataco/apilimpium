<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Attendance extends Model
{

    public function assignment()
    {
        return $this->belongsTo('App\Assignment');
    }

}