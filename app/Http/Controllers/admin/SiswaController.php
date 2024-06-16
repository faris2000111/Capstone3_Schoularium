<?php

namespace App\Http\Controllers\admin;


use App\Models\siswa;
use App\Models\kelas;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\RedirectResponse;
use App\Models\ekstrakurikuler;

class SiswaController extends Controller
{
    public function index()
    {

        $siswa = siswa::all();
        $ekstrakurikuler = ekstrakurikuler::all();
        return view('admin/siswa.index',compact('siswa','ekstrakurikuler'));

    }

    public function create()
    {

        $kelas = kelas::all();
        $ekstrakurikuler = ekstrakurikuler::all();
        return view('admin/siswa.create', compact('kelas', 'ekstrakurikuler'));

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

            'jenis_kelamin' => 'required',
            'id_kelas' => 'required',
            'id_ekstrakurikuler' => 'required',
            'foto'     => 'mimes:jpeg,jpg,png|max:1024',

            'id_kelas' => 'required', // Menggunakan id_kelas sebagai foreign key
            'ekstrakurikuler' => 'required',
            'foto' => 'mimes:jpeg,jpg,png|max:1024',

        ]);

        $siswa = [
            'NIS' => $request->NIS,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            'nama_siswa'   => $request->nama_siswa,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'id_kelas'   => $request->id_kelas,
            'id_ekstrakurikuler'   => $request->id_ekstrakurikuler,

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


        // siswa::create($request->all());
        siswa::create($siswa);

        return redirect()->route('siswa.index')->with('success','siswa created successfully.');

        Siswa::create($siswa);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan');

    }

    public function edit($id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);
        $kelas = Kelas::all(); // Mengambil semua data kelas
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }


    // public function edit(siswa $siswa)
    // {
    //     return view('siswa.edit',compact('siswa'));
    // }

    // public function edit(siswa $siswa)
    // {
    //     $kelas = kelas::all();
    //     $ekstrakurikuler = ekstrakurikuler::all();
    //     return view('admin/siswa.edit', compact('siswa', 'kelas','ekstrakurikuler'));
    // }
    public function update(Request $request, string $id_siswa)
{
    $request->validate([
        'NIS' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'nama_siswa' => 'required',
        'jenis_kelamin' => 'required',
        'id_kelas' => 'required',
        'id_ekstrakurikuler' => 'required',
    ]);

    // Ambil objek model siswa berdasarkan id_siswa
    $siswa = siswa::findOrFail($id_siswa);

    // Data yang akan diperbarui
    $data = [
        'NIS' => $request->NIS,
        'email' => $request->email,
        'password' => $request->password,
        'nama_siswa' => $request->nama_siswa,
        'jenis_kelamin' => $request->jenis_kelamin,
        'id_kelas' => $request->id_kelas,
        'id_ekstrakurikuler' => $request->id_ekstrakurikuler,
    ];

    // Periksa jika ada file foto yang diunggah
    if ($request->hasFile('foto')) {

    


    // Perbarui data siswa
    $siswa->update($data);

    return redirect()->route('siswa.index')->with('success', 'siswa updated successfully');

}}



    // public function destroy(siswa $siswa)
    // {
    //     // $siswa->delete();
    //     siswa::where('id_siswa', $siswa)->delete();
    //     \Log::info('Deleting Siswa:', ['siswa' => $siswa]);
    //     return redirect()->route('siswa.index')->with('success','siswa deleted successfully');
    // }


    public function destroy($id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);

        File::delete(public_path('foto_siswa') . '/' . $siswa->foto);

        $siswa->delete();


        //redirect to index
        return redirect()->route('siswa.index')->with('success', 'Data Berhasil Dihapus!');

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus');

    }
}
