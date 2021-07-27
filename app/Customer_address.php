<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_address extends Model
{
    protected $table = 'customer_address';

    protected $fillable = [
        'id_customer',
        'office_type' ,
        'address_text',
        'first_address_line',
        'second_address_line',
        'third_address_line',
        'city_area',
        'postal_zip_code' ,
        'country_area',
        'active_ind'
];

    //relasi sama tabel office_type
    public function office_type(){
        return $this->belongsTo('\App\Office_type','id_office_type','id');
    }

    //relasi sama tabel customer
    public function customer(){
        return $this->belongsTo('\App\Customer','id_customer','id');
    }

    //relasi sama tabel contact, one to many
    public function Customer_contact(){
        return $this->hasMany('\App\Customer_contact','Customer_address','id');
    }
}
