<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ControllerCustomer extends Controller
{
    public function index(){
        $header_title = "Manage customer";
        return view("master_data/customer/index", compact("header_title"));
    }

    public function fetch(){
        $table = DB::table("tb-customer")->get();
        return DataTables::of($table)->make(true);
    }

    public function save(Request $request){
        $table = DB::table("tb-customer")
        ->insert([
            "email"=>$request["email"],
            "name"=>$request["customer_name"],
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
        $table = DB::table("tb-customer")
        ->where("id",$request["id_customer"])
        ->first();

        return response()->json($table);
    }

    public function update(Request $request){
        $table = DB::table("tb-customer")
        ->where("id",$request["id_customer"])
        ->update([
            "email"=>$request["email"],
            "name"=>$request["customer_name"],
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
        $find_customer = DB::table("tb-customer")
        ->where("tb-customer.id", $request["id_customer"])
        ->join("tb-sales", "tb-customer.id","=","tb-sales.id_customer")
        ->count();

        if($find_customer == 0){
            DB::table("tb-customer")
            ->where("id",$request["id_customer"])
            ->delete();
        }

        return response()->json(["find_customer"=>$find_customer]);
    }
    
}
