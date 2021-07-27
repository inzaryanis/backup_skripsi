<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complain_task extends Model
{
    protected $table = 'complain_task';

    // relasi satu ke banyak sama tabel  contact_type
    public function rfs(){
        return $this->hasMany('\App\Rfs','task','id');
    }
}
