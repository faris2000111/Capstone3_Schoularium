<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah kelas dari tabel kelas
        $jumlahKelas = Kelas::count();

        // Mengambil pengguna yang sedang login
        $user = Auth::user();

        //Mengambil jumlah siswa dari tabel siswa
        $siswa = Siswa::count();

        //Mengambil jumlah siswa dari tabel admin
        $guru = Admin::count();

        return view('admin.dashboard', compact('jumlahKelas', 'user', 'siswa', 'guru'));
    }

}
