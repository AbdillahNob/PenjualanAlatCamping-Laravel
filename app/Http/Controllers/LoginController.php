<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index (){
        // dd(Auth::user());
        return view('login');
    }

    public function proses(Request $request ){
        $request->validate([
            'status' => 'required',
            'username' => 'required',
            'password' => 'required'            
        ]);   
        $data = $request->only('status','username','password');
        // dd($data);
        if(Auth::attempt($data)){
            $user=Auth::user();
            if($user->status==='admin'){
               
                return redirect()->route('index.dashboard');
            }else{
                return redirect()->route('customer.produk');
            }
        }else{  
            return redirect()->route('login')->with('failed','Username, password atau status anda Salah !');
        }
    }
   public function logOut (){
    Auth::logout();
    return redirect()->route('login')->with('succes','Berhasil logOut akun');
   }
}