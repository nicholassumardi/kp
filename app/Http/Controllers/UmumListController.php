<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Course;
use App\Models\CourseDetailUmum;
use App\Models\Umum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UmumListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only(['index', 'changeYear']);
    }

    public function index()
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();

        $this->dataView['page'] = 'umumList';

        $this->dataView['detail_kursus_umum_count'] = CourseDetailUmum::count();
            
            // Jika belum ada mahasiswa yang mendaftar kursus
        if ($this->dataView['detail_kursus_umum_count'] > 0) {
            $this->dataView['id_kursus_selected_umum'] = Course::where('tipe_kursus', 'umum')->min('id_kursus');
            $this->dataView['min_year_umum'] = CourseDetailUmum::min('created_at');
            $this->dataView['max_year_umum'] = CourseDetailUmum::max('created_at');
            $this->dataView['year_selected_umum'] = Carbon::createFromFormat('Y-m-d H:i:s', $this->dataView['max_year_umum'])->year;

            $this->dataView['data_kursus_umum'] = Course::all();
            $this->dataView['data_detail_kursus_umum'] = DB::table('detail_kursus_umum')
                ->join('kursus', 'detail_kursus_umum.kursus_id', '=', 'kursus.id_kursus')
                ->where('tipe_kursus', 'umum')
                ->get();
            $this->dataView['data_umum'] = Umum::whereHas(
                'kursus',
                function (Builder $query) {
                    $query
                        ->where('detail_kursus_umum.kursus_id', '=', $this->dataView['id_kursus_selected_umum'])
                        ->whereYear('detail_kursus_umum.created_at', '=', $this->dataView['max_year_umum']);
                }
            )->get();

            $this->dataView['data_umum_terurut'] = [];
            foreach ($this->dataView['data_umum'] as $umum) {
                foreach ($umum->kursus as $kursus) {
                    if (strval($kursus->id_kursus) === strval($this->dataView['id_kursus_selected_umum'])) {
                        array_push($this->dataView['data_umum_terurut'], [
                            'no_kartu_umum' => $kursus->pivot->no_kartu_umum,
                            'nama_umum' => $umum->nama,
                        ]);   
                    }
                }
            }
            asort($this->dataView['data_umum_terurut']);
        }


        return view('admin.main.student_list_admin.index', $this->dataView);

   
    }

    public function changeYear($year, $id_kursus)
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();

        $this->dataView['page'] = 'umumList';

        $this->dataView['detail_kursus_umum_count'] = CourseDetailUmum::count();
            
            // Jika belum ada mahasiswa yang mendaftar kursus
        if ($this->dataView['detail_kursus_umum_count'] > 0) {
            $this->dataView['id_kursus_selected_umum'] = $id_kursus;
            $this->dataView['min_year_umum'] = CourseDetailUmum::min('created_at');
            $this->dataView['max_year_umum'] = CourseDetailUmum::max('created_at');
            $this->dataView['year_selected_umum'] = $year;

            $this->dataView['data_kursus_umum'] = Course::all();
            $this->dataView['data_detail_kursus_umum'] = DB::table('detail_kursus_umum')
                ->join('kursus', 'detail_kursus_umum.kursus_id', '=', 'kursus.id_kursus')
                ->where('tipe_kursus', 'umum')
                ->get();
            $this->dataView['data_umum'] = Umum::whereHas(
                'kursus',
                function (Builder $query) {
                    $query
                        ->where('detail_kursus_umum.kursus_id', '=', $this->dataView['id_kursus_selected_umum'])
                        ->whereYear('detail_kursus_umum.created_at', '=', $this->dataView['max_year_umum']);
                }
            )->get();

            $this->dataView['data_umum_terurut'] = [];
            foreach ($this->dataView['data_umum'] as $umum) {
                foreach ($umum->kursus as $kursus) {
                    if (strval($kursus->id_kursus) === strval($this->dataView['id_kursus_selected_umum'])) {
                        array_push($this->dataView['data_umum_terurut'], [
                            'no_kartu_umum' => $kursus->pivot->no_kartu_umum,
                            'nama_umum' => $umum->nama,
                        ]);   
                    }
                }
            }
            asort($this->dataView['data_umum_terurut']);
        }
        
        return view('admin.main.student_list_admin.index', $this->dataView);
    }
}
