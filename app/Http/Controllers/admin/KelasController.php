<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = DB::table('kelas')
            ->join('admin', 'kelas.id_admin', '=', 'admin.id_admin')
            ->select('kelas.*', 'admin.*')
            ->get();

        return view('admin/daftarkelas/kelas1.daftar-kelas', compact('kelas'));

    }



    public function indexStudents($id_kelas)
    {
        // Mengambil data siswa dari kelas tertentu
        $siswa = DB::table('kelas')
            ->join('siswa', 'kelas.id_kelas', '=', 'siswa.id_kelas')
            ->where('kelas.id_kelas', '=', $id_kelas)
            ->select('siswa.*')
            ->get();

        return view('admin.daftarkelas.kelas1.daftar-siswa', compact('siswa', 'id_kelas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Admin::all();
        return view('admin/daftarkelas/kelas1.create', compact('kelas'));
    }

    public function createStudent()
    {
        return view('admin.daftarkelas.kelas1.create-siswa');
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'id_admin' => $request->id_admin
        ]);

        return redirect()->route('daftar-kelas.index')->with('success', 'Class created successfully.');
    }
    public function storeStudent(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'NIS' => 'required|string|max:255|unique:siswa,NIS',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'id_ekstrakurikuler' => 'required|exists:ekstrakurikuler,id',
        ]);

        $fotoPath = $request->file('foto')->store('images', 'public');

        Siswa::create([
            'nama_siswa' => $request->nama_siswa,
            'NIS' => $request->NIS,
            'foto' => $fotoPath,
            'id_kelas' => $request->id_kelas,
            'id_ekstrakurikuler' => $request->id_ekstrakurikuler,
        ]);

        return redirect()->route('daftar-siswa.indexStudents')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where('kelas.id_kelas', '=', $id)
            ->get();
        $kelas = Kelas::findOrFail($id);
        return view('admin/daftarkelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $admin = Admin::all();
        return view('admin/daftarkelas/kelas1.edit', compact('admin', 'kelas'));
    }

    public function editStudent($nis)
    {
        $siswa = Siswa::where('NIS', $nis)->firstOrFail();
        return view('admin.daftarkelas.kelas1.edit-siswa', compact('siswa'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());

        return redirect()->route('daftar-kelas.index')->with('success', 'Class updated successfully.');
    }

    public function updateStudent(Request $request, $nis)
    {
        $siswa = Siswa::where('NIS', $nis)->firstOrFail();
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'NIS' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:siswa,email,' . $siswa->NIS . ',NIS',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->email = $request->email;
        $siswa->NIS = $request->NIS;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('images', 'public');
            $siswa->foto = $fotoPath;
        }

        $siswa->save();

        return redirect()->route('daftar-siswa.indexStudents', $siswa->id_kelas)->with('success', 'Student updated successfully.');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        return redirect()->route('daftar-kelas.index')->with('success', 'Class deleted successfully.');
    }

    public function destroyStudent($nis)
    {
        $siswa = Siswa::where('NIS', $nis)->firstOrFail();
        $siswa->delete();

        return redirect()->route('daftar-siswa.indexStudents', $siswa->id_kelas)->with('success', 'Student deleted successfully.');
    }


}
