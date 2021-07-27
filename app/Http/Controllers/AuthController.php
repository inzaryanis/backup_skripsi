<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Permission;
use App\Role;
use App\RoleMenu;
use App\Menu;
use App\SubMenu;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request) {
        if(Auth::attempt($request->only('username','password'))){
                $userId  = Auth::id();
                $user = User::where("id", $userId)->first();
                $cek = $user->roles()->pluck('id')->first();


                $menu_section = RoleMenu::where("id_role",$cek)
                ->where("tipe", "menu_section")
                ->with(['menusection'])
                ->get();

                foreach ($menu_section as $value) {

                    $data_menu = RoleMenu::where("id_role", $cek)
                    ->where("tipe", "menu")
                    ->get();

                    $id_menu = [];
                    foreach ($data_menu as $mvalue) {
                        $id_menu[] = $mvalue->id_menu;
                    }

                    $data_menu = Menu::whereIn('id',$id_menu)
                    ->where('id_ms',$value['menusection']->id)
                    ->get();

                    foreach ($data_menu as $mvalue) {

                        $url = $mvalue->url;

                        if($url=="#"){

                            $data_submenu = RoleMenu::where("id_role", $cek)
                            ->where("tipe", "sub_menu")
                            ->get();
                            $id_submenu = [];
                            foreach ($data_submenu as $smvalue) {
                                $id_submenu[] = $smvalue->id_menu;
                            }

                            $data_submenu = SubMenu::whereIn('id',$id_submenu)
                            ->where('id_menu',$mvalue->id)
                            ->get();

                            foreach ($data_submenu as $smvalue) {
                              $nama = $smvalue->nama;
                              $url = $smvalue->url;
                               $submenu[] = [
                                  'nama'=> $nama,
                                  'url'=> $url
                               ];
                            }

                            $menu[] = [
                                'nama'=> $mvalue->nama,
                                'url'=> $mvalue->url,
                                'icon'=> $mvalue->icon,
                                'sub_menu'=>$submenu
                            ];
                            $submenu = [];

                        }else{

                            $menu[] = [
                                'nama'=> $mvalue->nama,
                                'url'=> $mvalue->url,
                                'icon'=> $mvalue->icon,
                                'sub_menu'=> 'None'
                            ];
                        }
                    }


                    $side_menu[] = [
                      'nama'=>$value['menusection']->nama,
                      'menu'=>$menu
                    ];
                    $menu = [];
                }

                session(['menu' => $side_menu]);
                session(['id_role'=>$cek]);
                return redirect('/home');
            }
        }

        // public function postlogin(Request $request) {
        //     if(Auth::attempt($request->only('username','password'))){
        //         if($request->user()->role=='super admin'){
        //             return redirect('/super_admin');
        //         }else if ($request->user()->role=='customer service'){
        //             return redirect('/home');
        //         }else{
        //             return redirect('/sales');
        //     }
        //         return redirect('/');
        //   }
        // }
      
     public function register()
    {
        return view('auth.register');
    }
    

    protected function postregister(Request $request) {
        User::create([
           'name' => $request['name'],
           'email' => $request['email'],
           'username' => $request['username'],
           'password' => Hash::make($request['password']),
       ]);

       return redirect('/');
   }


   public function logout() {
	    Auth::logout();
      session()->flush();
	    return redirect('/');
	}

	public function cek_roles(){
		$user = User::where("username","juanjuli")->first();
    $cek = $user->roles()->pluck('id')->first();
    dd($cek);
    // $manager = new User();
    // $manager->name = 'Jitesh Meniya';
    // $manager->email = 'jitesh21@gmail.com';
    // $manager->password = bcrypt('jitesh21');
    // $manager->save();
    // $manager->roles()->attach($manager_role);
    // $manager->permissions()->attach($manager_perm);
	}

}
