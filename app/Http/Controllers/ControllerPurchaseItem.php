<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ControllerPurchaseItem extends Controller
{
    public function index(){
        $tab_title = "BtO - Purchase item";
        $header_title = "Purchase item";

        return view("transaction/purchase_item/index", compact("header_title","tab_title"));
    }

    public function fetch(){
        $table = DB::table("tb-purchase")->get();
        return DataTables::of($table)->make(true);
    }

    public function good_purchase(Request $request){
        $table=DB::table("tb-purchase-transaction")
        ->select("tb-product.barcode","tb-product.product_name","tb-product.selling_price","tb-purchase-transaction.purchase_price","tb-purchase-transaction.qty")
        ->where("tb-purchase-transaction.receipt_code",$request->purchase_code)
        ->join("tb-product","tb-purchase-transaction.id_product","=","tb-product.id")
        ->get();

        return DataTables::of($table)->make(true);
    }
    
}
