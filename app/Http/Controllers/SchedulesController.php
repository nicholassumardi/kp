<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Course;
use App\Models\Mahasiswa;
use App\Models\Schedules;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchedulesController extends Controller
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
    
        $this->dataView['nama_kursus'] = Course::select('nama_kursus')
        ->join('jadwal', 'jadwal.kursus_id', '=', 'kursus.id_kursus')
        ->get();
        $this->dataView['jadwal'] = Schedules::all();
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        return view('admin.main.schedules_admin.index', $this->dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->dataView['kursus'] = Course::all();
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        return view('admin.main.schedules_admin.create',  $this->dataView);
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
            'kursus_id'=>'required',
            'hari'=>'required',
            'jadwal_mulai' => 'required',
            'jadwal_selesai' => 'required'
        ]);
      
        Schedules::create([
            'kursus_id' => $request->kursus_id,
            'hari' => $request->hari,
            'jadwal_mulai' => $request->jadwal_mulai,
            'jadwal_selesai' => $request->jadwal_selesai,
    
        ]);
        return redirect()->route('schedules.index')
        ->with('success','Post updated successfully.');
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
        $this->dataView['nama_kursus'] = Course::select('nama_kursus')
        ->join('jadwal', 'jadwal.kursus_id', '=', 'kursus.id_kursus')
        ->where('id_jadwal', $id)
        ->first();
        $this->dataView['jadwal'] = Schedules::where('id_jadwal', $id)->first();
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        return view('admin.main.schedules_admin.edit',  $this->dataView);
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
            'hari' => 'required',
            'jadwal_mulai'=>'required',
            'jadwal_selesai' => 'required',
        ]);
        
        Schedules::where('id_jadwal', $id)->update([
            'hari' => $request->hari,
            'jadwal_mulai'=>$request->jadwal_mulai,
            'jadwal_selesai' => $request->jadwal_selesai,
        ]);
        return redirect()->route('schedules.index')
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
        Schedules::where('id_jadwal', $id)->delete();
        return redirect()->route('schedules.index')
        ->with('success','Deleted successfully .');
    }
}
