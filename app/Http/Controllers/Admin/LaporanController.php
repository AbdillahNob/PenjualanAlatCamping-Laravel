<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TabelKeranjang;

class LaporanController extends Controller
{
    public function index(Request $request){
         // Ambil tanggal dari request, jika tidak ada gunakan bulan ini
         $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
         $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());
 
         // Ambil data penjualan yang sukses dalam rentang tanggal
         $laporan = TabelKeranjang::where('statusPembayaran', 'success')
                     ->whereBetween('created_at', [$startDate, $endDate])
                     ->orderBy('created_at', 'desc')
                     ->get();
 
         // Total produk terjual dan total pendapatan
         $totalProdukTerjual = $laporan->sum('jumlahPesanan');
         $totalPendapatan = $laporan->sum('totalHarga');
 
         return view('admin.laporan.index', compact('laporan', 'totalProdukTerjual', 'totalPendapatan', 'startDate', 'endDate'));
    }
    public function proses(Request $request){
        // Ambil tanggal dari request, jika tidak ada gunakan bulan ini
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

        // Ambil data penjualan yang sukses dalam rentang tanggal
        $laporan = TabelKeranjang::where('statusPembayaran', 'success')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->orderBy('created_at', 'desc')
                    ->get();

        // Total produk terjual dan total pendapatan
        $totalProdukTerjual = $laporan->sum('jumlahPesanan');
        $totalPendapatan = $laporan->sum('totalPembayaran');

        return view('admin.laporan.index', compact('laporan', 'totalProdukTerjual', 'totalPendapatan', 'startDate', 'endDate'));
    }
}