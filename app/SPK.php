<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SPK extends Model
{
    protected $table = 'spk';

    public function Spk_detail(){
        return $this->hasMany('\App\Spk_detail','id_spk','id');
    }

    public function customer(){
        return $this->belongsTo('\App\Customer','id_customer','id');
    }
}
