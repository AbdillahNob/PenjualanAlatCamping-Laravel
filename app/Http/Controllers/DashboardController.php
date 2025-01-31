<?php

namespace App\Http\Controllers;

use App\Models\TabelKeranjang;
use App\Models\TabelProduk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $dataP = TabelProduk::count();
        $dataC = User::where('status','customer')->count();      
        
        // Hitung semua jumlahPesanan berdasarkan statusPembayaran success
        $dataK = TabelKeranjang::where('statusPembayaran','success')->sum('jumlahPesanan');

        return view('admin.dashboard.index', compact('dataP','dataC','dataK'));
    }
}