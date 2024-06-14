<?php

namespace App\Http\Controllers\admin\absensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AbsensiAdmin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DataAbsensiController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil ID admin yang sedang login
        $adminId = Auth::id();

        // Mengambil bulan yang dipilih dari permintaan AJAX atau default ke bulan ini
        $monthYear = $request->input('month', Carbon::now()->format('Y-m'));
        $startDate = Carbon::createFromFormat('Y-m', $monthYear)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $monthYear)->endOfMonth();

        // Mengambil data absensi berdasarkan bulan yang dipilih
        $absensi = AbsensiAdmin::where('id_admin', $adminId)
                              ->whereBetween('tanggal', [$startDate, $endDate])
                              ->orderBy('tanggal', 'desc')
                              ->with('admin')
                              ->get();

        // Jika permintaan AJAX, kembalikan data dalam format JSON
        if ($request->ajax()) {
            return response()->json($absensi);
        }

        // Jika bukan permintaan AJAX, kirim data ke view
        return view('admin/absensi.data-absensi', compact('absensi', 'monthYear'));
    }
}
