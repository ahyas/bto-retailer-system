<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;

class PesanBarangController extends Controller
{
    public function index(){  
        $no_ref=$this->no_referensi();      
        return view("inventory/pesan_barang/index", compact("no_ref"));
    }

    function no_referensi(){
        $max=DB::table("tb_pemesanan")
        ->max(DB::raw("CAST(SUBSTRING(ref_pemesanan, 12, length(ref_pemesanan)-2) AS UNSIGNED)"));

        if($max==""){
            $count=1;
            $invoice="O-".date("Ymd").".".$count."-"."18";
        }else{
            $count=$max+1;
            $invoice="O-".date("Ymd").".".$count."-"."18";
        }
        return $invoice;
    }

    public function detail_transaksi($no_ref){
        $table=DB::table("tb_transaksi_pemesanan")
        ->where("tb_transaksi_pemesanan.ref_pemesanan",$no_ref)
        ->select("tb_ref_status.keterangan AS status","tb_transaksi_pemesanan.id AS id_transaksi","tb_transaksi_pemesanan.id_status","tb_transaksi_pemesanan.ref_pemesanan","tb_transaksi_pemesanan.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_pemesanan.qty_dipesan", "tb_transaksi_pemesanan.qty_diterima")
        ->leftjoin("tb_daftar_barang", "tb_transaksi_pemesanan.kode_barang","=","tb_daftar_barang.kode_barang")
        ->leftjoin("tb_ref_status","tb_transaksi_pemesanan.id_status","=","tb_ref_status.id")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function daftar_pesanan(){
        $table=DB::table("tb_pemesanan")
        ->select("tb_pemesanan.ref_pemesanan","tb_ref_status.keterangan","tb_pemesanan.tgl_pemesanan","tb_pemesanan.id_status","tb_pemesanan.tgl_diterima","tb_pemesanan.total_qty_dipesan", "tb_pemesanan.total_qty_diterima")
        ->leftjoin("tb_ref_status","tb_pemesanan.id_status","=","tb_ref_status.id")
        ->orderBy("tb_pemesanan.tgl_pemesanan","DESC")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function pilih($kode_barang){
        $table=DB::table("tb_daftar_barang")
        ->where("kode_barang",$kode_barang)
        ->select("nama_barang")
        ->first();

        return response()->json($table);
    }

    public function insert(Request $request, $ref_pemesanan, $kode_barang){
        $max=DB::table("tb_transaksi_pemesanan")->max("id");
        if($max==0){
            $id=1;
        }else{
            $id=$max+1;
        }
        $qty_dipesan = $request["qty_dipesan"];
        $table=DB::unprepared("INSERT INTO tb_transaksi_pemesanan(id,ref_pemesanan,kode_barang,id_status,qty_dipesan,qty_diterima) VALUES ($id, '$ref_pemesanan', $kode_barang, 7, $qty_dipesan,0) ON DUPLICATE KEY UPDATE qty_dipesan=qty_dipesan+$qty_dipesan");
        return response()->json(["table"=>$table]);
    }

    public function delete($ref_pemesanan, $kode_barang){
        $table = DB::table("tb_transaksi_pemesanan")
        ->where("ref_pemesanan",$ref_pemesanan)
        ->where("kode_barang",$kode_barang)
        ->delete();

        return response()->json($table);
    }

    public function save(Request $request, $ref_pemesanan){
        date_default_timezone_set('Asia/Jayapura');

        DB::table("tb_pemesanan")
        ->insert([
            "ref_pemesanan"  => $ref_pemesanan,
            "tgl_pemesanan"  => date("Y-m-d"),
            "id_status"      => 2,
            "total_qty_dipesan" => $request["tot_qty_dipesan"],
        ]); 

        $no_ref=$this->no_referensi();

        return response()->json(["no_ref"=>$no_ref]);
    }

    public function edit($id_transaksi){
        $table=DB::table("tb_transaksi_pemesanan")
        ->select("tb_transaksi_pemesanan.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_pemesanan.qty_dipesan","tb_transaksi_pemesanan.qty_diterima")
        ->leftJoin("tb_daftar_barang","tb_transaksi_pemesanan.kode_barang","=","tb_daftar_barang.kode_barang")
        ->where("tb_transaksi_pemesanan.id",$id_transaksi)
        ->first();

        return response()->json($table);
    }

    public function update(Request $request){
        $table = DB::table("tb_transaksi_pemesanan")
        ->where("id",$request["id_transaksi"])
        ->update([
            "qty_dipesan"=>$request["qty_dipesan"],
            "qty_diterima"=>$request["qty_diterima"],
        ]);

        return response()->json(["table"=>$table]);
    }

    public function terima($ref_pemesanan){
        $table=DB::table("tb_pemesanan")
        ->where("ref_pemesanan",$ref_pemesanan)
        ->first();
        return response()->json($table);
    }

    public function verify($no_ref, $kode_barang){
        $find=DB::table("tb_transaksi_pemesanan")
        ->where("ref_pemesanan",$no_ref)
        ->where("kode_barang",$kode_barang)
        ->count();
        if($find>0){
            $table=DB::table("tb_transaksi_pemesanan")
            ->select("tb_transaksi_pemesanan.id AS id_transaksi","tb_transaksi_pemesanan.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_pemesanan.qty_dipesan")
            ->leftJoin("tb_daftar_barang","tb_transaksi_pemesanan.kode_barang","=","tb_daftar_barang.kode_barang")
            ->where("tb_transaksi_pemesanan.ref_pemesanan",$no_ref)
            ->where("tb_transaksi_pemesanan.kode_barang",$kode_barang)
            ->first();
            $exist=true;
        }else{
            $table=0;
            $exist=false;
        }

        return response()->json(["exist"=>$exist,"table"=>$table]);
    }

    public function update_verify(Request $request, $ref_pemesanan, $kode_barang){
        DB::table("tb_transaksi_pemesanan")
        ->where("id",$request["id_transaksi"])
        ->update([
            "qty_diterima"=>$request["qty_diterima"],
            "id_status"=>6,
        ]);

        $result=DB::table("tb_transaksi_pemesanan")
        ->where("ref_pemesanan",$ref_pemesanan)
        ->where("id_status",7)
        ->count();

        if($result==0){
            $enabled=true;
        }else{
            $enabled=false;
        }

        return response()->json(["enabled"=>$enabled, "result"=>$result]);
    }

    public function simpan_terima($no_ref, Request $request){
        $keranjang=DB::table("tb_transaksi_pemesanan")
        ->where("tb_transaksi_pemesanan.ref_pemesanan",$no_ref)
        ->get();
        $qty_diterima=0;
        foreach($keranjang as $row){
            $qty_diterima=$qty_diterima+$row->qty_diterima;
           DB::table("tb_daftar_barang")
           ->where("kode_barang",$row->kode_barang)
           ->increment('stock', $row->qty_diterima);  
        }

        $table=DB::table("tb_pemesanan")
        ->where("ref_pemesanan",$no_ref)
        ->update([
            "no_bukti"      =>$request["no_bukti"],
            "id_status"     =>8,
            "tgl_diterima"  =>$request["tanggal"],
            "total_qty_diterima"  =>$qty_diterima
        ]);
        return response()->json($table);
    }

}
