<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Assignment extends Model
{

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }

}