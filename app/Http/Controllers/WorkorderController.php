<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

use\App\Customer;
use\App\Teknisi;
use\App\BAP;
use\App\Gsm;
use\App\SPK;
use\App\Spk_detail;
use\App\Gps_installation;

use\App\Customer_address;

use Yajra\Datatables\Datatables;


use Haruncpi\LaravelIdGenerator\IdGenerator;





class WorkorderController extends Controller
{

        // ============================ Home Work Order =============================================================

    public function index()
    {
        // $part = \App\Masterpart::all();
        


        return view('work order.index');
    }
        // ============================ End Home Work Order =============================================================



    // ============================ Instalation & Mutation =============================================================

    public function install()
    {

        $install = \App\BAP::all();
        $edit = \App\BAP::all();
        $detail = \App\BAP::all();

        $customer = \App\Customer::all();
        $teknisi = \App\Teknisi::all();
        $teknisi2 = \App\Teknisi::all();
        $teknisi3 = \App\Teknisi::all();
        $teknisi4 = \App\Teknisi::all();
        $gsm = \App\Gsm::all();

       
        return view('work order.install', compact('customer','teknisi','teknisi2','teknisi3','teknisi4','gsm','install',
                    'edit'));
    }

    public function getdataInstall()
    {
        $install = BAP::with(['customer','gsm'])->get();     
        // untuk Nampilin field relasi relasi
 
 // dd($install);
        return Datatables::of($install)
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
    public function create_bap()
    {
        $customer = \App\Customer::all();
        $teknisi = \App\Teknisi::all();
        $teknisi2 = \App\Teknisi::all();
        $teknisi3 = \App\Teknisi::all();
        $teknisi4 = \App\Teknisi::all();
        $gsm = \App\Gsm::where('functional_status','active')->whereNull('company')->get();



        return view('work order.create_bap', compact('customer','teknisi','teknisi2','teknisi3','teknisi4','gsm'));
    }

        public function storeBap(Request $request)
        {
                $bap = new BAP; 
                $bap->bap_number = IdGenerator::generate(['table' => 'bap', 'field' => 'bap_number', 'length' => 9 , 'prefix'=>'BAP-']); 
                $bap->bap_date = $request->bap_date;
                $bap->id_customer = $request->id_customer;
                $bap->nomor_polisi = $request->nomor_polisi;
                $bap->po_number = $request->po_number;
                $bap->po_date = $request->po_date;
                $bap->vehicle_type = $request->vehicle_type;
                $bap->vehicle_number = $request->vehicle_number;
                $bap->odometer = $request->odometer;
                $bap->installation_location = $request->installation_location;
                $bap->vehicle_battery = $request->vehicle_battery;
                $bap->fuel_tank_capacity = $request->fuel_tank_capacity;
                $bap->fuel_ratio = $request->fuel_ratio;
                $bap->fuel_type = $request->fuel_type;
                $bap->remarks = $request->remarks;
                $bap->job_type = $request->job_type;
                $bap->ex_nomor_polisi = $request->ex_nomor_polisi;
                $bap->spk_number = $request->spk_number;
                $bap->gps_type = $request->gps_type;
                $bap->imei = $request->imei;
                $bap->gsm_number = $request->gsm_number;
                $bap->technical_check = $request->technical_check;
                $bap->technical_check_remarks = $request->technical_check_remarks;
                $bap->fuel_sensor = $request->fuel_sensor;
                $bap->door_sensor = $request->door_sensor;
                $bap->door_sensor_remarks = $request->door_sensor_remarks;
                $bap->immobilizer_sensor = $request->immobilizer_sensor;
                $bap->rfid_sensor = $request->rfid_sensor;
                $bap->temperature_sensor = $request->temperature_sensor;
                $bap->temperature_sensor_remarks = $request->temperature_sensor_remarks;
                $bap->button_sensor = $request->button_sensor;
                $bap->button_sensor_remarks = $request->button_sensor_remarks;
                $bap->dump_sensor = $request->dump_sensor;
                $bap->tail_sensor = $request->tail_sensor;
                $bap->camera_sensor = $request->camera_sensor;
                $bap->pust_to_talk = $request->pust_to_talk;
                $bap->gps_port = $request->gps_port;
                $bap->technician_1 = $request->technician_1;
                $bap->technician_2 = $request->technician_2;
                $bap->technician_3 = $request->technician_3;
                $bap->technician_4 = $request->technician_4;

                if($request->hasfile('attachment1')){
                    $request->file('attachment1')->move('attachment/', $request->file('attachment1')->getClientOriginalName());
                    $bap->attachment1=$request->file('attachment1')->getClientOriginalName();
                }

                if($request->hasfile('attachment2')){
                    $request->file('attachment2')->move('attachment/', $request->file('attachment2')->getClientOriginalName());
                    $bap->attachment2=$request->file('attachment2')->getClientOriginalName();
                }

                if($request->hasfile('attachment3')){
                    $request->file('attachment3')->move('attachment/', $request->file('attachment3')->getClientOriginalName());
                    $bap->attachment3=$request->file('attachment3')->getClientOriginalName();
                }

                if($request->hasfile('attachment4')){
                    $request->file('attachment4')->move('attachment/', $request->file('attachment4')->getClientOriginalName());
                    $bap->attachment4=$request->file('attachment4')->getClientOriginalName();
                }

                if($request->hasfile('attachment5')){
                    $request->file('attachment5')->move('attachment/', $request->file('attachment5')->getClientOriginalName());
                    $bap->attachment5=$request->file('attachment5')->getClientOriginalName();
                }
                // $bap->attachment1 = $request->attachment1;
                // $bap->attachment2 = $request->attachment2;
                // $bap->attachment3 = $request->attachment3;
                // $bap->attachment4 = $request->attachment4;
                // $bap->attachment5 = $request->attachment5;


                

            $bap->save();
            


            // ============= update ke tabel gsm  berdasarkan gsm number yg dipilih   ======================================
            // dd($request->gsm_number);
                $update_gsm = Gsm::where('id', $request->gsm_number)->first();
                // dd($update_gsm);
                // $update_gsm = new Gsm;
                $update_gsm->company = $request->id_customer;
                $update_gsm->nomor_polisi = $request->nomor_polisi;
                $update_gsm->updated_by= auth()->user()->name;
                $update_gsm->save();
    
    
            
            return redirect('/create_bap');
        }
        

        public function dataModalBap($id)
        {
            $val = BAP::where('id',$id)->first();
            $output = array(
               'id'=>$val->id,
               'bap_date'=>$val->bap_date,
               'id_customer'=>$val->id_customer,
               'nomor_polisi'=>$val->nomor_polisi,
               'po_number'=>$val->po_number,
               'po_date'=>$val->po_date,
               'vehicle_type'=>$val->vehicle_type,
               'vehicle_number'=>$val->vehicle_number,
               'odometer'=>$val->odometer,
               'installation_location'=>$val->installation_location,
               'vehicle_battery'=>$val->vehicle_battery,
               'fuel_tank_capacity'=>$val->fuel_tank_capacity,
               'fuel_ratio'=>$val->fuel_ratio,
               'fuel_type'=>$val->fuel_type,
               'remarks'=>$val->remarks,
               'job_type'=>$val->job_type,
               'ex_nomor_polisi'=>$val->ex_nomor_polisi,
               'spk_number'=>$val->spk_number,
               'gps_type'=>$val->gps_type,
               'imei'=>$val->imei,
               'gsm_number'=>$val->gsm_number,
               'technical_check'=>$val->technical_check,
               'technical_check_remarks'=>$val->technical_check_remarks,
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
               'technician_1'=>$val->technician_1,
               'technician_2'=>$val->technician_2,
               'technician_3'=>$val->technician_3,
               'technician_4'=>$val->technician_4,
               'attachment1'=>$val->attachment1,
               'attachment2'=>$val->attachment2,
               'attachment3'=>$val->attachment3,
               'attachment4'=>$val->attachment4,
               'attachment5'=>$val->attachment5,

                
            );
            return $output;
        }
    
        public function updateBap(Request $request)
        {
            $attachment1= '';
            $attachment2= '';
            $attachment3= '';
            $attachment4= '';
            $attachment5= '';
            if($request->hasfile('attachment1')){
                    $request->file('attachment1')->move('attachment/', $request->file('attachment1')->getClientOriginalName());
                    $attachment1=$request->file('attachment1')->getClientOriginalName();
                }

                if($request->hasfile('attachment2')){
                    $request->file('attachment2')->move('attachment/', $request->file('attachment2')->getClientOriginalName());
                    $attachment2=$request->file('attachment2')->getClientOriginalName();
                }

                if($request->hasfile('attachment3')){
                    $request->file('attachment3')->move('attachment/', $request->file('attachment3')->getClientOriginalName());
                    $attachment3=$request->file('attachment3')->getClientOriginalName();
                }

                if($request->hasfile('attachment4')){
                    $request->file('attachment4')->move('attachment/', $request->file('attachment4')->getClientOriginalName());
                    $attachment4=$request->file('attachment4')->getClientOriginalName();
                }

                if($request->hasfile('attachment5')){
                    $request->file('attachment5')->move('attachment/', $request->file('attachment5')->getClientOriginalName());
                    $attachment5=$request->file('attachment5')->getClientOriginalName();
                }
          
            $bap = BAP::where('id',$request->id);
            $bap->update([
                'bap_date'=>$request->bap_date,
                'id_customer'=>$request->id_customer,
                'nomor_polisi'=>$request->nomor_polisi,
                'po_number'=>$request->po_number,
                'po_date'=>$request->po_date,
                'vehicle_type'=>$request->vehicle_type,
                'vehicle_number'=>$request->vehicle_number,
                'odometer'=>$request->odometer,
                'installation_location'=>$request->installation_location,
                'vehicle_battery'=>$request->vehicle_battery,
                'fuel_tank_capacity'=>$request->fuel_tank_capacity,
                'fuel_ratio'=>$request->fuel_ratio,
                'fuel_type'=>$request->fuel_type,
                'remarks'=>$request->remarks,
                'job_type'=>$request->job_type,
                'ex_nomor_polisi'=>$request->ex_nomor_polisi,
                'spk_number'=>$request->spk_number,
                'gps_type'=>$request->gps_type,
                'imei'=>$request->imei,
                'gsm_number'=>$request->gsm_number,
                'technical_check'=>$request->technical_check,
                'technical_check_remarks'=>$request->technical_check_remarks,
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
                'technician_1'=>$request->technician_1,
                'technician_2'=>$request->technician_2,
                'technician_3'=>$request->technician_3,
                'technician_4'=>$request->technician_4,
                'attachment1'=>$attachment1,
                'attachment2'=>$attachment2,
                'attachment3'=>$attachment3,
                'attachment4'=>$attachment4,
                'attachment5'=>$attachment5,
                        
    
                ]);
                return "success";
        }


        public function detailBap($id)
        {
            $val = BAP::with(["customer"])->select("*")->where('bap.id',$id)->first();
            // dd($val->request_media['id']);   
                        $output = array(
                        'id'=>$val->id,
                        'customer'=>$val->customer['name'],
                        'bap_date'=>$val->bap_date,                        //untuk menampilkan field relasi dengan value huruf, bukan angka. id_ di hapus
                        'nomor_polisi'=>$val->nomor_polisi,
                        'po_number'=>$val->po_number,
                        'po_date'=>$val->po_date,
                        'vehicle_type'=>$val->vehicle_type,
                        'vehicle_number'=>$val->vehicle_number,
                        'odometer'=>$val->odometer,
                        'installation_location'=>$val->installation_location,
                        'vehicle_battery'=>$val->vehicle_battery,
                        'fuel_tank_capacity'=>$val->fuel_tank_capacity,
                        'fuel_ratio'=>$val->fuel_ratio,
                        'fuel_type'=>$val->fuel_type,
                        'remarks'=>$val->remarks,
                        'job_type'=>$val->job_type,
                        'ex_nomor_polisi'=>$val->ex_nomor_polisi,
                        'spk_number'=>$val->spk_number,
                        'gps_type'=>$val->gps_type,
                        'imei'=>$val->imei,
                        'gsm_number'=>$val->gsm_number,
                        'technical_check'=>$val->technical_check,
                        'technical_check_remarks'=>$val->technical_check_remarks,
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
                        'technician_1'=>$val->technician_1,
                        'technician_2'=>$val->technician_2,
                        'technician_3'=>$val->technician_3,
                        'technician_4'=>$val->technician_4,
                        'attachment1'=>$val->attachment1,
                        'attachment2'=>$val->attachment2,
                        'attachment3'=>$val->attachment3,
                        'attachment4'=>$val->attachment4,
                        'attachment5'=>$val->attachment5,
                        
                        
                           
                        );
                return $output;   
                }
    
                public function destroy_bap($id)
                {
                    $bap = BAP::find($id);
                    $bap->delete();
                    return response()->json(['success'=>'BAP deleted successfully.']);
                }

    

    // ============================ End Instalation & Mutation =============================================================


    // ============================ Maintenance =============================================================


    public function maintenance()
    {
        // $part = \App\Masterpart::all();
        $spk = \App\SPK::all();

        $customer_edit = \App\Customer::all();
        $teknisi_edit = \App\Teknisi::all();
        $teknisi2_edit = \App\Teknisi::all();
        $teknisi3_edit = \App\Teknisi::all();
        $teknisi4_edit = \App\Teknisi::all();
        $gsm_edit = \App\Gsm::all();
        $imei_edit = \App\Gps_installation::all();
        $Gps_installation = \App\Gps_installation::all();

        return view('work order.maintenance',compact('spk','customer_edit','teknisi_edit','teknisi2_edit','teknisi3_edit','teknisi4_edit','gsm_edit','imei_edit','Gps_installation'));
    }

    // public function detailSpk($id)
    // {

    //     $spk =SPK::where('id',$id)->First();
    //     $spk_tabel = Spk_detail::where('id_spk',$spk->id)->get();


    //     return view('work order.detail_spk',compact('spk','spk_tabel'));
    // }

    public function create_spk()
    {

        $customer = \App\Customer::all();
        $teknisi = \App\Teknisi::all();
        $Gps_installation = \App\Gps_installation::all();
        $imei = \App\Gps_installation::select();


        return view('work order.create_spk', compact('customer','teknisi', 'Gps_installation'));
    }

    public function storeSpk(Request $request)
    {
            $spk = new SPK; 
            $spk->spk_number = IdGenerator::generate(['table' => 'spk', 'field' => 'spk_number', 'length' => 9 , 'prefix'=>'SPK-']); 
            $spk->id_customer = $request->id_customer;
            $spk->spk_date = $request->spk_date;
            $spk->job_type = $request->job_type;
            $spk->location = $request->location;
            $spk->pic_name = $request->pic_name;
            $spk->remarks = $request->remarks;
            $spk->start_name = $request->start_name;
            $spk->arrival_name = $request->arrival_name;
            $spk->finish_name = $request->finish_name;
            $spk->technician_1 = $request->technician_1;
            $spk->technician_2 = $request->technician_2;
            $spk->technician_3 = $request->technician_3;
            $spk->finish_name = $request->finish_name;



            $spk->save();

            foreach($request->item as $i => $prc ){      //buat multiple insert

            $spk_detail = new Spk_detail; 
            $spk_detail->id_spk = $spk->id;
            $spk_detail->item = $request->item[$i];
            $spk_detail->nomor_polisi = $request->nomor_polisi[$i];
            $spk_detail->imei = $request->imei[$i];
            $spk_detail->gsm_number = $request->gsm_number[$i];
            $spk_detail->problems = $request->problems[$i];
            $spk_detail->remarks_problems = $request->remarks_problems[$i];
            $spk_detail->gps_maintenance = $request->gps_maintenance[$i];
            $spk_detail->sensor_1 = $request->sensor_1[$i];
            $spk_detail->sensor_2 = $request->sensor_2[$i];
            $spk_detail->sensor_3 = $request->sensor_3[$i];


            $spk_detail->save();
            }
            return redirect('/create_spk');
    }

    public function getdataMaintenance()
    {
        $maintenance = SPK::with(['customer'])->get();     // untuk Nampilin field relasi relasi
 
        return Datatables::of($maintenance)
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

    public function dataModalSpk($id)
    {

        $val = SPK::where('id', $id)->first();
        $val_detail = Spk_detail::where('id_spk',$val->id)->get();
        $gsm = Gsm::all();
        
        $output = array(
           'id'=>$val->id,
           'spk_number'=>$val->spk_number,
           'spk_date'=>$val->spk_date,
           'id_customer'=>$val->id_customer,
           'job_type'=>$val->job_type,
           'location'=>$val->location,
           'pic_name'=>$val->pic_name,
           'arrival_name'=>$val->arrival_name,
           'start_name'=>$val->start_name,
           'finish_name'=>$val->finish_name,
           'technician_1'=>$val->technician_1,
           'technician_2'=>$val->technician_2,
           'technician_3'=>$val->technician_3,
           'technician_4'=>$val->technician_4,
           'remarks'=>$val->remarks,
           'val_detail'=>$val_detail,
           'gsm_number'=>$gsm,
           

           /*'item'=>$val_detail->item,
           'nomor_polisi'=>$val_detail->nomor_polisi,
           'imei'=>$val_detail->imei,
           'gsm_number'=>$val_detail->gsm_number,
           'problems'=>$val_detail->problems,
           'remarks_problems'=>$val_detail->remarks_problems,
           'gps_maintenance'=>$val_detail->gps_maintenance,
           'sensor_1'=>$val_detail->sensor_1,
           'sensor_2'=>$val_detail->sensor_2,
           'sensor_3'=>$val_detail->sensor_3,*/

         
           

            
        );
        return $output;
        // return response()->json(['val'=>$val,'val_detail'=>$val_detail]);
    }

    

    public function updateSpk(Request $request)
    {
        $spk=SPK::where('id',$request->id);
        $spk_detail = Spk_detail::where('id_spk',$request->id);
        $spk_detail->delete();

        $spk->update([
            'spk_date'=>$request->spk_date,
            'id_customer'=>$request->id_customer,
            'job_type'=>$request->job_type,
            'location'=>$request->location,
            'pic_name'=>$request->pic_name,
            'arrival_name'=>$request->arrival_name,
            'start_name'=>$request->start_name,
            'finish_name'=>$request->finish_name,
            'technician_1'=>$request->technician_1,
            'technician_2'=>$request->technician_2,
            'technician_3'=>$request->technician_3,
            'technician_4'=>$request->technician_4,
            'remarks'=>$request->remarks,
           
        ]);
        $item = explode(",",$request->item);
        $nomor_polisi = explode(",",$request->nomor_polisi);
        $imei = explode(",",$request->imei);
        $gsm_number = explode(",",$request->gsm_number);
        $problems = explode(",",$request->problems);
        $remarks_problems = explode(",",$request->remarks_problems);
        $gps_maintenance = explode(",",$request->gps_maintenance);
        $sensor_1 = explode(",",$request->sensor_1);
        $sensor_2 = explode(",",$request->sensor_2);
        $sensor_3 = explode(",",$request->sensor_3);
        

        for ($i=0; $i < $request->limit; $i++) { 
            
            $spk_detail = new Spk_detail; 
            $spk_detail->id_spk = $request->id;
            $spk_detail->item = $item[$i];
            $spk_detail->nomor_polisi = $nomor_polisi[$i];
            $spk_detail->imei = $imei[$i];
            $spk_detail->gsm_number = $gsm_number[$i];
            $spk_detail->problems = $problems[$i];
            $spk_detail->remarks_problems = $remarks_problems[$i];
            $spk_detail->gps_maintenance = $gps_maintenance[$i];
            $spk_detail->sensor_1 = $sensor_1[$i];
            $spk_detail->sensor_2 = $sensor_2[$i];
            $spk_detail->sensor_3 = $sensor_3[$i];


            $spk_detail->save();
        }

        // $spk_detail->update([
        //    'item'=>$request->item,
        //    'nomor_polisi'=>$request->nomor_polisi,
        //    'imei'=>$request->imei,
        //    'gsm_number'=>$request->gsm_number,
        //    'problems'=>$request->problems,
        //    'remarks_problems'=>$request->remarks_problems,
        //    'gps_maintenance'=>$request->gps_maintenance,
        //    'sensor_1'=>$request->sensor_1,
        //    'sensor_2'=>$request->sensor_2,
        //    'sensor_3'=>$request->sensor_3,   
        // ]);
        
        return "success";  
      }



    public function detailSpk($id)

    {

        $spk=  SPK::with(["customer"])->select("*")->where('spk.id',$id)->first();
        $spk_detail = Spk_detail::where('id_spk',$spk->id)->get();

                    $output = array(
                    'id'=>$spk->id,
                    'spk_number'=>$spk->spk_number,                                                       
                    'spk_date'=>$spk->spk_date,                                                       
                    'customer'=>$spk->customer['name'],                         
                    'job_type'=>$spk->job_type,   
                    // 'remarks'=>$spk->remarks,
                    'spk_detail'=>$spk_detail,
                            
                         
                    // 'spk'=>$spk_detail->spk['spk_number'], 
                    // 'nomor_polisi'=>$spk_detail->nomor_polisi,
                    // 'imei'=>$spk_detail->imei,                            
                    // 'gsm_number'=>$spk_detail->gsm_number,  
                   
                    );
                    return $output;   
                            // return response()->json(['spk'=>$spk,'spk_detail'=>$spk_detail]);

              
            }

            


    public function destroySpk($id)
    {
        $spk = SPK::find($id);
        $spk->delete();
        return response()->json(['success'=>'spk deleted successfully.']);
    }

     // ============================ End Maintenance =============================================================

}
