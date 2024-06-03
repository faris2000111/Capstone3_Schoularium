<?php

use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\GuruController;
use App\Http\Controllers\admin\KelasController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
Route::resource('daftar-guru', App\Http\Controllers\admin\GuruController::class); 

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









