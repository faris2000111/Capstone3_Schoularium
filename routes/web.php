<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginSiswaController;
use App\Http\Controllers\Auth\LoginAdminController;

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
})->middleware(['auth', 'verified']);

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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::resource('dashboard', App\Http\Controllers\admin\DashboardController::class); 