<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer_address;
use App\Customer;
use App\Office_type;
use Yajra\Datatables\Datatables;
use App\Imports\AddressImport;
use Maatwebsite\Excel\Facades\Excel;



class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = \App\Customer_address::all();
        $customer = \App\Customer::all();
        $ot = \App\Office_type::all();

        return view('customer.address',compact('address','customer','ot'));
    }
    public function getdata()
    {
        $customer_address = Customer_address::with('customer')->get();     // untuk Nampilin field relasi 
 
        return Datatables::of($customer_address)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            $btn = '<a data-id="'.$row->id.'" class="btn btn-primary btn-sm editBtn" href="javascript:void(0)"><i class="fa fa-edit"></i></a> ';
            $btn .= ' <a data-id="'.$row->id.'" class="btn btn-danger btn-sm hapusBtn" href="javascript:void(0)"><i class="fa fa-trash"></i></a> ';
            $btn .= ' <a data-id="'.$row->id.'" class="btn btn-info btn-sm detailBtn" href="javascript:void(0)"><i class="fa fa-eye"></i></a> ';

            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function detail($id)
    {

        $val = Customer_address::with(["customer"])->select("*")->where('customer_address.id',$id)->first();
        // dd($val->request_media['id']);   

                    $output = array(
                    'id'=>$val->id,
                    'customer'=>$val->customer['name'],
                    'id_office_type'=>$val->id_office_type,
                    'address_text'=>$val->address_text,
                    'first_address_line'=>$val->first_address_line,
                    'second_address_line'=>$val->second_address_line,
                    'third_address_line'=>$val->third_address_line,
                    'city_area'=>$val->city_area,
                    'postal_zip_code'=>$val->postal_zip_code,
                    'country_area'=>$val->country_area,
                    'active_ind'=>$val->active_ind,
                    'created_at'=>$val->created_at,
                    'created_by'=>$val->created_by,
                    'updated_at'=>$val->updated_at,
                    'updated_by'=>$val->updated_by
                       
                    );

            return $output;   
            }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = \App\Customer::all();
        $ot = \App\Office_type::all();
        return view('customer.create_address',compact('customer','ot'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address = new Customer_address;
        $address->id_customer = $request->customer;
        $address->office_type = $request->ot;
        $address->address_text = $request->address_text;
        $address->first_address_line = $request->first_address_line;
        $address->second_address_line = $request->second_address_line;
        $address->third_address_line = $request->third_address_line;
        $address->city_area = $request->city_area;
        $address->postal_zip_code = $request->postal_zip_code;
        $address->country_area = $request->country_area;
        // $address->active_ind = $request->ai;
        $address->created_by= auth()->user()->name;

        
               
        $address->save();

        return redirect('/create_address');
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
        // $address = Customer_address::where('id',$id)->FirstOrFail();
        // $customer=Customer::select('id','name')->get();
        // $ot=Office_type::select('id','office_type')->get();  
        // return view('customer.edit_address', compact('address','customer','ot'));
    }

    public function dataModal($id)
    {
        $val = Customer_address::where('id',$id)->first();
        $output = array(
            'id'=>$val->id,
            'customer'=>$val->customer,
            'office_type'=>$val->office_type,
            'address_text'=>$val->address_text,
            'first_address_line'=>$val->first_address_line,
            'second_address_line'=>$val->second_address_line,
            'third_address_line'=>$val->third_address_line,
            'city_area'=>$val->city_area,
            'postal_zip_code'=>$val->postal_zip_code,
            'country_area'=>$val->country_area,
            'active_ind'=>$val->active_ind,
            'customer_id'=>$val->customer->id,      // buat nampilin value yang relasi
            

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
        $address=Customer_address::where('id',$request->id);
        $address->update([
           'id_customer' => $request->customer,
           'office_type' => $request->ot,
           'address_text' => $request->address_text,
           'first_address_line' => $request->first_address_line,
           'second_address_line' => $request->second_address_line,
           'third_address_line' => $request->third_address_line,
           'city_area' => $request->city_area,
           'postal_zip_code' => $request->postal_zip_code,
           'country_area' => $request->country_area,
           'active_ind' => $request->active_ind,
           'updated_by'=> auth()->user()->name,
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
        $address = Customer_address::find($id);
        $address->delete();
        return response()->json(['success'=>'address deleted successfully.']);
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
        Excel::import(new AddressImport, public_path('/images/'.$nama_file));
        
 
		// notifikasi dengan session
		// Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('/customer_address');
	}
}
