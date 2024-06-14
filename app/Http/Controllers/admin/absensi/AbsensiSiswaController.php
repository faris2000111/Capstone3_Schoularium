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
        $admin = Auth::user();
        $kelas = Kelas::all();

        // Ambil mata pelajaran yang diajar oleh admin yang sedang login
        $mata_pelajaran = MataPelajaran::where('id_admin', $admin->id_admin)->get();

        if ($mata_pelajaran->isEmpty()) {
            return redirect()->back()->with('error', 'Admin tidak memiliki mata pelajaran.');
        }

        return view('admin/absensi.absensi-siswa', compact('mata_pelajaran', 'kelas'));
    }

    public function checkAbsensi($id_mata_pelajaran, $id_kelas, $tanggal, $id_admin)
    {
        $absensiDone = AbsensiSiswa::where('tanggal', $tanggal)
            ->where('id_mata_pelajaran', $id_mata_pelajaran)
            ->where('id_admin', $id_admin)
            ->exists();

        // Ambil data siswa yang ada di kelas yang dipilih
        $siswa = Siswa::where('id_kelas', $id_kelas)->get();

        // Ambil data absensi siswa untuk hari ini
        $absensi = AbsensiSiswa::where('tanggal', $tanggal)
            ->where('id_kelas', $id_kelas)
            ->where('id_mata_pelajaran', $id_mata_pelajaran)
            ->where('id_admin', $id_admin)
            ->get();

        // Gabungkan data siswa dengan absensi
        $siswaSudahAbsen = [];
        foreach ($siswa as $s) {
            $absensiSiswa = $absensi->firstWhere('NIS', $s->NIS);
            if ($absensiSiswa) {
                $s->absensi = $absensiSiswa;
                $siswaSudahAbsen[] = [
                    'NIS' => $s->NIS,
                    'status_kehadiran' => $absensiSiswa->status_kehadiran,
                    'alasan_ketidakhadiran' => $absensiSiswa->alasan_ketidakhadiran,
                ];
            } else {
                $s->absensi = null;
            }
        }

        return response()->json([
            'siswa' => $siswa,
            'absensiDone' => $absensiDone,
            'siswaSudahAbsen' => $siswaSudahAbsen,
        ]);
    }

    public function store(Request $request)
    {
        $id_admin = Auth::id();
        $todayDate = date('Y-m-d');
        $id_kelas = $request->input('id_kelas');
        $id_mata_pelajaran = $request->input('id_mata_pelajaran');

        // Periksa apakah ada input status kehadiran
        if (!$request->has('status_kehadiran') || empty($request->input('status_kehadiran'))) {
            return redirect()->back()->with('error', 'Mohon isi status kehadiran untuk setiap siswa.');
        }

        // Loop melalui semua siswa dan simpan status kehadiran mereka
        foreach ($request->input('status_kehadiran') as $NIS => $status_kehadiran) {
            $alasan_ketidakhadiran = $request->input("alasan_ketidakhadiran.$NIS", null);

            // Validasi tambahan
            if (($status_kehadiran == 'Izin' || $status_kehadiran == 'Sakit') && !$alasan_ketidakhadiran) {
                return redirect()->back()->with('error', 'Alasan ketidakhadiran wajib diisi jika status kehadiran adalah Izin atau Sakit.');
            }

            // Validasi jumlah kata pada alasan ketidakhadiran
            if (($status_kehadiran != 'Hadir' && $status_kehadiran != 'Alpha') && str_word_count($alasan_ketidakhadiran) < 5) {
                return redirect()->back()->with('error', 'Alasan ketidakhadiran harus memiliki minimal 5 kata.');
            }

            // Simpan atau update absensi siswa
            AbsensiSiswa::updateOrCreate(
                [
                    'NIS' => $NIS,
                    'id_kelas' => $id_kelas,
                    'id_mata_pelajaran' => $id_mata_pelajaran,
                    'tanggal' => $todayDate,
                    'id_admin' => $id_admin,
                ],
                [
                    'status_kehadiran' => $status_kehadiran,
                    'alasan_ketidakhadiran' => $status_kehadiran == 'Hadir' ? null : $alasan_ketidakhadiran,
                ]
            );
        }

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil disimpan.');
    }
}
