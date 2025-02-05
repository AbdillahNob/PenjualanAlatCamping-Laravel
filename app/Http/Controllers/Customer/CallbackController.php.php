<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TabelKeranjang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CallbackController extends Controller
{
    public function callback(Request $request)
    {
        // Log untuk debugging
        Log::info('Midtrans Callback Received', $request->all());

        // Mendapatkan server key dari config
        $serverKey = config('midtrans.server_key');

        // Validasi signature key
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Ambil order ID dari request
        $orderId = str_replace("ORDER-", "", $request->order_id);
        $keranjang = TabelKeranjang::where('id', $orderId)->first();

        if (!$keranjang) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Mulai transaksi database
        DB::beginTransaction();
        try {
            if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
                $keranjang->update(['statusPembayaran' => 'success']);
            } elseif ($request->transaction_status == 'pending') {
                $keranjang->update(['statusPembayaran' => 'pending']);
            } elseif ($request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
                $keranjang->update(['statusPembayaran' => 'failed']);
            }

            DB::commit();

            return response()->json(['message' => 'Callback handled successfully'], 200);
        } catch (\Exception $error) {
            DB::rollBack();
            Log::error('Midtrans Callback Error', ['error' => $error->getMessage()]);
            return response()->json(['message' => 'Error processing payment'], 500);
        }
    }
}