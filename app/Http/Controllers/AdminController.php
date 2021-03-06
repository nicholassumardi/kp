<?php

namespace App\Http\Controllers;

use App\Exports\CampuranExport;
use App\Exports\MahasiswaExport;
use App\Exports\UmumExport;
use App\Models\Admin;
use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\CourseDetailUmum;
use App\Models\Mahasiswa;
// use App\Models\Schedules;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        // $this->dataView['data_kursus'] = Schedules::get();
        $this->dataView['data_kursus'] = Course::paginate(5);
        $this->dataView['kursus_count'] = Course::count();
        $this->dataView['kursus_aktif_count'] = Course::where('status', 1)->count();
        $this->dataView['mahasiswa_count'] = Mahasiswa::count();
        $this->dataView['mahasiswa_aktif_count'] = User::where('status', 1)
            ->where('tipe_user_id', 4)
            ->count();

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
    // public function edit($id_jadwal, $id_kursus)
    public function edit($id_kursus)
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        $this->dataView['kursus'] = Course::where('id_kursus', $id_kursus)->first();
        // $this->dataView['jadwal'] = Schedules::where('id_jadwal', $id_jadwal)->where('kursus_id', $id_kursus)->first();
        $this->dataView['mahasiswa_count'] = count($this->dataView['kursus']->mahasiswa);
        $this->dataView['umum_count'] = count($this->dataView['kursus']->umum);

        return view('admin.main.dashboard_admin.edit', $this->dataView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_mahasiswa, $id_kursus)
    {
        CourseDetail::where('mahasiswa_id', $id_mahasiswa)
            ->where('kursus_id', $id_kursus)
            ->update(['status_verifikasi' => 1]);

        return redirect()->back()
            ->with('success', 'Status updated successfully.');
    }

    public function update2(Request $request, $id_umum, $id_kursus)
    {
        CourseDetailUmum::where('umum_id', $id_umum)
            ->where('kursus_id', $id_kursus)
            ->update(['status_verifikasi' => 1]);

        return redirect()->back()
            ->with('success', 'Status updated successfully.');
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

    public function sendKomentar(Request $request, $id_mahasiswa, $id_kursus)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        CourseDetail::where('mahasiswa_id', $id_mahasiswa)
            ->where('kursus_id', $id_kursus)
            ->update(['komentar' => $request->komentar]);

        return redirect()->back()
            ->with('success', 'Comment has been sent.');
    }

    public function sendKomentar2(Request $request, $id_umum, $id_kursus)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        CourseDetailUmum::where('umum_id', $id_umum)
            ->where('kursus_id', $id_kursus)
            ->update(['komentar' => $request->komentar]);

        return redirect()->back()
            ->with('success', 'Comment has been sent.');
    }
    public function exportExcel($id_kursus, $tipe_kursus)
    {

        if ($tipe_kursus === 'umum') {
            return (new UmumExport($id_kursus))->download('daftarUmum.xlsx');
        } elseif ($tipe_kursus === 'mahasiswa') {
            return (new MahasiswaExport($id_kursus))->download('daftarMahasiswa.xlsx');
        } else {
            return (new CampuranExport($id_kursus))->download('daftarPartisipan.xlsx');
        }
    }
}
