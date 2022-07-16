<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class TableLayout1Controller extends Controller
{
    public function index(){
        $tb_category=DB::table("tb_category")
        ->select("code","name")
        ->get();

        $unit=DB::table("tb_ref_unit")->select("name AS unit","id")->get();
        
        return view("crud/table_layout1/index", compact("tb_category","unit"));
    }

    public function show_data(){
        $table = DB::table("tb_item")
        ->select("tb_category.code as category","tb_sub_category.code as sub_category","tb_category.name as category_name","tb_sub_category.name as sub_category_name", "tb_item.id as id_item","tb_item.code as barcode","tb_item.name as item","tb_item.stock","tb_item.code_category as category","tb_ref_unit.name AS unit","tb_item.code_unit as id_unit")
        ->leftjoin("tb_category", "tb_item.code_category","=","tb_category.code")
        ->leftJoin("tb_sub_category", "tb_item.code_sub_category","=","tb_sub_category.code")
        ->leftjoin("tb_ref_unit","tb_item.code_unit","=","tb_ref_unit.id")
        ->orderBy("tb_item.created_at","DESC")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function save(Request $request){
        $table=DB::table("tb_item")
        ->where("code",$request["kode_barang"])
        ->count();

        //check if barcode has already exist
        if($table>0){
            $exist = true;
        }else{
            $exist = false;
            DB::table("tb_item")
            ->insert([
                "code_category"     =>$request["category"],
                "code_sub_category" =>$request["sub_category"],
                "code"              =>$request["barcode"],
                "name"              =>$request["item"],
                "code_unit"         =>$request["unit"],
                "stock"             =>$request["stock"],
            ]); 

        }

        return response()->json(["exist"=>$exist]);
    }

    public function edit(Request $request, $id){

        $table = DB::table("tb_item")
        ->select("tb_category.code as category","tb_sub_category.code as sub_category", "tb_item.code as barcode", "tb_item.name as item","tb_item.stock","tb_item.code_unit as id_unit")
        ->leftjoin("tb_category", "tb_item.code_category","=","tb_category.code")
        ->leftJoin("tb_sub_category", "tb_item.code_sub_category","=","tb_sub_category.code")
        ->where("tb_item.id", $id)
        ->first();

        $sub_category=DB::table("tb_sub_category")
        ->select("code","name as sub_category")
        ->where("code_category",$request["category"])
        ->get();

        return response()->json(["table"=>$table, "sub_category"=>$sub_category]);
    }

    public function update(Request $request){
        $table = DB::table("tb_item")
        ->where("id", $request["id_item"])
        ->update([
            "code_category"     =>$request["category"],
            "code_sub_category" =>$request["sub_category"],
            "code"              =>$request["barcode"],
            "name"              =>$request["item"],
            "stock"             =>$request["stock"],
            "code_unit"         =>$request["unit"]
        ]);

        return response()->json($table);

    }

    public function delete($id){
        $table = DB::table("tb_item")
        ->where("id",$id)
        ->delete();

        return response()->json($table);
    }

    public function kategori_barang($barcode){
        $table=DB::table("tb_sub_category")
        ->select("code", "name as sub_category")
        ->where("code_category", $barcode)
        ->get();

        return response()->json($table);
    }
    
}
