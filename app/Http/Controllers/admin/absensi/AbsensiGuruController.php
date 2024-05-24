<?php

namespace App\Http\Controllers\admin\absensi;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AbsensiAdmin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AbsensiGuruController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $absens = Admin::all();
        return view('admin/absensi.absensi-guru', compact('absens','user'));
    }
    public function store(Request $request)
{
    $id_admin = Auth::id();
    $todayDate = Carbon::now()->toDateString();

    $existingAbsensi = AbsensiAdmin::where('id_admin', $id_admin)
                                    ->whereDate('tanggal', $todayDate)
                                    ->first();

    if ($existingAbsensi) {
        return redirect()->back()->with('error', 'Anda sudah melakukan absensi hari ini.');
    }

    if ($request->status_kehadiran != 'Hadir' && !$request->alasan_ketidakhadiran) {
        return redirect()->back()->with('error', 'Alasan ketidakhadiran wajib diisi jika status kehadiran adalah Izin atau Sakit.');
    } elseif ($request->status_kehadiran != 'Hadir' && str_word_count($request->alasan_ketidakhadiran) < 10) {
        return redirect()->back()->with('error', 'Alasan ketidakhadiran harus memiliki minimal 10 kata.');
    }
    
    

    AbsensiAdmin::create([
        'id_admin' => $id_admin,
        'tanggal' => $todayDate,
        'status_kehadiran' => $request->status_kehadiran,
        'alasan_ketidakhadiran' => ($request->status_kehadiran == 'Hadir') ? null : $request->alasan_ketidakhadiran,
    ]);

    return redirect()->route('absensi.index')->with('success', 'Absensi berhasil disimpan.');
}

    public function show()
    {
        $absens = Admin::all();
        return view('admin/absensi.absensi', compact('absens'));
    }
}