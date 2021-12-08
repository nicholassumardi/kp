<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Umum;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        if (Auth::check()) {
            return redirect()->back();
        } else {
            return view('frontpages.account.register.index');
        }
    }

    public function store(Request $request)
    {
        $user = User::Create([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'tipe_user_id' => $request->id_tipe_user
        ]);
        
        // Jika tipe user adalah mahasiswa.
        if (strval($request->id_tipe_user) === strval(4)) {
            $request->validate([
                'id_tipe_user' => 'required',
                'email' => 'required|email',
                'nama' => 'required',
                'npm' => 'required',
                'password' => 'required'
            ]);
            
            Mahasiswa::create([
                'nama' => $request->nama,
                'npm' => $request->npm,
                'user_id' => $user->id_user
            ]);
        } 
        // Jika tipe user adalah umum.
        else {
            $request->validate([
                'id_tipe_user' => 'required',
                'email' => 'required|email',
                'nama' => 'required',
                'password' => 'required'
            ]);

            Umum::create([
                'nama' => $request->nama,
                'user_id' => $user->id_user
            ]);
        }        

        return redirect()->route('login.form');
    }
}
