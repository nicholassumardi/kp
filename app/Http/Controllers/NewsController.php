<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth.admin')->only(['index', 'create', 'edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['data_berita'] = News::all();
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();

        return view('admin.main.news_admin.index', $this->dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        return view('admin.main.news_admin.create', $this->dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('path_foto_berita')) { // Jika foto ada
            if ($this->isMimeFileMatches(
                [$request->path_foto_berita],
                ['image/jpeg', 'image/png']
            )) {
                $request->validate([
                    'judul_berita' => 'required',
                    'tanggal_berita' => 'required',
                    'isi_berita' => 'required',
                ]);

                $idAdmin = Admin::where('user_id', Auth::id())->first();

                News::create([
                    'admin_id' => $idAdmin->id_admin,
                    'judul_berita' => $request->judul_berita,
                    'tanggal_berita' => date('d-m-Y', strtotime($request->tanggal_berita)),
                    'path_foto_berita' => $request->path_foto_berita->store('images/berita/foto', 'public'),
                    'isi_berita' => $request->isi_berita
                ]);
            } else {
                return redirect()->route('addCourse.create')
                    ->with('error', 'Failed to create News, Picture in wrong format');
            }
        } else {
            $request->validate([
                'judul_berita' => 'required',
                'tanggal_berita' => 'required',
                'isi_berita' => 'required',
            ]);

            $idAdmin = Admin::where('user_id', Auth::id())->first();

            News::create([
                'admin_id' => $idAdmin->id_admin,
                'judul_berita' => $request->judul_berita,
                'tanggal_berita' => date('Y-m-d', strtotime($request->tanggal_berita)),
                'isi_berita' => $request->isi_berita
            ]);
        }
        return redirect()->route('addNews.index')
            ->with('success', 'News created successfully.');
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
        $this->dataview['data_berita'] = News::where('id_berita', $id)->first();
        $this->dataView['admin'] = Admin::where('user_id', Auth::id())->first();
        return view('admin.main.news_admin.edit', $this->dataView);
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
        News::where('id_berita', $id)->delete();

        return redirect()->route('addNews.index')
            ->with('success', 'News deleted successfully .');
    }
}
