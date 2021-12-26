<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;

class InventoryController extends Controller
{
    public function index(){
        $table = DB::table("tb_satuan")->select("id", "nama_satuan")->get();
        $kategori = DB::table("tb_kategori")->select("id", "nama_kategori")->get();
        return view("inventory/index", compact("table","kategori"));
    }

    public function show_data(){
        $table=DB::table("tb_inventory")
        ->select("tb_inventory.kode","tb_inventory.barcode","tb_inventory.nama_barang","tb_kategori.nama_kategori","tb_inventory.stock")
        ->leftJoin("tb_kategori", "tb_inventory.id_kategori","=","tb_kategori.id")
        ->orderBy("kode", "DESC")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function save(Request $request){
        $table = DB::table("tb_inventory")
        ->insert([
            "barcode"=>$request["barcode"],
            "nama_barang"=>$request["item"],
            "id_kategori"=>$request["kategori"],
            "stock"=>$request["stock"]
        ]);

        return response()->json($table);
    }

    public function edit($id){
        $table = DB::table("tb_inventory")
        ->where("id",$id)
        ->first();

        return response()->json($table);
    }

    public function update(Request $request){
        $table = DB::table("tb_inventory")
        ->where("id",$request["id_barang"])
        ->update([
            "barcode"=>$request["barcode"],
            "nama_barang"=>$request["item"],
            "id_kategori"=>$request["kategori"],
            "stock"=>$request["stock"]
        ]);

        return response()->json($table);
    }

    public function delete($id){
        $table = DB::table("tb_inventory")
        ->where("id",$id)
        ->delete();
        return response()->json($table);
    }
}
