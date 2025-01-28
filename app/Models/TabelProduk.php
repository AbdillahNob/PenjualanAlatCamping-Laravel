<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelProduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaProduk',
        'jenisProduk',
        'stok',
        'harga',
        'jumlahTerjual',        
    ];
}