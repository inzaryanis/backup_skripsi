<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer_contact;
use App\Customer;
use App\Customer_address;
use App\contact_type;
use App\religion;
use Yajra\Datatables\Datatables;




class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = \App\Customer_contact::all();
        $customer = \App\Customer::all();
        $contact_type = \App\Contact_type::all();
        $religion = \App\Religion::all();

        $ca = \App\Customer_address::all();


        return view('customer.contact',compact('contact', 'customer','contact_type', 'religion','ca'));
    }

    public function getdata()
    {
        $contact = Customer_contact::with(['customer','customer_address'])->get();     // untuk Nampilin field relasi relasi
 
        return Datatables::of($contact)
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = \App\Customer::all();
        $ca = \App\Customer_address::all();
        $ct = \App\Contact_type::all();
        $religion = \App\Religion::all();

        return view('customer.create_contact',compact('customer','ca','ct','religion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contact = new Customer_contact;
        $contact->id_customer = $request->customer;
        $contact->id_customer_address = $request->ca;
        $contact->contact_type = $request->ct;
        $contact->person_name = $request->person_name;
        $contact->religion = $request->religion;
        $contact->gender = $request->gender;
        $contact->birth_date = $request->birth_date;
        $contact->phone_mobile = $request->phone_mobile;
        $contact->phone_fixed = $request->phone_fixed;
        $contact->email_address = $request->email;
        // $contact->active_ind = $request->ai;
        $contact->created_by= auth()->user()->name;

        
               
        $contact->save();

        return redirect('/create_contact');
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
    public function dataModal($id)
    {
   
        $val = Customer_contact::where('id',$id)->first();

        $address = Customer_address::where('id_customer',$val->id_customer)->get();     // buat nampilin select option address text berdasarkan customernya

        $output = array(
            'id'=>$val->id,
            'id_customer'=>$val->id_customer,
            'id_customer_address'=>$val->id_customer_address,
            'contact_type'=>$val->contact_type,
            'person_name'=>$val->person_name,
            'religion'=>$val->religion,
            'gender'=>$val->gender,
            'birth_date'=>$val->birth_date,
            'phone_mobile'=>$val->phone_mobile,
            'phone_fixed'=>$val->phone_fixed,
            'email_address'=>$val->email_address,
            'active_ind'=>$val->active_ind,
            'customer_id'=>$val->customer->id,      // buat nampilin value yang relasi

            'address'=>$address,

           
        );
        return $output;
    }

  
    public function update(Request $request)
    {
         $contact = Customer_contact::where('id',$request->id);
            $contact->update([
            'id_customer'=>$request->customer,
            'id_customer_address'=>$request->ca,
            'contact_type'=>$request->contact_type,
            'person_name'=>$request->person_name,
            'religion'=>$request->religion,
            'gender'=>$request->gender,
            'birth_date'=>$request->birth_date,
            'phone_mobile'=>$request->phone_mobile,
            'phone_fixed'=>$request->phone_fixed,
            'email_address'=>$request->email_address,
            'active_ind'=>$request->active_ind,
            'updated_by'=> auth()->user()->name,

            // 'updated_by'=>$request->auth()->user()->name,

        ]);
        return "success";
    }

    public function detail($id)
    {

        $val = Customer_contact::with(["customer","customer_address"])->select("*")->where('customer_contact.id',$id)->first();
                    $output = array(
                        'id'=>$val->id,
                        'customer'=>$val->customer['name'],
                        'customer_address'=>$val->customer_address['address_text'],
                        'request_media'=>$val->request_media['request_media'],

                        'contact_type'=>$val->contact_type,
                        'person_name'=>$val->person_name,
                        'religion'=>$val->religion,
                        'gender'=>$val->gender,
                        'birth_date'=>$val->birth_date,
                        'phone_mobile'=>$val->phone_mobile,
                        'phone_fixed'=>$val->phone_fixed,
                        'email_address'=>$val->email_address,
                        'active_ind'=>$val->active_ind,
                    );

            return $output;   
            }

    public function destroy($id)
    {
        $contact = Customer_contact::find($id);
        $contact->delete();
        return response()->json(['success'=>'contact deleted successfully.']);
    }


 
    public function address_contact($id){
        $address = Customer_address::where('id_customer',$id)->get();
        return response()->json([
            'data'=>$address
        ]);
}
}
