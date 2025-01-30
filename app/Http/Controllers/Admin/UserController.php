<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create (){
        return view('register');
    }
    public function store(Request $request){
               
        $validate = $request->validate([
            'namaLengkap'=>'required',
            'jenisKelamin'=>'required',
            'alamat'=>'required',
            'noTelpon'=>'required',
            'status'=>'required',
            'username'=>'required',
            'password'=>'required'
        ]);
        
        if(empty($validate['status'] || $validate['jenisKelamin'])){
            return redirect()->route('register.user')->with('failed','Kolom inputan tidak boleh ada yang kosong');
        }

       $username = $request->input('username');
       $cekUsername = User::where('username', $username)->first();
        if($cekUsername){
            return redirect()->route('register.user')->with('failed','Username anda telah terdaftar sebelumnya');
        };
        
        User::create([
            'namaLengkap'=>$validate['namaLengkap'],
            'jenisKelamin'=>$validate['jenisKelamin'],
            'alamat'=>$validate['alamat'],
            'noTelpon'=>$validate['noTelpon'],
            'status'=>$validate['status'],
            'username'=>$validate['username'],
            'password'=> Hash::make($validate['password'])
        ]);
        return redirect()->route('login')->with('succes','Berhasil mendaftar akun');
    }
}