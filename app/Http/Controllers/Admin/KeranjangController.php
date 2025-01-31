<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TabelKeranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index(){
        $data = TabelKeranjang::where('statusPembayaran', 'success')->with(['produk','user'])->get();
        $no =1;

        return view('admin.pembelian.index', compact('data','no'));
    }
}