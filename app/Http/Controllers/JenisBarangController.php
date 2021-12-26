<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class JenisBarangController extends Controller
{
    public function index(){
        return view("inventory/jenis_barang/index");
    }

    public function show_data(){
        $table = DB::table("tb_jenis")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function save(Request $request){
        $find=DB::table("tb_jenis")
        ->where("kode",$request["kode"])
        ->count();

        if($find>0){
            $table="data_exist";
        }else{
            $table = DB::table("tb_jenis")->insert([
                "kode"          =>$request["kode"],
                "keterangan"    =>$request["keterangan"],
            ]);
        }

        return response()->json($table);
    }

    public function edit($id){
        $table=DB::table("tb_jenis")
        ->where("id",$id)
        ->first();

        return response()->json($table);
    }

    public function update(Request $request){
        $table=DB::table("tb_jenis")
        ->where("id", $request["id"])
        ->update([
            "kode"=>$request["kode"],
            "keterangan"=>$request["keterangan"]
        ]);

        return response()->json($table);
    }

    public function delete($id){
        $find=DB::table("tb_kategori")
        ->join("tb_jenis","tb_kategori.kode_jenis","=","tb_jenis.kode")
        ->where("tb_jenis.id",$id)
        ->count();

        if($find==0){
            $table = DB::table("tb_jenis")
            ->where("id",$id)
            ->delete();
        }else{
            $table = "data_exist";
        }

        return response()->json($table);
    }
}
