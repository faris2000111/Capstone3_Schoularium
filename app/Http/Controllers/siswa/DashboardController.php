<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function index(){
       

        return view('siswa.dashboard');
    }

}