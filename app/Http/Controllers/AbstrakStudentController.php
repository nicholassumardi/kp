<?php

namespace App\Http\Controllers;

use App\Models\Abstrak;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbstrakStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.student')->only(['index', 'create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['mahasiswa'] = Mahasiswa::where('user_id', Auth::id())->first();
        $this->dataView['data_abstract'] = Abstrak::where('mahasiswa_id', $this->dataView['mahasiswa']->id_mahasiswa)->get();

        return view('student.main.abstract_student.index', $this->dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->dataView['mahasiswa'] = Mahasiswa::where('user_id', Auth::id())->first();
        return view('student.main.abstract_student.create', $this->dataView);
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
            'path_foto_kuitansi' => 'required',
            'path_file_abstrak_mahasiswa' => 'required'
        ]);

        // Variabel
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        // Jika foto kuitansi dan file abstrak ada.
        if (
            $request->hasFile('path_foto_kuitansi') &&
            $request->hasFile('path_file_abstrak_mahasiswa')
        ) {
            // Jika format foto dan file abstrak benar
            if (
                $this->isMimeFileMatches(
                    [$request->path_foto_kuitansi],
                    ['image/jpeg', 'image/png']
                )
                &&
                $this->isMimeFileMatches(
                    [$request->path_file_abstrak_mahasiswa],
                    ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
                )
            ) {
                Abstrak::create([
                    'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                    'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/abstrak/', 'public'),
                    'path_file_abstrak_mahasiswa' => $request->path_file_abstrak_mahasiswa->storeAs(
                        'dokumen/dokumen-abstrak/mahasiswa/', 
                        $request->path_file_abstrak_mahasiswa->getClientOriginalName(), 
                        'public'
                    ),
                    'status' => 'unverified'
                ]);
            }
            // Jika format foto dan file abstrak salah
            else {
                return redirect()->route('abstract-student.index')
                    ->with('error', 'Gagal terkirim karena format tidak sesuai!');
            }
        }

        return redirect()->route('abstract-student.index')
            ->with('success', 'Berhasil terkirim!');
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
}
