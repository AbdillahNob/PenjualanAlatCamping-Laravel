<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TabelProduk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(){
        $data = TabelProduk::all();
        $no=1;

        return view('admin.produk.index', compact('data', 'no'));
    }
    public function create (){        

        return view('admin.produk.tambah');
    }
    public function store (Request $request){

        $data = $request->all();

        TabelProduk::create($data);
        return redirect()->route('admin.produk')->with('succes','Berhasil Menambah Alat Camping');
    }
    public function edit (String $id){

        $data = TabelProduk::findOrFail($id);

        return view('admin.produk.edit', compact('data'));
    }

    public function update(Request $request){
        $data = $request->all();

        $item = TabelProduk::find($request->id);
        
        $item->update($data);

        return redirect()->route('admin.produk')->with('succes','Berhasil Edit Produk');
    }

    public function hapus (){

    }

}