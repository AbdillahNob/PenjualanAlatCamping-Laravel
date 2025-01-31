<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TabelKeranjang;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request){
         // Ambil tanggal dari request, jika tidak ada gunakan bulan ini
         $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
         $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());
 
         // Ambil data penjualan yang sukses dalam rentang tanggal
         $laporan = TabelKeranjang::where('statusPembayaran', 'success')
                     ->whereBetween('updated_at', [$startDate, $endDate])
                     ->orderBy('updated_at', 'desc')
                     ->get();
 
         // Hitung Total produk terjual dan total pendapatan
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
                    ->whereBetween('updated_at', [$startDate, $endDate])
                    ->orderBy('updated_at', 'desc')
                    ->get();

        // Hitung Total produk terjual dan total pendapatan
        $totalProdukTerjual = $laporan->sum('jumlahPesanan');
        $totalPendapatan = $laporan->sum('totalPembayaran');

        return view('admin.laporan.index', compact('laporan', 'totalProdukTerjual', 'totalPendapatan', 'startDate', 'endDate'));
    }
    public function exportPDF(Request $request){
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());
    
        $laporan = TabelKeranjang::where('statusPembayaran', 'success')
                    ->whereBetween('updated_at', [$startDate, $endDate])
                    ->orderBy('updated_at', 'desc')
                    ->get();

        // Total produk terjual dan total pendapatan
        $totalProdukTerjual = $laporan->sum('jumlahPesanan');
        $totalPendapatan = $laporan->sum('totalPembayaran');
    
        $pdf = PDF::loadView('admin.laporan.cetak', compact('laporan','totalProdukTerjual','totalPendapatan', 'startDate', 'endDate'));
        return $pdf->download('laporan_penjualan_BentalaOutdoor' . $startDate . '_to_' . $endDate . '.pdf');
    }
}