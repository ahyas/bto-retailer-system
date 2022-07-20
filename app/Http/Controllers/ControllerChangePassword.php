<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

class ControllerChangePassword extends Controller
{
    public function index(){
        $table=DB::table("users")
        ->select("username")
        ->where("id",Auth::user()->id)
        ->first();

        return view("auth/change_password",compact("table"));
    }

    public function updatePassword(Request $request){
        $table=DB::table("users")
        ->select("password")
        ->where("id",Auth::user()->id)
        ->first();

        if(Hash::check($request->current_password, $table->password)){
            DB::table("users")
            ->where("id",Auth::user()->id)
            ->update([
                'password'=> Hash::make($request->new_password)
            ]);

            return Auth::logout();
        }else{
            $data=1;
            return response()->json($data);
        }

    }

}
