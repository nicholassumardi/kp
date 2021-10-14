<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Mahasiswa;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->back();
        } else {
            return view('frontpages.account.sign-in.index');
        }
    }

    public function isSuperAdmin($username, $password)
    {
        // True jika data login benar.
        return Auth::attempt([
            'email' => $username,
            'password' => $password,
            'tipe_user_id' => 1
        ]);
    }

    public function isAdmin($username, $password)
    {
        // Jika data login benar (admin PUSBA).
        if (Auth::attempt([
            'email' => $username,
            'password' => $password,
            'status' => 1,
            'tipe_user_id' => 2
        ])) {
            return true;
        }
        // Jika data login benar (admin abstrak).
        elseif (Auth::attempt([
            'email' => $username,
            'password' => $password,
            'status' => 1,
            'tipe_user_id' => 3
        ])) {
            return true;
        }

        return false;
    }

    public function isMahasiswa($username, $password)
    {
        // True jika data login menggunakan email benar.
        if (Auth::attempt([
            'email' => $username,
            'password' => $password,
            'status' => 1,
            'tipe_user_id' => 4
        ])) {
            return true;
        } else { // True jika data login menggunakan NPM benar.
            $mahasiswa = Mahasiswa::where('npm', $username)->first();

            if ($mahasiswa != null) {
                $user = User::where('id_user', $mahasiswa->user_id)->first();

                if (Auth::attempt([
                    'email' => $user->email,
                    'password' => $password,
                    'status' => 1,
                    'tipe_user_id' => 4
                ])) {
                    return true;
                }
            }
        }

        return false;
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->username;
        $password = $request->password;

        if ($this->isSuperAdmin($username, $password)) {
            return redirect()->route('super-admin.index');
        }

        if ($this->isAdmin($username, $password)) {
            return redirect()->route('admin.index');
        }

        if ($this->isMahasiswa($username, $password)) {
            return redirect()->route('student.index');
        }

        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
