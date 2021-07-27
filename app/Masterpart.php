<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masterpart extends Model
{
    protected $table = 'master_part';

    protected $fillable = [
        'part', 'series', 'type', 'merk','uom','description'
    ];

    //relasi sama tabel merk
    public function merk(){
        return $this->belongsTo('\App\Merk','id_merk','id');
    }

    //relasi sama tabel series
    // public function series(){
    //     return $this->belongsTo('\App\Series','id_series','id');
    // }

    //relasi sama tabel type
    public function type(){
        return $this->belongsTo('\App\Type','id_type','id');
    }

     //relasi sama tabel GPS, one to many
     public function gps(){
        return $this->hasMany('\App\Gps','id_part','id');
    }

     //relasi sama tabel GPS, one to many
     public function inventory(){
        return $this->hasMany('\App\Inventory','id_part','id');
    }
}
