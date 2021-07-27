<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office_type extends Model
{
    protected $table = 'office_type';

    // relasi satu ke banyak sama tabel customer address
    public function customer_address(){
        return $this->hasMany('\App\customer_address','id_customer_address','id');
    }
}
