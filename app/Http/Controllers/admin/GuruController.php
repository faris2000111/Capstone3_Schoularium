<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
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
    public function store(StoreAdminRequest $request)
    {
        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public');
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
            'foto' => $fotoPath,
            'jabatan' => $request->jabatan,
            'remember_token' => Str::random(60),
        ]);

        return redirect()->route('daftar-guru.index')->with('success', 'Admin created successfully.');
    }
    public function edit($id_guru)
    {
        $admin = Admin::findOrFail($id_guru);
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

        // Mengelola upload foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = $foto->getClientOriginalName();
            $foto->move(public_path('uploads/admins'), $fotoName);
            $admin->foto = $fotoName;
        }

        $admin->jabatan = $request->input('jabatan');

        // Update field lainnya sesuai kebutuhan

        $admin->save();

        return redirect()->route('daftar-guru.index')->with('success', 'Admin updated successfully.');
    }
    public function destroy($id_guru)
    {
        $admin = Admin::findOrFail($id_guru);
        $admin->delete();

        return redirect()->route('daftar-guru.index')->with('success', 'Admin deleted successfully.');
    }


}