<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gsm;
use App\Issue_to;
use App\Customer;

use App\Imports\GsmImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Session;



use Yajra\Datatables\Datatables;


class GSMController extends Controller
{
    public function index()
    {   
        $gsm = Gsm::all();
        $gsm_number_actived = Gsm::where('functional_status','inactive')->whereNull('activation_date_request')->get();
        $gsm_number_terminated = Gsm::where('functional_status','active')->whereNull('termination_date_request')->get();
        $update_terminated = Gsm::whereNotNull('termination_date_request')->whereNull('terminated_date')->get();
        $update_actived = Gsm::whereNotNull('activation_date_request')->whereNull('active_date')->get();    // ngambil data dimana field activation_date_request udh diisi dan active_date masih kosong 
        $issue_to = Issue_to::all();
        return view('gsm.gsm', compact('gsm','issue_to','gsm_number_actived','gsm_number_terminated','update_terminated','update_actived'));
    }

    public function getdata()
    {
        $gsm = Gsm::all();        // untuk Nampilin field relasi relasi
 
        return Datatables::of($gsm)
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

    //============================= nampilin Data  display request terminated =========================================
    public function Drt()
    {   
        $gsm = Gsm::all();
        $gsm_number_actived = Gsm::where('functional_status','inactive')->whereNull('activation_date_request')->get();
        $gsm_number_terminated = Gsm::where('functional_status','active')->whereNull('termination_date_request')->get();
        $update_terminated = Gsm::whereNotNull('termination_date_request')->whereNull('terminated_date')->get();
        $update_actived = Gsm::whereNotNull('activation_date_request')->whereNull('active_date')->get();    // ngambil data dimana field activation_date_request udh diisi dan active_date masih kosong 
        $issue_to = Issue_to::all();
        return view('gsm.request_terminate', compact('gsm','issue_to','gsm_number_actived','gsm_number_terminated','update_terminated','update_actived'));
    }

    public function getdataDRT()
    {
        $drt = Gsm::whereNotNull('termination_date_request')->whereNull('terminated_date')->get();      
 
        return Datatables::of($drt)
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

    //============================= nampilin Data  display GSM terminated =========================================
    public function DGT()
    {   
        $gsm = Gsm::all();
        $gsm_number_actived = Gsm::where('functional_status','inactive')->whereNull('activation_date_request')->get();
        $gsm_number_terminated = Gsm::where('functional_status','active')->whereNull('termination_date_request')->get();
        $update_terminated = Gsm::whereNotNull('termination_date_request')->whereNull('terminated_date')->get();
        $update_actived = Gsm::whereNotNull('activation_date_request')->whereNull('active_date')->get();    // ngambil data dimana field activation_date_request udh diisi dan active_date masih kosong 
        $issue_to = Issue_to::all();
        return view('gsm.gsm_terminate', compact('gsm','issue_to','gsm_number_actived','gsm_number_terminated','update_terminated','update_actived'));
    }

    public function getdataDGT()
    {
        $drt = Gsm::where('functional_status','terminate')->get();      
 
        return Datatables::of($drt)
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


      //============================= nampilin Data  display request Actived =========================================
      public function Dra()
      {   
          $gsm = Gsm::all();
          $gsm_number_actived = Gsm::where('functional_status','inactive')->whereNull('activation_date_request')->get();
          $gsm_number_terminated = Gsm::where('functional_status','active')->whereNull('termination_date_request')->get();
          $update_terminated = Gsm::whereNotNull('termination_date_request')->whereNull('terminated_date')->get();
          $update_actived = Gsm::whereNotNull('activation_date_request')->whereNull('active_date')->get();    // ngambil data dimana field activation_date_request udh diisi dan active_date masih kosong 
          $issue_to = Issue_to::all();
          return view('gsm.request_actived', compact('gsm','issue_to','gsm_number_actived','gsm_number_terminated','update_terminated','update_actived'));
      }
  
      public function getdataDRA()
      {
          $drt = Gsm::whereNotNull('activation_date_request')->whereNull('active_date')->get();      
   
          return Datatables::of($drt)
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
  
      //============================= nampilin Data  display GSM Actived =========================================
      public function DGA()
      {   
          $gsm = Gsm::all();
          $gsm_number_actived = Gsm::where('functional_status','inactive')->whereNull('activation_date_request')->get();
          $gsm_number_terminated = Gsm::where('functional_status','active')->whereNull('termination_date_request')->get();
          $update_terminated = Gsm::whereNotNull('termination_date_request')->whereNull('terminated_date')->get();
          $update_actived = Gsm::whereNotNull('activation_date_request')->whereNull('active_date')->get();    // ngambil data dimana field activation_date_request udh diisi dan active_date masih kosong 
          $issue_to = Issue_to::all();
          return view('gsm.gsm_actived', compact('gsm','issue_to','gsm_number_actived','gsm_number_terminated','update_terminated','update_actived'));
      }
  
      public function getdataDGA()
      {
          $drt = Gsm::where('functional_status','active')->get();      
   
          return Datatables::of($drt)
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

      

    public function dataModal($id)
    {
        $val = Gsm::where('id',$id)->first();
        $output = array(
                    'id'=>$val->id,
                    'gsm_number'=>$val->gsm_number,
                    'serial_number'=>$val->serial_number,
                    'receipt_date'=>$val->receipt_date,
                    'issue_date'=>$val->issue_date,
                    'issue_to'=>$val->issue_to,
                    'activation_date_request'=>$val->activation_date_request,
                    'activation_status'=>$val->activation_status,
                    'active_date'=>$val->active_date,
                    'termination_date_request'=>$val->termination_date_request,
                    'terminated_date'=>$val->terminated_date,
                    'termination_remarks'=>$val->termination_remarks,
                    'condition'=>$val->condition,
                    'functional_status'=>$val->functional_status,
                    'vendor'=>$val->vendor,
                    'remarks'=>$val->remarks,

        );
        return $output;
    }

    public function update(Request $request)
    {
       $gsm = Gsm::where('id',$request->id);
            $gsm->update([
                    'gsm_number'=>$request->gsm_number,
                    'serial_number'=>$request->serial_number,
                    'receipt_date'=>$request->receipt_date,
                    'issue_date'=>$request->issue_date,
                    'issue_to'=>$request->issue_to,
                    'activation_date_request'=>$request->activation_date_request,
                    'activation_status'=>$request->activation_status,
                    'active_date'=>$request->active_date,
                    'termination_date_request'=>$request->termination_date_request,
                    'terminated_date'=>$request->terminated_date,
                    'termination_remarks'=>$request->termination_remarks,
                    'condition'=>$request->condition,
                    'functional_status'=>$request->functional_status,
                    'vendor'=>$request->vendor,
                    'remarks'=>$request->remarks,
                    'updated_by'=>auth()->user()->name,

        ]);
        return "success";
    }


    public function detail($id)
    {

        $val = Gsm::with(["customer"])->select("*")->where('gsm.id',$id)->first();
        // dd($val->request_media['id']);   

                    $output = array(
                    'id'=>$val->id,
                    'gsm_number'=>$val->gsm_number,
                    'serial_number'=>$val->serial_number,
                    'receipt_date'=>$val->receipt_date,
                    'issue_date'=>$val->issue_date,
                    'issue_to'=>$val->issue_to,
                    'activation_date_request'=>$val->activation_date_request,
                    'activation_status'=>$val->activation_status,
                    'active_date'=>$val->active_date,
                    'termination_date_request'=>$val->termination_date_request,
                    'terminated_date'=>$val->terminated_date,
                    'termination_remarks'=>$val->termination_remarks,
                    'condition'=>$val->condition,
                    'functional_status'=>$val->functional_status,
                    'vendor'=>$val->vendor,
                    'remarks'=>$val->remarks,
                    'customer'=>$val->customer['name'],     // company
                    'nomor_polisi'=>$val->nomor_polisi,
                    'keterangan'=>$val->keterangan,
                    'created_at'=>$val->created_at,
                    'created_by'=>$val->created_by,
                    'updated_at'=>$val->updated_at,
                    'updated_by'=>$val->updated_by
                       
                    );

            return $output;   
            }

    public function receipt(Request $request)
    {
       
        $receipt = new Gsm;
        $receipt->gsm_number = $request->gsm_number;
        $receipt->serial_number = $request->serial_number;
        $receipt->receipt_date = $request->receipt_date;
        $receipt->issue_date = $request->receipt_date;
        $receipt->issue_to = 'IU-JKT';
        $receipt->condition = 'New';
        $receipt->functional_status = 'inactive';
        $receipt->vendor = $request->vendor;

        $receipt->created_by= auth()->user()->name;

               
        $receipt->save();

        return redirect()->back();
    }


    // =====================    tampilan nomor gsm berdasarkan pilihan option  ============================


                public function option($jenis)
            {
                $gsm_number = Gsm::all();
                if($jenis=='add gsm'){
                    $gsm_number = Customer::all();
                    return response()->json([
                        'jenis'=>'eks',
                        'data'=>$customer
                        ]);

                }else if($jenis=='display gsm'){
                     $gsm_number = Gsm::where('functional_status','inactive');
                     return response()->json([
                        'jenis'=>'display',
                        'data'=>$gsm_number
                        ]);

                }
            }

            public function getGsmnumber(){
                $gsm_number = Gsm::where('functional_status','inactive')->get();
                return response()->json([
                    'data'=>$gsm_number
                ]);
            }


    // public function option($jenis)
    // {
    //     if($jenis=='display gsm'){
    //         $option = Gsm::all();
    //         return response()->json([
    //             'jenis'=>'display',
    //             'data'=>$option
    //             ]);

    //     }else if($jenis=='add gsm'){
    //         $option = Customer::all();
    //         return response()->json([
    //             'jenis'=>'add',
    //             'data'=>$option
    //             ]);

    //     }
    // }

    public function issued(Request $request)
    {
        // dd($request->issue_date);
        // $i = 0;
        foreach ($request->gsm_number_issued as $item) {

            // $data[] = $item;
            $get_gsm = Gsm::where('id', $item)->first();
            $get_gsm->issue_date = $request->issue_date;
            $get_gsm->issue_to = $request->issue_to;
            $get_gsm->updated_by= auth()->user()->name;
            $get_gsm->save();

            // $i++;

        }
        
        return redirect('/gsm');

    }

    public function actived(Request $request)
    {
        // dd($request->all());
        // $i = 0;
        foreach ($request->gsm_number_actived as $jenis) {

            // $data[] = $item;
            $actived = Gsm::where('id', $jenis)->first();
            $actived->activation_date_request = $request->activation_date_request;
            // $actived->activation_status = 'SUCCESS';
            // $actived->active_date = $request->active_date;
            // $actived->functional_status = 'active';
            $actived->updated_by= auth()->user()->name;


            $actived->save();

            // $i++;

        }
        
        return redirect('/gsm');

    }

    public function updateActived(Request $request)
    {
       
        foreach ($request->update_actived as $jenis) {

           
            $actived = Gsm::where('id', $jenis)->first();
            $actived->activation_status = 'SUCCESS';
            $actived->active_date = $request->active_date;
            $actived->functional_status = 'active';
            $actived->updated_by= auth()->user()->name;


            $actived->save();

        }
        
        return redirect('/gsm');

    }

    public function terminated(Request $request)
    {
        // dd($request->all());
        // $i = 0;
        foreach ($request->gsm_number_terminated as $i) {

            // $data[] = $item;
            $terminated = Gsm::where('id', $i)->first();
            $terminated->termination_date_request = $request->termination_date_request;
            $terminated->terminated_date = $request->terminated_date;
            $terminated->functional_status = 'terminate';
            $terminated->updated_by= auth()->user()->name;


            $terminated->save();

            // $i++;

        }
        
        return redirect('/gsm');

    }

    public function terminated2(Request $request)
    {
        // dd($request->all());
        // $i = 0;
        foreach ($request->gsm_number_terminated as $i) {

            // $data[] = $item;
            $terminated = Gsm::where('id', $i)->first();
            $terminated->termination_date_request = $request->termination_date_request;
            $terminated->updated_by= auth()->user()->name;


            $terminated->save();

            // $i++;

        }
        
        return redirect('/gsm');

    }
    public function updateTerminated(Request $request)
    {
        // dd($request->all());
        // $i = 0;
        foreach ($request->updated_terminated as $i) {

            // $data[] = $item;
            $terminated = Gsm::where('id', $i)->first();
            $terminated->terminated_date = $request->terminated_date;
            $terminated->functional_status = 'terminate';
            $terminated->updated_by= auth()->user()->name;


            $terminated->save();

            // $i++;

        }
        
        return redirect('/gsm');

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
		Excel::import(new GsmImport, public_path('/images/'.$nama_file));
 
		// notifikasi dengan session
		// Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('/gsm');
	}


}
