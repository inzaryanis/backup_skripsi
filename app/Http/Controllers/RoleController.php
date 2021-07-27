<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use App\RoleMenu;
use App\Role;
use App\MenuSection;
use App\Menu;
use App\SubMenu;

class RoleController extends Controller
{
	public function index(){
		return view('setting.role.index');
	}

	public function getData(){
		$data = Role::orderBy('name','ASC')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" class="edit btn btn-primary btn-sm editRole"><i class="fa fa-edit"></i></a> ';
                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" class="edit btn btn-success btn-sm menuRole"><i class="fa fa-bars"></i></a> ';

                       $btn .=' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Hapus" class="hapus btn btn-danger btn-sm deleteRole"><i class="fa fa-trash"></i></a>';
                       

                        return $btn;

                })
                ->rawColumns(['action'])
                ->make(true);
	}

    public function storeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|max:255'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 422);
        }
        $slug = strtolower($request->name);
        $input = $request->all();
        $input['slug'] = $slug;
        Role::create($input);

        return 'Success';
    }

    public function deleteRole($id)
    {
        $data = Role::find($id);
        $data->delete();

        $menuRole = RoleMenu::where('id_role',$id);
        $menuRole->delete();

        return 'Success';
    }

    public function editRole($id)
    {
        $data = Role::find($id);
        return $data;
    }

    public function updateRole(Request $request)
    {
        $data = Role::find($request->id);
        $slug = strtolower($request->name);
        $data->update([
            'name'=>$request->name,
            'slug'=>$slug
        ]);

        return 'Success';
    }

    public function menuRole($id)
    {
        $menusection = MenuSection::all();
        foreach ($menusection as $value) {
            $data_menu = Menu::where('id_ms',$value->id)->get();
            foreach ($data_menu as $val_menu) {
                if($val_menu->url=="#"){
                    $sub_menu = SubMenu::where('id_menu',$val_menu->id)->get();

                    foreach ($sub_menu as $val_sm) {
                        $submenu[] = [
                            'nama'=>$val_sm->nama,
                            'id'=>$val_sm->id
                        ];
                    }
                    $menu[] = [
                        'nama'=>$val_menu->nama,
                        'id'=>$val_menu->id,
                        'sub_menu'=>$submenu
                    ];
                    $submenu = [];

                }else{
                    $menu[] = [
                        'nama'=>$val_menu->nama,
                        'id'=>$val_menu->id,
                        'sub_menu'=>'none'
                    ];
                }
            }

            $allmenu[] = [
                'nama'=>$value->nama,
                'id'=>$value->id,
                'menu'=>$menu
            ];
            $menu = [];
        }

        $output['menu_section'] = RoleMenu::where('id_role',$id)
        ->where("tipe","menu_section")
        ->get();

        $output['menu'] = RoleMenu::where('id_role',$id)
        ->where("tipe","menu")
        ->get();

        $output['sub_menu'] = RoleMenu::where('id_role',$id)
        ->where("tipe","sub_menu")
        ->get();

        $output['allmenu'] = $allmenu;

        return $output;
    }

    public function updateMenuRole(Request $request)
    {
        $id = $request->id;

        RoleMenu::where('id_role', $id)->delete();

        $limit  = count($request->menu_section);
        $menu_section = $request->menu_section;

        $limit2 = count($request->menu);
        $menu   = $request->menu;

        $limit3   = count($request->sub_menu);
        $sub_menu = $request->sub_menu;

        for ($i=0; $i < $limit; $i++) { 
            $id_ms = $menu_section[$i];
            RoleMenu::create([
                'id_role'=>$id,
                'id_menu'=>$id_ms,
                'tipe'=> 'menu_section'
            ]);
        }

        for ($i=0; $i < $limit2; $i++) { 
            $id_m = $menu[$i];
            RoleMenu::create([
                'id_role'=>$id,
                'id_menu'=>$id_m,
                'tipe'=> 'menu'
            ]);
        }

        for ($i=0; $i < $limit3; $i++) { 
            $id_sm = $sub_menu[$i];
            RoleMenu::create([
                'id_role'=>$id,
                'id_menu'=>$id_sm,
                'tipe'=> 'sub_menu'
            ]);
        }

        return "Success";
    }
}
