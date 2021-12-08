<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.student')->only(['index', 'edit']);
    }

    public function index()
    {
        $this->dataView['mahasiswa'] = Mahasiswa::where('user_id', Auth::id())->first();
        $this->dataView['kursus'] = Mahasiswa::where('user_id', Auth::id())->first()->kursus()->paginate(4);

        return view('student.main.dashboard_student.index',  $this->dataView);
    }

    public function edit($id)
    {
        $this->dataView['kursus'] = Course::where('id_kursus', $id)->first();
        $this->dataView['mahasiswa'] = Mahasiswa::where('user_id', Auth::id())->first();
        $this->dataView['kursus_index_pertama'] = Course::select('sertifikat')->first();


        return view('student.main.dashboard_student.edit',  $this->dataView);
    }

    public function update(Request $request,$id_mahasiswa, $id_kursus)
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
                    $request->path_foto_mahasiswa,
                    $request->path_foto_sertifikat
                ],
                ['image/jpeg', 'image/png']
            )) {
                CourseDetail::where('mahasiswa_id', $id_mahasiswa)->where('kursus_id', $id_kursus)->update([
                    'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
                    'path_foto_mahasiswa' => $request->path_foto_mahasiswa->store('images/foto-mahasiswa/', 'public'),
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

                CourseDetail::where('mahasiswa_id', $id_mahasiswa)->where('kursus_id', $id_kursus)->update([
                    'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/', 'public'),
                    'path_foto_mahasiswa' => $request->path_foto_mahasiswa->store('images/foto-mahasiswa/', 'public'),
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
}
