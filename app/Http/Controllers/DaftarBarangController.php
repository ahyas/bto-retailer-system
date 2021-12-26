<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class DaftarBarangController extends Controller
{
    public function index(){
        $tb_jenis=DB::table("tb_jenis")
        ->select("kode","keterangan")
        ->get();

        $satuan=DB::table("tb_ref_satuan")->select("nama AS satuan","id")->get();

        $tb_kategori=DB::table("tb_kategori")
        ->select("kode","keterangan")
        ->get();
        
        return view("inventory/daftar_barang/index", compact("tb_jenis","tb_kategori","satuan"));
    }

    public function show_data(){
        $table = DB::table("tb_daftar_barang")
        ->select("tb_jenis.keterangan as jenis_barang","tb_kategori.keterangan as kategori_barang", "tb_daftar_barang.id as id_barang","tb_daftar_barang.kode_barang","tb_daftar_barang.nama_barang", "tb_daftar_barang.nama_barang","tb_daftar_barang.stock","tb_daftar_barang.kode_jenis","tb_ref_satuan.nama AS satuan")
        ->leftjoin("tb_jenis", "tb_daftar_barang.kode_jenis","=","tb_jenis.kode")
        ->leftJoin("tb_kategori", "tb_daftar_barang.kode_kategori","=","tb_kategori.kode")
        ->leftjoin("tb_ref_satuan","tb_daftar_barang.id_satuan","=","tb_ref_satuan.id")
        ->orderBy("tb_daftar_barang.stock","DESC")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function save(Request $request){
        $ada=DB::table("tb_daftar_barang")
        ->where("kode_barang",$request["kode_barang"])
        ->count();

        if($ada>0){
            $ketemu=true;
        }else{
            $ketemu=false;
            DB::table("tb_daftar_barang")
            ->insert([
            "kode_jenis"    =>$request["kode_jenis"],
            "kode_kategori" =>$request["kode_kategori"],
            "kode_barang"   =>$request["kode_barang"],
            "nama_barang"   =>$request["nama_barang"],
            "stock"         =>0
        ]); 

        }

        return response()->json(["ketemu"=>$ketemu]);
    }

    public function edit(Request $request, $id){
        $table = DB::table("tb_daftar_barang")
        ->where("id",$id)
        ->first();

        $kode_barang = $table->kode_barang;

        $tb_transaksi_pemesanan=DB::table("tb_transaksi_pemesanan")
        ->where("kode_barang",$kode_barang)
        ->count();

        $tb_transaksi_permintaan=DB::table("tb_transaksi_permintaan")
        ->where("kode_barang",$kode_barang)
        ->count();
        //Jika barang yang dimaksud belum pernah di transaksikan
        if($tb_transaksi_pemesanan==0 && $tb_transaksi_permintaan==0){
            $table = DB::table("tb_daftar_barang")
            ->select("tb_jenis.kode as kode_jenis","tb_kategori.kode as kode_kategori", "tb_daftar_barang.kode_barang","tb_daftar_barang.nama_barang", "tb_daftar_barang.nama_barang","tb_daftar_barang.stock","tb_daftar_barang.id_satuan")
            ->leftjoin("tb_jenis", "tb_daftar_barang.kode_jenis","=","tb_jenis.kode")
            ->leftJoin("tb_kategori", "tb_daftar_barang.kode_kategori","=","tb_kategori.kode")
            ->where("tb_daftar_barang.id", $id)
            ->first();

            $kategori=DB::table("tb_kategori")
            ->select("kode","keterangan")
            ->where("kode_jenis",$request["kode_jenis"])
            ->get();
        //jika barang yang dimaksud sudah pernah di transaksikan 
        }else{
            $table = 0;
            $kategori = 0;
        }

        return response()->json(["table"=>$table, "kategori"=>$kategori,"tb_transaksi_pemesanan"=>$tb_transaksi_pemesanan]);
    }

    public function update(Request $request){
        $table = DB::table("tb_daftar_barang")
        ->where("id", $request["id_barang"])
        ->update([
            "kode_jenis"    =>$request["kode_jenis"],
            "kode_kategori" =>$request["kode_kategori"],
            "kode_barang"   =>$request["kode_barang"],
            "nama_barang"   =>$request["nama_barang"],
            "id_satuan"     =>$request["satuan_barang"]
        ]);

        return response()->json($table);

    }

    public function delete($id){
        $table = DB::table("tb_daftar_barang")
        ->where("id",$id)
        ->first();

        $kode_barang = $table->kode_barang;

        $tb_transaksi_pemesanan=DB::table("tb_transaksi_pemesanan")
        ->where("kode_barang",$kode_barang)
        ->count();

        $tb_transaksi_permintaan=DB::table("tb_transaksi_permintaan")
        ->where("kode_barang",$kode_barang)
        ->count();

        if($tb_transaksi_pemesanan==0 && $tb_transaksi_permintaan==0){
            $table = DB::table("tb_daftar_barang")
            ->where("id",$id)
            ->delete();
        }else{
            $table = 0;
        }
        return response()->json($table);
    }

    public function kategori_barang($kode_jenis){
        $table=DB::table("tb_kategori")
        ->select("kode", "keterangan")
        ->where("kode_jenis", $kode_jenis)
        ->get();

        return response()->json($table);
    }
}
