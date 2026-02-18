<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProfileCompleteMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        if ($user->isAdmin()) {
            return $next($request);
        }

        if (!$user->profile_completed) {
            if ($user->isSiswa()) {
                return redirect()->route('siswa.profil');
            }
            if ($user->isDudi()) {
                return redirect()->route('dudi.profil');
            }
        }

        return $next($request);
    }
}