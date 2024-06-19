<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->jabatan;

            if ($usertype == 'siswa') {
                return redirect()->intended('/dashboard/siswa');
            } else if ($usertype == 'admin') {
                return view('admin.dashboard');
            }
            else if ($usertype == 'guru') {
                return view('admin.dashboard');
            }
        }
        // return view('admin.dashboard');
    }
}
