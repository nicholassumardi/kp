<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        // True jika ada user yang login dan status masih aktif.
        if (Auth::check() == 1) {
            // True jika user yang login adalah admin.
            if (Auth::user()->tipe_user_id == 3) {
                return view('student.main.dashboard');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('/');
        }
    }
}
