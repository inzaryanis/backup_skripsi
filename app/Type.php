<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';

    //relasi sama tabel master part, one to many
    public function master_part(){
        return $this->hasMany('\App\Masterpart','id_type','id');
    }
}
