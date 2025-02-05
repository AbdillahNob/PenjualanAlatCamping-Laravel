<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\TabelKeranjang;
use App\Models\TabelProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KeranjangController extends Controller
{
    public function index(){                
        $dataKeranjang = TabelKeranjang::where('idUser', Auth::id())->where('statusPembayaran', 'pending')->with('produk')->orderBy('updated_at','desc')->get();
        $no = 1;

        return view('customer.keranjang.index', compact('dataKeranjang','no'));
    }
    public function tambahKeranjang($id){
        $produk = TabelProduk::findOrFail($id);
        $idUser = Auth::id();

        // Cek apakah produk yang dipilih sudah ada di keranjang user dengan status pending
        $keranjang = Tabelkeranjang::where('idUser',$idUser)->where('idProduk', $produk->id)->where('statusPembayaran','pending')->first();

        // Cek apakah produk yg dipilih user yg sedang aktif sdh dipilih sebelumnya        
        if($keranjang){
            $keranjang->increment('jumlahPesanan');
        }else{        
                           
        TabelKeranjang::create([
            'idUser' => Auth::id(),
            'idProduk'=> $produk->id,
            'jumlahPesanan'=> 1,
            'statusPesanan'=>'pending',        
        ]);
    }
        return redirect()->route('customer.keranjang')->with('succes','Anda Berhasil memesan produk ini');
    }
    
    public function checkoutKeranjang($id, $idProduk){
        $produk = TabelProduk::findOrFail($idProduk);
        if(!$produk){
            return redirect()->route('customer.produk')->with('failed','Id Produk tidak ditemukan');
        }
        $idUser =  Auth::id();        

        $checkout = TabelKeranjang::where('id',$id)->Where('idUser', $idUser)->where('idProduk', $produk->id)->with(['user','produk'])->first();
        if(!$checkout){            
            return redirect()->route('customer.keranjang')->with('failed','Data Checkout Pesanan tidak ditemukan');
        }
        $no =1;

    // Konfigurasi Midtrans
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = config('midtrans.is_production');
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    // Data transaksi
    $params = [
        'transaction_details' => [
            'order_id' => "ORDER-" . $checkout->id,
            'gross_amount' => $checkout->produk->harga * $checkout->jumlahPesanan,
        ],
        'customer_details' => [
            'first_name' => $checkout->user->namaLengkap,            
        ],
    ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('customer.keranjang.checkout', compact('checkout','no','snapToken'));
    }


    public function bayarKeranjang (Request $request, $id){
        $keranjang = TabelKeranjang::where('id', $id)->where('idUser', Auth::id())->with('produk')->first();
        if(!$keranjang){            
            return redirect()->route('customer.keranjang')->with('failed','Produk tidak ditemukan dalam keranjang');
            
        }

        $jumlahPesanan = $request->input('jumlahPesanan');
        $totalPembayaran = $request->input('totalPembayaran');        
        $noTelpon = $request->input('noTelpon');

        // Cek agr jumlah Pesanan bkn 0 atau kurang dari 0
        if($jumlahPesanan <=0){
            return redirect()->route('customer.keranjang')->with('failed','Jumlah Pesanan tidak boleh kurang dari 0 atau 0!');
        }

        // Cek agar jumlah Pesanan tidak melebihi jumlah STOK
        if($keranjang->produk->stok < $jumlahPesanan){
            return redirect()->route('customer.keranjang')->with('failed','Jumlah Stok Produk ini tidak cukup dari jumlah Pesanan Anda!');
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

            return redirect()->route('customer.riwayat')->with('succes','Berhasil Transaksi Pembayaran Produk');

        }catch(\Exception $error){
            DB::rollBack();
            return redirect()->route('customer.keranjang')->with('failed','Terjadi kesalahan saat memproses pembayaran.');
        }
    }

    public function riwayat(){
            $idUser = Auth::id();
            $dataKeranjang = TabelKeranjang::where('idUser', $idUser)->where('statusPembayaran','success')->with(['produk','user'])->orderBy('updated_at','desc')->get();
            $no = 1;

            return view('customer.riwayat.index', compact('dataKeranjang','no'));
    }
}