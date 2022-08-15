<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ControllerSupplier extends Controller
{
    public function index(){
        $tab_title = "BtO - Manage supplier";
        $header_title = "Manage supplier";

        $tb_supplier = DB::table("tb-supplier")->get();
        return view("master_data/supplier/index", compact("header_title","tab_title","tb_supplier"));
    }

    public function fetch(){
        $table = DB::table("tb-supplier")->get();
        return DataTables::of($table)->make(true);
    }

    public function save(Request $request){
        $table = DB::table("tb-supplier")
        ->insert([
            "email"=>$request["email"],
            "name"=>$request["supplier_name"],
            "address"=>$request["address"],
            "city"=>$request["city"],
            "state"=>$request["state"],
            "id_country"=>0,
            "postal"=>$request["postal"],
            "phone"=>$request["phone"],
            "fax"=>$request["fax"],

        ]);
        return response()->json($table);
    }

    public function edit(Request $request){
        $table = DB::table("tb-supplier")
        ->where("id",$request["id_supplier"])
        ->first();

        return response()->json($table);
    }

    public function update(Request $request){
        $table = DB::table("tb-supplier")
        ->where("id",$request["id_supplier"])
        ->update([
            "email"=>$request["email"],
            "name"=>$request["supplier_name"],
            "address"=>$request["address"],
            "city"=>$request["city"],
            "state"=>$request["state"],
            "id_country"=>0,
            "postal"=>$request["postal"],
            "phone"=>$request["phone"],
            "fax"=>$request["fax"],            
        ]);

        return response()->json($table);
    }

    public function delete(Request $request){
        $find_supplier = DB::table("tb-supplier")
        ->where("tb-supplier.id", $request["id_supplier"])
        ->join("tb-purchase", "tb-supplier.id","=","tb-purchase.id_supplier")
        ->count();

        if($find_supplier == 0){
            DB::table("tb-supplier")
            ->where("id",$request["id_supplier"])
            ->delete();
        }

        return response()->json(["find_supplier"=>$find_supplier]);
    }
    
}
