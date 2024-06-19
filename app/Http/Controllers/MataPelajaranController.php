<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\DB;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mataPelajaran = DB::table('mata_pelajaran')
            ->join('admin', 'mata_pelajaran.id_admin', '=', 'admin.id_admin')
            ->select('mata_pelajaran.*', 'admin.*')
            ->get();

        return view('mata_pelajaran.index', compact('mataPelajaran'));

    }

    public function create()
    {
        $mataPelajaran = Admin::all();
        return view('mata_pelajaran.create', compact('mataPelajaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelajaran' => 'required|string|max:255',
            'id_admin' => 'required|exists:admin,id_admin',
        ]);

        MataPelajaran::create([
            'nama_pelajaran' => $request->nama_pelajaran,
            'id_admin' => $request->id_admin
        ]);

        return redirect()->route('mata_pelajaran.index')->with('success', 'Mata Pelajaran created successfully.');
    }

    public function edit(MataPelajaran $mataPelajaran)
    {
        return view('mata_pelajaran.edit', compact('mataPelajaran'));
    }

    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $request->validate([
            'nama_pelajaran' => 'required',
            'id_admin' => 'required|exists:users,id',
        ]);

        $mataPelajaran->update($request->all());
        return redirect()->route('mata_pelajaran.index')->with('success', 'Mata Pelajaran updated successfully.');
    }

    public function destroy(string $id)
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);

        $mataPelajaran->delete();
        return redirect()->route('mata_pelajaran.index')->with('success', 'Mata Pelajaran deleted successfully.');
    }
}
