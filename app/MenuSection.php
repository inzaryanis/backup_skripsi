<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuSection extends Model
{
    protected $table = 'menu_section';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'nama'
    ];

    public function menu(){
        return $this->hasmany('App\Menu');
    }

    public function role_menu(){
        return $this->hasmany('App\RoleMenu');
    }
}
