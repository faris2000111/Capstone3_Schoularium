<?php
namespace App\Http\Controllers\siswa\jadwal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Admin;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\siswa;
use Illuminate\Support\Facades\Auth;

class JadwalSiswaController extends Controller
{
    
    public function index(Request $request)
{
    $user = auth()->user()->id;;

    $siswa = siswa::where('id', $user);
    $id_kelas = siswa::where('id', $user)->value('id_kelas');

    $selectedHari = $request->input('hari');
    $kelases = Kelas::all()->where('id_kelas', $id_kelas);

    $days = ['senin', 'selasa', 'rabu', 'kamis', 'jum\'at'];

    $query = Jadwal::query();

    if ($selectedHari) {
        $query->where('hari', $selectedHari);
    }

    $jadwals = $query->where('id_kelas', $id_kelas)->get();

    return view('siswa/jadwal.index', compact('jadwals', 'kelases', 'days', 'selectedHari'));
}

}