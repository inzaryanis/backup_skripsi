<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomor_polisi extends Model
{
    protected $table = 'nomor_polisi';

    public function union_nomor_polisi(){
        return $this->hasMany('\App\Union_nomor_polisi');
    }
}
