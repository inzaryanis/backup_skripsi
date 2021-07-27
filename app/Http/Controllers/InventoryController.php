<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gps;
use App\Inventory;
use App\Material_receipt_header;
use App\Material_receipt_detail;
use App\Type;
use App\Masterpart;
use Yajra\Datatables\Datatables;
use Haruncpi\LaravelIdGenerator\IdGenerator;




class InventoryController extends Controller
{

     public function index()
    {
        $part = \App\Masterpart::all();
        $series = \App\Series::all();
        $type = \App\Type::all();
        $merk = \App\Merk::all();

        return view('inventory.index',compact('part','series','type','merk'));
    }

    public function material_receipt()
    {
        $part = \App\Masterpart::all();
        $series = \App\Series::all();
        $type = \App\Type::all();
        $merk = \App\Merk::all();

        return view('inventory.material_receipt',compact('part','series','type','merk'));
    }

    public function getdata()
    {
        $inventory = Inventory::with(['master_part'])->get();     // untuk Nampilin field relasi relasi
 
        return Datatables::of($inventory)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            $btn = '<a data-id="'.$row->id.'" class="btn btn-primary btn-sm editBtn" href="javascript:void(0)"><i class="fa fa-edit"></i></a> ';
            $btn .= ' <a data-id="'.$row->id.'" class="btn btn-danger btn-sm hapusBtn" href="javascript:void(0)"><i class="fa fa-trash"></i></a> ';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(Request $request)
    {
                // dd($request);
                $mrh = new Material_receipt_header; 
                $mrh->material_receipt_number = IdGenerator::generate(['table' => 'material_receipt_header', 'field' => 'material_receipt_number', 'length' => 9 , 'prefix'=>'OPS-']);     
                $mrh->po_number = $request->po_number;
                $mrh->po_date = $request->po_date;
                $mrh->contact = $request->contact;
                $mrh->address = $request->address;
                $mrh->vendor = $request->vendor;
                $mrh->phone = $request->phone;
                $mrh->fax = $request->fax;
                $mrh->tax = $request->tax;
                $mrh->shipping = $request->shipping;
                $mrh->other = $request->other;
                $mrh->currency = $request->currency;
                $mrh->total_po = $request->total_po;

                  
        
                $mrh->save();

                
                $mrd = $request->item;
                
                foreach($request->item as $i => $prc ){
                $mrd = new Material_receipt_detail;
                $mrd->material_receipt_number =$mrh->material_receipt_number;
                $mrd->item = $request->item[$i];
                $mrd->part = $request->part[$i];
                $mrd->imei = $request->imei[$i];
                $mrd->description = $request->description[$i];
                $mrd->type = $request->type[$i];
                $mrd->quantity = $request->quantity[$i];
                $mrd->unit_price = $request->unit_price[$i];

                
                $mrd->save();
                } 
                
                
                
                $inventory = $request->part;
                
                foreach($request->part as $i => $prc ){      //buat multiple insert
                    $cekPart = Inventory::where('id_part', $request->part[$i])->first();        // cek part sudah ada belum

                if ($cekPart != null) {
                    // $finalQty = Inventory::where('id_part', $i)->first();
                    $finalQty = $request->quantity[$i] + $cekPart->quantity;
                    Inventory::where('id_part', $cekPart->id_part)->update(['quantity' => $finalQty]);
                }else{
                
                    $inventory = new Inventory;
                    $inventory->id_part = $request->part[$i];
                    $inventory->quantity = $request->quantity[$i];
                    $inventory->created_by = auth()->user()->name;
                    $inventory->save();
                }
            }
                // dd($inventory);
              


                
                return redirect('/inventory');
            
        }

        public function storePart(Request $request)
        {
            $this->validate($request, [
    
                'part' => 'required|unique:master_part,part',
                // 'part' => 'required|integer',
    
            ]);
            $Masterpart = new Masterpart;
            $Masterpart->part = $request->part;
            $Masterpart->series = $request->series;
            $Masterpart->type = $request->type;
            $Masterpart->merk = $request->merk;
            $Masterpart->uom = $request->uom;
            // $Masterpart->serialized_code = $request->sc;
            $Masterpart->created_by= auth()->user()->name;
    
           
            $Masterpart->save();
    
            return redirect()->back();
        }
        


    public function getType($id){

        
        $part = Masterpart::where('id',$id)->first();
        return response()->json([
            'data'=>$part
        ]);
        }


        // ======================================== TOOLS ================================================
        public function tools()
        {
            $part = \App\Masterpart::all();
            $series = \App\Series::all();
            $type = \App\Type::all();
            $merk = \App\Merk::all();
    
            return view('inventory.tools',compact('part','series','type','merk'));
        }
    
        public function getTools()
        {

            // nampilin data dari tabel inventory, berdasarkan type partnya yg diliat dari table master_part
            $inventory = Inventory::with(['master_part'])->whereHas('master_part', function($q){            
                $q->where('type', '=', 'Tools');
            })->get();
            
              
            
            // $inventory = Inventory::with(['master_part' => function($q){
            //     $q->where("type","Tools");
            // }])->get();    
            // $inventory = Masterpart::where("type","Tools")->get();
            // dd($inventory);
            return Datatables::of($inventory)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '<a data-id="'.$row->id.'" class="btn btn-primary btn-sm editBtn" href="javascript:void(0)"><i class="fa fa-edit"></i></a> ';
                $btn .= ' <a data-id="'.$row->id.'" class="btn btn-danger btn-sm hapusBtn" href="javascript:void(0)"><i class="fa fa-trash"></i></a> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }


        // =================================== ACCESSORIES ===========================================================================

        public function accessories()
        {
            $part = \App\Masterpart::all();
            $series = \App\Series::all();
            $type = \App\Type::all();
            $merk = \App\Merk::all();
    
            return view('inventory.accessories',compact('part','series','type','merk'));
        }
    
        public function getAccessories()
        {
            $inventory = Inventory::with(['master_part'])->whereHas('master_part', function($q){

                $q->where('type', '=', 'Accessories');
            
            })->get();     
            return Datatables::of($inventory)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '<a data-id="'.$row->id.'" class="btn btn-primary btn-sm editBtn" href="javascript:void(0)"><i class="fa fa-edit"></i></a> ';
                $btn .= ' <a data-id="'.$row->id.'" class="btn btn-danger btn-sm hapusBtn" href="javascript:void(0)"><i class="fa fa-trash"></i></a> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }


        // ============================= CONSUMMABLE ==============================================================================
        
        public function consummable()
        {
            return view('inventory.consummable');
        }
    
        public function getConsummable()
        {

            $inventory = Inventory::with(['master_part'])->whereHas('master_part', function($q){

                $q->where('type', '=', 'Consumable');
            
            })->get();

            // $inventory = Inventory::with(['master_part'])->where(master_part=='type','consummable')->get();     // untuk Nampilin field relasi relasi
     
            return Datatables::of($inventory)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '<a data-id="'.$row->id.'" class="btn btn-primary btn-sm editBtn" href="javascript:void(0)"><i class="fa fa-edit"></i></a> ';
                $btn .= ' <a data-id="'.$row->id.'" class="btn btn-danger btn-sm hapusBtn" href="javascript:void(0)"><i class="fa fa-trash"></i></a> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

            // ============================= GPS ==============================================================================

            public function Gps()
            {
                return view('inventory.gps');
            }
            
            public function getGPS()
            {

                $inventory = Inventory::with(['master_part'])->whereHas('master_part', function($q){

                    $q->where('type', '=', 'GPS');
                
                })->get();

                return Datatables::of($inventory)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $btn = '<a data-id="'.$row->id.'" class="btn btn-primary btn-sm editBtn" href="javascript:void(0)"><i class="fa fa-edit"></i></a> ';
                    $btn .= ' <a data-id="'.$row->id.'" class="btn btn-danger btn-sm hapusBtn" href="javascript:void(0)"><i class="fa fa-trash"></i></a> ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }


//====================  destroy  ===========================

            public function destroy($id)
            {
                $inventory = Inventory::find($id);
                $inventory->delete();
                return response()->json(['success'=>'inventory deleted successfully.']);
        
            }




























   

// ==================================      GPS      ===========================================================================================================
    // public function indexGps()
    // {
    //     $gps = \App\Gps::all();
    //     return view('inventory.gps',compact('gps'));
    // }
    // public function getdata()
    // {
    //     $gps = Gps::with(['master_part'])->get();     // untuk Nampilin field relasi relasi
 
    //     return Datatables::of($gps)
    //     ->addIndexColumn()
    //     ->addColumn('action',function($row){
    //         $btn = '<a data-id="'.$row->id.'" class="btn btn-primary btn-sm editBtn" href="javascript:void(0)"><i class="fa fa-edit"></i></a> ';
    //         $btn .= ' <a data-id="'.$row->id.'" class="btn btn-danger btn-sm hapusBtn" href="javascript:void(0)"><i class="fa fa-trash"></i></a> ';
    //         return $btn;
    //     })
    //     ->rawColumns(['action'])
    //     ->make(true);
    // }

    // public function createGps()
    // {
    //     $part = \App\Masterpart::all();
    //     return view('inventory.create_gps',compact('part'));
    // }

    // public function storeGps(Request $request)
    // {
       
    //     $gps = new Gps;
    //     $gps->id_part = $request->part;
    //     $gps->quantity = $request->quantity;
    //     $gps->uom = $request->uom;
    //     $gps->created_by= auth()->user()->name;

               
    //     $gps->save();

    //     return redirect('/create_gps');
    // }

// =================================        END GPS     ========================================================================================================
}
