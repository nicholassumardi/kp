<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only(['index', 'create', 'edit']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        $this->dataView['dataadmin'] = Course::all();
        return view('admin.main.courses_admin.courses.index', $this->dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        return view('admin.main.courses_admin.courses.create', $this->dataView);
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
            'tipe_kursus' => 'required',
            'nama_kursus' => 'required',
            'status' => 'required',
            'sertifikat' => 'required',
            'batas_partisipan' => 'required',
            'group_link' => 'required'
        ]);

        $idAdmin = Admin::where('user_id', Auth::id())->first();

        Course::create([
            'admin_id' => $idAdmin->id_admin,
            'tipe_kursus' => $request->tipe_kursus,
            'nama_kursus' => $request->nama_kursus,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'sertifikat' => $request->sertifikat,
            'batas_partisipan' => $request->batas_partisipan,
            'group_link' => $request->group_link
        ]);

        return redirect()->route('addCourse.index')
            ->with('success', 'Course created successfully.');
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
        $this->dataView['dataKursus'] = Course::where('id_kursus', $id)->first();

        return view('admin.main.courses_admin.courses.edit', $this->dataView);
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
        $request->validate([
            'tipe_kursus' => 'required',
            'nama_kursus' => 'required',
            'status' => 'required',
            'sertifikat' => 'required',
            'batas_partisipan' => 'required',
            'group_link' => 'required'
        ]);

        $idAdmin = Admin::where('user_id', Auth::id())->first();

        Course::where('id_kursus', $id)->update([
            'admin_id' => $idAdmin->id_admin,
            'tipe_kursus' => $request->tipe_kursus,
            'nama_kursus' => $request->nama_kursus,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'sertifikat' => $request->sertifikat,
            'batas_partisipan' => $request->batas_partisipan,
            'group_link' => $request->group_link
        ]);

        return redirect()->route('addCourse.index')
            ->with('success', 'Course updated successfully.');
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

    public function deactiveCourse($id_kursus)
    {
        Course::where('id_kursus', $id_kursus)->update([
            'status' => 0
        ]);
        
        return redirect()->route('addCourse.index')
            ->with('success', 'Course deactivated successfully.');
    }
}
