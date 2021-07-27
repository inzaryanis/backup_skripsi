<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
            'name',
            'short_name' ,
            'business_type',
            'business_conduct',
            'npwp',
            'remarks',
            'active_ind',
            'code_name' ,
            'control_by' 
    ];

    //relasi sama tabel business_type
    public function business_type(){
        return $this->belongsTo('\App\Business_type','id_business_type','id');
    }

    //relasi sama tabel business_conduct
    public function business_conduct(){
        return $this->belongsTo('\App\Business_conduct','id_business_conduct','id');
    }

     //relasi sama tabel address, one to many
     public function Customer_address(){
        return $this->hasMany('\App\Customer_address','id_Customer','id');
    }

     //relasi sama tabel contact, one to many
     public function Customer_contact(){
        return $this->hasMany('\App\Customer_contact','id_Customer','id');
    }

    //relasi sama tabel bap, one to many
    public function BAP(){
        return $this->hasMany('\App\BAP','id_Customer','id');
    }

    public function SPK(){
        return $this->hasMany('\App\SPK','id_customer','id');
    }

    public function Gps_installation(){
        return $this->hasMany('\App\Gps_installation','id_customer','id');
    }

    public function rfs(){
        return $this->hasMany('\App\Rfs','company_requestor','id');
    }

    public function gsm(){
        return $this->hasMany('\App\Gsm','company','id');
    }
    
}
