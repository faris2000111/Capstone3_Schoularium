<?php

use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;
use illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\admin\SiswaController;
use App\Http\Controllers\ProductController;
use app\Http\Middleware\LogRequest;
use App\Http\Controllers\admin\absensi\AbsensiController;
use App\Http\Controllers\admin\absensi\AbsensiSiswaController;
use App\Http\Controllers\SiswaAuthController;


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
Route::resource('dashboard', App\Http\Controllers\admin\DashboardController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);

Route::get('/siswa/login', [SiswaAuthController::class, 'showLoginForm'])->name('siswa.login');
Route::post('/siswa/login', [SiswaAuthController::class, 'login']);


Route::resource('/dashboard/siswa', App\Http\Controllers\siswa\DashboardController::class)
    ->only(['index'])
    ->middleware(['siswa']);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth', 'verified');

Auth::routes();

// Route::resource('dashboard', App\Http\Controllers\admin\DashboardController::class);

Route::middleware(['admin'])->group(function () {
    Route::resource('daftar-guru', AdminController::class);
});

Route::middleware(['guru'])->group(function () {
    Route::resource('absensi', App\Http\Controllers\admin\absensi\AbsensiController::class);
    Route::resource('absensi-siswa', App\Http\Controllers\admin\absensi\AbsensiSiswaController::class);
    Route::resource('absensi-guru', App\Http\Controllers\admin\absensi\AbsensiGuruController::class);
    Route::resource('data-absensi', App\Http\Controllers\admin\absensi\DataAbsensiController::class);
});
Route::middleware(['guru'])->group(function () {
    Route::resource('absensi', AbsensiController::class);
});

 

// Route::get('/siswa', [siswaController::class, 'index']);
Route::get('/tambahDataSiswa', function(){
    return view('siswa.tambahsiswa');
}
);
// Route::resource('siswa', SiswaController::class)->parameters(['siswa' => 'NIS']);
Route::resource('siswa', SiswaController::class);
Route::get('/check-absensi/{id_mata_pelajaran}/{id_kelas}/{tanggal}/{id_admin}', [AbsensiSiswaController::class, 'checkAbsensi']);
Route::get('/siswa-by-kelas/{id_kelas}', [AbsensiSiswaController::class, 'getSiswaByKelas'])->name('siswa.by.kelas');
