<?php

namespace App\Http\Controllers;


use App\Masterpart;

use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;

class DatatablesController extends Controller
{
    public function index()
    {
        return view('modal');
    }
    public function getdata()
    {
        $part = Masterpart::get();
 
        return Datatables::of($part)
        ->addIndexColumn()
        ->addColumn('action',function($part){
                $btn = '<a target="_blank" href="/edit/part'.$part->id.'/" class="btn btn-info btn-sm">Edit</a> ';
                $btn .= ' <a target="_blank" href="/hapus'.$part->id.'/" class="btn btn-danger btn-sm">Hapus</a> ';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
