<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $table = 'series';

    //relasi sama tabel master part, one to many
    // public function master_part(){
    //     return $this->hasMany('\App\Masterpart','id_series','id');
    // }
}
