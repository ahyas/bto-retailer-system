<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ControllerProduct extends Controller
{
    public function index(){
        $tab_title = "BtO - Manage product";
        $header_title = "Manage product";

        $tb_category = DB::table("tb-category")->get();
        return view("master_data/product/index", compact("header_title","tab_title","tb_category"));
    }

    public function fetch(){
        $table = DB::table("tb-product")
        ->select("tb-product.id","tb-product.barcode","tb-category.category_name","tb-product.product_name","tb-product.selling_price","tb-product.selling_promo_price","tb-product.current_stock")
        ->join("tb-category","tb-product.id_category","=","tb-category.id")
        ->orderBy("tb-product.created_at","DESC")
        ->get();
        return DataTables::of($table)->make(true);
    }
    //save product item
    public function save(Request $request){
        //find if any duplicate barcode number
        $find_barcode = DB::table("tb-product")
        ->whereNotNull("barcode")
        ->where("barcode", $request["barcode"])
        ->count();

        //validate if any duplicate number
        if($find_barcode == 0){
            $result = DB::table("tb-product")
            ->insert([
                "id_category"=>$request["id_category"],
                "barcode"=>$request["barcode"],
                "product_name"=>$request["product_name"],
                "selling_price"=>$request["selling_price"],
                "selling_promo_price"=>$request["selling_promo_price"],
                "wholesale_price"=>$request["wholesale_price"],
                "wholesale_promo_price"=>$request["wholesale_promo_price"],
                "purchase_price"=>0,
                "current_stock"=>0,
                "tax"=>$request["tax"],
                "notes"=>$request["notes"]
            ]);
        }
        return response()->json(["count"=>$find_barcode]);
    }

    public function edit(Request $request){
        $table = DB::table("tb-product")
        ->where("id",$request["id_product"])
        ->first();

        return response()->json($table);
    }

    public function update(Request $request){
        //find if any duplicate barcode number
        $find_barcode = DB::table("tb-product")
        ->where("id","<>",$request["id_product"])
        ->whereNotNull("barcode")
        ->where("barcode", $request["barcode"])
        ->count();

        //validate if any duplicate number
        if($find_barcode == 0){
            DB::table("tb-product")
            ->where("id",$request["id_product"])
            ->update([
                "id_category"=>$request["id_category"],
                "barcode"=>$request["barcode"],
                "product_name"=>$request["product_name"],
                "selling_price"=>$request["selling_price"],
                "selling_promo_price"=>$request["selling_promo_price"],
                "wholesale_price"=>$request["wholesale_price"],
                "wholesale_promo_price"=>$request["wholesale_promo_price"],
                "purchase_price"=>0,
                "current_stock"=>0,
                "tax"=>$request["tax"],
                "notes"=>$request["notes"]           
            ]);
        }
        
        return response()->json(["count"=>$find_barcode]);
    }

    public function delete(Request $request){
        $table = DB::table("tb-product")
        ->where("id",$request["id_product"])
        ->delete();
        return response()->json($table);
    }
    
}
