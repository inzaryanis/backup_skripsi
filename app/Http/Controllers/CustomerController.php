<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Business_type;
use App\Business_conduct;
use Yajra\Datatables\Datatables;
use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;




class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = \App\Customer::where('active_ind','Y')->first();
        $bt = \App\Business_type::all();
        $bc = \App\Business_conduct::all();
      
        return view('customer.customer',compact('customer','bt','bc'));
    }
    public function getdata()
    {
        $customer = Customer::where('active_ind','Y')->get();     // untuk Nampilin field relasi relasi
 
        return Datatables::of($customer)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            $btn = '<a data-id="'.$row->id.'" class="btn btn-primary btn-sm editBtn" href="javascript:void(0)"><i class="fa fa-edit"></i></a> ';
            $btn .= ' <a data-id="'.$row->id.'" class="btn btn-danger btn-sm hapusBtn" href="javascript:void(0)"><i class="fa fa-trash"></i></a> ';
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
        $bt = \App\Business_type::all();
        $bc = \App\Business_conduct::all();
        // $cb = \App\Control_by::all();
        return view('customer.create_customer',compact('bt','bc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

        'name' => 'required|unique:customer,name',

        ]);
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->short_name = $request->sn;
        $customer->business_type = $request->bt;
        $customer->business_conduct = $request->bc;
        $customer->npwp = $request->npwp;
        $customer->remarks = $request->remarks;
        $customer->code_name = $request->code_name;
        // $customer->active_ind = $request->ai;
        // $customer->control_by = $request->cb;
        $customer->created_by= auth()->user()->name;

               
        $customer->save();

        return redirect('/create_customer');
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
        // $customer = Customer::where('id',$id)->FirstOrFail();
        // $bt=Business_type::select('id','business_type')->get();
        // $bc=Business_conduct::select('id','business_conduct')->get();  
        // return view('customer.edit_customer', compact('customer','bt','bc'));
    }

    public function dataModal($id)
    {
        $val = Customer::where('id',$id)->first();
        $output = array(
            'id'=>$val->id,
            'name'=>$val->name,
            'short_name'=>$val->short_name,
            'business_type'=>$val->business_type,
            'business_conduct'=>$val->business_conduct,
            'npwp'=>$val->npwp,
            'remarks'=>$val->remarks,
            'active_ind'=>$val->active_ind,
            'control_by'=>$val->control_by,
           
        );
        return $output;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $this->validate($request, [

            // 'name' => 'required|unique:customer,name',
            // 'npwp' => 'required|integer',
    
            // ]);
            
            $customer = Customer::where('id',$request->id);
            $customer->update([
                'name'=>$request->name,
                'short_name'=>$request->short_name,
                'business_type'=>$request->bt,
                'business_conduct'=>$request->bc,
                'npwp'=>$request->npwp,
                'remarks'=>$request->remarks,
                // 'active_ind'=>$request->ai,
                'control_by'=>$request->control_by,
                'updated_by'=>auth()->user()->name,

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
        // Customer::where('id',$id)->delete();
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json(['success'=>'customer deleted successfully.']);
    }

    public function store_bt(Request $request)
    {
        $bt = new Business_type;
        $bt->business_type = $request->bt;
       
        $bt->save();

        return redirect('/create_customer');
    }

    public function store_bc(Request $request)
    {
        $bc = new Business_conduct;
        $bc->business_conduct = $request->bc;
       
        $bc->save();

        return redirect('/create_customer');
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
        Excel::import(new CustomerImport, public_path('/images/'.$nama_file));
        
 
		// notifikasi dengan session
		// Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('/customer');
	}
}
