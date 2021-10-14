<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthHome
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika tidak ada user yang login.
        if ( ! Auth::check()) {
            return $next($request);
        } 
        // Jika ada user yang login
        else {
            if (Auth::user()->tipe_user_id === 1) {
                return redirect()->route('super-admin.index');
            } elseif (
                Auth::user()->tipe_user_id === 2 ||
                Auth::user()->tipe_user_id === 3
            ) {
                return redirect()->route('admin.index');
            } elseif (Auth::user()->tipe_user_id === 4) {
                return redirect()->route('student.index');
            }
        }
    }
}
