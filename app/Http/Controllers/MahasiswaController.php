<?php

namespace App\Http\Controllers;

use App\Models\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.student')->only(['index']);
    }

    public function index()
    {
        $this->dataView['mahasiswa'] = Mahasiswa::where('user_id', Auth::id())->first();
        $this->dataView['kursus'] = Mahasiswa::where('user_id', Auth::id())->first()->kursus()->paginate(4);
        // foreach ($this->dataView['kursus'] as $k) {
        //     foreach ($k->jadwal as $j) {
        //         // if ($k->pivot->jadwal_id === $j->id_jadwal){
        //             dump($j->id_jadwal);
        //         // }
        //     }
        // }

        return view('student.main.dashboard_student.index',  $this->dataView);
    }
}
