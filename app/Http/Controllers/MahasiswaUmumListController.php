<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\CourseDetailUmum;
use App\Models\Mahasiswa;
use App\Models\Umum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MahasiswaUmumListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only(['index', 'changeYear']);
    }

    public function index()
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();

        $this->dataView['page'] = 'mahasiswaUmumList';

        $this->dataView['detail_kursus_umum_count'] = DB::table('detail_kursus_umum')
        ->join('kursus', 'detail_kursus_umum.kursus_id', '=', 'kursus.id_kursus')
        ->where('tipe_kursus', 'mahasiswa dan umum')
        ->count();
            
   
            
            // Jika belum ada mahasiswa yang mendaftar kursus
        if ($this->dataView['detail_kursus_umum_count'] > 0) {
            $this->dataView['id_kursus_selected_umum'] = Course::where('tipe_kursus', 'mahasiswa dan umum')->min('id_kursus');
            $this->dataView['min_year_umum'] = CourseDetailUmum::min('created_at');
            $this->dataView['max_year_umum'] = CourseDetailUmum::max('created_at');
            $this->dataView['year_selected_umum'] = Carbon::createFromFormat('Y-m-d H:i:s', $this->dataView['max_year_umum'])->year;

            $this->dataView['data_kursus_umum'] = Course::all();
            $this->dataView['data_detail_kursus_umum'] = DB::table('detail_kursus_umum')
                ->join('kursus', 'detail_kursus_umum.kursus_id', '=', 'kursus.id_kursus')
                ->where('tipe_kursus', 'mahasiswa dan umum')
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
        } $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();

        
        $this->dataView['detail_kursus_count'] = DB::table('detail_kursus')
        ->join('kursus', 'detail_kursus.kursus_id', '=', 'kursus.id_kursus')
        ->where('tipe_kursus', 'mahasiswa dan umum')
        ->count();
  
        


           // Jika belum ada mahasiswa yang mendaftar kursus
        if ($this->dataView['detail_kursus_count'] > 0) {
            $this->dataView['id_kursus_selected'] = Course::where('tipe_kursus', 'mahasiswa dan umum')->min('id_kursus');
            $this->dataView['min_year'] = CourseDetail::min('created_at');
            $this->dataView['max_year'] = CourseDetail::max('created_at');
            $this->dataView['year_selected'] = Carbon::createFromFormat('Y-m-d H:i:s', $this->dataView['max_year'])->year;

            $this->dataView['data_kursus'] = Course::all();
            $this->dataView['data_detail_kursus'] = DB::table('detail_kursus')
                ->join('kursus', 'detail_kursus.kursus_id', '=', 'kursus.id_kursus')
                ->where('tipe_kursus', 'mahasiswa dan umum')
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

        $this->dataView['page'] = 'mahasiswaUmumList';

        $this->dataView['detail_kursus_umum_count'] = DB::table('detail_kursus_umum')
        ->join('kursus', 'detail_kursus_umum.kursus_id', '=', 'kursus.id_kursus')
        ->where('tipe_kursus', 'mahasiswa dan umum')
        ->count();
            
            // Jika belum ada mahasiswa yang mendaftar kursus
        if ($this->dataView['detail_kursus_umum_count'] > 0) {
            $this->dataView['id_kursus_selected_umum'] = $id_kursus;
            $this->dataView['min_year_umum'] = CourseDetailUmum::min('created_at');
            $this->dataView['max_year_umum'] = CourseDetailUmum::max('created_at');
            $this->dataView['year_selected_umum'] = $year;

            $this->dataView['data_kursus_umum'] = Course::all();
            $this->dataView['data_detail_kursus_umum'] = DB::table('detail_kursus_umum')
                ->join('kursus', 'detail_kursus_umum.kursus_id', '=', 'kursus.id_kursus')
                ->where('tipe_kursus', 'mahasiswa dan umum')
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
                            'nama_umum' => $umum->nama,
                        ]);   
                    }
                }
            }
            asort($this->dataView['data_umum_terurut']);
        }

        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        
        $this->dataView['detail_kursus_count'] = DB::table('detail_kursus')
        ->join('kursus', 'detail_kursus.kursus_id', '=', 'kursus.id_kursus')
        ->where('tipe_kursus', 'mahasiswa dan umum')
        ->count();
            
      


           // Jika belum ada mahasiswa yang mendaftar kursus
        if ($this->dataView['detail_kursus_count'] > 0) {
            $this->dataView['id_kursus_selected'] = $id_kursus;
            $this->dataView['min_year'] = CourseDetail::min('created_at');
            $this->dataView['max_year'] = CourseDetail::max('created_at');
            $this->dataView['year_selected'] = $year;

            $this->dataView['data_kursus'] = Course::all();
            $this->dataView['data_detail_kursus'] = DB::table('detail_kursus')
                ->join('kursus', 'detail_kursus.kursus_id', '=', 'kursus.id_kursus')
                ->where('tipe_kursus', 'mahasiswa dan umum')
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
