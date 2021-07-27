<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gsm extends Model
{
    protected $table = 'gsm';

    protected $fillable = [
        'gsm_number', 'serial_number'
    ];

     //relasi sama tabel bap, one to many
     public function BAP(){
        return $this->hasMany('\App\BAP','gsm_number','id');
    }

     //relasi sama tabel customer
     public function customer(){
        return $this->belongsTo('\App\Customer','company','id');
    }
}
