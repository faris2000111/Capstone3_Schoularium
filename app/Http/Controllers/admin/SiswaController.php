<?php

namespace App\Http\Controllers\admin;

use App\Models\siswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\RedirectResponse;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = siswa::latest()->paginate(5);
        return view('admin/siswa.index',compact('siswa'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function create()
    {
        return view('admin/siswa.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'NIS' => 'required',
            'email' => 'required',
            'password' => 'required',
            'nama_siswa' => 'required',
            'kelas' => 'required',
            'ekstrakurikuler' => 'required',
            'foto'     => 'mimes:jpeg,jpg,png|max:1024',
        ]);
        $siswa = [
            'NIS'   => $request->NIS,
            'email'   => $request->email,
            'password' => Hash::make($request->password),
            'nama_siswa'   => $request->nama_siswa,
            'kelas'   => $request->kelas,
            'ekstrakurikuler'   => $request->ekstrakurikuler,
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
    }
    public function show(siswa $siswa)
    {
        // return view('siswa.show',compact('siswa'));
    }
    
    // public function edit(siswa $siswa)
    // {
    //     return view('siswa.edit',compact('siswa'));
    // }
    
    public function edit(siswa $siswa)
    {
        return view('admin/siswa.edit', compact('siswa'));
    }
    // public function update(Request $request, string $id_siswa)
    // {
    //     $request->validate([
    //         'NIS' => 'required',
    //         'email' => 'required',
    //         'password' => 'required',
    //         'nama_siswa' => 'required',
    //         'kelas' => 'required',
    //         'ekstrakurikuler' => 'required',
    //     ]);
    //     $siswa = [
    //         'NIS'   => $request->NIS,
    //         'email'   => $request->email,
    //         'password'   => $request->password,
    //         'nama_siswa'   => $request->nama_siswa,
    //         'kelas'   => $request->kelas,
    //         'ekstrakurikuler'   => $request->ekstrakurikuler,
    //     ];

    //     if ($request->hasFile('foto')) {
    //         $request->validate([
    //             'foto'     => 'mimes:jpeg,jpg,png|max:1024',
    //         ]);
    //         $foto_file = $request->file('foto');
    //         $foto_nama = $foto_file->hashName();
    //         $foto_file->move(public_path('foto_siswa'), $foto_nama);
    //         $siswa = siswa::where('id', $id)->first();
    //         File::delete(public_path('foto_siswa'). '/' .$siswa->foto);
    //         $siswa['foto'] = $foto_nama;
            
    //     }
  
    //     // $siswa->update($request->all());
    //     siswa::where('id', $id)->update($siswa);
  
    //     return redirect()->route('siswa.index')->with('success','siswa updated successfully');
    // }
    
    public function update(Request $request, string $id_siswa)
{
    $request->validate([
        'NIS' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'nama_siswa' => 'required',
        'kelas' => 'required',
        'ekstrakurikuler' => 'required',
    ]);

    // Ambil objek model siswa berdasarkan id_siswa
    $siswa = siswa::findOrFail($id_siswa);

    // Data yang akan diperbarui
    $data = [
        'NIS' => $request->NIS,
        'email' => $request->email,
        'password' => $request->password,
        'nama_siswa' => $request->nama_siswa,
        'kelas' => $request->kelas,
        'ekstrakurikuler' => $request->ekstrakurikuler,
    ];

    // Periksa jika ada file foto yang diunggah
    if ($request->hasFile('foto')) {
        $request->validate([
            'foto' => 'mimes:jpeg,jpg,png|max:1024',
        ]);
        $foto_file = $request->file('foto');
        $foto_nama = $foto_file->hashName();
        $foto_file->move(public_path('foto_siswa'), $foto_nama);

        // Hapus foto lama jika ada
        File::delete(public_path('foto_siswa') . '/' . $siswa->foto);

        // Tambahkan nama file foto baru ke data yang akan diperbarui
        $data['foto'] = $foto_nama;
    }

    // Perbarui data siswa
    $siswa->update($data);

    return redirect()->route('admin/siswa.index')->with('success', 'siswa updated successfully');
}



    // public function destroy(siswa $siswa)
    // {
    //     // $siswa->delete();
    //     siswa::where('id_siswa', $siswa)->delete();
    //     \Log::info('Deleting Siswa:', ['siswa' => $siswa]);
    //     return redirect()->route('siswa.index')->with('success','siswa deleted successfully');
    // }

    public function destroy($id_siswa)
    {
        //get post by ID_siswa
        $siswa = siswa::findOrFail($id_siswa);

        //delete image
        // Storage::delete('foto_siswa/'. $post->foto);
        File::delete(public_path('foto_siswa') . '/' . $siswa->foto);

        //delete post
        $siswa->delete();

        //redirect to index
        return redirect()->route('admin/siswa.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
