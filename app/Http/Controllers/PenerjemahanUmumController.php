<?php

namespace App\Http\Controllers;

use App\Models\AbstrakUmum;
use App\Models\IjazahUmum;
use App\Models\JurnalUmum;
use App\Models\TranskripNilaiUmum;
use App\Models\Umum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PenerjemahanUmumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.umum')->only(['index', 'create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['umum'] = Umum::where('user_id', Auth::id())->first();
        $this->dataView['data_abstract'] = AbstrakUmum::where('umum_id', $this->dataView['umum']->id_umum)->get();
        $this->dataView['data_transkrip_nilai'] = TranskripNilaiUmum::where('umum_id', $this->dataView['umum']->id_umum)->get();
        $this->dataView['data_ijazah'] = IjazahUmum::where('umum_id', $this->dataView['umum']->id_umum)->get();
        $this->dataView['data_jurnal'] = JurnalUmum::where('umum_id', $this->dataView['umum']->id_umum)->get();

        return view('public.main.abstract_public.index', $this->dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->dataView['umum'] = Umum::where('user_id', Auth::id())->first();
        return view('public.main.abstract_public.create', $this->dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $randToken = rand(0, 20000);
        if ($request->layanan === 'abstrak') {
            $request->validate([
                'path_foto_kuitansi' => 'required',
                'path_file_abstrak_umum' => 'required',
                'email' => 'required|email',
                'no_hp' => 'required',
            ]);

            // Variabel
            $umum = Umum::where('user_id', Auth::id())->first();

            // Jika foto kuitansi dan file abstrak ada.
            if (
                $request->hasFile('path_foto_kuitansi') &&
                $request->hasFile('path_file_abstrak_umum')
            ) {
                // Jika format foto dan file abstrak benar
                if (
                    $this->isMimeFileMatches(
                        [$request->path_foto_kuitansi],
                        ['image/jpeg', 'image/png']
                    )
                    &&
                    $this->isMimeFileMatches(
                        [$request->path_file_abstrak_umum],
                        ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
                    )
                ) {
                    $validatorFileSize = Validator::make($request->all(), [
                        // File maksimum 5 MB / 5000 KB
                        'path_file_abstrak_umum' => 'max:5000',
                    ]);

                    // Jika file tidak melebihi 5 MB
                    if (!$validatorFileSize->fails()) {
                        AbstrakUmum::create([
                            'umum_id' => $umum->id_umum,
                            'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/abstrak-umum/', 'public'),
                            'path_file_abstrak_umum' => $request->path_file_abstrak_umum->storeAs(
                                'dokumen/dokumen-abstrak/umum',
                                $request->path_file_abstrak_umum->getClientOriginalName() . "{}" . $randToken,
                                'public'
                            ),
                            'email' => $request->email,
                            'no_hp' => $request->no_hp,
                            'status' => 'unverified'
                        ]);
                    }
                    // Jika file melebihi 5 MB
                    else {
                        return redirect()->route('penerjemahan-public.index')
                            ->with('error', 'Gagal terkirim karena size file abstract melebihi 5 MB!');
                    }
                }
                // Jika format foto dan file abstrak salah
                else {
                    return redirect()->route('penerjemahan-public.index')
                        ->with('error', 'Gagal terkirim karena format tidak sesuai!');
                }
            }

            return redirect()->route('penerjemahan-public.index')
                ->with('success', 'Berhasil terkirim!');
        } elseif ($request->layanan === 'transkripnilai') {
            $request->validate([
                'path_foto_kuitansi' => 'required',
                'path_file_transkrip_nilai' => 'required',
                'email' => 'required|email',
                'no_hp' => 'required',
            ]);

            // Variabel
            $umum = Umum::where('user_id', Auth::id())->first();

            // Jika foto kuitansi dan file transkrip nilai ada.
            if (
                $request->hasFile('path_foto_kuitansi') &&
                $request->hasFile('path_file_transkrip_nilai')
            ) {
                // Jika format foto dan file transkrip nilai benar
                if (
                    $this->isMimeFileMatches(
                        [$request->path_foto_kuitansi],
                        ['image/jpeg', 'image/png']
                    )
                    &&
                    $this->isMimeFileMatches(
                        [$request->path_file_transkrip_nilai],
                        ['application/pdf', 'image/jpeg', 'image/png']
                    )
                ) {
                    $validatorFileSize = Validator::make($request->all(), [
                        // File maksimum 5 MB / 5000 KB
                        'path_file_transkrip_nilai' => 'max:5000',
                    ]);

                    // Jika file tidak melebihi 5 MB
                    if (!$validatorFileSize->fails()) {
                        TranskripNilaiUmum::create([
                            'umum_id' => $umum->id_umum,
                            'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/transkrip-nilai-umum/', 'public'),
                            'path_file_transkrip_nilai' => $request->path_file_transkrip_nilai->storeAs(
                                'dokumen/dokumen-transkrip/umum',
                                $request->path_file_transkrip_nilai->getClientOriginalName() . "{}" . $randToken,
                                'public'
                            ),
                            'email' => $request->email,
                            'no_hp' => $request->no_hp,
                            'status' => 'unchecked'
                        ]);
                    }
                    // Jika file melebihi 5 MB
                    else {
                        return redirect()->route('penerjemahan-public.index')
                            ->with('error', 'Gagal terkirim karena size file transkrip melebihi 5 MB!');
                    }
                }
                // Jika format foto dan file transkrip nilai salah
                else {
                    return redirect()->route('penerjemahan-public.index')
                        ->with('error', 'Gagal terkirim karena format tidak sesuai!');
                }
            }

            return redirect()->route('penerjemahan-public.index')
                ->with('success', 'Berhasil terkirim!');
        } elseif ($request->layanan === 'ijazah') {
            $request->validate([
                'path_foto_kuitansi' => 'required',
                'path_file_ijazah' => 'required',
                'email' => 'required|email',
                'no_hp' => 'required',
            ]);

            // Variabel
            $umum = Umum::where('user_id', Auth::id())->first();

            // Jika foto kuitansi dan file ijazah ada.
            if (
                $request->hasFile('path_foto_kuitansi') &&
                $request->hasFile('path_file_ijazah')
            ) {
                // Jika format foto dan file ijazah benar
                if (
                    $this->isMimeFileMatches(
                        [$request->path_foto_kuitansi],
                        ['image/jpeg', 'image/png']
                    )
                    &&
                    $this->isMimeFileMatches(
                        [$request->path_file_ijazah],
                        ['application/pdf', 'image/jpeg', 'image/png']
                    )
                ) {
                    $validatorFileSize = Validator::make($request->all(), [
                        // File maksimum 5 MB / 5000 KB
                        'path_file_ijazah' => 'max:5000',
                    ]);

                    // Jika file tidak melebihi 5 MB
                    if (!$validatorFileSize->fails()) {
                        IjazahUmum::create([
                            'umum_id' => $umum->id_umum,
                            'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/ijazah-umum/', 'public'),
                            'path_file_ijazah' => $request->path_file_ijazah->storeAs(
                                'dokumen/dokumen-ijazah/umum',
                                $request->path_file_ijazah->getClientOriginalName() . "{}" . $randToken,
                                'public'
                            ),
                            'email' => $request->email,
                            'no_hp' => $request->no_hp,
                            'status' => 'unchecked'
                        ]);
                    }
                    // Jika file melebihi 5 MB
                    else {
                        return redirect()->route('penerjemahan-public.index')
                            ->with('error', 'Gagal terkirim karena size file ijazah melebihi 5 MB!');
                    }
                }
                // Jika format foto dan file ijazah salah
                else {
                    return redirect()->route('penerjemahan-public.index')
                        ->with('error', 'Gagal terkirim karena format tidak sesuai!');
                }
            }

            return redirect()->route('penerjemahan-public.index')
                ->with('success', 'Berhasil terkirim!');
        } elseif ($request->layanan === 'transkripnilai_ijazah') {
            $request->validate([
                'path_foto_kuitansi_transkrip_nilai' => 'required',
                'path_foto_kuitansi_ijazah' => 'required',
                'path_file_transkrip_nilai' => 'required',
                'path_file_ijazah' => 'required',
                'email' => 'required|email',
                'no_hp' => 'required',
            ]);

            // Variabel
            $umum = Umum::where('user_id', Auth::id())->first();

            // Jika foto kuitansi dan file transkrip nilai dan ijazah ada.
            if (
                $request->hasFile('path_foto_kuitansi_transkrip_nilai') &&
                $request->hasFile('path_foto_kuitansi_ijazah') &&
                $request->hasFile('path_file_transkrip_nilai') &&
                $request->hasFile('path_file_ijazah')
            ) {
                // Jika format foto dan file transkrip nilai dan ijazah benar
                if (
                    $this->isMimeFileMatches(
                        [$request->path_foto_kuitansi_transkrip_nilai],
                        ['image/jpeg', 'image/png']
                    )
                    &&
                    $this->isMimeFileMatches(
                        [$request->path_file_transkrip_nilai],
                        ['application/pdf', 'image/jpeg', 'image/png']
                    )
                    &&
                    $this->isMimeFileMatches(
                        [$request->path_foto_kuitansi_ijazah],
                        ['image/jpeg', 'image/png']
                    )
                    &&
                    $this->isMimeFileMatches(
                        [$request->path_file_ijazah],
                        ['application/pdf', 'image/jpeg', 'image/png']
                    )
                ) {
                    $validatorFileSize = Validator::make($request->all(), [
                        // File maksimum 5 MB / 5000 KB
                        'path_file_transkrip_nilai' => 'max:5000',
                        'path_file_ijazah' => 'max:5000'
                    ]);

                    // Jika file tidak melebihi 5 MB
                    if (!$validatorFileSize->fails()) {
                        TranskripNilaiUmum::create([
                            'umum_id' => $umum->id_umum,
                            'path_foto_kuitansi' => $request->path_foto_kuitansi_transkrip_nilai->store('images/bukti-pembayaran/transkrip-nilai-umum/', 'public'),
                            'path_file_transkrip_nilai' => $request->path_file_transkrip_nilai->storeAs(
                                'dokumen/dokumen-transkrip/umum',
                                $request->path_file_transkrip_nilai->getClientOriginalName() . "{}" . $randToken,
                                'public'
                            ),
                            'email' => $request->email,
                            'no_hp' => $request->no_hp,
                            'status' => 'unchecked'
                        ]);

                        IjazahUmum::create([
                            'umum_id' => $umum->id_umum,
                            'path_foto_kuitansi' => $request->path_foto_kuitansi_ijazah->store('images/bukti-pembayaran/ijazah-umum/', 'public'),
                            'path_file_ijazah' => $request->path_file_ijazah->storeAs(
                                'dokumen/dokumen-ijazah/umum',
                                $request->path_file_ijazah->getClientOriginalName() . "{}" . $randToken,
                                'public'
                            ),
                            'email' => $request->email,
                            'no_hp' => $request->no_hp,
                            'status' => 'unchecked'
                        ]);
                    }
                    // Jika file melebihi 5 MB
                    else {
                        return redirect()->route('penerjemahan-public.index')
                            ->with('error', 'Gagal terkirim karena size file transkrip atau ijazah melebihi 5 MB!');
                    }
                }
                // Jika format foto dan file transkrip nilai dan ijazah salah
                else {
                    return redirect()->route('penerjemahan-public.index')
                        ->with('error', 'Gagal terkirim karena format tidak sesuai!');
                }
            }

            return redirect()->route('penerjemahan-public.index')
                ->with('success', 'Berhasil terkirim!');
        } elseif ($request->layanan === 'jurnal') {
            $request->validate([
                'path_foto_kuitansi' => 'required',
                'path_file_jurnal_umum' => 'required',
                'email' => 'required|email',
                'no_hp' => 'required',
                'jumlah_halaman_jurnal' => 'required',
            ]);

            // Variabel
            $umum = Umum::where('user_id', Auth::id())->first();

            // Jika foto kuitansi dan file jurnal ada.
            if (
                $request->hasFile('path_foto_kuitansi') &&
                $request->hasFile('path_file_jurnal_umum')
            ) {
                // Jika format foto dan file jurnal benar
                if (
                    $this->isMimeFileMatches(
                        [$request->path_foto_kuitansi],
                        ['image/jpeg', 'image/png']
                    )
                    &&
                    $this->isMimeFileMatches(
                        [$request->path_file_jurnal_umum],
                        ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
                    )
                ) {
                    $validatorFileSize = Validator::make($request->all(), [
                        // File maksimum 5 MB / 5000 KB
                        'path_file_jurnal_umum' => 'max:5000',
                    ]);

                    // Jika file tidak melebihi 5 MB
                    if (!$validatorFileSize->fails()) {
                        JurnalUmum::create([
                            'umum_id' => $umum->id_umum,
                            'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/jurnal-umum/', 'public'),
                            'path_file_jurnal_umum' => $request->path_file_jurnal_umum->storeAs(
                                'dokumen/dokumen-jurnal/umum',
                                $request->path_file_jurnal_umum->getClientOriginalName() . "{}" . $randToken,
                                'public'
                            ),
                            'email' => $request->email,
                            'no_hp' => $request->no_hp,
                            'jumlah_halaman_jurnal' => $request->jumlah_halaman_jurnal,
                            'status' => 'unverified'
                        ]);
                    }
                    // Jika file melebihi 5 MB
                    else {
                        return redirect()->route('penerjemahan-public.index')
                            ->with('error', 'Gagal terkirim karena size file jurnal melebihi 5 MB!');
                    }
                }
                // Jika format foto dan file jurnal salah
                else {
                    return redirect()->route('penerjemahan-public.index')
                        ->with('error', 'Gagal terkirim karena format tidak sesuai!');
                }
            }

            return redirect()->route('penerjemahan-public.index')
                ->with('success', 'Berhasil terkirim!');
        }
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
        //
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
    public function downloadAbstrakAdminPDF($id_umum, $id_abstrak_umum)
    {
        $file_name = AbstrakUmum::where([
            ['umum_id', '=', $id_umum],
            ['id_abstrak_umum', '=', $id_abstrak_umum],
        ])->value('path_file_abstrak_admin_pdf');
        $file = public_path('storage/') . $file_name;


        return response()->download($file);
    }
    public function downloadAbstrakAdminWORD($id_umum, $id_abstrak_umum)
    {
        $file_name = AbstrakUmum::where([
            ['umum_id', '=', $id_umum],
            ['id_abstrak_umum', '=', $id_abstrak_umum],
        ])->value('path_file_abstrak_admin_word');
        $file = public_path('storage/') . $file_name;


        return response()->download($file);
    }

    public function downloadJurnalAdminPDF($id_umum, $id_jurnal_umum)
    {
        $file_name = JurnalUmum::where([
            ['umum_id', '=', $id_umum],
            ['id_jurnal_umum', '=', $id_jurnal_umum],
        ])->value('path_file_jurnal_admin_pdf');
        $file = public_path('storage/') . $file_name;


        return response()->download($file);
    }

    public function downloadJurnalAdminWORD($id_umum, $id_jurnal_umum)
    {
        $file_name = JurnalUmum::where([
            ['umum_id', '=', $id_umum],
            ['id_jurnal_umum', '=', $id_jurnal_umum],
        ])->value('path_file_jurnal_admin_word');
        $file = public_path('storage/') . $file_name;


        return response()->download($file);
    }

    public function editAbstrakUmum($id_abstrak_umum)
    {
        $this->dataView['umum'] = Umum::where('user_id', Auth::id())->first();
        $this->dataView['abstrak'] = AbstrakUmum::where('id_abstrak_umum', $id_abstrak_umum)->first();
        return view('public.main.abstract_public.edit-abstrak', $this->dataView);
    }
    public function editJurnalUmum($id_jurnal_umum)
    {
        $this->dataView['umum'] = Umum::where('user_id', Auth::id())->first();
        $this->dataView['jurnal'] = JurnalUmum::where('id_jurnal_umum', $id_jurnal_umum)->first();

        return view('public.main.abstract_public.edit-jurnal', $this->dataView);
    }
    public function editIjazahUmum($id_ijazah_umum)
    {
        $this->dataView['umum'] = Umum::where('user_id', Auth::id())->first();
        $this->dataView['ijazah'] = IjazahUmum::where('id_ijazah_umum', $id_ijazah_umum)->first();

        return view('public.main.abstract_public.edit-ijazah', $this->dataView);
    }
    public function editTranskripNilaiUmum($id_transkrip_nilai_umum)
    {
        $this->dataView['umum'] = Umum::where('user_id', Auth::id())->first();
        $this->dataView['transkrip_nilai'] = TranskripNilaiUmum::where('id_transkrip_nilai_umum', $id_transkrip_nilai_umum)->first();
        // dd($this->dataView);
        return view('public.main.abstract_public.edit-transkrip', $this->dataView);
    }


    public function updateAbstrakUmum(Request $request, $id_abstrak_umum)
    {
        $randToken = rand(0, 20000);
        $request->validate([
            'path_foto_kuitansi' => 'required',
            'path_file_abstrak_umum' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
        ]);

        // Jika foto kuitansi dan file abstrak ada.
        if (
            $request->hasFile('path_foto_kuitansi') &&
            $request->hasFile('path_file_abstrak_umum')
        ) {
            // Jika format foto dan file abstrak benar
            if (
                $this->isMimeFileMatches(
                    [$request->path_foto_kuitansi],
                    ['image/jpeg', 'image/png']
                )
                &&
                $this->isMimeFileMatches(
                    [$request->path_file_abstrak_umum],
                    ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
                )
            ) {
                $validatorFileSize = Validator::make($request->all(), [
                    // File maksimum 5 MB / 5000 KB
                    'path_file_abstrak_umum' => 'max:5000',
                ]);

                // Jika file tidak melebihi 5 MB
                if (!$validatorFileSize->fails()) {
                    AbstrakUmum::where('id_abstrak_umum', $id_abstrak_umum)->update([
                        'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/abstrak/', 'public'),
                        'path_file_abstrak_umum' => $request->path_file_abstrak_umum->storeAs(
                            'dokumen/dokumen-abstrak/umum',
                            $request->path_file_abstrak_umum->getClientOriginalName() . "{}" . $randToken,
                            'public'
                        ),
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                    ]);
                }
                // Jika file melebihi 5 MB
                else {
                    return redirect()->route('penerjemahan-public.index')
                        ->with('error', 'Gagal terkirim karena size file abstract melebihi 5 MB!');
                }
            }
            // Jika format foto dan file abstrak salah
            else {
                return redirect()->route('penerjemahan-public.index')
                    ->with('error', 'Gagal terkirim karena format tidak sesuai!');
            }
        }

        return redirect()->route('penerjemahan-public.index')
            ->with('success', 'Berhasil terkirim!');
    }

    public function updateJurnalUmum(Request $request, $id_jurnal_umum)
    {
        $randToken = rand(0, 20000);
        $request->validate([
            'path_foto_kuitansi' => 'required',
            'path_file_jurnal_umum' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
        ]);

        // Jika foto kuitansi dan file jurnal ada.
        if (
            $request->hasFile('path_foto_kuitansi') &&
            $request->hasFile('path_file_jurnal_umum')
        ) {
            // Jika format foto dan file abstrak benar
            if (
                $this->isMimeFileMatches(
                    [$request->path_foto_kuitansi],
                    ['image/jpeg', 'image/png']
                )
                &&
                $this->isMimeFileMatches(
                    [$request->path_file_jurnal_umum],
                    ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
                )
            ) {
                $validatorFileSize = Validator::make($request->all(), [
                    // File maksimum 5 MB / 5000 KB
                    'path_file_jurnal_umum' => 'max:5000',
                ]);

                // Jika file tidak melebihi 5 MB
                if (!$validatorFileSize->fails()) {
                    JurnalUmum::where('id_jurnal_umum', $id_jurnal_umum)->update([
                        'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/jurnal-umum/', 'public'),
                        'path_file_jurnal_umum' => $request->path_file_jurnal_umum->storeAs(
                            'dokumen/dokumen-jurnal/umum',
                            $request->path_file_jurnal_umum->getClientOriginalName() . "{}" . $randToken,
                            'public'
                        ),
                        'jumlah_halaman_jurnal' => $request->jumlah_halaman_jurnal,
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                    ]);
                }
                // Jika file melebihi 5 MB
                else {
                    return redirect()->route('penerjemahan-public.index')
                        ->with('error', 'Gagal terkirim karena size file jurnal melebihi 5 MB!');
                }
            }
            // Jika format foto dan file jurnal salah
            else {
                return redirect()->route('penerjemahan-public.index')
                    ->with('error', 'Gagal terkirim karena format tidak sesuai!');
            }
        }

        return redirect()->route('penerjemahan-public.index')
            ->with('success', 'Berhasil terkirim!');
    }


    public function updateIjazahUmum(Request $request, $id_ijazah_umum)
    {
        $randToken = rand(0, 20000);
        $request->validate([
            'path_foto_kuitansi' => 'required',
            'path_file_ijazah' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
        ]);

        // Jika foto kuitansi dan file jurnal ada.
        if (
            $request->hasFile('path_foto_kuitansi') &&
            $request->hasFile('path_file_ijazah')
        ) {
            // Jika format foto dan file abstrak benar
            if (
                $this->isMimeFileMatches(
                    [$request->path_foto_kuitansi],
                    ['image/jpeg', 'image/png']
                )
                &&
                $this->isMimeFileMatches(
                    [$request->path_file_ijazah],
                    ['application/pdf', 'image/jpeg', 'image/png']
                )
            ) {
                $validatorFileSize = Validator::make($request->all(), [
                    // File maksimum 5 MB / 5000 KB
                    'path_file_ijazah' => 'max:5000',
                ]);

                // Jika file tidak melebihi 5 MB
                if (!$validatorFileSize->fails()) {
                    IjazahUmum::where('id_ijazah_umum', $id_ijazah_umum)->update([
                        'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/ijazah/', 'public'),
                        'path_file_ijazah' => $request->path_file_ijazah->storeAs(
                            'dokumen/dokumen-ijazah/umum',
                            $request->path_file_ijazah->getClientOriginalName() . "{}" . $randToken,
                            'public'
                        ),
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                    ]);
                }
                // Jika file melebihi 5 MB
                else {
                    return redirect()->route('penerjemahan-public.index')
                        ->with('error', 'Gagal terkirim karena size file ijazah melebihi 5 MB!');
                }
            }
            // Jika format foto dan file jurnal salah
            else {
                return redirect()->route('penerjemahan-public.index')
                    ->with('error', 'Gagal terkirim karena format tidak sesuai!');
            }
        }

        return redirect()->route('penerjemahan-public.index')
            ->with('success', 'Berhasil terkirim!');
    }

    public function updateTranskripNilaiUmum(Request $request, $id_transkrip_nilai_umum)
    {
        $randToken = rand(0, 20000);
        $request->validate([
            'path_foto_kuitansi' => 'required',
            'path_file_transkrip_nilai' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
        ]);

        // Jika foto kuitansi dan file jurnal ada.
        if (
            $request->hasFile('path_foto_kuitansi') &&
            $request->hasFile('path_file_transkrip_nilai')
        ) {
            // Jika format foto dan file abstrak benar
            if (
                $this->isMimeFileMatches(
                    [$request->path_foto_kuitansi],
                    ['image/jpeg', 'image/png']
                )
                &&
                $this->isMimeFileMatches(
                    [$request->path_file_transkrip_nilai],
                    ['application/pdf', 'image/jpeg', 'image/png']
                )
            ) {
                $validatorFileSize = Validator::make($request->all(), [
                    // File maksimum 5 MB / 5000 KB
                    'path_file_transkrip_nilai' => 'max:5000',
                ]);

                // Jika file tidak melebihi 5 MB
                if (!$validatorFileSize->fails()) {
                    TranskripNilaiUmum::where('id_transkrip_nilai_umum', $id_transkrip_nilai_umum)->update([
                        'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/transkrip-nilai/', 'public'),
                        'path_file_transkrip_nilai' => $request->path_file_transkrip_nilai->storeAs(
                            'dokumen/dokumen-transkrip/umum',
                            $request->path_file_transkrip_nilai->getClientOriginalName() . "{}" . $randToken,
                            'public'
                        ),
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                    ]);
                }
                // Jika file melebihi 5 MB
                else {
                    return redirect()->route('penerjemahan-public.index')
                        ->with('error', 'Gagal terkirim karena size file transkrip melebihi 5 MB!');
                }
            }
            // Jika format foto dan file jurnal salah
            else {
                return redirect()->route('penerjemahan-public.index')
                    ->with('error', 'Gagal terkirim karena format tidak sesuai!');
            }
        }

        return redirect()->route('penerjemahan-public.index')
            ->with('success', 'Berhasil terkirim!');
    }
}
