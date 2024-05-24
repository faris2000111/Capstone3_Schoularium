<?php

use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\admin\absensi\AbsensiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/dashboard', [DashboardController::class, 'index'], function() {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth', 'verified');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('dashboard', App\Http\Controllers\admin\DashboardController::class); 

Route::middleware(['admin'])->group(function () {
    Route::resource('daftar-guru', AdminController::class);
});

Route::middleware(['guru'])->group(function () {
    Route::resource('absensi', AbsensiController::class);
});
Route::resource('absensi-guru', App\Http\Controllers\admin\absensi\AbsensiGuruController::class); 
