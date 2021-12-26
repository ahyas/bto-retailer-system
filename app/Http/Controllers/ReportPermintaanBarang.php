<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ReportPermintaanBarang extends Controller
{
    public function index(){
        $user = DB::table("tb_pengguna")->select("nama_pemakai","id")->get();
        return view("report/permintaan_barang/index", compact("user"));
    }

    public function show_data(){
        $table=DB::table("tb_permintaan")
        ->where("tb_permintaan.id_status",8)
        ->select("tb_permintaan.ref_permintaan","tb_ref_status.keterangan","tb_permintaan.tgl_diterima", "tb_permintaan.total_qty_dikeluarkan","tb_ref_status.keterangan","tb_pengguna.nama_pemakai")
        ->leftjoin("tb_ref_status","tb_permintaan.id_status","=","tb_ref_status.id")
        ->leftjoin("tb_pengguna","tb_permintaan.id_user","=","tb_pengguna.id")
        ->orderBy("tb_permintaan.tgl_diterima","DESC")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function filter_data(Request $request){
        if($request["user"]==0){
            $table=DB::table("tb_permintaan")
            ->where("tb_permintaan.id_status",8)
            ->whereBetween("tb_permintaan.tgl_diterima", [$request["dari_tanggal"], $request["sampai_tanggal"]])
            ->select("tb_permintaan.ref_permintaan","tb_ref_status.keterangan","tb_permintaan.tgl_diterima", "tb_permintaan.total_qty_dikeluarkan","tb_ref_status.keterangan","tb_pengguna.nama_pemakai")
            ->leftjoin("tb_ref_status","tb_permintaan.id_status","=","tb_ref_status.id")
            ->leftjoin("tb_pengguna","tb_permintaan.id_user","=","tb_pengguna.id")
            ->orderBy("tb_permintaan.tgl_diterima","DESC")
            ->get();
        }else{
            $table=DB::table("tb_permintaan")
            ->where("tb_permintaan.id_status",8)
            ->where("tb_permintaan.id_user",$request["user"])
            ->whereBetween("tb_permintaan.tgl_diterima", [$request["dari_tanggal"], $request["sampai_tanggal"]])
            ->select("tb_permintaan.ref_permintaan","tb_ref_status.keterangan","tb_permintaan.tgl_diterima", "tb_permintaan.total_qty_dikeluarkan","tb_ref_status.keterangan","tb_pengguna.nama_pemakai")
            ->leftjoin("tb_ref_status","tb_permintaan.id_status","=","tb_ref_status.id")
            ->leftjoin("tb_pengguna","tb_permintaan.id_user","=","tb_pengguna.id")
            ->orderBy("tb_permintaan.tgl_diterima","DESC")
            ->get();
        }

        return DataTables::of($table)->make(true);
    }

    public function print_simple($dari_tanggal,$sampai_tanggal){

        $table=DB::table("tb_permintaan")
        ->where("tb_permintaan.id_status",8)
        ->whereBetween("tb_permintaan.tgl_diterima", [$dari_tanggal, $sampai_tanggal])
        ->select("tb_permintaan.ref_permintaan","tb_pengguna.nama_pemakai","tb_ref_status.keterangan","tb_permintaan.tgl_diterima", "tb_permintaan.total_qty_dikeluarkan","tb_ref_status.keterangan")
        ->leftjoin("tb_ref_status","tb_permintaan.id_status","=","tb_ref_status.id")
        ->leftjoin("tb_pengguna","tb_permintaan.id_user","=","tb_pengguna.id")
        ->orderBy("tb_permintaan.tgl_diterima","DESC")
        ->get();

        $dari_tanggal=$dari_tanggal;
        $sampai_tanggal=$sampai_tanggal;

        return view("report/permintaan_barang/print/index", compact("table","dari_tanggal","sampai_tanggal"));
    }

    public function print_detail($dari_tanggal,$sampai_tanggal,$user){
        if($user==0){
            $table=DB::table("tb_permintaan")
            ->where("tb_permintaan.id_status",8)
            ->whereBetween("tb_permintaan.tgl_diterima", [$dari_tanggal, $sampai_tanggal])
            ->select("tb_permintaan.ref_permintaan","tb_pengguna.nama_pemakai","tb_ref_status.keterangan","tb_permintaan.tgl_diterima", "tb_permintaan.total_qty_dikeluarkan","tb_ref_status.keterangan")
            ->leftjoin("tb_ref_status","tb_permintaan.id_status","=","tb_ref_status.id")
            ->leftjoin("tb_pengguna","tb_permintaan.id_user","=","tb_pengguna.id")
            ->orderBy("tb_permintaan.tgl_diterima","DESC")
            ->get();

            $detail_table=DB::table("tb_transaksi_permintaan")
            ->select("tb_transaksi_permintaan.ref_permintaan","tb_transaksi_permintaan.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_permintaan.qty_dikeluarkan")
            ->leftjoin("tb_daftar_barang", "tb_transaksi_permintaan.kode_barang","=","tb_daftar_barang.kode_barang")
            ->leftjoin("tb_ref_status","tb_transaksi_permintaan.id_status","=","tb_ref_status.id")
            ->get();
        }else{
            $table=DB::table("tb_permintaan")
            ->where("tb_permintaan.id_status",8)
            ->where("tb_permintaan.id_user",$user)
            ->whereBetween("tb_permintaan.tgl_diterima", [$dari_tanggal, $sampai_tanggal])
            ->select("tb_permintaan.ref_permintaan","tb_pengguna.nama_pemakai","tb_ref_status.keterangan","tb_permintaan.tgl_diterima", "tb_permintaan.total_qty_dikeluarkan","tb_ref_status.keterangan")
            ->leftjoin("tb_ref_status","tb_permintaan.id_status","=","tb_ref_status.id")
            ->leftjoin("tb_pengguna","tb_permintaan.id_user","=","tb_pengguna.id")
            ->orderBy("tb_permintaan.tgl_diterima","DESC")
            ->get();

            $detail_table=DB::table("tb_transaksi_permintaan")
            ->select("tb_transaksi_permintaan.ref_permintaan","tb_transaksi_permintaan.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_permintaan.qty_dikeluarkan")
            ->leftjoin("tb_daftar_barang", "tb_transaksi_permintaan.kode_barang","=","tb_daftar_barang.kode_barang")
            ->leftjoin("tb_ref_status","tb_transaksi_permintaan.id_status","=","tb_ref_status.id")
            ->get();
            
        }

        $dari_tanggal=$dari_tanggal;
        $sampai_tanggal=$sampai_tanggal;

        return view("report/permintaan_barang/print_detail/index", compact("table","dari_tanggal","sampai_tanggal","detail_table","user"));
    }

}
