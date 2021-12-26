<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class BarangKeluarController extends Controller
{
    public function index(){
        $rows = DB::table("tb_pemakaian")->count("ref_pemakaian");
        if($rows==0){
            $no_ref = 1;
        }else{
            $no_ref = $rows + 1;
        }

        $penerima = DB::table("tb_pengguna")->select("id", "nama_pemakai as penerima")->get();

        return view("inventory/barang_keluar/index", compact("no_ref","penerima", "rows"));
    }

    public function show_data(){
        $rows = DB::table("tb_pemakaian")->count("ref_pemakaian");
        if($rows==0){
            $no_ref = 1;
        }else{
            $no_ref = $rows + 1;
        }

        $table = DB::table("tb_transaksi_pemakaian")
        ->select("tb_daftar_barang.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_pemakaian.harga_satuan","tb_transaksi_pemakaian.qty","tb_transaksi_pemakaian.subtotal")
        ->leftjoin("tb_daftar_barang","tb_transaksi_pemakaian.kode_barang","=","tb_daftar_barang.kode_barang")
        ->where("tb_transaksi_pemakaian.ref_pemakaian",$no_ref)
        ->get();

        return DataTables::of($table)->make(true);
    }
    public function getQty($ref_pemakaian){
        $table=DB::table("tb_transaksi_pemakaian")
        ->select("qty")
        ->where("ref_pemakaian",$ref_pemakaian)
        ->count();

        return response()->json($table);
    }

    public function edit($ref_pemakaian, $kode_barang){
        $table=DB::table("tb_transaksi_pemakaian")
        ->select("tb_transaksi_pemakaian.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_pemakaian.qty")
        ->leftJoin("tb_daftar_barang","tb_transaksi_pemakaian.kode_barang","=","tb_daftar_barang.kode_barang")
        ->where("tb_transaksi_pemakaian.ref_pemakaian",$ref_pemakaian)
        ->where("tb_transaksi_pemakaian.kode_barang",$kode_barang)
        ->first();

        return response()->json($table);
    }

    public function update(Request $request){
        $table = DB::table("tb_transaksi_pemakaian")
        ->where("ref_pemakaian",$request["ref_pemakaian"])
        ->where("kode_barang",$request["kode_barang"])
        ->update([
            "qty"=>$request["qty"]
        ]);

        return response()->json(["table"=>$table]);
    }

    public function pilih($ref_pemakaian, $kode_barang){

        $ada=DB::table("tb_daftar_barang")
        ->where("kode_barang", $kode_barang)
        ->count();

        if($ada>0){
            $ketemu=true;

            $exist = DB::table("tb_transaksi_pemakaian")
            ->where("ref_pemakaian", $ref_pemakaian)
            ->where("kode_barang", $kode_barang)
            ->count();

            if($exist==0){
                DB::table("tb_transaksi_pemakaian")->insert([
                    "kode_barang"=>$kode_barang,
                    "ref_pemakaian"=>$ref_pemakaian,
                    "harga_satuan"=>0,
                    "qty"=>1,
                    "subtotal"=>0
                ]);
            }else{
                DB::table("tb_transaksi_pemakaian")
                ->where("kode_barang",$kode_barang)
                ->where("ref_pemakaian",$ref_pemakaian)
                ->increment('qty', 1);
            }

        }else{
            $ketemu=false;
        }
        
        return response()->json(["ketemu"=>$ketemu,"ketemu"=>$ketemu]);
    }

    public function save(Request $request, $ref_pemakaian){
        $keranjang = DB::table("tb_transaksi_pemakaian")
        ->where("ref_pemakaian",$ref_pemakaian)
        ->get();

        //memperbaharui stock barang (mengurangi)
        $total_qty=0;
        foreach($keranjang as $row){
           $total_qty =+ $total_qty+$row->qty;
           DB::table("tb_daftar_barang")
           ->where("kode_barang",$row->kode_barang)
           ->decrement("stock", $row->qty);  
        }

        $table = DB::table("tb_pemakaian")->insert([
            "ref_pemakaian" =>$ref_pemakaian,
            "id_penerima"   =>$request["id_penerima"],
            "tanggal_keluar"=>date("Y-m-d"),
            "total_qty"     =>$total_qty,
            "harga_pokok"   =>0,
            "total_nilai"   =>0
        ]); 

        $count = DB::table("tb_pemakaian")->count("ref_pemakaian");
        if($count==0){
            $no_ref = 1;
        }else{
            $no_ref = $count + 1;
        }

        return response()->json(["table"=>$table, "no_ref"=>$no_ref]);
    }

    public function delete($ref_pemakaian, $kode_barang){
        $table = DB::table("tb_transaksi_pemakaian")
        ->where("ref_pemakaian",$ref_pemakaian)
        ->where("kode_barang",$kode_barang)
        ->delete();

        $count = DB::table("tb_transaksi_pemakaian")
        ->where("ref_pemakaian",$ref_pemakaian)
        ->count();

        return response()->json(["table"=>$table, "count"=>$count]);
    }
}
