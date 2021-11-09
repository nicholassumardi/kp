<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class StudentListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only(['index', 'changeYear']);
    }

    public function index()
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        $this->dataView['detail_kursus_count'] = CourseDetail::count();

        // Jika belum ada mahasiswa yang mendaftar kursus
        if ($this->dataView['detail_kursus_count'] === 0) {
            return view('admin.main.student_list_admin.index', $this->dataView);
        }

        $this->dataView['id_kursus_selected'] = Course::min('id_kursus');
        $this->dataView['min_year'] = CourseDetail::min('created_at');
        $this->dataView['max_year'] = CourseDetail::max('created_at');
        $this->dataView['year_selected'] = Carbon::createFromFormat('Y-m-d H:i:s', $this->dataView['max_year'])->year;

        $this->dataView['data_kursus'] = Course::all();
        $this->dataView['data_detail_kursus'] = CourseDetail::all();
        $this->dataView['data_mahasiswa'] = Mahasiswa::whereHas(
            'kursus',
            function (Builder $query) {
                $query
                    ->where('detail_kursus.kursus_id', '=', $this->dataView['id_kursus_selected'])
                    ->whereYear('detail_kursus.created_at', '=', $this->dataView['max_year']);
            }
        )->get();

        $this->dataView['data_mahasiswa_terurut'] = [];
        foreach ($this->dataView['data_mahasiswa'] as $mahasiswa) {
            foreach ($mahasiswa->kursus as $kursus) {
                if (strval($kursus->id_kursus) === strval($this->dataView['id_kursus_selected'])) {
                    array_push($this->dataView['data_mahasiswa_terurut'], [
                        $kursus->pivot->no_kartu_mahasiswa,
                        $mahasiswa->nama,
                        $mahasiswa->npm
                    ]);
                }
            }
        }
        asort($this->dataView['data_mahasiswa_terurut']);

        return view('admin.main.student_list_admin.index', $this->dataView);
    }

    public function changeYear($year, $id_kursus)
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        $this->dataView['detail_kursus_count'] = CourseDetail::count();

        // Jika belum ada mahasiswa yang mendaftar kursus
        if ($this->dataView['detail_kursus_count'] === 0) {
            return view('admin.main.student_list_admin.index', $this->dataView);
        }

        $this->dataView['id_kursus_selected'] = $id_kursus;
        $this->dataView['min_year'] = CourseDetail::min('created_at');
        $this->dataView['max_year'] = CourseDetail::max('created_at');
        $this->dataView['year_selected'] = $year;

        $this->dataView['data_kursus'] = Course::all();
        $this->dataView['data_detail_kursus'] = CourseDetail::all();
        $this->dataView['data_mahasiswa'] = Mahasiswa::whereHas(
            'kursus',
            function (Builder $query) {
                $query
                    ->where('detail_kursus.kursus_id', '=', $this->dataView['id_kursus_selected'])
                    ->whereYear('detail_kursus.created_at', '=', $this->dataView['year_selected']);
            }
        )->get();

        // Jika data $year dan $id_kursus tidak ditemukan di database.
        if ($this->dataView['data_mahasiswa']->isEmpty()) {
            return redirect()->route('studentList.index');
        }

        $this->dataView['data_mahasiswa_terurut'] = [];
        foreach ($this->dataView['data_mahasiswa'] as $mahasiswa) {
            foreach ($mahasiswa->kursus as $kursus) {
                if (strval($kursus->id_kursus) === strval($this->dataView['id_kursus_selected'])) {
                    array_push($this->dataView['data_mahasiswa_terurut'], [
                        $kursus->pivot->no_kartu_mahasiswa,
                        $mahasiswa->nama,
                        $mahasiswa->npm
                    ]);
                }
            }
        }
        asort($this->dataView['data_mahasiswa_terurut']);

        return view('admin.main.student_list_admin.index', $this->dataView);
    }
}
