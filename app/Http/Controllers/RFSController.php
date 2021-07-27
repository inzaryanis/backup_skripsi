<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rfs;
use App\Nommor_polisi;
use Yajra\Datatables\Datatables;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Customer;
use App\Customer_contact;
use App\Internal;
use App\Office_type;
use App\Nomor_polisi;
use App\Union_nomor_polisi;
use App\Masterpart;
use App\Gps_installation;
use App\Complain_task;
use App\Request_task;
use App\Imports\RfsImport;
use Maatwebsite\Excel\Facades\Excel;






class RFSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_api()
    {
        // $rfs = \App\RFS::all();
        // return view('rfs.rfs',compact('rfs'));

        $rfs = Rfs::all();
        return response()->json($rfs);

        
    }
    public function index()
    {
        $rfs = \App\Rfs::all();
        $rm = \App\Request_media::all();
        // $data = $request->session()->all();
        $nopol = \App\Nomor_polisi::all();
        $customer = \App\Customer::all();
        $cr = \App\Internal::all();
        


        return view('rfs.index',compact('rfs','rm','nopol','customer','cr')); 
    }

    public function getdata()
    {
        $rfs = Rfs::with(['request_media','customer','customer_contact'])->get();     // untuk Nampilin field relasi relasi
 
        return Datatables::of($rfs)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            $btn = '<a data-id="'.$row->id.'" class="btn btn-primary btn-sm editBtn" href="javascript:void(0)"><i class="fa fa-edit"></i></a> ';
            $btn .= ' <a data-id="'.$row->id.'" class="btn btn-danger btn-sm hapusBtn" href="javascript:void(0)"><i class="fa fa-trash"></i></a> ';
            $btn .= ' <a data-id="'.$row->id.'" class="btn btn-info btn-sm detailBtn" href="javascript:void(0)"><i class="fa fa-eye"></i></a> ';

            return $btn;
            // $button = '<a href="javascript:void(0)" data-toggle="tooltip" name="edit"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
            // $button .= '&nbsp;&nbsp;';
            // $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
            // return $button;
        })
        ->addColumn('nopol',function($row){
            $nopol = Union_nomor_polisi::with(['Gps_installation'])->select('*')->where('id_request_for_service',$row->id)->get();
            $btn = '<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> nopol </button>
                <div class="dropdown-menu">';
                     foreach ($nopol as $nopol){
                       $btn .='<a class="dropdown-item" >'.$nopol->Gps_installation->no_polisi.'</a>';
                    }
            
            $btn .= '</div>';


            return $btn;
           })
		   ->addColumn('company_requestor',function($row){
            // dd($row);
			   return $row->Company_requestor();
           })
        //    ->addColumn('task',function($row){
        //     return $row->task();
        // })
        ->rawColumns(['action','nopol'])
        ->make(true);

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function nopol($id)
    {
        
        $nopol = Union_nomor_polisi::select('id_nomor_polisi')->where('id_request_for_service',$id)->get();


        return view('rfs.create',compact('rm','data','nopol','customer'));
    }

    public function create(Request $request)
    {
        
        $rm = \App\Request_media::all();
        $data = $request->session()->all();
        // $nopol = \App\Nomor_polisi::all();
        $customer = \App\Customer::all();

        return view('rfs.create',compact('rm','data','customer'));
    }

    
    public function requestor_pic($id){
        $pic = Customer_contact::where('id_customer',$id)->get();
        return response()->json([
            'data'=>$pic
        ]);
    }

    public function getPhone($id){

        
        $phone = Customer_contact::where('id',$id)->first();
        return response()->json([
            'data'=>$phone
        ]);
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
                $rfs = new Rfs; 
                $rfs->rfs_number = IdGenerator::generate(['table' => 'rfs', 'field' => 'rfs_number', 'length' => 5 , 'prefix'=>'0']);     
                $rfs->request_type = $request->request_type;
                $rfs->request_date = $request->request_date;
                $rfs->request_from = $request->request_from;
                $rfs->request_date = $request->request_date;
                $rfs->request_media = $request->request_media;
                $rfs->company_requestor = $request->company_requestor;
                $rfs->company = $request->company;
                $rfs->id_requestor_pic = $request->requestor_pic;
                // $rfs->date_from = $request->date_from;
                $rfs->phone_number = $request->phone_number;
                $rfs->task = $request->task;
                $rfs->task_description = $request->task_description;
                $rfs->location = $request->location;
                $rfs->response_date = $request->response_date;
                // $rfs->nomor_polisi = $request->nopol[$i];
                $rfs->response_by = $request->response_by;
                $rfs->response_input_by = auth()->user()->name;
                $rfs->response_media = $request->response_media;
                $rfs->status = $request->status;
                $rfs->status_description = $request->status_description;
                // $rfs->response_duration = $rfs->request_date-$rfs->response_date;
                $rfs->created_by= auth()->user()->name;
                // $data = $request->data;
                // dd($data);
        
        
        
                // $rfs->status = $request->status;
                // if($request->hasfile('lampiran')){
                //     $request->file('lampiran')->move('images/', $request->file('lampiran')->getClientOriginalName());
                //     $rfs->lampiran=$request->file('lampiran')->getClientOriginalName();
                // }        
        
                $rfs->save();

                // $nopol = $request->nomor_polisi;
                
            foreach($request->nomor_polisi as $i => $prc ){
                $nopol = new Union_nomor_polisi;
                $nopol->id_request_for_service = $rfs->id;
                $nopol->id_nomor_polisi = $request->nomor_polisi[$i];
                $nopol->created_by= auth()->user()->name;

                $nopol->save();
            }
                return redirect('/create_rfs'); 
        }
        
        
        

        // return response()->json([
        //     [
        //         'status'=>true,
        //         'code'=>200,
        //         'message'=>'Data berhasil di simpan'
        //     ]
        // ]);


        // return response()->json([
        //     'successfully',
        //     $rfs
        //     ]);    }
    

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
        //
    }


    // public function update(Request $request, $id)
    // {
    //     $rfs=Rfs::where('id',$id)
    //     ->update([
    //             'status'=>"closed",     

    //     ]);
    //     return redirect('/rfs');
    // }

  
    public function destroy($id)
    {
        $rfs = Rfs::find($id);
        $rfs->delete();
        return response()->json(['success'=>'Rfs deleted successfully.']);

    }

    public function dataModal($id)
    {

        $val = Rfs::where('id',$id)->first();
		$nopol = array();
		if($val->request_from == "Eksternal")
			$nopol = Gps_installation::where('id_customer', $val->company_requestor)->get();
        $nopolSelected = array();
		foreach(Union_nomor_polisi::select('id_nomor_polisi')->where('id_request_for_service',$id)->get() as $row){
			$nopolSelected[] = $row->id_nomor_polisi;
		}
        // if ($tipe=="internal") {
        //     $data_internal = Internal::find($val->id);
        //     $val = array(
        //         'name'=>$data_internal->name,
        //     );
    	// }else {
        //     $data_eksternal = Customer::find($val->id);
        //     $val = array(
        //         'name'=>$data_eksternal->name
        //     ); 
    	// }

        $pic = Customer_contact::where('id_customer',$val->company_requestor)->get(); // buat nampilin select option pic berdasarkan customernya
		$cmp_requestor = Internal::all();
			if($val->request_from == "Eksternal")
				$cmp_requestor = Customer::all();

         $req_type = Request_task::all();
           if($val->request_type == "Complain")
                 $req_type = Complain_task::all();        
                    $output = array(
                    'id'=>$val->id,
                    'rfs_number'=>$val->rfs_number,
                    'request_date'=>$val->request_date,
                    'request_type'=>$val->request_type,
                    'request_from'=>$val->request_from,
                    'request_media'=>$val->request_media,
                    'company_requestor'=>$val->company_requestor,
                    'company'=>$val->company,
                    'id_requestor_pic'=>$val->id_requestor_pic,
                    'phone_number'=>$val->phone_number,
                    'task'=>$val->task,
                    'task_description'=>$val->task_description,
                    'location'=>$val->location,
                    // 'nomor_polisi'=>$val->nomor_polisi,
                    'response_date'=>$val->response_date,
                    'response_by'=>$val->response_by,
                    'response_input_by'=>$val->response_input_by,
                    'response_media'=>$val->response_media,
                    'status'=>$val->status,
                    'status_description'=>$val->status_description,
                    'response_duration'=>$val->response_duration,

                    'nopol'=>$nopol,
                    'nopolSelected'=>$nopolSelected,
                    'cmp_requestor'=>$cmp_requestor,
                    'pic'=>$pic,
                    'req_type'=>$req_type,



                    // 'id_request_media'=>$val->request_media->id,      // buat nampilin value yang relasi
                   
                    );

            return $output;   
            }
        

            public function update(Request $request)
            {
                    
                    $rfs = Rfs::where('id',$request->id);
                    $rfs->update([
                        'request_date'=>$request->request_date,
                        'request_type'=>$request->request_type,
                        'request_from'=>$request->request_from,
                        'request_media'=>$request->request_media,
                        'company_requestor'=>$request->company_requestor,
                        'company'=>$request->company,
                        'id_requestor_pic'=>$request->requestor_pic,
                        'phone_number'=>$request->phone_number,
                        'task'=>$request->task,
                        'task_description'=>$request->task_description,
                        'location'=>$request->location,
                        // 'nomor_polisi'=>$request->nomor_polisi,
                        'response_date'=>$request->response_date,
                        'response_by'=>$request->response_by,
                        'response_input_by'=>$request->response_input_by,
                        'response_media'=>$request->response_media,
                        'status'=>$request->status,
                        'status_description'=>$request->status_description,
                        'response_duration'=>$request->response_duration,
                        // 'updated_by'=>auth()->user()->name,
        
                ]);
                $limit = count($request->nomor_polisi);
                $data_nopol = $request->nomor_polisi;
                
                $union_now = Union_nomor_polisi::where("id_request_for_service", $request->id);
                $union_now->delete();   
                

                for ($i=0; $i < $limit; $i++) { 
                    $nopol = new Union_nomor_polisi;
                    $nopol->id_request_for_service = $request->id;
                    $nopol->id_nomor_polisi = $data_nopol[$i];
                    $nopol->save();
                }
                return "success";
            }

    public function detail($id)
    {

        $val = Rfs::with(["customer_contact",'request_task','complain_task','customer','internal'])->select("*")->where('rfs.id',$id)->first();
        // dd($val->request_media['id']);   


        //================ buat  company requestor kalo internal ngambilnya dari tabel internal , kalo eksternal ngambilnya dari tabel customer ================================
        $company_requestor = Internal::where('id',$val->company_requestor)->first();
        if($val->request_from == "Eksternal")
              $company_requestor = customer::where('id',$val->company_requestor)->first();
        //================ buat task kalo complain ngambilnya dari tabel complain , kalo request ngambilnya dari tabel request ================================
        $task = Request_task::where('id',$val->task)->first();
        if($val->request_type == "Complain")
              $task = Complain_task::where('id',$val->task)->first();
                    $output = array(
                    'id'=>$val->id,
                    'rfs_number'=>$val->rfs_number,
                    'request_date'=>$val->request_date,
                    'request_type'=>$val->request_type,
                    'request_from'=>$val->request_from,
                    'request_media'=>$val->request_media,
                    // 'company_requestor'=>$val->company_requestor,
                    'company'=>$val->company,
                    'customer_contact'=>$val->customer_contact['person_name'],
                    'phone_number'=>$val->phone_number,
                    'task_description'=>$val->task_description,
                    'location'=>$val->location,
                    'nomor_polisi'=>$val->nomor_polisi,
                    'response_date'=>$val->response_date,
                    'response_by'=>$val->response_by,
                    'response_input_by'=>$val->response_input_by,
                    'response_media'=>$val->response_media,
                    'status'=>$val->status,
                    'status_description'=>$val->status_description,
                    'response_duration'=>$val->response_duration,
                    'created_at'=>$val->created_at,
                    'created_by'=>$val->created_by,
                    'updated_at'=>$val->updated_at,
                    'updated_by'=>$val->updated_by,
                    // 'req_type'=>$req_type
                    'task'=>$task['name_task'],
                    'company_requestor'=>$company_requestor['name'],


                       
                    );

            return $output;   
            }

