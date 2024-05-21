<?php

namespace App\Http\Controllers\admin\absensi;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Absensi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbsensiGuruController extends Controller
{
    public function index()
    {
        $absens = Admin::all();
        return view('admin/absensi.absensi-guru', compact('absens'));
    }
    public function store(Request $request)
    {
        $absensiData = $request->input('absensi');
        foreach ($absensiData as $adminId => $data) {
            Absensi::create([
                'id_admin' => $adminId,
                'status_kehadiran' => $data['status_kehadiran'],
                'alasan_ketidakhadiran' => $data['alasan_ketidakhadiran'] ?? null,
            ]);
        }

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil disimpan.');
    }
    public function show()
    {
        $absens = Admin::all();
        return view('admin/absensi.absensi', compact('absens'));
    }
}