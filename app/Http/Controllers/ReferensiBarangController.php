<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ReferensiBarangController extends Controller
{
    public function index(){        
        return view("referensi/satuan_barang/index");
    }

    public function show_data(){
        $tb_ref_satuan = DB::table("tb_ref_satuan")->get();
        return DataTables::of($tb_ref_satuan)->make(true);
    }

    public function edit($id){
        $tb_ref_satuan = DB::table("tb_ref_satuan")
        ->where("id",$id)
        ->first();
        return response()->json($tb_ref_satuan);
    }

    public function update(Request $request){
        $table=DB::table("tb_ref_satuan")
        ->where("id", $request["id"])
        ->update([
            "nama" => $request["satuan_barang"],
            "keterangan"=>$request["keterangan"]
        ]);
        $satuan_barang=$request["satuan_barang"];
        $keterangan=$request["keterangan"];
        $id=$request["id"];        

        return response()->json(["table"=>$table,"keterangan"=>$keterangan,"id"=>$id]);
    }
}
