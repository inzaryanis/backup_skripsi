<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';

     //relasi sama tabel masterpart
     public function master_part(){
        return $this->belongsTo('\App\Masterpart','id_part','id');
    }
}
