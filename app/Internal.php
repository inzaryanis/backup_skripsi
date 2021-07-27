<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internal extends Model
{
    protected $table = 'internal';

    public function rfs(){
        return $this->hasMany('\App\Rfs','company_requestor','id');
    }
}
