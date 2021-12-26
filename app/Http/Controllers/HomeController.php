<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $table = DB::table("tb_transaksi_permintaan")
        ->select("tb_pengguna.nama_pemakai",DB::raw("SUM(tb_transaksi_permintaan.qty_dikeluarkan) as total_qty_dikeluarkan"))
        ->join("tb_pengguna","tb_transaksi_permintaan.id_user","=","tb_pengguna.id")
        ->groupBy("tb_transaksi_permintaan.id_user","tb_pengguna.nama_pemakai")
        ->get();

        $id_user=Auth::user()->id;
        $riwayat_permintaan=DB::table("tb_permintaan")
        ->where("tb_permintaan.id_user",$id_user)
        ->select("tb_ref_status.keterangan AS status","tb_permintaan.ref_permintaan","tb_permintaan.tanggal","tb_permintaan.id_status")
        ->leftjoin("tb_ref_status","tb_permintaan.id_status","=","tb_ref_status.id")
        ->orderby("tb_permintaan.tanggal","DESC")
        ->get();

        return view('home', compact("table","riwayat_permintaan"));
    }

    public function warehouse(){
        $table = DB::table("tb_warehouse")->get();
        return response()->json($table);
    }
}
