<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ControllerCategory extends Controller
{
    public function index(){
        $header_title = "Mange category";
        return view("master_data/category/index", compact("header_title"));
    }

    public function fetch(){
        $table = DB::table("tb-category")->get();
        return DataTables::of($table)->make(true);
    }

    public function save(Request $request){
        $table = DB::table("tb-category")
        ->insert([
            "category_name"=>$request["category_name"]
        ]);
        return response()->json($table);
    }

    public function edit(Request $request){
        $table = DB::table("tb-category")
        ->where("id",$request["id_category"])
        ->first();

        return response()->json($table);
    }

    public function update(Request $request){
        $table = DB::table("tb-category")
        ->where("id",$request["id_category"])
        ->update([
            "category_name"=>$request["category_name"]            
        ]);

        return response()->json($table);
    }

    public function delete(Request $request){
        $find_product = DB::table("tb-product")
        ->where("tb-product.id_category", $request["id_category"])
        ->join("tb-category", "tb-product.id_category","=","tb-category.id")
        ->count();

        if($find_product > 0){
            $result = false;
        }else{
            $result = DB::table("tb-category")
            ->where("id",$request["id_category"])
            ->delete();
        }

        return response()->json(["result"=>$result]);
    }
    
}
