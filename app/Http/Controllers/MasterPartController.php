<?php

namespace App\Http\Controllers;

use App\Masterpart;
use App\Merk;
use App\Series;
use App\Type;

use Yajra\Datatables\Datatables;
use App\Imports\PartImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class MasterPartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $part = \App\Masterpart::all();
        $edit = \App\Masterpart::all();
        $series = \App\Series::all();
        $type = \App\Type::all();
        $merk = \App\Merk::all();

        $series_edit = \App\Series::all();
        $type_edit = \App\Type::all();
        $merk_edit = \App\Merk::all();

        // $series=Series::select('id','series')->get(); 
        // $type=Type::select('id','type')->get();
        // $type1=Type::select('id','type')->get();
        // $merk=Merk::select('id','merk')->get(); 
        // $merk1=Merk::select('id','merk')->get(); 

        return view('part.home',compact('part','series','type','merk','edit','merk_edit','type_edit','series_edit'));
    }

    public function getdata()
    {
        $part = Masterpart::all();     // untuk Nampilin field relasi relasi
 
        return Datatables::of($part)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            $btn = '<a data-id="'.$row->id.'" class="btn btn-primary btn-sm editBtn" href="javascript:void(0)"><i class="fa fa-pencil"></i></a> ';
            $btn .= ' <a data-id="'.$row->id.'" class="btn btn-danger btn-sm hapusBtn" href="javascript:void(0)"><i class="fa fa-trash"></i></a> ';
            // $btn .= ' <a data-id="'.$row->id.'" class="btn btn-info btn-sm detailBtn" href="javascript:void(0)"><i class="fa fa-eye"></i></a> ';
            return $btn;
            // $button = '<a href="javascript:void(0)" data-toggle="tooltip" name="edit"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
            // $button .= '&nbsp;&nbsp;';
            // $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
            // return $button;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type=Type::select('id','type')->get();
        $merk=Merk::select('id','merk')->get();
        $series=Series::select('id','series')->get();
        return view('part.create_mp',compact('type','merk','series'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        $Masterpart = new Masterpart;
        $Masterpart->part = $request->part;
        $Masterpart->series = $request->series;
        $Masterpart->type = $request->type;
        $Masterpart->merk = $request->merk;
        $Masterpart->uom = $request->uom;
        // $Masterpart->serialized_code = $request->sc;
        $Masterpart->created_by= auth()->user()->name;

       
        $Masterpart->save();

        return redirect('/create_mp');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $part = Masterpart::where('id',$id)->FirstOrFail();
        $series=Series::select('id','series')->get(); 
        $type=Type::select('id','type')->get();
        $type1=Type::select('id','type')->get();
        $merk=Merk::select('id','merk')->get(); 
        $merk1=Merk::select('id','merk')->get();  
 
        return view('part.edit_part', compact('part','series','type','merk','type1','merk1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function dataModal($id)
    {
        $val = Masterpart::where('id',$id)->first();
        $output = array(
            'id'=>$val->id,
            'part'=>$val->part,
            'series'=>$val->series,
            'type'=>$val->type,
            'merk'=>$val->merk,
            'uom'=>$val->uom,
            'serialized_code'=>$val->serialized_code,
            
        );
        return $output;
    }

    public function update(Request $request)
    {
        // $this->validate($request, [

        //     'part' => 'required|unique:master_part,part',
            // 'part' => 'required|integer',

        // ]);
        
         
        $part = Masterpart::where('id',$request->id);
        $part->update([
                    'part'=>$request->part,
                    'series'=>$request->series,
                    'type'=>$request->type,
                    'merk'=>$request->merk,
                    'uom'=>$request->uom,
                    'serialized_code'=>$request->serialized_code,
                    

            ]);
            return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            // $part = Masterpart::where('id',$id);
            // $part->delete();
            // return redirect('/home');
        
        $part = Masterpart::find($id);
        $part->delete();
        return response()->json(['success'=>'part deleted successfully.']);
    }

    public function detailData($id)
    {
        $val = Masterpart::where('id',$id);
               


            $output = array(
                'part'=>$val->k_part,
                'id_series'=>$val->k_id_series,
                'id_type'=>$val->id_type,
                'id_merk'=>$val->k_id_merk,
                'uom'=>$val->k_uom,
            );
        
        
        return Response::json($output);   
    }

    public function coba()
    {
        $part = \App\Masterpart::all();

        return view('modal',compact('part'));
    }
    

    public function excelImport(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
  
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('images',$nama_file);
    
		// import data
		Excel::import(new PartImport, public_path('/images/'.$nama_file));
 
		
		// alihkan halaman kembali
		return redirect('/home');
	}
}
