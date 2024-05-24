<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function index(){
       

        return view('admin.dashboard', compact('user'));
    }

}