<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class BarangMasukController extends Controller
{
    public function index(){
        $rows = DB::table("tb_pembelian")->count("ref_pembelian");
        if($rows==0){
            $no_ref = 1;
        }else{
            $no_ref = $rows + 1;
        }

        $supplier = DB::table("tb_supplier")
        ->select("id","nama_supplier")
        ->get();

        return view("inventory/barang_masuk/index", compact("no_ref","supplier"));
    }

    public function getQty($ref_pembelian){
        $table=DB::table("tb_transaksi_pembelian")
        ->select("qty")
        ->where("ref_pembelian",$ref_pembelian)
        ->count();

        return response()->json($table);
    }

    public function show_data(){
        $max = DB::table("tb_pembelian")->max("ref_pembelian");
        if($max==0){
            $no_ref = 1;
        }else{
            $no_ref = $max + 1;
        }

        $table = DB::table("tb_transaksi_pembelian")
        ->select("tb_daftar_barang.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_pembelian.id","tb_transaksi_pembelian.harga_satuan","tb_transaksi_pembelian.qty","tb_transaksi_pembelian.subtotal")
        ->leftjoin("tb_daftar_barang","tb_transaksi_pembelian.kode_barang","=","tb_daftar_barang.kode_barang")
        ->where("tb_transaksi_pembelian.ref_pembelian",$no_ref)
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function edit($id_transaksi){
        $table=DB::table("tb_transaksi_pembelian")
        ->select("tb_transaksi_pembelian.kode_barang", "tb_transaksi_pembelian.harga_satuan","tb_daftar_barang.nama_barang","tb_transaksi_pembelian.qty")
        ->leftJoin("tb_daftar_barang","tb_transaksi_pembelian.kode_barang","=","tb_daftar_barang.kode_barang")
        ->where("tb_transaksi_pembelian.id",$id_transaksi)
        ->first();

        return response()->json($table);
    }

    public function update(Request $request, $ref_pembelian, $kode_barang){
        $count=DB::table("tb_transaksi_pembelian")
        ->where("ref_pembelian",$ref_pembelian)
        ->where("kode_barang",$kode_barang)
        ->where("harga_satuan",$request["harga_satuan"])
        ->where("id","<>",$request["id_transaksi"])
        ->count();
        if($count==1){
            DB::table("tb_transaksi_pembelian")
            ->where("id","=",$request["id_transaksi"])
            ->delete();
            $table=DB::table("tb_transaksi_pembelian")
            ->where("ref_pembelian",$ref_pembelian)
            ->where("kode_barang",$kode_barang)
            ->where("harga_satuan",$request["harga_satuan"])
            ->update([
                "qty"=>DB::raw("qty+".$request["qty"]),
                "subtotal"=>DB::raw("qty*".$request["harga_satuan"])
            ]);
        }else{
            $table=DB::table("tb_transaksi_pembelian")
            ->where("id","=",$request["id_transaksi"])
            ->update([
                "qty"=>$request["qty"],
                "harga_satuan"=>$request["harga_satuan"],
                "subtotal"=>DB::raw("qty*".$request["harga_satuan"])
            ]);
        }

        return response()->json(["count"=>$count,"table"=>$table]);
    }

    public function pilih($kode_barang){

        $row = DB::table("tb_daftar_barang")
        ->where("kode_barang",$kode_barang)
        ->first();

        return response()->json($row);
    }

    public function insert(Request $request, $ref_pembelian, $kode_barang){
        $max=DB::table("tb_transaksi_pembelian")->max("id");
        if($max==0){
            $id=1;
        }else{
            $id=$max+1;
        }
        $harga_satuan = $request["harga_satuan"];
        $qty = $request["qty"];
        $table=DB::unprepared("INSERT INTO tb_transaksi_pembelian(id,ref_pembelian,kode_barang,harga_satuan,qty,subtotal) VALUES ($id, $ref_pembelian, $kode_barang, $harga_satuan, $qty, $qty*$harga_satuan) ON DUPLICATE KEY UPDATE qty=qty+$qty, subtotal=qty*harga_satuan");
        return response()->json(["table"=>$table]);
    }

    public function save(Request $request, $ref_pembelian){
        date_default_timezone_set('Asia/Jayapura');

        $keranjang = DB::table("tb_transaksi_pembelian")
        ->where("ref_pembelian",$ref_pembelian)
        ->get();

        $total_qty=0;
        foreach($keranjang as $row){
           $total_qty =+ $total_qty+$row->qty;
           DB::table("tb_daftar_barang")
           ->where("kode_barang",$row->kode_barang)
           ->increment('stock', $row->qty);  
        }

        $table = DB::table("tb_pembelian")->insert([
            "ref_pembelian" => $ref_pembelian,
            "tanggal_masuk" => date("Y-m-d"),
            "total_qty"     => $total_qty,
            "id_supplier"   => $request["id_supplier"],
            "harga_pokok"   => 0,
            "total_nilai"   => 0
        ]); 

        $rows = DB::table("tb_pembelian")->count("ref_pembelian");
        if($rows==0){
            $no_ref = 1;
        }else{
            $no_ref = $rows + 1;
        }

        return response()->json(["table"=>$table, "no_ref"=>$no_ref]);
    }

    public function delete($id_transaksi){
        $table = DB::table("tb_transaksi_pembelian")
        ->where("id",$id_transaksi)
        ->delete();

        return response()->json($table);
    }
}
