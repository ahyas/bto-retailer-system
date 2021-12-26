<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ReportBarangMasukController extends Controller
{
    public function index(){
        return view("report/barang_masuk/index");
    }

    public function show_data(){
        $table=DB::table("tb_pembelian")
        ->select("tb_supplier.nama_supplier","tb_pembelian.ref_pembelian", "tb_pembelian.tanggal_masuk","tb_pembelian.total_qty")
        ->leftjoin("tb_supplier", "tb_pembelian.id_supplier","=","tb_supplier.id")
        ->orderBy("tb_pembelian.tanggal_masuk","DESC")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function detail_transaksi($ref_pembelian){
        $table=DB::table("tb_transaksi_pembelian")
        ->select("tb_daftar_barang.nama_barang", "tb_transaksi_pembelian.kode_barang", "tb_transaksi_pembelian.qty")
        ->leftjoin("tb_daftar_barang","tb_transaksi_pembelian.kode_barang","=","tb_daftar_barang.kode_barang")
        ->where("tb_transaksi_pembelian.ref_pembelian",$ref_pembelian)
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function detail_supplier($ref_pembelian){
        $table=DB::table("tb_pembelian")
        ->select("tb_supplier.nama_supplier","tb_pembelian.tanggal_masuk")
        ->leftjoin("tb_supplier","tb_pembelian.id_supplier","=","tb_supplier.id")
        ->where("tb_pembelian.ref_pembelian",$ref_pembelian)
        ->first();

        return response()->json($table);
    }

    public function filter(Request $request){
        $dari_tgl=$request["dari_tgl"];
        $sampai_tgl=$request["sampai_tgl"];

        $table=DB::table("tb_pembelian")
        ->select("tb_supplier.nama_supplier","tb_pembelian.ref_pembelian", "tb_pembelian.tanggal_masuk","tb_pembelian.total_qty")
        ->leftjoin("tb_supplier", "tb_pembelian.id_supplier","=","tb_supplier.id")
        ->whereBetween("tb_pembelian.tanggal_masuk", [$dari_tgl, $sampai_tgl])
        ->get();

        return DataTables::of($table)->make(true);
    }
}
