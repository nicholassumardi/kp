<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CourseDetail;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class StudentListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only(['index']);
    }

    public function index()
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();

        $this->dataView['min_year'] = CourseDetail::min('created_at');
        $this->dataView['max_year'] = CourseDetail::max('created_at');
        $this->dataView['year_selected'] = Carbon::createFromFormat('Y-m-d H:i:s', $this->dataView['max_year'])->year;

        $this->dataView['data_mahasiswa'] = Mahasiswa::whereHas(
            'kursus', 
            function (Builder $query) {
                $query->whereYear('detail_kursus.created_at', '=', $this->dataView['max_year']);
            }
        )->get();
        
                
        return view('admin.main.student_list_admin.index', $this->dataView);
    }

    public function changeYear($year)
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        
        $this->dataView['min_year'] = CourseDetail::min('created_at');
        $this->dataView['max_year'] = CourseDetail::max('created_at');
        $this->dataView['year_selected'] = $year;
        
        $this->dataView['data_mahasiswa'] = Mahasiswa::whereHas(
            'kursus', 
            function (Builder $query) {
                $query->whereYear('detail_kursus.created_at', '=', $this->dataView['year_selected']);
            }
        )->get();

        return view('admin.main.student_list_admin.index', $this->dataView);
    }
}
