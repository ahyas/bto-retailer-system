<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ReportPersediaanBarang extends Controller
{
    public function index(){
        return view("report/persediaan_barang/index");
    }

    public function daftar_barang(){
        $table = DB::table("tb_daftar_barang")
        ->where("tb_daftar_barang.stock",">",0)
        ->select("tb_jenis.keterangan as jenis_barang","tb_kategori.keterangan as kategori_barang", "tb_daftar_barang.id as id_barang","tb_daftar_barang.kode_barang","tb_daftar_barang.nama_barang", "tb_daftar_barang.nama_barang","tb_daftar_barang.stock","tb_daftar_barang.kode_jenis")
        ->leftjoin("tb_jenis", "tb_daftar_barang.kode_jenis","=","tb_jenis.kode")
        ->leftJoin("tb_kategori", "tb_daftar_barang.kode_kategori","=","tb_kategori.kode")
        ->orderBy("tb_daftar_barang.stock","DESC")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function detail_keluar(Request $request){
        $kode_barang = $request["kode_barang"];
        $table=DB::table("tb_transaksi_permintaan")
        ->where("tb_transaksi_permintaan.kode_barang",$kode_barang)
        ->where("tb_transaksi_permintaan.qty_dikeluarkan",">",0)
        ->select("tb_permintaan.tanggal AS tgl_keluar","tb_transaksi_permintaan.ref_permintaan","tb_transaksi_permintaan.qty_dikeluarkan AS barang_keluar","tb_pengguna.nama_pemakai")
        ->leftjoin("tb_permintaan","tb_transaksi_permintaan.ref_permintaan","=","tb_permintaan.ref_permintaan")
        ->leftJoin("tb_pengguna", "tb_transaksi_permintaan.id_user","=","tb_pengguna.id")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function detail_masuk(Request $request){
        $kode_barang = $request["kode_barang"];
        $table=DB::table("tb_transaksi_pemesanan")
        ->where("tb_transaksi_pemesanan.kode_barang",$kode_barang)
        ->where("tb_transaksi_pemesanan.qty_diterima",">",0)
        ->select("tb_pemesanan.tgl_pemesanan AS tgl_masuk","tb_transaksi_pemesanan.ref_pemesanan","tb_transaksi_pemesanan.qty_diterima AS barang_masuk")
        ->leftjoin("tb_pemesanan","tb_transaksi_pemesanan.ref_pemesanan","=","tb_pemesanan.ref_pemesanan")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function detail_barang(Request $request){
        $table = DB::table("tb_daftar_barang")
        ->where("tb_daftar_barang.kode_barang",$request["kode_barang"])
        ->select("tb_jenis.keterangan as jenis_item","tb_kategori.keterangan as kategori_barang", "tb_daftar_barang.id as id_barang","tb_daftar_barang.kode_barang","tb_daftar_barang.nama_barang","tb_daftar_barang.stock","tb_daftar_barang.kode_jenis")
        ->leftjoin("tb_jenis", "tb_daftar_barang.kode_jenis","=","tb_jenis.kode")
        ->leftJoin("tb_kategori", "tb_daftar_barang.kode_kategori","=","tb_kategori.kode")
        ->first();
        return response()->json($table);
    }

}
