<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $table = 'religion';

    // relasi satu ke banyak sama tabel customer contact
    public function customer_contact(){
        return $this->hasMany('\App\customer_contact','id_customer_contact','id');
    }
}
