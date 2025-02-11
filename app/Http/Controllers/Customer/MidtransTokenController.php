<?php

namespace App\Http\Controllers\Customer;

use Midtrans\Snap;
use Midtrans\Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MidtransTokenController extends Controller
{
    public function getSnapToken(Request $request) {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    
        $orderId = $request->order_id;
        $grossAmount = (int) $request->totalPembayaran; // Konversi ke integer
    
        $transaction = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount
            ],
            'customer_details' => [
                'first_name' => auth()->user()->namaLengkap,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->noTelpon
            ]
        ];
    
        try {
            $snapToken = Snap::getSnapToken($transaction);
            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}