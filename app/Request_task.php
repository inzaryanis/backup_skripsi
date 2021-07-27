<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request_task extends Model
{
    protected $table = 'request_task';

    public function rfs(){
        return $this->hasMany('\App\Rfs','task','id');
    }

}
