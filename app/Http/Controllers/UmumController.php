<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDetailUmum;
use App\Models\Umum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UmumController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth.umum')->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['umum'] = Umum::where('user_id', Auth::id())->first();
        $this->dataView['kursus'] = Umum::where('user_id', Auth::id())->first()->kursus()->paginate(4);

        return view('public.main.dashboard_public.index',  $this->dataView);
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
        $this->dataView['kursus'] = Course::where('id_kursus', $id)->first();
        $this->dataView['umum'] = Umum::where('user_id', Auth::id())->first();
        $this->dataView['kursus_index_pertama'] = Course::select('sertifikat')->first();


        return view('public.main.dashboard_public.edit',  $this->dataView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_umum, $id_kursus)
    {
        $request->validate([
            'path_foto_kuitansi' =>'required',
            'path_foto_mahasiswa' => 'required',
        ]);
        if ($request->hasFile('path_foto_sertifikat')) {
            // Jika format foto benar
            if ($this->isMimeFileMatches(
                [
                    $request->path_foto_kuitansi,
                    $request->path_foto_umum,
                    $request->path_foto_sertifikat
                ],
                ['image/jpeg', 'image/png']
            )) {
                CourseDetailUmum::where('umum_id', $id_umum)->where('kursus_id', $id_kursus)->update([
                    'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
                    'path_foto_umum' => $request->path_foto_umum->store('images/foto-umum/', 'public'),
                    'path_foto_sertifikat' => $request->path_foto_sertifikat->store('images/foto-sertifikat/', 'public'),
                ]);
            }
            // Jika format foto salah
            else {
                return redirect()->route('registerCourses.index')
                    ->with('error', 'Update gagal, format file salah!');
            }
        }
        // Jika foto sertifikat tidak ada
        else {
            // Jika format foto benar
            if ($this->isMimeFileMatches(
                [
                    $request->path_foto_kuitansi,
                    $request->path_foto_mahasiswa
                ],
                ['image/jpeg', 'image/png']
            )) {

                CourseDetailUmum::where('umum_id', $id_umum)->where('kursus_id', $id_kursus)->update([
                    'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
                    'path_foto_umum' => $request->path_foto_umum->store('images/foto-umum/', 'public'),
                ]);
            }
            // Jika format foto salah
            else {
                return redirect()->back()
                    ->with('error', 'Update gagal, format file salah!');
            }
        }

        return redirect()->route('student.index')
            ->with('success', 'Update berhasil!');
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
