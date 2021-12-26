<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;

class DaftarPegawaiController extends Controller
{
    public function index(){
        return view("referensi/daftar_pegawai/index");
    }

    public function show_data(){
        $table=DB::table("tb_pengguna")
        ->select("id","nama_pemakai AS pengguna","nip")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function save(Request $request){
        $table=DB::table("tb_pengguna")->insert([
            "nip"=>$request["nip"],
            "nama_pemakai"=>$request["nama"]
        ]);

        return response()->json($table);
    }

    public function edit($id){
        $table=DB::table("tb_pengguna")
        ->select("id","nama_pemakai AS pengguna","nip")
        ->where("id",$id)
        ->first();

        return response()->json($table);
    }

    public function update(Request $request){
        $table=DB::table("tb_pengguna")
        ->where("id",$request["id"])
        ->update([
            "nip"   =>$request["nip"],
            "nama_pemakai"  =>$request["nama"]
        ]);
        return response()->json($table);
    }

    public function delete($id){
        $table=DB::table("tb_pengguna")
        ->where("id",$id)
        ->delete();

        return response()->json($table);
    }
}
