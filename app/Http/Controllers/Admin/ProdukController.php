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

        $validated = $request->validate([
            'jenisProduk'=>'required',
            'namaProduk'=>'required|string|max:255',
            'stok'=>'required|integer|min:0',
            'harga'=>'required|numeric|min:0',
        ]);
        if(empty($validated['jenisProduk'])){
            return redirect()->back()->with('failed','Jenis Produk anda kosong!');
        }

        TabelProduk::create($validated);
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

    public function delete (String $id){
        $data = TabelProduk::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.produk')->with('succes','Berhasil Hapus Data Produk');
    }

}