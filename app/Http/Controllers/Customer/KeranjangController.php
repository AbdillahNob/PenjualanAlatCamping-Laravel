<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\TabelKeranjang;
use App\Models\TabelProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index(){                
        $dataKeranjang = TabelKeranjang::where('idUser', Auth::id())->with('produk')->get();
        $no = 1;

        return view('customer.keranjang.index', compact('dataKeranjang','no'));
    }
    public function tambahKeranjang($id){
        $produk = TabelProduk::findOrFail($id);
        $idUser = Auth::id();

        // Cek apakah produk yg dipilih user yg sedang aktif sdh dipilih sebelumnya
        $keranjang = Tabelkeranjang::where('idUser',$idUser)->where('idProduk', $produk->id)->first();
        if($keranjang){
            $keranjang->increment('jumlahPesanan');
        }else{        
        TabelKeranjang::create([
            'idUser' => Auth::id(),
            'idProduk'=> $produk->id,
            'jumlahPesanan'=> 1,
            'statusPesanan'=>'pending'
        ]);
        }

        return redirect()->route('customer.keranjang')->with('succes','Anda Berhasil memesan produk ini');
    }
    public function checkoutKeranjang($id){
        
    }
    public function bayarKeranjang ($id){
        
    }
}