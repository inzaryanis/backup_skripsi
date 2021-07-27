<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_contact extends Model
{
    protected $table = 'customer_contact';

    //relasi sama tabel contact_type
    public function contact_type(){
        return $this->belongsTo('\App\Contact_type','id_contact_type','id');
    }

    //relasi sama tabel religion
    public function religion(){
        return $this->belongsTo('\App\Religion','id_religion','id');
    }

    //relasi sama tabel customer
    public function customer(){
        return $this->belongsTo('\App\Customer','id_customer','id');
    }

    //relasi sama tabel customer address
    public function customer_address(){
        return $this->belongsTo('\App\Customer_address','id_customer_address','id');
    }
    
     //relasi sama tabel rfs
     public function requestor_pic(){
        return $this->belongsTo('\App\Rfs','id_requestor_pic','id');
    }
    
}
