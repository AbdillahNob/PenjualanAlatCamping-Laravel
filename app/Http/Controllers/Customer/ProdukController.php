<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\TabelProduk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    function index(){

        $data = TabelProduk::all();
        $no =1;
        return view('customer.produk.index', compact('data','no'));
    }
}