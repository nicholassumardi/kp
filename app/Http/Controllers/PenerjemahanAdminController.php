<?php

namespace App\Http\Controllers;

use App\Models\Abstrak;
use App\Models\Admin;
use App\Models\Ijazah;
use App\Models\Jurnal;
use App\Models\TranskripNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->dataView['data_abstract'] = Abstrak::all();
        $this->dataView['data_transkrip_nilai'] = TranskripNilai::all();
        $this->dataView['data_ijazah'] = Ijazah::all();
        $this->dataView['data_jurnal'] = Jurnal::all();
        $this->dataView['abstrak_count'] = count($this->dataView['data_abstract']);
        $this->dataView['transkrip_nilai_count'] = count($this->dataView['data_transkrip_nilai']);
        $this->dataView['ijazah_count'] = count($this->dataView['data_ijazah']);
        $this->dataView['jurnal_count'] = count($this->dataView['data_jurnal']);

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
                'status' => 'verified',
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
                'status' => 'verified',
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
            }
        }
        // Jika request bukan ajax, throw halaman 403.
        return abort(403);
    }
}
