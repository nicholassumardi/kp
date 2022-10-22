<?php

namespace App\Http\Controllers;

use App\Jobs\EmailProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Token;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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

    public function isUmum($username, $password)
    {
        // Jika data login benar (Umum/ Public).
        if (Auth::attempt([
            'email' => $username,
            'password' => $password,
            'status' => 1,
            'tipe_user_id' => 5
        ])) {
            return true;
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
        if ($this->isUmum($username, $password)) {
            return redirect()->route('umum.index');
        }

        return redirect()->back()
            ->with('error', 'Username atau password salah, silahkan login kembali!');
    }

    public function forgotPassword(Request $request)
    {
        $account = User::where('email', $request->email)->first();
        if ($account) {
            // Token::where('tokenable_type', $account->tipe_user_id)
            //     ->where('tokenable_id', $account->id)
            //     ->where('type', 2)
            //     ->update(['status' => 2]);

            $token = Token::create([
                'tokenable_type' => $account->tipe_user_id,
                'tokenable_id'   => $account->id_user,
                'token'          => Str::random(45),
                'valid'          => date('Y-m-d H:i:s', strtotime('+1 day')),
            ]);

            $payload = [
                'name'    => $account->nama,
                'email'   => $account->email,
                'link'    => url('reset_password?token=' . base64_encode($token->token)),
                'view'    => 'reset_password.index',
                'subject' => 'PUSBA | Reset Password'
            ];


            dispatch(new EmailProcess($payload));

            $response = [
                'status'  => 200,
                'message' => 'The password reset link has been successfully sent to your email, valid 1 day'
            ];
        } else {
            $response = [
                'status'  => 400,
                'message' => 'Email not registered'
            ];
        }

        return response()->json($response);
    }

    public function resetPassword(Request $request)
    {
        
        $token    = base64_decode($request->token);
        $customer = Token::where('token', $token)
            ->first();

        if ($customer) {
            if ($request->has('_token') && session()->token() == $request->_token) {
                $validation = Validator::make($request->all(), [
                    'password'              => 'required',
                    'confirm_password' => 'required|same:password'
                ], [
                    'password.required'              => 'Password cannot be empty',
                    'confirm_password.required' => 'Password confirmation cannot be empty',
                    'confirm_password.same'     => 'Password confirmation not match with password',
                ]);

                if ($validation->fails()) {
                    return redirect()->back()->withErrors($validation);
                } else {
                     User::whereHas('token', function($query) use ($request){
                        $query->where('token', base64_decode($request->token));
                    }
                    )->update([
                        'password' => Hash::make($request->password)
                    ]);

                    return redirect('/')->with(['success' => 'Password successfully reset']);
                }
            } else {

                return view('frontpages.account.reset_password.index');
            }
        }



        return redirect()->route('login.form');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
