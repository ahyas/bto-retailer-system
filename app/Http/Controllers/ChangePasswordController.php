<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Session;
use DB;
use Auth;

class ChangePasswordController extends Controller
{
   
    public function showFormChangePassword(){
        return view("change_password");
    }

    public function change_password(Request $request){
        $rules = [
            'password'              => 'required|confirmed|min:8'
        ];
 
        $messages = [
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password',
            'password.min'    => 'Minimal 8 karakter'
        ]; 

        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }else{
            $id_user=Auth::user()->id;
            DB::table("users")
            ->where("id",$id_user)
            ->update([
                "password"=>Hash::make($request->password_confirmation),
            ]);

            return redirect()->back()->with('success', 'Password berhasil di update');   
        }
    }
 
}
