<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TabelProduk;

class TabelKeranjang extends Model
{
    use HasFactory;
    protected $table = 'tabel_keranjangs';
    protected $fillable = [
        'idUser',
        'idProduk',
        'noTelpon',
        'jumlahPesanan',
        'totalPembayaran',
        'statusPembayaran',
        'tanggalPesan',
    ];
    
    public function produk(){        
        return $this->belongsTo(TabelProduk::class, 'idProduk','id');
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'idUser');
    }

}