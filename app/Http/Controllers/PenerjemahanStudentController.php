<?php

namespace App\Http\Controllers;

use App\Models\Abstrak;
use App\Models\Ijazah;
use App\Models\Jurnal;
use App\Models\Mahasiswa;
use App\Models\TranskripNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenerjemahanStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.student')->only(['index', 'create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['mahasiswa'] = Mahasiswa::where('user_id', Auth::id())->first();
        $this->dataView['data_abstract'] = Abstrak::where('mahasiswa_id', $this->dataView['mahasiswa']->id_mahasiswa)->get();
        $this->dataView['data_transkrip_nilai'] = TranskripNilai::where('mahasiswa_id', $this->dataView['mahasiswa']->id_mahasiswa)->get();
        $this->dataView['data_ijazah'] = Ijazah::where('mahasiswa_id', $this->dataView['mahasiswa']->id_mahasiswa)->get();
        $this->dataView['data_jurnal'] = Jurnal::where('mahasiswa_id', $this->dataView['mahasiswa']->id_mahasiswa)->get();

        return view('student.main.abstract_student.index', $this->dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->dataView['mahasiswa'] = Mahasiswa::where('user_id', Auth::id())->first();

        return view('student.main.abstract_student.create', $this->dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
    
        if ($request->layanan === 'abstrak') {
            $request->validate([
                'path_foto_kuitansi' => 'required',
                'path_file_abstrak_mahasiswa' => 'required',
                'email' =>'required|email',
                'no_hp' => 'required',
            ]);
    
            // Variabel
            $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
    
            // Jika foto kuitansi dan file abstrak ada.
            if (
                $request->hasFile('path_foto_kuitansi') &&
                $request->hasFile('path_file_abstrak_mahasiswa')
            ) {
                // Jika format foto dan file abstrak benar
                if (
                    $this->isMimeFileMatches(
                        [$request->path_foto_kuitansi],
                        ['image/jpeg', 'image/png']
                    )
                    &&
                    $this->isMimeFileMatches(
                        [$request->path_file_abstrak_mahasiswa],
                        ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
                    )
                ) {
                    Abstrak::create([
                        'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                        'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/abstrak/', 'public'),
                        'path_file_abstrak_mahasiswa' => $request->path_file_abstrak_mahasiswa->storeAs(
                            'dokumen/dokumen-abstrak/mahasiswa', 
                            $request->path_file_abstrak_mahasiswa->getClientOriginalName(), 
                            'public'
                        ),
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                        'status' => 'unverified'
                    ]);
                }
                // Jika format foto dan file abstrak salah
                else {
                    return redirect()->route('penerjemahan-student.index')
                        ->with('error', 'Gagal terkirim karena format tidak sesuai!');
                }
            }
    
            return redirect()->route('penerjemahan-student.index')
                ->with('success', 'Berhasil terkirim!');

        } elseif ($request->layanan === 'transkripnilai') {
            $request->validate([
                'path_foto_kuitansi' => 'required',
                'path_file_transkrip_nilai' => 'required',
                'email' =>'required|email',
                'no_hp' => 'required',
            ]);
    
            // Variabel
            $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
    
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
                    TranskripNilai::create([
                        'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                        'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/transkrip-nilai/', 'public'),
                        'path_file_transkrip_nilai' => $request->path_file_transkrip_nilai->storeAs(
                            'dokumen/dokumen-transkrip/mahasiswa', 
                            $request->path_file_transkrip_nilai->getClientOriginalName(), 
                            'public'
                        ),
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                        'status' => 'unchecked'
                    ]);
                }
                // Jika format foto dan file transkrip nilai salah
                else {
                    return redirect()->route('penerjemahan-student.index')
                        ->with('error', 'Gagal terkirim karena format tidak sesuai!');
                }
            }
    
            return redirect()->route('penerjemahan-student.index')
                ->with('success', 'Berhasil terkirim!');

        } elseif ($request->layanan === 'ijazah') {
            $request->validate([
                'path_foto_kuitansi' => 'required',
                'path_file_ijazah' => 'required',
                'email' =>'required|email',
                'no_hp' => 'required',
            ]);
    
            // Variabel
            $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
    
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
                    Ijazah::create([
                        'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                        'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/ijazah/', 'public'),
                        'path_file_ijazah' => $request->path_file_ijazah->storeAs(
                            'dokumen/dokumen-ijazah/mahasiswa', 
                            $request->path_file_ijazah->getClientOriginalName(), 
                            'public'
                        ),
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                        'status' => 'unchecked'
                    ]);
                }
                // Jika format foto dan file ijazah salah
                else {
                    return redirect()->route('penerjemahan-student.index')
                        ->with('error', 'Gagal terkirim karena format tidak sesuai!');
                }
            }
    
            return redirect()->route('penerjemahan-student.index')
                ->with('success', 'Berhasil terkirim!');

        } elseif ($request->layanan === 'transkripnilai_ijazah') {
            $request->validate([
                'path_foto_kuitansi_transkrip_nilai' => 'required',
                'path_foto_kuitansi_ijazah' => 'required',
                'path_file_transkrip_nilai' => 'required',
                'path_file_ijazah' => 'required',
                'email' =>'required|email',
                'no_hp' => 'required',
            ]);
    
            // Variabel
            $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
    
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
                    TranskripNilai::create([
                        'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                        'path_foto_kuitansi' => $request->path_foto_kuitansi_transkrip_nilai->store('images/bukti-pembayaran/transkrip-nilai/', 'public'),
                        'path_file_transkrip_nilai' => $request->path_file_transkrip_nilai->storeAs(
                            'dokumen/dokumen-transkrip/mahasiswa', 
                            $request->path_file_transkrip_nilai->getClientOriginalName(), 
                            'public'
                        ),
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                        'status' => 'unchecked'
                    ]);

                    Ijazah::create([
                        'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                        'path_foto_kuitansi' => $request->path_foto_kuitansi_ijazah->store('images/bukti-pembayaran/ijazah/', 'public'),
                        'path_file_ijazah' => $request->path_file_ijazah->storeAs(
                            'dokumen/dokumen-ijazah/mahasiswa', 
                            $request->path_file_ijazah->getClientOriginalName(), 
                            'public'
                        ),
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                        'status' => 'unchecked'
                    ]);
                }
                // Jika format foto dan file transkrip nilai dan ijazah salah
                else {
                    return redirect()->route('penerjemahan-student.index')
                        ->with('error', 'Gagal terkirim karena format tidak sesuai!');
                }
            }
    
            return redirect()->route('penerjemahan-student.index')
                ->with('success', 'Berhasil terkirim!');
        }elseif ($request->layanan === 'jurnal') {
            $request->validate([
                'path_foto_kuitansi' => 'required',
                'path_file_jurnal_mahasiswa' => 'required',
                'email' =>'required|email',
                'no_hp' => 'required',
                'jumlah_halaman_jurnal' => 'required',
            ]);
    
            // Variabel
            $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
    
            // Jika foto kuitansi dan file jurnal ada.
            if (
                $request->hasFile('path_foto_kuitansi') &&
                $request->hasFile('path_file_jurnal_mahasiswa')
            ) {
                // Jika format foto dan file jurnal benar
                if (
                    $this->isMimeFileMatches(
                        [$request->path_foto_kuitansi],
                        ['image/jpeg', 'image/png']
                    )
                    &&
                    $this->isMimeFileMatches(
                        [$request->path_file_jurnal_mahasiswa],
                        ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
                    )
                ) {
                    Jurnal::create([
                        'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                        'path_foto_kuitansi' => $request->path_foto_kuitansi->store('images/bukti-pembayaran/abstrak/', 'public'),
                        'path_file_jurnal_mahasiswa' => $request->path_file_jurnal_mahasiswa->storeAs(
                            'dokumen/dokumen-jurnal/mahasiswa', 
                            $request->path_file_jurnal_mahasiswa->getClientOriginalName(), 
                            'public'
                        ),
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                        'jumlah_halaman_jurnal' => $request->jumlah_halaman_jurnal,
                        'status' => 'unverified'
                    ]);
                }
                // Jika format foto dan file jurnal salah
                else {
                    return redirect()->route('penerjemahan-student.index')
                        ->with('error', 'Gagal terkirim karena format tidak sesuai!');
                }
            }
    
            return redirect()->route('penerjemahan-student.index')
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

    public function downloadAbstrakAdminPDF($id_mahasiswa, $id_abstrak){
        $file_name = Abstrak::where([
            ['mahasiswa_id', '=', $id_mahasiswa],
            ['id_abstrak', '=', $id_abstrak],
        ])->value('path_file_abstrak_admin_pdf');
        $file = public_path('storage/'). $file_name;
   

        return response()->download($file);
        
    }
    public function downloadAbstrakAdminWORD($id_mahasiswa, $id_abstrak){
        $file_name = Abstrak::where([
            ['mahasiswa_id', '=', $id_mahasiswa],
            ['id_abstrak', '=', $id_abstrak],
        ])->value('path_file_abstrak_admin_word');
        $file = public_path('storage/'). $file_name;
   

        return response()->download($file);
        
    }
    
    public function downloadJurnalAdminPDF($id_mahasiswa, $id_jurnal){
        $file_name = Jurnal::where([
            ['mahasiswa_id', '=', $id_mahasiswa],
            ['id_jurnal', '=', $id_jurnal],
        ])->value('path_file_jurnal_admin_pdf');
        $file = public_path('storage/'). $file_name;
   

        return response()->download($file);
        
    }

    public function downloadJurnalAdminWORD($id_mahasiswa, $id_jurnal){
        $file_name = Jurnal::where([
            ['mahasiswa_id', '=', $id_mahasiswa],
            ['id_jurnal', '=', $id_jurnal],
        ])->value('path_file_jurnal_admin_word');
        $file = public_path('storage/'). $file_name;
   

        return response()->download($file);
        
    }
}
