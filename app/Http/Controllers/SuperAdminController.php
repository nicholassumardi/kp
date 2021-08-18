<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listAdmin = User::where('tipe_user_id', 2)->get();
        
        // True jika ada user yang login dan status masih aktif.
        if (Auth::check()) {
            // True jika user yang login adalah Super Admin.
            if (Auth::user()->tipe_user_id === 1) {
                return view('superAdmin.main.dashboard.index', compact('listAdmin'));
            } elseif (Auth::user()->tipe_user_id === 2) {
                return redirect()->route('admin.index');
            } elseif (Auth::user()->tipe_user_id === 3) {
                return redirect()->route('student.index');
            }
        } else {
            return redirect()->route('/');
        }
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
        ->with('success','Post created successfully.');

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
