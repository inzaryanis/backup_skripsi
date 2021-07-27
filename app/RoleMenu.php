<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    protected $table = 'role_menu';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'id_role', 'id_menu', 'tipe'
    ];

    public function menu(){
        return $this->belongsTo('App\Menu','id_menu');
    }

    public function submenu(){
        return $this->belongsTo('App\SubMenu','id_menu');
    }

    public function menusection(){
        return $this->belongsTo('App\MenuSection','id_menu');
    }

    public function role(){
        return $this->belongsTo('App\Role','id_role');
    }
}
