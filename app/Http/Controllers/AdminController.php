<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // True jika ada user yang login.
        if (Auth::check() == 1) {
            // True jika user yang login adalah admin.
            if (Auth::user()->tipe_user_id == 2) {
                return view('admin.main.dashboard_admin.index');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('/');
        }
    }
}
