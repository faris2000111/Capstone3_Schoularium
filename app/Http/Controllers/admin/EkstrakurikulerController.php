<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\ekstrakurikuler;
use App\Models\Admin;

use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ekstrakurikuler = ekstrakurikuler::all();
        return view('admin/siswa/ekstrakurikuler.index',compact('ekstrakurikuler'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = Admin::all();
        return view('admin/siswa/ekstrakurikuler.create', compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ekstrakurikuler' => 'required',
            'id_admin' => 'required',
        ]);
        $ekstrakurikuler = [
            'nama_ekstrakurikuler' => $request->nama_ekstrakurikuler,
            'id_admin' => $request->id_admin,
        ];
        ekstrakurikuler::create($ekstrakurikuler);

        return redirect()->route('ekstrakurikuler.index')->with('success','ekstrakurikuler created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ekstrakurikuler $ekstrakurikuler)
    {
        $admin = Admin::all();
        return view('admin/siswa/ekstrakurikuler.edit', compact('ekstrakurikuler','admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_ekstrakurikuler)
    {
        $request->validate([
            'nama_ekstrakurikuler' => 'required',
            'id_admin' => 'required',
        ]);
        $ekstrakurikuler = ekstrakurikuler::findOrFail($id_ekstrakurikuler);
        $data = [
            'nama_ekstrakurikuler' => $request->nama_ekstrakurikuler,
            'id_admin' => $request->id_admin,
        ];
        $ekstrakurikuler->update($data);

        return redirect()->route('ekstrakurikuler.index')->with('success', 'siswa updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_ekstrakurikuler)
    {
        $ekstrakurikuler = ekstrakurikuler::findOrFail($id_ekstrakurikuler);

        //delete post
        $ekstrakurikuler->delete();

        //redirect to index
        return redirect()->route('ekstrakurikuler.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
