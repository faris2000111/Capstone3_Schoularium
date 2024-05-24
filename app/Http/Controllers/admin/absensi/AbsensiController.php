<?php

namespace App\Http\Controllers\admin\absensi;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Absensi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $absens = Admin::all();
        return view('admin/absensi.absensi', compact('absens','user'));
    }
}