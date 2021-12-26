<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class KategoriBarangController extends Controller
{
    public function index(){
        $jenis=DB::table("tb_jenis")
        ->select("kode", "keterangan AS jenis")
        ->get();

        return view("inventory/kategori_barang/index", compact("jenis"));
    }

    public function show_data(){
        $table = DB::table("tb_kategori")
        ->select("tb_kategori.kode AS kode_kategori", "tb_kategori.keterangan AS nama_kategori", "tb_jenis.keterangan AS nama_jenis","tb_kategori.id")
        ->join("tb_jenis", "tb_kategori.kode_jenis","=","tb_jenis.kode")
        ->orderBy("id","DESC")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function save(Request $request){
        $find = DB::table("tb_kategori")->where("kode",$request["kode"])->count();
        
        if($find>0){
            $table=0;
        }else{
            $table = DB::table("tb_kategori")->insert([
                "kode_jenis"    =>$request["kode_jenis"],
                "kode"          =>$request["kode_kategori"],
                "keterangan"    =>$request["nama_kategori"],
            ]);
        }

        return response()->json($table);
    }

    public function edit($id){
        $table=DB::table("tb_kategori")
        ->where("id",$id)
        ->first();

        return response()->json($table);
    }

    public function update(Request $request){
        $table=DB::table("tb_kategori")
        ->where("id", $request["id"])
        ->update([
            "kode_jenis"=>$request["kode_jenis"],
            "kode"=>$request["kode_kategori"],
            "keterangan"=>$request["nama_kategori"]
        ]);
        return response()->json($table);

    }

    public function delete($id){
        $kode_kategori=DB::table("tb_kategori")
        ->select("kode")
        ->where("id",$id)
        ->first();

        $find=DB::table("tb_daftar_barang")
        ->join("tb_kategori","tb_daftar_barang.kode_kategori","=","tb_kategori.kode")
        ->where("tb_kategori.id",$id)
        ->count();

        if($find>0){
            $table="exist";
        }else{
            $table = DB::table("tb_kategori")
            ->where("id",$id)
            ->delete();
        }

        return response()->json($table);
    }
}
