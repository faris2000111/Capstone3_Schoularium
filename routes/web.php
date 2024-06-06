<?php

use Illuminate\Support\Facades\DB;
use app\Http\Middleware\LogRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RedirectResponse;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\admin\GuruController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\KelasController;
use App\Http\Controllers\admin\SiswaController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\absensi\AbsensiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;


try {
    DB::connection()->getPdo();
    if(DB::connection()->getDatabaseName()){
        echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
    }else{
        die("Could not find the database. Please check your configuration.");
    }
} catch (\Exception $e) {
    die("Could not open connection to database server.  Please check your configuration.");
}
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
})->middleware(['auth', 'verified'])->name('dashboard.index');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/login', [CustomAuthenticatedSessionController::class, 'store'])->name('login');
Route::get('/logout', [CustomAuthenticatedSessionController::class, 'destroy'])->name('logout');

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
// });

// Route::middleware(['auth', 'role:siswa'])->group(function () {
//     Route::get('/siswa/dashboard', function () {
//         return view('siswa.dashboard');
//     })->name('siswa.dashboard');
// });



Auth::routes();

// Route::resource('dashboard', App\Http\Controllers\admin\DashboardController::class);

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
// Route::get('/admin/siswa.index', SiswaController::class);
// Route::resource('siswa', SiswaController::class)->parameters(['siswa' => 'NIS']);
Route::resource('siswa', SiswaController::class);


Route::resource('daftar-kelas', App\Http\Controllers\admin\KelasController::class); 
Route::get('daftar-kelas', [KelasController::class, 'index'])->name('daftar-kelas.index');
Route::get('daftar-kelas/create', [KelasController::class, 'create'])->name('daftar-kelas.create');
Route::get('daftar-kelas/{id}/edit', [KelasController::class, 'edit'])->name('daftar-kelas.edit');
Route::post('daftar-kelas', [KelasController::class, 'store'])->name('daftar-kelas.store');
Route::delete('daftar-kelas/{id}', [KelasController::class, 'destroy'])->name('daftar-kelas.destroy');

Route::get('daftar-siswa/{id_kelas}', [KelasController::class, 'indexStudents'])->name('daftar-siswa.indexStudents');
Route::get('daftar-siswa/create', [KelasController::class, 'createStudent'])->name('create-siswa.createStudent');
Route::post('daftar-siswa', [KelasController::class, 'storeStudent'])->name('daftar-siswa.storeStudent');
Route::get('daftar-siswa/{nis}/edit', [KelasController::class, 'editStudent'])->name('daftar-siswa.editStudent');
Route::put('daftar-siswa/{nis}', [KelasController::class, 'updateStudent'])->name('daftar-siswa.updateStudent');
Route::delete('/siswa/{nis}', [KelasController::class, 'destroyStudent'])->name('daftar-siswa.destroyStudent');









