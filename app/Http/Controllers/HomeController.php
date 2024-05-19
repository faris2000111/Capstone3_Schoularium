<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Mengambil total jumlah artikel
        $totalArtikel = Artikel::count();

        // Mengambil total jumlah kategori
        $totalKategori = Kategori::count();

        // Mengambil jumlah user terdaftar
        $totalUser = User::count();

        return view('home', compact('totalArtikel', 'totalKategori','totalUser'));
    }
}