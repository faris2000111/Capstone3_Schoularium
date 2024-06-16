<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GuruOnly
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->jabatan === 'admin' || Auth::user()->jabatan === 'guru')) {
            return $next($request);
        }        

        return redirect()->route('dashboard.index')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
