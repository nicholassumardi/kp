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
        if (Auth::check()) {
            // True jika user yang login adalah admin.
            if (Auth::user()->tipe_user_id === 3) {
                $this->dataView['mahasiswa'] = Mahasiswa::where('user_id', Auth::id())->first();
                return view('student.main.dashboard_student.index',  $this->dataView);
            } elseif (Auth::user()->tipe_user_id === 1) {
                return redirect()->route('super-admin.index');
            } elseif (Auth::user()->tipe_user_id === 2) {
                return redirect()->route('admin.index');
            }
        } else {
            return redirect()->route('/');
        }
    }
}
