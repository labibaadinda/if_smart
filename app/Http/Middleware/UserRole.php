<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role == $role)
        {
            return $next($request);
        }

        if(Auth::user()->role == 'admin'){
            return redirect('/dashboard-dinas');
        }
        else if(Auth::user()->role == 'mahasiswa'){
            return redirect('/dashboard-mahasiswa');
        }
        else if(Auth::user()->role == 'dosen'){
            return redirect()->route('dosen');
        }
        else if(Auth::user()->role == 'departemen'){
            return redirect('departemen');
        }
    }
}
