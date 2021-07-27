<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $table = 'sub_menu';

    protected $primaryKey = 'id';
    
    protected $fillable = [
    	'id_menu', 'nama', 'url'
    ];

    public function menu(){
        return $this->belongsTo('App\Menu','id_menu');
    }

    public function role_menu(){
        return $this->hasmany('App\RoleMenu');
    }
}
