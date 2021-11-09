<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUmum
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
        // True jika ada user yang login.
        if (Auth::check()) {
            // True jika user yang login adalah jenis umum.
            if (Auth::user()->tipe_user_id === 5) {
                return $next($request);
            } elseif (Auth::user()->tipe_user_id === 1) {
                return redirect()->route('super-admin.index');
            } elseif (
                Auth::user()->tipe_user_id === 2 ||
                Auth::user()->tipe_user_id === 3
            ) {
                return redirect()->route('admin.index');
            } elseif (Auth::user()->tipe_user_id === 4) {
                return redirect()->route('student.index');
            }
        } else {
            return redirect()->route('/');
        }
    }
}
