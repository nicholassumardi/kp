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
        if (Auth::check()) {
            // True jika user yang login adalah admin.
            if (Auth::user()->tipe_user_id === 2) {
                $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
                return view('admin.main.dashboard_admin.index', $this->dataView);
            } elseif (Auth::user()->tipe_user_id === 1) {
                return redirect()->route('super-admin.index');
            } elseif (Auth::user()->tipe_user_id === 3) {
                return redirect()->route('student.index');
            }
        } else {
            return redirect()->route('/');
        }
    }
}
