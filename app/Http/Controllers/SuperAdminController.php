<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.super-admin')->only(['index', 'create']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['nama'] = 'Super Admin';
        $this->dataView['listAdmin'] = User::whereIn('tipe_user_id', [2, 3])->get();

        return view('superAdmin.main.dashboard.index', $this->dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->dataView['nama'] = 'Super Admin';

        return view('superAdmin.main.dashboard.create', $this->dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tipe_user' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $user = User::Create([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'tipe_user_id' => $request->id_tipe_user
        ]);
        
        Admin::create([
            'nama' => $request->nama,
            'user_id' => $user->id_user
        ]);

        return redirect()->route('super-admin.index')
            ->with('success', 'Admin account created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        // mengubah data berdasarkan request dan parameter yang dikirimkan
        User::where('id_user', $id )->update(['status' => $request->status]);
         
        // setelah berhasil mengubah data
        return redirect()->route('super-admin.index')
            ->with('success','Status updated successfully.');
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
