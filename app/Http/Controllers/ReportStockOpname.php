<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;

class ReportStockOpname extends Controller
{
    public function index(){

        return view("report/stock_opname/index");
    }

    public function show_data(){
        $table=DB::table("tb_stock_opname")->get();
        return DataTables::of($table)->make(true);
    }

    public function print($no_ref){
        $table = DB::table("tb_transaksi_stock_opname")
        ->where("tb_transaksi_stock_opname.no_ref",$no_ref)
        ->select("tb_daftar_barang.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_stock_opname.qty_sistem","tb_transaksi_stock_opname.qty_gudang","tb_transaksi_stock_opname.selisih")
        ->leftjoin("tb_daftar_barang","tb_transaksi_stock_opname.kode_barang","=","tb_daftar_barang.kode_barang")
        ->get();
        return view("report/stock_opname/print/index",compact("table","no_ref"));
    }

}
