@extends('frontpages/layouts/app')

@section('content')

<div class="container padding">

    <div class="row text-start mt-4" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1400">
        <div class="col-sm-9 aboutme">
            <h2></h2>
            <h2>ITATS LANGUAGE CENTRE</h2>
            <hr class="solid">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5 aboutmedesc" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1400">
            <p>English is the window of the Global World, join us to develop your self and future career by improving your English.
            </p>
        </div>
    </div>

    <div class="row mt-2 mb-3" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1400"
        data-aos-once="true">
        <div class="col-sm">
            <a href="https://www.instagram.com/pusbaitats/?hl=en"><button type="button" class="btn btn-sm col-sm-3 custombutton shadow d-flex justify-content-center">  <i class="mx-2 fa fa-instagram fa-lg mt-1" style="font-size: 42px;"></i><span class="instagram">More Information On<span style="margin-bottom: 0em;display: block;"></span> <span class="instagram2">Instagram</span></span></button></a>
        </div>
    </div>

    {{-- <div class="row col-l" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1400" data-aos-once="true">
        <div class="container ms-1 text-center">
            <div class="social mt-2 mb-3">
                <a target="_blank" href="https://www.instagram.com/pusbaitats/?hl=en" class="aboutmedesc">
                    <i class="mx-2 fa fa-instagram fa-lg"></i> Follow Us On Instagram
                </a>
            </div>
        </div>
    </div> --}}



    <div class="row fixed-bottom logohero" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="900">
        <div class="col-md">
            <img src="{{asset('images/human.png')}}" alt="" class="logohero">
        </div>
    </div>



</div>

@endsection