<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request_media extends Model
{
    protected $table = 'request_media';

    //relasi sama tabel Rfs, one to many field REQUEST MEDIA
    public function Rfs(){
        return $this->hasMany('\App\Rfs');
    }

    //relasi sama tabel Rfs, one to many FIELD RESPONSE MEDIA
    public function Rfs_respon(){
        return $this->hasMany('\App\Rfs','response_media','id');
    }
}
