<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\TabelKeranjang;
use App\Models\TabelProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $produk = TabelProduk::findOrFail($id);
        $idUser =  Auth::id();

        $checkout = TabelKeranjang::Where('idUser', $idUser)->where('idProduk', $produk->id)->with(['user','produk'])->first();
        if(!$checkout){
            return redirect()->route('customer.keranjang')->with('failed','Data Checkout Pesanan tidak ditemukan');
        }
        $no =1;

        return view('customer.keranjang.checkout', compact('checkout','no'));
    }


    public function bayarKeranjang (Request $request, $id){
        $keranjang = TabelKeranjang::where('id', $id)->where('idUser', Auth::id())->with('produk')->first();
        if(!$keranjang){
            return response()->json([
                'success'=>false,
                'message'=>'Produk tidak ditemukan dalam keranjang'
            ], 404);
        }

        $jumlahPesanan = $request->input('jumlahPesanan');
        $totalPembayaran = $request->input('totalPembayaran');        
        $noTelpon = $request->input('noTelpon');

        if($jumlahPesanan <=0){
            return response()->json([
                'success'=>false,
                'message'=>'Jumlah Pesanan tidak boleh kurang dari 0 atau 0!'
            ], 400);
        }

        if($keranjang->produk->stok < $jumlahPesanan){
            return response()->json([
                'success'=>false,
                'message'=>'Jumlah Stok Produk ini tidak cukup'
            ], 400);
        }

        DB::beginTransaction();
        try{
            $keranjang->update([
                'statusPembayaran'=>'success',
                'noTelpoon'=> $noTelpon,
                'jumlahPesanan'=> $jumlahPesanan,
                'totalPembayaran'=> $totalPembayaran
            ]);

            $produk = $keranjang->produk;
            $produk->update([
                'stok'=>$produk->stok - $jumlahPesanan,
                'jumlahTerjual'=>$produk->jumlahTerjual + $jumlahPesanan
            ]);

            DB::commit();

            return redirect()->route('customer.keranjang')->with('succes','Berhasil Transaksi Pembayaran Produk');

        }catch(\Exception $error){
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pembayaran.',
                'error' => $error->getMessage()
            ], 500);
        }
    }
}