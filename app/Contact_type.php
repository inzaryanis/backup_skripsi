<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_type extends Model
{
    protected $table = 'contact_type';

     // relasi satu ke banyak sama tabel  contact_type
     public function customer(){
        return $this->hasMany('\App\customer','id_contact_type','id');
    }
    
}
