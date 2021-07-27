<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use App\Role;
use App\RoleMenu;
use App\Menu;
use App\SubMenu;
use App\MenuSection;

class MenuController extends Controller
{
    public function index(){
    	return view('setting.menu.index');
    }

    

    public function dataMenu(){
    	$data = Menu::orderBy('nama','ASC')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-tipe="menu" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm editMenu"><i class="fa fa-edit"></i></a> ';

                       $btn .=' <a href="javascript:void(0)" data-toggle="tooltip" data-tipe="menu" data-id="'.$row->id.'" class="hapus btn btn-danger btn-sm deleteMenu"><i class="fa fa-trash"></i></a>';
                       

                        return $btn;

                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function dataMenuSection(){
    	$data = MenuSection::orderBy('nama','ASC')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-tipe="menu_section" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm editMenu"><i class="fa fa-edit"></i></a> ';

                       $btn .=' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Hapus" data-tipe="menu_section" class="hapus btn btn-danger btn-sm deleteMenu"><i class="fa fa-trash"></i></a>';
                       

                        return $btn;

                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function dataSubMenu(){
    	$data = SubMenu::orderBy('nama','ASC')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-tipe="sub_menu" data-id="'.$row->id.'"  class="edit btn btn-primary btn-sm editMenu"><i class="fa fa-edit"></i></a> ';

                       $btn .=' <a href="javascript:void(0)" data-toggle="tooltip" data-tipe="sub_menu" data-id="'.$row->id.'" class="hapus btn btn-danger btn-sm deleteMenu"><i class="fa fa-trash"></i></a>';
                       

                        return $btn;

                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function destroy($id,$tipe){
        $id_role = session('id_role');
    	if($tipe=="menu_section"){
    		$data = MenuSection::find($id);
            $data2 = RoleMenu::where("id_menu",$id)->where('id_role',$id_role)->where("tipe","menu_section");
    		$data->delete();
            $data2->delete();
    	}else if($tipe=="menu"){
    		$data  = Menu::find($id);
            $data2 = RoleMenu::where("id_menu",$id)->where('id_role',$id_role)->where("tipe","menu"); 
    		$data->delete();
            $data2->delete();
    	}else if($tipe=="sub_menu"){
    		$data = SubMenu::find($id);
            $data2 = RoleMenu::where("id_menu",$id)->where('id_role',$id_role)->where("tipe","sub_menu");
    		$data->delete();
            $data2->delete();
    	}
    	return "Success";
    }

    public function searchMenu(Request $request){
    	if ($request->has('q')) {
            $cari = $request->q.'%';
            $data = Menu::select('id', 'nama')->where("url","#")->where('nama', 'like', $cari)->get();
            return response()->json($data);
        }
    }

    public function searchMenuSection(Request $request){
    	if ($request->has('q')) {
            $cari = $request->q.'%';
            $data = MenuSection::select('id', 'nama')->where('nama', 'like', $cari)->get();
            return response()->json($data);
        }
    }

    public function storeMenuSection(Request $request){

    	$validator = Validator::make($request->all(), [
            'nama' => 'required|unique:menu_section|max:255'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 422);
        }

    	$menu = MenuSection::create([
    		'nama' => $request->nama
    	]);

    	$id = $menu->id;

    	$id_admin = Role::where("name",'Admin')->first();

    	RoleMenu::create([
    		'id_role'=>$id_admin->id,
    		'id_menu'=>$id,
    		'tipe'=>'menu_section'
    	]);

    	return response()->json(['success'=>'Menu Section Berhasil Dibuat!']);
    }

    public function storeMenu(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'nama' => 'required|unique:menu|max:255'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 422);
        }

        $url = $request->url;
        if($url==null || $url=="" || $url==Null){
            $url = "#";
        }
    	$menu = Menu::create([
    		'nama' => $request->nama,
    		'id_ms' => $request->id_ms,
    		'url' => $url,
    		'icon' => $request->icon
    	]);

    	$id = $menu->id;

    	$id_admin = Role::where("name",'Admin')->first();

    	RoleMenu::create([
    		'id_role'=>$id_admin->id,
    		'id_menu'=>$id,
    		'tipe'=>'menu'
    	]);

    	return response()->json(['success'=>'Menu Berhasil Dibuat!']);
    }

    public function storeSubMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:menu|max:255',
            'url' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 422);
        }

        $url = $request->url;

        $menu = new SubMenu;
        $menu->url = $url;
        $menu->nama = $request->nama;
        $menu->id_menu = $request->id_menu;
        $menu->save();
        $id = $menu->id;

        $id_admin = Role::where("name",'Admin')->first();

        RoleMenu::create([
            'id_role'=>$id_admin->id,
            'id_menu'=>$id,
            'tipe'=>'sub_menu'
        ]);

        return response()->json(['success'=>'Menu Berhasil Dibuat!']);
    }

    public function editMenu($id,$tipe)
    {
    	if ($tipe=="menu_section") {
    		$data = MenuSection::find($id);
    	}else if ($tipe=="menu") {
    		$data = Menu::find($id);
            $data_ms = MenuSection::find($data->id_ms);
            $data = array(
                'nama_ms'=>$data_ms->nama,
                'nama'=>$data->nama,
                'url'=>$data->url,
                'icon'=>$data->icon,
                'id_ms'=>$data->id_ms,
                'id'=>$data->id
            );
    	}else {
    		$data = SubMenu::find($id);
            $data_menu = Menu::find($data->id_menu);
            $data = array(
                'nama'=>$data->nama,
                'id'=>$data->id,
                'url'=>$data->url,
                'id_menu'=>$data->id_menu,
                'nama_menu'=>$data_menu->nama
            );
    	}

    	return $data;
    }

    public function updateMenu(Request $request){

    	$tipe = $request->tipe;
    	if ($tipe=="menu_section") {

    		$data = MenuSection::find($request->id);

    		$data->update([
    			'nama'=>$request->nama
    		]);

    	}else if ($tipe=="menu") {

    		$data = Menu::find($request->id);

            $data->update([
                'nama'=>$request->nama,
                'url'=>$request->url,
                'icon'=>$request->icon,
                'id_ms'=>$request->id_ms
            ]);

    	}else if ($tipe=="sub_menu"){

            $data = SubMenu::where('id',$request->id)
            ->update([
                'nama'=>$request->nama,
                'url'=>$request->url,
                'id_menu'=>$request->id_menu
            ]);

    	}

    	return response()->json(['success'=>'Menu Berhasil Diupdate!']);
    }
}
