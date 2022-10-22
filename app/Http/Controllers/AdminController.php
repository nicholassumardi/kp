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
use App\Models\Umum;
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
        // $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // $uri = explode('/', $uri_path);
        // $params = $uri[2];
        // $idKursus = intval($params);

        // dd($uri[2]);

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
        $query = CourseDetail::where('mahasiswa_id', $id_mahasiswa)
            ->where('kursus_id', $id_kursus)
            ->update(['status_verifikasi' => 1]);

        if ($query) {
            $response = [
                'status' => 200,
                'message' => 'Success'
            ];
        } else {
            $response = [
                'status' => 400,
                'message' => 'Failed'
            ];
        }
        return response()->json($response);
    }

    public function update2(Request $request, $id_umum, $id_kursus)
    {
        $query = CourseDetailUmum::where('umum_id', $id_umum)
            ->where('kursus_id', $id_kursus)
            ->update(['status_verifikasi' => 1]);


        if ($query) {
            $response = [
                'status' => 200,
                'message' => 'Success'
            ];
        } else {
            $response = [
                'status' => 400,
                'message' => 'Failed'
            ];
        }
        return response()->json($response);
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


    public function datatable(Request $request)
    {

        if ($request->tipeKursus === "mahasiswa") {
            $column = [
                'mahasiswa_id',
                'kursus_id',
                'created_at',
                'no_kartu_mahasiswa',
            ];

            $start  = $request->start;
            $length = $request->length;
            $order  = $column[$request->input('order.0.column')];
            $dir    = $request->input('order.0.dir');
            $search = $request->input('search.value');


            $total_data = CourseDetail::where('kursus_id', '=', $request->idKursus)->count();

            $query_data = CourseDetail::where(function ($query) use ($search, $request) {
                if ($search) {
                    $query->where(function ($query) use ($search, $request) {
                        $query->where('no_kartu_mahasiswa', 'like', "%$search%")
                            ->orWhereHas('mahasiswa', function ($query) use ($search, $request) {
                                $query->where('nama', 'like', "%$search%");
                            });
                    });
                }
            })->where('kursus_id', '=', $request->idKursus)
                ->offset($start)
                ->limit($length)
                ->orderBy($order, $dir)
                ->get();

            $total_filtered = CourseDetail::where(function ($query) use ($search, $request) {
                if ($search) {
                    $query->where('no_kartu_mahasiswa', 'like', "%$search%")
                        ->orWhereHas('mahasiswa', function ($query) use ($search, $request) {
                            $query->where('nama', 'like', "%$search%");
                        });
                }
            })->where('kursus_id', '=', $request->idKursus)
                ->count();

            $response['data'] = [];
            if ($query_data <> FALSE) {

                foreach ($query_data as $val) {

                    $getStatus =  $val->status_verifikasi == 1 ? 'bi bi-check btn-success' : 'bi bi-x btn-danger';
                    $statusConvert = $val->status_verifikasi == 1 ? 'Verfied' : 'Unverified';
                    $status =
                        '<li class="btn btn-sm js-status ' . $getStatus . '  disabled">
                             ' . $statusConvert . '
                            </li>';

                    $btnFotoKuitansi =
                        '<a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop" data-img-src="' . asset('storage/' . $val->path_foto_kuitansi) . '"><button type="button" class="btn btn-primary">  View Image
                    </button>';

                    $btnFotoMahasiswa =
                        '<a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop" data-img-src="' . asset('storage/' . $val->path_foto_mahasiswa) . '"><button type="button" class="btn btn-primary">  View Image
                    </button>';

                    $btnFotoSertifikat =
                        '<a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop" data-img-src="' . asset('storage/' . $val->path_foto_sertifikat) . '"><button type="button" class="btn btn-primary">  View Image
                    </button>';

                    $btnUpdateStatus =
                        '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateStatusMahasiswa(' . $val->mahasiswa->id_mahasiswa . ',' . $request->idKursus . ')">
                    <i class="bi bi-check-square text-green"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                    data-toggle="modal" data-target="#modal-komentar"
                    data-action="' . route('admin.sendKomentar', ['id_mahasiswa' => $val->mahasiswa->id_mahasiswa, 'id_kursus' => $request->idKursus]) . '">
                    <i class="bi bi-x-square text-danger"></i>
                    </button>';

                    $btnPrint = '<a href="' . route('generate.pdf', ['id_kursus' => $request->idKursus, 'id_mahasiswa_satu' => $val->mahasiswa->id_mahasiswa]) . '"
                    class="btn btn-sm btn-outline-secondary"><i
                        class="bi bi-printer-fill text-indigo"></i></a>';

                    $response['data'][] = [
                        $val->mahasiswa->nama,
                        $val->no_kartu_mahasiswa,
                        date(
                            'Y',
                            strtotime($val->created_at)
                        ),
                        $status,
                        $btnFotoKuitansi,
                        $btnFotoMahasiswa,
                        $val->kursus->sertifikat === 1 ? $btnFotoSertifikat : '-',
                        $btnUpdateStatus,
                        $btnPrint,

                    ];
                }
            }

            $response['recordsTotal'] = 0;
            if ($total_data <> FALSE) {
                $response['recordsTotal'] = $total_data;
            }

            $response['recordsFiltered'] = 0;
            if ($total_filtered <> FALSE) {
                $response['recordsFiltered'] = $total_filtered;
            }

            return response()->json($response);
        } else if ($request->tipeKursus === "umum") {
            $column = [
                'umum_id',
                'kursus_id',
                'created_at',
                'no_kartu_umum',
            ];

            $start  = $request->start;
            $length = $request->length;
            $order  = $column[$request->input('order.0.column')];
            $dir    = $request->input('order.0.dir');
            $search = $request->input('search.value');


            $total_data = CourseDetailUmum::where('kursus_id', '=', $request->idKursus)->count();

            $query_data = CourseDetailUmum::where(function ($query) use ($search, $request) {
                if ($search) {
                    $query->where(function ($query) use ($search, $request) {
                        $query->where('no_kartu_umum', 'like', "%$search%")
                            ->orWhereHas('umum', function ($query) use ($search, $request) {
                                $query->where('nama', 'like', "%$search%");
                            });
                    });
                }
            })->where('kursus_id', '=', $request->idKursus)
                ->offset($start)
                ->limit($length)
                ->orderBy($order, $dir)
                ->get();

            $total_filtered = CourseDetailUmum::where(function ($query) use ($search, $request) {
                if ($search) {
                    $query->where('no_kartu_umum', 'like', "%$search%")
                        ->orWhereHas('umum', function ($query) use ($search, $request) {
                            $query->where('nama', 'like', "%$search%");
                        });
                }
            })->where('kursus_id', '=', $request->idKursus)
                ->count();

            $response['data'] = [];
            if ($query_data <> FALSE) {

                foreach ($query_data as $val) {

                    $getStatus =  $val->status_verifikasi == 1 ? 'bi bi-check btn-success' : 'bi bi-x btn-danger';
                    $statusConvert = $val->status_verifikasi == 1 ? 'Verfied' : 'Unverified';
                    $status =
                        '<li class="btn btn-sm js-status ' . $getStatus . '  disabled">
                             ' . $statusConvert . '
                            </li>';

                    $btnFotoKuitansi =
                        '<a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop" data-img-src="' . asset('storage/' . $val->path_foto_kuitansi) . '"><button type="button" class="btn btn-primary">  View Image
                    </button>';

                    $btnFotoUmum =
                        '<a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop" data-img-src="' . asset('storage/' . $val->path_foto_umum) . '"><button type="button" class="btn btn-primary">  View Image
                    </button>';

                    $btnFotoSertifikat =
                        '<a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop" data-img-src="' . asset('storage/' . $val->path_foto_sertifikat) . '"><button type="button" class="btn btn-primary">  View Image
                    </button>';

                    $btnUpdateStatus =
                        '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateStatusUmum(' . $val->umum->id_umum . ',' . $request->idKursus . ')">
                    <i class="bi bi-check-square text-green"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                    data-toggle="modal" data-target="#modal-komentar"
                    data-action="' . route('admin.sendKomentar2', ['id_umum' => $val->umum->id_umum, 'id_kursus' => $request->idKursus]) . '">
                    <i class="bi bi-x-square text-danger"></i>
                    </button>';

                    $btnPrint = '<a href="' . route('generateUmum.pdf', ['id_kursus' => $request->idKursus, 'id_umum_satu' => $val->umum->id_umum]) . '"
                    class="btn btn-sm btn-outline-secondary"><i
                        class="bi bi-printer-fill text-indigo"></i></a>';

                    $response['data'][] = [
                        $val->umum->nama,
                        $val->no_kartu_umum,
                        date(
                            'Y',
                            strtotime($val->created_at)
                        ),
                        $status,
                        $btnFotoKuitansi,
                        $btnFotoUmum,
                        $val->kursus->sertifikat === 1 ? $btnFotoSertifikat : '-',
                        $btnUpdateStatus,
                        $btnPrint,

                    ];
                }
            }

            $response['recordsTotal'] = 0;
            if ($total_data <> FALSE) {
                $response['recordsTotal'] = $total_data;
            }

            $response['recordsFiltered'] = 0;
            if ($total_filtered <> FALSE) {
                $response['recordsFiltered'] = $total_filtered;
            }

            return response()->json($response);
        } else {

            $column = [
                
                'kursus_id',
                'created_at',
              
            ];

            $start  = $request->start;
            $length = $request->length;
            $order  = $column[$request->input('order.0.column')];
            $dir    = $request->input('order.0.dir');
            $search = $request->input('search.value');


            $total_data_mahasiswa = CourseDetail::where('kursus_id', '=', $request->idKursus)->count();

            $query_data_mahasiswa = CourseDetail::where(function ($query) use ($search, $request) {
                if ($search) {
                    $query->where(function ($query) use ($search, $request) {
                        $query->where('no_kartu_mahasiswa', 'like', "%$search%")
                            ->orWhereHas('mahasiswa', function ($query) use ($search, $request) {
                                $query->where('nama', 'like', "%$search%");
                            });
                    });
                }
            })->where('kursus_id', '=', $request->idKursus)
                ->offset($start)
                ->limit($length)
                ->orderBy($order, $dir)
                ->get();

            $total_filtered_mahasiswa = CourseDetail::where(function ($query) use ($search, $request) {
                if ($search) {
                    $query->where('no_kartu_mahasiswa', 'like', "%$search%")
                        ->orWhereHas('mahasiswa', function ($query) use ($search, $request) {
                            $query->where('nama', 'like', "%$search%");
                        });
                }
            })->where('kursus_id', '=', $request->idKursus)
                ->count();


            $total_data_umum = CourseDetailUmum::where('kursus_id', '=', $request->idKursus)->count();

            $query_data_umum = CourseDetailUmum::where(function ($query) use ($search, $request) {
                if ($search) {
                    $query->where(function ($query) use ($search, $request) {
                        $query->where('no_kartu_umum', 'like', "%$search%")
                            ->orWhereHas('umum', function ($query) use ($search, $request) {
                                $query->where('nama', 'like', "%$search%");
                            });
                    });
                }
            })->where('kursus_id', '=', $request->idKursus)
                ->offset($start)
                ->limit($length)
                ->orderBy($order, $dir)
                ->get();

            $total_filtered_umum = CourseDetailUmum::where(function ($query) use ($search, $request) {
                if ($search) {
                    $query->where('no_kartu_umum', 'like', "%$search%")
                        ->orWhereHas('umum', function ($query) use ($search, $request) {
                            $query->where('nama', 'like', "%$search%");
                        });
                }
            })->where('kursus_id', '=', $request->idKursus)
                ->count();

            $response['data'] = [];
            if ($query_data_mahasiswa && $query_data_umum <> FALSE) {

                foreach ($query_data_mahasiswa as $val) {

                    $getStatus =  $val->status_verifikasi == 1 ? 'bi bi-check btn-success' : 'bi bi-x btn-danger';
                    $statusConvert = $val->status_verifikasi == 1 ? 'Verfied' : 'Unverified';
                    $status =
                        '<li class="btn btn-sm js-status ' . $getStatus . '  disabled">
                             ' . $statusConvert . '
                            </li>';

                    $btnFotoKuitansi =
                        '<a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop" data-img-src="' . asset('storage/' . $val->path_foto_kuitansi) . '"><button type="button" class="btn btn-primary">  View Image
                    </button>';

                    $btnFotoMahasiswa =
                        '<a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop" data-img-src="' . asset('storage/' . $val->path_foto_mahasiswa) . '"><button type="button" class="btn btn-primary">  View Image
                    </button>';

                    $btnFotoSertifikat =
                        '<a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop" data-img-src="' . asset('storage/' . $val->path_foto_sertifikat) . '"><button type="button" class="btn btn-primary">  View Image
                    </button>';

                    $btnUpdateStatus =
                        '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateStatusMahasiswa(' . $val->mahasiswa->id_mahasiswa . ',' . $request->idKursus . ')">
                    <i class="bi bi-check-square text-green"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                    data-toggle="modal" data-target="#modal-komentar"
                    data-action="' . route('admin.sendKomentar', ['id_mahasiswa' => $val->mahasiswa->id_mahasiswa, 'id_kursus' => $request->idKursus]) . '">
                    <i class="bi bi-x-square text-danger"></i>
                    </button>';

                    $btnPrint = '<a href="' . route('generate.pdf', ['id_kursus' => $request->idKursus, 'id_mahasiswa_satu' => $val->mahasiswa->id_mahasiswa]) . '"
                    class="btn btn-sm btn-outline-secondary"><i
                        class="bi bi-printer-fill text-indigo"></i></a>';

                    $response['data'][] = [
                        $val->mahasiswa->nama,
                        $val->no_kartu_mahasiswa,
                        date(
                            'Y',
                            strtotime($val->created_at)
                        ),
                        $status,
                        $btnFotoKuitansi,
                        $btnFotoMahasiswa,
                        $val->kursus->sertifikat === 1 ? $btnFotoSertifikat : '-',
                        $btnUpdateStatus,
                        $btnPrint,

                    ];
                }

                foreach ($query_data_umum as $val) {

                    $getStatus =  $val->status_verifikasi == 1 ? 'bi bi-check btn-success' : 'bi bi-x btn-danger';
                    $statusConvert = $val->status_verifikasi == 1 ? 'Verfied' : 'Unverified';
                    $status =
                        '<li class="btn btn-sm js-status ' . $getStatus . '  disabled">
                             ' . $statusConvert . '
                            </li>';

                    $btnFotoKuitansi =
                        '<a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop" data-img-src="' . asset('storage/' . $val->path_foto_kuitansi) . '"><button type="button" class="btn btn-primary">  View Image
                    </button>';

                    $btnFotoUmum =
                        '<a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop" data-img-src="' . asset('storage/' . $val->path_foto_umum) . '"><button type="button" class="btn btn-primary">  View Image
                    </button>';

                    $btnFotoSertifikat =
                        '<a href="#" data-toggle="modal" data-target="#modalKurikulum" class="pop" data-img-src="' . asset('storage/' . $val->path_foto_sertifikat) . '"><button type="button" class="btn btn-primary">  View Image
                    </button>';

                    $btnUpdateStatus =
                        '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateStatusUmum(' . $val->umum->id_umum . ',' . $request->idKursus . ')">
                    <i class="bi bi-check-square text-green"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                    data-toggle="modal" data-target="#modal-komentar"
                    data-action="' . route('admin.sendKomentar2', ['id_umum' => $val->umum->id_umum, 'id_kursus' => $request->idKursus]) . '">
                    <i class="bi bi-x-square text-danger"></i>
                    </button>';

                    $btnPrint = '<a href="' . route('generateUmum.pdf', ['id_kursus' => $request->idKursus, 'id_umum_satu' => $val->umum->id_umum]) . '"
                    class="btn btn-sm btn-outline-secondary"><i
                        class="bi bi-printer-fill text-indigo"></i></a>';

                    $response['data'][] = [
                        $val->umum->nama,
                        $val->no_kartu_umum,
                        date(
                            'Y',
                            strtotime($val->created_at)
                        ),
                        $status,
                        $btnFotoKuitansi,
                        $btnFotoUmum,
                        $val->kursus->sertifikat === 1 ? $btnFotoSertifikat : '-',
                        $btnUpdateStatus,
                        $btnPrint,

                    ];
                }
            }

            $response['recordsTotal'] = 0;
            if ($total_data_mahasiswa && $total_data_umum <> FALSE) {
                $response['recordsTotal'] = $total_data_mahasiswa + $total_data_umum;
            }

            $response['recordsFiltered'] = 0;
            if ($total_filtered_mahasiswa && $total_filtered_umum <> FALSE) {
                $response['recordsFiltered'] = $total_filtered_mahasiswa + $total_filtered_umum;
            }

            return response()->json($response);
        }
    }
}
