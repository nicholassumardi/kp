@extends('frontpages/layouts/app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1400">
         <div class="mt-5 mb-5">
            <div class="card" style="width: 70vw;">
                <div class="card-body">
                    <p class="newstitle">{{$berita->judul_berita}}</p>
                    <h6 class="card-subtitle mb-2 text-muted">Date: {{$berita->tanggal_berita}}&nbsp; By:
                        {{$berita->admin->nama}}</h6>
                    <img src="{{asset('storage/' . $berita->path_foto_berita)}}" class="card-img-top">
                    <p class="card-text">{!! $berita->isi_berita !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection