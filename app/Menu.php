<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'id_ms', 'nama', 'url', 'icon'
    ];

    public function sub_menu(){
        return $this->hasmany('App\SubMenu');
    }

    public function role_menu(){
        return $this->hasmany('App\RoleMenu');
    }
}
