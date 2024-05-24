<?php

use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\admin\SiswaController;
use App\Http\Controllers\ProductController;
use app\Http\Middleware\LogRequest;
use App\Http\Controllers\admin\absensi\AbsensiController;


// try {
//     DB::connection()->getPdo();
//     if(DB::connection()->getDatabaseName()){
//         echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
//     }else{
//         die("Could not find the database. Please check your configuration.");
//     }
// } catch (\Exception $e) {
//     die("Could not open connection to database server.  Please check your configuration.");
// }
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

// Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth', 'verified');

Auth::routes();

Route::resource('dashboard', App\Http\Controllers\admin\DashboardController::class);
Route::middleware(['admin'])->group(function () {
    Route::resource('daftar-guru', AdminController::class);
});

Route::middleware(['guru'])->group(function () {
    Route::resource('absensi', AbsensiController::class);
});
Route::resource('absensi-guru', App\Http\Controllers\admin\absensi\AbsensiGuruController::class); 

// Route::get('/siswa', [siswaController::class, 'index']);
Route::get('/tambahDataSiswa', function(){
    return view('siswa.tambahsiswa');
}
);
// Route::resource('siswa', SiswaController::class)->parameters(['siswa' => 'NIS']);
Route::resource('siswa', SiswaController::class);