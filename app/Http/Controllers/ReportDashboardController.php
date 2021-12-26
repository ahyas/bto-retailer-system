<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;

class ReportDashboardController extends Controller
{
    public function total_pemakaian(){
        $table=DB::table("tb_permintaan")
        ->where("tb_permintaan.id_status",8)
        ->select("tb_permintaan.ref_permintaan","tb_ref_status.keterangan","tb_permintaan.tgl_diterima", "tb_permintaan.total_qty_dikeluarkan","tb_ref_status.keterangan","tb_pengguna.nama_pemakai")
        ->leftjoin("tb_ref_status","tb_permintaan.id_status","=","tb_ref_status.id")
        ->leftjoin("tb_pengguna","tb_permintaan.id_user","=","tb_pengguna.id")
        ->orderBy("tb_permintaan.tgl_diterima","DESC")
        ->get();

        return response()->json($table);
    }
}