// ============= pilihan internal eksternal otomatis ===================================
    public function requestFrom($jenis)
    {
        if($jenis=='Internal'){
            $customer = Internal::all();
            return response()->json([
                'jenis'=>'inter',
                'data'=>$customer
                ]);

        }else if($jenis=='Eksternal'){
            $customer = Customer::all();
            return response()->json([
                'jenis'=>'eks',
                'data'=>$customer
                ]);

        }
    }

    // ============= pilihan complain Request otomatis ===================================
    public function requestType($jenis)
    {
        if($jenis=='Request'){
            $task = Request_task::all();
            return response()->json([
                'jenis'=>'req',
                'data'=>$task
                ]);

        }else if($jenis=='Complain'){
            $task = Complain_task::all();
            return response()->json([
                'jenis'=>'com',
                'data'=>$task
                ]);

        }
    }

// ============= pilihan nopol otomatis ===================================

public function companyRequestor($jenis)
{
    $customer = customer::all();
    if($jenis==$customer){
        $nopol = Nomor_polisi::where('id_customer',$jenis);
        return response()->json([
            'jenis'=>$customer,
            'data'=>$nopol
            ]);

    }else if($jenis=='Eksternal'){
        $customer = Customer::all();
        return response()->json([
            'jenis'=>'eks',
            'data'=>$customer
            ]);

    }
}

public function getNopol($id){
    $nopol = Gps_installation::where('id_customer',$id)->get();
    return response()->json([
        'data'=>$nopol
    ]);
}

// =============================================================================================



    public function storeNopol(Request $request)
    {

        $nopol = new Nomor_polisi;
        $nopol->id_customer = $request->id_customer;
        $nopol->nomor_polisi = $request->nopol;
        // $merk->created_by= auth()->user()->name;

       
        $nopol->save();

        return redirect('/create_rfs');
       
    }

    public function storeSession(Request $request)
    {
        $request->session()->put('rfs'.$request->input('nopol'));
        echo "data telah di tambahkan";
    }
    public function getSession(Request $request)
    {
        if ($request->session()->get('nopol'))
        {
            echo $request->session()->get('nopol');
        }
        else
        {
            echo "data tidak ada";
        }
        // $request->session()->put('rfs'.$request->input('nopol'));
        // echo "data telah di tambahkan";
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
        Excel::import(new RfsImport, public_path('/images/'.$nama_file));
        
 
		// notifikasi dengan session
		// Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('/request');
	}
}
