<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Mahasiswa;
use App\Models\ProofOfPayment;
use App\Models\Schedules;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;

class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['nama_kursus'] = Course::all();
        $this->dataView['jadwal'] = Schedules::where('kursus_id', Course::min('id_kursus'))->get();
        $this->dataView['mahasiswa'] = Mahasiswa::where('user_id', Auth::id())->first();
        $this->dataView['kursus_index_pertama'] = Course::select('bukti_pembayaran')->first();
        return view('student.main.register_student.create', $this->dataView);
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
        // dd($request->all());
        $request->validate([
            'kursus_id' => 'required',
            'jadwal_id' => 'required',
            'path_foto_kuitansi' => 'required|mimes:jpeg,png'
        ]);

        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if ($request->hasFile('path_foto_mahasiswa')) { // Jika foto mahasiswa ada
            CourseDetail::create([
                'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                'kursus_id' => $request->kursus_id,
                'jadwal_id' => $request->jadwal_id,
                'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
                'path_foto_mahasiswa' => $request->path_foto_mahasiswa->store('images/foto-mahasiswa/', 'public'),
            ]);
        } else {
            CourseDetail::create([
                'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                'kursus_id' => $request->kursus_id,
                'jadwal_id' => $request->jadwal_id,
                'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
            ]);
        }
        
        return redirect()->route('registerCourses.index')
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
        //
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

    public function getSchedules($id)
	{
        $jadwal = Schedules::where('kursus_id', '=', $id)->get();
        
        return Response::json($jadwal);
	}

    public function getCourse($id)
	{
        $kursus = Course::where('id_kursus', '=', $id)->get();
        
        return Response::json($kursus);
	}

    // public function getIdKursus($id)
	// {
    //     $this->dataView['id_kursus'] = Course::where('id_kursus', '=', $id)->first();
        
    //     return view('student.main.register_student.create', $this->dataView);
	// }
}
