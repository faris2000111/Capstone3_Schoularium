<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('admin/daftarkelas/kelas1.daftar-kelas', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/daftarkelas/kelas1.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'nama_siswa' => $request->nama_siswa,
            'nama_walikelas' => $request->nama_walikelas
        ]);

        return redirect()->route('daftar-kelas.index')->with('success', 'Class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('admin/daftarkelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('admin/daftarkelas/kelas1.edit', compact('kelas'));
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        return redirect()->route('daftar-kelas.index')->with('success', 'Admin deleted successfully.');
    }
}
