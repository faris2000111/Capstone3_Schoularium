<?php

namespace App\Http\Controllers\admin\absensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\AbsensiSiswa;
use App\Models\Siswa;
use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Auth;

class AbsensiSiswaController extends Controller
{
    public function index()
    {
        // Ambil data admin yang sedang login
        $admin = Auth::user();

        // Ambil data siswa dan mata pelajaran yang diajarkan oleh admin
        $siswa = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->select('siswa.*', 'kelas.*')
            ->get();
        
        $mata_pelajaran = DB::table('mata_pelajaran')
            ->join('admin', 'mata_pelajaran.id_admin', '=', 'admin.id_admin')
            ->select('mata_pelajaran.*', 'admin.nama')
            ->where('admin.id_admin', $admin->id_admin)
            ->get();

        // Ambil data absensi siswa pada hari ini
        $todayDate = Carbon::now()->toDateString();
        $absensiHariIni = AbsensiSiswa::where('tanggal', $todayDate)->pluck('NIS');

        // Filter siswa yang belum absen hari ini
        $siswaBelumAbsen = $siswa->filter(function ($siswa) use ($absensiHariIni) {
            return !$absensiHariIni->contains($siswa->NIS);
        });

        return view('admin/absensi.absensi-siswa', compact('siswaBelumAbsen', 'mata_pelajaran', 'siswa'));
    }

    public function store(Request $request)
    {
        $id_admin = Auth::id();
        $todayDate = date('Y-m-d');
        $id_kelas = $request->input('id_kelas');
        $id_mata_pelajaran = $request->input('id_mata_pelajaran');

        // Loop melalui semua siswa dan simpan status kehadiran mereka
        foreach ($request->input('status_kehadiran') as $NIS => $status_kehadiran) {
            $alasan_ketidakhadiran = $request->input("alasan_ketidakhadiran.$NIS", null);

            // Validasi tambahan
            if (($status_kehadiran == 'Izin' || $status_kehadiran == 'Sakit') && !$alasan_ketidakhadiran) {
                return redirect()->back()->with('error', 'Alasan ketidakhadiran wajib diisi jika status kehadiran adalah Izin atau Sakit.');
            }

            // Validasi jumlah kata pada alasan ketidakhadiran
            if ($status_kehadiran != 'Hadir' && str_word_count($alasan_ketidakhadiran) < 10) {
                return redirect()->back()->with('error', 'Alasan ketidakhadiran harus memiliki minimal 10 kata.');
            }

            AbsensiSiswa::create([
                'NIS' => $NIS,
                'id_kelas' => $id_kelas,
                'id_mata_pelajaran' => $id_mata_pelajaran,
                'tanggal' => $todayDate,
                'status_kehadiran' => $status_kehadiran,
                'alasan_ketidakhadiran' => $status_kehadiran == 'Hadir' ? null : $alasan_ketidakhadiran,
                'id_admin' => $id_admin,
            ]);
        }

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil disimpan.');
    }

}
