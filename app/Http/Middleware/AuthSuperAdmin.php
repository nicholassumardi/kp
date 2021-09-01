<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthSuperAdmin
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
        // True jika ada user yang login dan status masih aktif.
        if (Auth::check()) {
            // True jika user yang login adalah Super Admin.
            if (Auth::user()->tipe_user_id === 1) {
                return $next($request);
            } elseif (Auth::user()->tipe_user_id === 2) {
                return redirect()->route('admin.index');
            } elseif (Auth::user()->tipe_user_id === 3) {
                return redirect()->route('student.index');
            }
        } else {
            return redirect()->route('/');
        }
    }
}
