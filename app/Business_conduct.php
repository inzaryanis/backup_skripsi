<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business_conduct extends Model
{
    protected $table = 'business_conduct';

    // relasi satu ke banyak sama tabel customer
    public function customer(){
        return $this->hasMany('\App\customer','id_business_conduct','id');
    }
}
