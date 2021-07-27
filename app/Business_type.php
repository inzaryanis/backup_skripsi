<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business_type extends Model
{
    protected $table = 'business_type';

    // relasi satu ke banyak sama tabel customer
    public function customer(){
        return $this->hasMany('\App\customer','id_business_type','id');
    }
}
