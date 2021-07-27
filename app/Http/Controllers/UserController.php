<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserController extends Controller
{
    public function index()
    {
    	return view('setting.user.index');
    }

    public function getData()
    {
    	$data = User::orderBy('name','ASC')->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" class="edit btn btn-primary btn-sm editUser"><i class="fa fa-edit"></i></a> ';

                       $btn .=' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" class="hapus btn btn-danger btn-sm deleteUser"><i class="fa fa-trash"></i></a>';
                       

                        return $btn;

                })
                ->addColumn('role', function($row){
                	$user = User::where("id", $row->id)->first();
                	$nama_role = $user->roles()->pluck('name')->first();
                	return $nama_role;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function edit($id)
    {
    	$user = User::find($id);
    	$id_role = $user->roles()->pluck('id')->first();
    	$nama_role = $user->roles()->pluck('name')->first();

    	$output = array(
    		'id_role'=> $id_role,
    		'nama_role'=>$nama_role,
    		'id'=>$user->id,
    		'name'=>$user->name,
    		'email'=>$user->email,
    		'username'=>$user->username
    	);

    	return $output;
    }

    public function update(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required|max:255',
            'password' => 'same:confirm-password',
            'id_role' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 422);
        }

        if ($request->password=='' || $request->password==null) {
        	$user = User::find($request->id);
        	$user->update([
        		'name'=>$request->name,
        		'email'=>$request->email,
        		'username'=>$request->username,
        	]);

        	$role = Role::where('id',$request->id_role)->first();
        	$user->roles()->detach();
        	$user->roles()->attach($role);
        }else{
        	$password = bcrypt($request->passowrd);
        	$user = User::find($request->id);
        	$user->update([
        		'name'=>$request->name,
        		'email'=>$request->email,
        		'username'=>$request->username,
        		'password'=>$password
        	]);

        	$role = Role::where('id',$request->id_role)->first();
        	$user->roles()->detach();
        	$user->roles()->attach($role);
        }

        return 'success';
    }

    public function store(Request $request)
    {

    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users|max:255',
            'password' => 'required|same:confirm-password',
            'id_role' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 422);
        }

    	$role = Role::where('id',$request->id_role)->first();

		$user = new User();
		$user->name = $request->name;
		$user->email = $request->email;
		$user->username = $request->username;
		$user->password = bcrypt($request->password);
		$user->save();
		$user->roles()->attach($role);

		return "success";
    }

    public function searchRole(Request $request){
    	if ($request->has('q')) {
            $cari = $request->q.'%';
            $data = Role::select('id', 'name')->where('name', 'like', $cari)->get();
            return response()->json($data);
        }
    }

    public function delete($id)
    {
    	$user = User::find($id);
    	$user->delete();

    	return "success";
    }
}
