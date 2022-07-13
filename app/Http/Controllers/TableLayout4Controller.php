<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class TableLayout4Controller extends Controller
{
    public function index(){
        $tb_jenis=DB::table("tb_jenis")
        ->select("kode","keterangan")
        ->get();

        $satuan=DB::table("tb_ref_satuan")->select("nama AS satuan","id")->get();

        $tb_kategori=DB::table("tb_kategori")
        ->select("kode","keterangan")
        ->get();
        
        return view("crud/table_layout4/index", compact("tb_jenis","tb_kategori","satuan"));
    }
    
}
