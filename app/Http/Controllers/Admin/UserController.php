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
        
       $data = $request->all();

       $username = $request->input('username');
       $cekUsername = User::where('username', $username)->first();
        if($cekUsername){
            return redirect()->route('register.user')->with('failed','Username anda telah terdaftar sebelumnya');
        };
        
        User::create([
            'namaLengkap'=>$data['namaLengkap'],
            'jenisKelamin'=>$data['jenisKelamin'],
            'alamat'=>$data['alamat'],
            'noTelpon'=>$data['noTelpon'],
            'status'=>$data['status'],
            'username'=>$data['username'],
            'password'=> Hash::make($data['password'])
        ]);

        return redirect()->route('login')->with('succes','Berhasil mendaftar akun');
    }
}