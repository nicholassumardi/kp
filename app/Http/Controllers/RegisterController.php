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
        $user = User::where('email', $request->email)->first();

        // Jika tipe user adalah mahasiswa.
        if (strval($request->id_tipe_user) === strval(4)) {
            $request->validate([
                'id_tipe_user' => 'required',
                'email' => 'required|email',
                'nama' => 'required',
                'npm' => 'required',
                'password' => 'required'
            ]);

            $mahasiswa = Mahasiswa::where('npm', $request->npm)->first();

            // Jika NPM mahasiswa belum ada di database / belum pernah terdaftar
            // dan email user belum ada di database / belum pernah terdaftar.
            if ($mahasiswa === null && $user === null) {
                $user = User::create([
                    'email' => $request->email,
                    'nama' => $request->nama,
                    'password' => Hash::make($request->password),
                    'tipe_user_id' => $request->id_tipe_user
                ]);

                Mahasiswa::create([
                    'nama' => $request->nama,
                    'npm' => $request->npm,
                    'user_id' => $user->id_user
                ]);
            }
            // Jika sudah pernah daftar.
            else {
                if ($mahasiswa !== null && $user !== null) {
                    return redirect()->back()
                        ->with('error', "User dengan email ($request->email) dan NPM ($request->npm) sudah terdaftar!");
                } else if ($mahasiswa !== null && $user === null) {
                    return redirect()->back()
                        ->with('error', "User dengan NPM ($request->npm) sudah terdaftar!");
                } else if ($mahasiswa === null && $user !== null) {
                    return redirect()->back()
                        ->with('error', "User dengan email ($request->email) sudah terdaftar!");
                }
            }
        }
        // Jika tipe user adalah umum.
        else {
            $request->validate([
                'id_tipe_user' => 'required',
                'email' => 'required|email',
                'nama' => 'required',
                'password' => 'required'
            ]);

            // Jika email user belum ada di database / belum pernah terdaftar.
            if ($user === null) {
                $user = User::create([
                    'email' => $request->email,
                    'nama' => $request->nama,
                    'password' => Hash::make($request->password),
                    'tipe_user_id' => $request->id_tipe_user
                ]);

                Umum::create([
                    'nama' => $request->nama,
                    'user_id' => $user->id_user
                ]);
            }
            // Jika sudah pernah daftar.
            else {
                return redirect()->back()
                    ->with('error', "User dengan email ($request->email) sudah terdaftar!");
            }
        }

        return redirect()->route('login.form')
            ->with('success', 'Register berhasil, silahkan melakukan Sign-in!');
    }
}
