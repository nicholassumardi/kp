<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth.admin')->only(['index']);
    }

    public function index()
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        $this->dataView['data_kursus'] = Course::all();
        return view('admin.main.dashboard_admin.index', $this->dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
 
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
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        $this->dataView['nama_mahasiswa'] = Mahasiswa::select('nama')
        ->join('detail_kursus', 'detail_kursus.mahasiswa_id', '=', 'mahasiswa.id_mahasiswa')
        ->where('kursus_id', $id)
        ->get();
        $this->dataView['nama_kursus'] = Course::select('nama_kursus')
        ->join('detail_kursus', 'detail_kursus.kursus_id', '=', 'kursus.id_kursus')
        ->where('kursus_id', $id)
        ->get();
        $this->dataView['data_kursus'] = CourseDetail::where('kursus_id', $id)->get();
        return view('admin.main.dashboard_admin.edit', $this->dataView);
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

        CourseDetail::where('mahasiswa_id', $id)->update(['status_verifikasi' => 1]);
      
        return redirect()->back()
            ->with('success','Post updated successfully.');
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

    public function sendKomentar(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        CourseDetail::where('mahasiswa_id', $id)->update(['komentar' => $request->komentar]);
      
        return redirect()->back()
            ->with('success','Post updated successfully.');
    }
}
