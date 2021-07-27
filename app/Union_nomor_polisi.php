<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Union_nomor_polisi extends Model
{
    protected $table = 'union_nomor_polisi';

    public function nomor_polisi(){
        return $this->belongsTo('\App\Nomor_polisi','id_nomor_polisi');
    }
    public function Gps_installation(){
        return $this->belongsTo('\App\Gps_installation','id_nomor_polisi');
    }
}
