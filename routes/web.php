<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route basic
Route::get('about', function () {
    return 'Ini Halaman About';
});

Route::get('profile', function () {
    return view('profile');
});


// Route parameter (di tandai {})
Route::get('produk/{namaProduk}', function ($a) {
    return 'Saya Membeli <b>' . $a . '</b>';
});

Route::get('beli/{barang}/{jumlah}', function ($a, $b) {
    return view('beli', compact('a', 'b'));
});


// Route optional parameter
Route::get('kategori/{namaKategori?}', function ($nama = null) {
    if ($nama) {
        return 'Anda Memilih Kategori: ' . $nama;
    } else {
        return 'Anda Belum Memilih Kategori';
    }
});


Route::get('promo/{barang?}/{kode?}', function ($barang = null , $kode = null) {
    return view('promo', compact('barang', 'kode'));

}); 

// Route siswa

use App\Http\Controllers\MyController;


Route::get('siswa', [MyController::class, 'index']);    

// create     
Route::get('siswa/create', [MyController::class, 'create']); 
Route::post('siswa', [MyController::class, 'store']);   

// show     
Route::get('siswa/{id}', [MyController::class, 'show']);  

// edit data
Route::get('siswa/{id}/edit', [MyController::class, 'edit']);   
Route::put('siswa/{id}', [MyController::class, 'update']);

//delete
Route::delete('siswa/{id}', [MyController::class, 'destroy']);