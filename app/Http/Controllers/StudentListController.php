<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class StudentListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only(['index', 'changeYear']);
    }

    public function index()
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();

        $this->dataView['page'] = 'studentList';
        
        $this->dataView['detail_kursus_count'] = CourseDetail::count();
        


           // Jika belum ada mahasiswa yang mendaftar kursus
        if ($this->dataView['detail_kursus_count'] > 0) {
            $this->dataView['id_kursus_selected'] = Course::where('tipe_kursus', 'mahasiswa')->min('id_kursus');
            $this->dataView['min_year'] = CourseDetail::min('created_at');
            $this->dataView['max_year'] = CourseDetail::max('created_at');
            $this->dataView['year_selected'] = Carbon::createFromFormat('Y-m-d H:i:s', $this->dataView['max_year'])->year;

            $this->dataView['data_kursus'] = Course::all();
            $this->dataView['data_detail_kursus'] = DB::table('detail_kursus')
                ->join('kursus', 'detail_kursus.kursus_id', '=', 'kursus.id_kursus')
                ->where('tipe_kursus', 'mahasiswa')
                ->get();
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
                            'no_kartu_mahasiswa' => $kursus->pivot->no_kartu_mahasiswa,
                            'nama_mahasiswa' => $mahasiswa->nama,
                            'npm_mahasiswa' => $mahasiswa->npm
                        ]);
                    }
                }
            }
            asort($this->dataView['data_mahasiswa_terurut']);
        }

        return view('admin.main.student_list_admin.index', $this->dataView);   
    }

    public function changeYear($year, $id_kursus)
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();

        $this->dataView['page'] = 'studentList';
        
        $this->dataView['detail_kursus_count'] = CourseDetail::count();


           // Jika belum ada mahasiswa yang mendaftar kursus
        if ($this->dataView['detail_kursus_count'] > 0) {
            $this->dataView['id_kursus_selected'] = $id_kursus;
            $this->dataView['min_year'] = CourseDetail::min('created_at');
            $this->dataView['max_year'] = CourseDetail::max('created_at');
            $this->dataView['year_selected'] = $year;

            $this->dataView['data_kursus'] = Course::all();
            $this->dataView['data_detail_kursus'] = DB::table('detail_kursus')
                ->join('kursus', 'detail_kursus.kursus_id', '=', 'kursus.id_kursus')
                ->where('tipe_kursus', 'mahasiswa')
                ->get();
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
                            'no_kartu_mahasiswa' => $kursus->pivot->no_kartu_mahasiswa,
                            'nama_mahasiswa' => $mahasiswa->nama,
                            'npm_mahasiswa' => $mahasiswa->npm
                        ]);
                    }
                }
            }
            asort($this->dataView['data_mahasiswa_terurut']);
        }
        
        return view('admin.main.student_list_admin.index', $this->dataView);
    }
}
