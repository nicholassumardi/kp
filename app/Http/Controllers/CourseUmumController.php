<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDetailUmum;
use App\Models\Umum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseUmumController extends Controller
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
        $this->dataView['nama_kursus'] = Course::whereNotIn('tipe_kursus', ['mahasiswa'])->get();
        // $this->dataView['jadwal'] = Schedules::where('kursus_id', Course::min('id_kursus'))->get();
        $this->dataView['umum'] = Umum::where('user_id', Auth::id())->first();
        $this->dataView['kursus_index_pertama'] = Course::select('sertifikat')->first();

        return view('public.main.register_public.create', $this->dataView);
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
        $request->validate([
            'kursus_id' => 'required',
            'path_foto_kuitansi' => 'required',
        ]);

        // Variabel
        $umum = Umum::where('user_id', Auth::id())->first();
        $kursus = Course::where('id_kursus', $request->kursus_id)->first();
        // $jadwal = Schedules::where('id_jadwal', $request->jadwal_id)->first();
        $isUmumBelumTerdaftarKursus = CourseDetailUmum::where('umum_id', $umum->id_umum)
            ->where('kursus_id', $request->kursus_id)
            ->doesntExist();


        // Jika kelas masih belum penuh
        if ($kursus->partisipan_saat_ini < $kursus->batas_partisipan) {
            // Jika umum belum terdaftar kursus, maka dapat melakukan registrasi.
            if ($isUmumBelumTerdaftarKursus) {
                // Jika foto sertifikat ada
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
                        $nomorKartuUmum = CourseDetailUmum::where('kursus_id', $request->kursus_id)->max('no_kartu_umum');
                        
                        // Jika kursus belum memiliki umum yang mendaftar
                        if ($nomorKartuUmum !== null) {
                            CourseDetailUmum::create([
                                'umum_id' => $umum->id_umum,
                                'kursus_id' => $request->kursus_id,
                                'no_kartu_umum' => $nomorKartuUmum + 1,
                                // 'jadwal_id' => $request->jadwal_id,
                                'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
                                'path_foto_umum' => $request->path_foto_umum->store('images/foto-umum/', 'public'),
                                'path_foto_sertifikat' => $request->path_foto_sertifikat->store('images/foto-sertifikat/', 'public'),
                            ]);
                        } 
                        // Jika kursus sudah memiliki umum yang mendaftar
                        else {
                            CourseDetailUmum::create([
                                'umum_id' => $umum->id_umum,
                                'kursus_id' => $request->kursus_id,
                                'no_kartu_umum' => 1,
                                // 'jadwal_id' => $request->jadwal_id,
                                'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
                                'path_foto_umum' => $request->path_foto_umum->store('images/foto-umum/', 'public'),
                                'path_foto_sertifikat' => $request->path_foto_sertifikat->store('images/foto-sertifikat/', 'public'),
                            ]);
                        }

                        // Tambahkan jumlah partisipan saat ini
                        Course::where('id_kursus', $request->kursus_id)
                            ->update(['partisipan_saat_ini' => $kursus->partisipan_saat_ini + 1]);
                    }
                    // Jika format foto salah
                    else {
                        return redirect()->route('registerCoursesPublic.index')
                            ->with('error', 'Registrasi gagal, format file salah!');
                    }
                }
                // Jika foto sertifikat tidak ada
                else {
                    // Jika format foto benar
                    if ($this->isMimeFileMatches(
                        [
                            $request->path_foto_kuitansi,
                            $request->path_foto_umum
                        ],
                        ['image/jpeg', 'image/png']
                    )) {
                        $nomorKartuUmum = CourseDetailUmum::where('kursus_id', $request->kursus_id)->max('no_kartu_umum');
                        
                        // Jika kursus belum memiliki umum yang mendaftar
                        if ($nomorKartuUmum !== null) {
                            CourseDetailUmum::create([
                                'umum_id' => $umum->id_umum,
                                'kursus_id' => $request->kursus_id,
                                'no_kartu_umum' => $nomorKartuUmum + 1,
                                // 'jadwal_id' => $request->jadwal_id,
                                'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
                                'path_foto_umum' => $request->path_foto_umum->store('images/foto-umum/', 'public'),
                            ]);
                        } 
                        // Jika kursus sudah memiliki umum yang mendaftar
                        else {
                            CourseDetailUmum::create([
                                'umum_id' => $umum->id_umum,
                                'kursus_id' => $request->kursus_id,
                                'no_kartu_umum' => 1,
                                // 'jadwal_id' => $request->jadwal_id,
                                'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
                                'path_foto_umum' => $request->path_foto_umum->store('images/foto-umum/', 'public'),
                            ]);
                        }

                        // Tambahkan jumlah partisipan saat ini
                        Course::where('id_kursus', $request->kursus_id)
                            ->update(['partisipan_saat_ini' => $kursus->partisipan_saat_ini + 1]);
                    }
                    // Jika format foto salah
                    else {
                        return redirect()->route('registerCoursesPublic.index')
                            ->with('error', 'Registrasi gagal, format file salah!');
                    }
                }

                return redirect()->route('registerCoursesPublic.index')
                    ->with('success', 'Registrasi berhasil!');
            }
            // Jika mahasiswa sudah terdaftar kursus, maka gagal registrasi.
            else {
                return redirect()->route('registerCoursesPublic.index')
                    ->with('error', 'Registrasi gagal, Anda sudah terdaftar pada kursus ini!');
            }
        }
        // Jika kelas sudah penuh
        else {
            return redirect()->route('registerCoursesPublic.index')
                ->with('error', 'Registrasi gagal, kelas sudah penuh!');
        }
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
    public function getCourse(Request $request, $id)
    {
        // Jika request ajax
        if ($request->ajax()) {
            $kursus = Course::where('id_kursus', '=', $id)->get();

            return response()->json($kursus);
        }
        // Jika request bukan ajax, throw halaman 403.
        return abort(403);
    }
}
