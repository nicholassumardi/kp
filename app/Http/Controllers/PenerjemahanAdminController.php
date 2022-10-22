<?php

namespace App\Http\Controllers;

use App\Models\Abstrak;
use App\Models\AbstrakUmum;
use App\Models\Admin;
use App\Models\Ijazah;
use App\Models\IjazahUmum;
use App\Models\Jurnal;
use App\Models\JurnalUmum;
use App\Models\TranskripNilai;
use App\Models\TranskripNilaiUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenerjemahanAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only(['index', 'create']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        // data Mahasiswa
        $this->dataView['data_abstract'] = Abstrak::where('file_status', 1)->get();
        $this->dataView['data_transkrip_nilai'] = TranskripNilai::where('file_status', 1)->get();
        $this->dataView['data_ijazah'] = Ijazah::where('file_status', 1)->get();
        $this->dataView['data_jurnal'] = Jurnal::where('file_status', 1)->get();
        $this->dataView['abstrak_count'] = count($this->dataView['data_abstract']);
        $this->dataView['transkrip_nilai_count'] = count($this->dataView['data_transkrip_nilai']);
        $this->dataView['ijazah_count'] = count($this->dataView['data_ijazah']);
        $this->dataView['jurnal_count'] = count($this->dataView['data_jurnal']);
        // data Umum/ Pulic
        $this->dataView['data_abstract_umum'] = AbstrakUmum::where('file_status', 1)->get();
        $this->dataView['data_transkrip_nilai_umum'] = TranskripNilaiUmum::where('file_status', 1)->get();
        $this->dataView['data_ijazah_umum'] = IjazahUmum::where('file_status', 1)->get();
        $this->dataView['data_jurnal_umum'] = JurnalUmum::where('file_status', 1)->get();
        $this->dataView['abstrak_umum_count'] = count($this->dataView['data_abstract_umum']);
        $this->dataView['transkrip_nilai_umum_count'] = count($this->dataView['data_transkrip_nilai_umum']);
        $this->dataView['ijazah_umum_count'] = count($this->dataView['data_ijazah_umum']);
        $this->dataView['jurnal_umum_count'] = count($this->dataView['data_jurnal_umum']);

        return view('admin.main.abstract_admin.index', $this->dataView);
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
    public function edit($id)
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();

        return view('admin.main.abstract_admin.edit', $this->dataView);
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

    public function editPageAbstrak(Request $request, $id_abstrak, $id_mahasiswa)
    {

        $this->dataView['page'] = 'Abstract';
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        $this->dataView['data_abstract'] = Abstrak::where('id_abstrak', $id_abstrak)->where('mahasiswa_id', $id_mahasiswa)->first();
        return view('admin.main.abstract_admin.edit', $this->dataView);
    }

    public function editPageJurnal(Request $request, $id_jurnal, $id_mahasiswa)
    {
        $this->dataView['page'] = 'Journal';
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        $this->dataView['data_jurnal'] = Jurnal::where('id_jurnal', $id_jurnal)->where('mahasiswa_id', $id_mahasiswa)->first();
        return view('admin.main.abstract_admin.edit', $this->dataView);
    }

    public function updatePartialAbstrak(Request $request, $id_abstrak, $id_mahasiswa)
    {

        Abstrak::where('id_abstrak', $id_abstrak)
            ->where('mahasiswa_id', $id_mahasiswa)
            ->update([
                'path_file_abstrak_admin_word' => $request->path_file_abstrak_admin_word->storeAs(
                    'dokumen/dokumen-abstrak/admin/',
                    $request->path_file_abstrak_admin_word->getClientOriginalName(),
                    'public'
                ),
                'path_file_abstrak_admin_pdf' => $request->path_file_abstrak_admin_pdf->storeAs(
                    'dokumen/dokumen-abstrak/admin/',
                    $request->path_file_abstrak_admin_pdf->getClientOriginalName(),
                    'public'
                ),
                // 'status' => 'verified',
            ]);

        return redirect()->back()
            ->with('success', 'Abstract has been sent.');
    }

    public function updatePartialJurnal(Request $request, $id_jurnal, $id_mahasiswa)
    {

        Jurnal::where('id_jurnal', $id_jurnal)
            ->where('mahasiswa_id', $id_mahasiswa)
            ->update([
                'path_file_jurnal_admin_word' => $request->path_file_jurnal_admin_word->storeAs(
                    'dokumen/dokumen-jurnal/admin/',
                    $request->path_file_jurnal_admin_word->getClientOriginalName(),
                    'public'
                ),
                'path_file_jurnal_admin_pdf' => $request->path_file_jurnal_admin_pdf->storeAs(
                    'dokumen/dokumen-jurnal/admin/',
                    $request->path_file_jurnal_admin_pdf->getClientOriginalName(),
                    'public'
                ),
                // 'status' => 'verified',
            ]);

        return redirect()->back()
            ->with('success', 'Journal has been sent.');
    }

    public function changeStatusToPending(Request $request)
    {
        // Jika request ajax
        if ($request->ajax()) {
            if ($request->layanan === 'abstrak') {
                $abstrak = tap(Abstrak::where('id_abstrak', $request->id))
                    ->update(['status' => 'pending'])
                    ->first();

                return response()->json($abstrak);
            } elseif ($request->layanan === 'jurnal') {
                $jurnal = tap(Jurnal::where('id_jurnal', $request->id))
                    ->update(['status' => 'pending'])
                    ->first();

                return response()->json($jurnal);
            } elseif ($request->layanan === 'abstrakUmum') {
                $abstrakUmum = tap(AbstrakUmum::where('id_abstrak_umum', $request->id))
                    ->update(['status' => 'pending'])
                    ->first();

                return response()->json($abstrakUmum);
            } elseif ($request->layanan === 'jurnalUmum') {
                $jurnalUmum = tap(JurnalUmum::where('id_jurnal_umum', $request->id))
                    ->update(['status' => 'pending'])
                    ->first();

                return response()->json($jurnalUmum);
            }
        }
        // Jika request bukan ajax, throw halaman 403.
        return abort(403);
    }
    public function changeStatusToChecked(Request $request)
    {
        // Jika request ajax
        if ($request->ajax()) {
            if ($request->layanan === 'transkrip_nilai') {
                $transkripNilai = tap(TranskripNilai::where('id_transkrip_nilai', $request->id))
                    ->update(['status' => 'checked'])
                    ->first();

                return response()->json($transkripNilai);
            } elseif ($request->layanan === 'ijazah') {
                $ijazah = tap(Ijazah::where('id_ijazah', $request->id))
                    ->update(['status' => 'checked'])
                    ->first();

                return response()->json($ijazah);
            } elseif ($request->layanan === 'transkrip_nilai_umum') {
                $transkripnilaiUmum = tap(TranskripNilaiUmum::where('id_transkrip_nilai_umum', $request->id))
                    ->update(['status' => 'checked'])
                    ->first();

                return response()->json($transkripnilaiUmum);
            } elseif ($request->layanan === 'ijazah_umum') {
                $ijazahUmum = tap(IjazahUmum::where('id_ijazah_umum', $request->id))
                    ->update(['status' => 'checked'])
                    ->first();

                return response()->json($ijazahUmum);
            }
        }
        // Jika request bukan ajax, throw halaman 403.
        return abort(403);
    }


    public function changeStatusToVerified(Request $request)
    {
        // Jika request ajax
        if ($request->ajax()) {
            if ($request->layanan === 'abstrak') {
                $abstrak = tap(Abstrak::where('id_abstrak', $request->id))
                    ->update(['status' => 'verified'])
                    ->first();

                return response()->json($abstrak);
            } elseif ($request->layanan === 'jurnal') {
                $jurnal = tap(Jurnal::where('id_jurnal', $request->id))
                    ->update(['status' => 'verified'])
                    ->first();

                return response()->json($jurnal);
            } elseif ($request->layanan === 'abstrakUmum') {
                $abstrakUmum = tap(AbstrakUmum::where('id_abstrak_umum', $request->id))
                    ->update(['status' => 'verified'])
                    ->first();

                return response()->json($abstrakUmum);
            } elseif ($request->layanan === 'jurnalUmum') {
                $jurnalUmum = tap(JurnalUmum::where('id_jurnal_umum', $request->id))
                    ->update(['status' => 'verified'])
                    ->first();

                return response()->json($jurnalUmum);
            }
        }
        // Jika request bukan ajax, throw halaman 403.
        return abort(403);
    }

    // public function changeStatusToRejected(Request $request)
    // {
    //     // Jika request ajax
    //     if ($request->ajax()) {
    //         if ($request->layanan === 'transkrip_nilai') {
    //             $transkripNilai = tap(TranskripNilai::where('id_transkrip_nilai', $request->id))
    //                 ->update(['status' => 'rejected'])
    //                 ->first();

    //             return response()->json($transkripNilai);
    //         } elseif ($request->layanan === 'ijazah') {
    //             $ijazah = tap(Ijazah::where('id_ijazah', $request->id))
    //                 ->update(['status' => 'rejected'])
    //                 ->first();

    //             return response()->json($ijazah);
    //         } elseif ($request->layanan === 'transkrip_nilai_umum') {
    //             $transkripnilaiUmum = tap(TranskripNilaiUmum::where('id_transkrip_nilai_umum', $request->id))
    //                 ->update(['status' => 'rejected'])
    //                 ->first();

    //             return response()->json($transkripnilaiUmum);
    //         } elseif ($request->layanan === 'ijazah_umum') {
    //             $ijazahUmum = tap(IjazahUmum::where('id_ijazah_umum', $request->id))
    //                 ->update(['status' => 'rejected'])
    //                 ->first();

    //             return response()->json($ijazahUmum);
    //         }
    //         if ($request->layanan === 'abstrak') {
    //             $abstrak = tap(Abstrak::where('id_absrak', $request->id))
    //                 ->update(['status' => 'rejected'])
    //                 ->first();

    //             return response()->json($abstrak);
    //         } elseif ($request->layanan === 'jurnal') {
    //             $jurnal = tap(Ijazah::where('id_jurnal', $request->id))
    //                 ->update(['status' => 'rejected'])
    //                 ->first();

    //             return response()->json($jurnal);
    //         } elseif ($request->layanan === 'abstrak_umum') {
    //             $abstrakUmum = tap(AbstrakUmum::where('id_abstrak_umum', $request->id))
    //                 ->update(['status' => 'rejected'])
    //                 ->first();

    //             return response()->json($abstrakUmum);
    //         } elseif ($request->layanan === 'jurnal_umum') {
    //             $jurnalUmum = tap(IjazahUmum::where('id_jurnal_umum', $request->id))
    //                 ->update(['status' => 'rejected'])
    //                 ->first();

    //             return response()->json($jurnalUmum);
    //         }
    //     }
    //     // Jika request bukan ajax, throw halaman 403.
    //     return abort(403);
    // }

    public function editPageAbstrakUmum(Request $request, $id_abstrak_umum, $id_umum)
    {

        $this->dataView['page'] = 'AbstractUmum';
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        $this->dataView['data_abstract_umum'] = AbstrakUmum::where('id_abstrak_umum', $id_abstrak_umum)->where('umum_id', $id_umum)->first();
        return view('admin.main.abstract_admin.edit', $this->dataView);
    }

    public function editPageJurnalUmum(Request $request, $id_jurnal_umum, $id_umum)
    {
        $this->dataView['page'] = 'JournalUmum';
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        $this->dataView['data_jurnal_umum'] = JurnalUmum::where('id_jurnal_umum', $id_jurnal_umum)->where('umum_id', $id_umum)->first();
        return view('admin.main.abstract_admin.edit', $this->dataView);
    }

    public function updatePartialAbstrakUmum(Request $request, $id_abstrak_umum, $id_umum)
    {

        AbstrakUmum::where('id_abstrak_umum', $id_abstrak_umum)
            ->where('umum_id', $id_umum)
            ->update([
                'path_file_abstrak_admin_word' => $request->path_file_abstrak_admin_word->storeAs(
                    'dokumen/dokumen-abstrak/admin/',
                    $request->path_file_abstrak_admin_word->getClientOriginalName(),
                    'public'
                ),
                'path_file_abstrak_admin_pdf' => $request->path_file_abstrak_admin_pdf->storeAs(
                    'dokumen/dokumen-abstrak/admin/',
                    $request->path_file_abstrak_admin_pdf->getClientOriginalName(),
                    'public'
                ),
                // 'status' => 'verified',
            ]);


        return redirect()->back()
            ->with('success', 'Abstract has been sent.');
    }

    public function updatePartialJurnalUmum(Request $request, $id_jurnal_umum, $id_umum)
    {

        JurnalUmum::where('id_jurnal_umum', $id_jurnal_umum)
            ->where('umum_id', $id_umum)
            ->update([
                'path_file_jurnal_admin_word' => $request->path_file_jurnal_admin_word->storeAs(
                    'dokumen/dokumen-jurnal/admin/',
                    $request->path_file_jurnal_admin_word->getClientOriginalName(),
                    'public'
                ),
                'path_file_jurnal_admin_pdf' => $request->path_file_jurnal_admin_pdf->storeAs(
                    'dokumen/dokumen-jurnal/admin/',
                    $request->path_file_jurnal_admin_pdf->getClientOriginalName(),
                    'public'
                ),
                // 'status' => 'verified',
            ]);

        return redirect()->back()
            ->with('success', 'Journal has been sent.');
    }




    public function downloadAbstrakMahasiswa($id_mahasiswa, $id_abstrak)
    {
        $file_name = Abstrak::where([
            ['mahasiswa_id', '=', $id_mahasiswa],
            ['id_abstrak', '=', $id_abstrak],
        ])->value('path_file_abstrak_mahasiswa');
        $file = public_path('storage/') . $file_name;


        return response()->download($file);
    }

    public function downloadTranskripMahasiswa($id_mahasiswa, $id_transkrip_nilai)
    {
        $file_name = TranskripNilai::where([
            ['mahasiswa_id', '=', $id_mahasiswa],
            ['id_transkrip_nilai', '=', $id_transkrip_nilai],
        ])->value('path_file_transkrip_nilai');
        $file = public_path('storage/') . $file_name;


        return response()->download($file);
    }
    public function downloadIjazahMahasiswa($id_mahasiswa, $id_ijazah)
    {
        $file_name = Ijazah::where([
            ['mahasiswa_id', '=', $id_mahasiswa],
            ['id_ijazah', '=', $id_ijazah],
        ])->value('path_file_ijazah');
        $file = public_path('storage/') . $file_name;


        return response()->download($file);
    }
    public function downloadJurnalMahasiswa($id_mahasiswa, $id_jurnal)
    {
        $file_name = Jurnal::where([
            ['mahasiswa_id', '=', $id_mahasiswa],
            ['id_jurnal', '=', $id_jurnal],
        ])->value('path_file_jurnal_mahasiswa');
        $file = public_path('storage/') . $file_name;


        return response()->download($file);
    }


    public function downloadAbstrakUmum($id_umum, $id_abstrak_umum)
    {
        $file_name = AbstrakUmum::where([
            ['umum_id', '=', $id_umum],
            ['id_abstrak_umum', '=', $id_abstrak_umum],
        ])->value('path_file_abstrak_umum');
        $file = public_path('storage/') . $file_name;


        return response()->download($file);
    }

    public function downloadTranskripUmum($id_umum, $id_transkrip_nilai_umum)
    {
        $file_name = TranskripNilaiUmum::where([
            ['umum_id', '=', $id_umum],
            ['id_transkrip_nilai_umum', '=', $id_transkrip_nilai_umum],
        ])->value('path_file_transkrip_nilai');
        $file = public_path('storage/') . $file_name;


        return response()->download($file);
    }
    public function downloadIjazahUmum($id_umum, $id_ijazah_umum)
    {
        $file_name = IjazahUmum::where([
            ['umum_id', '=', $id_umum],
            ['id_ijazah_umum', '=', $id_ijazah_umum],
        ])->value('path_file_ijazah');
        $file = public_path('storage/') . $file_name;


        return response()->download($file);
    }
    public function downloadJurnalUmum($id_umum, $id_jurnal_umum)
    {
        $file_name = JurnalUmum::where([
            ['umum_id', '=', $id_umum],
            ['id_jurnal_umum', '=', $id_jurnal_umum],
        ])->value('path_file_jurnal_umum');
        $file = public_path('storage/') . $file_name;
        $headers = ['Content-Type: application/msword'];
        $fileName = $file_name . '.doc';

        return response()->download($file);
    }
    public function sendKomentarAbstrak(Request $request, $id_abstrak)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        Abstrak::where('id_abstrak', $id_abstrak)
            ->update([
                'komentar' => $request->komentar,
                'status' => 'rejected'
            ]);

        return redirect()->back()
            ->with('success', 'Comment has been sent.');
    }
    public function sendKomentarTranskripNilai(Request $request, $id_transkrip_nilai)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        TranskripNilai::where('id_transkrip_nilai', $id_transkrip_nilai)
            ->update([
                'komentar' => $request->komentar,
                'status' => 'rejected'
            ]);

        return redirect()->back()
            ->with('success', 'Comment has been sent.');
    }
    public function sendKomentarIjazah(Request $request, $id_ijazah)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        Ijazah::where('id_ijazah', $id_ijazah)
            ->update([
                'komentar' => $request->komentar,
                'status' => 'rejected'
            ]);

        return redirect()->back()
            ->with('success', 'Comment has been sent.');
    }
    public function sendKomentarJurnal(Request $request, $id_jurnal)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        Jurnal::where('id_jurnal', $id_jurnal)
            ->update([
                'komentar' => $request->komentar,
                'status' => 'rejected'
            ]);

        return redirect()->back()
            ->with('success', 'Comment has been sent.');
    }

    public function sendKomentarAbstrakUmum(Request $request, $id_abstrak_umum)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        AbstrakUmum::where('id_abstrak_umum', $id_abstrak_umum)
            ->update([
                'komentar' => $request->komentar,
                'status' => 'rejected'
            ]);

        return redirect()->back()
            ->with('success', 'Comment has been sent.');
    }
    public function sendKomentarTranskripNilaiUmum(Request $request, $id_transkrip_nilai_umum)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        TranskripNilaiUmum::where('id_transkrip_nilai_umum', $id_transkrip_nilai_umum)
            ->update([
                'komentar' => $request->komentar,
                'status' => 'rejected'
            ]);

        return redirect()->back()
            ->with('success', 'Comment has been sent.');
    }
    public function sendKomentarIjazahUmum(Request $request, $id_ijazah_umum)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        IjazahUmum::where('id_ijazah_umum', $id_ijazah_umum)
            ->update([
                'komentar' => $request->komentar,
                'status' => 'rejected'
            ]);

        return redirect()->back()
            ->with('success', 'Comment has been sent.');
    }
    public function sendKomentarJurnalUmum(Request $request, $id_jurnal_umum)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        JurnalUmum::where('id_jurnal_umum', $id_jurnal_umum)
            ->update([
                'komentar' => $request->komentar,
                'status' => 'rejected'
            ]);

        return redirect()->back()
            ->with('success', 'Comment has been sent.');
    }

    // // Delete File Mahasiswa
    // public function deleteAbstrakMahasiswa($id_mahasiswa, $id_abstrak)
    // {
    //     Abstrak::where([
    //         ['mahasiswa_id', '=', $id_mahasiswa],
    //         ['id_abstrak', '=', $id_abstrak],
    //     ])->delete();

    //     return redirect()->route('penerjemahan-admin.index')
    //         ->with('success', 'Abstract deleted successfully .');
    // }
    // public function deleteTranskripMahasiswa($id_mahasiswa, $id_transkrip_nilai)
    // {
    //     TranskripNilai::where([
    //         ['mahasiswa_id', '=', $id_mahasiswa],
    //         ['id_transkrip_nilai', '=', $id_transkrip_nilai],
    //     ])->delete();

    //     return redirect()->route('penerjemahan-admin.index')
    //         ->with('success', 'Transkrip Nilai deleted successfully .');
    // }
    // public function deleteIjazahMahasiswa($id_mahasiswa, $id_ijazah)
    // {
    //     Ijazah::where([
    //         ['mahasiswa_id', '=', $id_mahasiswa],
    //         ['id_ijazah', '=', $id_ijazah],
    //     ])->delete();

    //     return redirect()->route('penerjemahan-admin.index')
    //         ->with('success', 'Ijazah deleted successfully .');
    // }
    // public function deleteJurnalMahasiswa($id_mahasiswa, $id_jurnal)
    // {
    //     Jurnal::where([
    //         ['mahasiswa_id', '=', $id_mahasiswa],
    //         ['id_jurnal', '=', $id_jurnal],
    //     ])->delete();

    //     return redirect()->route('penerjemahan-admin.index')
    //         ->with('success', 'Journal deleted successfully .');
    // }


    // // Delete File Public (Umum)
    // public function deleteAbstrakUmum($id_umum, $id_abstrak_umum)
    // {
    //     AbstrakUmum::where([
    //         ['umum_id', '=', $id_umum],
    //         ['id_abstrak_umum', '=', $id_abstrak_umum],
    //     ])->delete();

    //     return redirect()->route('penerjemahan-admin.index')
    //         ->with('success', 'Abstract deleted successfully .');
    // }
    // public function deleteTranskripUmum($id_umum, $id_transkrip_umum)
    // {
    //     TranskripNilaiUmum::where([
    //         ['umum_id', '=', $id_umum],
    //         ['id_transkrip_nilai_umum', '=', $id_transkrip_umum],
    //     ])->delete();

    //     return redirect()->route('penerjemahan-admin.index')
    //         ->with('success', 'Transkrip Nilai deleted successfully .');
    // }
    // public function deleteIjazahUmum($id_umum, $id_ijazah_umum)
    // {
    //     IjazahUmum::where([
    //         ['umum_id', '=', $id_umum],
    //         ['id_ijazah_umum', '=', $id_ijazah_umum],
    //     ])->delete();

    //     return redirect()->route('penerjemahan-admin.index')
    //         ->with('success', 'Ijazah deleted successfully .');
    // }
    // public function deleteJurnalUmum($id_umum, $id_jurnal_umum)
    // {
    //     JurnalUmum::where([
    //         ['umum_id', '=', $id_umum],
    //         ['id_jurnal_umum', '=', $id_jurnal_umum],
    //     ])->delete();

    //     return redirect()->route('penerjemahan-admin.index')
    //         ->with('success', 'Journal deleted successfully .');
    // }

    // MAHASISWA
    public function deactiveAbstrak($id_abstrak)
    {
        Abstrak::where('id_abstrak', $id_abstrak)->update([
            'file_status' => 0
        ]);

        return redirect()->back()
            ->with('success', 'deactivated successfully.');
    }
    public function deactiveTranskripNilai($id_transkrip_nilai)
    {
        TranskripNilai::where('id_transkrip_nilai', $id_transkrip_nilai)->update([
            'file_status' => 0
        ]);

        return redirect()->back()
            ->with('success', 'deactivated successfully.');
    }
    public function deactiveIjazah($id_ijazah)
    {
        Ijazah::where('id_ijazah', $id_ijazah)->update([
            'file_status' => 0
        ]);

        return redirect()->back()
            ->with('success', 'deactivated successfully.');
    }
    public function deactiveJurnal($id_jurnal)
    {
        Jurnal::where('id_jurnal', $id_jurnal)->update([
            'file_status' => 0
        ]);

        return redirect()->back()
            ->with('success', 'deactivated successfully.');
    }

    // PUBLIC/ UMUM
    public function deactiveAbstrakUmum($id_abstrak_umum)
    {
        AbstrakUmum::where('id_abstrak_umum', $id_abstrak_umum)->update([
            'file_status' => 0
        ]);

        return redirect()->back()
            ->with('success', 'deactivated successfully.');
    }
    public function deactiveTranskripNilaiUmum($id_transkrip_nilai_umum)
    {
        TranskripNilaiUmum::where('id_transkrip_nilai_umum', $id_transkrip_nilai_umum)->update([
            'file_status' => 0
        ]);

        return redirect()->back()
            ->with('success', 'deactivated successfully.');
    }
    public function deactiveIjazahUmum($id_ijazah_umum)
    {
        IjazahUmum::where('id_ijazah_umum', $id_ijazah_umum)->update([
            'file_status' => 0
        ]);

        return redirect()->back()
            ->with('success', 'deactivated successfully.');
    }
    public function deactiveJurnalUmum($id_jurnal_umum)
    {
        JurnalUmum::where('id_jurnal_umum', $id_jurnal_umum)->update([
            'file_status' => 0
        ]);

        return redirect()->back()
            ->with('success', 'deactivated successfully.');
    }

    public function datatable(Request $request)
    {

        if ($request->tipeUser == "Mahasiswa") {
            if ($request->tipePenerjemahan === "Abstrak") {
                $column = [
                    'id_abstrak',
                    'created_at',
                    'mahasiswa_id',
                    'email',
                    'no_hp',
                    'path_foto_kuitansi',
                    'status',
                    'path_file_abstrak_mahasiswa',
                ];

                $start  = $request->start;
                $length = $request->length;
                $order  = $column[$request->input('order.0.column')];
                $dir    = $request->input('order.0.dir');
                $search = $request->input('search.value');


                $total_data = Abstrak::count();

                $query_data = Abstrak::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('mahasiswa', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })
                    ->offset($start)
                    ->limit($length)
                    ->orderBy($order, $dir)
                    ->get();

                $total_filtered = Abstrak::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('mahasiswa', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })->count();

                $response['data'] = [];
                if ($query_data <> FALSE) {

                    foreach ($query_data as $val) {
                        $getStatus = $val->status === 'unverified' ? 'btn-danger' : ($val->status === 'pending' ? ' btn-warning' : ($val->status === 'rejected' ? 'btn-danger' : 'btn-success'));

                        $status =
                            '<li class="btn btn-sm js-status ' . $getStatus . '  disabled">
                        ' . $val->status . '
                        </li>';

                        $buttonEditStatus =
                            '<button type="button" class="btn btn-sm btn-outline-secondary js-btn-abstrak-pending"
                            data-id=" ' . $val->id_abstrak . '">
                            <i class="bi bi-hourglass-split text-yellow"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary js-btn-abstrak-verified"
                            data-id="' . $val->id_abstrak . '">
                            <i class=" bi bi-check-square text-green"></i>
                        </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                                data-toggle="modal" data-target="#modal-komentar"
                                data-action="' . route('penerjemahan.sendKomentarAbstrak',  $val->id_abstrak) . '">
                                <i class="bi bi-x-square text-danger"></i>
                        </button>';

                        $buttonAction =
                            '<a href="' . route('penerjemahan.downloadAbstrakMahasiswa', ['id_mahasiswa' =>  $val->mahasiswa_id, 'id_abstrak' =>  $val->id_abstrak]) . '"
                        class="btn btn-sm btn-outline-secondary"><i
                        class="bi bi-download text-gray"></i></a>
                        <a href="' . route('penerjemahan-admin.editPageAbstrak', ['id_penerjemahan' => $val->id_abstrak, 'id_mahasiswa' =>  $val->mahasiswa_id]) . '"
                        class="btn btn-sm btn-outline-secondary"><i
                        class="bi bi-pen-fill text-green"></i>
                        </a>';

                        $buttonPrint = '<a href="' . route('generate2.pdf', ['id_abstract_satu' => $val->id_abstrak, 'id_mahasiswa_satu' => $val->mahasiswa_id]) . '"
                        class="btn btn-sm btn-outline-secondary"><i
                        class="bi bi-printer-fill text-indigo"></i></a>';



                        $buttonDeactive =
                            '<button class="btn btn-sm btn-outline-secondary js-button-submit" type="button" onclick="deactiveAbstract(' . $val->id_abstrak . ')"><i class="bi bi-trash2-fill text-red"></i></button>';



                        $response['data'][] = [

                            date(
                                'd M Y',
                                strtotime($val->created_at)
                            ),
                            "Abstract",
                            $val->mahasiswa->nama,
                            $val->email,
                            $val->no_hp,
                            '<img src="' . url('storage/' . $val->path_foto_kuitansi) . '"
                                    class="custombuktipembayaran">',
                            $status,



                            basename($val->path_file_abstrak_mahasiswa),
                            $buttonEditStatus,
                            $buttonAction,
                            $buttonPrint,
                            $buttonDeactive,

                        ];
                    }
                }
            } else if ($request->tipePenerjemahan === "Ijazah") {
                $column = [
                    'id_ijazah',
                    'mahasiswa_id',
                    'created_at',
                    'status',
                ];

                $start  = $request->start;
                $length = $request->length;
                $order  = $column[$request->input('order.0.column')];
                $dir    = $request->input('order.0.dir');
                $search = $request->input('search.value');


                $total_data = Ijazah::count();

                $query_data = Ijazah::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('mahasiswa', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })
                    ->offset($start)
                    ->limit($length)
                    ->orderBy($order, $dir)
                    ->get();

                $total_filtered = Ijazah::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('mahasiswa', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })->count();

                $response['data'] = [];
                if ($query_data <> FALSE) {

                    foreach ($query_data as $val) {

                        $getStatus = $val->status === 'unchecked' ? 'btn-danger' : ($val->status === 'rejected' ? ' btn-danger' : 'btn-success');

                        $status =
                            '<li class="btn btn-sm js-status ' . $getStatus . '  disabled">
                        ' . $val->status . '
                        </li>';

                        $buttonEditStatus =
                            '<button type="button" class="btn btn-sm btn-outline-secondary js-btn-ijazah-checked"
                                    data-id="' . $val->id_ijazah . '">
                                    <i class=" bi bi-check-square text-green"></i>
                        </button>
                              
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                            data-toggle="modal" data-target="#modal-komentar"
                            data-action="' . route('penerjemahan.sendKomentarIjazah', $val->id_ijazah) . '">
                            <i class="bi bi-x-square text-danger"></i>
                        </button>';

                        $buttonAction =
                            '<a href="' . route('penerjemahan.downloadIjazahMahasiswa', ['id_mahasiswa' => $val->mahasiswa_id, 'id_ijazah' => $val->id_ijazah]) . '"
                        class="btn btn-sm btn-outline-secondary js-btn-download-ijazah"
                        data-id="{{ $ijazah->id_ijazah}}"><i class="bi bi-download text-gray"></i></a>';

                        $buttonPrint =
                            '<a href="' . route('generate4.pdf', ['id_ijazah_satu' => $val->id_ijazah, 'id_mahasiswa_satu' => $val->mahasiswa_id]) . '"
                        class="btn btn-sm btn-outline-secondary"><i
                            class="bi bi-printer-fill text-indigo"></i></a>';


                        $buttonDeactive =
                            '<button class="btn btn-sm btn-outline-secondary js-button-submit" type="button" onclick="deactiveIjazah(' . $val->id_ijazah . ')"><i class="bi bi-trash2-fill text-red"></i></button>';



                        $response['data'][] = [

                            date(
                                'd M Y',
                                strtotime($val->created_at)
                            ),
                            'Ijazah',
                            $val->mahasiswa->nama,
                            $val->email,
                            $val->no_hp,
                            '<img src="' . url('storage/' . $val->path_foto_kuitansi) . '"
                                    class="custombuktipembayaran">',
                            $status,
                            basename($val->path_file_ijazah),
                            $buttonEditStatus,
                            $buttonAction,
                            $buttonPrint,
                            $buttonDeactive

                        ];
                    }
                }
            } else if ($request->tipePenerjemahan === "Transkrip") {

                $column = [
                    'id_transkrip_nilai',
                    'mahasiswa_id',
                    'created_at',
                    'status',
                ];

                $start  = $request->start;
                $length = $request->length;
                $order  = $column[$request->input('order.0.column')];
                $dir    = $request->input('order.0.dir');
                $search = $request->input('search.value');


                $total_data = TranskripNilai::count();

                $query_data = TranskripNilai::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('mahasiswa', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })
                    ->offset($start)
                    ->limit($length)
                    ->orderBy($order, $dir)
                    ->get();

                $total_filtered = TranskripNilai::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('mahasiswa', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })->count();

                $response['data'] = [];
                if ($query_data <> FALSE) {

                    foreach ($query_data as $val) {

                        $getStatus = $val->status === 'unchecked' ? 'btn-danger' : ($val->status === 'rejected' ? ' btn-danger' : 'btn-success');

                        $status =
                        '<li class="btn btn-sm js-status ' . $getStatus . '  disabled">
                        ' . $val->status . '
                        </li>';

                        $buttonEditStatus =
                        '<button type="button" class="btn btn-sm btn-outline-secondary js-btn-transkrip-checked"
                            data-id="'. $val->id_transkrip_nilai .'">
                            <i class=" bi bi-check-square text-green"></i>
                        </button>
            
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                            data-toggle="modal" data-target="#modal-komentar"
                            data-action="'. route('penerjemahan.sendKomentarTranskripNilai', $val->id_transkrip_nilai) .'">
                            <i class="bi bi-x-square text-danger"></i>
                        </button>';

                        $buttonAction =
                        '<a href="'. route('penerjemahan.downloadTranskripMahasiswa', ['id_mahasiswa' => $val->mahasiswa_id, 'id_transkrip_nilai' => $val->id_transkrip_nilai]) .'"
                        class="btn btn-sm btn-outline-secondary js-btn-download-transkrip-nilai"
                        data-id="'. $val->id_transkrip_nilai .'"><i
                            class="bi bi-download text-gray"></i></a>';

                        $buttonPrint =
                        '<a href="'. route('generate3.pdf', ['id_transkrip_nilai_satu' => $val->id_transkrip_nilai, 'id_mahasiswa_satu' => $val->mahasiswa_id]) .'"
                        class="btn btn-sm btn-outline-secondary"><i
                            class="bi bi-printer-fill text-indigo"></i></a>';


                        $buttonDeactive =
                            '<button class="btn btn-sm btn-outline-secondary js-button-submit" type="button" onclick="deactiveTranskrip(' . $val->id_transkrip_nilai . ')"><i class="bi bi-trash2-fill text-red"></i></button>';



                        $response['data'][] = [

                            date(
                                'd M Y',
                                strtotime($val->created_at)
                            ),
                            'Transkrip Nilai',
                            $val->mahasiswa->nama,
                            $val->email,
                            $val->no_hp,
                            '<img src="' . url('storage/' . $val->path_foto_kuitansi) . '"
                                    class="custombuktipembayaran">',
                            $status,
                            basename($val->path_file_transkrip_nilai),
                            $buttonEditStatus,
                            $buttonAction,
                            $buttonPrint,
                            $buttonDeactive

                        ];
                    }
                }
            } else {
                $column = [
                    'id_jurnal',
                    'mahasiswa_id',
                    'created_at',
                    'status',
                ];

                $start  = $request->start;
                $length = $request->length;
                $order  = $column[$request->input('order.0.column')];
                $dir    = $request->input('order.0.dir');
                $search = $request->input('search.value');


                $total_data = Jurnal::count();

                $query_data = Jurnal::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('mahasiswa', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })
                    ->offset($start)
                    ->limit($length)
                    ->orderBy($order, $dir)
                    ->get();

                $total_filtered = Jurnal::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('mahasiswa', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })->count();

                $response['data'] = [];
                if ($query_data <> FALSE) {

                    foreach ($query_data as $val) {
                        $getStatus = $val->status === 'unverified' ? 'btn-danger' : ($val->status === 'pending' ? ' btn-warning' : ($val->status === 'rejected' ? 'btn-danger' : 'btn-success'));

                        $status =
                            '<li class="btn btn-sm js-status ' . $getStatus . '  disabled">
                        ' . $val->status . '
                        </li>';
                        $jumlahHalaman = '<br><b> Jumlah Halaman : ' . $val->jumlah_halaman_jurnal . '</b>';
                        $buttonEditStatus =
                            '<button type="button" class="btn btn-sm btn-outline-secondary js-btn-jurnal-pending"
                            data-id="' . $val->id_jurnal . '">
                            <i class="bi bi-hourglass-split text-yellow"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary js-btn-jurnal-verified"
                            data-id="' . $val->id_jurnal . '">
                            <i class=" bi bi-check-square text-green"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                            data-toggle="modal" data-target="#modal-komentar"
                            data-action="' . route('penerjemahan.sendKomentarJurnal', $val->id_jurnal) . '">
                            <i class="bi bi-x-square text-danger"></i>
                        </button>';

                        $buttonAction =
                            '<a href="' . route('penerjemahan.downloadJurnalMahasiswa', ['id_mahasiswa' => $val->mahasiswa_id, 'id_jurnal' => $val->id_jurnal]) . '"
                        class="btn btn-sm btn-outline-secondary js-btn-download-jurnal"
                        data-id="' . $val->id_jurnal . '"><i class="bi bi-download text-gray"></i></a>
                        <a href="' . route('penerjemahan-admin.editPageJurnal', ['id_jurnal' => $val->id_jurnal, 'id_mahasiswa' => $val->mahasiswa_id]) . '" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-pen-fill text-green"></i></a>';

                        $buttonPrint =
                            '<a href="' . route('generate5.pdf', ['id_jurnal_satu' => $val->id_jurnal, 'id_mahasiswa_satu' => $val->mahasiswa_id]) . '" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-printer-fill text-indigo"></i></a>';


                        $buttonDeactive =
                            '<button class="btn btn-sm btn-outline-secondary js-button-submit" type="button" onclick="deactiveJurnal(' . $val->id_jurnal . ')"><i class="bi bi-trash2-fill text-red"></i></button>';



                        $response['data'][] = [

                            date(
                                'd M Y',
                                strtotime($val->created_at)
                            ),
                            'Jurnal' . $jumlahHalaman,
                            $val->mahasiswa->nama,
                            $val->email,
                            $val->no_hp,
                            '<img src="' . url('storage/' . $val->path_foto_kuitansi) . '"
                                    class="custombuktipembayaran">',
                            $status,
                            basename($val->path_file_jurnal_mahasiswa),
                            $buttonEditStatus,
                            $buttonAction,
                            $buttonPrint,
                            $buttonDeactive

                        ];
                    }
                }
            }
        } else {
            if ($request->tipePenerjemahan === "Abstrak") {
                $column = [
                    'id_abstrak_umum',
                    'created_at',
                    'mahasiswa_id',
                    'email',
                    'no_hp',
                    'path_foto_kuitansi',
                    'status',
                    'path_file_abstrak_umum',
                ];

                $start  = $request->start;
                $length = $request->length;
                $order  = $column[$request->input('order.0.column')];
                $dir    = $request->input('order.0.dir');
                $search = $request->input('search.value');


                $total_data = AbstrakUmum::count();

                $query_data = AbstrakUmum::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('umum', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })
                    ->offset($start)
                    ->limit($length)
                    ->orderBy($order, $dir)
                    ->get();

                $total_filtered = AbstrakUmum::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('umum', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })->count();

                $response['data'] = [];
                if ($query_data <> FALSE) {

                    foreach ($query_data as $val) {
                        $getStatus = $val->status === 'unverified' ? 'btn-danger' : ($val->status === 'pending' ? ' btn-warning' : ($val->status === 'rejected' ? 'btn-danger' : 'btn-success'));

                        $status =
                            '<li class="btn btn-sm js-status ' . $getStatus . '  disabled">
                        ' . $val->status . '
                        </li>';

                        $buttonEditStatus =
                        '<button type="button"
                            class="btn btn-sm btn-outline-secondary js-btn-abstrak-umum-pending"
                            data-id="'. $val->id_abstrak_umum .'">
                            <i class="bi bi-hourglass-split text-yellow"></i>
                        </button>
                        <button type="button"
                            class="btn btn-sm btn-outline-secondary js-btn-abstrak-umum-verified"
                            data-id="'. $val->id_abstrak_umum .'">
                            <i class=" bi bi-check-square text-green"></i>
                        </button>

                        <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                            data-toggle="modal" data-target="#modal-komentar"
                            data-action="'. route('penerjemahan.sendKomentarAbstrakUmum',$val->id_abstrak_umum) .'">
                            <i class="bi bi-x-square text-danger"></i>
                        </button>';

                        $buttonAction =
                            
                        '<a href="'. route('penerjemahan.downloadAbstrakUmum', ['id_umum' => $val->umum_id, 'id_abstrak_umum' => $val->id_abstrak_umum]) .'"
                        class="btn btn-sm btn-outline-secondary js-btn-download-abstrak-umum"
                        data-id="'. $val->id_abstrak_umum .'"><i
                            class="bi bi-download text-gray"></i></a>
                        <a href="'. route('penerjemahan-admin.editPageAbstrakUmum', ['id_penerjemahan_umum' => $val->id_abstrak_umum, 'id_umum' => $val->umum_id]) .'"
                            class="btn btn-sm btn-outline-secondary"><i
                                class="bi bi-pen-fill text-green"></i></a>';

                        $buttonPrint = '<a href="'. route('generateUmum2.pdf', ['id_abstract_umum' => $val->id_abstrak_umum, 'id_umum_satu' => $val->umum_id]) .'"
                        class="btn btn-sm btn-outline-secondary"><i
                            class="bi bi-printer-fill text-indigo"></i></a>';



                        $buttonDeactive =
                            '<button class="btn btn-sm btn-outline-secondary js-button-submit" type="button" onclick="deactiveAbstractUmum(' . $val->id_abstrak_umum . ')"><i class="bi bi-trash2-fill text-red"></i></button>';



                        $response['data'][] = [

                            date(
                                'd M Y',
                                strtotime($val->created_at)
                            ),
                            "Abstract",
                            $val->umum->nama,
                            $val->email,
                            $val->no_hp,
                            '<img src="' . url('storage/' . $val->path_foto_kuitansi) . '"
                                    class="custombuktipembayaran">',
                            $status,



                            basename($val->path_file_abstrak_umum),
                            $buttonEditStatus,
                            $buttonAction,
                            $buttonPrint,
                            $buttonDeactive,

                        ];
                    }
                }

            } else if ($request->tipePenerjemahan === "Ijazah") {
                $column = [
                    'id_ijazah_umum',
                    'umum_id',
                    'created_at',
                    'status',
                ];

                $start  = $request->start;
                $length = $request->length;
                $order  = $column[$request->input('order.0.column')];
                $dir    = $request->input('order.0.dir');
                $search = $request->input('search.value');


                $total_data = IjazahUmum::count();

                $query_data = IjazahUmum::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('umum', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })
                    ->offset($start)
                    ->limit($length)
                    ->orderBy($order, $dir)
                    ->get();

                $total_filtered = IjazahUmum::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('umum', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })->count();

                $response['data'] = [];
                if ($query_data <> FALSE) {

                    foreach ($query_data as $val) {

                        $getStatus = $val->status === 'unchecked' ? 'btn-danger' : ($val->status === 'rejected' ? ' btn-danger' : 'btn-success');

                        $status =
                            '<li class="btn btn-sm js-status ' . $getStatus . '  disabled">
                        ' . $val->status . '
                        </li>';

                        $buttonEditStatus =
                        '<button type="button"
                            class="btn btn-sm btn-outline-secondary js-btn-ijazah-umum-checked"
                            data-id="'. $val->id_ijazah_umum .'">
                            <i class=" bi bi-check-square text-green"></i>
                        </button>
                   
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                            data-toggle="modal" data-target="#modal-komentar"
                            data-action="'. route('penerjemahan.sendKomentarIjazahUmum', $val->id_ijazah_umum) .'">
                            <i class="bi bi-x-square text-danger"></i>
                        </button>';

                        $buttonAction =
                        '<a href="'. route('penerjemahan.downloadIjazahUmum', ['id_umum' => $val->umum_id, 'id_ijazah_umum' => $val->id_ijazah_umum]) .'"
                        class="btn btn-sm btn-outline-secondary js-btn-download-ijazah-umum"
                        data-id="'. $val->id_ijazah_umum .'"><i
                            class="bi bi-download text-gray"></i></a>';

                        $buttonPrint =
                            '<a href="'. route('generateUmum4.pdf', ['id_ijazah_umum' => $val->id_ijazah_umum, 'id_umum_satu' => $val->umum_id]) .'"
                            class="btn btn-sm btn-outline-secondary"><i
                                class="bi bi-printer-fill text-indigo"></i></a>';


                        $buttonDeactive =
                            '<button class="btn btn-sm btn-outline-secondary js-button-submit" type="button" onclick="deactiveIjazahUmum(' . $val->id_ijazah_umum . ')"><i class="bi bi-trash2-fill text-red"></i></button>';



                        $response['data'][] = [

                            date(
                                'd M Y',
                                strtotime($val->created_at)
                            ),
                            'Ijazah',
                            $val->umum->nama,
                            $val->email,
                            $val->no_hp,
                            '<img src="' . url('storage/' . $val->path_foto_kuitansi) . '"
                                    class="custombuktipembayaran">',
                            $status,
                            basename($val->path_file_ijazah),
                            $buttonEditStatus,
                            $buttonAction,
                            $buttonPrint,
                            $buttonDeactive

                        ];
                    }
                }
            } else if ($request->tipePenerjemahan === "Transkrip") {
                $column = [
                    'id_transkrip_nilai_umum',
                    'umum_id',
                    'created_at',
                    'status',
                ];

                $start  = $request->start;
                $length = $request->length;
                $order  = $column[$request->input('order.0.column')];
                $dir    = $request->input('order.0.dir');
                $search = $request->input('search.value');


                $total_data = TranskripNilaiUmum::count();

                $query_data = TranskripNilaiUmum::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('umum', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })
                    ->offset($start)
                    ->limit($length)
                    ->orderBy($order, $dir)
                    ->get();

                $total_filtered = TranskripNilaiUmum::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('umum', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })->count();

                $response['data'] = [];
                if ($query_data <> FALSE) {

                    foreach ($query_data as $val) {

                        $getStatus = $val->status === 'unchecked' ? 'btn-danger' : ($val->status === 'rejected' ? ' btn-danger' : 'btn-success');

                        $status =
                        '<li class="btn btn-sm js-status ' . $getStatus . '  disabled">
                        ' . $val->status . '
                        </li>';

                        $buttonEditStatus =
                        '<button type="button"
                            class="btn btn-sm btn-outline-secondary js-btn-transkrip-umum-checked"
                            data-id="'. $val->id_transkrip_nilai_umum .'">
                            <i class=" bi bi-check-square text-green"></i>
                        </button>
                   
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                            data-toggle="modal" data-target="#modal-komentar"
                            data-action="'. route('penerjemahan.sendKomentarTranskripNilaiUmum', $val->id_transkrip_nilai_umum) .'">
                            <i class="bi bi-x-square text-danger"></i>
                        </button>';

                        $buttonAction =
                        '<a href="'. route('penerjemahan.downloadTranskripUmum', ['id_umum' => $val->umum_id, 'id_transkrip_nilai_umum' => $val->id_transkrip_nilai_umum]) .'"
                        class="btn btn-sm btn-outline-secondary js-btn-download-transkrip-nilai-umum"
                        data-id="'. $val->id_transkrip_nilai_umum .'"><i
                            class="bi bi-download text-gray"></i></a>';

                        $buttonPrint =
                        '<a href="'. route('generateUmum3.pdf', ['id_transkrip_nilai_umum' => $val->id_transkrip_nilai_umum, 'id_umum_satu' => $val->umum_id]) .'"
                        class="btn btn-sm btn-outline-secondary"><i
                            class="bi bi-printer-fill text-indigo"></i></a>';


                        $buttonDeactive =
                            '<button class="btn btn-sm btn-outline-secondary js-button-submit" type="button" onclick="deactiveTranskripUmum(' . $val->id_transkrip_nilai_umum . ')"><i class="bi bi-trash2-fill text-red"></i></button>';



                        $response['data'][] = [

                            date(
                                'd M Y',
                                strtotime($val->created_at)
                            ),
                            'Transkrip Nilai',
                            $val->umum->nama,
                            $val->email,
                            $val->no_hp,
                            '<img src="' . url('storage/' . $val->path_foto_kuitansi) . '"
                                    class="custombuktipembayaran">',
                            $status,
                            basename($val->path_file_transkrip_nilai),
                            $buttonEditStatus,
                            $buttonAction,
                            $buttonPrint,
                            $buttonDeactive

                        ];
                    }
                }
            } else {
                $column = [
                    'id_jurnal_umum',
                    'umum_id',
                    'created_at',
                    'status',
                ];

                $start  = $request->start;
                $length = $request->length;
                $order  = $column[$request->input('order.0.column')];
                $dir    = $request->input('order.0.dir');
                $search = $request->input('search.value');


                $total_data = JurnalUmum::count();

                $query_data = JurnalUmum::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('umum', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })
                    ->offset($start)
                    ->limit($length)
                    ->orderBy($order, $dir)
                    ->get();

                $total_filtered = JurnalUmum::where(function ($query) use ($search, $request) {
                    if ($search) {
                        $query->where(function ($query) use ($search, $request) {
                            $query->where('email', 'like', "%$search%")
                                ->orWhereHas('umum', function ($query) use ($search, $request) {
                                    $query->where('nama', 'like', "%$search%");
                                });
                        });
                    }
                })->count();

                $response['data'] = [];
                if ($query_data <> FALSE) {

                    foreach ($query_data as $val) {
                        $getStatus = $val->status === 'unverified' ? 'btn-danger' : ($val->status === 'pending' ? ' btn-warning' : ($val->status === 'rejected' ? 'btn-danger' : 'btn-success'));

                        $status =
                            '<li class="btn btn-sm js-status ' . $getStatus . '  disabled">
                        ' . $val->status . '
                        </li>';
                        $jumlahHalaman = '<br><b> Jumlah Halaman : ' . $val->jumlah_halaman_jurnal . '</b>';

                        $buttonEditStatus =
                        '<button type="button"
                            class="btn btn-sm btn-outline-secondary js-btn-jurnal-umum-pending"
                            data-id="'. $val->id_jurnal_umum .'">
                            <i class="bi bi-hourglass-split text-yellow"></i>
                        </button>
                        <button type="button"
                            class="btn btn-sm btn-outline-secondary js-btn-jurnal-umum-verified"
                            data-id="'. $val->id_jurnal_umum .'">
                            <i class=" bi bi-check-square text-green"></i>
                        </button>
                
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-komentar"
                            data-toggle="modal" data-target="#modal-komentar"
                            data-action="'. route('penerjemahan.sendKomentarJurnalUmum', $val->id_jurnal_umum) .'">
                            <i class="bi bi-x-square text-danger"></i>
                        </button>';

                        $buttonAction =
                        '<a href="'. route('penerjemahan.downloadJurnalUmum', ['id_umum' => $val->umum_id, 'id_jurnal_umum' => $val->id_jurnal_umum]) .'"
                        class="btn btn-sm btn-outline-secondary js-btn-download-jurnal-umum"
                        data-id="'. $val->id_jurnal_umum .'"><i
                            class="bi bi-download text-gray"></i></a>

                        <a href="'. route('penerjemahan-admin.editPageJurnalUmum', ['id_jurnal_umum' => $val->id_jurnal_umum, 'id_umum' => $val->umum_id]) .'"
                            class="btn btn-sm btn-outline-secondary"><i
                                class="bi bi-pen-fill text-green"></i></a>';

                        $buttonPrint =
                        '<a href="'. route('generateUmum5.pdf', ['id_jurnal_umum' => $val->id_jurnal_umum, 'id_umum_satu' => $val->umum_id]) .'"
                        class="btn btn-sm btn-outline-secondary"><i
                            class="bi bi-printer-fill text-indigo"></i></a>';


                        $buttonDeactive =
                            '<button class="btn btn-sm btn-outline-secondary js-button-submit" type="button" onclick="deactiveJurnalUmum(' . $val->id_jurnal_umum . ')"><i class="bi bi-trash2-fill text-red"></i></button>';



                        $response['data'][] = [

                            date(
                                'd M Y',
                                strtotime($val->created_at)
                            ),
                            'Jurnal' . $jumlahHalaman,
                            $val->umum->nama,
                            $val->email,
                            $val->no_hp,
                            '<img src="' . url('storage/' . $val->path_foto_kuitansi) . '"
                                    class="custombuktipembayaran">',
                            $status,
                            basename($val->path_file_jurnal_umum),
                            $buttonEditStatus,
                            $buttonAction,
                            $buttonPrint,
                            $buttonDeactive

                        ];
                    }
                }
            
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
    }
}
