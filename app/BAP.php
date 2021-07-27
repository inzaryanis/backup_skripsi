<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BAP extends Model
{
    protected $table = 'bap';

     //relasi sama tabel customer
     public function Customer(){
        return $this->belongsTo('\App\Customer','id_customer','id');
    }

    public function Gsm(){
        return $this->belongsTo('\App\Gsm','gsm_number','id');
    }

}
