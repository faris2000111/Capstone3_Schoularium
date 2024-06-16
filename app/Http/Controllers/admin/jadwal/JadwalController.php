<?php
namespace App\Http\Controllers\Admin\jadwal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Admin;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\User;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with(['user', 'mataPelajaran', 'kelas'])->get();
        return view('admin/jadwal.index', compact('jadwals'));
    }

    public function show(Request $request)
    {
        $selectedHari = $request->input('hari');
        $selectedKelas = $request->input('kelas');
        $userId = auth()->user()->id;

        $kelases = Kelas::all();
        $days = ['senin', 'selasa', 'rabu', 'kamis', 'jum\'at'];

        $query = Jadwal::query();

        $query->where('id_admin', $userId);

        if ($selectedHari) {
            $query->where('hari', $selectedHari);
        }

        if ($selectedKelas) {
            $query->where('id_kelas', $selectedKelas);
        }

        $jadwals = $query->get();

        return view('admin/jadwal.tampilJadwal', compact('jadwals', 'kelases', 'days', 'selectedHari', 'selectedKelas'));
    }

    public function create()
    {
        $Admins = User::where('jabatan', 'guru')->get();
        $mataPelajarans = MataPelajaran::all();
        $kelases = Kelas::all();

        return view('admin/jadwal.tambahJadwal', compact('Admins', 'mataPelajarans', 'kelases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'nama_guru' => 'required',
            'mata_pelajaran' => 'required',
            'kelas' => 'required',
            'hari' => 'required',
            'lama_jam' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);

        $idAdmin = $request->input('nama_guru');
        if (empty($idAdmin)) {
            $idAdmin = null;
        }

        $mapel = $request->input('mata_pelajaran');
        if (empty($mapel)) {
            $mapel = null;
        }

        Jadwal::create([
            'id_mata_pelajaran' => $mapel,
            'id_admin' => $idAdmin,
            'id_kelas' => $request->input('kelas'),
            'hari' => $request->input('hari'),
            'lama_jam' => $request->input('lama_jam'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
        ]);

        return redirect()->route('jadwal-admin.index')->with('success', 'Jadwal created successfully.');
    }

    public function edit($id_jadwal)
    {
        $jadwal = Jadwal::findOrFail($id_jadwal);
        $admins = User::where('jabatan', 'guru')->get();
        $mataPelajarans = MataPelajaran::all();
        $kelases = Kelas::all();
        return view('admin/jadwal.editJadwal', compact('jadwal', 'admins', 'mataPelajarans', 'kelases'));
    }

    public function update(Request $request, $id_jadwal)
    {
        $request->validate([
            'nama_guru' => 'required',
            'mata_pelajaran' => 'required',
            'kelas' => 'required',
            'hari' => 'required',
            'lama_jam' => 'required|integer',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal = Jadwal::findOrFail($id_jadwal);

        $jadwal->update([
            'id_guru' => $request->input('nama_guru'),
            'id_mata_pelajaran' => $request->input('mata_pelajaran'),
            'id_kelas' => $request->input('kelas'),
            'hari' => $request->input('hari'),
            'lama_jam' => $request->input('lama_jam'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
        ]);

        return redirect()->route('jadwal-admin.index')->with('success', 'Jadwal updated successfully.');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();

        return redirect()->route('jadwal-admin.index')->with('success', 'Jadwal deleted successfully.');
    }
}