<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        return view('admin.main.profile_admin.index', $this->dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->dataView['admin'] = Admin::where('user_id', $id)->first();
        $this->dataView['user'] = User::whereHas(
            'admin',
            function (Builder $query) use ($id) {
                $query->where('user_id', $id);
            }
        )->first();
        return view('admin.main.profile_admin.index', $this->dataView);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('file')) { // Jika foto ada
            $request->validate([
                'nama' => 'required',
                'umur' => 'required',
                'alamat' => 'required',
                'kota' => 'required',
                'negara' => 'required',
                'email' => 'required',
                'file' => 'mimes:jpeg,png' // Only allow .jpg and .png file types.
            ]);

            Admin::where('user_id', $id)->update([
                'nama' => $request->nama,
                'umur'  => $request->umur,
                'alamat'  => $request->alamat,
                'kota' => $request->kota,
                'negara' => $request->negara,
                'path_foto' => $request->file->store('images/profile/admin', 'public')
            ]);
        } else { // Jika foto tidak ada
            $request->validate([
                'nama' => 'required',
                'umur' => 'required',
                'alamat' => 'required',
                'kota' => 'required',
                'negara' => 'required',
                'email' => 'required',
            ]);

            Admin::where('user_id', $id)->update([
                'nama' => $request->nama,
                'umur'  => $request->umur,
                'alamat'  => $request->alamat,
                'kota' => $request->kota,
                'negara' => $request->negara
            ]);
        }

        // Jika password ada, input email dan password.
        if ($request->filled('newpassword')) {
            User::where('id_user', $id)->update([
                'email' => $request->email,
                'password' => Hash::make($request->newpassword)
            ]);
        } else { // Input email saja
            User::where('id_user', $id)->update([
                'email' => $request->email
            ]);
        }

        return redirect()->back()
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
