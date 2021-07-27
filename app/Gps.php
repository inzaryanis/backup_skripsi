<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gps extends Model
{
    protected $table = 'gps';

    //relasi sama tabel masterpart
    public function master_part(){
        return $this->belongsTo('\App\Masterpart','id_part','id');
    }
}
