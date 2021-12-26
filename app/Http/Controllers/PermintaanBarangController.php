<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;

class PermintaanBarangController extends Controller
{
    public function index(){
        $no_ref=$this->no_referensi();
        $role=Auth::user()->role;
        return view("inventory/permintaan_barang/index", compact("no_ref","role"));
    }

    function no_referensi(){
        $id_user=Auth::user()->id;
        $max=DB::table("tb_permintaan")
        ->where("id_user",$id_user)
        ->max(DB::raw("CAST(SUBSTRING(ref_permintaan, 12, length(ref_permintaan)-2) AS UNSIGNED)"));

        if($max==""){
            $count=1;
            $invoice="P-".date("Ymd").".".$count."-".$id_user;
        }else{
            $count=$max+1;
            $invoice="P-".date("Ymd").".".$count."-".$id_user;
        }
        return $invoice;
    }

    public function show_data($no_ref){
        $id_user=Auth::user()->id;
        $table=DB::table("tb_transaksi_permintaan")
        ->where("tb_transaksi_permintaan.ref_permintaan",$no_ref)
        ->where("tb_transaksi_permintaan.id_user",$id_user)
        ->select("tb_transaksi_permintaan.id","tb_transaksi_permintaan.id_user","tb_transaksi_permintaan.ref_permintaan","tb_transaksi_permintaan.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_permintaan.qty_diminta", "tb_transaksi_permintaan.qty_dikeluarkan")
        ->leftjoin("tb_daftar_barang", "tb_transaksi_permintaan.kode_barang","=","tb_daftar_barang.kode_barang")
        ->leftjoin("tb_penilaian","tb_transaksi_permintaan.ref_permintaan","=","tb_penilaian.no_referensi")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function daftar_permintaan(){
        $role=Auth::user()->role;

        if($role==1){
            $table=DB::table("tb_permintaan")
            ->select("tb_ref_penilaian.id AS id_penilaian","tb_ref_penilaian.keterangan AS penilaian","tb_permintaan.id_user", "users.name AS nama_customer","tb_ref_status.keterangan","tb_permintaan.id_user","tb_permintaan.id_status","tb_permintaan.ref_permintaan","tb_permintaan.tanggal","tb_permintaan.tgl_diterima")
            ->leftjoin("users","tb_permintaan.id_user","=","users.id")
            ->leftjoin("tb_ref_status","tb_permintaan.id_status","=","tb_ref_status.id")
            ->leftjoin("tb_penilaian","tb_permintaan.ref_permintaan","=","tb_penilaian.no_referensi")
            ->join("tb_ref_penilaian","tb_penilaian.result","=","tb_ref_penilaian.id","left outer")
            ->orderby("tb_permintaan.tanggal","DESC")
            ->get();

        }elseif($role==2){
            $id_user=Auth::user()->id;
            $table=DB::table("tb_permintaan")
            ->select("tb_ref_penilaian.id AS id_penilaian","tb_ref_penilaian.keterangan AS penilaian","tb_permintaan.id_user", "users.name AS nama_customer","tb_ref_status.keterangan","tb_permintaan.id_user","tb_permintaan.id_status","tb_permintaan.ref_permintaan","tb_permintaan.tanggal","tb_permintaan.tgl_diterima","tb_permintaan.total_qty_diminta","tb_permintaan.total_qty_dikeluarkan")
            ->where("tb_permintaan.id_user",$id_user)
            ->leftjoin("users","tb_permintaan.id_user","=","users.id")
            ->leftjoin("tb_ref_status","tb_permintaan.id_status","=","tb_ref_status.id")
            ->leftjoin("tb_penilaian","tb_permintaan.ref_permintaan","=","tb_penilaian.no_referensi")
            ->join("tb_ref_penilaian","tb_penilaian.result","=","tb_ref_penilaian.id","left outer")
            ->orderby("tb_permintaan.tanggal","DESC")
            ->get();
        }
        return DataTables::of($table)->make(true);
    }

    public function edit($id_transaksi){
        $table=DB::table("tb_transaksi_permintaan")
        ->select("tb_transaksi_permintaan.id","tb_transaksi_permintaan.kode_barang","tb_daftar_barang.nama_barang","tb_daftar_barang.stock","tb_transaksi_permintaan.qty_diminta","tb_transaksi_permintaan.qty_dikeluarkan")
        ->leftJoin("tb_daftar_barang","tb_transaksi_permintaan.kode_barang","=","tb_daftar_barang.kode_barang")
        ->where("tb_transaksi_permintaan.id",$id_transaksi)
        ->first();

        return response()->json($table);
    }

    public function update(Request $request){
        if($request["role_user"]==1){
            $table = DB::table("tb_transaksi_permintaan")
            ->where("id",$request["id_transaksi"])
            ->update([
                "qty_diminta"=>$request["qty_diminta"],
                "qty_dikeluarkan"=>$request["qty_dikeluarkan"],
                "id_status"=>6
            ]);
        }else{
            $table = DB::table("tb_transaksi_permintaan")
            ->where("id",$request["id_transaksi"])
            ->update([
                "qty_diminta"=>$request["qty_diminta"],
                "qty_dikeluarkan"=>$request["qty_dikeluarkan"]
            ]);
        }
        
        $count=DB::table("tb_transaksi_permintaan")
        ->where("ref_permintaan", $request["ref_permintaan"])
        ->where("id_status",7)
        ->count();

        $req = $request["ref_permintaan"];

        return response()->json(["table"=>$table,"count"=>$count,"req"=>$req]);
    }

    public function pilih($kode_barang){
        $table=DB::table("tb_daftar_barang")
        ->where("kode_barang",$kode_barang)
        ->select("nama_barang", "stock")
        ->first();

        return response()->json($table);
    }

    public function insert(Request $request, $ref_permintaan, $kode_barang){
        $max=DB::table("tb_transaksi_permintaan")->max("id");
        if($max==0){
            $id=1;
        }else{
            $id=$max+1;
        }
        $qty_diminta = $request["qty_diminta"];
        $id_user =  $request["id_user"];
        $table=DB::unprepared("INSERT INTO tb_transaksi_permintaan(id,id_user,id_status,kode_barang,ref_permintaan,qty_diminta,qty_dikeluarkan) VALUES ($id, $id_user, 7,$kode_barang, '$ref_permintaan', $qty_diminta, 0) ON DUPLICATE KEY UPDATE qty_diminta=qty_diminta+$qty_diminta");
        return response()->json(["table"=>$table]);
    }

    public function save(Request $request, $ref_permintaan){
        date_default_timezone_set('Asia/Jayapura');

        $keranjang = DB::table("tb_transaksi_permintaan")
        ->where("ref_permintaan",$ref_permintaan)
        ->get();

        $total_qty_diminta=0;
        foreach($keranjang as $row){
           $total_qty_diminta =+ $total_qty_diminta+$row->qty_diminta;
        }

        DB::table("tb_permintaan")->insert([
            "id_user"        => $request["id_user"],
            "ref_permintaan" => $ref_permintaan,
            "tanggal"        => date("Y-m-d"),
            "id_status"      => 1,
            "total_qty_diminta"      => $total_qty_diminta,
        ]); 

        $no_ref=$this->no_referensi();

        return response()->json(["no_ref"=>$no_ref]);
    }

    public function delete($ref_permintaan, $kode_barang){
        $table = DB::table("tb_transaksi_permintaan")
        ->where("ref_permintaan",$ref_permintaan)
        ->where("kode_barang",$kode_barang)
        ->delete();

        return response()->json($table);
    }

    public function detail_transaksi($no_referensi){
        
        $role=Auth::user()->role;
        if($role==1){
            $table=DB::table("tb_transaksi_permintaan")
            ->where("tb_transaksi_permintaan.ref_permintaan",$no_referensi)
            ->select("tb_ref_status.keterangan","tb_transaksi_permintaan.id","tb_transaksi_permintaan.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_permintaan.qty_diminta", "tb_transaksi_permintaan.id_status","tb_transaksi_permintaan.qty_dikeluarkan")
            ->leftjoin("tb_daftar_barang", "tb_transaksi_permintaan.kode_barang","=","tb_daftar_barang.kode_barang")
            ->leftjoin("tb_ref_status","tb_transaksi_permintaan.id_status","=","tb_ref_status.id")
            ->get();
        }elseif($role==2){
            $id_user=Auth::user()->id;
            $table=DB::table("tb_transaksi_permintaan")
            ->where("tb_transaksi_permintaan.ref_permintaan",$no_referensi)
            ->where("tb_transaksi_permintaan.id_user",$id_user)
            ->select("tb_ref_status.keterangan","tb_transaksi_permintaan.id","tb_transaksi_permintaan.kode_barang","tb_daftar_barang.nama_barang","tb_transaksi_permintaan.qty_diminta","tb_transaksi_permintaan.qty_dikeluarkan", "tb_transaksi_permintaan.id_status")
            ->leftjoin("tb_daftar_barang", "tb_transaksi_permintaan.kode_barang","=","tb_daftar_barang.kode_barang")
            ->leftjoin("tb_ref_status","tb_transaksi_permintaan.id_status","=","tb_ref_status.id")
            ->get();
        }
        
        return DataTables::of($table)->make(true);
    }

    public function tolak($no_ref){
        $table=DB::table("tb_permintaan")
        ->where("ref_permintaan",$no_ref)
        ->update([
            "id_status"=>4
        ]);
        return response()->json($table);
    }

    public function terima($no_ref){

        $table=DB::table("tb_permintaan")
        ->where("ref_permintaan",$no_ref)
        ->update([
            "tgl_diterima"=>date("Y-m-d"),
            "id_status"=>8
        ]);
        return response()->json($table);
    }

    public function proses(Request $request, $no_ref){
        DB::table("tb_permintaan")
        ->where("ref_permintaan",$no_ref)
        ->update([
            "id_status"=>2,
            "total_qty_dikeluarkan"=>$request["total_qty_dikeluarkan"]
        ]);
        $keranjang=DB::table("tb_transaksi_permintaan")
        ->where("ref_permintaan",$no_ref)
        ->get();

        foreach($keranjang as $row){
            DB::table("tb_daftar_barang")
            ->where("kode_barang",$row->kode_barang)
            ->update([
                "stock"=>DB::raw("stock-".$row->qty_dikeluarkan)
            ]);
        }
        return response()->json();
    }

    public function batal($no_ref){
        $table=DB::table("tb_permintaan")
        ->where("ref_permintaan",$no_ref)
        ->update([
            "id_status"=>5
        ]);
        return response()->json($table);
    }

    public function verify($no_ref, $kode_barang){
        $find=DB::table("tb_transaksi_permintaan")
        ->where("ref_permintaan",$no_ref)
        ->where("kode_barang",$kode_barang)
        ->count();

        if($find>0){
            $table=DB::table("tb_transaksi_permintaan")
            ->select("tb_transaksi_permintaan.qty_diminta","tb_transaksi_permintaan.id AS id_transaksi","tb_daftar_barang.nama_barang","tb_transaksi_permintaan.kode_barang")
            ->leftjoin("tb_daftar_barang","tb_transaksi_permintaan.kode_barang","=","tb_daftar_barang.kode_barang")
            ->where("tb_transaksi_permintaan.ref_permintaan",$no_ref)
            ->where("tb_transaksi_permintaan.kode_barang",$kode_barang)
            ->first();
            $exist=true;
        }else{
            $table=0;
            $exist=false;
        }

        return response()->json(["exist"=>$exist,"table"=>$table]);
    }

    public function feedback(Request $request){
        $result = $request["result"];
        DB::table("tb_penilaian")->insert([
            "no_referensi"=>$request["no_ref"],
            "id_user"=>$request["id_user"],
            "result"=>$request["result"]
        ]);

        return response()->json($result);
    }

}
