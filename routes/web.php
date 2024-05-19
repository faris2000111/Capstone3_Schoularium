<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('daftarKategori');


Route::get('/kategori/create', [App\Http\Controllers\KategoriController::class, 'create'])->name('createKategori');

Route::post('/kategori/create', [App\Http\Controllers\KategoriController::class, 'store'])->name('storeKategori');

Route::get('/kategori/{id}/edit', [App\Http\Controllers\KategoriController::class, 'edit'])->name('editKategori');

Route::post('/kategori/{id}/edit', [App\Http\Controllers\KategoriController::class, 'update'])->name('updateKategori');

Route::get('/kategori/{id}/delete', [App\Http\Controllers\KategoriController::class, 'destroy'])->name('deleteKategori');

Route::get('/artikel', [App\Http\Controllers\ArtikelController::class, 'index'])->name('daftarArtikel');

Route::get('/artikel/create', [App\Http\Controllers\ArtikelController::class, 'create'])->name('createArtikel');

Route::post('/artikel/create', [App\Http\Controllers\ArtikelController::class, 'store'])->name('storeArtikel');

Route::get('/artikel/{id}/edit', [App\Http\Controllers\ArtikelController::class, 'edit'])->name('editArtikel');

Route::post('/artikel/{id}/edit', [App\Http\Controllers\ArtikelController::class, 'update'])->name('updateArtikel');

Route::get('/artikel/{id}/delete', [App\Http\Controllers\ArtikelController::class, 'destroy'])->name('deleteArtikel');

