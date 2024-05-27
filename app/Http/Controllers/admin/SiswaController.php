<?php

namespace App\Http\Controllers\admin;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::latest()->paginate(5);
        return view('admin.siswa.index', compact('siswa'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $kelas = Kelas::all(); // Mengambil semua data kelas
        return view('admin.siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NIS' => 'required',
            'email' => 'required',
            'password' => 'required',
            'nama_siswa' => 'required',
            'id_kelas' => 'required', // Menggunakan id_kelas sebagai foreign key
            'ekstrakurikuler' => 'required',
            'foto' => 'mimes:jpeg,jpg,png|max:1024',
        ]);

        $siswa = [
            'NIS' => $request->NIS,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nama_siswa' => $request->nama_siswa,
            'id_kelas' => $request->id_kelas, // Menyimpan id_kelas
            'ekstrakurikuler' => $request->ekstrakurikuler,
        ];

        if ($request->hasFile('foto')) {
            $foto_file = $request->file('foto');
            $foto_nama = $foto_file->hashName();
            $foto_file->move(public_path('foto_siswa'), $foto_nama);

            $siswa['foto'] = $foto_nama;
        }

        Siswa::create($siswa);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit($id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);
        $kelas = Kelas::all(); // Mengambil semua data kelas
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, $id_siswa)
    {
        $request->validate([
            'NIS' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'nama_siswa' => 'required',
            'id_kelas' => 'required', // Menggunakan id_kelas sebagai foreign key
            'ekstrakurikuler' => 'required',
        ]);

        $siswa = Siswa::findOrFail($id_siswa);

        $data = [
            'NIS' => $request->NIS,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nama_siswa' => $request->nama_siswa,
            'id_kelas' => $request->id_kelas, // Menyimpan id_kelas
            'ekstrakurikuler' => $request->ekstrakurikuler,
        ];

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'mimes:jpeg,jpg,png|max:1024',
            ]);
            $foto_file = $request->file('foto');
            $foto_nama = $foto_file->hashName();
            $foto_file->move(public_path('foto_siswa'), $foto_nama);

            File::delete(public_path('foto_siswa') . '/' . $siswa->foto);

            $data['foto'] = $foto_nama;
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil diperbarui');
    }

    public function destroy($id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);

        File::delete(public_path('foto_siswa') . '/' . $siswa->foto);

        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
}
