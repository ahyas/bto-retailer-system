<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;

class DaftarSupplierController extends Controller
{
    public function index(){
        return view("referensi/daftar_supplier/index");
    }

    public function show_data(){
        $table=DB::table("tb_supplier")
        ->select("id","nama_supplier","alamat")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function save(Request $request){
        $table=DB::table("tb_supplier")
        ->insert([
            "nama_supplier"=>$request["nama_supplier"],
            "alamat"=>$request["alamat"]
        ]);

        return response()->json($table);
    }

    public function edit($id){
        $table=DB::table("tb_supplier")
        ->select("id","nama_supplier","alamat")
        ->where("id",$id)
        ->first();

        return response()->json($table);
    }

    public function update(Request $request){
        $table=DB::table("tb_supplier")
        ->where("id",$request["id_supplier"])
        ->update([
            "nama_supplier"   =>$request["nama_supplier"],
            "alamat"  =>$request["alamat"]
        ]);
        return response()->json($table);
    }

    public function delete($id){
        $table=DB::table("tb_supplier")
        ->where("id",$id)
        ->delete();

        return response()->json($table);
    }
}
