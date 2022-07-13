<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class TableLayout1Controller extends Controller
{
    public function index(){
        $tb_jenis=DB::table("tb_jenis")
        ->select("kode","keterangan")
        ->get();

        $satuan=DB::table("tb_ref_satuan")->select("nama AS satuan","id")->get();

        $tb_kategori=DB::table("tb_kategori")
        ->select("kode","keterangan")
        ->get();
        
        return view("crud/table_layout1/index", compact("tb_jenis","tb_kategori","satuan"));
    }

    public function show_data(){
        $table = DB::table("tb_daftar_barang")
        ->select("tb_jenis.kode as category","tb_kategori.kode as sub_category","tb_jenis.keterangan as jenis_barang","tb_kategori.keterangan as kategori_barang", "tb_daftar_barang.id as id_item","tb_daftar_barang.kode_barang as barcode","tb_daftar_barang.nama_barang as item", "tb_daftar_barang.nama_barang","tb_daftar_barang.stock","tb_daftar_barang.kode_jenis as category","tb_ref_satuan.nama AS unit","tb_daftar_barang.id_satuan as id_unit")
        ->leftjoin("tb_jenis", "tb_daftar_barang.kode_jenis","=","tb_jenis.kode")
        ->leftJoin("tb_kategori", "tb_daftar_barang.kode_kategori","=","tb_kategori.kode")
        ->leftjoin("tb_ref_satuan","tb_daftar_barang.id_satuan","=","tb_ref_satuan.id")
        ->orderBy("tb_daftar_barang.created_at","DESC")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function save(Request $request){
        $table=DB::table("tb_daftar_barang")
        ->where("kode_barang",$request["kode_barang"])
        ->count();

        //check if barcode has already exist
        if($table>0){
            $exist = true;
        }else{
            $exist = false;
            DB::table("tb_daftar_barang")
            ->insert([
                "kode_jenis"    =>$request["category"],
                "kode_kategori" =>$request["sub_category"],
                "kode_barang"   =>$request["barcode"],
                "nama_barang"   =>$request["item"],
                "id_satuan"     =>$request["unit"],
                "stock"         =>$request["stock"],
            ]); 

        }

        return response()->json(["exist"=>$exist]);
    }

    public function edit(Request $request, $id){

        $table = DB::table("tb_daftar_barang")
        ->select("tb_jenis.kode as category","tb_kategori.kode as sub_category", "tb_daftar_barang.kode_barang as barcode","tb_daftar_barang.nama_barang", "tb_daftar_barang.nama_barang as item","tb_daftar_barang.stock","tb_daftar_barang.id_satuan as id_unit")
        ->leftjoin("tb_jenis", "tb_daftar_barang.kode_jenis","=","tb_jenis.kode")
        ->leftJoin("tb_kategori", "tb_daftar_barang.kode_kategori","=","tb_kategori.kode")
        ->where("tb_daftar_barang.id", $id)
        ->first();

        $kategori=DB::table("tb_kategori")
        ->select("kode","keterangan")
        ->where("kode_jenis",$request["category"])
        ->get();

        return response()->json(["table"=>$table, "kategori"=>$kategori]);
    }

    public function update(Request $request){
        $table = DB::table("tb_daftar_barang")
        ->where("id", $request["id_item"])
        ->update([
            "kode_jenis"    =>$request["category"],
            "kode_kategori" =>$request["sub_category"],
            "kode_barang"   =>$request["barcode"],
            "nama_barang"   =>$request["item"],
            "stock"         =>$request["stock"],
            "id_satuan"     =>$request["unit"]
        ]);

        return response()->json($table);

    }

    public function delete($id){
        $table = DB::table("tb_daftar_barang")
        ->where("id",$id)
        ->delete();

        return response()->json($table);
    }

    public function kategori_barang($barcode){
        $table=DB::table("tb_kategori")
        ->select("kode", "keterangan")
        ->where("kode_jenis", $barcode)
        ->get();

        return response()->json($table);
    }

    public function test(){
        return view("test");
    }

    
}
