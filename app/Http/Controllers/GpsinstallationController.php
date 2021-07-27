<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\GpsImport;
use App\Gps_installation;
use App\Customer;
use App\Nomor_polisi;
use App\Merk;
use App\Customer_address;


use Yajra\Datatables\Datatables;

use Maatwebsite\Excel\Facades\Excel;

class GpsinstallationController extends Controller
{
    public function index()
    {
		$gps = \App\Gps_installation::all();
		$data = \App\Gps_installation::all();
		$customer = \App\Customer::all();
		$merk = \App\Merk::all();



        return view('gps_installation.index',compact('gps','data','customer','merk'));
	}
	
	public function getdata()		//index
    {
        $gps = Gps_installation::with('customer')->get();    // untuk Nampilin field relasi relasi
 
        return Datatables::of($gps)
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

    public function add()
    {
		$customer=\App\Customer::all();
		$nopol=\App\Nomor_polisi::all();
		$merk=\App\Merk::all();

        return view('gps_installation.add',compact('customer','nopol','merk'));
	}
	
	public function store(Request $request)
    {
      
        $gpsinstall = new Gps_installation;
		$gpsinstall->id_customer = $request->id_customer;
		$gpsinstall->no_polisi = $request->no_polisi;
		$gpsinstall->po_customer_number = $request->po_customer_number;
		$gpsinstall->po_customer_date = $request->po_customer_date;
		$gpsinstall->imei = $request->imei;
		$gpsinstall->gsm_number = $request->gsm_number;
		$gpsinstall->merk = $request->merck;
		$gpsinstall->type = $request->type;
		$gpsinstall->gsm_provider = $request->gsm_provider;
		$gpsinstall->gps_owned_by = $request->gps_owned_by;
		$gpsinstall->gps_status = $request->gps_status;
		$gpsinstall->gps_install_date = $request->gps_install_date;
		$gpsinstall->gps_uninstall_date = $request->gps_uninstall_date;
		$gpsinstall->remarks = $request->remarks;
		$gpsinstall->fuel_sensor = $request->fuel_sensor;
		$gpsinstall->door_sensor = $request->door_sensor;
		$gpsinstall->door_sensor_remarks = $request->door_sensor_remarks;
		$gpsinstall->immobilizer_sensor = $request->immobilizer_sensor;
		$gpsinstall->rfid_sensor = $request->rfid_sensor;
		$gpsinstall->temperature_sensor = $request->temperature_sensor;
		$gpsinstall->temperature_sensor_remarks = $request->temperature_sensor_remarks;
		$gpsinstall->button_sensor = $request->button_sensor;
		$gpsinstall->button_sensor_remarks = $request->button_sensor_remarks;
		$gpsinstall->dump_sensor = $request->dump_sensor;
		$gpsinstall->tail_sensor = $request->tail_sensor;
		$gpsinstall->camera_sensor = $request->camera_sensor;
		$gpsinstall->pust_to_talk = $request->pust_to_talk;
		$gpsinstall->gps_port = $request->gps_port;
		$gpsinstall->installation_location = $request->installation_location;
		$gpsinstall->oslog_status = $request->oslog_status;
		$gpsinstall->oslog_inactive_date = $request->oslog_inactive_date;
		$gpsinstall->oslog_active_date = $request->oslog_active_date;
		$gpsinstall->gsm_terminated_date = $request->gsm_terminated_date;
		$gpsinstall->ex_no_polisi = $request->ex_no_polisi;
		$gpsinstall->ex_imei = $request->ex_imei;
		$gpsinstall->ex_gsm_number = $request->ex_gsm_number;
		$gpsinstall->note = $request->note;
        // $gpsinstall->created_by= auth()->user()->name;

               
        $gpsinstall->save();

        return redirect('/add_gps_installation');
	}

	public function dataModal($id)
    {
		
        $val = Gps_installation::where('id',$id)->first();
        $output = array(
            'id'=>$val->id,
			'id_customer'=>$val->id_customer,
			'no_polisi'=>$val->no_polisi,
			'po_customer_number'=>$val->po_customer_number,
			'po_customer_date'=>$val->po_customer_date,
			'imei'=>$val->imei,
			'gsm_number'=>$val->gsm_number,
			'merk'=>$val->merk,
			'type'=>$val->type,
			'gsm_provider'=>$val->gsm_provider,
			'gps_owned_by'=>$val->gps_owned_by,
			'gps_status'=>$val->gps_status,
			'gps_install_date'=>$val->gps_install_date,
			'gps_uninstall_date'=>$val->gps_uninstall_date,
			'remarks'=>$val->remarks,
			'fuel_sensor'=>$val->fuel_sensor,
			'door_sensor'=>$val->door_sensor,
			'door_sensor_remarks'=>$val->door_sensor_remarks,
			'immobilizer_sensor'=>$val->immobilizer_sensor,
			'rfid_sensor'=>$val->rfid_sensor,
			'temperature_sensor'=>$val->temperature_sensor,
			'temperature_sensor_remarks'=>$val->temperature_sensor_remarks,
			'button_sensor'=>$val->button_sensor,
			'button_sensor_remarks'=>$val->button_sensor_remarks,
			'dump_sensor'=>$val->dump_sensor,
			'tail_sensor'=>$val->tail_sensor,
			'camera_sensor'=>$val->camera_sensor,
			'pust_to_talk'=>$val->pust_to_talk,
			'gps_port'=>$val->gps_port,
			'installation_location'=>$val->installation_location,
			'oslog_status'=>$val->oslog_status,
			'oslog_inactive_date'=>$val->oslog_inactive_date,
			'oslog_active_date'=>$val->oslog_active_date,
			'gsm_terminated_date'=>$val->gsm_terminated_date,
			'ex_no_polisi'=>$val->ex_no_polisi,
			'ex_imei'=>$val->ex_imei,
			'ex_gsm_number'=>$val->ex_gsm_number,
			'note'=>$val->note,
			// 'customer_id'=>$val->customer->id,      // buat nampilin value yang relasi

	
           
        );
        return $output;
    }

    public function update(Request $request)
    {
            
            $gps_installation = Gps_installation::where('id',$request->id);
            $gps_installation->update([
				'id_customer'=>$request->id_customer,
				'no_polisi'=>$request->no_polisi,
				'po_customer_number'=>$request->po_customer_number,
				'po_customer_date'=>$request->po_customer_date,
				'imei'=>$request->imei,
				'gsm_number'=>$request->gsm_number,
				'merk'=>$request->merk,
				'type'=>$request->type,
				'gsm_provider'=>$request->gsm_provider,
				'gps_owned_by'=>$request->gps_owned_by,
				'gps_status'=>$request->gps_status,
				'gps_install_date'=>$request->gps_install_date,
				'gps_uninstall_date'=>$request->gps_uninstall_date,
				'remarks'=>$request->remarks,
				'fuel_sensor'=>$request->fuel_sensor,
				'door_sensor'=>$request->door_sensor,
				'door_sensor_remarks'=>$request->door_sensor_remarks,
				'immobilizer_sensor'=>$request->immobilizer_sensor,
				'rfid_sensor'=>$request->rfid_sensor,
				'temperature_sensor'=>$request->temperature_sensor,
				'temperature_sensor_remarks'=>$request->temperature_sensor_remarks,
				'button_sensor'=>$request->button_sensor,
				'button_sensor_remarks'=>$request->button_sensor_remarks,
				'dump_sensor'=>$request->dump_sensor,
				'tail_sensor'=>$request->tail_sensor,
				'camera_sensor'=>$request->camera_sensor,
				'pust_to_talk'=>$request->pust_to_talk,
				'gps_port'=>$request->gps_port,
				'installation_location'=>$request->installation_location,
				'oslog_status'=>$request->oslog_status,
				'oslog_inactive_date'=>$request->oslog_inactive_date,
				'oslog_active_date'=>$request->oslog_active_date,
				'gsm_terminated_date'=>$request->gsm_terminated_date,
				'ex_no_polisi'=>$request->ex_no_polisi,
				'ex_imei'=>$request->ex_imei,
				'ex_gsm_number'=>$request->ex_gsm_number,
				'note'=>$request->note,
	
		

        ]);
        return "success";
    }
	
	// public function detail($id)
    // {
	// 	$gps = \App\Gps_installation::where('id',$id)->FirstOrFail();
    //     return view('gps_installation.detail',compact('gps'));
	// }

	public function detail($id)
    {

        $val = Gps_installation::with(["customer"])->select("*")->where('gps_installation.id',$id)->first();
        // dd($val->request_media['id']);   

                    $output = array(
                    'id'=>$val->id,
					'customer'=>$val->customer['name'],
					'no_polisi'=>$val->no_polisi,
					'po_customer_number'=>$val->po_customer_number,
					'po_customer_date'=>$val->po_customer_date,
					'imei'=>$val->imei,
					'gsm_number'=>$val->gsm_number,
					'merk'=>$val->merk,
					'type'=>$val->type,
					'gsm_provider'=>$val->gsm_provider,
					'gps_owned_by'=>$val->gps_owned_by,
					'gps_status'=>$val->gps_status,
					'gps_install_date'=>$val->gps_install_date,
					'gps_uninstall_date'=>$val->gps_uninstall_date,
					'remarks'=>$val->remarks,
					'fuel_sensor'=>$val->fuel_sensor,
					'door_sensor'=>$val->door_sensor,
					'door_sensor_remarks'=>$val->door_sensor_remarks,
					'immobilizer_sensor'=>$val->immobilizer_sensor,
					'rfid_sensor'=>$val->rfid_sensor,
					'temperature_sensor'=>$val->temperature_sensor,
					'temperature_sensor_remarks'=>$val->temperature_sensor_remarks,
					'button_sensor'=>$val->button_sensor,
					'button_sensor_remarks'=>$val->button_sensor_remarks,
					'dump_sensor'=>$val->dump_sensor,
					'tail_sensor'=>$val->tail_sensor,
					'camera_sensor'=>$val->camera_sensor,
					'pust_to_talk'=>$val->pust_to_talk,
					'gps_port'=>$val->gps_port,
					'installation_location'=>$val->installation_location,
					'oslog_status'=>$val->oslog_status,
					'oslog_inactive_date'=>$val->oslog_inactive_date,
					'oslog_active_date'=>$val->oslog_active_date,
					'gsm_terminated_date'=>$val->gsm_terminated_date,
					'ex_no_polisi'=>$val->ex_no_polisi,
					'ex_imei'=>$val->ex_imei,
					'ex_gsm_number'=>$val->ex_gsm_number,
					'note'=>$val->note,
                    
                       
                    );

            return $output;   
            }

	public function destroy($id)
	{
		$gps_instalation = Gps_installation::find($id);
		$gps_instalation->delete();
		return response()->json(['success'=>'Gps Installation deleted successfully.']);
	}

	// public function destroy($id)
    // {
    //         $gps = Gps_installation::where('id',$id);
    //         $gps->delete();
    //         return redirect('/gps_installation');
    // }

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
		Excel::import(new GpsImport, public_path('/images/'.$nama_file));
 
		// notifikasi dengan session
		// Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('/gsm');
	}

}
