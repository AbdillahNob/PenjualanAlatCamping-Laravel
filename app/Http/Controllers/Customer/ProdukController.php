<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\TabelProduk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
{
    $search =$request->query('search');
    $data = TabelProduk::all(); // Ambil semua data produk

    if (!empty($search)) {
        $filteredData = [];

        foreach ($data as $produk) {
            // Cek apakah nama produk cocok dengan algoritma Brute Force atau Rabin-Karp
            if ($this->bruteForce($produk->namaProduk, $search) !== -1 || $this->rabinKarp($produk->namaProduk, $search) !== -1) {
                $filteredData[] = $produk;
            }
        }

        $data = $filteredData; // Gunakan hasil filter
        
    }
    $no =1;

    return view('customer.produk.index', compact('data', 'no'));
}
// Algoritma Brute Force
private function bruteForce($text, $pattern)
{

    $n = strlen($text);
    $m = strlen($pattern);

       // Jika teks lebih pendek dari pattern, langsung return -1 (tidak cocok)
    if ($n < $m) {
        return -1;
    }
    
    for ($i = 0; $i <= $n - $m; $i++) {
        $j = 0;
        while ($j < $m && $text[$i + $j] == $pattern[$j]) {
            $j++;
        }
        if ($j == $m) {
            return $i; // Cocok, kembalikan posisi
        }
    }
    return -1; // Tidak ditemukan
}

// Algoritma Rabin-Karp
private function rabinKarp($text, $pattern, $prime = 101)
{
    $d = 256; // Jumlah karakter ASCII
    $n = strlen($text);
    $m = strlen($pattern);
    
    // Jika teks lebih pendek dari pattern, langsung return -1 (tidak cocok)
    if ($n < $m) {
        return -1;
    }

    $h = 1;
    $p = 0; // Hash untuk pattern
    $t = 0; // Hash untuk text
    $q = $prime;

    // Hitung nilai h = d^(m-1) % q
    for ($i = 0; $i < $m - 1; $i++) {
        $h = ($h * $d) % $q;
    }

    // Hitung hash awal untuk pattern dan text
    for ($i = 0; $i < $m; $i++) {
        $p = ($d * $p + ord($pattern[$i])) % $q;
        $t = ($d * $t + ord($text[$i])) % $q;
    }

    // Sliding window untuk mencocokkan hash
    for ($i = 0; $i <= $n - $m; $i++) {
        if ($p == $t) { // Jika hash cocok, lakukan pengecekan karakter per karakter
            for ($j = 0; $j < $m; $j++) {
                if ($text[$i + $j] != $pattern[$j]) {
                    break;
                }
            }
            if ($j == $m) {
                return $i; // Cocok, kembalikan posisi
            }
        }

        // Hitung hash untuk window berikutnya
        if ($i < $n - $m) {
            $t = ($d * ($t - ord($text[$i]) * $h) + ord($text[$i + $m])) % $q;

            // Jika hash negatif, ubah menjadi positif
            if ($t < 0) {
                $t += $q;
            }
        }
    }
    return -1; // Tidak ditemukan
}



}