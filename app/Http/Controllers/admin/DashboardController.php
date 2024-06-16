<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\MataPelajaran;
use App\Models\siswa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah kelas dari tabel kelas
        $jumlahKelas = kelas::count();

        // Mengambil pengguna yang sedang login
        $user = Auth::user();

        //Mengambil jumlah siswa dari tabel siswa
        $siswa = siswa::count();

        //Mengambil jumlah siswa dari tabel admin
        $guru = Admin::count();

        //Mengambil jumlah mapel dari tabel mapel
        $mata_pelajaran = MataPelajaran::count();

        return view('admin.dashboard', compact('jumlahKelas', 'user', 'siswa', 'guru', 'mata_pelajaran'));
    }

}
