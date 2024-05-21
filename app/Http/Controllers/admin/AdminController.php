<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin/daftarguru.daftar-guru', compact('admins'));
    }
    public function create()
    {
        return view('admin/daftarguru.create');
    }

    // Menyimpan data admin
    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            // Aturan validasi lainnya...
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh: Hanya menerima file gambar dengan maksimal ukuran 2MB
        ]);

        // Proses penyimpanan foto ke penyimpanan
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->getClientOriginalName();
            $tujuan_upload = 'foto/guru'; // tanpa "public"
            $request->file('foto')->storeAs($tujuan_upload, $foto, 'public'); // Simpan di storage/app/public/guru/foto
        }

        // Membuat data admin
        Admin::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mata_pelajaran' => $request->mata_pelajaran,
            'tingkat_pendidikan' => $request->tingkat_pendidikan,
            'foto' => $foto,
            'jabatan' => $request->jabatan,
            'remember_token' => Str::random(60),
        ]);

        return redirect()->route('daftar-guru.index')->with('success', 'Admin created successfully.');
    }
    public function edit($id_admin)
    {
        $admin = Admin::findOrFail($id_admin);
        return view('admin/daftarguru.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->nama = $request->input('nama');
        $admin->nip = $request->input('nip');
        $admin->umur = $request->input('umur');
        $admin->jenis_kelamin = $request->input('jenis_kelamin');
        $admin->no_telp = $request->input('no_telp');
        $admin->email = $request->input('email');

        // Update password jika ada input password baru
        if ($request->has('password')) {
            $admin->password = bcrypt($request->input('password'));
        }

        $admin->mata_pelajaran = $request->input('mata_pelajaran');
        $admin->tingkat_pendidikan = $request->input('tingkat_pendidikan');

        // Validasi form
        $request->validate([
            // Aturan validasi lainnya...
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh: Hanya menerima file gambar dengan maksimal ukuran 2MB
        ]);

        $admin = Admin::findOrFail($id);

        // Proses penyimpanan foto ke penyimpanan
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($admin->foto) {
                Storage::disk('public')->delete('foto/guru/' . $admin->foto);
            }
    
            $foto = $request->file('foto')->getClientOriginalName();
            $tujuan_upload = 'foto/guru'; // tanpa "public"
            $request->file('foto')->storeAs($tujuan_upload, $foto, 'public'); // Simpan di storage/app/public/guru/foto
            $admin->foto = $foto;
        }

        $admin->jabatan = $request->input('jabatan');

        // Update field lainnya sesuai kebutuhan

        $admin->save();

        return redirect()->route('daftar-guru.index')->with('success', 'Admin updated successfully.');
    }
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        // Hapus foto dari penyimpanan jika ada
        if ($admin->foto) {
            Storage::delete($admin->foto);
        }

        // Hapus data admin dari database
        $admin->delete();

        return redirect()->route('daftar-guru.index')->with('success', 'Admin deleted successfully.');
    }


}