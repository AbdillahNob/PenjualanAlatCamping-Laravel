<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\TabelProduk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function index(Request $request)
    {
        $search = strtolower(trim($request->query('search'))); 
        $search = $this->normalizeText($search); 
    
        $data = TabelProduk::all(); 
        $filteredData = [];
    
        if (!empty($search)) {
            foreach ($data as $produk) {
                $namaProdukLower = strtolower(trim($produk->namaProduk)); 
                $namaProdukLower = $this->normalizeText($namaProdukLower); 
    
                // Hitung Levenshtein Distance
                $distance = $this->levenshteinDistance($namaProdukLower, $search);
                $maxDistance = max(3, ceil(strlen($search) * 0.7)); // Toleransi typo lebih tinggi (70%)
    
                // Cek kemiripan menggunakan similar_text
                similar_text($namaProdukLower, $search, $similarity);
    
                // Periksa dengan Brute Force & Rabin-Karp
                $foundBruteForce = $this->bruteForce($namaProdukLower, $search) !== -1 ? 1 : 0;
                $foundRabinKarp = $this->rabinKarp($namaProdukLower, $search) !== -1 ? 1 : 0;
                $foundStripos = stripos($namaProdukLower, $search) !== false ? 1 : 0;
             
                $score = (100 - $distance * 2) + ($similarity * 1.5) + ($foundBruteForce * 25) + ($foundRabinKarp * 25) + ($foundStripos * 20);                
                
                    // Simpan jika relevan
                if ($distance <= $maxDistance || $similarity >= 40 || $foundBruteForce || $foundRabinKarp || $foundStripos) {            
                    $filteredData[] = [
                        'produk' => $produk,
                        'score' => $score
                    ];
                }
                      

            }
           
    
            // Urutkan berdasarkan skor relevansi
            usort($filteredData, function ($a, $b) {
                return $b['score'] <=> $a['score']; 
            });
    
            // Ambil hanya produk dari hasil filter
            $data = array_column($filteredData, 'produk');
        }
    
        $no = 1;
        return view('customer.produk.index', compact('data', 'no'));
    }
    
    // Fungsi Normalisasi untuk memperbaiki typo kecil
    private function normalizeText($text)
    {
        // Hilangkan huruf berulang lebih dari dua kali berturut-turut (contoh: "campiing" -> "camping")
        $text = preg_replace('/(.)\1{2,}/', '$1', $text); 
    
        // Hilangkan karakter tambahan yang sering muncul (contoh: "tendaaa" -> "tenda")
        $text = preg_replace('/(.)\1+$/', '$1', $text); 
    
        return $text;
    }
    
    

// Algoritma Brute Force
private function bruteForce($text, $pattern)
{
    // Konversi ke huruf kecil
    $text = strtolower($text);
    $pattern = strtolower($pattern);


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
    // Konversi ke huruf kecil
    $text = strtolower($text);
    $pattern = strtolower($pattern);

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
private function levenshteinDistance($str1, $str2)
{
    $len1 = strlen($str1);
    $len2 = strlen($str2);
    $matrix = [];

    if ($len1 == 0) return $len2;
    if ($len2 == 0) return $len1;

    for ($i = 0; $i <= $len1; $i++) {
        $matrix[$i][0] = $i;
    }

    for ($j = 0; $j <= $len2; $j++) {
        $matrix[0][$j] = $j;
    }

    for ($i = 1; $i <= $len1; $i++) {
        for ($j = 1; $j <= $len2; $j++) {
            $cost = ($str1[$i - 1] == $str2[$j - 1]) ? 0 : 1;
            $matrix[$i][$j] = min(
                $matrix[$i - 1][$j] + 1, // Penghapusan
                $matrix[$i][$j - 1] + 1, // Penyisipan
                $matrix[$i - 1][$j - 1] + $cost // Substitusi
            );
        }
    }

    return $matrix[$len1][$len2];
}

}