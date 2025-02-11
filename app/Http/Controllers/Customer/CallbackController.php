<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TabelKeranjang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CallbackController extends Controller
{
    public function callback(Request $request) {
        Log::info("Callback diterima:", $request->all());
    
        $orderId = $request->order_id;
        $transactionStatus = $request->transaction_status;
    
        $keranjang = TabelKeranjang::where('id', str_replace('ORDER-', '', $orderId))->first();
    
        if (!$keranjang) {
            return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
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
            
    
        if ($transactionStatus == "capture" || $transactionStatus == "settlement") {
            $keranjang->update([
                'statusPembayaran' => 'success',
                'jumlahPesanan'=>$jumlahPesanan,
                'totalPembayaran'=>$totalPembayaran,
                'noTelpon'=>$noTelpon
            ]);
            $produk = $keranjang->produk;
            $produk->update([
                'stok'=>$produk->stok - $jumlahPesanan,
                'jumlahTerjual'=>$produk->jumlahTerjual + $jumlahPesanan
            ]);
        } elseif ($transactionStatus == "pending") {
            $keranjang->update(['statusPembayaran' => 'pending']);
        } elseif ($transactionStatus == "deny" || $transactionStatus == "cancel") {
            $keranjang->update(['statusPembayaran' => 'failed']);
        }
    
        return response()->json(['message' => 'Callback diproses']);
    }
    
}