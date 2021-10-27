<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class FrontpagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.home')->only(['index']);
    }
    
    public function index()
    {
        return view('frontpages.home.index');
    }

    public function NewsIndex()
    {
        $this->dataView['berita'] = News::paginate(3);
        return view ('frontpages.news.index', $this->dataView);
    }


    public function ShowNews($id)
    {
        $this->dataView['berita'] = News::where('id_berita', $id)->first();
        return view ('frontpages.news.show', $this->dataView);
    }
}
