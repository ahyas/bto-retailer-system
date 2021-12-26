<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class StockOpnameController extends Controller
{
    public function index(){  
        $no_ref=$this->no_referensi();
        return view("inventory/stock_opname/index", compact("no_ref"));
    }

    public function show_data(){
        $table=DB::table("tb_stock_opname")->get();
        return DataTables::of($table)->make(true);
    }

    function no_referensi(){
        $max=DB::table("tb_stock_opname")
        ->max(DB::raw("CAST(SUBSTRING(no_ref, 12, length(no_ref)-2) AS UNSIGNED)"));

        if($max==""){
            $count=1;
            $no_referensi="S-".date("Ymd").".".$count;
        }else{
            $count=$max+1;
            $no_referensi="S-".date("Ymd").".".$count;
        }
        return $no_referensi;
    }

    public function find_barang(Request $request){
        $table = DB::table("tb_daftar_barang")
        ->where("kode_barang",$request["barcode"])
        ->select("kode_barang","nama_barang","stock")
        ->first();
        return response()->json($table);
    }

    public function detail_transaksi(Request $request){
        $table=DB::table("tb_transaksi_stock_opname")
        ->select("tb_daftar_barang.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_stock_opname.qty_sistem","tb_transaksi_stock_opname.qty_gudang","tb_transaksi_stock_opname.selisih")
        ->join("tb_daftar_barang","tb_transaksi_stock_opname.kode_barang","=","tb_daftar_barang.kode_barang")
        ->where("no_ref",$request["no_ref"])
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function save_barang(Request $request){
        $no_ref = $request["no_ref"];
        $kode_barang = $request["kode_barang"];
        $qty_sistem = $request["qty_sistem"];
        $qty_gudang =$request["qty_gudang"];
        $selisih=$request["qty_gudang"]-$request["qty_sistem"];

        $table=DB::unprepared("INSERT INTO tb_transaksi_stock_opname(no_ref,kode_barang,qty_sistem,qty_gudang,selisih) VALUES ( '$no_ref', $kode_barang, $qty_sistem, $qty_gudang, $selisih) ON DUPLICATE KEY UPDATE qty_gudang=qty_gudang+$qty_gudang, selisih=qty_sistem-qty_gudang");

        return response()->json($table);
    }

    public function delete_barang(Request $request){
        $table=DB::table("tb_transaksi_stock_opname")
        ->where("no_ref",$request["no_ref"])
        ->where("kode_barang",$request["kode_barang"])
        ->delete();

        $count=DB::table("tb_transaksi_stock_opname")
        ->where("no_ref",$request["no_ref"])
        ->count();

        return response()->json(["table"=>$table,"count"=>$count]);
    }

    public function edit_barang(Request $request){
        $table=DB::table("tb_transaksi_stock_opname")
        ->where("tb_transaksi_stock_opname.no_ref",$request["no_ref"])
        ->where("tb_transaksi_stock_opname.kode_barang",$request["kode_barang"])
        ->select("tb_daftar_barang.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_stock_opname.qty_sistem","tb_transaksi_stock_opname.qty_gudang","tb_transaksi_stock_opname.no_ref")
        ->join("tb_daftar_barang","tb_transaksi_stock_opname.kode_barang","=","tb_daftar_barang.kode_barang")
        ->first();
        return response()->json($table);
    }

    public function update_barang(Request $request){
        $table=DB::table("tb_transaksi_stock_opname")
        ->where("no_ref",$request["no_ref"])
        ->where("kode_barang",$request["kode_barang"])
        ->update([
            "qty_gudang"=>$request["qty_gudang"],
            "selisih"=>$request["qty_gudang"]-$request["qty_sistem"]
        ]);
    }
    
    public function save_transaksi(Request $request){
        $table=DB::table("tb_stock_opname")
        ->insert([
            "no_ref"=>$request["no_ref"],
            "tanggal"=>$request["tgl"],
            "tot_qty_sistem"=>$request["tot_qty_sistem"],
            "tot_qty_gudang"=>$request["tot_qty_gudang"],
            "tot_selisih"=>$request["total_selisih"]
        ]);   
        $no_ref=$this->no_referensi();
        return response()->json(["table"=>$table,"no_ref"=>$no_ref]);
    }

}
