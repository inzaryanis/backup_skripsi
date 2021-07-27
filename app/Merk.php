<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    protected $table = 'merk';

    protected $fillable = ['merk'];

     //relasi sama tabel master part, one to many
     public function master_part(){
        return $this->hasMany('\App\Masterpart','id_merk','id');
    }
}
