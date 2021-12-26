<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ReportPemesananBarang extends Controller
{
    public function index(){
        return view("report/pemesanan_barang/index");
    }

    public function show_data(){
        $table=DB::table("tb_pemesanan")
        ->where("tb_pemesanan.id_status",8)
        ->select("tb_pemesanan.ref_pemesanan","tb_ref_status.keterangan","tb_pemesanan.tgl_diterima", "tb_pemesanan.total_qty_diterima","tb_ref_status.keterangan")
        ->leftjoin("tb_ref_status","tb_pemesanan.id_status","=","tb_ref_status.id")
        ->orderBy("tb_pemesanan.tgl_pemesanan","DESC")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function filter_data(Request $request){
        $table=DB::table("tb_pemesanan")
        ->where("tb_pemesanan.id_status",8)
        ->whereBetween("tb_pemesanan.tgl_diterima", [$request["dari_tanggal"], $request["sampai_tanggal"]])
        ->select("tb_pemesanan.ref_pemesanan","tb_ref_status.keterangan","tb_pemesanan.tgl_diterima", "tb_pemesanan.total_qty_diterima","tb_ref_status.keterangan")
        ->leftjoin("tb_ref_status","tb_pemesanan.id_status","=","tb_ref_status.id")
        ->orderBy("tb_pemesanan.tgl_pemesanan","DESC")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function print_simple($dari_tanggal,$sampai_tanggal){
        $table=DB::table("tb_pemesanan")
        ->where("tb_pemesanan.id_status",8)
        ->whereBetween("tb_pemesanan.tgl_diterima", [$dari_tanggal, $sampai_tanggal])
        ->select("tb_pemesanan.ref_pemesanan","tb_ref_status.keterangan","tb_pemesanan.tgl_diterima", "tb_pemesanan.total_qty_diterima","tb_ref_status.keterangan")
        ->leftjoin("tb_ref_status","tb_pemesanan.id_status","=","tb_ref_status.id")
        ->orderBy("tb_pemesanan.tgl_pemesanan","DESC")
        ->get();

        $dari_tanggal=$dari_tanggal;
        $sampai_tanggal=$sampai_tanggal;

        return view("report/pemesanan_barang/print/index", compact("table","dari_tanggal","sampai_tanggal"));
    }

    public function print_detail($dari_tanggal,$sampai_tanggal){
        $table=DB::table("tb_pemesanan")
        ->where("tb_pemesanan.id_status",8)
        ->whereBetween("tb_pemesanan.tgl_diterima", [$dari_tanggal, $sampai_tanggal])
        ->select("tb_pemesanan.ref_pemesanan","tb_ref_status.keterangan","tb_pemesanan.tgl_diterima", "tb_pemesanan.total_qty_diterima","tb_ref_status.keterangan")
        ->leftjoin("tb_ref_status","tb_pemesanan.id_status","=","tb_ref_status.id")
        ->orderBy("tb_pemesanan.tgl_pemesanan","DESC")
        ->get();

        $detail_table=DB::table("tb_transaksi_pemesanan")
        ->select("tb_transaksi_pemesanan.ref_pemesanan","tb_transaksi_pemesanan.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_pemesanan.qty_dipesan", "tb_transaksi_pemesanan.qty_diterima")
        ->leftjoin("tb_daftar_barang", "tb_transaksi_pemesanan.kode_barang","=","tb_daftar_barang.kode_barang")
        ->leftjoin("tb_ref_status","tb_transaksi_pemesanan.id_status","=","tb_ref_status.id")
        ->get();

        $dari_tanggal=$dari_tanggal;
        $sampai_tanggal=$sampai_tanggal;

        return view("report/pemesanan_barang/print_detail/index", compact("table","dari_tanggal","sampai_tanggal","detail_table"));
    }

}
