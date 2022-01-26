<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\CourseDetailUmum;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.student')->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['nama_kursus'] = Course::whereNotIn('tipe_kursus', ['umum'])->get();
        // $this->dataView['jadwal'] = Schedules::where('kursus_id', Course::min('id_kursus'))->get();
        $this->dataView['mahasiswa'] = Mahasiswa::where('user_id', Auth::id())->first();
        $this->dataView['kursus_index_pertama'] = Course::select('sertifikat')->where('tipe_kursus', 'mahasiswa')->first();
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
        $request->validate([
            'kursus_id' => 'required',
            'path_foto_kuitansi' => 'required',
        ]);

        // Variabel
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $kursus = Course::where('id_kursus', $request->kursus_id)->first();
        // $jadwal = Schedules::where('id_jadwal', $request->jadwal_id)->first();
        $isMahasiswaBelumTerdaftarKursus = CourseDetail::where('mahasiswa_id', $mahasiswa->id_mahasiswa)
            ->where('kursus_id', $request->kursus_id)
            ->doesntExist();


        // Jika kelas masih belum penuh
        if ($kursus->partisipan_saat_ini < $kursus->batas_partisipan) {
            // Jika mahasiswa belum terdaftar kursus, maka dapat melakukan registrasi.
            if ($isMahasiswaBelumTerdaftarKursus) {
                // Jika foto sertifikat ada
                if ($request->hasFile('path_foto_sertifikat')) {
                    // Jika format foto benar
                    if ($this->isMimeFileMatches(
                        [
                            $request->path_foto_kuitansi,
                            $request->path_foto_mahasiswa,
                            $request->path_foto_sertifikat
                        ],
                        ['image/jpeg', 'image/png']
                    )) {
                        // $nomorKartuMahasiswa = CourseDetail::where('kursus_id', $request->kursus_id)->max('no_kartu_mahasiswa');
                        $nomorKartuMhs = CourseDetail::where('kursus_id', $request->kursus_id)->max('no_kartu_mahasiswa');
                        $nomorKartuUmum = CourseDetailUmum::where('kursus_id', $request->kursus_id)->max('no_kartu_umum');

                        // Mahasiswa
                        if ($nomorKartuMhs > $nomorKartuUmum) {
                            $nomorKartu = $nomorKartuMhs;
                        } 
                        // umum
                        else {
                            $nomorKartu = $nomorKartuUmum;
                        }
                        
                        // Jika kursus belum memiliki mahasiswa yang mendaftar
                        if ($nomorKartu !== null) {
                            CourseDetail::create([
                                'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                                'kursus_id' => $request->kursus_id,
                                'no_kartu_mahasiswa' => $nomorKartu + 1,
                                // 'jadwal_id' => $request->jadwal_id,
                                'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
                                'path_foto_mahasiswa' => $request->path_foto_mahasiswa->store('images/foto-mahasiswa/', 'public'),
                                'path_foto_sertifikat' => $request->path_foto_sertifikat->store('images/foto-sertifikat/', 'public'),
                            ]);
                        } 
                        // Jika kursus sudah memiliki mahasiswa yang mendaftar
                        else {
                            CourseDetail::create([
                                'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                                'kursus_id' => $request->kursus_id,
                                'no_kartu_mahasiswa' => 1,
                                // 'jadwal_id' => $request->jadwal_id,
                                'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
                                'path_foto_mahasiswa' => $request->path_foto_mahasiswa->store('images/foto-mahasiswa/', 'public'),
                                'path_foto_sertifikat' => $request->path_foto_sertifikat->store('images/foto-sertifikat/', 'public'),
                            ]);
                        }

                        // Tambahkan jumlah partisipan saat ini
                        Course::where('id_kursus', $request->kursus_id)
                            ->update(['partisipan_saat_ini' => $kursus->partisipan_saat_ini + 1]);
                    }
                    // Jika format foto salah
                    else {
                        return redirect()->route('registerCourses.index')
                            ->with('error', 'Registrasi gagal, format file salah!');
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
                        // $nomorKartuMahasiswa = CourseDetail::where('kursus_id', $request->kursus_id)->max('no_kartu_mahasiswa');
                        $nomorKartuMhs = CourseDetail::where('kursus_id', $request->kursus_id)->max('no_kartu_mahasiswa');
                        $nomorKartuUmum = CourseDetailUmum::where('kursus_id', $request->kursus_id)->max('no_kartu_umum');

                        // Mahasiswa
                        if ($nomorKartuMhs > $nomorKartuUmum) {
                            $nomorKartu = $nomorKartuMhs;
                        } 
                        // umum
                        else {
                            $nomorKartu = $nomorKartuUmum;
                        }
                        
                        // Jika kursus belum memiliki mahasiswa yang mendaftar
                        if ($nomorKartu !== null) {
                            CourseDetail::create([
                                'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                                'kursus_id' => $request->kursus_id,
                                'no_kartu_mahasiswa' => $nomorKartu + 1,
                                // 'jadwal_id' => $request->jadwal_id,
                                'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
                                'path_foto_mahasiswa' => $request->path_foto_mahasiswa->store('images/foto-mahasiswa/', 'public'),
                            ]);
                        } 
                        // Jika kursus sudah memiliki mahasiswa yang mendaftar
                        else {
                            CourseDetail::create([
                                'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                                'kursus_id' => $request->kursus_id,
                                'no_kartu_mahasiswa' => 1,
                                // 'jadwal_id' => $request->jadwal_id,
                                'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
                                'path_foto_mahasiswa' => $request->path_foto_mahasiswa->store('images/foto-mahasiswa/', 'public'),
                            ]);
                        }

                        // Tambahkan jumlah partisipan saat ini
                        Course::where('id_kursus', $request->kursus_id)
                            ->update(['partisipan_saat_ini' => $kursus->partisipan_saat_ini + 1]);
                    }
                    // Jika format foto salah
                    else {
                        return redirect()->route('registerCourses.index')
                            ->with('error', 'Registrasi gagal, format file salah!');
                    }
                }

                return redirect()->route('registerCourses.index')
                    ->with('success', 'Registrasi berhasil!');
            }
            // Jika mahasiswa sudah terdaftar kursus, maka gagal registrasi.
            else {
                return redirect()->route('registerCourses.index')
                    ->with('error', 'Registrasi gagal, Anda sudah terdaftar pada kursus ini!');
            }
        }
        // Jika kelas sudah penuh
        else {
            return redirect()->route('registerCourses.index')
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

    // public function getSchedules(Request $request, $id)
    // {
    //     // Jika request ajax
    //     if ($request->ajax()) {
    //         // $jadwal = Schedules::where('kursus_id', '=', $id)->get();
    //         $kursus = Course::where('id_kursus', '=', $id)->get();

    //         return response()->json($kursus);
    //     }
    //     // Jika request bukan ajax, throw halaman 403.
    //     return abort(403);
    // }

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
