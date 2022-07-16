<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class TableLayout3Controller extends Controller
{
    public function index(){
        $tb_category=DB::table("tb_category")
        ->select("code","name")
        ->get();

        $unit=DB::table("tb_ref_unit")->select("name AS unit","id")->get();
        
        return view("crud/table_layout3/index", compact("tb_category","unit"));;
    }
    
}
