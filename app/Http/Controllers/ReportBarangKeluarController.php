<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ReportBarangKeluarController extends Controller
{
    public function index(){
        return view("report/barang_keluar/index");
    }

    public function show_data(){
        $table=DB::table("tb_pemakaian")
        ->select("tb_pengguna.nama_pemakai AS penerima", "tb_pemakaian.tanggal_keluar","tb_pemakaian.total_qty","tb_pemakaian.ref_pemakaian AS no_ref")
        ->leftjoin("tb_pengguna", "tb_pemakaian.id_penerima","=","tb_pengguna.id")
        ->orderBy("tb_pemakaian.tanggal_keluar","DESC")
        ->get();

        return DataTables::of($table)->make(true);

    }

    public function detail($ref_pemakaian){
        $table=DB::table("tb_transaksi_pemakaian")
        ->select("tb_daftar_barang.nama_barang", "tb_transaksi_pemakaian.kode_barang", "tb_transaksi_pemakaian.qty")
        ->leftjoin("tb_daftar_barang","tb_transaksi_pemakaian.kode_barang","=","tb_daftar_barang.kode_barang")
        ->where("ref_pemakaian",$ref_pemakaian)
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function detail_pengguna($ref_pemakaian){
        $table=DB::table("tb_pemakaian")
        ->select("tb_pengguna.nama_pemakai", "tb_pemakaian.tanggal_keluar")
        ->leftjoin("tb_pengguna","tb_pemakaian.id_penerima","=","tb_pengguna.id")
        ->where("tb_pemakaian.ref_pemakaian",$ref_pemakaian)
        ->first();
        return response()->json($table);
    }

    public function print($ref_pemakaian){
        $table=DB::table("tb_transaksi_pemakaian")
        ->select("tb_daftar_barang.nama_barang", "tb_transaksi_pemakaian.kode_barang", "tb_transaksi_pemakaian.qty")
        ->leftjoin("tb_daftar_barang","tb_transaksi_pemakaian.kode_barang","=","tb_daftar_barang.kode_barang")
        ->where("ref_pemakaian",$ref_pemakaian)
        ->get();

        $pengguna=DB::table("tb_pemakaian")
        ->select("tb_pengguna.nama_pemakai", "tb_pemakaian.tanggal_keluar")
        ->leftjoin("tb_pengguna","tb_pemakaian.id_penerima","=","tb_pengguna.id")
        ->where("tb_pemakaian.ref_pemakaian",$ref_pemakaian)
        ->first();

        return view("inventory/barang_keluar/print/index", compact("table","pengguna"));
    }

    public function filter(Request $request){
        $dari_tgl=$request["dari_tgl"];
        $sampai_tgl=$request["sampai_tgl"];

        $table=DB::table("tb_pemakaian")
        ->select("tb_pengguna.nama_pemakai AS penerima", "tb_pemakaian.tanggal_keluar","tb_pemakaian.total_qty","tb_pemakaian.ref_pemakaian AS no_ref")
        ->leftjoin("tb_pengguna", "tb_pemakaian.id_penerima","=","tb_pengguna.id")
        ->whereBetween("tb_pemakaian.tanggal_keluar", [$dari_tgl, $sampai_tgl])
        ->get();

        return DataTables::of($table)->make(true);
    }
}
