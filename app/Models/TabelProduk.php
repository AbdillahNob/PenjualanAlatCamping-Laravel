<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelProduk extends Model
{
    use HasFactory;

    protected $table = 'tabel_produks';
    protected $fillable = [
        'namaProduk',
        'jenisProduk',
        'stok',
        'harga',
        'jumlahTerjual',        
    ];

    public function keranjang(){
        return $this->hasMany(TabelKeranjang::class, 'idProduk','id');
    }
}   