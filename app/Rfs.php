<?php

namespace App;
use Illuminate\Support\Carbon;
// use Alfa6661\AutoNumber\AutoNumberTrait;

use Illuminate\Database\Eloquent\Model;

class Rfs extends Model
{
    // use AutoNumberTrait;  
    
    protected $table = 'rfs';

    protected $fillable = [

        // 'request_date' ,

                 'rfs_number',
                'company_requestor' ,
                'request_from',
                'task',
                'request_media' ,
                'task_description',
                'response_date',
                'response_by',
                'response_media' ,
                'status' ,
                'status_description' ,
                'request_type',
                'request_date',
                'company',
                'response_input_by' ,
                'location',
];
    
    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function($post) {
    //         $post->created_at = Carbon::now();
    //         $post->updated_at = Carbon::now();
    //     });

    //     static::updating(function($post) {
    //         $post->updated_at = Carbon::now();
    //     });
    // }
    // public $timestamps =false;
    // const CREATED_AT = 'create_date';
    // const UPDATED_AT = 'update_date'; 

    //relasi sama tabel 
    public function Request_media(){
        return $this->belongsTo('\App\Request_media','id_request_media');
    }

    //relasi sama tabel 
    public function Response_media(){
        return $this->belongsTo('\App\Request_media','response_media','id');
    }

     //relasi sama tabel 
     public function customer(){
        return $this->belongsTo('\App\Customer','company_requestor','id');
    }

   //relasi sama tabel 
   public function customer_contact(){
    return $this->belongsTo('\App\Customer_contact','id_requestor_pic','id');
}

    //relasi sama tabel 
   public function request_task(){
    return $this->belongsTo('\App\Request_task','task','id');
}

//relasi sama tabel 
public function complain_task(){
    return $this->belongsTo('\App\Complain_task','task','id');
}

//relasi sama tabel 
public function internal(){
    return $this->belongsTo('\App\Internal','company_requestor','id');
}

public function Company_requestor(){
    if($this->request_from == "Eksternal")
        return Customer::where('id',$this->company_requestor)->first()->name??'';
    if($this->request_from == "Internal")
        return Internal::where('id',$this->company_requestor)->first()->name??'';
} 

public function Task(){
    if($this->Request_type == "Request")
        return Request_task::findOrFail($this->company_requestor)->request;
    if($this->Request_type == "Complain")
        return Complain_task::findOrFail($this->company_requestor)->complain;
} 

// public function Requestor_pic(){
//     if($this->request_from == "eksternal")
//         return Customer_contact::findOrFail($this->Requestor_pic)->name;
//     if($this->request_from == "internal")
//         if($this->company_requestor=="management")
//         return Internal::findOrFail($this->Requestor_pic)->name;
// } 
}
