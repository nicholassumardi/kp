@extends('frontpages/layouts/app')
@section('content')

<div class="container">

    <div class="row justify-content-center" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1400">
        @foreach ($berita as $databerita)
        <div class="col-auto mt-5">
            <div class="card" style="width: 50vw;">
                <div class="card-body">
                    <img src="{{'storage/' . $databerita->path_foto_berita}}" class="card-img-top" alt="...">
                    <h5 class="card-title">{{$databerita->judul_berita}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$databerita->tanggal_berita}}</h6>
                    <p class="card-text">{!! Str::limit($databerita->isi_berita, 100) !!}.</p>
                    <a href="{{route('news.show', $databerita->id_berita)}}" class="btn btn-outline-primary">See
                        More</a>
                </div>
            </div>
        </div>
        @endforeach

        <div class="d-flex justify-content-center mt-5 mb-3 pagination">
            {!! $berita->links() !!}
        </div>
    </div>

</div>

@endsection