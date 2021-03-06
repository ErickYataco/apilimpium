<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Worker extends Model
{

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }


}