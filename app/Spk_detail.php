<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spk_detail extends Model
{
    protected $table = 'spk_detail';

    public function SPK(){
        return $this->belongsTo('\App\SPK','id_spk','id');
    }

   

}
