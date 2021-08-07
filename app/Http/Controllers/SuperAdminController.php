<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function index()
    {
        // True jika ada user yang login dan status masih aktif.
        if (Auth::check() == 1) {
            // True jika user yang login adalah admin.
            if (Auth::user()->tipe_user_id == 1) {
                return view('superAdmin.main.dashboard');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('/');
        }
    }
}

