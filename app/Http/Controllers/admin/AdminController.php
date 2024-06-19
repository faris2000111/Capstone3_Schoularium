<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        $user = Auth::user();
        return view('admin/daftarguru.daftar-guru', compact('admins', 'user'));
    }

    public function create()
    {
        $mapel = MataPelajaran::all();
        return view('admin/daftarguru.create', compact('mapel'));
    }

    public function store(Request $request)
    {
        // // Validasi form
        // $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'nip' => 'nullable|string|max:255',
        //     'umur' => 'required|integer',
        //     'jenis_kelamin' => 'required|string|in:L,P',
        //     'no_telp' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users|unique:admins',
        //     'password' => 'required|string|min:8|confirmed',
        //     'id_mata_pelajaran' => 'required|string|max:255',
        //     'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'jabatan' => 'required|string|in:Guru,Staff',
        // ]);

        // Inisialisasi variabel $foto
        $foto = null;

        // Proses penyimpanan foto ke penyimpanan
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->getClientOriginalName();
            $tujuan_upload = 'foto/guru'; // tanpa "public"
            $request->file('foto')->storeAs($tujuan_upload, $foto, 'public'); // Simpan di storage/app/public/guru/foto
        }

        DB::transaction(function () use ($request, $foto) {
            // Membuat data user
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'jabatan' => $request->jabatan,
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60),
            ]);

            // Membuat data admin dengan id yang sama seperti di tabel users
            Admin::create([
                'id' => $user->id,
                'nama' => $request->nama,
                'nip' => $request->nip,
                'umur' => $request->umur,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_mata_pelajaran' => $request->id_mata_pelajaran,
                'foto' => $foto,
                'jabatan' => $request->jabatan,
                'remember_token' => Str::random(60),
            ]);
        });

        return redirect()->route('daftar-guru.index')->with('success', 'Admin created successfully.');
    }

    public function edit($id_admin)
    {
        $admin = Admin::findOrFail($id_admin);
        $mapel = MataPelajaran::all();
        return view('admin/daftarguru.edit', compact('admin', 'mapel'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $user = User::findOrFail($admin->id);

        // // Validasi form
        // $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'nip' => 'nullable|string|max:255',
        //     'umur' => 'required|integer',
        //     'jenis_kelamin' => 'required|string|in:L,P',
        //     'no_telp' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email,' . $user->id . '|unique:admins,email,' . $admin->id,
        //     'password' => 'nullable|string|min:8|confirmed',
        //     'id_mata_pelajaran' => 'required|string|max:255',
        //     'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'jabatan' => 'required|string|in:Guru,Staff',
        // ]);

        // Inisialisasi variabel $foto
        $foto = $admin->foto;

        // Proses penyimpanan foto ke penyimpanan
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($admin->foto) {
                Storage::disk('public')->delete('foto/guru/' . $admin->foto);
            }

            $foto = $request->file('foto')->getClientOriginalName();
            $tujuan_upload = 'foto/guru'; // tanpa "public"
            $request->file('foto')->storeAs($tujuan_upload, $foto, 'public'); // Simpan di storage/app/public/guru/foto
        }

        DB::transaction(function () use ($request, $admin, $user, $foto) {
            // Update data user
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'jabatan' => $request->jabatan,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);

            // Update data admin
            $admin->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'umur' => $request->umur,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $admin->password,
                'id_mata_pelajaran' => $request->id_mata_pelajaran,
                'foto' => $foto,
                'jabatan' => $request->jabatan,
            ]);
        });

        return redirect()->route('daftar-guru.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        // Hapus foto dari penyimpanan jika ada
        if ($admin->foto) {
            Storage::disk('public')->delete('foto/guru/' . $admin->foto);
        }

        // Hapus data admin dari database
        $admin->delete();

        // Hapus data user yang terkait
        $user = User::where('email', $admin->email)->first();
        if ($user) {
            $user->delete();
        }

        return redirect()->route('daftar-guru.index')->with('success', 'Admin deleted successfully.');
    }
}
