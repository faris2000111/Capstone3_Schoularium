<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        // Menggunakan Auth::user() untuk mendapatkan user yang sedang login
        $user = Auth::user();

        // Mengambil siswa yang terkait dengan user yang sedang login
        $siswa = Siswa::where('id', $user->id)->with('user')->first();

        // Mengirimkan data siswa ke view 'siswa.dashboard'
        return view('siswa.dashboard', compact('siswa'));
    }
}
