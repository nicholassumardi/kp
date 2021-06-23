<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Mahasiswa;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        if (Auth::check() == 1) {
            return redirect()->back();
        } else {
            return view('frontpages.account.register.index');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nama' => 'required',
            'npm' => 'required',
            'password' => 'required'
        ]);

        $user = User::Create([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password)
        ]);

        Mahasiswa::create([
            'nama' => $request->nama,
            'npm' => $request->npm,
            'user_id' => $user->id_user
        ]);

        return redirect()->route('login.form');
    }
}
