<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;

class PetunjukPenggunaanController extends Controller
{
    public function index(){  
        return view("help/index");
    }

}
