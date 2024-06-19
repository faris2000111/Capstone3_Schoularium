<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahKelas = Kelas::count();
        
        $user = Auth::user();

        $siswa = Siswa::count();

        $guru = Admin::count();

        $mata_pelajaran = MataPelajaran::count();

        $siswaId = siswa::where('id', $user->id)->with('user')->first();

        if (Auth::id()) {
            $usertype = Auth()->user()->jabatan;

            if ($usertype == 'siswa') {
                return view('siswa.dashboard', compact('siswaId'));
            } else if ($usertype == 'admin') {
                return view('admin.dashboard', compact('jumlahKelas', 'user', 'siswa', 'guru', 'mata_pelajaran'));
            }
            else if ($usertype == 'guru') {
                return view('admin.dashboard', compact('jumlahKelas', 'user', 'siswa', 'guru', 'mata_pelajaran'));
            }
        }
        // return view('admin.dashboard');
    }
}
